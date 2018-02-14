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
                      <label class="labeling" for="account_number" id="lblAccountNumber">Account #:</label>
                      <input class="form-control" type="text" id="account_number" value="<?=generateAccountNumber()?>" name="account_number" required="" readonly="">
                    </div>
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
                      <label class="labeling" for="mobile_number">Mobile Number (eg 639171234567)</label>
                      <input class="form-control" type="number" id="mobile_number" name="mobile_number" 
                      pattern="/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/" 
                      required="">
                    </div>                
                    <div class="col-xs-12 col-md-2 col-lg-2 form-group">
                      <label class="labeling" for="mi">Middle Name</label>
                      <input class="form-control" type="text" id="mi" name="mi" required="">
                    </div>                  
                    <div class="col-xs-12 col-md-4 col-lg-4 form-group" id="divBirthday">
                      <label class="labeling" for="birthday" id="lblBirthday">Birthday</label>
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
                    
                    <h3 class="hidden"> Account Information </h3>  
                    <div class="col-xs-12 col-md-4 col-lg-4 form-group divPassword hidden" >
                      <label class="labeling" for="password" id="lblPassword">Password</label>
                      <input class="form-control" type="password" id="password" name="password"  required="">
                    </div>
                    <div class="col-xs-12 col-md-4 col-lg-4 form-group divPassword hidden">
                      <label class="labeling" for="password_confirm">Confirm Password</label>
                      <input class="form-control" type="password" id="password_confirm" name="password_confirm"  required="">
                    </div>
                    
                    <div class="clearfix"></div>
                    <hr>
                    <h3> Property Information </h3>
                    <div class="col-xs-12 col-md-6 col-lg-6 form-group" id="divPINTD">
                      <label class="labeling" for="pin_td" id="lblPINTD">PIN/TD</label>
                      <input class="form-control" type="text" id="pin_td" name="pin_td" required placeholder="PIN/TD">
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6 form-group">
                      <label class="labeling" for="lot_number">Lot #</label>
                      <input class="form-control" type="text" id="lot_number" name="lot_number"  required="" placeholder="Lot #">
                    </div>            

                    <div class="col-xs-12 col-md-4 col-lg-4 form-group">
                      <label class="labeling" for="baranggay_id">Baranggay</label>
                      <select class="form-control" name="baranggay_id" id="baranggay_id"  required="">
                        <option value="">Please Select</option>
                            <?php 
                                $data = getBaranggayCollection();
                                foreach($data as $key=>$value){
                                  ?>
                                    <option value="<?=$value['id']?>"><?=html_entity_decode($value['name'])?></option>
                                  <?php
                                  
                                }
                            ?>
                      </select>
                    </div>       
                    
                    <div class="col-xs-12 col-md-4 col-lg-4 form-group">
                      <label class="labeling" for="class_id">Class</label>
                      <select class="form-control" name="class_id" id="class_id"  required="">
                        <option value="">Please Select</option>
                              <?php 
                                $data = getClassList();
                                foreach($data as $key=>$value){
                                  ?>
                                    <option value="<?=$value['id']?>"><?=html_entity_decode($value['type'])?></option>
                                  <?php
                                  
                                }
                            ?>
                      </select>
                    </div>       

                    <div class="col-xs-12 col-md-4 col-lg-4 form-group">
                      <label class="labeling" for="value">Asesssed Value</label>
                      <input class="form-control" type="text" id="value" name="value"  required="" placeholder="Asesssed Value">
                    </div>                
                    <div class="col-xs-12 col-md-12 col-lg-12 form-group">
                           <iframe src="sample.php" width="100%" height="500px" id="frameMap""></iframe>
                    </div>                
                    <input type ="hidden" name="lattitude" id="lattitude">
                    <input type ="hidden" name="longitude" id="longitude">
                    <input type ="hidden" name="owner_id" id="owner_id">
                    <input type="submit" value="submit" class="btn btn-success  ">
                  </div>
                  
          </form>

          
          </section>
      </section>

  

    <!-- js placed at the end of the document so the pages load faster -->
    
	<?php require "../required/scripts.php";?>

  <script>
    function getDob(dob){
      var str = dob
      var new_str="";
      var ctr = 0;
      $.each(str,function(k,v){
        if(str[ctr]=="-"){
          new_str = new_str+"";
        }else{
          new_str = new_str+str[ctr];
        }

      ctr++
      });
      return new_str;
    }
    function validateBirth(dob_string){
      var year = Number(dob.substr(0, 4));
    var month = Number(dob.substr(4, 2)) - 1;
    var day = Number(dob.substr(6, 2));
    var today = new Date();
    var age = today.getFullYear() - year;
      if (today.getMonth() < month || (today.getMonth() == month && today.getDate() < day)) {
        age--;
     
      }
      if(age < 18){
     
        $('#divBirthday').addClass('has-error')
        $('#lblBirthday').html('Birthday (Must be atleast 18 years old)')
        return false;
      }else if(age > 90){
        $('#divBirthday').addClass('has-error')
        $('#lblBirthday').html('Birthday (Overage)')
        return false;
        
      }

        $('#divBirthday').removeClass('has-error')

        $('#lblBirthday').html('Birthday')
        return true;
    }
    $(function(){
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
      $.ajax({
          url:'../required/api.php',
          data:{request:'checkIfUsernameExists',username:$('#username').val()},
          type:'POST',
          success:function(data){
            console.log(data)
            if(data==200){
              $("#divUsername").addClass('has-error')
              $("#lblUsername").html('Username (Username already existing)')
              errors++
            }else{
              console.log('pwede')
              $("#divUsername").removeClass('has-error')
              $("#lblUsername").html('Username')}
            
          }
        })
        $.ajax({
          url:'../required/api.php',
          data:{request:'checkIfPinTdExists',pin_td:$('#pin_td').val()},
          type:'POST',
          success:function(data){
            console.log(data)
            if(data==200){
              $("#divPINTD").addClass('has-error')
              $("#lblPINTD").html('PIN/TD (PIN/TD already existing)')
              errors++
            }else{
              console.log('pwede')
              $("#divPINTD").removeClass('has-error')
              $("#lblPINTD").html('PIN/TD')}
            
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
      var lat = $('#frameMap').contents().find('#lat').val()
      var long = $('#frameMap').contents().find('#long').val()
      $('#longitude').val(long);
      $('#lattitude').val(lat);
      var dob = $("#birthday").val()

      if(!validateBirth(dob)){
        errors++;
      }
      if(errors>0){
        return;
      }

      if(lat =="" || long==""){
        alert('Location position of building using the map')
        //e.preventDefault()
        return;
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
