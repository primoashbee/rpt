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
          <form action="create_account1.php" method="POST" id="frmCreateAccount">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Create Accounts</h3></div>
                <div class="panel-body">
                  <?php 
                      require "../required/alert.php";
                  ?>
                    <h3> Personal Information </h3>

                    <div class="col-xs-12 col-md-4 col-lg-4 form-group" id="divUsername">
                      <label class="labeling" for="username" id="lblUsername">Username</label>
                      <input class="form-control" type="text" id="username" name="username" required="">
                    </div>
                    <div class="col-xs-12 col-md-4 col-lg-4 form-group">
                      <label class="labeling" for="firstname">Firstname</label>
                      <input class="form-control" type="text" id="firstname" name="firstname"  required="">
                    </div>                
                    <div class="col-xs-12 col-md-4 col-lg-4 form-group">
                      <label class="labeling" for="lastname">Lastname</label>
                      <input class="form-control" type="text" id="lastname" name="lastname"  required="">
                    </div>                
                    <div class="col-xs-12 col-md-4 col-lg-4 form-group">
                      <label class="labeling" for="mobile_number">Mobile Number</label>
                      <input class="form-control" type="text" id="mobile_number" name="mobile_number"  required="">
                    </div>                
                    <div class="col-xs-12 col-md-2 col-lg-2 form-group">
                      <label class="labeling" for="mi">Middle Initial</label>
                      <input class="form-control" type="text" id="mi" name="mi" >
                    </div>                  
                    <div class="col-xs-12 col-md-4 col-lg-4 form-group">
                      <label class="labeling" for="birthday">Birthday</label>
                      <input class="form-control" type="date" id="birthday" name="birthday"  required="">
                    </div>                                  
                    <div class="col-xs-12 col-md-4 col-lg-2 form-group">
                      <label class="labeling" for="gender">Gender</label>
                      <select class="form-control" name="gender" id="gender"  required="">
                        <option value="">Please Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>                
                    <div class="clearfix"></div>
                    <hr>
                    <h3> Account Information </h3>  
                    <div class="col-xs-12 col-md-4 col-lg-4 form-group divPassword">
                      <label class="labeling" for="password" id="lblPassword">Password</label>
                      <input class="form-control" type="password" id="password" name="password"  required="">
                    </div>
                    <div class="col-xs-12 col-md-4 col-lg-4 form-group divPassword">
                      <label class="labeling" for="password_confirm">Confirm Password</label>
                      <input class="form-control" type="password" id="password_confirm" name="password_confirm"  required="">
                    </div>
                    <div class="col-xs-12 col-lg-4 col-md-4" style="margin-top:15px">
                      <input type="submit"  class="btn btn-lg btn-success">
                    </div>

                </div>

            </div>

          </form>
          
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer" style="  background: #ffab62;
  width: 100%;
  position: absolute;
  bottom: 0;
  left: 0;">
          <div class="text-center">
              <?= $footer_text ?>
              
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    
	<?php require "../required/scripts.php";?>

  <script>
      $("#frmCreateAccount").submit(function(e){
      var errors = 0
      
      $.ajax({
          url:'../required/api.php',
          data:{request:'checkIfUsernameExists',username:$('#username').val()},
          type:'POST',
          success:function(data){
            console.log(data)
            if(data==200){
              console.log('existing')
              $("#divUsername").addClass('has-error')
              $("#lblUsername").html('Username (Username already existing)')
              errors++
            }else{
              console.log('pwede')
              $("#divUsername").removeClass('has-error')
              $("#lblUsername").html('Username')}
            
          }
        })
      
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
      $('#password_confirm').attr('disabled','disabled');

    })

  
    function checkPasswordIfMatched(pass1,pass2){
      if(pass1==pass2){
        return true;
      }
        return false;
    }
  </script>

	
	
  

  </body>
</html>
