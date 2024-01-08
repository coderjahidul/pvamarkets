<?php

$parameters = [
    'amount' => 50,
    'currency' => 'USD',
    'details' => 'Payment description',
    'custom' => 'DFU80XZIKS',
    'ipn_url' => 'https://accountsseller.com',
    'redirect_url' => 'https://accountsseller.com/',
    'failed_url' => 'https://accountsseller.com',
    'name' => 'John Doe',
    'email' => 'john@doe.com',
    'alias' => 'Stripe'
];

$url = 'https://payment.blueprintedge.xyz/api/payment/initiate';

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS,  $parameters);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);
var_dump($result);
exit;
$result = json_decode($result);

//$result contains the response back.
?>