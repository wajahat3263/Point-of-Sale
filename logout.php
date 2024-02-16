<?php 
session_start();
unset($_SESSION['user_name']);
unset($_SESSION['email']);
unset($_SESSION['name']);
unset($_SESSION['photo']);
unset($_SESSION['role']);
session_destroy();
header('location:index.php');

?>