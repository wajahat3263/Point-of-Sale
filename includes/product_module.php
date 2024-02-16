<?php
///include database connection///
require_once "config.php";


/////==========================================\Products MODULE/=======================================/////
///================\Handle Insert Product AJAX Request/================///
if (isset($_POST["action"]) && $_POST["action"] == "insert_user") {
    ///check data in arrey in console///
    // print_r ($_POST);

    $pro_name = check_inputs($_POST["pro_name"]);
    $pro_catagory = check_inputs($_POST["pro_catagory"]);
    $serial = check_inputs($_POST["serial"]);
    $bar_code = check_inputs($_POST["bar_code"]);
    $purchase = check_inputs($_POST["purchase"]);
    $sale_price = check_inputs($_POST["sale_price"]);
    $detail = check_inputs($_POST["detail"]);
    //Name of image//
    $image_name = $_FILES["pro_photo"]["name"];
    //Path of image where saved//
    $image_path = $_FILES["pro_photo"]["tmp_name"];


    if (strlen($image_name) > 4) {

        $new_name = save_product_image($image_name, $image_path);

        // query to send data in database //
        $sql_query = $con->prepare("INSERT INTO products (pro_name, pro_catagory, pro_serial, pro_barcode, pro_purchase_price, pro_sale_price, pro_detail, pro_photo) VALUES (:pro_name, :pro_catagory, :pro_serial, :pro_barcode, :pro_purchase_price, :pro_sale_price, :pro_detail, :pro_photo)");
        // Query execution
        $sql_query->execute([
            "pro_name" => $pro_name,
            "pro_catagory" => $pro_catagory,
            "pro_serial" => $serial,
            "pro_barcode" => $bar_code,
            "pro_purchase_price" => $purchase,
            "pro_sale_price" => $sale_price,
            "pro_detail" => $detail,
            "pro_photo" => $new_name

        ]);




    } else {
        $sql_query = $con->prepare("INSERT INTO products (pro_name, pro_catagory, pro_serial, pro_barcode, pro_purchase_price, pro_sale_price, pro_detail) VALUES (:pro_name, :pro_catagory, :pro_serial, :pro_barcode, :pro_purchase_price, :pro_sale_price, :pro_detail)");
        // Query execution
        $sql_query->execute([
            "pro_name" => $pro_name,
            "pro_catagory" => $pro_catagory,
            "pro_serial" => $serial,
            "pro_barcode" => $bar_code,
            "pro_purchase_price" => $purchase,
            "pro_sale_price" => $sale_price,
            "pro_detail" => $detail

        ]);
    }


    if ($sql_query) {
        echo "inserted";
    } else {
        echo "not_inserted";
    }




}

///================= \Handle Load Product AJAX Request/ ================///
if(isset($_POST["loaduser"])){
    $sql_query = $con->prepare("SELECT * FROM products");
	$sql_query->execute();
	$row=$sql_query->fetchAll(PDO::FETCH_ASSOC);

    $output = "";
    $rowno = 1;

    if($row){
        $output = "<table>
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Prod. Name</th>
                    <th>Prod. Catagory</th>
                    <th>Prod. Serial</th>
                    <th>Bar Code</th>
                    <th>Pur. Price</th>
                    <th>Sal. Price</th>
                    <th>Detail</th>
                    <th>Photo</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>";
        foreach($row as $row){

            if (!empty($row["pro_photo"])) {
                $path = "uploads/product_images/" . $row["pro_photo"];
            } else {
                $path = "uploads/kukar.jpg";
            }
            
            
            $output .="<tr>
            <td>{$rowno}</td>
            <td>{$row["pro_name"]}</td>
            <td>{$row["pro_catagory"]}</td>
            <td>{$row["pro_serial"]}</td>
            <td>{$row["pro_barcode"]}</td>
            <td>{$row["pro_purchase_price"]}</td>
            <td>{$row["pro_sale_price"]}</td>
            <td>{$row["pro_detail"]}</td>
            <td><img src='{$path}' height='50' width='50'></td>
            <td> 
            <button class='btn btn-success' id='edit_btn' data-uid='{$row["pro_id"]}'><i class='fa fa-edit'></i></button>
            <button class='btn btn-danger' id='delete_btn' data-did='{$row["pro_id"]}'><i class='fa fa-trash'></i></button> 
            </td>
            </tr> ";
            $rowno++;
        }
        $output .= "</tbody></table>";
        echo $output;
    }else{
        echo "<table>
        <thead>
          <tr>
            <th>No.</th>
            <th>Product Name</th>
            <th>Product Catagory</th>
            <th>Product Serial</th>
            <th>Bar Code</th>
            <th>Purchase Price</th>
            <th>Sale Price</th>
            <th>Detail</th>
            <th>Photo</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
        </table>";

    }

    
}

