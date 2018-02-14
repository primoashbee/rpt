<?php
require __DIR__  . '../../vendor/autoload.php';
	require "../config.php";
	require "../required/functions.php";


use Coreproc\Chikka\ChikkaClient;
use Coreproc\Chikka\Models\Sms;
use Coreproc\Chikka\Transporters\SmsTransporter;
	session_start();
	checkIfLoggedInAdmin();
	$username = addslashes($_POST['username']);
	//$pass = addslashes($_POST['password']);
	$oldpass  = generatePassword();
	$password = password_hash($oldpass,PASSWORD_DEFAULT);
	echo $oldpass;
	$fname = addslashes($_POST['firstname']);
	$lname = addslashes($_POST['lastname']);
	$bday = addslashes($_POST['birthday']);
	$gender = addslashes($_POST['gender']);
	$mi = addslashes($_POST['mi']);

	$lot_num = addslashes($_POST['lot_number']);
	$pin_td = addslashes($_POST['pin_td']);
	$baranggay_id = addslashes($_POST['baranggay_id']);
	$class_id = addslashes($_POST['class_id']);
	$value = addslashes($_POST['value']);
	$mobile_number = addslashes($_POST['mobile_number']);

	$lattitude = addslashes($_POST['lattitude']);
	$longitude = addslashes($_POST['longitude']);
	/*
	$sql = "Insert into accounts(username,`password`,firstname,lastname,mi,birthday,gender)values('".$username."','".$password."','".$fname."','".$lname."','".$bday."','".$gender."')";
		if($flag = mysqli_query($conn,$sql)){
			$_SESSION['msg'] = "Account Successfully Created";
    		
    		header('location:create_account.php');
		}
		echo 'Something went wrong';

	*/
	/*
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

*/


	if(checkIfUsernameExists($username)==200){
		$_SESSION['msg']  = 'USERNAME ALREADY TAKEN'; 
		header('location:create_accounts.php');
		exit;
	}
	if(checkIfPinTdExists($pin_td)==200){
		$_SESSION['msg']  = 'PIN/TD ALREADY TAKEN'; 
		header('location:create_accounts.php');
		exit;
	}

	$ctrl_number = generateAccountNumber();
	$sql = "Insert into accounts(firstname,lastname,mi,birthday,username,password,gender,mobile_number,control_number)
	values('$fname','$lname','$mi','$bday','$username','$password','$gender','$mobile_number','$ctrl_number')";

	if(mysqli_query($conn,$sql)){
	$acc_id = mysqli_insert_id($conn);
	$sql = "Insert into properties(lot_number,pin_td,baranggay_id,class_id,value,owner_id,lattitude,longitude)values(
		'$lot_num','$pin_td','$baranggay_id','$class_id','$value','$acc_id','$lattitude','$longitude')";
	
		if(mysqli_query($conn,$sql)){
		$name = $fname.' '.$lname;
		$msg = 
		"Good Day, $name Your account is now created on $GLOBAL_WEBSITE_NAME! 
		Here are your credentials.
		Username: $username. Password: $oldpass ";
  
		$clientId = '07a28c3017c007c0e318b6a1b4e0abff44dd23b1b88a5d360b75a268ac30374e';
		$secretKey = 'b73fd9702ab4d553d71585b1c7ce9eb149e1a42964ced1bbaa1bba13d911607f';
		$shortCode = '29290951011';




		$chikkaClient = new ChikkaClient($clientId, $secretKey, $shortCode);

		$sms = new Sms(rand(0,100000),$mobile_number, $msg);

		$smsTransporter = new SmsTransporter($chikkaClient, $sms);

		$response = $smsTransporter->send();
		if($response->status==200){

		}
			$_SESSION['msg'] = "Account Succesfully Created!";
		}else{
			$sql="Delete from accounts where id = '$acc_id";
			mysqli_conn($conn,$sql);

			$_SESSION['msg'] = mysqli_error($conn);
		}
	}else{
			$_SESSION['msg'] = mysqli_error($conn);
		
	}

	header("location:create_accounts.php");
?>