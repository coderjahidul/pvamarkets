<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Perfect Money confirmation handling.
 */
class WC_Gateway_Pm_Confirmation_Handler {

	public function __construct($payee_account, $alternate_passhprase) {

		$this->payee_account = $payee_account;		
        $this->alternate_passhprase = $alternate_passhprase;		
                
	}


	protected function validate_amount($order, $amount){
            
		if(number_format(($order->get_total()-round($order->get_total_shipping()+$order->get_shipping_tax())), 2)!=$amount){
                    
			WC_Gateway_Pm::log('Payment error: Amounts do not match');

			// Put this order on-hold for manual checking.
			$order->update_status('on-hold', __( 'Validation error: Perfect Money amounts do not match.', 'woocommerce'));
			exit;
                        
		}
                
	}
        

	protected function validate_account($order, $account){
            
		if($account!=$this->payee_account){
                    
			WC_Gateway_Pm::log("Accounts does not match");

			// Put this order on-hold for manual checking.
			$order->update_status('on-hold', __( 'Accounts does not match', 'woocommerce'));
			exit;
                        
		}
                
	}


	public function check_response(){

		echo "<pre>";
		print_r( $_REQUEST );
		echo "</pre>";

		$string=
			  $_POST['PAYMENT_ID'].':'.$_POST['PAYEE_ACCOUNT'].':'.
			  $_POST['PAYMENT_AMOUNT'].':'.$_POST['PAYMENT_UNITS'].':'.
			  $_POST['PAYMENT_BATCH_NUM'].':'.
			  $_POST['PAYER_ACCOUNT'].':'.strtoupper(md5($this->alternate_passhprase)).':'.
			  $_POST['TIMESTAMPGMT'];

		$hash=strtoupper(md5($string));

		if($hash===$_POST['V2_HASH']){ // processing payment if only hash is valid

		   $order=wc_get_order($_POST['PAYMENT_ID']);

      	   if($order->has_status('completed')){
				WC_Gateway_Pm::log('Aborting, Order #'.$order->id.' is already complete.');
				exit;
		   }

		   $this->validate_amount($order, $_POST['PAYMENT_AMOUNT']);
		   $this->validate_account($order, $_POST['PAYEE_ACCOUNT']);

		   $order->add_order_note(__('PM payment completed', 'woocommerce'));
		   $order->payment_complete($_POST['PAYMENT_ID']);

		}else{ // you can also save invalid payments for debug purposes

			WC_Gateway_Pm::log('Hash mismatch: '.$_POST['V2_HASH'].' vs. '.$hash);

		}

	}

}
