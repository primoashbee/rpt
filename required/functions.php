<?php 
function checkIfLoggedInAdmin(){
	if(!isset($_SESSION['user']) && $_SESSION['user']['isAdmin']==false){
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

function checkIfUsernameExists($username){
	require "../config.php";
	$sql="Select * from accounts where username = '$username'";
		$res = mysqli_query($conn,$sql);
	if(mysqli_num_rows($res)>0){

		return 200;
	}
	return 404;

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