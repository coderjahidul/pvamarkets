<?php

$parameters = [
    'amount' => 50,
    'currency' => 'USD',
    'details' => 'Payment description',
    'custom' => 'DFU80XZIKS',
    'ipn_url' => 'http://example.com/ipn_url.php',
    'redirect_url' => 'http://example.com/redirect_url.php',
    'failed_url' => 'http://example.com/failed_url.php',
    'name' => 'John Doe',
    'email' => 'john@doe.com',
    'alias' => 'Paypal'
];

$url = 'https://payment.markethunter.xyz/api/payment/initiate';

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS,  $parameters);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);

$result = json_decode($result);
var_dump($result);
//$result contains the response back.
?>