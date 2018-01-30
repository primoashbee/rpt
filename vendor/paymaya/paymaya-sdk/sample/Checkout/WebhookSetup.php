<?php

require __DIR__ . "/../autoload.php";

use PayMaya\PayMayaSDK;
use PayMaya\API\Webhook;

PayMayaSDK::getInstance()->initCheckout('pk-sEt9FzRUWI2PCBI2axjZ7xdBHoPiVDEEWSulD78CW9c', 'sk-cJFYCGhH4stZZTS52Z3dpNbrpRyu6a9iJaBiVlcIqZ5', 'SANDBOX');

$successWebhook = new Webhook();
$successWebhook->name = Webhook::CHECKOUT_SUCCESS;
$successWebhook->callbackUrl = "http://shop.someserver.com/success";
$successWebhook->register();

$failureWebhook = new Webhook();
$failureWebhook->name = Webhook::CHECKOUT_FAILURE;
$failureWebhook->callbackUrl = "http://shop.someserver.com/failure";
$failureWebhook->register();

$webhooks = Webhook::retrieve();
print_r($webhooks);

$webhook = $webhooks[0];
$webhook->callbackUrl .= "Updated";
$webhook->update();
print_r(Webhook::retrieve());

$webhookCopy = clone $webhook;
echo $webhook->delete();

print_r(Webhook::retrieve());

$webhookCopy->register();

print_r(Webhook::retrieve());