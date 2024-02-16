<?php

session_start();


///database connection///

$host="localhost";
$user="root";
$pass="";
$db="final";

$url = "http://localhost/";


$con= new PDO("mysql: host=$host; dbname=$db", $user, $pass);

// PDO error mode
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if ($con) {
    
} else {
    echo "Database connection error";
}




///Function to check inputs special characters and remove///
function check_inputs($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}




///////Functions for user module///////

///Function to check email already exist///
function email_exist($mail){
	global $con;
	$sql_query = $con->prepare("SELECT * FROM users WHERE e_mail = :e_mail");
	$sql_query->execute([
		"e_mail" => $mail  
	]);
	$result=$sql_query->fetch(PDO::FETCH_ASSOC);
	return $result;
}

///Function to check username already exist///
function username_exist($user){
	global $con;
	$sql_query = $con->prepare("SELECT * FROM users WHERE u_name = :u_name");
	$sql_query->execute([
		"u_name" => $user
	]);
	$result=$sql_query->fetch(PDO::FETCH_ASSOC);
	return $result;
}

///Function to check username already exist in update module///
function u_username_exist($user, $id){
	global $con;
	$sql_query = $con->prepare("SELECT * FROM users WHERE u_name = :u_name AND user_id != :user_id");
	$sql_query->execute([
		"u_name" => $user,
		"user_id" => $id
	]);
	$result = $sql_query->fetch(PDO::FETCH_ASSOC);
	return $result;
}

///Function to check email already exist in update module///
function u_email_exist($mail, $id){
	global $con;
	$sql_query = $con->prepare("SELECT * FROM users WHERE e_mail = :e_mail AND user_id != :user_id");
	$sql_query->execute([
		"e_mail" => $mail,
		"user_id" => $id
	]);
	$result = $sql_query->fetch(PDO::FETCH_ASSOC);
	return $result;
}





///////Functions for customer module//////

///Function to check email already exist///
function c_email_exist($mail){
	global $con;
	$query = $con->prepare("SELECT * FROM customers WHERE email=:email");
	$query->execute([
		"email"=>$mail
	]);
	$result = $query->fetch(PDO::FETCH_ASSOC);
	return $result;

}

///Function to check email already exist in update module///
function cu_email_exist($mail,$id){
	global $con;
	$query = $con->prepare("SELECT * FROM customers WHERE email=:email AND customer_id!=:customer_id");
	$query->execute([
		"email"=>$mail,
		"customer_id"=>$id
	]);
	$result = $query->fetch(PDO::FETCH_ASSOC);
	return $result;

}




///////Functions for Suppliers module//////

///Function to check email already exist in add-suppier///

function x_email_exist($mail){
	global $con;
	$query = $con->prepare("SELECT * FROM suppliers WHERE email=:email AND email!='' OR c_email=:c_email AND c_email!=''");
	$query->execute([
		"email"=>$mail,
		"c_email"=>$mail

	]);
	$result = $query->fetch(PDO::FETCH_ASSOC);
	return $result;

}



//Function to check email already exist in update module///

function y_email_exist($mail,$id){
	global $con;
	$query = $con->prepare("SELECT * FROM suppliers WHERE email=:email AND email!='' OR c_email=:c_email AND c_email!='' AND supplier_id!=:supplier_id");
	$query->execute([
		"email"=>$mail,
		"c_email"=>$mail,
		"supplier_id"=>$id

	]);
	$result = $query->fetch(PDO::FETCH_ASSOC);
	return $result;

}


///image save function
function save_image($image_name,$image_path){
	global $con;
	$without_extension = pathinfo($image_name, PATHINFO_FILENAME);

    $extension = pathinfo($image_name, PATHINFO_EXTENSION);

    $new_name = $without_extension . rand(100000, 999999) . time() . "." . $extension;

    $path = "../uploads/user_images/" . $new_name;

    move_uploaded_file($image_path, $path);

	return $new_name;


}






?>