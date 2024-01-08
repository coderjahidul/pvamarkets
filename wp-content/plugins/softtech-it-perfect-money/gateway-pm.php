<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Perfect Money payment gateway Class.
 */
class WC_Gateway_Pm extends WC_Payment_Gateway {

	/** @var bool Whether or not logging is enabled */
	public static $log_enabled = false;

	/** @var WC_Logger Logger instance */
	public static $log = false;
        
    public $confirmation_handler;

	/**
	 * Constructor for the gateway.
	 */
	public function __construct() {
		$this->id                 = 'pm';
		$this->has_fields         = false;
		$this->order_button_text  = __( 'Proceed to Perfect Money', 'woocommerce');
		$this->method_title       = __( 'Perfect Money', 'woocommerce');
		$this->supports           = array(
			'products'
		);

		// Load the settings.
		$this->init_form_fields();
		$this->init_settings();

		// Define user set variables.
		$this->title          = $this->get_option('title');
		$this->debug          = 'yes' === $this->get_option('debug', 'no');
		$this->payee_account  = $this->get_option('payee_account', $this->payee_account = '');
		$this->alternate_passphrase = $this->get_option('alternate_passphrase');
                
		self::$log_enabled    = $this->debug;

		add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
		add_action('woocommerce_receipt_'.$this->id, array($this, 'receipt_page'));

        include_once('includes/gateway-pm-confirmation-handler.php');
		$this->confirmation_handler=new WC_Gateway_Pm_Confirmation_Handler($this->payee_account, $this->alternate_passphrase);

	}

	/**
	 * Logging method.
	 * @param string $message
	 */
	public static function log($message){
		if(self::$log_enabled){
			if(empty(self::$log)){
				self::$log = new WC_Logger();
			}
			self::$log->add('pm', $message);
		}
	}

	/**
	 * Get gateway icon.
	 * @return string
	 */
	public function get_icon() {

		$icon_html='<img src="' . WC_HTTPS::force_https_url(content_url()) . '/plugins/softtech-it-perfect-money/assets/images/perfectmoney.png' . '" alt="' . esc_attr__( 'Perfect Money', 'woocommerce' ) . '" />';

		return apply_filters('woocommerce_gateway_icon', $icon_html, $this->id);
	}




	/**
	 * Initialise Gateway Settings Form Fields.
	 */
	public function init_form_fields(){
		$this->form_fields = include('includes/settings-pm.php');
	}


	/**
     *  There are no payment fields for PM, but we want to show the description if set.
     **/
    function payment_fields(){
        if($this -> description) echo wpautop(wptexturize($this -> description));
    }

    /**
     * Generate payment form
     **/
    public function generate_payment_form($order_id){
 
        global $woocommerce;
 
        $order = new WC_Order($order_id);
 
        $redirect_url = ($this -> redirect_page_id=="" || $this -> redirect_page_id==0)?get_site_url() . "/":get_permalink($this -> redirect_page_id);
 
        $productinfo = "Order $order_id";

	    $currs=array('U'=>'USD', 'E'=>'EUR');
		$cur_l=substr($this->payee_account, 0,1);
		$currency=$currs[$cur_l];



		return '<form action="https://perfectmoney.com/api/step1.asp" method="post" id="perfectmoney_payment_form">
<input type="hidden" name="SUGGESTED_MEMO" value="'.$productinfo.'">

<input type="hidden" name="PAYMENT_ID" value="'.$order_id.'" />
<input type="hidden" name="PAYMENT_AMOUNT" value="'.$order->order_total.'" />
<input type="hidden" name="PAYEE_ACCOUNT" value="'.$this->payee_account.'" />
<input type="hidden" name="PAYMENT_UNITS" value="'.$currency.'" />
<input type="hidden" name="PAYEE_NAME" value="'.get_option('blogname').'" />
<input type="hidden" name="PAYMENT_URL" value="'.$order->get_checkout_order_received_url().'" />
<input type="hidden" name="PAYMENT_URL_METHOD" value="LINK" />
<input type="hidden" name="NOPAYMENT_URL" value="'.$redirect_url.'" />
<input type="hidden" name="NOPAYMENT_URL_METHOD" value="LINK" />
<input type="hidden" name="STATUS_URL" value="'.get_site_url().'/wp-content/plugins/softtech-it-perfect-money/status_url.php" />

<input type="submit" class="button-alt" id="submit_perfectmoney_payment_form" value="'.__('Pay via Perfect Money', 'pm').'" />

<a class="button cancel" href="'.$order->get_cancel_order_url().'">'.__('Cancel order &amp; restore cart', 'pm').'</a>

<script type="text/javascript">
jQuery(function(){
jQuery("body").block(
        {
            message: "<img src=\"'.$woocommerce->plugin_url().'/assets/images/ajax-loader.gif\" alt=\"Redirecting…\" style=\"float:left; margin-right: 10px;\" />'.__('Thank you for your order. We are now redirecting you to Payment Gateway to make payment.', 'woocommerce').'",
                overlayCSS:
        {
            background: "#fff",
                opacity: 0.6
    },
    css: {
        padding:        20,
            textAlign:      "center",
            color:          "#555",
            border:         "3px solid #aaa",
            backgroundColor:"#fff",
            cursor:         "wait",
            lineHeight:"32px"
    }
    });
    jQuery("#submit_perfectmoney_payment_form").click();});</script>
            </form>';
 
 
    }

    /**
     * Receipt Page
     **/
    function receipt_page($order){
        echo '<p>'.__('Thank you for your order, please click the button below to pay with Perfect Money.', 'woocommerce').'</p>';
        echo $this->generate_payment_form($order);
    }


	/**
	 * Process the payment and return the result.
	 * @param  int $order_id
	 * @return array
	 */
    function process_payment($order_id){
        
        $order = new WC_Order($order_id);
        
        return array('result' => 'success', 'redirect' => add_query_arg(array(
                    'key' => $order->order_key,
                    'order' => $order->id
                ),
                wc_get_checkout_url()
            )
        );
        
    }
 

	/**
	 * Can the order be refunded via Pm?
	 * @param  WC_Order $order
	 * @return bool
	 */
	public function can_refund_order($orde){
		return false;
	}

	
}
