<?php 
	require "../config.php";
	require "../required/functions.php";
	session_start();
if(isset($_GET['type'])){
	$type = $_GET['type'];
	if($type=="create"){
		$headline = addslashes($_POST['headline']);
		$body = addslashes($_POST['body']);
		$sql = "Insert into news(headline,body)values('$headline','$body')";
			
		if(mysqli_query($conn,$sql)){


			$_SESSION['msg']=' News Published!';
		}else{
			$_SESSION['msg']=mysqli_error($conn);

		}
		header('location:index.php');
		exit;
	}
}
?>