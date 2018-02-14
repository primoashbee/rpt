
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
              <div class="panel-heading">Property Summary</div>
              <div class="panel-body">
                 <section id="no-more-tables">
                    <table class="table table-bordered table-striped table-condensed cf" id="tblList">
                      <thead class="cf">
                        <th>PIN/TD</th>
                        <th>Location/CLASS</th>
                        <th>Create On</th>
                        <th>Status</th>
                        <th>Action</th>
                      </thead>
                      <tbody >
                      <?php 
                        billRemainingPropeties();
                        $list = getPropertyWithStatus();

                        foreach ($list as $key => $value) {
                          ?>
                      <tr>
                        <td data-title="PIN/TD"><?=$value['pin_td']?></td>
                        <td data-title="LOCATION/CLASS"><?=$value['lot_number']?></td>
                        <td data-title="STATUS"><?=$value['created_at']?></td>
                        <td data-title="ACTION" style="text-align: center;width: 50px">
                        <?php 
                            if($value['status']=="DELINQUENT"){
                              
                          ?>
                           <span class="label label-danger">INACTIVE</span>
                          <?php
                          }else{
                          ?>

                        <span class="label label-success">ACTIVE</span>

                          <?php } ?>

                        <td data-title="Actions">
                          <button class="btn btn-sm btn-default edit" id="<?=$value['id']?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
                        
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
      
      <!--footer end-->
  </section>


<form id="frmUpdateProperties" action="update_properties1.php" method="post">
  <div class="modal fade " tabindex="-1" role="dialog" id="myModal" >
    <div class="modal-dialog modal-lg " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Update Property</h4>
        </div>
        <div class="modal-body">
           <div class="col-xs-12 col-md-4 col-lg-4 form-group" id="divUsername">
                      <label class="labeling" for="pin_td" id="lblUsername">PIN/TD</label>
                      <input class="form-control" type="text" id="pin_td" name="pin_td" readonly="" placeholder="PIN/TD">
                    </div>
                    <div class="col-xs-12 col-md-4 col-lg-4 form-group">
                      <label class="labeling" for="lot_number">Lot #</label>
                      <input class="form-control" type="text" id="lot_number" name="lot_number"  readonly="" placeholder="Lot #">
                    </div>            

                    <div class="col-xs-12 col-md-4 col-lg-4 form-group">
                      <label class="labeling" for="baranggay_id">Baranggay</label>
                      <select class="form-control" name="baranggay_id" id="baranggay_id"  readonly="">
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
                      <select class="form-control" name="class_id" id="class_id"  readonly="">
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
                      <input class="form-control" type="text" id="value" name="value"  readonly="" placeholder="Asesssed Value">
                    </div>                
                    <div class="col-xs-12 col-md-6 col-lg-6 form-group">
                           <iframe src="sample.php" width="850px" height="500px" id="frameMap""></iframe>
                    </div>                
                    <input type ="hidden" name="lattitude" id="lattitude">
                    <input type ="hidden" name="longitude" id="longitude">
                    <input type ="hidden" name="property_id" id="property_id">
                    <div class="clearfix"></div>
                   
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</form>

    <!-- js placed at the end of the document so the pages load faster -->
    
  <?php require "../required/scripts.php";?>

  <script>
      $(function(){
        $("#tblList").DataTable();
      })
      $('.edit').click(function(){
         id = $(this).attr('id')
      $('#property_id').val(id);
        $.ajax({
          url:'../required/api.php',
          data:{request:'getPropertyViaID',id:id},
          dataType:'JSON',
          type:'POST',
          success:function(data){

            $("#frameMap").contents().find('#lat').val();
            var qryString = 'lat='+data.lattitude+'&long='+data.longitude
            $('#lattitude').val(data.lattitude)
            $('#longitude').val(data.longitude)
            $("#frameMap").attr('src','sample.php?'+qryString);
            console.log(qryString);
            $('#pin_td').val(data.pin_td);        
            $('#lot_number').val(data.lot_number);        
            $('#baranggay_id').val(data.baranggay_id);        
            $('#class_id').val(data.class_id);        
            $('#value').val(data.value);        
            $("#myModal").modal('show'); 
          }
        });
        
      })
  </script>

  
  
  

  </body>
</html>