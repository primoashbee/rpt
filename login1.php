<?php 
require "config.php";
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "Select * from accounts where username ='$username' and password = '$password'";
if(mysqli_num_rows(mysqli_query($conn,$sql))>0){
	$_SESSION['user'] = mysqli_fetch_assoc(mysqli_query($conn,$sql));
	header('location:admin/index.php');
}else{
	$_SESSION['msg'] = 'Username and Password Incorrect';
	header('location:login.php');
}


?>