<?php

namespace App\Router;

class RouterCore{
    public function init()
    {
        add_action('template_redirect', [$this,'viserPages']);
    }

    public function viserPages()
    {
        global $wp_query;
        $routers = Router::router();
        foreach ($routers as $key => $router) {
            $pageName = @$wp_query->query['pagename'] ?? '';
            if (@$wp_query->query['page_slug']) {
                $pageName = $pageName.'/'.$wp_query->query['page_slug'];
            }
            if ($pageName && $pageName == $router['url']) {
                $wp_query->is_404 = false;
                status_header(200);
                // $this->checkLogin(array_key_exists('should_login',$router) ? $router['should_login'] : true);
                // if( isset($wp_query->query['page_slug']) ){
                //     $this->validatePostMethod(@$wp_query->query['page_slug']);
                // }
                // $this->setPageTitle(@$router['page_title'] ?? '');
                $action = new $router['action'][0]();
                $method = $router['action'][1];
                return $action->$method();
            }
        }
    }

    public function setPageTitle($pageTitle)
    {
        add_filter('wp_title', function($title,$sep) use ($pageTitle){
            return $pageTitle . $title;
        }, 10, 2);
    }

    private function checkLogin($shouldLogin)
    {
        if ($shouldLogin) {
            if (!is_user_logged_in()) {
                wp_redirect(home_url('login?redirect_to=user-dashboard'));
                exit;
            }
        }
    }
}