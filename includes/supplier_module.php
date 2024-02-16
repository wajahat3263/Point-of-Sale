<?php include_once "config.php";


///handle insert supp ajax request///
if (isset($_POST["action"]) && $_POST["action"] == "insert_supplier") {

    $c_company = check_inputs($_POST["name"]);
    $c_phone = check_inputs($_POST["phone"]);
    $c_email = check_inputs($_POST["email"]);
    $c_address = check_inputs($_POST["address"]);
    $c_website = check_inputs($_POST["website"]);

    $s_name = check_inputs($_POST["cname"]);
    $s_designation = check_inputs($_POST["designation"]);
    $s_phone = check_inputs($_POST["cphone"]);
    $s_email = check_inputs($_POST["cemail"]);


    $check_email = x_email_exist($c_email);
    $check_semail = x_email_exist($s_email);

    //ledger
    $trn_date=date("y-m-d");
    $trn_detail="Opening Balance";
    $trn_type=1;
    $paid=0;
    $received=0;


    if ($check_email == null && $check_semail==null) {

        if ($c_email==$s_email && $c_email!=null && $s_email!=null) {

            echo "same_both_emails";

            
        } else {
            //query to send data in database//
            $query = $con->prepare("INSERT INTO suppliers (company,phone,email,address,website, c_name,c_designation,c_phone,c_email) VALUES (:company,:phone,:email,:address,:website, :c_name,:c_designation,:c_phone,:c_email)");
            $query->execute([
                ":company" => $c_company,
                ":phone" => $c_phone,
                ":email" => $c_email,
                ":address" => $c_address,
                ":website" => $c_website,

                ":c_name" => $s_name,
                ":c_designation" => $s_designation,
                ":c_phone" => $s_phone,
                ":c_email" => $s_email

            ]);
            $supplier_id=$con->lastInsertId();
            $leg=$con->prepare("INSERT INTO supp_ledger (supp_id, trn_date, trn_detail, trn_type, paid, received) VALUES (:supp_id, :trn_date, :trn_detail, :trn_type, :paid, :received)");
            $leg->execute([
                "supp_id"=>$supplier_id,
                "trn_date"=>$trn_date,
                "trn_detail"=>$trn_detail,
                "trn_type"=>$trn_type,
                "paid"=>$paid,
                "received"=>$received
            ]);

            if ($query && $leg) {
                echo "inserted";
            } else {
                echo "not_inserted";
            }

            
        }
        

            

    } else {
        echo "Email_already_exist";
    }




}


///Handle load supp ajax request///
if (isset($_POST["load"])) {
    $query = $con->prepare("SELECT * FROM suppliers");
    $query->execute();
    $row = $query->fetchAll(PDO::FETCH_ASSOC);

    $no = 1;

    $output = "<table>
                <thead>
                    <tr>
                        <th colspan='7' class='text-primary' style='font-size:20px;'>Company Details</th>
                    </tr>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Website</th>
                        <th style='width:18%'>Actions</th>
                    </tr>
                </thead>
                <tbody>";
    foreach ($row as $row) {

        $output .= "<tr>
                        <td>{$no}</td>
                        <td>{$row["company"]}</td>
                        <td>{$row["phone"]}</td>
                        <td>{$row["email"]}</td>
                        <td>{$row["address"]}</td>
                        <td>{$row["website"]}</td>
                        <td>
                        <button class='btn btn-info' id='view_btn' data-vid='{$row["supplier_id"]}'> <i class='fa fa-eye'></i> </button>
                        <a class='btn btn-primary' id='ledger_btn' href='supplier_ledger.php?supplier_id={$row["supplier_id"]}'> <i class='fa fa-bank'></i> </a>
                        <button class='btn btn-success' id='update_btn' data-uid='{$row["supplier_id"]}'> <i class='fa fa-edit'></i> </button>
                        <button class='btn btn-danger' id='delete_btn' data-did='{$row["supplier_id"]}'> <i class='fa fa-trash'></i> </button>
                        </td>
                    </tr>";
        $no++;
    }

    $output .= "</tbody></table>";

    echo $output;
}



///Handle view contact person ajax request///
if (isset($_POST["id"])) {

    $v_id = $_POST["id"];

    $query = $con->prepare("SELECT * FROM suppliers WHERE supplier_id=:supplier_id");
    $query->execute([
        "supplier_id" => $v_id
    ]);
    $row = $query->fetch(PDO::FETCH_ASSOC);

    $view_data["v_name"] = $row["c_name"];
    $view_data["v_designation"] = $row["c_designation"];
    $view_data["v_phone"] = $row["c_phone"];
    $view_data["v_email"] = $row["c_email"];


    echo json_encode($view_data);
}



///Handle fetch supplier-data for update ajax request///
if (isset($_POST["cid"])) {

    $u_id = $_POST["cid"];

    $query = $con->prepare("SELECT * FROM suppliers WHERE supplier_id=:supplier_id");
    $query->execute([
        "supplier_id" => $u_id
    ]);
    $row = $query->fetch(PDO::FETCH_ASSOC);

    $supplier_data["s_id"] = $row["supplier_id"];
    $supplier_data["s_name"] = $row["c_name"];
    $supplier_data["s_designation"] = $row["c_designation"];
    $supplier_data["s_phone"] = $row["c_phone"];
    $supplier_data["s_email"] = $row["c_email"];


    echo json_encode($supplier_data);
}



///Handle Update Supplier-ajax request///
if (isset($_POST["action"]) && $_POST["action"] == "update_supplier") {
    // print_r ($_POST);

    $updated_id = check_inputs($_POST["update"]);
    $updated_name = check_inputs($_POST["uname"]);
    $updated_designation = check_inputs($_POST["udesignation"]);
    $updated_phone = check_inputs($_POST["uphone"]);
    $updated_email = check_inputs($_POST["uemail"]);

    $check_update_email = y_email_exist($updated_email, $updated_id);

    if ($check_update_email == null) {

        $query = $con->prepare("UPDATE suppliers SET c_name=:c_name, c_designation=:c_designation, c_phone=:c_phone, c_email=:c_email Where supplier_id=:supplier_id");

        $query->execute([
            "supplier_id" => $updated_id,
            "c_name" => $updated_name,
            "c_designation" => $updated_designation,
            "c_phone" => $updated_phone,
            "c_email" => $updated_email

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
    $query = $con->prepare("DELETE FROM suppliers WHERE supplier_id=:supplier_id");
    $query->execute([
        "supplier_id" => $delete_id
    ]);

    if ($query) {
        echo "deleted";
    } else {
        echo "not_deleted";
    }

}










?>