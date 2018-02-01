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
              <div class="panel panel-heading"><h3> Change Homepage </h3></div>
              <div class="panel-body">
              <?php require "../required/alert.php"; ?>
               <h3> Slides </h3>
               
                <table class="table table-striped">
                  <thead>
                    <th>Tagline</th>
                    <th>Subtitle</th>
                    <th>Background Image</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                    
                    <?php 
                    $homepage = getHomePage(true);
                    foreach ($homepage['slides'] as $key => $value) {
                    ?>
                      <tr>
                        <td><?=$value['tagline']?></td>
                        <td><?=$value['subtitle']?></td>
                        <td><img class="img img-responsive" style="max-width: 150px;max-height: 150px" src="<?='../'.$value['img_url']?>"/></td>
                        <td>
                          <button class="btn btn-default update" s_id="<?=$value['id']?>"><i class="fa fa-edit" style="font-size:2em"></i></button>
                          <button class="btn btn-danger delete"><i class="fa fa-trash-o" style="font-size:2em"></i></button>
                        </td>
                      </tr>
                    <?php
                    }

                    ?>
                  </tbody>
                </table>
                <hr>
                <form action = "index1.php?type=CMS" method ="POST"">
                <h3> Vision </h3>
                <input type="hidden" name = "cms_id" value="<?=$homepage['cms_info']['id']?>">
                <div class="form-group">
                <textarea class ="form-control" name="vision" id="vision" v_id=<?=$homepage['cms_info']['id']?>"" cols="30" rows="5" required=""><?=$homepage['cms_info']['vision']?></textarea>

                </div>        
                <div class="clearfix"></div>        
                <hr>
                <h3> Mission </h3>
                <div class="form-group">
                <textarea class ="form-control" name="mission" id="vision" cols="30" rows="5" required=""><?=$homepage['cms_info']['mission']?></textarea>

                </div>

                <div class="clearfix"></div>
                <hr>
                <h3> About </h3>
                <div class="form-group">
                <textarea class ="form-control" name="about" id="vision" cols="30" rows="5" required=""><?=$homepage['cms_info']['about']?></textarea>

                <button class="btn btn-success" type="submit" style="float:right;margin-top:5px">Update </button>
              </form>
                </div>
              </div>
            </div>
            
          </section>
      </section>

      <!--main content end-->
      
      <!--footer end-->
  </section>


<form id="frmUpdateSlides" action="index1.php?type=SLIDES">
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
          <input type="file" name="img_url" id="img_url">
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
      $('.update').click(function(){
        id = $(this).attr('s_id');
        $.ajax({
          url:'../required/api.php',
          data:{id:id,request:'getSlideViaID'},
          dataType:'JSON',
          type:'POST',
          success:function(data){
              $('#tagline').val(data.tagline);
              $('#subtitle').val(data.subtitle);

              $('#img_url_src').attr('src','../'+data.img_url);

          }
        })
        $('#myModal').modal('show');
      })
    })
    $("#img_url").change(function(){

            var output = document.getElementById('output');
            console.log($(this).val())
            output.src = $(this).val();
    })
  </script>

	
	
  

  </body>
</html>
