<?php 
session_start();
?>
<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>AMILYAR PAYMENT - SIGN IN</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
	  	
		      <form class="form-login" action="login1.php" method="POST">
		        <h2 class="form-login-heading">Enter your credentials</h2>
		        <div class="login-wrap">
		        	
                    <?php
                      if(isset($_SESSION['msg'])){
                        
                        ?>
                          <div class="alert alert-danger fade in " style="margin-top:18px;">
                              <center><strong>Alert!</strong></center>
                              <center><h4 style="font-weight:900"><?=$_SESSION['msg'];?></h4></center>
                          </div>
                        <?php
                        unset($_SESSION['msg']);
                      }
                    ?>  
		            <input type="text" class="form-control"  name="username" placeholder="Username" autofocus>
		            <br>
		            <input type="password" class="form-control" name="password"  placeholder="Password">
		            <!--<label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="login.html#myModal"> Forgot Password?</a>
		
		                </span>
		            </label>!--><br>
		            <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
		            <hr>
		            
		            <div class="login-social-link centered">
		            <p>If you forgot your password</p>
		             <p> Contact the system Administrator </p>
		            </div>
		           
		
		        </div>
		
		      </form>	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/login-bg.jpg", {speed: 500});
    </script>


  </body>
</html>
