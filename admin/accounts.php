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
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Create On</th>
                        <th>Status</th>
                        <th>Action</th>
                      </thead>
                      <tbody >
                      <?php 
                        $list = getAccountsList();
                        foreach ($list as $key => $value) {
                          ?>
                      <tr>
                        <td data-title="Firstname"><?=$value['firstname']?></td>
                        <td data-title="Lastname"><?=$value['lastname']?></td>
                        <td data-title="Created At"><?=$value['created_at']?></td>
                        <td data-title="Status" style="text-align: center;width: 50px">
                        <?php 
                            if($value['isDeleted']){
                              
                          ?>
                           <span class="label label-danger">INACTIVE</span>
                          <?php
                          }else{
                          ?>

                        <span class="label label-success">ACTIVE</span>

                          <?php } ?>

                        <td data-title="Actions">
                          <button class="btn btn-sm btn-default edit" id="<?=$value['id']?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
                          <?php 
                            if($value['isDeleted']){
                              
                          ?>
                          <button class="btn btn-sm btn-success recover" id="<?=$value['id']?>" style="background-color:#68dff0 ;border-color:#68dff0"><i class="fa fa-undo"></i></button>
                          <?php
                          }else{
                          ?>
                          <button class="btn btn-sm btn-danger delete" id="<?=$value['id']?>"><i class="fa fa-ban"></i></button>


                          <?php } ?>
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
                      <input class="form-control" type="text" id="firstname" name="firstname" readonly="">
                    </div>                
                    <div class="col-xs-12 col-md-4 col-lg-4 form-group">
                      <label class="labeling" for="lastname">Lastname</label>
                      <input class="form-control" type="text" id="lastname" name="lastname"  readonly="">
                    </div>                
                    <div class="col-xs-12 col-md-3 col-lg-3 form-group">
                      <label class="labeling" for="mi">Middle Name</label>
                      <input class="form-control" type="text" id="mi" name="mi" readonly="">
                    </div>                  
                    <div class="col-xs-12 col-md-4 col-lg-3 form-group">
                      <label class="labeling" for="birthday">Birthday</label>
                      <input class="form-control" type="date" id="birthday" name="birthday" readonly="">
                    </div>                                  
                    <div class="col-xs-12 col-md-4 col-lg-2 form-group">
                      <label class="labeling" for="gender">Gender</label>
                      <select class="form-control" name="gender" id="gender"  readonly="">
                        <option value="">Please Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>                
                    <div class="clearfix"></div>
                    <div class="col-xs-12 col-md-12 col-lg-12 form-group divPassword">
                      <label class="labeling" for="mobile_number" >Mobile Number</label>
                      <input class="form-control" type="text" id="mobile_number" name="mobile_number" readonly="">
                    </div>
                  </div>
        <div class="clearfix"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
              <h1> <center> Are you sure you want to disable this account? </center> </h1>
        </div>
        <div class="clearfix"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" id = "btnDelete" class="btn btn-primary">Yes</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <div class="modal fade " tabindex="-1" role="dialog" id="recoverModal" >
    <div class="modal-dialog modal-lg " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Account Information</h4>
        </div>
        <div class="modal-body">
              <h1> <center> Are you sure you want to recover this account? </center> </h1>
        </div>
        <div class="clearfix"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" id = "btnRecover" class="btn btn-primary">Yes</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

    <!-- js placed at the end of the document so the pages load faster -->
    
	<?php require "../required/scripts.php";?>

	<script>
  var id 
  $(function(){
    $('#mobile_number').mask("639999999999");
    $("#tblList").DataTable();


    $( "#frmUpdateAccount" ).validate({
        rules: {
          mobile_number: {
            required: true,
            maxlength: 12,
            minlength: 12
          }
        }
      });
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
          $('#mobile_number').val(data.mobile_number);
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
    $(".recover").click(function(){
      id = $(this).attr('id')
      $("#recoverModal").modal('show');
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
    $("#btnRecover").click(function(){

      $.ajax({
        url:'../required/api.php',
        data:{
          request:'recoverAccountViaID',
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
/*
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
      mobile_number= $("#mobile_number").val()
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
          password:password,
          mobile_number:mobile_number,
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
*/

function checkPasswordIfMatched(pass1,pass2){
      if(pass1==pass2){
        return true;
      }
        return false;
}
  </script>
	
  

  </body>
</html>
