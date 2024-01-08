<?php

class PaypalGateway extends WC_Gateway_Sinek{
    public function __construct()
    {
        $this->id = 'sinek_paypal_gateway';
        $this->method_title = 'Paypal';
        $this->alias = 'Paypal';
        parent::__construct();
    }
}