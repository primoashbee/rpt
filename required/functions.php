<?php 
function getHomePage($isAdmin=false){
	if($isAdmin){
		require "../config.php";
	}else{
		require "config.php";
	}
	//fetch slides
	$sql = "Select * from cms_slides where isDeleted = false";
	$res_cms = mysqli_fetch_all(mysqli_query($conn,$sql),MYSQLI_ASSOC);
	$sql = "Select * from services where isDeleted = false";
	$res_services = mysqli_fetch_all(mysqli_query($conn,$sql),MYSQLI_ASSOC);	
	$sql = "Select * from cms_info ";
	$res_cms_info = mysqli_fetch_assoc(mysqli_query($conn,$sql));
	
	$sql = "Select * from news order by created_at DESC";
	$res_news = mysqli_fetch_all(mysqli_query($conn,$sql),MYSQLI_ASSOC);

	$sql = "Select * from services order by created_at DESC";
	$res_services = mysqli_fetch_all(mysqli_query($conn,$sql),MYSQLI_ASSOC);
	
	$homepage =array('slides'=>$res_cms,'services'=>$res_services,'cms_info'=>$res_cms_info,'news'=>$res_news,'services'=>$res_services);
	return $homepage;
}

function generateAccountNumber(){
	require "../config.php";
	
	$sql="SELECT control_number as ctrl FROM accounts  where isDeleted = false ORDER BY control_number DESC LIMIT 1";
	$res = mysqli_query($conn,$sql);
	if(mysqli_num_rows($res)>0){
		$data = mysqli_fetch_assoc($res);
		$ctrl = $data['ctrl'];
		if(date('Y') == substr($ctrl, 0, 4)){
			$series = substr($ctrl, 5, 14)+1;
			return date('Y').'-'.$series;
			
		}else{
			return date('Y').'-1000000';
			
		}
	}else{
			return date('Y').'-1000000';
		
	}
}

function generatePassword(){
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string

}
function checkIfLoggedInAdmin(){
	if(!isset($_SESSION['user']) && $_SESSION['user']['isAdmin']==false){
		header('location:../index.php');
	}
}
function checkIfLoggedInUser(){;
	if(!isset($_SESSION['user'])){
		header('location:../index.php');
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
function billRemainingPropeties(){
	require "../config.php";
	$year =date('Y');
	$month =date('n');
	$sql = "SELECT p.id FROM properties p WHERE p.id NOT IN (SELECT b.`property_id` FROM bills b WHERE b.`billing_year` = YEAR(CURRENT_TIMESTAMP()))";

	$list = mysqli_fetch_all(mysqli_query($conn,$sql),MYSQLI_ASSOC);
	$rows= (count($list));
	foreach ($list as $key => $value) {
		$id = $value['id'];
		$prop = getPropertyViaID($id);
		$amount = ($prop['value']*$GLOBAL_TAX_RATE);
		$sql = "Insert into bills(property_id,billing_year,billing_month,amount)values('$id','$year','$month','$amount')";
		mysqli_query($conn,$sql);
	}
}
function getPropertyWithStatus($params = array()){

	require "../config.php";
	$sql = "SELECT p.*,b.`amount`,c.`type`,IF(b.`isPaid`=TRUE,'ACTIVE','DELINQUENT') AS `status` FROM bills b LEFT JOIN properties p ON p.`id` = b.`property_id` LEFT JOIN class c ON p.`class_id` = c.id";
	return mysqli_fetch_all(mysqli_query($conn,$sql),MYSQLI_ASSOC);

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
function checkIfPinTdExists($pin_td){
	require "../config.php";
	$pin_td = addslashes($pin_td);
	$sql="Select * from properties where pin_td = '$pin_td'";
		$res = mysqli_query($conn,$sql);
	if(mysqli_num_rows($res)>0){

		return 200;
	}
	return 404;

}
function checkPropertyStatus($property_id){

}
function myReceipts($user_id=""){
	require "../config.php";
	if($user_id==""){
	$sql ="SELECT 
		  p.checkout_id,
		  p.id AS payment_id,
		  b.*,
		  prop.`owner_id` AS owner_id,
		  CONCAT(acc.`firstname`,' ',acc.`lastname`) AS payer_name
		FROM
		  payments p 
		  LEFT JOIN bills b 
		    ON p.billing_id = b.id 
		  LEFT JOIN properties prop 
		    ON b.`property_id` = prop.id 
		   LEFT JOIN accounts acc ON prop.`owner_id` = acc.`id`
		ORDER BY p.created_at DESC ";
	
	}else{
	$sql ="SELECT 
			  p.checkout_id,
			  p.id AS payment_id,
			  b.*,
			  prop.`owner_id` AS owner_id,
			  CONCAT(acc.`firstname`,' ',acc.`lastname`) AS payer_name
			FROM
			  payments p 
			  LEFT JOIN bills b 
			    ON p.billing_id = b.id 
			  LEFT JOIN properties prop 
			    ON b.`property_id` = prop.id 
			   LEFT JOIN accounts acc ON prop.`owner_id` = acc.`id`
 
			where owner_id ='$user_id' order by p.created_at DESC";
	}		

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
function getReceiptViaBillingId($billing_id){
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
		where p.`billing_id` = '$billing_id'";

		return mysqli_fetch_array(mysqli_query($conn,$sql),MYSQLI_ASSOC);


}
function getAccountsList(){
	require "../config.php";
	$sql ="Select * from accounts where isAdmin = 0 ";
	return mysqli_fetch_all(mysqli_query($conn,$sql),MYSQLI_ASSOC);
}
function status($bool){
	if($bool){
		return 'IACTIVE';
	}else{
		return 'ACTIVE';
	}
}
function getProperties(){
	require "../config.php";
	$space = " ";
	$sql ="SELECT p.*, b.`name` as baranggay_name, c.`type` as class_type,CONCAT(a.`firstname`,'$space' ,a.`lastname`) AS owner_name FROM properties p LEFT JOIN baranggays b ON p.`baranggay_id` = b.`id` LEFT JOIN class c ON p.`class_id` =c.`id` LEFT JOIN accounts a ON p.`owner_id` = a.`id` WHERE p.isDeleted = 0";
	return mysqli_fetch_all(mysqli_query($conn,$sql),MYSQLI_ASSOC);
}
function getDelinquentsProperties(){
	require "../config.php";
	$sql ="SELECT p.*,b.isPaid FROM properties p LEFT JOIN bills b ON b.`property_id` = p.id WHERE b.`property_id` IS NULL and b.billing_year=YEAR(CURRENT_TIMESTAMP)";
}
function getActiveProperties(){
	$sql ="SELECT p.*,b.isPaid FROM properties p LEFT JOIN bills b ON b.`property_id` = p.id WHERE b.`property_id` IS NULL and b.billing_year=YEAR(CURRENT_TIMESTAMP)";
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