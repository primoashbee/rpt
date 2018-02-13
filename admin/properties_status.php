
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


<form id="frmUpdateSlides" action="index1.php?type=SLIDES" method="POST" enctype="multipart/form-data">
  <div class="modal fade " tabindex="-1" role="dialog" id="myModal" >
    <div class="modal-dialog modal-lg " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Update Slide</h4>
        </div>
        <div class="modal-body">
        <div class="col-xs-12 col-md-6 col-lg-6">
          <div class="form-group">
            <label for="tagline"> Tagline</label>
            <input type="text" name="tagline" id="tagline" class="form-control">
          </div>
        </div>
  
        <div class="col-xs-12 col-md-6 col-lg-6">
          <div class="form-group">
            <label for="tagline"> Subtitle</label>
            <input type="text" name="subtitle" id="subtitle" class="form-control">
          </div>
        </div>
        <div class="col-xs-12 col-md-12 col lg-12">
          <center>
          <label for="img_url"> Background Image </label>
          <img src="../wallpaper.png" id="img_url_src" class="img img-responsive img-thumbnail" style="max-width: 100%;max-height: 500px">
          <script>

          </script>
          <input type="file" name="img_url" id="img_url" accept="image/x-png,image/jpeg">
          </center>
        </div>
        <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
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
        alert()
      })
  </script>

  
  
  

  </body>
</html>