<?php
/*
* @author  PressLayouts
* @package PL EmallShop Extensions
* @version 1.0
*/
 
if ( ! defined( 'ABSPATH' ) ):
	exit; // Exit if accessed directly
endif;

add_action('after_setup_theme', 'emallshop_add_vc_params', 1);

function emallshop_add_vc_params(){
	vc_add_shortcode_param( 'emallshop_product_categories', 'emallshop_get_product_categories' );
	vc_add_shortcode_param( 'emallshop_product_cates_with_none', 'emallshop_get_product_cates_with_none' );
	vc_add_shortcode_param( 'emallshop_brands', 'emallshop_get_brands' );
	vc_add_shortcode_param( 'emallshop_categories_with_none', 'emallshop_get_categories_with_none' );
	vc_add_shortcode_param( 'emallshop_service_category_with_none', 'emallshop_get_services_cates_with_none' );
}
function emallshop_get_product_categories($settings, $value)
{
	$args = array(
      'id'           => $settings['param_name'],
      'name'         => $settings['param_name'],
      'class'        => 'parent-category wpb_vc_param_value',
      'hide_empty'   => 1,
      'orderby'      => 'name',
      'order'        => "desc",
      'tab_index'    => true,
      'hierarchical' => true,
      'echo'         => 0,
      'selected'     => $value,
	  'taxonomy'     => 'product_cat',
	  'value_field'	 => 'slug',
    );
  
    return wp_dropdown_categories( $args );
}

function emallshop_get_product_cates_with_none($settings, $value)
{
	$args = array(
      'id'           => $settings['param_name'],
      'name'         => $settings['param_name'],
      'class'        => 'parent-category-none wpb_vc_param_value',
	  'show_option_none' => esc_html__( 'Select category','pl-emallshop-extensions' ),
	  'option_none_value' => '-1',
      'hide_empty'   => 1,
      'orderby'      => 'name',
      'order'        => "desc",
      'tab_index'    => true,
      'hierarchical' => true,
      'echo'         => 0,
      'selected'     => $value,
	  'taxonomy'     => 'product_cat',
	  'value_field'	 => 'slug',
    );  
    return wp_dropdown_categories( $args );
}

function emallshop_get_brands($settings, $value)
{
	$args = array(
      'id'           => $settings['param_name'],
      'name'         => $settings['param_name'],
      'class'        => 'emallshop-brand wpb_vc_param_value',
	  'show_option_none' => esc_html__( 'Select brand','pl-emallshop-extensions' ),
	  'option_none_value' => '-1',
      'hide_empty'   => 1,
      'orderby'      => 'name',
      'order'        => "desc",
      'tab_index'    => true,
      'hierarchical' => true,
      'echo'         => 0,
      'selected'     => $value,
	  'taxonomy'     => 'product_brand',
	  'value_field'	 => 'slug',
    );  
    return wp_dropdown_categories( $args );
}
function emallshop_get_categories_with_none($settings, $value)
{
	$args = array(
      'id'           => $settings['param_name'],
      'name'         => $settings['param_name'],
      'class'        => 'parent-category wpb_vc_param_value',
	  'show_option_none' => esc_html__( 'Select category','pl-emallshop-extensions' ),
	  'option_none_value' => '-1',
      'hide_empty'   => 1,
      'orderby'      => 'name',
      'order'        => "desc",
      'tab_index'    => true,
      'hierarchical' => true,
      'echo'         => 0,
      'selected'     => $value,
	  'taxonomy'     => 'category',
	  'value_field'	 => 'slug',
    );  
    return wp_dropdown_categories( $args );
}

function emallshop_get_services_cates_with_none($settings, $value)
{
	$args = array(
      'id'           => $settings['param_name'],
      'name'         => $settings['param_name'],
      'class'        => 'parent-category wpb_vc_param_value',
	  'show_option_none' => esc_html__( 'Select category','pl-emallshop-extensions' ),
	  'option_none_value' => '-1',
      'hide_empty'   => 1,
      'orderby'      => 'name',
      'order'        => "desc",
      'tab_index'    => true,
      'hierarchical' => true,
      'echo'         => 0,
      'selected'     => $value,
	  'taxonomy'     => 'service_cat',
	  'value_field'	 => 'slug',
    );  
    return wp_dropdown_categories( $args );
}