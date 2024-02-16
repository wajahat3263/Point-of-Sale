<?php
    ///include database connection///
    require_once "config.php";
    ///========================================Sale=====================================///
    ///===========Handle Get product data Ajax Request=========///
    if(isset($_POST["product_id"])){
        // print_r ($_POST);
        $product_id = $_POST["product_id"];

        $query = $con->prepare("SELECT * FROM products WHERE pro_id=:pro_id");
        $query->execute([
            "pro_id"=>$product_id
        ]);
        $data = $query->fetch(PDO::FETCH_ASSOC);

        $product_data["pro_name"] = $data["pro_name"];
        $product_data["pro_sale_price"] = $data["pro_sale_price"];
        $product_data["pro_id"] = $data["pro_id"];

        $query1 = $con->prepare("SELECT SUM(stock_in_qty-stock_out_qty) FROM all_stock WHERE product_id=:product_id");
        $query1->execute([
            "product_id"=>$product_id
        ]);
        $datas = $query1->fetch(PDO::FETCH_ASSOC);
        $product_data["old_stock"] = $datas["SUM(stock_in_qty-stock_out_qty)"];
        echo json_encode($product_data);


    }

    if(isset($_POST["bar_code"])){
        // print_r ($_POST);
        $bar_code = $_POST["bar_code"];

        $query = $con->prepare("SELECT * FROM products WHERE pro_barcode=:pro_barcode");
        $query->execute([
            "pro_barcode"=>$bar_code
        ]);
        $data = $query->fetch(PDO::FETCH_ASSOC);

        $product_data["pro_name"] = $data["pro_name"];
        $product_data["pro_sale_price"] = $data["pro_sale_price"];
        $product_data["pro_id"] = $data["pro_id"];

        $query1 = $con->prepare("SELECT SUM(stock_in_qty-stock_out_qty) FROM all_stock WHERE product_id=:product_id");
        $query1->execute([
            "product_id"=>$product_data["pro_id"]
        ]);
        $datas = $query1->fetch(PDO::FETCH_ASSOC);
        $product_data["old_stock"] = $datas["SUM(stock_in_qty-stock_out_qty)"];
        echo json_encode($product_data);


    }

    ///=========Handle save invoice AJAX request=========///
    if(isset($_POST["action"]) && $_POST["action"]=="save_invoice"){
            // print_r($_POST);

            $sale_date = $_POST["sale_date"];
    
            $pro_id = $_POST["pro_id"];
            $sale_price = $_POST["sale_price"];
            $qty = $_POST["qty"];
            $dis_per = $_POST["dis_per"];
            $dis_amt = $_POST["dis_amt"];
            $total = $_POST["total"];


            $cus_id = $_POST["cus_name"];
            $detail = $_POST["detail"];
            //invoice
            $sub_total = $_POST["sub_total"];
            $tax_percent = $_POST["tax_percent"];
            $tax_rupees = $_POST["tax_rupees"];
            $final_amount = $_POST["f_amount"];
            $paid_amount = $_POST["paid_amount"];
            $due_amount = $_POST["due_amount"];
    
    
        $query = $con->prepare("INSERT INTO sale (cust_id, sale_date, sale_detail, subtotal, dis_percent, dis_amount, total, paid_amount, due_amount) VALUES(:cust_id, :sale_date, :sale_detail, :subtotal, :dis_percent, :dis_amount, :total, :paid_amount, :due_amount)");
        $query->execute([
            "cust_id"=>$cus_id,
            "sale_date"=>$sale_date,
            "sale_detail"=>$detail,
            "subtotal"=>$sub_total,
            "dis_percent"=>$tax_percent,
            "dis_amount"=>$tax_rupees,
            "total"=>$final_amount,
            "paid_amount"=>$paid_amount,
            "due_amount"=>$due_amount
        ]);
        if($query){
    
            $sale_id = $con->lastInsertId();
            for($i=0; $i < count($pro_id); $i++){
    
                $all_stock = $con->prepare("INSERT INTO all_stock (sale_id, customer_id, product_id, invoice_date, sale_price, total_sale_price, stock_out_qty, dis_per, dis_amt) VALUES (:sale_id, :customer_id, :product_id, :invoice_date, :sale_price, :total_sale_price, :stock_out_qty, :dis_per, :dis_amt)");
                $all_stock->execute([
                    "sale_id"=>$sale_id,
                    "customer_id"=>$cus_id,
                    "product_id"=>$pro_id[$i],
                    "invoice_date"=>$sale_date,
                    "sale_price"=>$sale_price[$i],
                    "total_sale_price"=>$total[$i],
                    "stock_out_qty"=>$qty[$i],
                    "dis_per"=>$dis_per[$i],
                    "dis_amt"=>$dis_amt[$i]
    
                ]);
            }
    
            echo "sale_added"; 
    
        }else{
            echo "sale_not_added";
        }
        
    
    }

    ///========================================All Sales==================================///
    ///=========Handle load sale data AJAX request=========///
    if(isset($_POST["load"])){

        $load = $con->prepare("SELECT * FROM sale LEFT JOIN customers ON sale.cust_id=customers.customer_id");
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
                      <th>Customer</th>
                      <th>Subtotal</th>
                      <th>Dis%</th>
                      <th>Dis Amount</th>
                      <th>Total</th>
                      <th style='width:17%;'>Actions</th>
                      </tr>
                    </thead>
                    <tbody>";
            foreach($row as $row){            
                $output .="<tr>
                <td>{$no}</td>
                <td>{$row["sale_date"]}</td>
                <td>{$row["name"]}</td>
                <td>{$row["subtotal"]}</td>
                <td>{$row["dis_percent"]}</td>
                <td>{$row["dis_amount"]}</td>
                <td>{$row["total"]}</td>
                <td> 
                <button class='btn btn-primary' id='view_btn' data-vid='{$row["sale_id"]}'><i class='fa fa-eye'></i></button>
                <a class='btn btn-success' id='edit_btn' href='update_sale.php?sale_id={$row["sale_id"]}'><i class='fa fa-edit'></i></a>
                <a class='btn btn-warning' id='edit_btn' href='sale_return.php?sale_id={$row["sale_id"]}'><i class='fa fa-undo'></i></a>
                <button class='btn btn-danger' id='delete_btn' data-did='{$row["sale_id"]}'><i class='fa fa-trash'></i></button>
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
              <th>Customer</th>
              <th>Subtotal</th>
              <th>Dis%</th>
              <th>Dis Amount</th>
              <th>Total</th>
              <th>Actions</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
            </table>";
        }
        
    }

    ///========Handle view sale data AJAX request==========///
    if(isset($_POST["vid"])){

            $vid = $_POST["vid"];
                
            $view_query = $con->prepare("SELECT * FROM sale LEFT JOIN customers ON sale.cust_id=customers.customer_id WHERE sale_id=:sale_id");
            $view_query->execute([
                "sale_id"=>$vid
            ]);
        
            $view = $view_query->fetch(PDO::FETCH_ASSOC);
        
            $purchase["company"] = $view["name"];
            $purchase["date"] = $view["sale_date"];
            $purchase["detail"] = $view["sale_detail"];
            $purchase["subtotal"] = $view["subtotal"];
            $purchase["dis_percent"] = $view["dis_percent"];
            $purchase["dis_amount"] = $view["dis_amount"];
            $purchase["g_total"] = $view["total"];
            $purchase["paid_amount"] = $view["paid_amount"];
            $purchase["due_amount"] = $view["due_amount"];
        
            echo json_encode($purchase);
        
    }
    if (isset($_POST["tid"])) {

        $tid = $_POST["tid"];

        $tab_query = $con->prepare("SELECT * FROM all_stock LEFT JOIN products ON all_stock.product_id=products.pro_id WHERE sale_id=:sale_id");
        $tab_query->execute([
            "sale_id" => $tid
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
                        <th>Sale Price</th>
                        <th>Qty</th>
                        <th>Dis %</th>
                        <th>Dis Amt</th>
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
                <td>{$tab["dis_per"]}</td>
                <td>{$tab["dis_amt"]}</td>
                <td>{$tab["total_sale_price"]}</td>
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
                <th>Sale Price</th>
                <th>Qty</th>
                <th>Dis %</th>
                <th>Dis Amt</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            </table>";
        }


    }

    ///=====Delete sale AJAX request=====///
    if(isset($_POST["did"])){
            // print_r($_POST);
            $did = $_POST["did"];
            $del = $con->prepare("DELETE FROM sale WHERE sale_id=:sale_id");
            $del->execute([
                "sale_id"=>$did
            ]);
    
            $dele = $con->prepare("DELETE FROM all_stock WHERE sale_id=:sale_id");
            $dele->execute([
                "sale_id"=>$did
            ]);
    
            echo "deleted";
    
    
    }


    ///====================================update sale======================================///
    ///=========Handle update invoice AJAX request=========///
    if(isset($_POST["action"]) && $_POST["action"]=="update_invoice"){
        // print_r($_POST);
        $sale_id = $_POST["id_sale"];
        $cus_id = $_POST["cus_name"];
        $sale_date = $_POST["sale_date"];

        $pro_id = $_POST["pro_id"];
        $sale_price = $_POST["sale_price"];
        $qty = $_POST["qty"];
        $dis_per = $_POST["dis_per"];
        $dis_amt = $_POST["dis_amt"];
        $total = $_POST["total"];

        $detail = $_POST["detail"];
        //invoice
        $sub_total = $_POST["sub_total"];
        $tax_percent = $_POST["tax_percent"];
        $tax_rupees = $_POST["tax_rupees"];
        $final_amount = $_POST["f_amount"];
        $paid_amount = $_POST["paid_amount"];
        $due_amount = $_POST["due_amount"];


    $query = $con->prepare("UPDATE sale SET cust_id=:cust_id, sale_date=:sale_date, sale_detail=:sale_detail, subtotal=:subtotal, dis_percent=:dis_percent, dis_amount=:dis_amount, total=:total, paid_amount=:paid_amount, due_amount=:due_amount WHERE sale_id=:sale_id");
    $query->execute([
        "sale_id"=>$sale_id,
        "cust_id"=>$cus_id,
        "sale_date"=>$sale_date,
        "sale_detail"=>$detail,
        "subtotal"=>$sub_total,
        "dis_percent"=>$tax_percent,
        "dis_amount"=>$tax_rupees,
        "total"=>$final_amount,
        "paid_amount"=>$paid_amount,
        "due_amount"=>$due_amount
    ]);

    if($query){

        $d_query = $con->prepare("DELETE FROM all_stock WHERE sale_id=:sale_id");
        $d_query->execute([
            "sale_id"=>$sale_id
        ]);


        for($i=0; $i < count($pro_id); $i++){

            $all_stock = $con->prepare("INSERT INTO all_stock (sale_id, customer_id, product_id, invoice_date, sale_price, total_sale_price, stock_out_qty, dis_per, dis_amt) VALUES (:sale_id, :customer_id, :product_id, :invoice_date, :sale_price, :total_sale_price, :stock_out_qty, :dis_per, :dis_amt)");
            $all_stock->execute([
                "sale_id"=>$sale_id,
                "customer_id"=>$cus_id,
                "product_id"=>$pro_id[$i],
                "invoice_date"=>$sale_date,
                "sale_price"=>$sale_price[$i],
                "total_sale_price"=>$total[$i],
                "stock_out_qty"=>$qty[$i],
                "dis_per"=>$dis_per[$i],
                "dis_amt"=>$dis_amt[$i]            

            ]);
        }

        echo "sale_updated"; 

    }else{
        echo "sale_not_updated";
    }
    

    }


    ///====================================return sale======================================///
    ///=========Handle save Return invoice AJAX request=========///
    if(isset($_POST["action"]) && $_POST["action"]=="return_invoice"){
            // print_r($_POST);

        $sale_id = $_POST["sale_id"];
        $customer_id = $_POST["cust_id"];
        $sale_date = $_POST["sale_date"];
        $return_date = $_POST["ret_date"];
    
        $pro_id = $_POST["pro_id"];
        $sale_price = $_POST["sale_price"];
        $qty = $_POST["qty"];
        $dis_per = $_POST["dis_per"];
        $dis_amt = $_POST["dis_amt"];
        $total = $_POST["total"];

        $detail = $_POST["detail"];
            //invoice
        $sub_total = $_POST["rsub_total"];
        $ded_percent = $_POST["ded_percent"];
        $ded_rupees = $_POST["ded_rupees"];
        $g_total = $_POST["f_amount"];
        $paid_amount = $_POST["paid_amount"];
        $due_amount = $_POST["due_amount"];
    
    
        $query = $con->prepare("INSERT INTO sale_return (sale_id, cust_id, sale_date, sale_ret_date, ret_detail, subtotal, ded_per, ded_amt, g_total, paid_amt, due_amt) VALUES(:sale_id, :cust_id, :sale_date, :sale_ret_date, :ret_detail, :subtotal, :ded_per, :ded_amt, :g_total, :paid_amt, :due_amt)");
        $query->execute([
            "sale_id"=>$sale_id,
            "cust_id"=>$customer_id,
            "sale_date"=>$sale_date,
            "sale_ret_date"=>$return_date,
            "ret_detail"=>$detail,
            "subtotal"=>$sub_total,
            "ded_per"=>$ded_percent,
            "ded_amt"=>$ded_rupees,
            "g_total"=>$g_total,
            "paid_amt"=>$paid_amount,
            "due_amt"=>$due_amount
        ]);
        if($query){
    
            $sale_ret_id = $con->lastInsertId();
            for($i=0; $i < count($pro_id); $i++){
    
                $all_stock = $con->prepare("INSERT INTO all_stock (sale_ret_id, customer_id, product_id, invoice_date, sale_price, total_sale_ret_price, stock_in_qty, dis_per, dis_amt) VALUES (:sale_ret_id, :customer_id, :product_id, :invoice_date, :sale_price, :total_sale_ret_price, :stock_in_qty, :dis_per, :dis_amt)");
                $all_stock->execute([
                    "sale_ret_id"=>$sale_ret_id,
                    "customer_id"=>$customer_id,
                    "product_id"=>$pro_id[$i],
                    "invoice_date"=>$return_date,
                    "sale_price"=>$sale_price[$i],
                    "total_sale_ret_price"=>$total[$i],
                    "stock_in_qty"=>$qty[$i],
                    "dis_per"=>$dis_per[$i],
                    "dis_amt"=>$dis_amt[$i]
    
                ]);
            }
    
            echo "return_added"; 
    
        }else{
            echo "return_not_added";
        }
        
    
    }

    ///========================================All Sale Return==================================///
    ///=========Handle load sale return data AJAX request=========///
    if(isset($_POST["return"])){

        $load = $con->prepare("SELECT * FROM sale_return LEFT JOIN customers ON sale_return.cust_id=customers.customer_id");
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
                      <th>Customer</th>
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
                <td>{$row["sale_ret_date"]}</td>
                <td>{$row["name"]}</td>
                <td>{$row["subtotal"]}</td>
                <td>{$row["ded_per"]}</td>
                <td>{$row["ded_amt"]}</td>
                <td>{$row["g_total"]}</td>
                <td> 
                <button class='btn btn-primary' id='view_btn' data-vid='{$row["sale_return_id"]}'><i class='fa fa-eye'></i></button>
                <a class='btn btn-success' id='edit_btn' href='update_sale_returns.php?sale_ret_id={$row["sale_return_id"]}'><i class='fa fa-edit'></i></a>
                <button class='btn btn-danger' id='delete_btn' data-did='{$row["sale_return_id"]}'><i class='fa fa-trash'></i></button>
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
              <th>Customer</th>
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

    ///========Handle view sale return data AJAX request==========///
    if(isset($_POST["rvid"])){

        $vid = $_POST["rvid"];
                
        $view_query = $con->prepare("SELECT * FROM sale_return LEFT JOIN customers ON sale_return.cust_id=customers.customer_id WHERE sale_return_id=:sale_return_id");
        $view_query->execute([
            "sale_return_id"=>$vid
        ]);
        
        $view = $view_query->fetch(PDO::FETCH_ASSOC);
        
        $purchase["company"] = $view["name"];
        $purchase["date"] = $view["sale_ret_date"];
        $purchase["detail"] = $view["ret_detail"];
        $purchase["subtotal"] = $view["subtotal"];
        $purchase["dis_percent"] = $view["ded_per"];
        $purchase["dis_amount"] = $view["ded_amt"];
        $purchase["g_total"] = $view["g_total"];
        $purchase["paid_amount"] = $view["paid_amt"];
        $purchase["due_amount"] = $view["due_amt"];
        
        echo json_encode($purchase);
        
    }
    if (isset($_POST["rtid"])) {

        $tid = $_POST["rtid"];

        $tab_query = $con->prepare("SELECT * FROM all_stock LEFT JOIN products ON all_stock.product_id=products.pro_id WHERE sale_ret_id=:sale_ret_id");
        $tab_query->execute([
            "sale_ret_id" => $tid
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
                        <th>Sale Price</th>
                        <th>Qty</th>
                        <th>Dis %</th>
                        <th>Dis Amt</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>";
            foreach ($tab as $tab) {
                $output .= "<tr>
                <td>{$no}</td>
                <td>{$tab["pro_name"]}</td>
                <td>{$tab["sale_price"]}</td>
                <td>{$tab["stock_in_qty"]}</td>
                <td>{$tab["dis_per"]}</td>
                <td>{$tab["dis_amt"]}</td>
                <td>{$tab["total_sale_ret_price"]}</td>
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
                <th>Sale Price</th>
                <th>Qty</th>
                <th>Dis %</th>
                <th>Dis Amt</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            </table>";
        }


    }

    ///=====Delete sale AJAX request=====///
    if(isset($_POST["rdid"])){
            // print_r($_POST);
            $did = $_POST["rdid"];
            $del = $con->prepare("DELETE FROM sale_return WHERE sale_return_id=:sale_return_id");
            $del->execute([
                "sale_return_id"=>$did
            ]);
    
            $dele = $con->prepare("DELETE FROM all_stock WHERE sale_ret_id=:sale_ret_id");
            $dele->execute([
                "sale_ret_id"=>$did
            ]);
    
            echo "deleted";
    
    
    }

    ///====================================update sale return======================================///
    ///=========Handle update sale return AJAX request=========///
    if(isset($_POST["action"]) && $_POST["action"]=="update_return_invoice"){
        // print_r($_POST);
    $sale_ret_id = $_POST["sale_ret_id"];
    $sale_id = $_POST["sale_id"];
    $cus_id = $_POST["cust_id"];
    $sale_date = $_POST["sale_date"];
    $sale_ret_date = $_POST["ret_date"];

    $pro_id = $_POST["pro_id"];
    $sale_price = $_POST["sale_price"];
    $qty = $_POST["qty"];
    $dis_per = $_POST["dis_per"];
    $dis_amt = $_POST["dis_amt"];
    $total = $_POST["total"];

    $detail = $_POST["detail"];
        //invoice
    $sub_total = $_POST["rsub_total"];
    $ded_percent = $_POST["ded_percent"];
    $ded_rupees = $_POST["ded_rupees"];
    $g_total = $_POST["f_amount"];
    $paid_amount = $_POST["paid_amount"];
    $due_amount = $_POST["due_amount"];


    $query = $con->prepare("UPDATE sale_return SET sale_id=:sale_id, cust_id=:cust_id, sale_date=:sale_date, sale_ret_date=:sale_ret_date, ret_detail=:ret_detail, subtotal=:subtotal, ded_per=:ded_per, ded_amt=:ded_amt, g_total=:g_total, paid_amt=:paid_amt, due_amt=:due_amt WHERE sale_return_id=:sale_return_id");
    $query->execute([
        "sale_return_id"=>$sale_ret_id,
        "sale_id"=>$sale_id,
        "cust_id"=>$cus_id,
        "sale_date"=>$sale_date,
        "sale_ret_date"=>$sale_ret_date,
        "ret_detail"=>$detail,
        "subtotal"=>$sub_total,
        "ded_per"=>$ded_percent,
        "ded_amt"=>$ded_rupees,
        "g_total"=>$g_total,
        "paid_amt"=>$paid_amount,
        "due_amt"=>$due_amount
    ]);

    if($query){

        $d_query = $con->prepare("DELETE FROM all_stock WHERE sale_ret_id=:sale_ret_id");
        $d_query->execute([
            "sale_ret_id"=>$sale_ret_id
        ]);


        for($i=0; $i < count($pro_id); $i++){

            $all_stock = $con->prepare("INSERT INTO all_stock (sale_ret_id, customer_id, product_id, invoice_date, sale_price, total_sale_ret_price, stock_in_qty, dis_per, dis_amt) VALUES (:sale_ret_id, :customer_id, :product_id, :invoice_date, :sale_price, :total_sale_ret_price, :stock_in_qty, :dis_per, :dis_amt)");
            $all_stock->execute([
                "sale_ret_id"=>$sale_ret_id,
                "customer_id"=>$cus_id,
                "product_id"=>$pro_id[$i],
                "invoice_date"=>$sale_ret_date,
                "sale_price"=>$sale_price[$i],
                "total_sale_ret_price"=>$total[$i],
                "stock_in_qty"=>$qty[$i],
                "dis_per"=>$dis_per[$i],
                "dis_amt"=>$dis_amt[$i]            

            ]);
        }

        echo "return_updated"; 

    }else{
        echo "return_not_updated";
    }
    

    }


?>