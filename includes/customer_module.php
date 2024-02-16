<?php include_once "config.php";


///handle insert customer ajax request///
if (isset($_POST["action"]) && $_POST["action"] == "insert_customer") {

    $c_name = check_inputs($_POST["name"]);
    $c_email = check_inputs($_POST["email"]);
    $c_phone = check_inputs($_POST["phone"]);
    $c_address = check_inputs($_POST["address"]);

    $check_email = c_email_exist($c_email);
    if ($check_email == null) {

        //query to send data in database//
        $query = $con->prepare("INSERT INTO customers (name,phone,email,address) VALUES (:name,:phone,:email,:address)");
        $query->execute([
            ":name" => $c_name,
            ":phone" => $c_phone,
            ":email" => $c_email,
            ":address" => $c_address
        ]);

        if ($query) {
            echo "inserted";
        } else {
            echo "not_inserted";
        }
    } else {
        echo "Email_already_exist";
    }




}

///Handle load customer ajax request///
if (isset($_POST["load"])) {
    $query = $con->prepare("SELECT * FROM customers");
    $query->execute();
    $row = $query->fetchAll(PDO::FETCH_ASSOC);

    $no = 1;

    $output = "<table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>";
    foreach ($row as $row) {

        $output .= "<tr>
                        <td>{$no}</td>
                        <td>{$row["name"]}</td>
                        <td>{$row["phone"]}</td>
                        <td>{$row["email"]}</td>
                        <td>{$row["address"]}</td>
                        <td>
                        <button class='btn btn-success' id='update_btn' data-uid='{$row["customer_id"]}'> <i class='fa fa-edit'></i> </button>
                        <button class='btn btn-danger' id='delete_btn' data-did='{$row["customer_id"]}'> <i class='fa fa-trash'></i> </button>
                        </td>
                    </tr>";
        $no++;
    }

    $output .= "</tbody></table>";

    echo $output;
}


///Handle fetch customer-data for update ajax request///
if (isset($_POST["cid"])) {

    $u_id = $_POST["cid"];

    $query = $con->prepare("SELECT * FROM customers WHERE customer_id=:customer_id");
    $query->execute([
        "customer_id" => $u_id
    ]);
    $row = $query->fetch(PDO::FETCH_ASSOC);

    $customer_data["c_id"] = $row["customer_id"];
    $customer_data["c_name"] = $row["name"];
    $customer_data["c_phone"] = $row["phone"];
    $customer_data["c_email"] = $row["email"];
    $customer_data["c_address"] = $row["address"];

    echo json_encode($customer_data);
}


///Handle Update customer ajax request///
if (isset($_POST["action"]) && $_POST["action"] == "update_customer") {
    // print_r ($_POST);

    $updated_id = check_inputs($_POST["update"]);
    $updated_name = check_inputs($_POST["u_name"]);
    $updated_phone = check_inputs($_POST["u_phone"]);
    $updated_email = check_inputs($_POST["u_email"]);
    $updated_address = check_inputs($_POST["u_address"]);

    $check_u_email = cu_email_exist($updated_email, $updated_id);

    if ($check_u_email == null) {

        $query = $con->prepare("UPDATE customers SET  name=:name, phone=:phone, email=:email, address=:address Where customer_id=:customer_id");

        $query->execute([
            "customer_id" => $updated_id,
            "name" => $updated_name,
            "phone" => $updated_phone,
            "email" => $updated_email,
            "address" => $updated_address
        ]);

        if ($query) {
            echo "updated";
        } else {
            echo "not_updated";
        }


    } else {
        echo "email_exist";
    }




}


///Handl delete customer ajax request///
if (isset($_POST["delete"])) {
    // print_r($_POST);
    $delete_id = $_POST["delete"];
    $query = $con->prepare("DELETE FROM customers WHERE customer_id=:customer_id");
    $query->execute([
        "customer_id" => $delete_id
    ]);

    if ($query) {
        echo "deleted";
    } else {
        echo "not_deleted";
    }

}









?>