<?php

namespace App\Action;

class Redirect{
    public function success()
    {
        $redirectUrl = $_GET['redirect_to'];
        templateView('gateway/success',compact('redirectUrl'));
    }

    public function failed()
    {
        $redirectUrl = $_GET['redirect_to'];
        templateView('gateway/failed',compact('redirectUrl'));
    }
}