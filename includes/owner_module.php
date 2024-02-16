<?php include_once "config.php";

    ///handle insert bank ajax request///
    if (isset($_POST["action"]) && $_POST["action"] == "insert_bank") {
    // print_r ($_POST);
    $name = check_inputs($_POST["name"]);
    $email = check_inputs($_POST["email"]);
    $phone = check_inputs($_POST["phone"]);

    $check_acc = a_exist($email);
    if ($check_acc == null) {

        $query = $con->prepare("INSERT INTO owners (owner_name, owner_email, owner_phone) VALUES (:owner_name, :owner_email, :owner_phone)");
        $query->execute([
            "owner_name" => $name,
            "owner_email" => $email,
            "owner_phone" => $phone
        ]);

        if ($query) {
            echo "inserted";
        } else {
            echo "not_inserted";
        }

    } else {
        echo "account_already_exist";
    }




    }

    ///Handle load bank ajax request///
    if (isset($_POST["load"])) {
        $query = $con->prepare("SELECT * FROM owners");
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);

        $no = 1;

        $output = "<table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Owner Name</th>
                            <th>Owner Email</th>
                            <th>Owner Phone</th>
                            <th style='width:15%'>Actions</th>
                        </tr>
                    </thead>
                    <tbody>";
        foreach ($row as $row) {

            $output .= "<tr>
                            <td>{$no}</td>
                            <td>{$row["owner_name"]}</td>
                            <td>{$row["owner_email"]}</td>
                            <td>{$row["owner_phone"]}</td>
                            <td>
                            <button class='btn btn-success' id='update_btn' data-uid='{$row["owner_id"]}'> <i class='fa fa-edit'></i> </button>
                            <button class='btn btn-danger' id='delete_btn' data-did='{$row["owner_id"]}'> <i class='fa fa-trash'></i> </button>
                            </td>
                        </tr>";
            $no++;
        }

        $output .= "</tbody></table>";

        echo $output;
    }

    ///Handle fetch bank-data for update ajax request///
    if (isset($_POST["cid"])) {

        $u_id = $_POST["cid"];

        $query = $con->prepare("SELECT * FROM owners WHERE owner_id=:owner_id");
        $query->execute([
            "owner_id" => $u_id
        ]);
        $row = $query->fetch(PDO::FETCH_ASSOC);

        $customer_data["owner_id"] = $row["owner_id"];
        $customer_data["owner_name"] = $row["owner_name"];
        $customer_data["owner_email"] = $row["owner_email"];
        $customer_data["owner_phone"] = $row["owner_phone"];
        echo json_encode($customer_data);
    }

    ///Handle Update bank ajax request///
    if (isset($_POST["action"]) && $_POST["action"] == "update_bank") {
        // print_r ($_POST);

        $updated_id = check_inputs($_POST["update"]);
        $u_name = check_inputs($_POST["u_name"]);
        $u_email = check_inputs($_POST["u_email"]);
        $u_phone = check_inputs($_POST["u_phone"]);

        $check_u_acc = u_a_exist($u_email, $updated_id);

        if ($check_u_acc == null) {

            $query = $con->prepare("UPDATE owners SET  owner_name=:owner_name, owner_email=:owner_email, owner_phone=:owner_phone Where owner_id=:owner_id");

            $query->execute([
                "owner_id" => $updated_id,
                "owner_name" => $u_name,
                "owner_email" => $u_email,
                "owner_phone" => $u_phone
            ]);

            if ($query) {
                echo "updated";
            } else {
                echo "not_updated";
            }


        } else {
            echo "account_exist";
        }




    }

    ///Handl delete customer ajax request///
    if (isset($_POST["delete"])) {
        // print_r($_POST);
        $delete_id = $_POST["delete"];
        $query = $con->prepare("DELETE FROM owners WHERE owner_id=:owner_id");
        $query->execute([
            "owner_id" => $delete_id
        ]);

        if ($query) {
            echo "deleted";
        } else {
            echo "not_deleted";
        }

    }






    ///Function to check email already exist///
    function a_exist($account){
        global $con;
        $sql_query = $con->prepare("SELECT * FROM owners WHERE owner_email=:owner_email");
        $sql_query->execute([
            "owner_email" => $account  
        ]);
        $result=$sql_query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    ///Function to check email already exist in update module///
    function u_a_exist($account, $id){
        global $con;
        $sql_query = $con->prepare("SELECT * FROM owners WHERE owner_email=:owner_email AND owner_id!=:owner_id");
        $sql_query->execute([
            "owner_email"=>$account,
            "owner_id"=>$id
        ]);
        $result = $sql_query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }




?>