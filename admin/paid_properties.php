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
                    <h3> Summary of Receipts</h3>
                    
                    <section id="no-more-tables">
                    <table class="table table-bordered table-striped table-condensed cf" id="tblList">
                      <thead class="cf">
                        <th>Receipt #</th>
                        <th>Billing Year</th>
                        <th>Date of Payment</th>
                        <th>Amount Paid</th>
                        <th>Action</th>
                      </thead>
                      <tbody >
                      <?php 
                        $list = myReceipts();
                        foreach ($list as $key => $value) {
                          ?>
                      <tr>
                        <td data-title="Receipt #"><?=$value['checkout_id']?></td>
                        <td data-title="Billing Year"><?=$value['billing_year']?></td>
                        <td data-title="Baranggay"><?=$value['created_at']?></td>
                        <td data-title="Amount Paid">₱ <?=number_format($value['amount'],2)?></td>
                        <td data-title="Action">
                          <button class="btn btn-sm btn-default view" 
                          checkout_id ="<?=$value['checkout_id']?>"
                          amount ="₱ <?=number_format($value['amount'])?>"
                          payment_date ="<?=($value['created_at'])?>"
                          payer_name="<?=$value['payer_name']?>"



                          ><i class="fa fa-eye" style="font-size:2em"></i></button>
                          <a href="receipt.php?id=<?=$value['payment_id']?>&type=excel" ><button class="btn btn-sm btn-success"><i class="fa fa-file-excel-o" aria-hidden="true" style="font-size:2em"></i></button></a>
                          <a href="receipt.php?id=<?=$value['payment_id']?>&type=pdf" ><button class="btn btn-sm btn-warning"><i class="fa fa-file-pdf-o fa-2" aria-hidden="true" style="font-size:2em"></i></button></a>
                        </td>
                        

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
  <div class="modal fade " tabindex="-1" role="dialog" id="myModal" >
    <div class="modal-dialog modal-lg " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Receipt Information - <i><b><span id="lblCheckoutID">bdcadb20-e714-42be-bc6e-6679ce02d927 </span></b></i></b></h4>
        </div>
        <div class="modal-body">
            <div class="col-xs-12 col-md-12 col-lg-12">
                 <img src="../assets/img/right.png" alt="" class="img img-responsive" style="margin:auto;max-width: 100px;max-height: 100px" width="350px" height="350px">
            </div>

            <div class="col-xs-12 col-md-12 col-lg-12" style="padding-top: 25px">
            <h3 class="text-center"> Real Property Tax Receipt </h3>
            <table class="table table-condensed">
              <tbody>             
                <tr>
                  <td class="text-center" style="font-size: 1.3em">
                    <b>Reference ID</b> : </span>
                  </td>
                  <td class="" style="font-size: 1.3em;text-align: left">
                    <b><span id="spanCheckoutID"></span></b>
                  </td>
                </tr>               
                <tr>
                  <td class="text-center" style="font-size: 1.3em">
                    <b>Payor</b> : </span>
                  </td>
                  <td class="" style="font-size: 1.3em;text-align: left">
                    <b><span id="spanPayor"><?=$_SESSION['user']['firstname'].' '.$_SESSION['user']['lastname']?></span></b>
                  </td>
                </tr>             
                <tr>
                  <td class="text-center" style="font-size: 1.3em">
                    <b>Amount Paid</b> :
                  </td>
                  <td class="" style="font-size: 1.3em;text-align: left">
                    <b><span id="spanAmountPaid"></span></b>
                  </td>
                </tr>             
                <tr>
                  <td class="text-center" style="font-size: 1.3em">
                    <b>Date of Payment</b> :
                  </td>
                  <td class="" style="font-size: 1.3em;text-align: left">
                    <b><span id="spanDateOfPayment"></span></b>
                  </td>
                </tr>

              </tbody>
            </table>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <?php require "../required/scripts.php";?>

  <script>
  $(function(){
    $('#tblList').DataTable();
  })
  $('.view').click(function(){
    $("#myModal").modal('show');
    var checkout_id = $(this).attr('checkout_id');
    var amount = $(this).attr('amount');
    var payment_date = $(this).attr('payment_date');
    var payer_name = $(this).attr('payer_name');
    $('#lblCheckoutID').html(checkout_id);
    $('#spanCheckoutID').html(checkout_id);
    $('#spanAmountPaid').html(amount);
    $('#spanPayor').html(payer_name);
    $('#spanDateOfPayment').html(payment_date);
  })  
  </script>
  
  

  </body>
</html>

  
  

  </body>
</html>