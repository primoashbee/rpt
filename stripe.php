<?php 
require_once('vendor/autoload.php');
echo date('n');
$_GET['amount']=1000;
?>
<form action="bill.php" method="POST">
    <input type="text" name="amount" id="amount" value="<?=$_GET['amount']?>">
    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_pgJq2Y99jLKJ3GTPWD7TyZ9g"
    data-amount="<?=($_GET['amount'])?>"
    data-name="Ashbee Morgado"
    data-description="Widget"
    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
    data-locale="auto"
    data-currency="USD">
  </script>




</form>