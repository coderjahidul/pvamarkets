<?php
 /**
 * EmallShop Include Admin Customizer Function
 *
 * @package WordPress
 * @subpackage EmallShop
 * @since EmallShop 1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/* 	Get Options Header Style Image
/* --------------------------------------------------------------------- */
if ( ! function_exists( 'emallshop_options_header_style' ) ){
	function emallshop_options_header_style(){
		return array(
			'header-1' => array('alt' => esc_html__('Header Style 1', 'emallshop'), 'img' => EMALLSHOP_ADMIN_URI.'/images/header/header-1.png'),
			'header-2' => array('alt' => esc_html__('Header Style 2', 'emallshop'), 'img' => EMALLSHOP_ADMIN_URI.'/images/header/header-2.png'),
			'header-3' => array('alt' => esc_html__('Header Style 3', 'emallshop'), 'img' => EMALLSHOP_ADMIN_URI.'/images/header/header-3.png'),
			'header-4' => array('alt' => esc_html__('Header Style 4', 'emallshop'), 'img' => EMALLSHOP_ADMIN_URI.'/images/header/header-4.png'),
			'header-5' => array('alt' => esc_html__('Header Style 5', 'emallshop'), 'img' => EMALLSHOP_ADMIN_URI.'/images/header/header-5.png'),
			'header-6' => array('alt' => esc_html__('Header Style 6', 'emallshop'), 'img' => EMALLSHOP_ADMIN_URI.'/images/header/header-6.png'),
			'header-7' => array('alt' => esc_html__('Header Style 7', 'emallshop'), 'img' => EMALLSHOP_ADMIN_URI.'/images/header/header-7.png'),
			'header-8' => array('alt' => esc_html__('Header Style 8', 'emallshop'), 'img' => EMALLSHOP_ADMIN_URI.'/images/header/header-8.png'),
			'header-9' => array('alt' => esc_html__('Header Style 9', 'emallshop'), 'img' => EMALLSHOP_ADMIN_URI.'/images/header/header-9.png'),
			'header-10' => array('alt' => esc_html__('Header Style 10', 'emallshop'), 'img' => EMALLSHOP_ADMIN_URI.'/images/header/header-10.png'),
			'header-11' => array('alt' => esc_html__('Header Style 11', 'emallshop'), 'img' => EMALLSHOP_ADMIN_URI.'/images/header/header-11.png'),
		);
	}
}

/* 	Get Options Page Heading Style Image
/* --------------------------------------------------------------------- */
if ( ! function_exists( 'emallshop_options_page_heading_style' ) ){
	function emallshop_options_page_heading_style(){
		return array(
			'page-heading-1' => array('alt' => esc_html__('Page Heading Style 1', 'emallshop'), 'img' => EMALLSHOP_ADMIN_URI.'/images/page-heading/page-heading-1.png'),
			'page-heading-2' => array('alt' => esc_html__('Page Heading Style 2', 'emallshop'), 'img' => EMALLSHOP_ADMIN_URI.'/images/page-heading/page-heading-2.png'),
			'page-heading-3' => array('alt' => esc_html__('Page Heading Style 3', 'emallshop'), 'img' => EMALLSHOP_ADMIN_URI.'/images/page-heading/page-heading-3.png'),
			'page-heading-4' => array('alt' => esc_html__('Page Heading Style 4', 'emallshop'), 'img' => EMALLSHOP_ADMIN_URI.'/images/page-heading/page-heading-4.png'),
		);
	}
}

/* 	Get Options Footer Style Image
/* --------------------------------------------------------------------- */
if ( ! function_exists( 'emallshop_options_footer_style' ) ){
	function emallshop_options_footer_style(){
		return array(
			'footer-1' => array('alt' => esc_html__('Footer Style 1', 'emallshop'), 'img' => EMALLSHOP_ADMIN_URI.'/images/footer/footer-1.png'),
			'footer-2' => array('alt' => esc_html__('Footer Style 2', 'emallshop'), 'img' => EMALLSHOP_ADMIN_URI.'/images/footer/footer-2.png'),
			'footer-3' => array('alt' => esc_html__('Footer Style 3', 'emallshop'), 'img' => EMALLSHOP_ADMIN_URI.'/images/footer/footer-3.png'),
		);
	}
}

/*  Preset Layouts
/* --------------------------------------------------------------------- */
if ( ! function_exists( 'emallshop_import_presets' ) ){
	function emallshop_import_presets(){
		return array(
				'default' => array(
					'alt'     => 'Default', 'img'=> EMALLSHOP_ADMIN_URI . '/images/presets/default.jpg'
				),
				'general' => array(
					'alt'     => 'General', 'img'=> EMALLSHOP_ADMIN_URI . '/images/presets/general.jpg'
				),
				'electronic' => array(
					'alt'     => 'Electronic', 'img' => EMALLSHOP_ADMIN_URI . '/images/presets/electronic.jpg'
				),
				'beauty' => array(
					'alt'     => 'Beauty', 'img'=> EMALLSHOP_ADMIN_URI . '/images/presets/beauty.jpg'
				),
				'bodybuilder' => array(
					'alt'     => 'Bodybuilder', 'img'=> EMALLSHOP_ADMIN_URI . '/images/presets/bodybuilder.jpg'
				),
				'jewellery' => array(
					'alt'     => 'Jewellery', 'img'=> EMALLSHOP_ADMIN_URI . '/images/presets/jewellery.jpg'
				),
				'furniture' => array(
					'alt'     => 'Furniture', 'img' => EMALLSHOP_ADMIN_URI . '/images/presets/furniture.jpg'
				),
				'kids' => array(
					'alt'     => 'Kids', 'img' => EMALLSHOP_ADMIN_URI . '/images/presets/kids.jpg'
				),
				'mobile' => array(
					'alt'     => 'Mobile', 'img' => EMALLSHOP_ADMIN_URI . '/images/presets/mobile.jpg'
				),
				'sport' => array(
					'alt'     => 'Sport', 'img' => EMALLSHOP_ADMIN_URI . '/images/presets/sport.jpg'
				),
				'medical' => array(
					'alt'     => 'Medical', 'img' => EMALLSHOP_ADMIN_URI . '/images/presets/medical.jpg'
				),
				'organic' => array(
					'alt'     => 'Organic', 'img' => EMALLSHOP_ADMIN_URI . '/images/presets/organic.jpg'
				),
				'vegetable' => array(
					'alt'     => 'Vegetable', 'img' => EMALLSHOP_ADMIN_URI . '/images/presets/vegetable.jpg'
				),
				'wine' => array(
					'alt'     => 'Wine', 'img' => EMALLSHOP_ADMIN_URI . '/images/presets/wine.jpg'
				),
				'underwear' => array(
					'alt'     => 'Underwear', 'img' => EMALLSHOP_ADMIN_URI . '/images/presets/underwear.jpg'
				),
			);
	}
}