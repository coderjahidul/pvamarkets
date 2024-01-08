<?php

class WC_Gateway_Sinek extends WC_Payment_Gateway
{

    public function __construct()
    {
        $this->init_form_fields();
        $this->init_settings();

        $this->has_fields = false;

        $this->title = $this->get_option('title');
        $this->description = $this->get_option('description');

        $this->method_description = $this->get_option('description');

        $this->success_page_id = $this->get_option('success_page_id');
        $this->cancel_page_id = $this->get_option('cancel_page_id');

        add_action('woocommerce_receipt_' . $this->id, array($this, 'payment_init'));
        add_action('woocommerce_update_options_payment_gateways_' . $this->id, [$this, 'process_admin_options']);

        if (!defined('VISER_CALLBACK_URL')) {
            define('VISER_CALLBACK_URL', WC()->api_request_url('wc_' . $this->id));
        }
        add_action('woocommerce_api_wc_' . $this->id, array($this, 'wc_ipn'));
    }

    public function process_payment($order_id)
    {

        $order = wc_get_order($order_id);

        return array(
            'result' => 'success',
            'redirect' => $order->get_checkout_payment_url(true)
        );
    }


    public function init_form_fields()
    {
        $fields = array(
            'enabled' => array(
                'title' => 'Enable/Disable',
                'type' => 'checkbox',
                'label' => 'Enable Payment Module.',
                'default' => 'no'
            ),
            'title' => array(
                'title' => 'Title:',
                'type' => 'text',
                'description' => 'This controls the title which the user sees during checkout.',
                'default' => VISER_PLUGIN_NAME
            ),
            'description' => array(
                'title' => 'Description:',
                'type' => 'textarea',
                'description' => 'This controls the description which the user sees during checkout.',
                'default' => ''
            ),
        );
        $this->form_fields = array_merge($fields, array(
            'success_page_id' => array(
                'title' => 'Success Page',
                'type' => 'select',
                'options' => $this->get_pages('Select Page'),
                'description' => "URL of success page"
            ),
            'cancel_page_id' => array(
                'title' => 'Cancel Page',
                'type' => 'select',
                'options' => $this->get_pages('Select Page'),
                'description' => "URL of cancel page"
            )
        )
        );
    }

    public function process_admin_options()
    {

        $this->init_settings();

        $post_data = $this->get_post_data();
        foreach ($this->get_form_fields() as $key => $field) {
            if ('title' !== $this->get_field_type($field)) {
                try {
                    $this->settings[$key] = $this->get_field_value($key, $field, $post_data);
                } catch (Exception $e) {
                    $this->add_error($e->getMessage());
                }
            }
        }

        return update_option($this->get_option_key(), apply_filters('woocommerce_settings_api_sanitized_fields_' . $this->id, $this->settings), 'yes');
    }


