<?php 
/**
 * EmallShop Extras Functions
 *
 * @package PressLayouts
 * @subpackage EmallShop
 * @since EmallShop 1.0
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/* 	Get activated theme
/* --------------------------------------------------------------------- */
if(!function_exists('emallshop_activated_theme')) {
    function emallshop_activated_theme() {
        $activated_data = get_option( 'emallshop_activated_data' );
        $theme = ( isset( $activated_data['theme'] ) && ! empty( $activated_data['theme'] ) ) ? $activated_data['theme'] : false ;
        return $theme;
    }

}

/* 	Is theme activatd
/* --------------------------------------------------------------------- */
if(!function_exists('emallshop_is_activated')) {
    function emallshop_is_activated() {
        if ( emallshop_activated_theme() != EMALLSHOP_PREFIX ) return false;
		if ( ! get_option( 'emallshop_is_activated' ) ) update_option( 'emallshop_is_activated', true );        
        return get_option( 'emallshop_is_activated', false );
    }
}

/* 	Check WooCommerce is activated
/* --------------------------------------------------------------------- */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		return class_exists( 'woocommerce' ) ? true : false;
	}
}

/* 	Check Dokan is activated
/* --------------------------------------------------------------------- */
if ( ! function_exists( 'is_dokan_activated' ) ) {
	function is_dokan_activated() {
		return class_exists( 'WeDevs_Dokan' ) ? true : false;
	}
}

/* 	Check WC Marketplace is activated
/* --------------------------------------------------------------------- */
if ( ! function_exists( 'is_WC_Marketplace_activated' ) ) {
	function is_WC_Marketplace_activated() {
		return class_exists( 'WCMp' ) ? true : false;
	}
}

/*Check WC Vendors is activated
/* --------------------------------------------------------------------- */
if( ! function_exists( 'is_wc_vendors_activated' ) ) {
	function is_wc_vendors_activated() {
		return class_exists( 'WC_Vendors' ) ? true : false;
	}
}

/*Check Visual Composer is activated
/* --------------------------------------------------------------------- */
if( ! function_exists( 'is_vc_activated' ) ) {
	function is_vc_activated() {
		return class_exists( 'WPBakeryVisualComposerAbstract' ) ? true : false;
	}
}

if ( ! function_exists( 'emallshop_get_option' ) ) {
	function emallshop_get_option($name, $default = '') {
		global $emallshop_options;
		if ( isset($emallshop_options[$name]) ) {
			return $emallshop_options[$name];
		}
		return $default;
	}
}