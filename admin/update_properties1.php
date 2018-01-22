<?php 
require '../config.php';
checkIfLoggedInAdmin();
session_start();
$id = $_POST['property_id'];
$pin_td = addslashes($_POST['pin_td']);
$lot_number = addslashes($_POST['lot_number']);	
$baranggay_id = addslashes($_POST['baranggay_id']);	
$class_id = addslashes($_POST['class_id']);	
$value = addslashes($_POST['value']);	
$lattitude = addslashes($_POST['lattitude']);	
$longitude = addslashes($_POST['longitude']);	

$sql = "Update properties set pin_td='$pin_td', lot_number='$lot_number', baranggay_id='$baranggay_id', class_id='$class_id', value='$value', lattitude ='$lattitude', longitude='$longitude' where id = '$id'";
	if(mysqli_query($conn,$sql)){
		$_SESSION['msg']= 'Property Successfully Updated!';
	}else{
		$_SESSION['msg']= mysqli_error($conn);
	}
	header('location:properties.php');
?>
