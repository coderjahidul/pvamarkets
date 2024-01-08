<?php
/**
 * @author  PressLayouts
 * @package PL EmallShop Extensions
 * @version 1.1.4
 */

require_once ES_EXTENSIONS_PATH .'widgets/general_widgets.php';

/**
 * Register widgets
 *
 * @since  1.1.4
 *
 * @return void
 */
function emallshop_register_general_widgets() {
	
	register_widget('EmallShop_Products_Widget');
	register_widget('EmallShop_Brand_Filter_Widget');
	register_widget('EmallShop_Brand_Slider_Widget');
	
	register_widget('EmallShop_QRCode_Widget');
	register_widget('EmallShop_Recent_Posts_Widget');
	register_widget('EmallShop_Portfolio_Widget');
	register_widget('EmallShop_Testimonial_Widget');	
    register_widget('EmallShop_Twitter_Widget'); 
	register_widget('EmallShop_About_Us_Widget');
	register_widget('EmallShop_Newsletter_Widget'); 
	register_widget('EmallShop_Stay_Connected_Widget');
	//register_widget('EmallShop_Services_Widget');
	//register_widget('EmallShop_Block_Widget'); 
	//register_widget('EmallShop_Follow_Us_Widget'); 
}

add_action( 'widgets_init', 'emallshop_register_general_widgets' );
