<?php

class StripeGateway extends WC_Gateway_Sinek{
    public function __construct()
    {
        $this->id = 'sinek_stripe_gateway';
        $this->alias = 'Stripe';
        $this->method_title = 'Stripe';
        
        parent::__construct();
    }
}