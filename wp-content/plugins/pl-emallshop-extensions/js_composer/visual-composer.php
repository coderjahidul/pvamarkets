<?php
/*
* @author  PressLayouts
* @package PL EmallShop Extensions
* @version 1.0
*/
 
if ( ! defined( 'ABSPATH' ) ):
	exit; // Exit if accessed directly
endif;

require_once ES_EXTENSIONS_PATH . '/js_composer/custom-fields.php';
if(is_plugin_active( 'woocommerce/woocommerce.php' )){
	require_once ES_EXTENSIONS_PATH . '/js_composer/shortcodes/category-products-with-tab.php';
	require_once ES_EXTENSIONS_PATH . '/js_composer/shortcodes/products-carousel.php';
	require_once ES_EXTENSIONS_PATH . '/js_composer/shortcodes/category-and-sub-category.php';
	require_once ES_EXTENSIONS_PATH . '/js_composer/shortcodes/products-brands.php';
	require_once ES_EXTENSIONS_PATH . '/js_composer/shortcodes/hot-deal-products.php';
	require_once ES_EXTENSIONS_PATH . '/js_composer/shortcodes/products-sidebar.php';
}
require_once ES_EXTENSIONS_PATH . '/js_composer/shortcodes/vertical-menu.php';
require_once ES_EXTENSIONS_PATH . '/js_composer/shortcodes/blogs-carousel.php';
require_once ES_EXTENSIONS_PATH . '/js_composer/shortcodes/blogs-listing.php';
require_once ES_EXTENSIONS_PATH . '/js_composer/shortcodes/portfolios-listing.php';
//require_once ES_EXTENSIONS_PATH . '/js_composer/shortcodes/services.php';
require_once ES_EXTENSIONS_PATH . '/js_composer/shortcodes/newsletter.php';
require_once ES_EXTENSIONS_PATH . '/js_composer/shortcodes/testimonials.php';
