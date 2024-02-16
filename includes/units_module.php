<?php
///include database connection///
require_once "config.php";

/////==========================================\UNITS MODULE/=======================================/////
///================\Handle Insert Unit AJAX Request/================///
if (isset($_POST["action"]) && $_POST["action"] == "insert_unit") {

    $unit_name = check_inputs($_POST["unit"]);

    // query to send data in database //
    $sql_query = $con->prepare("INSERT INTO units (unit_name) VALUES (:unit_name)");
    // Query execution
    $sql_query->execute([
        "unit_name" => $unit_name
    ]);


    if ($sql_query) {
        echo "inserted";
    } else {
        echo "not_inserted";
    }



}

///================= \Handle Load Unit AJAX Request/ ================///
if (isset($_POST["loadunit"])) {

    $sql_query = $con->prepare("SELECT * FROM units");
    $sql_query->execute();
    $row = $sql_query->fetchAll(PDO::FETCH_ASSOC);

    $output = "";
    $rowno = 1;

    if ($row) {
        $output = "<table>
                <thead>
                    <tr>
                        <th style='width:80px'>No.</th>
                        <th>Unit Name</th>
                        <th style='width:150px'>Action</th>
                    </tr>
                </thead>
                <tbody>";
        foreach ($row as $row) {

            $output .= "<tr>
            <td>{$rowno}</td>
            <td>{$row["unit_name"]}</td>
            <td> 
            <button class='btn btn-success' id='edit_btn' data-uid='{$row["unit_id"]}'><i class='fa fa-edit'></i></button>
            <button class='btn btn-danger' id='delete_btn' data-did='{$row["unit_id"]}'><i class='fa fa-trash'></i></button> 
            </td>
            </tr> ";
            $rowno++;
        }
        $output .= "</tbody></table>";
        echo $output;
    } else {
        echo "No record found";
    }


}

///======== \Handle Fetch Unit Data For Update AJAX Request/ ========///
if (isset($_POST["uid"])) {

    $up_id = $_POST["uid"];

    $sql_query = $con->prepare("SELECT * FROM units WHERE unit_id = :unit_id");
    $sql_query->execute(["unit_id" => $up_id]);
    $row = $sql_query->fetch(PDO::FETCH_ASSOC);

    $user_data["uid"] = $row["unit_id"];
    $user_data["name"] = $row["unit_name"];

    echo json_encode($user_data);
}

///=============== \Handle Update Unit AJAX Request/ ===============///
if (isset($_POST["action"]) && $_POST["action"] == "update_unit") {

    $unit_id = check_inputs($_POST["hid"]);
    $unit_name = check_inputs($_POST["up_unit"]);

    // query to send data in database //
    $sql_query = $con->prepare("UPDATE units SET unit_name = :unit_name WHERE unit_id = :unit_id");
    // Query execution
    $sql_query->execute([

        "unit_id" => $unit_id,
        "unit_name" => $unit_name

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

    $sql_query = $con->prepare("DELETE FROM units WHERE unit_id = :unit_id");
	$sql_query->execute(["unit_id" => $delele_id]);
    
    if($sql_query){
        echo "deleted";
    }else{
        echo "not_deleted";
    }
}





?>