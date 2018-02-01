<?php 
require "../config.php";
require "../required/functions.php";
session_start();
if(isset($_GET['type'])){
$type = $_GET'type'];
	if($type="CMS"){
	$id = addslashes($_POST['cms_id']);
	$vision = addslashes($_POST['vision']);
	$mission = addslashes($_POST['mission']);
	$about = addslashes($_POST['about']);


	$sql = "Update cms_info set vision = '$vision', mission = '$mission', about ='$about' where id = '$id'";
		if(mysqli_query($conn,$sql)){
			$_SESSION['msg']='Content Updated!';
		}else{
			$_SESSION['msg']=mysqli_error($conn);

		}
	}elseif($type="SLIDES"){

		

	}

	header('location:index.php');
}
echo 'Invalid Parameters';
exit;
?>
