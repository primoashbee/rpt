<?php 
function checkIfLoggedInAdmin(){
	if(!isset($_SESSION['user']) && $_SESSION['user']['isAdmin']==false){
		header('location:../login.php');
	}
}
function checkIfLoggedInUser(){;
	if(!isset($_SESSION['user'])){
		header('location:../login.php');
	}
}
function activeTabs($needle,$haystack){
	if( strpos( $haystack, $needle ) !== false ) {
    	return 'active';
	}
}
function getLoggedInName(){

	if($_SESSION['user']['isAdmin']){
		return 'ADMINISTRATOR';
	}else{
		return $_SESSION['user']['firstname']." ".$_SESSION['user']['lastname'];
	}
}
function getTaxYearViaId($id){
	require "../config.php";
	return;
	$sql ="Select * from bills where property_id = '$id' and isPaid = 0 order by created_at DESC";
	if(mysqli_num_rows($res = mysqli_query($conn,$sql))>0){
		$isPaid = mysqli_fetch_array($res)['isPaid'];
		if($isPaid){
			return 'Already Paid';
			
		}else{
			return date('Y');
		}
		
	}else{
		// if there is no billing, insert billing for current year		

		$property = getPropertyViaID($id);
		$year =date('Y');
		$month =date('n');
		$amount = ($property['value']*$GLOBAL_TAX_RATE);

		$sql = "Insert into bills(property_id,billing_year,billing_month,amount)values('$id','$year','$month','$amount')";
		
		mysqli_query($conn,$sql);

		$sql ="Select * from bills where property_id = '$id' order by created_at DESC";
		$res = mysqli_query($conn,$sql);
		$year = mysqli_fetch_array($res)['billing_year']+1;
		if($year > date('Y')){
			return 'NOT YEAR ISSUED';
			
		}else{
			return $year;
		}
		
	}
	return '2017';

}
function getLatestBillingViaID($id){
	require "../config.php";
	$year =date('Y');
	$month =date('n');
	$sql = "Select * from bills where property_id ='$id' and billing_year = '$year'  order by created_at DESC";
	
/*
	//if wala pang billing, gawa ng billing statement
	if(mysqli_num_rows($res = mysqli_query($conn,$sql))>0){
		//Check is paid this current year
		$data = mysqli_fetch_array($res);
		
		if($data['isPaid']){
			return $data;

		}else{
		$property = getPropertyViaID($id);
		
		$amount = ($property['value']*$GLOBAL_TAX_RATE);

		$sql = "Insert into bills(property_id,billing_year,billing_month,amount)values('$id','$year','$month','$amount')";
		
		mysqli_query($conn,$sql);

		$sql ="Select * from bills where property_id = '$id' order by created_at DESC";
		$res = mysqli_query($conn,$sql);
		return mysqli_fetch_array($res);
		}
	}
	return mysqli_fetch_array(mysqli_query($conn,$sql));*/

	if(mysqli_num_rows($res = mysqli_query($conn,$sql))>0){
		$data = mysqli_fetch_array($res);
		
			return $data;
		
	}else{
		
		$property = getPropertyViaID($id);
		$amount = ($property['value']*$GLOBAL_TAX_RATE);
		$sql = "Insert into bills(property_id,billing_year,billing_month,amount)values('$id','$year','$month','$amount')";
		mysqli_query($conn,$sql);
		$sql ="Select * from bills where property_id = '$id' order by created_at DESC";
		$res = mysqli_query($conn,$sql);
		return mysqli_fetch_array($res);
		
	}



}

