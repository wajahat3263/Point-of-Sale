<?php include_once "config.php";

    ///handle insert bank ajax request///
    if (isset($_POST["action"]) && $_POST["action"] == "insert_bank") {
    // print_r ($_POST);
    $name = check_inputs($_POST["name"]);
    $account_no = check_inputs($_POST["account_no"]);
    $account_tit = check_inputs($_POST["account_tit"]);
    $b_code = check_inputs($_POST["b_code"]);
    $address = check_inputs($_POST["address"]);

    $check_acc = a_exist($account_no);
    if ($check_acc == null) {

        $query = $con->prepare("INSERT INTO banks (bank_name, account_title, account_no, branch_code, address) VALUES (:bank_name, :account_title, :account_no, :branch_code, :address)");
        $query->execute([
            "bank_name" => $name,
            "account_title" => $account_tit,
            "account_no" => $account_no,
            "branch_code" => $b_code,
            "address" => $address
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
        $query = $con->prepare("SELECT * FROM banks");
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);

        $no = 1;

        $output = "<table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Bank Name</th>
                            <th>Acoount Title</th>
                            <th>Account No</th>
                            <th>Branch Code</th>
                            <th>Address</th>
                            <th style='width:12%'>Actions</th>
                        </tr>
                    </thead>
                    <tbody>";
        foreach ($row as $row) {

            $output .= "<tr>
                            <td>{$no}</td>
                            <td>{$row["bank_name"]}</td>
                            <td>{$row["account_title"]}</td>
                            <td>{$row["account_no"]}</td>
                            <td>{$row["branch_code"]}</td>
                            <td>{$row["address"]}</td>
                            <td>
                            <button class='btn btn-success' id='update_btn' data-uid='{$row["bank_id"]}'> <i class='fa fa-edit'></i> </button>
                            <button class='btn btn-danger' id='delete_btn' data-did='{$row["bank_id"]}'> <i class='fa fa-trash'></i> </button>
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

        $query = $con->prepare("SELECT * FROM banks WHERE bank_id=:bank_id");
        $query->execute([
            "bank_id" => $u_id
        ]);
        $row = $query->fetch(PDO::FETCH_ASSOC);

        $customer_data["bank_id"] = $row["bank_id"];
        $customer_data["bank_name"] = $row["bank_name"];
        $customer_data["account_title"] = $row["account_title"];
        $customer_data["account_no"] = $row["account_no"];
        $customer_data["branch_code"] = $row["branch_code"];
        $customer_data["address"] = $row["address"];

        echo json_encode($customer_data);
    }

    ///Handle Update bank ajax request///
    if (isset($_POST["action"]) && $_POST["action"] == "update_bank") {
        // print_r ($_POST);

        $updated_id = check_inputs($_POST["update"]);
        $u_name = check_inputs($_POST["u_name"]);
        $uaccount_no = check_inputs($_POST["uaccount_no"]);
        $uaccount_tit = check_inputs($_POST["uaccount_tit"]);
        $ub_code = check_inputs($_POST["ub_code"]);
        $u_address = check_inputs($_POST["u_address"]);

        $check_u_acc = u_a_exist($uaccount_no, $updated_id);

        if ($check_u_acc == null) {

            $query = $con->prepare("UPDATE banks SET  bank_name=:bank_name, account_title=:account_title, account_no=:account_no, branch_code=:branch_code, address=:address Where bank_id=:bank_id");

            $query->execute([
                "bank_id" => $updated_id,
                "bank_name" => $u_name,
                "account_title" => $uaccount_tit,
                "account_no" => $uaccount_no,
                "branch_code" => $ub_code,
                "address" => $u_address
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
        $query = $con->prepare("DELETE FROM banks WHERE bank_id=:bank_id");
        $query->execute([
            "bank_id" => $delete_id
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
        $sql_query = $con->prepare("SELECT * FROM banks WHERE account_no = :account_no");
        $sql_query->execute([
            "account_no" => $account  
        ]);
        $result=$sql_query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    ///Function to check email already exist in update module///
    function u_a_exist($account, $id){
        global $con;
        $sql_query = $con->prepare("SELECT * FROM banks WHERE account_no=:account_no AND bank_id!=:bank_id");
        $sql_query->execute([
            "account_no"=>$account,
            "bank_id"=>$id
        ]);
        $result = $sql_query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }




?>