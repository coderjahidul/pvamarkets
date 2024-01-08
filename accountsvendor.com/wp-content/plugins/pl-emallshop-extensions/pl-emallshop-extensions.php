<?php
/*
Plugin Name: PL EmallShop Extensions
Plugin URI: http://themeforest.net/user/presslayouts
Description: VC Shortcode, Posts, widget and Data Importer for EmallShop eCommerce Theme.
Version: 1.1.9
Author: PressLayouts
Author URI: http://presslayouts.com
Text Domain: pl-emallshop-extensions
*/

// don't load directly
if (!defined('ABSPATH'))
    die('-1');

define("ES_EXTENSIONS_PATH", trailingslashit( plugin_dir_path(__FILE__) ) );
define("ES_EXTENSIONS_URL", trailingslashit( plugin_dir_url(__FILE__) ) );


// Load Custom Post types
require_once ES_EXTENSIONS_PATH .'posts/posts-content.php';

// Load Custom widget
require_once ES_EXTENSIONS_PATH .'widgets/widgets.php';

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

// Load plugin text domain
load_plugin_textdomain( 'pl-emallshop-extensions', false, plugin_basename( dirname( __FILE__ ) ) . "/languages" );

if ( !class_exists ( 'ReduxFramework' ) && file_exists ( ES_EXTENSIONS_PATH.'inc/ReduxCore/framework.php' ) ) {
    require_once ( ES_EXTENSIONS_PATH .'inc/ReduxCore/framework.php' );
} 

// Load Wordpress Importer plugin
require_once ES_EXTENSIONS_PATH .'inc/importer/importer.php';

// Load Cookie
require_once ES_EXTENSIONS_PATH .'inc/cookie-notice.php';


/**
 * Initialising Visual Composer
 */ 
if ( class_exists( 'Vc_Manager', false ) ) {
	require_once ES_EXTENSIONS_PATH . 'js_composer/visual-composer.php';
}