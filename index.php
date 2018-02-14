<?php 
require "config.php";
require "required/functions.php";
session_start();

$homepage = getHomepage();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BALANGA CITY TREASURY</title>
  <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  <link href="website/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="website/css/font-awesome.min.css" rel="stylesheet">
  <link href="website/css/animations.css" rel="stylesheet">
  <link href="website/css/normalize.css" rel="stylesheet">
  <link href="website/css/style.css" rel="stylesheet" type="text/css">
  <link href="website/css/royalslider.css" rel="stylesheet" type="text/css">

  <!-- include HTML5 IE enabling script and stylesheet for IE -->
  <!--[if lte IE 9]>
      <link href="css/animations-ie-fix.css" rel="stylesheet">
  <script type='text/javascript' src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <script type='text/javascript' src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
  <script src="js/ie.js"></script>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->

</head>

<body class="home">
  <!-- wrapper -->
  <div id="wrapper" class="win-min-height">
    <header id="header" class="header block background01">
      <div class="container header_block">
        <div class="row">
          <div class="social-icon">
            <ul>
              <li style="margin-top:3px"><a class="color02 color01-hover03" href="login.php" style="font-weight:bold;color:#777;margin-top:15px;padding-bottom:15px;line-height:20px;font-size:16px">LOG IN <i class="fa fa-sign-in"></i></a>
              </li>
            </ul>
          </div>
          <nav class="navbar navbar-default">
            <div class="container-fluid">
              <div class="navbar-header">
                <a class="navbar-brand" href="#">
                  <img class="img-responsive" src="assets/img/balanga.png" alt="">
                </a>
                <div class="menu-btn">
                  <button type="button" class="navbar-toggle collapsed color02" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <strong> <span class="sr-only">Toggle navigation</span> <span class="icon-bar background02"></span> <span class="icon-bar background02"></span> <span class="icon-bar background02"></span> </strong> <strong> MENU</strong>
                  </button>
                </div>
              </div>
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav color02">
                  <li class="active"><a href="#wrapper">Home</a></li>
                  <li> <a href="#services">Services</a></li>                  
                  <li> <a href="#vmg">Vision/Mission</a></li>
                  <li> <a href="#about-us">About Us</a></li>
                  <li> <a href="#news">News</a></li>
                  <li> <a href="#contact">Contact Us</a></li>
                </ul>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </header>
    <section id="slider" class="block background01">
      <div class="row">
        <div class="responsive-slider" data-spy="responsive-slider" data-autoplay="true">
          <div class="slides" data-group="slides">
            <ul>
              <?php 
              $ctr=0;
              foreach ($homepage['slides'] as $key => $value) {
                # code...
              ?>
              <li>
                <div class="slide-body" data-group="slide">
                  <img src="<?=$value['img_url']."?".rand(0,1000)?>" alt="Slide<?=$ctr?>">
                  <div class="slide_textholder" >
                    <div class="container holderinner"   >
                      <div class="caption subheader" data-animate="slideAppearDownToUp" data-delay="500" data-length="300" style=" background: rgba(54, 25, 25, .5)">
                        <h2 class="color01"><?=$value['tagline']?></h2>
                        <h5 class="color01"><?=$value['subtitle']?></h5>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <?php } ?>
            </ul>
          </div>
          <div class="pagerholder"> <a class="page slidenumber" href="#" data-jump-to="1">1</a> <a class="page slidenumber" href="#" data-jump-to="2">2</a> <a class="page slidenumber" href="#" data-jump-to="3">3</a>
          </div>
        </div>
      </div>
    </section>
    <section id="services" class="block background01 animatedParent animateOnce">
      <div class="row">
        <div class="services">
          <div class="animated fadeIn slow">
            <h2><center>Services We Offer</center></h2>
           
          </div>

        </div>
         <ol>
            <?php foreach ($homepage['services'] as $key => $value) {
              # code...
            ?>
              <li style="margin-top:10px;text-align: left!important"><h3><?=$value['service_name']?></h3></li>
            <?php 
            }?>
            </ol>
      </div>
    </section>
    <section id="vmg" class="block background01 animatedParent animateOnce">
        <div role="tabpanel" class="animated fadeIn slow">
          <ul class="nav nav-tabs tabhead" role="tablist">
            <li class="active"><a href="#tab1" aria-controls="tab09a" role="tab" data-toggle="tab">Vision</a>
            </li>
            <li role="presentation"><a href="#tab2" aria-controls="tab09b" role="tab" data-toggle="tab">Mission</a>
            </li>
          </ul>
          <div class="tab-content background09">
            <div role="tabpanel" id="tab1" class="boxes active tab-pane">
              <div class="container">
                <div class="holder">
                  <div class="col color01 col-sm-12 m-item">
                    <div class="box-holder background01">
                      <div class="icone_box color01 col-sm-5 col-xs-4">
                        <img class="img-responsive" src="<?=$homepage['cms_info']['vision_img']?>" alt="Project">
                      </div>
                      <div class="col-sm-7 col-xs-8 text_box color02">
                        <h3>Our Vision</h3>
                        <div class="text-holder">
                          <p><?=$homepage['cms_info']['vision']?></p> <a class="btn more background05 color01 color01-hover" href="#"><i class="fa fa-arrow-right">&nbsp;</i></a>
                        </div>
                      </div>
                    </div>
                  </div>
            
                </div>

              </div>
            </div>
            <div role="tabpanel" id="tab2" class="boxes tab-pane">
              <div class="container">
                <div class="holder">
                  <div class="col color01 col-sm-12 m-item">
                    <div class="box-holder background01">
                      <div class="col-sm-7 col-xs-8 text_box color02">
                        <h3>Mission</h3>
                        <div class="text-holder">
                          <p><?=$homepage['cms_info']['mission']?></p> <a class="btn more background05 color01 color01-hover" href="#"><i class="fa fa-arrow-right">&nbsp;</i></a>
                        </div>
                      </div>
                      <div class="icone_box color01 col-sm-5 col-xs-4">
                        <img class="img-responsive" src="<?=$homepage['cms_info']['mission_img']?>" alt="Project">
                      </div>
                    </div>
                  </div>
            
                </div>

              </div>
            </div>
          
          </div>
        </div>
    </section>

    <section id="about-us" class="block background01 animatedParent animateOnce">
      <div class="container">
        <div class="row">
          <div class="container projects" style="  max-width: 100%;">
            <h2 class="animated fadeIn slow">About Us</h2>
              <p style="overflow:auto"><?=$homepage['cms_info']['about']?></p>

          </div>
        </div>
      </div>
    </section>
    <section id="news" class="block animatedParent animateOnce background02">
      <div class="mail-section">
        <div class="quickemail animated fadeIn slow">
          <div class="container">
            <div class="row">
              <div class="mail_content">
                <h2 class="color08"> News </h2>
                
                <?php 

                    $news = $homepage['news'];
                    foreach ($news as $key => $value) {
                  ?>
                <h3 style="text-align: left;color:white;margin-top:10px"><b><?=$value['headline']?></b></h3>
                <p class="align-left" style="color:gray;font-size: 1em"><i>Published on <?=$value['created_at']?> by Admin</i></p>
                <p class="align-left" style="color:white"><i><?=$value['body']?></i></p>
                <hr>
                
                  <?php    
                    }

                ?>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>    
    <section id="contact" class="block animatedParent animateOnce background03">
      <div class="mail-section">
        <div class="quickemail animated fadeIn slow">
          <div class="container">
            <div class="row">
              <div class="mail_content">
                <h2 class="color08">Email Us</h2>
                <p class=" color04"><?=$GLOBAL_EMAIL?></p>
                <div class="form col-md-12 col-xs-12 col-lg-12">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d123515.7493739205!2d120.42672967903106!3d14.663478715959945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33964009381ef663%3A0xe135d5b451871d25!2sCity+of+Balanga%2C+Bataan!5e0!3m2!1sen!2sph!4v1517496322792" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer id="footer" class="footer block background01 animatedParent animateOnce">
      <div class="container">
        <div class="row">
          <div class="footerinner animated fadeIn slow">
            <div class="logo_bottom">
              <a href="#">
                <img class="img img-responsive" src="assets/img/balanga.png" alt="">
              </a>
            </div> <span class="color02 col-xs-12 col-sm-6 col-md-6"> &copy; City of Balanga <?= date('Y')?> <a href="#" target="_blank" ></a></span>
  
          </div>
        </div>
      </div>
    </footer>
    <!-- Go To Top Link -->
    <a style="display: block;" href="#" class="back-to-top">
      <i class="fa fa-angle-up"></i>
    </a>

  </div>
  <script type="text/javascript" src="website/js/jquery-min.js"></script>
  <script src="website/js/bootstrap.min.js"></script>
  <script src="website/js/responsive-slider.js"></script>
  <script src="website/js/countUp.js"></script>
  <script src="website/js/touch-slide.js"></script>
  <script src="website/js/jquery.nav.js"></script>
  <script src="website/js/classie.js"></script>
  <script src="website/js/jquery.custom-scrollbar.js"></script>
  <script src="website/js/royalslider-min.js"></script>
  <script src="website/js/custom.js"></script>
  <script type="text/javascript">
    if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
      var msViewportStyle = document.createElement('style')
      msViewportStyle.appendChild(
        document.createTextNode(
          '@-ms-viewport{width:auto!important}'
        )
      )
      document.querySelector('head').appendChild(msViewportStyle)
    }
  </script>
</body>

</html>