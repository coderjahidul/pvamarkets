<?php

class AuthorizeGateway extends WC_Gateway_Sinek{
    public function __construct()
    {
        $this->id = 'sinek_authorize_gateway';
        $this->alias = 'Authorize';
        $this->method_title = 'Authorize.net';
        parent::__construct();
    }
}