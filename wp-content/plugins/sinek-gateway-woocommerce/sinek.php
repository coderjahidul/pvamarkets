<?php

require_once __DIR__.'/vendor/autoload.php';

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://sinek.io
 * @since             1.0.0
 * @package           Sinek
 *
 * @wordpress-plugin
 * Plugin Name:       Sinek
 * Description:       Sinek payment gateway for WooCommerce
 * Version:           1.0.0
 * Author:            sinek
 * Author URI:        https://sinek.io
 * Text Domain:       sinek
 */

use App\Includes\ViserActivator;
use App\Includes\ViserPlugin;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Rename this for your plugin and update it as you release new versions.
 */
define('VISER_PLUGIN_VERSION', '1.0.0');
define('VISER_PLUGIN_NAME', 'sinek');
define('VISER_ROOT', plugin_dir_path(__FILE__));
define('VISER_PLUGIN_URL', str_replace('index.php','',plugins_url( 'index.php', __FILE__ )));



$activator = new ViserActivator();


register_activation_hook( __FILE__, [$activator, 'activate']);
register_deactivation_hook( __FILE__, [$activator, 'deactivate']);



function sinek_init()
{

	if ( !class_exists( 'WC_Payment_Gateway' ) ) return;

	include 'gateway/class-sinek-gateway.php';
	include 'gateway/class-stripe-gateway.php';
	include 'gateway/class-paypal-gateway.php';
	include 'gateway/class-nmi-gateway.php';
	include 'gateway/class-authorize-gateway.php';

	add_filter( 'woocommerce_payment_gateways', 'sinek_gateway' );

	function sinek_gateway( $methods )
	{

		$methods[] = 'StripeGateway';
		$methods[] = 'PaypalGateway';
		$methods[] = 'NmiGateway';
		$methods[] = 'AuthorizeGateway';

		return $methods;

	}
	
	if (!get_option('woocommerce_sinek_payment_domains') || !get_option('woocommerce_sinek_api_secret')) {
        add_action('admin_notices', 'account_add_notice');
    }
    
    function account_add_notice()
    {
        echo '<div class="notice notice-warning">Please steup your Sinek payment domain and api secret from <a href="' . admin_url('admin.php?page=wc-settings&tab=sinek_tab') . '">WooCommerce Sinek Setting</a>.</div>';
    }

}
add_action( 'plugins_loaded', 'sinek_init' );

// Register a new tab
function sinek_woocommerce_settings_tabs($settings_tabs) {
    $settings_tabs['sinek_tab'] = __('Sinek', 'sinek-woocommerce-settings');
    return $settings_tabs;
}
add_filter('woocommerce_settings_tabs_array', 'sinek_woocommerce_settings_tabs', 50);

// Display the new tab content
function sinek_woocommerce_settings_tab() {
    ?>
    <h2><?php _e('Sinek', 'sinek-woocommerce-settings'); ?></h2>
    <table class="form-table sinek-form-table">
		<tr>
			<th><?php _e('Payment Domain', VISER_PLUGIN_NAME); ?></th>
			<td>
				<input type="text" name="woocommerce_sinek_payment_domains[]" value="<?php echo @get_option('woocommerce_sinek_payment_domains')[0] ?>" /> <button type="button" style="cursor: pointer;
    background: #05d505;
    border: none;
    color: #fff;
    height: 30px;
    width: 30px;
    line-height: 30px;
    border-radius: 2px;" class="sinekAddNewBtn">+</button>
			</td>
		</tr>
		<?php
		$paymentDomains = get_option('woocommerce_sinek_payment_domains');
		if (!$paymentDomains) {
			$paymentDomains = [];
		}
		array_shift($paymentDomains);
			foreach($paymentDomains as $key => $paymentDomain){
		?>

<tr>
                <th></th>
                <td>
                    <input type="text" name="woocommerce_sinek_payment_domains[]" value="<?php echo $paymentDomain ?>" /> <button type="button" style="cursor: pointer;
        background: #d50505;
        border: none;
        color: #fff;
        height: 30px;
        width: 30px;
        line-height: 28px;
        border-radius: 2px;" class="sinekRemoveBtn">x</button>
                </td>
            </tr>
		
		<?php
			}
		?>
    </table>
	<table class="form-table">
		<tr>
			<th><?php _e('API Secret', VISER_PLUGIN_NAME); ?></th>
			<td>
				<input type="text" name="woocommerce_sinek_api_secret" value="<?php echo get_option('woocommerce_sinek_api_secret') ?>" />
			</td>
		</tr>
    </table>
    <?php
}
add_action('woocommerce_settings_tabs_sinek_tab', 'sinek_woocommerce_settings_tab');


function sinek_plugin_enqueue_scripts( $hook ) {
    wp_enqueue_script( 'sinek-custom-js', plugins_url( 'assets/js/sinek.js', __FILE__ ), array( 'jquery' ), '1.0', true );
}
add_action( 'admin_enqueue_scripts', 'sinek_plugin_enqueue_scripts' );

// Save the form data
function sinek_woocommerce_settings_save() {
	if ($_POST['woocommerce_sinek_api_secret']) {
		update_option('woocommerce_sinek_api_secret',$_POST['woocommerce_sinek_api_secret']);
	}
	if ($_POST['woocommerce_sinek_payment_domains']) {
		update_option('woocommerce_sinek_payment_domains',$_POST['woocommerce_sinek_payment_domains']);
	}
}
add_action('woocommerce_update_options_sinek_tab', 'sinek_woocommerce_settings_save');



$plugin = new ViserPlugin();
$plugin->run();