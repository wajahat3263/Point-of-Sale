<?php
    ///include database connection///
    require_once "config.php";
    ///=======================================Purchase=====================================///
    ///===========Handle Get product data Ajax Request=========///
    if(isset($_POST["product_id"])){
        // print_r ($_POST);
        $product_id = $_POST["product_id"];

    $query = $con->prepare("SELECT * FROM products WHERE pro_id=:pro_id");
    $query->execute([
        "pro_id"=>$product_id
    ]);
    $data = $query->fetch(PDO::FETCH_ASSOC);

    $product_data["pur_price"] = $data["pro_purchase_price"];
    $product_data["sale_price"] = $data["pro_sale_price"];
    $product_data["id"] = $data["pro_id"];

    $query1 = $con->prepare("SELECT SUM(stock_in_qty-stock_out_qty) FROM all_stock WHERE product_id=:product_id");
    $query1->execute([
        "product_id"=>$product_id
    ]);
    $datas = $query1->fetch(PDO::FETCH_ASSOC);
    $product_data["old_stock"] = $datas["SUM(stock_in_qty-stock_out_qty)"];

    
    echo json_encode($product_data);


    }

    ///=========Handle save invoice AJAX request=========///
    if(isset($_POST["action"]) && $_POST["action"]=="save_invoice"){
        // print_r($_POST);
        $sup_id = $_POST["sup_name"];
        $pur_date = $_POST["pur_date"];

        $pro_id = $_POST["pro_name"];
        $pur_price = $_POST["pur_price"];
        $sale_price = $_POST["sale_price"];
        $qty = $_POST["qty"];
        $total = $_POST["total"];

        $detail = $_POST["detail"];
        //invoice
        $sub_total = $_POST["sub_total"];
        $tax_percent = $_POST["tax_percent"];
        $tax_rupees = $_POST["tax_rupees"];
        $final_amount = $_POST["f_amount"];
        $paid_amount = $_POST["paid_amount"];
        $due_amount = $_POST["due_amount"];


    $query = $con->prepare("INSERT INTO purchase (supplier_id, pur_date, pur_detail, subtotal, discount_percent, discount_amount, total, paid_amount, due_amount) VALUES(:supplier_id, :pur_date, :pur_detail, :subtotal, :discount_percent, :discount_amount, :total, :paid_amount, :due_amount)");
    $query->execute([
        "supplier_id"=>$sup_id,
        "pur_date"=>$pur_date,
        "pur_detail"=>$detail,
        "subtotal"=>$sub_total,
        "discount_percent"=>$tax_percent,
        "discount_amount"=>$tax_rupees,
        "total"=>$final_amount,
        "paid_amount"=>$paid_amount,
        "due_amount"=>$due_amount
    ]);
    if($query){

        $pur_id = $con->lastInsertId();
        for($i=0; $i < count($pro_id); $i++){

            $all_stock = $con->prepare("INSERT INTO all_stock (purchase_id, supplier_id, product_id, invoice_date, purchase_price, sale_price, total_pur_price, stock_in_qty) VALUES (:purchase_id, :supplier_id, :product_id, :invoice_date, :purchase_price, :sale_price, :total_pur_price, :stock_in_qty)");
            $all_stock->execute([
                "purchase_id"=>$pur_id,
                "supplier_id"=>$sup_id,
                "product_id"=>$pro_id[$i],
                "invoice_date"=>$pur_date,
                "purchase_price"=>$pur_price[$i],
                "sale_price"=>$sale_price[$i],
                "total_pur_price"=>$total[$i],
                "stock_in_qty"=>$qty[$i]

            ]);
        }

        $product_id=implode(",",$pro_id);
        $product_qty=implode(",",$qty);
        $trn_type=2;
        $trn_detail="Buy Products";
        $ledger=$con->prepare("INSERT INTO supp_ledger (supp_id, pur_id, pro_id, pro_qty, trn_date, trn_detail, trn_type, paid, received) VALUES (:supp_id, :pur_id, :pro_id, :pro_qty, :trn_date, :trn_detail, :trn_type, :paid, :received)");
        $ledger->execute([
            "supp_id"=>$sup_id,
            "pur_id"=>$pur_id,
            "pro_id"=>$product_id,
            "pro_qty"=>$product_qty,
            "trn_date"=>$pur_date,
            "trn_detail"=>$trn_detail,
            "trn_type"=>$trn_type,
            "paid"=>$paid_amount,
            "received"=>$final_amount
        ]);

        echo "purchase_added"; 

    }else{
        echo "purchase_not_added";
    }
    

    }

    ///======================================All Purchase==================================///
    ///=========Handle load purchase data AJAX request=========///
    if(isset($_POST["load"])){

    $load = $con->prepare("SELECT * FROM purchase LEFT JOIN suppliers ON purchase.supplier_id=suppliers.supplier_id");
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
                  <th>Supp Name</th>
                  <th>Subtotal</th>
                  <th>Tax%</th>
                  <th>Tax Amount</th>
                  <th>Total</th>
                  <th style='width:18%;'>Actions</th>
                  </tr>
                </thead>
                <tbody>";
        foreach($row as $row){            
            $output .="<tr>
            <td>{$no}</td>
            <td>{$row["pur_date"]}</td>
            <td>{$row["company"]}</td>
            <td>{$row["subtotal"]}</td>
            <td>{$row["discount_percent"]}</td>
            <td>{$row["discount_amount"]}</td>
            <td>{$row["total"]}</td>
            <td> 
            <button class='btn btn-primary' id='view_btn' data-vid='{$row["purchase_id"]}'><i class='fa fa-eye'></i></button>
            <a class='btn btn-success' id='edit_btn' href='update_purchase.php?purchase_id={$row["purchase_id"]}'><i class='fa fa-edit'></i></a>
            <a class='btn btn-warning' id='edit_btn' href='purchase_return.php?purchase_id={$row["purchase_id"]}'><i class='fa fa-undo'></i></a>
            <button class='btn btn-danger' id='delete_btn' data-did='{$row["purchase_id"]}'><i class='fa fa-trash'></i></button>
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
          <th>No.</th>
          <th>Date</th>
          <th>Supp Name</th>
          <th>Subtotal</th>
          <th>Tax%</th>
          <th>Tax Amount</th>
          <th>Total</th>
          <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
        </table>";
    }
    
    }

    ///========Handle view purchase data AJAX request==========///
    if(isset($_POST["vid"])){

    $vid = $_POST["vid"];
        
    $view_query = $con->prepare("SELECT * FROM purchase LEFT JOIN suppliers ON purchase.supplier_id=suppliers.supplier_id WHERE purchase_id=:purchase_id");
    $view_query->execute([
        "purchase_id"=>$vid
    ]);

    $view = $view_query->fetch(PDO::FETCH_ASSOC);

    $purchase["company"] = $view["company"];
    $purchase["date"] = $view["pur_date"];
    $purchase["detail"] = $view["pur_detail"];
    $purchase["subtotal"] = $view["subtotal"];
    $purchase["dis_percent"] = $view["discount_percent"];
    $purchase["dis_amount"] = $view["discount_amount"];
    $purchase["g_total"] = $view["total"];
    $purchase["paid_amount"] = $view["paid_amount"];
    $purchase["due_amount"] = $view["due_amount"];

    echo json_encode($purchase);

    }
    if (isset($_POST["tid"])) {

        $tid = $_POST["tid"];

        $tab_query = $con->prepare("SELECT * FROM all_stock LEFT JOIN products ON all_stock.product_id=products.pro_id WHERE purchase_id=:purchase_id");
        $tab_query->execute([
            "purchase_id" => $tid
        ]);
        $tab = $tab_query->fetchAll(PDO::FETCH_ASSOC);

        $output = "";
        $no = 1;

        if ($tab) {
            $output = "<table>
                    <thead style='color: blue; background-color: lightgray;'>
                    <tr>
                        <th>No#</th>
                        <th>Product Name</th>
                        <th>Purchase Price</th>
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
                <td>{$tab["purchase_price"]}</td>
                <td>{$tab["sale_price"]}</td>
                <td>{$tab["stock_in_qty"]}</td>
                <td>{$tab["total_pur_price"]}</td>
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
                <th>Product Name</th>
                <th>Purchase Price</th>
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
    ///=====Delete purchase AJAX request=====///
    if(isset($_POST["did"])){
        // print_r($_POST);
        $did = $_POST["did"];
        $del = $con->prepare("DELETE FROM purchase WHERE purchase_id=:purchase_id");
        $del->execute([
            "purchase_id"=>$did
        ]);

        $dele = $con->prepare("DELETE FROM all_stock WHERE purchase_id=:purchase_id");
        $dele->execute([
            "purchase_id"=>$did
        ]);

        echo "deleted";


    }



    ///=================================update Purchase====================================///
    ///=========Handle update invoice AJAX request=========///
    if(isset($_POST["action"]) && $_POST["action"]=="update_invoice"){
        // print_r($_POST);
        $purchase_id = $_POST["id_purchase"];
        $sup_id = $_POST["sup_name"];
        $pur_date = $_POST["pur_date"];

        $pro_id = $_POST["pro_name"];
        $pur_price = $_POST["pur_price"];
        $sale_price = $_POST["sale_price"];
        $qty = $_POST["qty"];
        $total = $_POST["total"];

        $detail = $_POST["detail"];
        //invoice
        $sub_total = $_POST["sub_total"];
        $tax_percent = $_POST["tax_percent"];
        $tax_rupees = $_POST["tax_rupees"];
        $final_amount = $_POST["f_amount"];
        $paid_amount = $_POST["paid_amount"];
        $due_amount = $_POST["due_amount"];


    $query = $con->prepare("UPDATE purchase SET supplier_id=:supplier_id, pur_date=:pur_date, pur_detail=:pur_detail, subtotal=:subtotal, discount_percent=:discount_percent, discount_amount=:discount_amount, total=:total, paid_amount=:paid_amount, due_amount=:due_amount WHERE purchase_id=:purchase_id");
    $query->execute([
        "purchase_id"=>$purchase_id,
        "supplier_id"=>$sup_id,
        "pur_date"=>$pur_date,
        "pur_detail"=>$detail,
        "subtotal"=>$sub_total,
        "discount_percent"=>$tax_percent,
        "discount_amount"=>$tax_rupees,
        "total"=>$final_amount,
        "paid_amount"=>$paid_amount,
        "due_amount"=>$due_amount
    ]);

    if($query){

        $d_query = $con->prepare("DELETE FROM all_stock WHERE purchase_id=:purchase_id");
        $d_query->execute([
            "purchase_id"=>$purchase_id
        ]);


        for($i=0; $i < count($pro_id); $i++){

            $all_stock = $con->prepare("INSERT INTO all_stock (purchase_id, supplier_id, product_id, invoice_date, purchase_price, sale_price, total_pur_price, stock_in_qty) VALUES (:purchase_id, :supplier_id, :product_id, :invoice_date, :purchase_price, :sale_price, :total_pur_price, :stock_in_qty)");
            $all_stock->execute([
                "purchase_id"=>$purchase_id,
                "supplier_id"=>$sup_id,
                "product_id"=>$pro_id[$i],
                "invoice_date"=>$pur_date,
                "purchase_price"=>$pur_price[$i],
                "sale_price"=>$sale_price[$i],
                "total_pur_price"=>$total[$i],
                "stock_in_qty"=>$qty[$i]

            ]);
        }

        echo "purchase_updated"; 

    }else{
        echo "purchase_not_updated";
    }
    

    }


    ///==================================Purchase Return===================================///
    ///=========Handle save purchase return invoice AJAX request=========///
   
    if(isset($_POST["action"]) && $_POST["action"]=="return_invoice"){
        // print_r($_POST);
        $purchase_id = $_POST["id_purchase"];
        $supplier_id = $_POST["supp_id"];
        $pur_date = $_POST["pur_date"];
        $pur_ret_date = $_POST["ret_date"];
    
        $pro_id = $_POST["pro_id"];
        $pur_price = $_POST["pur_price"];
        $qty = $_POST["qty"];
        $total = $_POST["total"];
    
        $detail = $_POST["detail"];
        //invoice
        $sub_total = $_POST["rsub_total"];
        $ded_percent = $_POST["ded_percent"];
        $ded_rupees = $_POST["ded_rupees"];
        $final_amount = $_POST["f_amount"];
        $paid_amount = $_POST["paid_amount"];
        $due_amount = $_POST["due_amount"];
    
    
        $query = $con->prepare("INSERT INTO purchase_return (pur_id, supp_id, pur_date, pur_ret_date, ret_detail, subtotal, deduction_per, deduction_amt, grand_total, paid_amt, due_amt) VALUES(:pur_id, :supp_id, :pur_date, :pur_ret_date, :ret_detail, :subtotal, :deduction_per, :deduction_amt, :grand_total, :paid_amt, :due_amt)");
        $query->execute([
            "pur_id"=>$purchase_id,
            "supp_id"=>$supplier_id,
            "pur_date"=>$pur_date,
            "pur_ret_date"=>$pur_ret_date,
            "ret_detail"=>$detail,
            "subtotal"=>$sub_total,
            "deduction_per"=>$ded_percent,
            "deduction_amt"=>$ded_rupees,
            "grand_total"=>$final_amount,
            "paid_amt"=>$paid_amount,
            "due_amt"=>$due_amount
        ]);
        if($query){
    
            $pur_ret_id = $con->lastInsertId();
            for($i=0; $i < count($pro_id); $i++){
    
                $all_stock = $con->prepare("INSERT INTO all_stock (purchase_ret_id, supplier_id, product_id, invoice_date, purchase_price, total_pur_ret_price, stock_out_qty) VALUES (:purchase_ret_id, :supplier_id, :product_id, :invoice_date, :purchase_price, :total_pur_ret_price, :stock_out_qty)");
                $all_stock->execute([
                    // "purchase_id"=>$purchase_id,
                    "purchase_ret_id"=>$pur_ret_id,
                    "supplier_id"=>$supplier_id,
                    "product_id"=>$pro_id[$i],
                    "invoice_date"=>$pur_ret_date,
                    "purchase_price"=>$pur_price[$i],
                    "total_pur_ret_price"=>$total[$i],
                    "stock_out_qty"=>$qty[$i]
    
                ]);
            }
    
            echo "return_added"; 
    
        }else{
            echo "return_not_added";
        }
        
    
    }

    ///=================================Purchase Returns===================================///
    ///=========Handle load purchase-return data AJAX request=========///
    if(isset($_POST["return"])){

            $load = $con->prepare("SELECT * FROM purchase_return LEFT JOIN suppliers ON purchase_return.supp_id=suppliers.supplier_id");
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
                          <th>Supp Name</th>
                          <th>Subtotal</th>
                          <th>Ded%</th>
                          <th>Ded Amount</th>
                          <th>Total</th>
                          <th style='width:15%;'>Actions</th>
                          </tr>
                        </thead>
                        <tbody>";
                foreach($row as $row){            
                    $output .="<tr>
                    <td>{$no}</td>
                    <td>{$row["pur_ret_date"]}</td>
                    <td>{$row["company"]}</td>
                    <td>{$row["subtotal"]}</td>
                    <td>{$row["deduction_per"]}</td>
                    <td>{$row["deduction_amt"]}</td>
                    <td>{$row["grand_total"]}</td>
                    <td> 
                    <button class='btn btn-primary' id='view_btn' data-vid='{$row["pur_return_id"]}'><i class='fa fa-eye'></i></button>
                    <a class='btn btn-success' id='edit_btn' href='update_purchase_returns.php?pur_return_id={$row["pur_return_id"]}'><i class='fa fa-edit'></i></a>
                    <button class='btn btn-danger' id='delete_btn' data-did='{$row["pur_return_id"]}'><i class='fa fa-trash'></i></button>
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
                  <th>No.</th>
                  <th>Date</th>
                  <th>Supp Name</th>
                  <th>Subtotal</th>
                  <th>Ded%</th>
                  <th>Ded Amount</th>
                  <th>Total</th>
                  <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
                </table>";
            }
            
    }

    ///========Handle view purchase return data AJAX request==========///
    if(isset($_POST["rvid"])){

        $vid = $_POST["rvid"];
                
        $view_query = $con->prepare("SELECT * FROM purchase_return LEFT JOIN suppliers ON purchase_return.supp_id=suppliers.supplier_id WHERE pur_return_id=:pur_return_id");
        $view_query->execute([
            "pur_return_id"=>$vid
        ]);
        
        $view = $view_query->fetch(PDO::FETCH_ASSOC);

        $purchase["company"] = $view["company"];
        $purchase["date"] = $view["pur_ret_date"];
        $purchase["detail"] = $view["ret_detail"];
        $purchase["subtotal"] = $view["subtotal"];
        $purchase["dis_percent"] = $view["deduction_per"];
        $purchase["dis_amount"] = $view["deduction_amt"];
        $purchase["g_total"] = $view["grand_total"];
        $purchase["paid_amount"] = $view["paid_amt"];
        $purchase["due_amount"] = $view["due_amt"];
        
        echo json_encode($purchase);
        
    }
    if (isset($_POST["rtid"])) {

        $tid = $_POST["rtid"];

        $tab_query = $con->prepare("SELECT * FROM all_stock LEFT JOIN products ON all_stock.product_id=products.pro_id WHERE purchase_ret_id=:purchase_ret_id");
        $tab_query->execute([
            "purchase_ret_id" => $tid
        ]);
        $tab = $tab_query->fetchAll(PDO::FETCH_ASSOC);

        $output = "";
        $no = 1;

        if ($tab) {
            $output = "<table>
                    <thead style='color: blue; background-color: lightgray;'>
                    <tr>
                        <th>No#</th>
                        <th>Product Name</th>
                        <th>Purchase Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>";
            foreach ($tab as $tab) {
                $output .= "<tr>
                <td>{$no}</td>
                <td>{$tab["pro_name"]}</td>
                <td>{$tab["purchase_price"]}</td>
                <td>{$tab["stock_out_qty"]}</td>
                <td>{$tab["total_pur_ret_price"]}</td>
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
                <th>Product Name</th>
                <th>Purchase Price</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            </table>";
        }


    }

    ///=====Delete purchase AJAX request=====///
    if(isset($_POST["rdid"])){
            // print_r($_POST);
            $did = $_POST["rdid"];
            $del = $con->prepare("DELETE FROM purchase_return WHERE pur_return_id=:pur_return_id");
            $del->execute([
                "pur_return_id"=>$did
            ]);
    
            $dele = $con->prepare("DELETE FROM all_stock WHERE purchase_ret_id=:purchase_ret_id");
            $dele->execute([
                "purchase_ret_id"=>$did
            ]);
    
            echo "deleted";
    
    
    }

    ///==============================update Purchase returns===============================///

    ///=========Handle update pur ret invoice AJAX request=========///
    if(isset($_POST["action"]) && $_POST["action"]=="up_return_invoice"){
        // print_r($_POST);
        $return_id = $_POST["id_purchase_ret"];
        $purchase_id = $_POST["id_purchase"];
        $supplier_id = $_POST["supp_id"];
        $purchase_date = $_POST["pur_date"];
        $return_date = $_POST["ret_date"];
    
        $product_id = $_POST["pro_id"];
        $purchase_price = $_POST["pur_price"];
        $qty = $_POST["qty"];
        $total = $_POST["total"];
    
        $detail = $_POST["detail"];
          //invoice
        $sub_total = $_POST["rsub_total"];
        $ded_percent = $_POST["ded_percent"];
        $ded_rupees = $_POST["ded_rupees"];
        $g_total = $_POST["f_amount"];
        $paid_amount = $_POST["paid_amount"];
        $due_amount = $_POST["due_amount"];
    
    
        $query = $con->prepare("UPDATE purchase_return SET pur_id=:pur_id, supp_id=:supp_id, pur_date=:pur_date, pur_ret_date=:pur_ret_date, ret_detail=:ret_detail, subtotal=:subtotal, deduction_per=:deduction_per, deduction_amt=:deduction_amt, grand_total=:grand_total, paid_amt=:paid_amt, due_amt=:due_amt WHERE pur_return_id=:pur_return_id");
        $query->execute([
            "pur_return_id"=>$return_id,
            "pur_id"=>$purchase_id,
            "supp_id"=>$supplier_id,
            "pur_date"=>$purchase_date,
            "pur_ret_date"=>$return_date,
            "ret_detail"=>$detail,
            "subtotal"=>$sub_total,
            "deduction_per"=>$ded_percent,
            "deduction_amt"=>$ded_rupees,
            "grand_total"=>$g_total,
            "paid_amt"=>$paid_amount,
            "due_amt"=>$due_amount
        ]);
    
        if($query){
    
            $d_query = $con->prepare("DELETE FROM all_stock WHERE purchase_ret_id=:purchase_ret_id");
            $d_query->execute([
                "purchase_ret_id"=>$return_id
            ]);
    
    
            for($i=0; $i < count($product_id); $i++){
    
                $all_stock = $con->prepare("INSERT INTO all_stock (purchase_ret_id, supplier_id, product_id, invoice_date, purchase_price, total_pur_ret_price, stock_out_qty) VALUES (:purchase_ret_id, :supplier_id, :product_id, :invoice_date, :purchase_price, :total_pur_ret_price, :stock_out_qty)");
                $all_stock->execute([
                    "purchase_ret_id"=>$return_id,
                    "supplier_id"=>$supplier_id,
                    "product_id"=>$product_id[$i],
                    "invoice_date"=>$return_date,
                    "purchase_price"=>$purchase_price[$i],
                    "total_pur_ret_price"=>$total[$i],
                    "stock_out_qty"=>$qty[$i]
    
                ]);
            }
    
            echo "return_updated"; 
    
        }else{
            echo "return_not_updated";
        }
        
    
    }


?>  