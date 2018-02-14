<?php
require __DIR__  . '../vendor/autoload.php';
require "config.php";
require "required/functions.php";


use Coreproc\Chikka\ChikkaClient;
use Coreproc\Chikka\Models\Sms;
use Coreproc\Chikka\Transporters\SmsTransporter;
	
	
$msg = 
"Good Day, Ashbee Morgado Your account is now created on $GLOBAL_WEBSITE_NAME! 
Here are your credentials. 
Username: Ashbee 
Password: Morgado ";
  
		$clientId = '07a28c3017c007c0e318b6a1b4e0abff44dd23b1b88a5d360b75a268ac30374e';
		$secretKey = 'b73fd9702ab4d553d71585b1c7ce9eb149e1a42964ced1bbaa1bba13d911607f';
		$shortCode = '29290951011';




		$chikkaClient = new ChikkaClient($clientId, $secretKey, $shortCode);

		$sms = new Sms(rand(0,100000),'639171101126', $msg);

		$smsTransporter = new SmsTransporter($chikkaClient, $sms);

		$response = $smsTransporter->send();
		
?>