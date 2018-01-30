<?php
require_once('vendor/autoload.php');
var_dump($_POST);

$stripe = array(
  "secret_key"      => "sk_test_doyM4Xht0ica9M2MKiGIIdrd",
  "publishable_key" => "pk_test_pgJq2Y99jLKJ3GTPWD7TyZ9g"
);


\Stripe\Stripe::setApiKey($stripe['secret_key']);
  $charge = \Stripe\Charge::create(array(
      'card' => $_POST['stripeToken'],
      'amount'   => $_POST['amount'],
      'currency' => 'usd'
  ));

  echo '<h1>Successfully charged $'.$_POST['amount'].!'</h1>';?>