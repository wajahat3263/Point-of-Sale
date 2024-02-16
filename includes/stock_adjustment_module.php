<?php
    ///include database connection///
    require_once "config.php";
    ///================================Add Stock Adjustment==============================///
    ///===========Handle Get product data Ajax Request=========///
    if(isset($_POST["product_id"])){
        // print_r ($_POST);
        $product_id = $_POST["product_id"];

        $query = $con->prepare("SELECT * FROM products WHERE pro_id=:pro_id");
        $query->execute([
            "pro_id"=>$product_id
        ]);
        $data = $query->fetch(PDO::FETCH_ASSOC);

        $product_data["pro_id"] = $data["pro_id"];
        $product_data["pro_name"] = $data["pro_name"];
        $product_data["pro_purchase_price"] = $data["pro_purchase_price"];
        $product_data["pro_sale_price"] = $data["pro_sale_price"];

        echo json_encode($product_data);


    }

    ///=========Handle save invoice AJAX request=========///
    if(isset($_POST["action"]) && $_POST["action"]=="save_invoice"){
        // print_r($_POST);

        $stock_date = $_POST["stock_date"];
        $detail = $_POST["detail"];
        $sub_total = $_POST["sub_total"];

        $pro_id = $_POST["pro_id"];
        $pur_price = $_POST["pur_price"];
        $sale_price = $_POST["sale_price"];
        $qty = $_POST["qty"];
        $total = $_POST["total"];

        $query = $con->prepare("INSERT INTO stk_adjustment (adj_date, adj_detail, adj_gtotal) VALUES(:adj_date, :adj_detail, :adj_gtotal)");
        $query->execute([
            "adj_date"=>$stock_date,
            "adj_detail"=>$detail,
            "adj_gtotal"=>$sub_total

        ]);
        if($query){

            $adj_id = $con->lastInsertId();
            for($i=0; $i < count($pro_id); $i++){

                $all_stock = $con->prepare("INSERT INTO all_stock (stk_adj_id, product_id, invoice_date, purchase_price, sale_price, total_stk_adj_price, stock_out_qty) VALUES (:stk_adj_id, :product_id, :invoice_date, :purchase_price, :sale_price, :total_stk_adj_price, :stock_out_qty)");
                $all_stock->execute([
                    "stk_adj_id"=>$adj_id,
                    "product_id"=>$pro_id[$i],
                    "invoice_date"=>$stock_date,
                    "purchase_price"=>$pur_price[$i],
                    "sale_price"=>$sale_price[$i],
                    "total_stk_adj_price"=>$total[$i],
                    "stock_out_qty"=>$qty[$i]

                ]);
            }

            echo "stock_added"; 

        }else{
            echo "stock_not_added";
        }
    

    }

    ///================================All Stock Adjustment===============================///
    ///=========Handle load stock data AJAX request=========///
    if(isset($_POST["load"])){

        $load = $con->prepare("SELECT * FROM stk_adjustment");
        $load->execute();
        $row = $load->fetchAll(PDO::FETCH_ASSOC);
    
        $output = "";
        $no = 1;
    
        if($row){
            $output = "<table>
                    <thead>
                      <tr>
                      <th style='width:1%;'>No.</th>
                      <th>Date</th>
                      <th>Detail</th>
                      <th>Total</th>
                      <th style='width:15%;'>Actions</th>
                      </tr>
                    </thead>
                    <tbody>";
            foreach($row as $row){            
                $output .="<tr>
                <td>{$no}</td>
                <td>{$row["adj_date"]}</td>
                <td>{$row["adj_detail"]}</td>
                <td>{$row["adj_gtotal"]}</td>
                <td> 
                <button class='btn btn-primary' id='view_btn' data-vid='{$row["stk_adjustment_id"]}'><i class='fa fa-eye'></i></button>
                <a class='btn btn-success' id='edit_btn' href='update_stock_adjustment.php?stk_adjustment_id={$row["stk_adjustment_id"]}'><i class='fa fa-edit'></i></a>
                <button class='btn btn-danger' id='delete_btn' data-did='{$row["stk_adjustment_id"]}'><i class='fa fa-trash'></i></button>
                </td>
                </tr> ";
                $no++;
            }
            $output .= "</tbody></table>";
            echo $output;
        }else{
            echo "<table>
            <thead>
            <tr>
                <th style='width:1%;'>No.</th>
                <th>Date</th>
                <th>Detail</th>
                <th>Total</th>
                <th style='width:18%;'>Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            </table>";
        }
        
    }

    ///========Handle view stock data AJAX request==========///
    if(isset($_POST["vid"])){

        $vid = $_POST["vid"];
                
        $view_query = $con->prepare("SELECT * FROM stk_adjustment WHERE stk_adjustment_id=:stk_adjustment_id");
            $view_query->execute([
                "stk_adjustment_id"=>$vid
            ]);
        
        $view = $view_query->fetch(PDO::FETCH_ASSOC);
        
        $purchase["expense_date"] = $view["adj_date"];
        $purchase["exp_detail"] = $view["adj_detail"];
        $purchase["grand_total"] = $view["adj_gtotal"];
    
        echo json_encode($purchase);
        
    }
    if (isset($_POST["tid"])) {

        $tid = $_POST["tid"];

        $tab_query = $con->prepare("SELECT * FROM all_stock LEFT JOIN products ON all_stock.product_id=products.pro_id WHERE stk_adj_id=:stk_adj_id");
        $tab_query->execute([
            "stk_adj_id" => $tid
        ]);
        $tab = $tab_query->fetchAll(PDO::FETCH_ASSOC);

        $output = "";
        $no = 1;

        if ($tab) {
            $output = "<table>
                    <thead style='color: blue; background-color: lightgray;'>
                    <tr>
                        <th>No#</th>
                        <th>Name</th>
                        <th>Sale Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>";
            foreach ($tab as $tab) {
                $output .= "<tr>
                <td>{$no}</td>
                <td>{$tab["pro_name"]}</td>
                <td>{$tab["sale_price"]}</td>
                <td>{$tab["stock_out_qty"]}</td>
                <td>{$tab["total_stk_adj_price"]}</td>
                </tr> ";
                $no++;
            }
            $output .= "</tbody></table>";
            echo $output;


        }else{
            echo "<table>
            <thead>
            <tr>
                <th>No#</th>
                <th>Name</th>
                <th>Sale Price</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            </table>";
        }


    }

    ///=====Delete stock AJAX request=====///
    if(isset($_POST["did"])){
        // print_r($_POST);
        $did = $_POST["did"];
        $del = $con->prepare("DELETE FROM stk_adjustment WHERE stk_adjustment_id=:stk_adjustment_id");
        $del->execute([
            "stk_adjustment_id"=>$did
        ]);

        $dele = $con->prepare("DELETE FROM all_stock WHERE stk_adj_id=:stk_adj_id");
        $dele->execute([
            "stk_adj_id"=>$did
        ]);

        echo "deleted";


    }

    ///============================update Stock Adj Module==============================///
    ///=========Handle update invoice AJAX request=========///
    if(isset($_POST["action"]) && $_POST["action"]=="update_invoice"){
        // print_r($_POST);
        $ops_id = $_POST["ops_id"];
        $stock_date = $_POST["stock_date"];
        $detail = $_POST["detail"];
        $sub_total = $_POST["sub_total"];

        $pro_id = $_POST["pro_id"];
        $pur_price = $_POST["pur_price"];
        $sale_price = $_POST["sale_price"];
        $qty = $_POST["qty"];
        $total = $_POST["total"];

        $query = $con->prepare("UPDATE stk_adjustment SET adj_date=:adj_date, adj_detail=:adj_detail, adj_gtotal=:adj_gtotal WHERE stk_adjustment_id=:stk_adjustment_id");
        $query->execute([
            "adj_date"=>$stock_date,
            "adj_detail"=>$detail,
            "adj_gtotal"=>$sub_total,
            "stk_adjustment_id"=>$ops_id

        ]);

        if($query){

            $d_query = $con->prepare("DELETE FROM all_stock WHERE stk_adj_id=:stk_adj_id");
            $d_query->execute([
                "stk_adj_id"=>$ops_id
            ]);

            for($i=0; $i < count($pro_id); $i++){

                $all_stock = $con->prepare("INSERT INTO all_stock (stk_adj_id, product_id, invoice_date, purchase_price, sale_price, total_stk_adj_price, stock_out_qty) VALUES (:stk_adj_id, :product_id, :invoice_date, :purchase_price, :sale_price, :total_stk_adj_price, :stock_out_qty)");
                $all_stock->execute([
                    "stk_adj_id"=>$ops_id,
                    "product_id"=>$pro_id[$i],
                    "invoice_date"=>$stock_date,
                    "purchase_price"=>$pur_price[$i],
                    "sale_price"=>$sale_price[$i],
                    "total_stk_adj_price"=>$total[$i],
                    "stock_out_qty"=>$qty[$i]

                ]);
            }

            echo "stock_updated"; 

        }else{
            echo "stock_not_updated";
        }
        

    }


?>