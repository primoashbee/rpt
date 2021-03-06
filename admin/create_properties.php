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
                <div class="panel-heading"><h3>Property</h3></div>
                <div class="panel-body">
                  <?php 
                      require "../required/alert.php";
                  ?>
                    <h3> Create Property</h3>
                    
                    <section id="no-more-tables">
                    <table class="table table-bordered table-striped table-condensed cf" id="tblList">
                      <thead class="cf">
                        <th >Username</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
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
                        <td data-title="Actions">
                          <button class="btn btn-sm btn-default edit" id="<?=$value['id']?>"><i class="fa fa-plus" aria-hidden="true"></i></button>

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
<form id="frmUpdateAccount" action="create_properties1.php" method ="POST">
  <div class="modal fade " tabindex="-1" role="dialog" id="myModal" >
    <div class="modal-dialog modal-lg " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Create Property</h4>
        </div>
        <div class="modal-body">
                    <div class="col-xs-12 col-md-4 col-lg-4 form-group" id="divUsername">
                      <label class="labeling" for="pin_td" id="lblUsername">PIN/TD</label>
                      <input class="form-control" type="text" id="pin_td" name="pin_td" required placeholder="PIN/TD">
                    </div>
                    <div class="col-xs-12 col-md-4 col-lg-4 form-group">
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

                    <div class="col-xs-12 col-md-6 col-lg-6 form-group">
                      <label class="labeling" for="value">Asesssed Value</label>
                      <input class="form-control" type="text" id="value" name="value"  required="" placeholder="Asesssed Value">
                    </div>                
                    <div class="col-xs-12 col-md-6 col-lg-6 form-group">
                           <iframe src="sample.php" width="850px" height="500px" id="frameMap""></iframe>
                    </div>                
                    <input type ="hidden" name="lattitude" id="lattitude">
                    <input type ="hidden" name="longitude" id="longitude">
                    <input type ="hidden" name="owner_id" id="owner_id">
        
        </div>

        <div class="clearfix"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Create Property</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</form>



    <!-- js placed at the end of the document so the pages load faster -->
    
  <?php require "../required/scripts.php";?>

  <script>
  var id 
  $(function(){
    $("#tblList").DataTable();



    $(".edit").click(function(){
          $("#myModal").modal('show');     
          $("#owner_id").val($(this).attr('id'));     
    })

  });

  $('#frmUpdateAccount').submit(function(e){
    var lat = $('#frameMap').contents().find('#lat').val()
    var long = $('#frameMap').contents().find('#long').val()
    alert(lat + ' : ' +long);
    $('#longitude').val(long);
    $('#lattitude').val(lat);
    //e.preventDefault();
  });
  </script>
  
  

  </body>
</html>
