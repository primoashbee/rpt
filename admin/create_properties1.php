<?php 
	require '../config.php';
	session_start();

	$params = $_POST;
	$sql="Insert into properties";
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
		$_SESSION['msg'] = "Property Succesfully Created!";
	}else{
		$_SESSION['msg'] = mysqli_error($conn);
	}
	
	header("location:create_properties.php");

?>