    public function payment_init($order)
    {
        $order = wc_get_order($order);
        $amount = $order->get_total();
        $order_id = method_exists($order, 'get_id') ? $order->get_id() : $order->id;
        $productinfo = "WooCommerce Payment for Order ID: $order_id";

        $success_page = ($this->success_page_id == "" || $this->success_page_id == 0) ? get_site_url() . "/" : get_permalink($this->success_page_id);
        $cancel_page = ($this->cancel_page_id == "" || $this->cancel_page_id == 0) ? get_site_url() . "/" : get_permalink($this->cancel_page_id);

        if ($this->alias == 'Nmi' || $this->alias == 'Authorize') {
            $success_page = get_site_url() . '/index.php/sinek-payment-success?redirect_to=' . $success_page;
            $cancel_page = get_site_url() . '/index.php/sinek-payment-failed?redirect_to=' . $cancel_page;
        }
        $fullname = $order->get_billing_first_name() . ' ' . $order->get_billing_last_name();
        if (!trim($fullname)) {
            $emailData = explode('@', $order->get_billing_email());
            $fullname = ucfirst(preg_replace("/[^a-zA-Z]/", "", $emailData[0]));
        }

        $parameters = [
            'amount' => $amount,
            'currency' => get_woocommerce_currency(),
            'details' => $productinfo,
            'custom' => $order_id,
            'ipn_url' => VISER_CALLBACK_URL,
            'redirect_url' => $success_page,
            'failed_url' => $cancel_page,
            'firstname' => $order->get_billing_first_name() ? $order->get_billing_first_name() : 'N/A',
            'lastname' => $order->get_billing_last_name() ? $order->get_billing_last_name() : 'N/A',
            'email' => $order->get_billing_email() ? $order->get_billing_email() : 'N/A',
            'address' => @$order->get_billing_address_1() ? $order->get_billing_address_1() : 'N/A',
            'state' => @$order->get_billing_state() ? $order->get_billing_state() : 'N/A',
            'zip' => @$order->get_billing_postcode() ? $order->get_billing_postcode() : 'N/A',
            'country' => @$order->get_billing_country() ? $order->get_billing_country() : 'N/A',
            'city' => @$order->get_billing_city() ? $order->get_billing_city() : 'N/A',
            'alias' => $this->alias
        ];

        $paymentDomains = @get_option('woocommerce_sinek_payment_domains') ?? [];
        $payDomain = @get_option('woocommerce_sinek_next_payment_domains');
        if (!$payDomain) {
            $payDomain = 0;
        }
        $payemntDomain = $paymentDomains[$payDomain];

        $payemntScret = get_option('woocommerce_sinek_api_secret');
        if (!$payemntDomain || !$payemntScret) {
            echo '<ul style="background: #ff1b1b29;color: #ff1b1b;padding-top: 6px;padding-bottom: 6px;font-weight: 500;"><li>Payment gateway configuratin is not complete yet!</strong></li></ul>';
        } else {

            $url = "$payemntDomain/api/payment/initiate";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);

            $result = json_decode($result);

            if (@$result->status == 'error') {
                $messages = $result->message;
                $error = '<ul style="background: #ff1b1b29;color: #ff1b1b;padding-top: 6px;padding-bottom: 6px;font-weight: 500;">';
                foreach ($messages->error as $key => $message) {

                    $error .= "<li>$message </li>";
                }
                $error .= '<ul>';
                echo $error;
            }
            if (@$result->data->redirect_url) {
                viserRedirect(@$result->data->redirect_url);
            }
            if (@$result->data->iframe_url) {
                echo '<iframe src="' . @$result->data->iframe_url . '" height="500" width="720" frameborder="0"></iframe>';
            }
        }

    }

    public function wc_ipn()
    {

        //Receive the response parameter
        $signature = $_POST['signature'];
        $custom = $_POST['custom'];
        $trx = $_POST['trx'];
        $amount = $_POST['amount'];
        $currency = $_POST['currency'];

        $order = wc_get_order($custom);

        $order->add_order_note('kisu akta add hobe');

        // Generate your signature
        $customKey = $amount . $currency . $custom . $trx;
        $secret = get_option('woocommerce_sinek_api_secret');
        $mySignature = strtoupper(hash_hmac('sha256', $customKey, $secret));

        if ($signature == $mySignature && $amount == $order->get_total()) {
            $message = 'Payment Successful. Transaction Reference: ' . $trx;
            $message_type = 'success';

            //Add admin order note
            $order->add_order_note('Payment Via ' . $this->method_title . ' Transaction Reference: ' . $trx);

            //Add customer order note
            $order->add_order_note('Payment Successful. Transaction Reference: ' . $trx, 1);

            $order->payment_complete($trx);
            $order->reduce_order_stock();
            // Empty cart
            wc_empty_cart();

            $paymentDomains = @get_option('woocommerce_sinek_payment_domains') ?? [];
            $payDomain = @get_option('woocommerce_sinek_next_payment_domains');
            if (!$payDomain) {
                $payDomain = 0;
            }
            $payDomain++;
            $payemntDomain = @$paymentDomains[$payDomain];
            if (!$payemntDomain) {
                $payDomain = 0;
            }
            update_option('woocommerce_sinek_next_payment_domains', $payDomain);
        } else {
            //process a failed transaction
            $message = 'Payment Failed. Reason: Hash not matched. Transaction Reference: ' . $trx;
            $message_type = 'error';

            //Add Customer Order Note
            $order->add_order_note($message, 1);

            //Add Admin Order Note
            $order->add_order_note($message);

            //Update the order status
            $order->update_status('failed', '');
        }
    }

    function get_pages($title = false, $indent = true)
    {
        $wp_pages = get_pages('sort_column=menu_order');
        $page_list = array();
        if ($title)
            $page_list[] = $title;
        foreach ($wp_pages as $page) {
            $prefix = '';
            // show indented child pages?
            if ($indent) {
                $has_parent = $page->post_parent;
                while ($has_parent) {
                    $prefix .= ' - ';
                    $next_page = get_page($has_parent);
                    $has_parent = $next_page->post_parent;
                }
            }
            // add to page list array array
            $page_list[$page->ID] = $prefix . $page->post_title;
        }
        return $page_list;
    }
}