///======== \Handle Fetch Product Data For Update AJAX Request/ ========///
if(isset($_POST["uid"])){

    $up_id = $_POST["uid"];

    $sql_query = $con->prepare("SELECT * FROM products WHERE pro_id = :pro_id");
	$sql_query->execute(["pro_id" => $up_id]);
	$row = $sql_query->fetch(PDO::FETCH_ASSOC);

    $user_data["uid"] = $row["pro_id"];
    $user_data["pro_name"] = $row["pro_name"];
    $user_data["pro_catagory"] = $row["pro_catagory"];
    $user_data["pro_purchase_price"] = $row["pro_purchase_price"];
    $user_data["pro_sale_price"] = $row["pro_sale_price"];

    echo json_encode($user_data);
}

///=============== \Handle Update Product AJAX Request/ ===============///
if (isset($_POST["action"]) && $_POST["action"] == "update_user") {
    ///check data in arrey in console///
    // print_r ($_POST);
    $product_id = check_inputs($_POST["uuid"]);
    $u_pro_name = check_inputs($_POST["u_pro_name"]);
    $u_catagory = check_inputs($_POST["u_catagory"]);
    $u_purchase = check_inputs($_POST["u_purchase"]);
    $u_sale = check_inputs($_POST["u_sale"]);

    

        // query to send data in database //
        $sql_query = $con->prepare("UPDATE products SET pro_name = :pro_name, pro_catagory = :pro_catagory, pro_purchase_price = :pro_purchase_price, pro_sale_price = :pro_sale_price WHERE pro_id = :pro_id");
        // Query execution
        $sql_query->execute([

            "pro_id" => $product_id,
            "pro_name" => $u_pro_name,
            "pro_catagory" => $u_catagory,
            "pro_purchase_price" => $u_purchase,
            "pro_sale_price" => $u_sale

        ]);


        if ($sql_query) {
            echo "updated";
        } else {
            echo "not_updated";
        }




}

///================ \Handle Delete Product AJAX Request/ ==============///
if(isset($_POST["DeleteId"])){

    $delele_id = $_POST["DeleteId"];

    $sql_quer = $con->prepare("SELECT * FROM products WHERE pro_id = :pro_id");
	$sql_quer->execute(["pro_id" => $delele_id]);
    $name=$sql_quer->fetch(PDO::FETCH_ASSOC);
    $nam=$name["pro_photo"];

    $sql_query = $con->prepare("DELETE FROM products WHERE pro_id = :pro_id");
	$sql_query->execute(["pro_id" => $delele_id]);
    
    if($sql_query){
        if (is_file("../uploads/product_images/".$nam)) {
            unlink("../uploads/product_images/".$nam);
        }
        echo "deleted";
    }else{
        echo "not_deleted";
    }
}







///image
function save_product_image($image_name,$image_path){
	global $con;
	$without_extension = pathinfo($image_name, PATHINFO_FILENAME);

    $extension = pathinfo($image_name, PATHINFO_EXTENSION);

    $new_name = $without_extension . rand(100000, 999999) . time() . "." . $extension;

    $path = "../uploads/product_images/" . $new_name;

    move_uploaded_file($image_path, $path);

	return $new_name;


}


?>