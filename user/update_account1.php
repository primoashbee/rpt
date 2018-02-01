<?php
require '../config.php';
session_start();
	$password = $_POST['password'];
	$id = $_SESSION['user']['id'];
	if(!file_exists($_FILES['img_src']['tmp_name']) || !is_uploaded_file($_FILES['img_src']['tmp_name'])) {
		if($password ==""){
				echo 'no PASSWORD';
				
				header('location:update_account.php');
				
		}else{
		$sql ="Update accounts set password ='$password' where id ='$id'";
		if($res = mysqli_query($conn,$sql)){
				$_SESSION['msg'] = 'Account Succesffuly Updated';
				$sql = "Select * from accounts where id ='$id'";
				$res = mysqli_query($conn,$sql);
				$_SESSION['user'] = mysqli_fetch_assoc($res);

				header('location:update_account.php');
			}
		}
		
	}else{
	$target_dir = "../assets/img/avatar/";
	$target_file = $target_dir . basename($id.'.jpg');
	
	    $check = getimagesize($_FILES["img_src"]["tmp_name"]);
	    if($check !== false) {
		  
			$info = pathinfo($_FILES['img_src']['name']);
			$ext = $info['extension']; // get the extension of the file
			$newname = $id.".".$ext; 

			$target = '../assets/img/avatar/'.$newname;
			if($password ==""){

				$sql ="Update accounts set 
				 img_url='$target' where id ='$id'";
			}else{
				$sql ="Update accounts set 
				password ='$password', img_url='$target' where id ='$id'";
			}

			if(mysqli_query($conn,$sql)){
				move_uploaded_file( $_FILES['img_src']['tmp_name'], $target);
				$_SESSION['msg'] = 'Account Succesffuly Upaded';
				$sql="Select * from accounts where id ='$id'";
				$_SESSION['user'] = mysqli_fetch_assoc(mysqli_query($conn,$sql));

				header('location:update_account.php');
			}
	    } else {
	    	echo 'File not an Image';

	    }
	 }
	 echo $sql;

	 ?>