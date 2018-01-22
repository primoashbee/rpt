<?php 
session_start();
require "../config.php";
require "functions.php";
$request = addslashes($_POST['request']);

if($request=="checkIfUsernameExists"){
	$username = addslashes($_POST['username']);
	echo checkIfUsernameExists($username);
	return checkIfUsernameExists($username);
}
if($request=="getAccountViaID"){
	$id = addslashes($_POST['id']);
	$sql ="Select * from accounts where id ='$id'";
	$account =mysqli_fetch_assoc(mysqli_query($conn,$sql));
	$account['password'] = "";


	echo json_encode($account);
}
if($request=="getPropertyViaID"){
	$id = addslashes($_POST['id']);
	$sql ="Select * from properties where id ='$id'";
	$account =mysqli_fetch_assoc(mysqli_query($conn,$sql));
	echo json_encode($account);
}
if($request=="deleteAccountViaID"){
	$id = addslashes($_POST['id']);
	$sql ="update accounts set isDeleted = true where id ='$id'";
	if(mysqli_query($conn,$sql)){
		echo json_encode(array('code'=>200,'msg'=>'Account Successfully Deleted!'));
	}else{
	
		echo json_encode(array('code'=>400,'msg'=>mysqli_error($conn)));
	}

}
if($request=="deletePropertyViaID"){
	$id = addslashes($_POST['id']);
	$sql ="update properties set isDeleted = true where id ='$id'";
	if(mysqli_query($conn,$sql)){
		echo json_encode(array('code'=>200,'msg'=>'Property Successfully Deleted!'));
	}else{
	
		echo json_encode(array('code'=>400,'msg'=>mysqli_error($conn)));
	}

}
if($request=="updateAccountViaID"){
	$fname = addslashes($_POST['firstname']);
	$lname = addslashes($_POST['lastname']);
	$mi = addslashes($_POST['mi']);
	$birthday = addslashes($_POST['birthday']);
	$gender= addslashes($_POST['gender']);
	$password = addslashes($_POST['password']);
	$id = addslashes($_POST['id']);
	$sql = "Update accounts set 
			firstname= '$fname', 
			lastname='$lname', 
			mi = '$mi', 
			birthday ='$birthday', 
			gender ='$gender', 
			password = '$password'
			where id ='$id'";
	if(mysqli_query($conn,$sql)){
		echo json_encode(array('code'=>200,'msg'=>'Account Successfully Updated!'));
	}else{
	
		echo json_encode(array('code'=>400,'msg'=>mysqli_error($conn)));
	}
}

?>