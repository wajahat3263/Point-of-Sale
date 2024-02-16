<?php
///include database connection///
require_once "config.php";

/////==========================================\Expense Catagory MODULE/=======================================/////
///================\Handle Insert Exp-Catagory AJAX Request/================///
if (isset($_POST["action"]) && $_POST["action"] == "insert_expense_cat") {

    $cat_name = check_inputs($_POST["unit"]);
    $name = check_exp_cat($cat_name);
    if ($name == null) {
        // query to send data in database //
        $sql_query = $con->prepare("INSERT INTO expense_cat (expense_cat_name) VALUES (:expense_cat_name)");
        // Query execution
        $sql_query->execute([
            "expense_cat_name" => $cat_name
        ]);


        if ($sql_query) {
            echo "inserted";
        } else {
            echo "not_inserted";
        }
    } else {
        echo "cat_exist";
    }
    

    



}

///================= \Handle Load Exp-Catagory AJAX Request/ ================///
if (isset($_POST["loadcat"])) {

    $sql_query = $con->prepare("SELECT * FROM expense_cat");
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
                        <th style='width:150px;'>Actions</th>
                    </tr>
                </thead>
                <tbody>";
        foreach ($row as $row) {

            $output .= "<tr>
            <td>{$rowno}</td>
            <td>{$row["expense_cat_name"]}</td>
            <td> 
            <button class='btn btn-success' id='edit_btn' data-uid='{$row["expense_cat_id"]}'><i class='fa fa-edit'></i></button>
            <button class='btn btn-danger' id='delete_btn' data-did='{$row["expense_cat_id"]}'><i class='fa fa-trash'></i></button> 
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

///======== \Handle Fetch Exp-Cat Data For Update AJAX Request/ ========///
if (isset($_POST["uid"])) {

    $up_id = $_POST["uid"];

    $sql_query = $con->prepare("SELECT * FROM expense_cat WHERE expense_cat_id = :expense_cat_id");
    $sql_query->execute(["expense_cat_id" => $up_id]);
    $row = $sql_query->fetch(PDO::FETCH_ASSOC);

    $user_data["uid"] = $row["expense_cat_id"];
    $user_data["name"] = $row["expense_cat_name"];

    echo json_encode($user_data);
}

///=============== \Handle Update Exp-Cat AJAX Request/ ===============///
if (isset($_POST["action"]) && $_POST["action"] == "update_cat") {

    $cat_id = check_inputs($_POST["hid"]);
    $cat_name = check_inputs($_POST["up_unit"]);
    $name = check_uexp_cat($cat_name, $cat_id);
    if ($name==null) {
        // query to send data in database //
        $sql_query = $con->prepare("UPDATE expense_cat SET expense_cat_name = :expense_cat_name WHERE expense_cat_id = :expense_cat_id");
        // Query execution
        $sql_query->execute([

            "expense_cat_id" => $cat_id,
            "expense_cat_name" => $cat_name

        ]);


        if ($sql_query) {
            echo "updated";
        } else {
            echo "not_updated";
        }
    } else {
        echo "up_cat_exist";
    }
    

    





}

///================ \Handle Delete Exp-Cat AJAX Request/ ==============///
if(isset($_POST["DeleteId"])){

    $delele_id = $_POST["DeleteId"];

    $sql_query = $con->prepare("DELETE FROM expense_cat WHERE expense_cat_id = :expense_cat_id");
	$sql_query->execute(["expense_cat_id" => $delele_id]);
    
    if($sql_query){
        echo "deleted";
    }else{
        echo "not_deleted";
    }
}

///===================================================Expense===================================================///
///===========Handle Get Expence data Ajax Request=========///
    if(isset($_POST["exp_cat_id"])){
        // print_r ($_POST);
        $exp_cat_id = $_POST["exp_cat_id"];

        $query = $con->prepare("SELECT * FROM expense_cat WHERE expense_cat_id=:expense_cat_id");
        $query->execute([
            "expense_cat_id"=>$exp_cat_id
        ]);
        $data = $query->fetch(PDO::FETCH_ASSOC);

        $product_data["id"] = $data["expense_cat_id"];
        $product_data["name"] = $data["expense_cat_name"];
        
        echo json_encode($product_data);


}

///=========Handle save Expense invoice AJAX request=========///
if(isset($_POST["action"]) && $_POST["action"]=="save_invoice"){
    // print_r($_POST);

    $inv_date = $_POST["inv_date"];
    $detail = $_POST["detail"];
    $sub_total = $_POST["sub_total"];
            
    $exp_cat_id = $_POST["id"];
    $date = $_POST["date"];
    $total = $_POST["total"];
    
    $query = $con->prepare("INSERT INTO expense (expense_date, exp_detail, grand_total) VALUES(:expense_date, :exp_detail, :grand_total)");
    $query->execute([
        "expense_date"=>$inv_date,
        "exp_detail"=>$detail,
        "grand_total"=>$sub_total
    ]);
    if($query){
    
        $exp_id = $con->lastInsertId();
        for($i=0; $i < count($exp_cat_id); $i++){
    
            $expense_detail = $con->prepare("INSERT INTO expense_detail (exp_id, exp_cat_id, date, total) VALUES (:exp_id, :exp_cat_id, :date, :total)");
            $expense_detail->execute([
                "exp_id"=>$exp_id,
                "exp_cat_id"=>$exp_cat_id[$i],
                "date"=>$date[$i],
                "total"=>$total[$i]
    
            ]);
        }
    
        echo "expense_added"; 
    
    }else{
        echo "expense_not_added";
    }
        
    
}

///==================================================All Expense=================================================///
///=========Handle load expense data AJAX request=========///
if(isset($_POST["load"])){

    $load = $con->prepare("SELECT * FROM expense");
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
                <td>{$row["expense_date"]}</td>
                <td>{$row["exp_detail"]}</td>
                <td>{$row["grand_total"]}</td>
                <td> 
                <button class='btn btn-primary' id='view_btn' data-vid='{$row["expense_id"]}'><i class='fa fa-eye'></i></button>
                <a class='btn btn-success' id='edit_btn' href='update_expense.php?expense_id={$row["expense_id"]}'><i class='fa fa-edit'></i></a>
                <button class='btn btn-danger' id='delete_btn' data-did='{$row["expense_id"]}'><i class='fa fa-trash'></i></button>
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

///========Handle view expense data AJAX request==========///
if(isset($_POST["vid"])){

    $vid = $_POST["vid"];
            
    $view_query = $con->prepare("SELECT * FROM expense WHERE expense_id=:expense_id");
        $view_query->execute([
            "expense_id"=>$vid
        ]);
    
        $view = $view_query->fetch(PDO::FETCH_ASSOC);
    
        $purchase["expense_date"] = $view["expense_date"];
        $purchase["exp_detail"] = $view["exp_detail"];
        $purchase["grand_total"] = $view["grand_total"];
    
        echo json_encode($purchase);
    
}
if (isset($_POST["tid"])) {

    $tid = $_POST["tid"];

    $tab_query = $con->prepare("SELECT * FROM expense_detail LEFT JOIN expense_cat ON expense_detail.exp_cat_id=expense_cat.expense_cat_id WHERE exp_id=:exp_id");
    $tab_query->execute([
        "exp_id" => $tid
    ]);
    $tab = $tab_query->fetchAll(PDO::FETCH_ASSOC);

    $output = "";
    $no = 1;

    if ($tab) {
        $output = "<table>
                <thead style='color: blue; background-color: lightgray;'>
                <tr>
                    <th>No#</th>
                    <th>Expense Name</th>
                    <th>Date</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>";
        foreach ($tab as $tab) {
            $output .= "<tr>
            <td>{$no}</td>
            <td>{$tab["expense_cat_name"]}</td>
            <td>{$tab["date"]}</td>
            <td>{$tab["total"]}</td>
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
            <th>Expense Name</th>
            <th>Date</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
        </table>";
    }


}

///=====Delete expense AJAX request=====///
if(isset($_POST["did"])){
    // print_r($_POST);
    $did = $_POST["did"];
    $del = $con->prepare("DELETE FROM expense WHERE expense_id=:expense_id");
    $del->execute([
        "expense_id"=>$did
    ]);

    $dele = $con->prepare("DELETE FROM expense_detail WHERE exp_id=:exp_id");
    $dele->execute([
        "exp_id"=>$did
    ]);

    echo "deleted";


}

///===========================================update Expense Module=============================================///
///=========Handle update invoice AJAX request=========///
if(isset($_POST["action"]) && $_POST["action"]=="update_invoice"){
    // print_r($_POST);
    $up_date = $_POST["up_date"];
    $expens_id = $_POST["exp_id"];
    $detail = $_POST["detail"];
    $g_total = $_POST["sub_total"];

    $cat_id = $_POST["id"];
    $exp_date = $_POST["date"];
    $total = $_POST["total"];

    $query = $con->prepare("UPDATE expense SET expense_date=:expense_date, exp_detail=:exp_detail, grand_total=:grand_total WHERE expense_id=:expense_id");
    $query->execute([
        "expense_id"=>$expens_id,
        "expense_date"=>$up_date,
        "exp_detail"=>$detail,
        "grand_total"=>$g_total
    ]);

    if($query){

        $d_query = $con->prepare("DELETE FROM expense_detail WHERE exp_id=:exp_id");
        $d_query->execute([
            "exp_id"=>$expens_id
        ]);


        for($i=0; $i < count($cat_id); $i++){

            $all = $con->prepare("INSERT INTO expense_detail (exp_id, exp_cat_id, date, total) VALUES (:exp_id, :exp_cat_id, :date, :total)");
            $all->execute([
                "exp_id"=>$expens_id,
                "exp_cat_id"=>$cat_id[$i],
                "date"=>$exp_date[$i],
                "total"=>$total[$i]

            ]);
        }

        echo "expense_updated"; 

    }else{
        echo "expense_not_updated";
    }
    

}











///===Functions===///
function check_exp_cat($exp_cat){
    global $con;
    $exp = $con->prepare("SELECT * FROM expense_cat WHERE expense_cat_name=:expense_cat_name");
    $exp->execute([
        "expense_cat_name"=>$exp_cat
    ]);
    $name = $exp->fetch(PDO::FETCH_ASSOC);
    return $name;
}
function check_uexp_cat($exp_cat, $id){
    global $con;
    $exp = $con->prepare("SELECT * FROM expense_cat WHERE expense_cat_name=:expense_cat_name AND expense_cat_id!=:expense_cat_id");
    $exp->execute([
        "expense_cat_name"=>$exp_cat,
        "expense_cat_id"=>$id
    ]);
    $name = $exp->fetch(PDO::FETCH_ASSOC);
    return $name;
}

?>