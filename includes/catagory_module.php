<?php
///include database connection///
require_once "config.php";

/////==========================================\UNITS MODULE/=======================================/////
///================\Handle Insert Unit AJAX Request/================///
if (isset($_POST["action"]) && $_POST["action"] == "insert_unit") {

    $unit_name = check_inputs($_POST["unit"]);

    // query to send data in database //
    $sql_query = $con->prepare("INSERT INTO catagory (cat_name) VALUES (:cat_name)");
    // Query execution
    $sql_query->execute([
        "cat_name" => $unit_name
    ]);


    if ($sql_query) {
        echo "inserted";
    } else {
        echo "not_inserted";
    }



}

///================= \Handle Load Unit AJAX Request/ ================///
if (isset($_POST["loadunit"])) {

    $sql_query = $con->prepare("SELECT * FROM catagory");
    $sql_query->execute();
    $row = $sql_query->fetchAll(PDO::FETCH_ASSOC);

    $output = "";
    $rowno = 1;

    if ($row) {
        $output = "<table>
                <thead>
                    <tr>
                        <th style='width:80px;'>No.</th>
                        <th>Catagory Name</th>
                        <th style='width:150px;'>Action</th>
                    </tr>
                </thead>
                <tbody>";
        foreach ($row as $row) {

            $output .= "<tr>
            <td>{$rowno}</td>
            <td>{$row["cat_name"]}</td>
            <td> 
            <button class='btn btn-success' id='edit_btn' data-uid='{$row["cat_id"]}'><i class='fa fa-edit'></i></button>
            <button class='btn btn-danger' id='delete_btn' data-did='{$row["cat_id"]}'><i class='fa fa-trash'></i></button> 
            </td>
            </tr> ";
            $rowno++;
        }
        $output .= "</tbody></table>";
        echo $output;
    } else {
        echo "<table>
        <thead>
            <tr>
                <th>No.</th>
                <th class='text-center'>Catagory Name</th>
                <th class='text-center'>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        </table>";

    }


}

///======== \Handle Fetch Unit Data For Update AJAX Request/ ========///
if (isset($_POST["uid"])) {

    $up_id = $_POST["uid"];

    $sql_query = $con->prepare("SELECT * FROM catagory WHERE cat_id = :cat_id");
    $sql_query->execute(["cat_id" => $up_id]);
    $row = $sql_query->fetch(PDO::FETCH_ASSOC);

    $user_data["uid"] = $row["cat_id"];
    $user_data["name"] = $row["cat_name"];

    echo json_encode($user_data);
}

///=============== \Handle Update Unit AJAX Request/ ===============///
if (isset($_POST["action"]) && $_POST["action"] == "update_unit") {

    $unit_id = check_inputs($_POST["hid"]);
    $unit_name = check_inputs($_POST["up_unit"]);

    // query to send data in database //
    $sql_query = $con->prepare("UPDATE catagory SET cat_name = :cat_name WHERE cat_id = :cat_id");
    // Query execution
    $sql_query->execute([

        "cat_id" => $unit_id,
        "cat_name" => $unit_name

    ]);


    if ($sql_query) {
        echo "updated";
    } else {
        echo "not_updated";
    }





}

///================ \Handle Delete User AJAX Request/ ==============///
if(isset($_POST["DeleteId"])){

    $delele_id = $_POST["DeleteId"];

    $sql_query = $con->prepare("DELETE FROM catagory WHERE cat_id = :cat_id");
	$sql_query->execute(["cat_id" => $delele_id]);
    
    if($sql_query){
        echo "deleted";
    }else{
        echo "not_deleted";
    }
}





?>