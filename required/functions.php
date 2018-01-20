<?php 

function activeTabs($needle,$haystack){
	if( strpos( $haystack, $needle ) !== false ) {
    	return 'active';
	}
}
function getLoggedInName(){
	return 'haha';
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
?>