function checkoutPayment($billing_id,$checkoutID){
	require "../config.php";
	$sql="Select * from payments where billing_id = '$billing_id'";
	if(mysqli_num_rows(mysqli_query($conn,$sql))>0){
		return 'Billing ID Expired';
		exit;
	}

	$sql="Update bills set isPaid = true where id = '$billing_id'";
	mysqli_query($conn,$sql);

	$sql ="Insert into payments(billing_id,checkout_id)values('$billing_id','$checkoutID')";
	if(mysqli_query($conn,$sql)){
		return true;
	}
	return false;


}
function getPropertyViaID($id){
	require "../config.php";
	$sql ="Select * from properties where id ='$id'";
	
	$account =mysqli_fetch_assoc(mysqli_query($conn,$sql));
	return $account;
}
function checkIfUsernameExists($username){
	require "../config.php";
	$sql="Select * from accounts where username = '$username'";
		$res = mysqli_query($conn,$sql);
	if(mysqli_num_rows($res)>0){

		return 200;
	}
	return 404;

}
function myReceipts($user_id){
	require "../config.php";
	$sql ="SELECT p.checkout_id,p.id AS payment_id,b.*,prop.`owner_id` as owner_id FROM payments p LEFT JOIN bills b ON p.billing_id = b.id  LEFT JOIN properties prop ON b.`property_id`=prop.id where owner_id ='$user_id'";
	return mysqli_fetch_all(mysqli_query($conn,$sql),MYSQLI_ASSOC);
}
function getReceiptViaPaymentID($payment_id){
	require "../config.php";
	$sql = "SELECT 
		p.`id` AS payment_id,
		p.`checkout_id`,
		b.`property_id`,
		b.`amount`,
		b.id AS billing_id,
		b.`billing_year`,
		b.`billing_month`,
		p.`created_at`,
		prop.id AS property_id,
		prop.`lot_number`,
		prop.`owner_id`,
		prop.`lot_number`,
		prop.`pin_td`,
		prop.`value`,
		a.`firstname`,
		a.`lastname`,
		a.`mobile_number`,
		br.`name`,
		c.`type`
		FROM
		payments p 
		LEFT JOIN bills b 
		ON b.`id` = p.`billing_id` 
		LEFT JOIN properties prop 
		ON prop.`id` = b.`property_id` 
		LEFT JOIN accounts a 
		ON a.`id` = prop.`owner_id` 
		LEFT JOIN class c 
		ON prop.`class_id` = c.id
		LEFT JOIN baranggays br
		ON prop.`baranggay_id` = br.`id`
		where p.id = '$payment_id'";

		return mysqli_fetch_array(mysqli_query($conn,$sql),MYSQLI_ASSOC);


}
function getAccountsList(){
	require "../config.php";
	$sql ="Select * from accounts where isAdmin = 0 and isDeleted = 0";
	return mysqli_fetch_all(mysqli_query($conn,$sql),MYSQLI_ASSOC);
}
function getProperties(){
	require "../config.php";
	$space = " ";
	$sql ="SELECT p.*, b.`name` as baranggay_name, c.`type` as class_type,CONCAT(a.`firstname`,'$space' ,a.`lastname`) AS owner_name FROM properties p LEFT JOIN baranggays b ON p.`baranggay_id` = b.`id` LEFT JOIN class c ON p.`class_id` =c.`id` LEFT JOIN accounts a ON p.`owner_id` = a.`id` WHERE p.isDeleted = 0";
	return mysqli_fetch_all(mysqli_query($conn,$sql),MYSQLI_ASSOC);
}
function getMyProperties($id){
	require "../config.php";
	$space = " ";
	$sql ="SELECT p.*, b.`name` as baranggay_name, c.`type` as class_type,CONCAT(a.`firstname`,'$space' ,a.`lastname`) AS owner_name FROM properties p LEFT JOIN baranggays b ON p.`baranggay_id` = b.`id` LEFT JOIN class c ON p.`class_id` =c.`id` LEFT JOIN accounts a ON p.`owner_id` = a.`id` WHERE p.isDeleted = 0 and p.owner_id = '$id'";
	return mysqli_fetch_all(mysqli_query($conn,$sql),MYSQLI_ASSOC);
}
function getBaranggayCollection(){
	require "../config.php";
	$sql="Select * from baranggays where isDeleted = false order by name  ASC";
	return mysqli_fetch_all(mysqli_query($conn,$sql),MYSQLI_ASSOC);
}
function getClassList(){
	require "../config.php";
	$sql="Select * from class where isDeleted = false order by type  ASC";
	return mysqli_fetch_all(mysqli_query($conn,$sql),MYSQLI_ASSOC);
}

?>