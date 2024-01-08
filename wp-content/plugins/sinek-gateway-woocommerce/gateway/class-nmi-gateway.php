<?php

class NmiGateway extends WC_Gateway_Sinek{
    public function __construct()
    {
        $this->id = 'sinek_nmi_gateway';
        $this->alias = 'Nmi';
        $this->method_title = 'Nmi';
        parent::__construct();
    }
}