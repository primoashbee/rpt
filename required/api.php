<?php 
session_start();
require "../config.php";
require "functions.php";

$request = addslashes($_POST['request']);

if($request=="getSlideViaID"){
	require "../config.php";
	$id = addslashes($_POST['id']);
	$sql = "Select * from cms_slides where id = '$id'";
	echo json_encode(mysqli_fetch_assoc(mysqli_query($conn,$sql)));
}
if($request=="checkServiceNameIfExists"){
	require "../config.php";
	$service = addslashes($_POST['service']);
	$sql = "Select * from services where service_name = '$service'";
	if(mysqli_num_rows(mysqli_query($conn,$sql))>0){
		echo json_encode(array('code'=>404,'msg'=>'Services already exists'));
	}else{
		$sql = "Insert into services(service_name)value('$service')";
		mysqli_query($conn,$sql);
		echo json_encode(array('code'=>200,'msg'=>'Services successfully added!'));
		
	}
}
if($request=="getNewsViaId"){
	require "../config.php";
	$id = addslashes($_POST['id']);
	$sql = "Select * from news where id = '$id'";
	echo json_encode(mysqli_fetch_assoc(mysqli_query($conn,$sql)));
}
if($request=="checkIfUsernameExists"){
	require "../config.php";
	$username = addslashes($_POST['username']);

	echo checkIfUsernameExists($username);
}
if($request=="checkIfPinTdExists"){
	require "../config.php";
	$pin_td = addslashes($_POST['pin_td']);

	echo checkIfPinTdExists($pin_td);
}
if($request=="getComputeTaxPaymentViaId"){
	$id = addslashes($_POST['id']);
	$sql ="Select p.*, concat(b.name,'/',c.type)  as location_class, format(p.value,2) as p_value from properties p left join class c on p.class_id = c.id left join baranggays b on b.id = p.id where p.id ='$id'";
	
	$info =mysqli_fetch_assoc(mysqli_query($conn,$sql));
	
	$value = $info['value'];

	$tax = $value*$GLOBAL_TAX_RATE;
	$latest_billing =getLatestBillingViaID($id);


	echo json_encode(array(
		'property'=>$info,
		'rate'=>$GLOBAL_TAX_RATE,
		'tax_text'=>(number_format($tax,2)),
		//'year'=>getTaxYearViaId($id),
		'tax'=>intval($tax),
		'billing'=>$latest_billing));

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
		echo json_encode(array('code'=>200,'msg'=>'Account Successfully Disabled!'));
	}else{
	
		echo json_encode(array('code'=>400,'msg'=>mysqli_error($conn)));
	}

}
if($request=="recoverAccountViaID"){
	$id = addslashes($_POST['id']);
	$sql ="update accounts set isDeleted = false where id ='$id'";
	if(mysqli_query($conn,$sql)){
		echo json_encode(array('code'=>200,'msg'=>'Account Successfully Recovered!'));
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
	$mobile_number = addslashes($_POST['mobile_number']);
	$sql = "Update accounts set 
			firstname= '$fname', 
			lastname='$lname', 
			mi = '$mi', 
			birthday ='$birthday', 
			gender ='$gender', 
			password = '$password',
			mobile_number = '$mobile_number'
			where id ='$id'";
	if(mysqli_query($conn,$sql)){
		echo json_encode(array('code'=>200,'msg'=>'Account Successfully Updated!'));
	}else{
	
		echo json_encode(array('code'=>400,'msg'=>mysqli_error($conn)));
	}
}

?>