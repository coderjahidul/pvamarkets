<?php

$pathinfo=pathinfo(__FILE__);

require($pathinfo['dirname'].'/../../../wp-load.php');
require_once('gateway-pm.php');

$wc=new WC_Gateway_Pm();
$wc->confirmation_handler->check_response();

?>