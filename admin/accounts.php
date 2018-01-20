<?php 
require "../config.php";
require "../required/functions.php";
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

                    <table class="table table-striped" id="tblList">
                      <thead>
                        <th>Username</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Create On</th>
                      </thead>
                      <tbody >
                      <?php 
                        $list = getAccountsList();
                        foreach ($list as $key => $value) {
                          ?>
                      <tr>
                        <td><?=$value['username']?></td>
                        <td><?=$value['firstname']?></td>
                        <td><?=$value['lastname']?></td>
                        <td><?=$value['created_at']?></td>
                      </tr>

                          <?php
                        }
                      ?>
                      </tbody>
                    </table>


                    
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

    <!-- js placed at the end of the document so the pages load faster -->
    
	<?php require "../required/scripts.php";?>

	<script>
   
  $(function(){
    $("#tblList").DataTable();
  });
  </script>
	
  

  </body>
</html>
