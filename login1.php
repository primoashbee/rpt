<?php 
require "config.php";
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "Select * from accounts where username ='$username' ";
if(mysqli_num_rows(mysqli_query($conn,$sql))>0){
	$user = mysqli_fetch_assoc(mysqli_query($conn,$sql));
	if(password_verify($password,$user['password'])){
		$_SESSION['user'] = $user;
		if($user['isAdmin']){
			header('location:admin/index.php');		
		}else{
			header('location:user/index.php');

		}
	}else{
	$_SESSION['msg'] = 'Username and Password Incorrect';
	header('location:login.php');

	}
}else{
	$_SESSION['msg'] = 'Username and Password Incorrect';
	header('location:login.php');
}


?>