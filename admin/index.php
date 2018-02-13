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
                <ul class="nav nav-tabs">
                  <li class="active lead"><a data-toggle="tab" href="#home" >Slides</a></li>
                  <li class="lead"><a data-toggle="tab" href="#menu1">VISION/MISSION</a></li>
                  <li class="lead"><a data-toggle="tab" href="#services">SERVICES</a></li>
                  <li class="lead"><a data-toggle="tab" href="#menu2">ABOUT</a></li>
                  <li class="lead"><a data-toggle="tab" href="#menu3">NEWS</a></li>
                </ul>

                <div class="tab-content">
                  <div id="home" class="tab-pane fade in active">
            
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
                            <td><img class="img img-responsive" style="max-width: 150px;max-height: 150px" src="<?='../'.$value['img_url']."?".rand(0,1000)?>"/></td>
                            <td>
                              <button class="btn btn-default update" s_id="<?=$value['id']?>"><i class="fa fa-edit" style="font-size:2em"></i></button>
                              <!--<button class="btn btn-danger delete"><i class="fa fa-trash-o" style="font-size:2em"></i></button>!-->
                            </td>
                          </tr>
                        <?php
                        }

                        ?>
                      </tbody>
                    </table>
                  </div>
                  <div id="menu1" class="tab-pane fade">
                  <form action="index1.php?type=VM" method="POST" enctype="multipart/form-data">
                    <h3> Vision </h3>
                    <div class="col-xs-12 col-md-6 col-lg-6">
                      <input type="hidden" name = "cms_id" value="<?=$homepage['cms_info']['id']?>">
                      <div class="form-group">
                      <textarea class ="form-control" name="vision" id="vision" v_id=<?=$homepage['cms_info']['id']?>"" cols="30" rows="16" required=""><?=$homepage['cms_info']['vision']?></textarea>

                      </div>      
                    </div>  
                    <div class="col-xs-12 col-md-6 col-lg-6">
                      <img src="../<?=$homepage['cms_info']['vision_img']."?".rand(0,100)?>" id="vision_view" class="img img-responsive" style="max-width: 100%;max-height: 100%" alt="">  
                      <br>  
                      <input type="file" name ="vision_img" id="vision_img" accept="image/*"/>
                          
                    </div>
                    <div class="clearfix"></div>        
                    <hr>
                    <h3> Mission </h3>
                    <div class="col-xs-12 col-md-6 col-lg-6">
                    <div class="form-group">

                    <textarea class ="form-control" name="mission" id="vision" cols="30" rows="16" required=""><?=$homepage['cms_info']['mission']?></textarea>
                
                    </div>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6">
                      <img src="../<?=$homepage['cms_info']['mission_img']."?".rand(0,100)?>" id="mission_view" class="img img-responsive" style="max-width: 100%;max-height: 100%" alt="">  
                      <br>  
                      <input type="file" name ="mission_img" id="mission_img" accept="image/*"/>
                          
                    </div>
                    <button class="btn btn-success" style="float: right">Submit</button>
                  </form>




                  </div>
                <div id="services" class="tab-pane fade">
                    <br>
                    <button class="btn btn-success" type="button" id="btnCreateService" style="float: right"> Add New Service </button>
                    <table class="table table-condensed">
                      <thead>
                        <th>Services</th>
                        <th>Added on</th>
                      </thead>
                      <tbody>
                     
                          <?php 

                          foreach ($homepage['services'] as $key => $value) {
                           ?>
                        <tr>
                          <td><?=$value['service_name']?></td>
                          <td><?=$value['created_at']?></td>
                          <td>
                            <!--<button class="btn btn-default view-news" news_id="<?=$value['id']?>"><i class="fa fa-eye"></i></button>-->
                          </td>
                          
                        </tr>
                         <?php
                           
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                    <div id="menu2" class="tab-pane fade">

                     <form action="index1.php?type=ABOUT" method="POST" enctype="multipart/form-data">
                      <h3> About </h3>
                      <div class="form-group">
                      <input type="hidden" name="slide_id" id="slide_id" value="<?=$homepage['cms_info']['id']?>">
                      <textarea class ="form-control" name="about" id="about" cols="30" rows="20" required=""><?=$homepage['cms_info']['about']?></textarea>

                      <button class="btn btn-success" type="submit" style="float:right;margin-top:5px">Update </button>
                      </div>
                    </form>
                  </div>
                  <div id="menu3" class="tab-pane fade">
                    <br>
                    <button class="btn btn-success" type="button" id="btnCreateNews" style="float: right"> Create News </button>
                    <table class="table table-condensed">
                      <thead>
                        <th>Headline</th>
                        <th>Published on</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                     
                          <?php 

                          foreach ($homepage['news'] as $key => $value) {
                           ?>
                        <tr>
                          <td><?=$value['headline']?></td>
                          <td><?=$value['created_at']?></td>
                          <td>
                            <button class="btn btn-default view-news" news_id="<?=$value['id']?>"><i class="fa fa-eye"></i></button>
                          </td>
                          
                        </tr>
                         <?php
                           
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              
               
                </div>
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
          <input type="hidden" name="slide_id" id="slide_id">
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
           <center><label for="img_url">Background Image </label> </center>
        </div>

        <div class="col-xs-12 col-md-12 col lg-12">
          <center>
          <img src="../website/images/wallpaper.png" id="img_view" class="img img-responsive img-thumbnail" style="max-width: 100%;max-height: 500px">
         
          <input type="file" name="img_url" id="img_url" accept="image/*">
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
<form action="create_service.php" method="POST" id="frmAddService">
<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">SERVICES</h3>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="service_name">Service Name</label>
            <input type="text" name="service_name" id="service_name" class="form-control" required="">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" id="btnSubmitService" >Submit</button>
        </div>
      </div>
      
    </div>
  </div>
</form>
<form action="create_news.php" method="POST" id="frmNews">
  <div class="modal fade " tabindex="-1" role="dialog" id="newsModal" >
    <div class="modal-dialog modal-lg " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">News Information</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" name="slide_id" id="slide_id">
        <div class="col-xs-12 col-md-12 col-lg-12">
          <div class="form-group">
            <label for="tagline"> Headline</label>
            <input type="text" name="headline" id="headline" class="form-control" required="" placeholder="Headline">
          </div>
        </div>
  
        <div class="col-xs-12 col-md-12 col-lg-12">
          <div class="form-group">
            <label for="tagline"> Body</label>
            <textarea class="form-control" name="body" id="body" cols="30" rows="10" required="" placeholder="News Body">
            </textarea>
          </div>
        </div>
        <div class="clearfix">  </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" id="btnSubmitNews" class="btn btn-primary">Save changes</button>
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
              $('#frmUpdateSlides').find('#slide_id').val(data.id)
              $('#img_view').attr('src','../'+data.img_url);

          }
        })
        $('#myModal').modal('show');
     
      })

      $('.view-news').click(function(){
        id = $(this).attr('news_id');
        $.ajax({
          url:'../required/api.php',
          data:{id:id,request:'getNewsViaId'},
          dataType:'JSON',
          type:'POST',
          success:function(data){
              $('#headline').val(data.headline);
              $('#headline').attr('readonly','true');
              $('#body').val(data.body);
              $('#body').attr('readonly','true');

              $('#img_view').attr('src','../'+data.img_url);

          }
        })
        $('#newsModal').modal('show');
        $("#btnSubmitNews").hide();
      })
      $("#btnCreateNews").click(function(){

        $('#frmNews').attr('action','create_news.php?type=create');

        $('#headline').attr('readonly',false);
        $('#headline').val('');

        $('#body').attr('readonly',false);
        $('#body').val('');
        $("#newsModal").modal('show')
        $("#btnSubmitNews").show();
      })


    })
    $('#btnCreateService').click(function(){
      $('#myModal2').modal('show')
    })
    /*
    $("#img_url").change(function(){

            var output = document.getElementById('output');
            console.log($(this).val())
            output.src = $(this).val();
    })
  */
    function readURL(input,target) {

      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#'+target).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }


  $("#vision_img").change(function() {
    readURL(this,"vision_view");
  });  
  $("#mission_img").change(function() {
    readURL(this,"mission_view");
  });  
  $("#img_url").change(function() {
    readURL(this,"img_view");
  });


  $("#frmAddService").submit(function(e){
    var service = $('#service_name').val();
    $.ajax({
      url:'../required/api.php',
      data:{service:service,request:'checkServiceNameIfExists'},
      dataType:'JSON',
      type:'POST',
      success:function(data){
        if(data.code==200){
          alert(data.msg);
          location.reload();
        }else{
          alert(data.msg)
        }
      }
    })
    e.preventDefault();
  })
  </script>

	
	
  

  </body>
</html>
