<?php

namespace App\Router;

use App\Action\Redirect;

class Router
{
    public static function router()
    {
        return [
            'successRoute' => [
                'url' => 'sinek-payment-success',
                'should_login'=>false,
                'page_title' => 'Login',
                'action' => [Redirect::class, 'success']
            ],
            'failedRoute' => [
                'url' => 'sinek-payment-failed',
                'should_login'=>false,
                'page_title' => 'Login',
                'action' => [Redirect::class, 'failed']
            ]
        ];
    }
}
