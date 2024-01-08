<?php
/**
 * Plugin Name: SoftTech IT Perfect Money
 * Plugin URI: http://your-plugin-website.com/
 * Version: 1.0.0
 * Author: SoftTech IT
 * Author URI: https://softtech-it.com/
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

add_action('plugins_loaded', 'woocommerce_pm_init', 0);

function woocommerce_pm_init(){

	if(!class_exists('WC_Payment_Gateway')) { return; }
	
	$plugin_dir = plugin_dir_path(__FILE__);
	

	require_once $plugin_dir . 'gateway-pm.php';

	/**
 	* Add the Gateway to WooCommerce
 	**/
	function add_pm_gateway($methods) {
		$methods[] = 'WC_Gateway_Pm';
		return $methods;
	}
	
	add_filter('woocommerce_payment_gateways', 'add_pm_gateway' );

} 
