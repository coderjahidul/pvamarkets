<?php

use App\Lib\ViserSession;

function dd(...$info){
    foreach ($info as $data) {
        echo "<pre style='padding: 10px;background: #000842;color: #07db07;'>";
        print_r($data);
        echo "</pre>";
    }
    exit;
}

function setNotify($data)
{
    viserSession()->flash('notify', $data);
}

function viserSession()
{
    return new ViserSession();
}


function view($view,$data = [])
{
    extract( $data );
    echo "<div class='viser-layout'>";
    include VISER_ROOT.'views/'.$view.'.php';
    echo "</div>";
}

function keyToTitle($text)
{
    return ucfirst(preg_replace("/[^A-Za-z0-9 ]/", ' ', $text));
}

function titleToKey($text)
{
    return strtolower(str_replace(' ', '_', $text));
}

function viserCur($type)
{
    return get_option("hyiplab_currency_$type");
}

function viserRedirect($url)
{
    wp_redirect($url);
    exit;
}

function back()
{
    if (isset($_SERVER['HTTP_REFERER'])) {

        $url = $_SERVER['HTTP_REFERER'];
    } else {
        $url = home_url();
    }
    viserRedirect($url);
}

function validate($rules)
{
    $messages = [];
    foreach($rules as $key => $rule){
        $fieldName = ucfirst(str_replace('_',' ',$key));
        foreach ($rule as $validation) {
            if ($validation == 'required') {
                if (!@$_POST[$key] || @strval($_POST[$key]) == '') {
                    $messages[] = "$fieldName field is required";
                    continue;
                }
            }

            if ($validation == 'integer') {
                if (@$_POST[$key] && !is_int(intval($_POST[$key]))) {
                    $messages[] = "$fieldName must be an integer";
                }
            }

            if ($validation == 'numeric') {
                if (@$_POST[$key] && !is_numeric(floatval($_POST[$key]))) {
                    $messages[] = "$fieldName must be a numeric";
                }
            }
        }
    }

    if (!empty($messages)) {
        foreach ($messages as $message) {
            $notify[] = ['error',$message];
        }
        setNotify($notify);
        back();
    }
}


function queryToUrl($arr){
    return add_query_arg($arr,$_SERVER['REQUEST_URI']);
}

function getAmount($amount, $length = 2)
{
    $amount = round($amount, $length);
    return $amount + 0;
}

function showAmount($amount, $decimal = 2, $separate = true, $exceptZeros = false)
{
    $separator = '';
    if ($separate) {
        $separator = ',';
    }
    $printAmount = number_format($amount, $decimal, '.', $separator);
    if ($exceptZeros) {
        $exp = explode('.', $printAmount);
        if ($exp[1] * 1 == 0) {
            $printAmount = $exp[0];
        } else {
            $printAmount = rtrim($printAmount, '0');
        }
    }
    return $printAmount;
}


function templateView($view, $data = [])
{
    global $viserData;
    $viserData = $data;
    include VISER_ROOT . 'views/' . $view . '.php';
    exit;
}