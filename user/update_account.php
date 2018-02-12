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
<?php require "../required/sidebar-user.php";?>
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
                    <h3 style="text-align:center;font-weight: 900"> Account Information </h3>  
                    <div class="col-xs-12 col-md-6 col-lg-6">
                      <center><img src="<?=$_SESSION['user']['img_url']."?".rand(0,100)?>" class="img-responsive img-circle" id="output" style="max-width:250px;max-height: 250px" width="250px" height="250px">

                      <br>
                      <input type="file" accept="image/*" id="img_src" name="img_src" onchange="loadFile(event)" style="visibility: hidden">
                      <button type="button" id="btnUpload" class="btn btn-sm btn-warning">Change Profile Photo</button>
                    </center>
                      <script>
                      var loadFile = function(event) {
                        var output = document.getElementById('output');
                        output.src = URL.createObjectURL(event.target.files[0]);
                      };
                    </script>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6 form-group" id="divUsername">
                      <label class="labeling" for="username" id="lblUsername">Username</label>
                      <input class="form-control" type="text" id="username" name="username"  readonly value="<?=$_SESSION['user']['username']?>" required="">
                    </div>
                    <div class="col-xs-12 col-md-3 col-lg-3 form-group">
                      <label class="labeling" for="firstname">Firstname</label>
                      <input class="form-control" type="text" id="firstname" name="firstname" value="<?=$_SESSION['user']['firstname']?>" required="">
                    </div>                
                    <div class="col-xs-12 col-md-3 col-lg-3 form-group">
                      <label class="labeling" for="lastname">Lastname</label>
                      <input class="form-control" type="text" id="lastname" name="lastname" value="<?=$_SESSION['user']['lastname']?>"  required="">
                    </div>                
                    <div class="col-xs-12 col-md-4 col-lg-4 form-group">
                      <label class="labeling" for="mobile_number">Mobile Number (eg 639171234567)</label>
                      <input class="form-control" type="text" id="mobile_number" name="mobile_number" value="<?=$_SESSION['user']['mobile_number']?>" required="">
                    </div>                
                    <div class="col-xs-12 col-md-2 col-lg-2 form-group">
                      <label class="labeling" for="mi">Middle Initial</label>
                      <input class="form-control" type="text" id="mi" name="mi" value="<?=$_SESSION['user']['mi']?>">
                    </div>                  
                    <div class="col-xs-12 col-md-3 col-lg-3 form-group">
                      <label class="labeling" for="birthday">Birthday</label>
                      <input class="form-control" type="date" id="birthday" name="birthday" value="<?=$_SESSION['user']['birthday']?>" required="">
                    </div>                                  
                    <div class="col-xs-12 col-md-3 col-lg-3 form-group">
                      <label class="labeling" for="gender">Gender</label>
                      <select class="form-control" name="gender" id="gender"  required="">
                        <option value="">Please Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>                
                    <div class="col-xs-12 col-md-3 col-lg-3 form-group divPassword">
                      <label class="labeling" for="password" id="lblPassword">Password</label>
                      <input class="form-control" type="password" id="password" name="password"  >
                    </div>
                    <div class="col-xs-12 col-md-3 col-lg-3 form-group divPassword">
                      <label class="labeling" for="password_confirm">Confirm Password</label>
                      <input class="form-control" type="password" id="password_confirm" name="password_confirm">
                    </div>
                    <div class="col-xs-12 col-lg-offset-6  col-md-offset-6" style="margin-top:15px">
                      <input type="submit"  class="btn btn-lg btn-success" style="width: 50%">
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
      $(function(){
        $('#gender').val('<?=$_SESSION['user']['gender']?>');

        $('#mobile_number').mask("639999999999");
        $('#birthday').blur(function(){
            dob = $(this).val()
            str_dob = getDob(dob)
            validateBirth(str_dob)
        })
      
      })
       $( "#frmCreateAccount" ).validate({
        rules: {
          mobile_number: {
            required: true,
            maxlength: 12,
            minlength: 12
          }
        }
      });
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
