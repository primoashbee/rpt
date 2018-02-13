<?php 
require "../config.php";
require "../required/functions.php";
session_start();

if(isset($_GET['type'])){
$type = $_GET['type'];
	if($type=="ABOUT"){

		$about = addslashes($_POST['about']);
		$id= addslashes($_POST['slide_id']);
		$sql = "Update cms_info set about ='$about' where id = '$id'";
			
				if(mysqli_query($conn,$sql)){


					$_SESSION['msg']='Content Updated!';
				}else{
					$_SESSION['msg']=mysqli_error($conn);

				}
		header('location:index.php');
		exit;
		
	}elseif($type=="VM"){
			$id = addslashes($_POST['cms_id']);
			$vision = addslashes($_POST['vision']);
			$mission = addslashes($_POST['mission']);
		

			$target_dir = "../website/images";
			$mission_img = "";
			$vision_img ="";

			if($_FILES['vision_img']['name']!=""){
				$vision_img = $target_dir . basename('vision.jpg');
				$check = getimagesize($_FILES["vision_img"]["tmp_name"]);

			    if($check !== false) {
				  
					$info = pathinfo($_FILES['vision_img']['name']);
					var_dump(move_uploaded_file($_FILES['vision_img']['tmp_name'], $target_dir.'/vision.jpg'));
				
				}else{
					$_SESSION['msg']  = 'Vision photo uploaded not an image file';
					header('location:index.php');
					
				}
			}

			if($_FILES['mission_img']['name']!=""){
				$mission_img = $target_dir . basename('mission.jpg');
				$check = getimagesize($_FILES["mission_img"]["tmp_name"]);
			    if($check !== false) {
				  
					$info = pathinfo($_FILES['mission_img']['name']);
					move_uploaded_file($_FILES['mission_img']['tmp_name'], $target_dir.'/mission.jpg');

				}else{
					$_SESSION['msg']  = 'Mission photo uploaded not an image file';
					header('location:index.php');
					exit;
				}
			}

			
			


			$sql = "Update cms_info set vision = '$vision', mission = '$mission' where id = '$id'";
			
				if(mysqli_query($conn,$sql)){


					$_SESSION['msg']='Content Updated!';
				}else{
					$_SESSION['msg']=mysqli_error($conn);

				}
	}elseif($type=="SLIDES"){
		$target_dir = "../website/images";
		$slide_img = "";
			

		if($_FILES['img_url']['name']!=""){
			//$vision_img = $target_dir . basename('wallpaper'.$_POST['slide_id'].'.jpg');
			$check = getimagesize($_FILES["img_url"]["tmp_name"]);

			    if($check !== false) {
				  
					$info = pathinfo($_FILES['img_url']['name']);
					move_uploaded_file($_FILES['img_url']['tmp_name'], $target_dir.'/wallpaper'.$_POST['slide_id'].'.jpg');

					$tagline  =addslashes($_POST['tagline']);
					$subtitle =addslashes($_POST['subtitle']);
					$id =addslashes($_POST['slide_id']);
					$img_url ='website/images/wallpaper'.$_POST['slide_id'].'.jpg';
					$sql = "Update cms_slides set tagline = '$tagline', subtitle ='$subtitle',img_url='$img_url' where id = '$id'";

					if(mysqli_query($conn,$sql)){

						$_SESSION['msg']  = 'Slide succesfully updated';
						
						header('location:index.php');
						exit;
							
					
					}
					
				}else{
					$_SESSION['msg']  = 'Background photo uploaded not an image file';
				
					header('location:index.php');
					exit;
					
				}
				

			
		}else{
			$tagline  =addslashes($_POST['tagline']);
			$subtitle =addslashes($_POST['subtitle']);
			$id =addslashes($_POST['slide_id']);

			$sql = "Update cms_slides set tagline = '$tagline', subtitle ='$subtitle' where id = '$id'";
			
			if(mysqli_query($conn,$sql)){

				$_SESSION['msg']  = 'Slide succesfully updated';
				
				header('location:index.php');
				exit;
					
			
			}
		}
	}elseif($type="NEWS"){

	}
}

	header('location:index.php');

echo 'Invalid Parameters';
exit;
?>
