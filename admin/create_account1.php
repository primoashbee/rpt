<?php
	
	require "../config.php";
	require "../required/functions.php";
	session_start();
	checkIfLoggedInAdmin();
	$username = addslashes($_POST['username']);
	$password = addslashes($_POST['password']);
	$fname = addslashes($_POST['firstname']);
	$lname = addslashes($_POST['lastname']);
	$bday = addslashes($_POST['birthday']);
	$gender = addslashes($_POST['gender']);
	$mi = addslashes($_POST['mi']);
	/*
	$sql = "Insert into accounts(username,`password`,firstname,lastname,mi,birthday,gender)values('".$username."','".$password."','".$fname."','".$lname."','".$bday."','".$gender."')";
		if($flag = mysqli_query($conn,$sql)){
			$_SESSION['msg'] = "Account Successfully Created";
    		
    		header('location:create_account.php');
		}
		echo 'Something went wrong';

	*/
	$params = $_POST;
	$sql="Insert into accounts";
	$keys="(";
	$ctr = 0;
	$total  = count($_POST);
	$values ="(";
	foreach ($params as $key =>$value) {
		if($ctr==0){
			$keys.="`".$key."`";
			$values.="'".addslashes($value)."'";

		}else{
			if(!$value==""){
				$keys.=", `".$key."`";
				$values.=", '".addslashes($value)."'";
			}
		}
		$ctr++;
	}
	$keys=$keys.')';
	$values=$values.')';
	$sql = $sql.$keys." VALUES ".$values;

	if(mysqli_query($conn,$sql)){
		$_SESSION['msg'] = "Account Succesfully Created!";
	}else{
		$_SESSION['msg'] = mysqli_error($conn);
	}
	echo $_SESSION['msg'];
	header("location:create_accounts.php");
?>