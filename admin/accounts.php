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
            
                <div class="panel panel-default">
                <div class="panel-heading"><h3>Accounts</h3></div>
                <div class="panel-body">
                  <?php 
                      require "../required/alert.php";
                  ?>
                    <h3> List of Accounts</h3>
                    
                    <section id="no-more-tables">
                    <table class="table table-bordered table-striped table-condensed cf" id="tblList">
                      <thead class="cf">
                        <th >Username</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Create On</th>
                        <th>Action</th>
                      </thead>
                      <tbody >
                      <?php 
                        $list = getAccountsList();
                        foreach ($list as $key => $value) {
                          ?>
                      <tr>
                        <td data-title="Username"><?=$value['username']?></td>
                        <td data-title="Firstname"><?=$value['firstname']?></td>
                        <td data-title="Lastname"><?=$value['lastname']?></td>
                        <td data-title="Created At"><?=$value['created_at']?></td>
                        <td data-title="Actions">
                          <button class="btn btn-sm btn-default edit" id="<?=$value['id']?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                          <button class="btn btn-sm btn-danger delete" id="<?=$value['id']?>"><i class="fa fa-trash-o" aria-hidden="true"></i></button>

                        </td>
                      </tr>

                          <?php
                        }
                      ?>
                      </tbody>
                    </table>
                    </section>

                    
                </div>

            </div>
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
        <?php 
          require "../required/footer.php";
        ?>
      <!--footer end-->

  </section>
<form id="frmUpdateAccount">
  <div class="modal fade " tabindex="-1" role="dialog" id="myModal" >
    <div class="modal-dialog modal-lg " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Update Account</h4>
        </div>
        <div class="modal-body">
                    <div class="col-xs-12 col-md-6 col-lg-6 form-group" id="divUsername">
                      <label class="labeling" for="username" id="lblUsername">Username</label>
                      <input class="form-control" type="text" id="username" name="username" readonly="">
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6 form-group">
                      <label class="labeling" for="firstname">Firstname</label>
                      <input class="form-control" type="text" id="firstname" name="firstname"  required="">
                    </div>                
                    <div class="col-xs-12 col-md-6 col-lg-6 form-group">
                      <label class="labeling" for="lastname">Lastname</label>
                      <input class="form-control" type="text" id="lastname" name="lastname"  required="">
                    </div>                
                    <div class="col-xs-12 col-md-1 col-lg-1 form-group">
                      <label class="labeling" for="mi">M.I</label>
                      <input class="form-control" type="text" id="mi" name="mi" >
                    </div>                  
                    <div class="col-xs-12 col-md-4 col-lg-3 form-group">
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
                  </div>
        <div class="clearfix"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</form>

  <div class="modal fade " tabindex="-1" role="dialog" id="deleteModal" >
    <div class="modal-dialog modal-lg " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Account Information</h4>
        </div>
        <div class="modal-body">
              <h1> <center> Are you sure you want to delete this account? </center> </h1>
        </div>
        <div class="clearfix"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" id = "btnDelete" class="btn btn-primary">Yes</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

    <!-- js placed at the end of the document so the pages load faster -->
    
	<?php require "../required/scripts.php";?>

	<script>
  var id 
  $(function(){
    $("#tblList").DataTable();
    $(".edit").click(function(){
      id = $(this).attr('id')
      $.ajax({
        url:'../required/api.php',
        data:{request:'getAccountViaID',id:id},
        dataType:'JSON',
        type:'POST',
        success:function(data){
          $("#myModal").modal('show');
          $('#username').val(data.username);
          $('#firstname').val(data.firstname);
          $('#lastname').val(data.lastname);
          $('#mi').val(data.mi);
          $('#birthday').val(data.birthday);
          $('#gender').val(data.gender);
        }
      });
     
    });
    $(".delete").click(function(){
      id = $(this).attr('id')
      $("#deleteModal").modal('show');
    });
  });

    $("#btnDelete").click(function(){

      $.ajax({
        url:'../required/api.php',
        data:{
          request:'deleteAccountViaID',
          id:id
        },
        dataType:'JSON',
        type:'POST',
        success:function(data){
          if(data.code==200){
            alert(data.msg)
            location.reload()
          }else{
            alert(data.msg)
          }
        }
      })

    })
  $("#frmUpdateAccount").submit(function(e){
    var errors = 0;
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
        return;
      }
      firstname = $("#firstname").val()
      
      lastname = $("#lastname").val()
      mi = $("#mi").val()
      birthday = $("#birthday").val()
      gender = $("#gender").val()
      password= $("#password").val()
      $.ajax({
        url:'../required/api.php',
        data:{
          request:'updateAccountViaID',
          id:id,
          firstname:firstname,
          lastname:lastname,
          mi:mi,
          birthday:birthday,
          gender:gender,
          password:password
        },
        dataType:'JSON',
        type:'POST',
        success:function(data){
          if(data.code==200){
            alert(data.msg)
            location.reload()
          }else{
            alert(data.msg)
          }
        }
      })
      e.preventDefault()  
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
