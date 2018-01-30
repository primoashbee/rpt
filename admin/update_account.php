<?php 
require "../config.php";
require "../required/functions.php";
session_start();
checkIfLoggedInAdmin();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>
    <?php require "../required/head.php";?>
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
<?php require "../required/navbar.php";?>
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
<?php require "../required/sidebar.php";?>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          <div style="margin-top:15px"></div>
          <form action="update_account1.php" method="POST" id="frmCreateAccount" enctype="multipart/form-data">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Create Accounts</h3></div>
                <div class="panel-body">
                  <?php 
                      require "../required/alert.php";
                  ?>
                    <h3> Account Information </h3>  
                    <div class="col-xs-12 col-md-6 col-lg-6">
                      <center><img src="<?=$_SESSION['user']['img_url']."?".rand(0,100)?>" class="img-responsive img-circle" id="output" style="max-width:250px;max-height: 250px" width="250px" height="250px">

                      <br>
                      <input type="file" accept="image/*" id="img_src" name="img_src" onchange="loadFile(event)" style="visibility: hidden">
                      <button type="button" id="btnUpload" class="btn btn-sm btn-warning">Change Profile Photo</button>
                      <script>
                      var loadFile = function(event) {
                        var output = document.getElementById('output');
                        output.src = URL.createObjectURL(event.target.files[0]);
                      };
                    </script>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6 form-group" id="divUsername">
                      <label class="labeling" for="username" id="lblUsername">Username</label>
                      <input class="form-control" type="text" id="username" name="username"  readonly value="<?=$_SESSION['user']['username']?>"required="">
                    </div>
                  
                    <div class="col-xs-12 col-md-4 col-lg-6 form-group divPassword">
                      <label class="labeling" for="password" id="lblPassword">Password</label>
                      <input class="form-control" type="password" id="password" name="password"  >
                    </div>
                    <div class="col-xs-12 col-md-4 col-lg-6 form-group divPassword">
                      <label class="labeling" for="password_confirm">Confirm Password</label>
                      <input class="form-control" type="password" id="password_confirm" name="password_confirm">
                    </div>
                    <div class="col-xs-12 col-lg-4 col-md-6" style="margin-top:15px">
                      <input type="submit"  class="btn btn-lg btn-success">
                    </div>

                </div>

            </div>

          </form>
          
          </section>
      </section>
      <!--main content end-->
      <!--footer start-->
      <?php require "../required/footer.php" ?>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    
	<?php require "../required/scripts.php";?>

  <script>
      $("#frmCreateAccount").submit(function(e){
      var errors = 0
      
      
      
      if(!checkPasswordIfMatched($("#password").val(),$('#password_confirm').val())){
        $('#lblPassword').html('Password (Password must match)');
        $('.divPassword').addClass('has-error')
        errors++
      }else{
        $('#lblPassword').html('Password ');
        $('.divPassword').removeClass('has-error')
      }

      if(errors>0){
        e.preventDefault()
      }
      $('#password_confirm').attr('disabled','disabled');

    })

  
    function checkPasswordIfMatched(pass1,pass2){
      if(pass1==pass2){
        return true;
      }
        return false;

    }

    $("#btnUpload").click(function(){
      $('#img_src').click();
    })
  </script>

	
	
  

  </body>
</html>
