<?php 
require __DIR__  . '../../vendor/autoload.php';

require "../config.php";
require "../required/functions.php";



session_start();
checkIfLoggedInUser();

if(isset($_SESSION['checkout']) && isset($_GET['b_id'])){
  $billing_id = $_GET['b_id'];
  $checkoutID = $_SESSION['checkout']->id;
  $_SESSION['msg'] = 'Checkout successfully with ID: '.$_SESSION['checkout']->id;
  checkoutPayment($billing_id,$checkoutID);
  unset($_SESSION['checkout']);
  unset($_GET['b_id']);
}

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
<?php require "../required/sidebar-user.php";?>
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
                    <h3> List of Properties</h3>
                    
                    <section id="no-more-tables">
                    <table class="table table-bordered table-striped table-condensed cf" id="tblList">
                      <thead class="cf">
                        <th>PIN/TD</th>
                        <th>Lot #</th>
                        <th>Baranggay</th>
                        <th>Class</th>
                        <th>Value</th>
                        <th>Action</th>
                      </thead>
                      <tbody >
                      <?php 
                        $list = getMyProperties($_SESSION['user']['id']);
                        foreach ($list as $key => $value) {
                          ?>
                      <tr>
                        <td data-title="Owner"><?=$value['pin_td']?></td>
                        <td data-title="Lot Number"><?=$value['lot_number']?></td>
                        <td data-title="Baranggay"><?=$value['baranggay_name']?></td>
                        <td data-title="Class"><?=$value['class_type']?></td>
                        <td data-title="Assessed Value" style="font-weight: 900">₱ <?=number_format($value['value'],2)?></td>
                        <td data-title="Actions">
                          <button class="btn btn-sm btn-default edit" id="<?=$value['id']?>"><i class="fa fa-outdent" aria-hidden="true"></i></button>
                          <!--<button class="btn btn-sm btn-danger delete" id="<?=$value['id']?>"><i class="fa fa-trash-o" aria-hidden="true"></i></button>!-->

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
          <h4 class="modal-title">Billing Statement - <b>Computation for <i><span id="s_computation_for">January 2018</span></i></b></h4>
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-md-4 col-lg-4">

            <img src="../assets/img/left.png" alt="" class="img img-responsive" style="margin:auto;max-width: 200px;max-height: 350px" width="200px" height="350px">
            
          </div>
          <div class="col-xs-12 col-md-4 col-lg-4">
            <p align="center" style="font-size: 1.1em"> Republic of the Philippines </p>
            <p align="center" style="font-size: 1.1em"> Province of Bataan </p>
            <p align="center" style="font-size: 1.1em"> CITY OF BALANGA </p>
            <p align="center" style="font-size: 1.1em"> CITY TREASURER'S OFFICE </p>
            <p align="center" style="font-size: 1.1em"> Tel. # (047) 237-3404 , (047) 237-0704 </p>
            
            
            
          </div>
          <div class="col-xs-12 col-md-4 col-lg-4">
             <img src="../assets/img/right.png" alt="" class="img img-responsive" style="margin:auto;max-width: 200px;max-height: 200px" width="350px" height="350px">
          </div>
          <div class="clearfix"></div>
          <br>
            <p align="center"><b> ORDER OF PAYMENT</b></p>
          <p style="font-size: 1.3em">Received from <b><i><span id="payer_name" class="fillable" style="text-decoration: underline"></span></i></b> this sum of (<b>₱<i><span id="payment_amount" class="fillable" style="text-decoration: underline"></span></i></b> ) pesos in full or as installment payment of REAL PROPERTY TAX upon property declared to <b><i><span id="payer_name2"  class="fillable" style="text-decoration: underline"></span></i></b>  as follows </p>
          <section id="no-more-tables">
                    <table class="table table-bordered table-striped table-condensed cf" id="tblList">
                      <thead class="cf">
                        <th>Lot #</th>
                        <th>PIN/TD</th>
                        <th>Location/Class</th>
                        <th>Value</th>
                        <th>Year</th>
                        <th>Due</th>
                        <th>Penalty Discount</th>
                        <th>Total</th>
                      </thead>
                      <tbody >
                      
                      <tr>
                        <td data-title="Lot Number"><span id="s_lot"  class="fillable"></span></td>
                        <td data-title="PIN/TD"><span id="s_pin_td"  class="fillable"></span></td>
                        <td data-title="Location/Class"><span id="s_loc_class"  class="fillable"></span></td>
                        <td data-title="Value"><span id="s_value"  class="fillable"></span></td>
                        <td data-title="Tax Year"><span id="s_tax_year" class="fillable"></span></td>
                        <td data-title="Tax Due"><span id="s_tax_due" class="fillable"></span></td>
                        <td data-title="Penaly Discount"><span id="s_penalty_discount" class="fillable"></span></td>
                        <td data-title="Total"><span id="s_total"  class="fillable"></span></td>
                      </tr>
                      </tbody>
                    </table>

          </section>
                    <button type="button" class="btn btn-default" id="btnPayNow"> Pay Now </button>

                     <div class="clearfix"></div>
                  <form action="bills_payments1.php" method="POST" id="frmPay" style="margin-top:25px">
                    <h3><center> Payment Information </center> </h3>
                    <input type="hidden" name="billing_id" id="billing_id">
                    <div class="form-group col-xs-12 col-md-5 col-lg-5">
                              <label for="firstname">Firstname</label>
                              <input type="text" name="firstname" id="firstname" class="form-control" value="<?=$_SESSION['user']['firstname']?>" required>
                    </div>
                    <div class="form-group  col-xs-12 col-md-2 col-lg-2">
                              <label for="mi">MI</label>
                              <input type="text" name="mi" id="mi" class="form-control" value="<?=$_SESSION['user']['mi']?>" required>
                    </div>
                    <div class="form-group col-xs-12 col-md-5 col-lg-5">
                              <label for="lastname">Lastname</label>
                              <input type="text" name="lastname" id="lastname" class="form-control" value="<?=$_SESSION['user']['lastname']?>" required>
                    </div>
                    <div class="form-group col-xs-12 col-md-4 col-lg-4">
                              <label for="amount_due">Amount Due</label>
                              <input type="text" name="amount_due" id="amount_due" class="form-control" value="" readonly="" disabled="">
                    </div>
                     <div class="form-group col-xs-12 col-md-4 col-lg-4">
                              <label for="amount">Payment</label>
                              <input type="text" name="amount2" id="amount2" class="form-control" readonly="">
                    </div>
                    <div class="form-group   col-xs-12 col-md-4 col-lg-4">
                              <label for="payment_name">Payment Name</label>
                              <input type="text" name="payment_name" id="payment_name" class="form-control" value="Payment for Real Property Tax" readonly="">
                    </div>
  
                    <div class="form-group   col-xs-12 col-md-12 col-lg-12">
                              <label for="payment_description">Description Name</label>
                              <input type="text" name="payment_description" id="payment_description" class="form-control" value="" readonly="">
                    </div>  
                    <div class="form-group   col-xs-12 col-md-12 col-lg-12">
                        <label for="payment_method"> Please select payment method </label>
                        <select class="form-control" name="payment_method" id="payment_method">
                            <option value="">Please Select</option>
                            <option value="paymaya">PayMaya</option>
                            <option value="stripe">Stripe</option>
                        </select>
                    </div>



                    <button type ="submit" id="btnPaymaya" class="btn btn-success"> Pay Billing</button>
                  </form>
                  


          
            <div class="clearfix">  </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


    <!-- js placed at the end of the document so the pages load faster -->
    
	<?php require "../required/scripts.php";?>

	<script>
  var id 
  $(function(){
    $('#frmPay').hide();
    $("#tblList").DataTable();

    $(".edit").click(function(){
      $('#frmPay').hide();
      id = $(this).attr('id')
      $('#property_id').val(id);
      $.ajax({
        url:'../required/api.php',
        data:{request:'getComputeTaxPaymentViaId',id:id},
        dataType:'JSON',
        type:'POST',
        success:function(data){
            $('#btnPayNow').show();
          console.log(data.billing.isPaid)
          if(data.billing.isPaid==1){
            $('#btnPayNow').hide();
            $('#s_tax_year').html('Already Paid');
          }else{
            $('#s_tax_year').html(data.billing.billing_year);
            
          }
          $('#payer_name').html('<?=$_SESSION['user']['firstname']." ".$_SESSION['user']['lastname']?>');
          $('#payer_name2').html('<?=$_SESSION['user']['firstname']." ".$_SESSION['user']['lastname']?>');
          $('#payment_amount').html(data.tax);
          $('#s_lot').html(data.property.lot_number);
          $('#s_pin_td').html(data.property.pin_td);
          $('#s_loc_class').html(data.property.location_class);
          $('#s_value').html(data.property.p_value);
          $('#s_tax_year').html(data.year);
          $('#s_tax_due').html(data.tax_text);
          $('#s_penalty_discount').html('');
          $('#s_total').html(data.tax_text);
          /*
          $('#amount_due').val(data.tax);
          $('#amount').val((data.tax_text)*100);
          //console.log((data.tax_text)*100);
          $('#script').attr('data-amount',(data.tax_text)*100);
          $('#amount2').val(data.tax_text);
          $('#billing_id').val(data.billing.id);
            */
          $('#amount_due').val(data.tax_text);
          $('#amount2').val(data.tax);
          $('#billing_id').val(data.billing.id);
          var desc = 'Payment for '+data.property.lot_number + ', '+data.property.pin_td+', '+data.property.location_class
          
          $('#payment_description').val(desc);

        

          $("#myModal").modal('show'); 
        }
      });
     
    });
    
});


function clearFillable(){
  $total = $('.fillable')
  $.each($total,function(k,v){
    $(this).html('');
  })
}
$('#btnPayNow').click(function(){
  $('#frmPay').show('slow')
  $('#firstname').focus();
})
  </script>
	
  

  </body>
</html>
