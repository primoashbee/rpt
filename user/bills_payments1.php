<?php
require '../config.php';
require '../required/functions.php';

session_start();
/*
 * Sample checkout.php code for PayMaya Checkout
 *
 * Note: This script basically creates a Checkout object that provides the
 * payment page. The script needs to be run every time the customer
 * checks out.
 *
 *
 *
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

require  '../vendor/autoload.php';

use PayMaya\API\Checkout;
use PayMaya\Model\Checkout\Buyer;
use PayMaya\Model\Checkout\Item;
use PayMaya\Model\Checkout\ItemAmount;
use PayMaya\Model\Checkout\ItemAmountDetails;
use PayMaya\Model\Checkout\Address;
use PayMaya\Model\Checkout\Contact;
use PayMaya\API\Customization;

PayMaya\PayMayaSDK::getInstance()->initCheckout('pk-AyydW1knvyLFfmNI3Xme9Lzi2dvSFQJgtCgGEJK6mZL', 'sk-OKMK8pGN1PpG219mzO3yhxWkrkfYdr5vWYWAtFJ8vDp', 'SANDBOX');

if (isset($_POST)) {
$billing_id = $_POST['billing_id'];
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if ($_POST['payment_method'] == 'paymaya') {

        $shopCustomization = new Customization();
        $shopCustomization->logoUrl = $logo_url;
        $shopCustomization->iconUrl = $icon_url;
        $shopCustomization->appleTouchIconUrl = "https://cdn.paymaya.com/production/checkout_api/customization_example/youricon_ios.ico";
        $shopCustomization->customTitle = "RPT - PAYMENT";
        $shopCustomization->colorScheme = "#368d5c";
        $shopCustomization->set();





        $itemCheckout = new PayMaya\API\Checkout();
        /*
        $address = new Address();
        $address->line1 = "6th Floor, LaunchPad Building";
        $address->line2 = "Reliance Street";
        $address->city = "Mandaluyong City";
        $address->state = "Metro Manila";
        $address->zipCode = "12345";
        $address->countryCode = "PH";
        */

        $contact = new Contact();
        $contact->phone = $_SESSION['user']['mobile_number'];
        $contact->email =strtolower($_SESSION['user']['firstname'].'.'.$_SESSION['user']['lastname']."@gmail.com");

        $buyer = new Buyer();
        //$buyer->firstName = ucfirst($_POST['firstname']);
        $buyer->firstName = 'Ashbee';
        //$buyer->middleName = ucfirst($_POST['mi']);
        $buyer->lastName = 'Morgado';
        //$buyer->lastName = ucfirst($_POST['lastname']);
        $buyer->contact = $contact;
        //$buyer->shippingAddress = $address;
        //$buyer->billingAddress = $address;

        $itemCheckout->buyer = $buyer;
        $itemAmountDetails = new PayMaya\Model\Checkout\ItemAmountDetails();
        $itemAmountDetails->shippingFee = "0.00";
        $itemAmountDetails->tax = "0.00";
        $itemAmountDetails->subtotal = $_POST['amount2'];
        $itemAmountDetails->serviceCharge = "0.00";
        $itemAmount = new PayMaya\Model\Checkout\ItemAmount();
        $itemAmount->currency = "PHP";
        $itemAmount->value = $_POST['amount2'];
        $itemAmount->details = $itemAmountDetails;
        
        $item = new PayMaya\Model\Checkout\Item();

        $item->value = $_POST['amount2'];
        $item->name = $_POST['payment_name'];
        $item->code = 	 '1';
        $item->description = $_POST['payment_description'];
        $item->quantity = "1";
        $item->amount = $itemAmount;
        $item->totalAmount = $itemAmount;

        $itemCheckout->items = array($item);
        $itemCheckout->totalAmount = $itemAmount;

        // The requestReferenceNumber is an identifier for the customer's order.
        $itemCheckout->requestReferenceNumber = "123456789";
       
    var_dump($itemCheckout);exit;
        
        // Redirect URLs are used to direct the customer to the correct
        // page based on the transaction outcome.
        // Redirect URLs should not be used to set the status of an order
        // to "paid" as the customer might quit the browser prior the redirection.
        
        
       $itemCheckout->redirectUrl = array(
            "success" => $actual_link.'?b_id='.$billing_id,
            "failure" => $_SERVER['HTTP_HOST'].'/user/error.php',
            "cancel" =>  $_SERVER['HTTP_HOST'].'/user/cancel.php'
        );
       
       $itemCheckout->execute();
       // var_dump($itemCheckout);
       $itemCheckout->retrieve();

        // Uncomment to redirect the user to the Checkout page.;
            
        $_SESSION['checkout']=$itemCheckout;
        header("Location:" . $itemCheckout->url);
        echo '<a href="'.$itemCheckout->url.'">Check out</a>';
        

        exit;

    }elseif($payment_type ="stripe") {

       
exit;
        $stripe = array(
          "secret_key"      => "sk_test_doyM4Xht0ica9M2MKiGIIdrd",
          "publishable_key" => "pk_test_pgJq2Y99jLKJ3GTPWD7TyZ9g"
        );


        \Stripe\Stripe::setApiKey($stripe['secret_key']);
          $charge = \Stripe\Charge::create(array(
              'card' => $_POST['stripeToken'],
              'amount'   => $_POST['amount'],
              'currency' => 'usd',
              'description'=>
              'Payment for Real Property Tax ['.$_SESSION['user']['firstname'].' '.$_SESSION['user']['lastname'].']'
          ));
          $checkoutID = $charge->id;
          
          if(checkoutPayment($billing_id,$checkoutID,$_POST['amount'])){
                $arr_post_body = array(
                "message_type" => "SEND",
                "mobile_number" => $data['mobile_number'],
                "shortcode" => "29290 951011",
                "message_id" => "12345678901234567890123456789012",
                "message" => urlencode("Welcome to My Service!"),
                "client_id" => "07a28c3017c007c0e318b6a1b4e0abff44dd23b1b88a5d360b75a268ac30374e",
                "secret_key" => "b73fd9702ab4d553d71585b1c7ce9eb149e1a42964ced1bbaa1bba13d911607f"
            );

            $query_string = "";
            foreach($arr_post_body as $key => $frow)
            {
                $query_string .= '&'.$key.'='.$frow;
            }

            $URL = "https://post.chikka.com/smsapi/request";

            $curl_handler = curl_init();
            curl_setopt($curl_handler, CURLOPT_URL, $URL);
            curl_setopt($curl_handler, CURLOPT_POST, count($arr_post_body));
            curl_setopt($curl_handler, CURLOPT_POSTFIELDS, $query_string);
            curl_setopt($curl_handler, CURLOPT_RETURNTRANSFER, TRUE);
            $response = curl_exec($curl_handler);
            curl_close($curl_handler);

          header('location:bills_payments.php?billing_id='.$billing_id.'checkout='.$checkoutID);
          exit;
      }

    }    

    echo "Error in creating a Checkout object.";
        //header("Location:http://www.yourwebsite.com/page.php");
}
?>