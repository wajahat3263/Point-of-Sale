<?php
///include database connection///
require_once "config.php";

///========PHP MAILER Starts========///
//Load Composer's autoloader
require '../assets/PhpMailer/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
///========PHP MAILER Ends========///


/////======================= \Handle Forgot Password AJAX Request/ ======================/////
if(isset($_POST["action"]) && $_POST["action"]=="reset_pass"){

    $user_email = check_inputs($_POST["email"]);

    $sql = $con->prepare("SELECT * FROM users WHERE e_mail=:e_mail");
    $sql->execute([
        "e_mail"=>$user_email
    ]);

    $user_data = $sql->fetch(PDO::FETCH_ASSOC);

    if ($user_data!=null) {

        $token = uniqid();
        $token = str_shuffle($token);

        $token_sql = $con->prepare("UPDATE users SET token=:token, t_expire=DATE_ADD(NOW(),INTERVAL :expire_in MINUTE) WHERE e_mail=:e_mail");

        $token_sql->execute([
            "token"=>$token,
            "expire_in"=>10,
            "e_mail"=>$user_email
        ]);

        if ($token_sql) {
            
            try {
                //Server settings//
                 //Send using SMTP
                $mail->isSMTP();
                //Set the SMTP server to send through                 
                $mail->Host       = 'smtp.gmail.com';
                //Enable SMTP authentication                   
                $mail->SMTPAuth   = true;

                //SMTP Email
                $mail->Username   = 'muridwalaadda201@gmail.com';
                //SMTP password           
                $mail->Password   = 'yvbqscvdfrgsrxun';

                //Enable implicit TLS encryption                          
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                //TCP port to connect to, use 465            
                $mail->Port       = 465;                             
            
                //Recipients
                $mail->setFrom('muridwalaadda201@gmail.com', 'Haseeb');
                //Add a recipient email
                $mail->addAddress($user_email);     
        
                //Content
                $mail->isHTML(true);                    //Set email format to HTML
                $mail->Subject = 'Reset Password';
                $mail->Body    = 'Here is your Password Reset Link: <a href="http://localhost/Final_Project/reset_password.php?email='.$user_email.'&token='.$token.'"> <b>Click to Reset!</b> </a>';
            
                $mail->send();
                echo 'Email_sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

        } else {
            echo "server_error";
        }
        


    } else {
        echo "user_not_found";
    }
    
    


}

/////========================= \Handle Login User AJAX Request/ =========================/////
if(isset($_POST["action"]) && $_POST["action"]=="login_user"){

    $uname_email = check_inputs($_POST["username_email"]);
    $pass = check_inputs($_POST["password"]);

    $sql = $con->prepare("SELECT * FROM users WHERE u_name=:u_name OR e_mail=:e_mail");
    $sql->execute([
        "u_name"=>$uname_email,
        "e_mail"=>$uname_email
    ]);

    $user_data = $sql->fetch(PDO::FETCH_ASSOC);

    if ($user_data!=null) {

        //Password verification
        if(password_verify($pass,$user_data["p_word"])) {

            //Remember me cookie//
            if(isset($_POST["remember_me"])) {

                setcookie("email_username", $uname_email, time() + (30 * 24 * 60 * 60), "/");
                setcookie("pass_word", $pass, time() + (30 * 24 * 60 * 60), "/");

            }else{
                setcookie("email_username", "", 1, "/");
                setcookie("pass_word", "", 1, "/");
            }

            echo "logged_in";
            //Sessions//
            $_SESSION["user_name"] = $user_data["u_name"];
            $_SESSION["email"] = $user_data["e_mail"];
            $_SESSION["name"] = $user_data["f_name"];
            $_SESSION["photo"] = $user_data["photo"];
            $_SESSION["role"] = $user_data["role"];
            $_SESSION["id"] = $user_data["user_id"];

        }else{
            echo "wrong_password";
        }

    } else {
        echo "user_not_found";
    }
    


}



/////===================================\USERS MODULE/===================================/////
///================\Handle Insert User AJAX Request/================///
if(isset($_POST["action"]) && $_POST["action"] == "insert_user"){
    ///check data in arrey in console///
    // print_r ($_POST);

    $name = check_inputs($_POST["name"]);
    $user_name = check_inputs($_POST["user_name"]);
    $email = check_inputs($_POST["email"]);
    $pass = check_inputs($_POST["password"]);
    $gender = check_inputs($_POST["gender"]);
    $role = check_inputs($_POST["role"]);
    //Name of image//
    $image_name = $_FILES["user_photo"]["name"];
    //Path of image where saved//
    $image_path = $_FILES["user_photo"]["tmp_name"];


    $hpass = password_hash($pass, PASSWORD_DEFAULT);

    $check_email = email_exist($email);
    $check_username = username_exist($user_name);

    if($check_email==null){
        if ($check_username == null) {

            if (strlen($image_name) > 4) {

                $new_name=save_image($image_name, $image_path);

                // query to send data in database //
                $sql_query = $con->prepare("INSERT INTO users (f_name, u_name, e_mail, p_word, gen, role, photo) VALUES(:f_name, :u_name, :e_mail, :p_word, :gen, :role, :photo)");
                // Query execution
                $sql_query->execute([
                    "f_name" => $name,
                    "u_name" => $user_name,
                    "e_mail" => $email,
                    "p_word" => $hpass,
                    "gen" => $gender,
                    "role" => $role,
                    "photo"=>$new_name

                ]);

                


            } else {
                // query to send data in database //
                $sql_query = $con->prepare("INSERT INTO users (f_name, u_name, e_mail, p_word, gen, role) VALUES(:f_name, :u_name, :e_mail, :p_word, :gen, :role)");
                // Query execution
                $sql_query->execute([
                    "f_name" => $name,
                    "u_name" => $user_name,
                    "e_mail" => $email,
                    "p_word" => $hpass,
                    "gen" => $gender,
                    "role" => $role,

                ]);
            }


            if ($sql_query) {
                echo "inserted";
            } else {
                echo "not_inserted";
            }
            



        }else{
            echo "username_exist"; 
        }

    }else{
        echo "email_exist";
    }

}

///================= \Handle Load User AJAX Request/ ================///
if(isset($_POST["loaduser"])){
    $sql_query = $con->prepare("SELECT * FROM users");
	$sql_query->execute();
	$row=$sql_query->fetchAll(PDO::FETCH_ASSOC);

    $output = "";
    $rowno = 1;

    if($row){
        $output = "<table>
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Full Name</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Photo</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>";
        foreach($row as $row){

            if ($row["blocked"]=="1") {
                $status = "Enabled";
                $badge = "<span class='label label-success'>";
            } else {
                $status = "Disabled";
                $badge = "<span class='label label-danger'>";
                
            }

            if (!empty($row["photo"])) {
                $path = "uploads/user_images/" . $row["photo"];
            } else {
                $path = "uploads/default.png";
            }
            
            
            $output .="<tr>
            <td>{$rowno}</td>
            <td>{$row["f_name"]}</td>
            <td>{$row["u_name"]}</td>
            <td>{$row["e_mail"]}</td>
            <td>{$row["gen"]}</td>
            <td>{$row["role"]}</td>
            <td>{$badge}{$status}</td>
            <td><img src='{$path}' height='50' width='50'></td>
            <td> 
            <button class='btn btn-success' id='edit_btn' data-uid='{$row["user_id"]}'><i class='fa fa-edit'></i></button>
            <button class='btn btn-danger' id='delete_btn' data-did='{$row["user_id"]}'><i class='fa fa-trash'></i></button> 
            </td>
            </tr> ";
            $rowno++;
        }
        $output .= "</tbody></table>";
        echo $output;
    }else{
        echo "No record found";
    }

    
}

///======== \Handle Fetch User Data For Update AJAX Request/ ========///
if(isset($_POST["uid"])){

    $up_id = $_POST["uid"];

    $sql_query = $con->prepare("SELECT * FROM users WHERE user_id = :user_id");
	$sql_query->execute(["user_id" => $up_id]);
	$row = $sql_query->fetch(PDO::FETCH_ASSOC);

    $user_data["uid"] = $row["user_id"];
    $user_data["name"] = $row["f_name"];
    $user_data["uname"] = $row["u_name"];
    $user_data["status"] = $row["blocked"];
    $user_data["role"] = $row["role"];

    echo json_encode($user_data);
}

///=============== \Handle Update User AJAX Request/ ===============///
if (isset($_POST["action"]) && $_POST["action"] == "update_user") {
    ///check data in arrey in console///
    // print_r ($_POST);
    $user_id = check_inputs($_POST["uuid"]);
    $uname = check_inputs($_POST["uname"]);
    $uuser_name = check_inputs($_POST["uuser_name"]);
    $urole = check_inputs($_POST["urole"]);
    $ustatus = check_inputs($_POST["ustatus"]);

    $check_u_username = u_username_exist($uuser_name, $user_id);

    if ($check_u_username == null) {

        // query to send data in database //
        $sql_query = $con->prepare("UPDATE users SET f_name = :f_name, u_name = :u_name, role = :role, blocked = :status WHERE user_id = :user_id");
        // Query execution
        $sql_query->execute([

            "user_id" => $user_id,
            "f_name" => $uname,
            "u_name" => $uuser_name,
            "role" => $urole,
            "status" => $ustatus,

        ]);


        if ($sql_query) {
            echo "updated";
        } else {
            echo "not_updated";
        }



    } else {
        echo "username_exist";
    }



}

///================ \Handle Delete User AJAX Request/ ==============///
if(isset($_POST["DeleteId"])){

    $delele_id = $_POST["DeleteId"];

    $sql_query = $con->prepare("DELETE FROM users WHERE user_id = :user_id");
	$sql_query->execute(["user_id" => $delele_id]);
    
    if($sql_query){
        echo "deleted";
    }else{
        echo "not_deleted";
    }
}



/////============================= \USER PROFILE MODULE/ ===============================/////
///========= \Handle Load User Profile Data AJAX Request/ ==========///
if(isset($_POST["user_id"])){

    $user_id = $_POST["user_id"];

    $profile_sql = $con->prepare("SELECT * FROM users WHERE user_id=:user_id");
    $profile_sql->execute([
        "user_id"=>$user_id
    ]);

    $profile_data = $profile_sql->fetch(PDO::FETCH_ASSOC);

    $profile["id"] = $profile_data["user_id"];
    $profile["full_name"] = $profile_data["f_name"];
    $profile["user_name"] = $profile_data["u_name"];
    $profile["email"] = $profile_data["e_mail"];
    $profile["phone"] = $profile_data["phone"];
    $profile["gender"] = $profile_data["gen"];
    $profile["address"] = $profile_data["address"];
    $profile["verified"] = $profile_data["v_fied"];
    $profile["photo"] = $profile_data["photo"];
    $profile["role"] = $profile_data["role"];
    $profile["status"] = $profile_data["blocked"];
    

    echo json_encode ($profile);
    
}

///======== \Handle Update User Profile Data AJAX Request/ ========///
if(isset($_POST["action"]) && $_POST["action"]=="update_profile"){
    // print_r ($_POST);
    $profile_id = check_inputs($_POST["profile_id"]);
    $profile_name = check_inputs($_POST["input_Name"]);
    $profile_username = check_inputs($_POST["input_Username"]);
    $profile_email = check_inputs($_POST["input_Email"]);
    $profile_role = check_inputs($_POST["input_Role"]);
    $profile_phone = check_inputs($_POST["input_Phone"]);

    $check_profile_username = u_username_exist($profile_username,$profile_id);
    $check_profile_email = u_email_exist($profile_email,$profile_id);

    if ($check_profile_username==null) {
        if ($check_profile_email==null) {

            $sql = $con->prepare("UPDATE users SET f_name=:f_name, u_name=:u_name, e_mail=:e_mail, role=:role, phone=:phone WHERE user_id=:user_id");

            $sql->execute([
                "user_id"=>$profile_id,
                "f_name"=>$profile_name,
                "u_name"=>$profile_username,
                "e_mail"=>$profile_email,
                "role"=>$profile_role,
                "phone"=>$profile_phone,
            
            ]);
    
            if ($sql) {
                echo "profile_updated";
            } else {
                echo "profile_not_updated";
            }
            
        } else {
            
            echo "profile_email_already_exist";
        }
        
        

    } else {

        echo "profile_username_already_exist";
    }
    

   
}

///=========== \Handle Update User Password AJAX Request/ =========///
if(isset($_POST["action"]) && $_POST["action"]=="update_password"){
    // print_r ($_POST);
    $pass_id = check_inputs($_POST["get_id"]);
    $old_pass = check_inputs($_POST["input_old_pass"]);
    $new_pass = check_inputs($_POST["input_new_pass"]);
    $conf_new_pass = check_inputs($_POST["input_confirm_pass"]);



    $hash_new_pass = password_hash($new_pass, PASSWORD_DEFAULT);

    $sql = $con->prepare("SELECT * FROM users WHERE user_id=:user_id");
    $sql->execute([
        "user_id"=>$pass_id
    ]);

    $data = $sql->fetch(PDO::FETCH_ASSOC);

    if(password_verify($old_pass,$data["p_word"])) {

        if ($new_pass==$conf_new_pass && $new_pass!=null && $conf_new_pass!=null) {

            if (strlen($new_pass)>=3) {

                
                $sql = $con->prepare("UPDATE users SET p_word=:p_word WHERE user_id=:user_id");
                $sql->execute([
                    "p_word"=>$hash_new_pass,
                    "user_id"=>$pass_id
                ]);

                if ($sql) {
                    echo "password_updated_successfully";
                } else {
                    echo "password_not_updated_successfully";
                }


            } else {
                echo "less_password";
            }
            

            
            

        } else {
            echo "pass_not_match";
        }
        

               

    }else{
        echo "wrong_old_pass";
    }

   

    
}





    





?>