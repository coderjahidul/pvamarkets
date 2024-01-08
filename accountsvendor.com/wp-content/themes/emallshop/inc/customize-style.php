<?php
/**
 * Customize theme style functionality for EmallShop
 *
 * @package WordPress
 * @subpackage EmallShop
 * @since EmallShop 1.2.3
 */

 /**
 * Styles the theme body.
 *
 * @since EmallShop 1.2.3
 *
 */
add_action( 'wp_enqueue_scripts', 'emallshop_theme_style', 11 );
if ( ! function_exists( 'emallshop_theme_style' ) ) :
function emallshop_theme_style() { 
	global $emallshop_options;
	
	// Add custom user CSS
	$theme_css 					= trim( emallshop_get_option('custom-css',''));	
	$pre_page_width				= (emallshop_get_option('use-predefined-page-width','pre-defined')=="pre-defined") ? emallshop_get_option('predefined-page-width','1170') : emallshop_get_option('custom-page-width','1170');
	
	/*Defaul Setting*/
	
	/* Typography */
	$theme_font					= emallshop_get_option('body-typography', array( 'font-family' => 'Open Sans', 'google' => true, 'font-weight'  => '400', 'font-style'  => '400', 'font-size' => '14px', 'line-height' => '22'));
	
	/*Color*/
	$theme_color				=  emallshop_get_option('theme-color','#0ba2e8');
	$theme_secondary_color		=  emallshop_get_option('theme-secondary-color','#ff8400');
	$body_background			=  emallshop_get_option('body-background',array('background-color' => '#ffffff', 'background-image'=> '', 'background-repeat' => '', 'background-size' => '', 'background-attachment' => '', 'background-position' => ''));	
	$body_background_rgb		= ($body_background['background-color']!="transparent") ? 'rgba('.emallshop_hex2rgb_color($body_background['background-color']). ','.emallshop_get_option('body-bg-opacity',1).')' : $body_background['background-color'];
	
	$body_content_background			=  emallshop_get_option('body-content-background',array('background-color' => '#ffffff', 'background-image'=> '', 'background-repeat' => '', 'background-size' => '', 'background-attachment' => '', 'background-position' => ''));	
	$body_content_background_rgb		= ($body_content_background['background-color']!="transparent") ? 'rgba('.emallshop_hex2rgb_color($body_content_background['background-color']). ','.emallshop_get_option('body-content-bg-opacity',1).')' : $body_content_background['background-color'];
	
	
	$body_text_color			=  emallshop_get_option('body-text-color','#656565');
	$body_heading_color			=  emallshop_get_option('body-heading-color','#212121');
	$body_input_background		=  emallshop_get_option('body-input-background','#ffffff');
	$body_input_color			=  emallshop_get_option('body-input-color','#656565');
	$body_link_color			=  emallshop_get_option('body-link-color', array( 'regular' => '#212121', 'hover' => '#ff8400', 'active' => '#ff8400'));
	$theme_border				=  emallshop_get_option('theme-border', array( 'border-color' => '#e9e9e9', 'border-style'  => 'solid', 'border-top' => '1px', 'border-right' => '1px', 'border-bottom' => '1px', 'border-left'   => '1px'));
	$theme_border_radius		=  emallshop_get_option('theme-border-radius','3');
	$body_wrapper_padding		=  emallshop_get_option('body-wrapper-padding', array( 'padding-top' => '0px', 'padding-bottom' => '0px', 'units' => 'px') );
	
	/* Header */
	$header_wrapper_background	= emallshop_get_option('header-wrapper-background',array('background-color' => 'transparent', 'background-image'=> '', 'background-repeat' => '', 'background-size' => '', 'background-attachment' => '', 'background-position' => ''));
	$header_wrapper_background_rgb = ($header_wrapper_background['background-color']!="transparent") ? 'rgba('.emallshop_hex2rgb_color($header_wrapper_background['background-color']). ','.emallshop_get_option('header-wrapper-opacity',1).')' : $header_wrapper_background['background-color'];
	$header_background			= emallshop_get_option('header-background',array('background-color' => '#fcfcfc', 'background-image'=> '', 'background-repeat' => '', 'background-size' => '', 'background-attachment' => '', 'background-position' => ''));
	//$header_background['background-color']= ($header_wrapper_background['background-color']!='transparent') ? 'transparent' : $header_background['background-color'];
	$header_background_rgb		= ($header_background['background-color']!="transparent") ? 'rgba('.emallshop_hex2rgb_color($header_background['background-color']). ','.emallshop_get_option('header-opacity',1).')' : $header_background['background-color'];
	$header_text_color			=  emallshop_get_option('header-text-color','#656565');
	$header_input_background	=  emallshop_get_option('header-input-background','#ffffff');
	$header_input_color			=  emallshop_get_option('header-input-color','#656565');
	$header_link_color			=  emallshop_get_option('header-link-color', array( 'regular' => '#212121', 'hover' => '#ff8400', 'active' => '#ff8400'));
	$header_border				=  emallshop_get_option('header-border', array( 'border-color' => '#e9e9e9', 'border-style'  => 'solid', 'border-top' => '1px', 'border-right' => '1px', 'border-bottom' => '1px', 'border-left'   => '1px'));
	$header_border_color_rgb 	= 'rgba('.emallshop_hex2rgb_color($header_border['border-color']). ','.emallshop_get_option('header-opacity',1).')';
	$header_padding				=  emallshop_get_option('header-padding', array( 'padding-top' => '24px', 'padding-bottom' => '24px', 'units' => 'px' ));
	
	/* Sticky Header */
	$sticky_header_background 	= emallshop_get_option('sticky-header-background',array('background-color' => '#ffffff', 'background-image'=> '', 'background-repeat' => '', 'background-size' => '', 'background-attachment' => '', 'background-position' => ''));
	$sticky_header_background_rgb = ($sticky_header_background['background-color']!="transparent") ? 'rgba('.emallshop_hex2rgb_color($sticky_header_background['background-color']). ','.emallshop_get_option('sticky-header-opacity',1).')' : $sticky_header_background['background-color'];
	$sticky_header_text_color	=  emallshop_get_option('sticky-header-text-color','#656565');
	$sticky_header_input_background	=  emallshop_get_option('sticky-header-input-background','#ffffff');
	$sticky_header_input_color	=  emallshop_get_option('sticky-header-input-color','#656565');
	$sticky_header_color 		=  emallshop_get_option('sticky-header-link-color', array( 'regular' => '#212121', 'hover' => '#ff8400', 'active' => '#ff8400'));
	$sticky_header_border			=  emallshop_get_option('sticky-header-border', array( 'border-color' => '#e9e9e9', 'border-style'  => 'solid', 'border-top' => '1px', 'border-right' => '1px', 'border-bottom' => '1px', 'border-left'   => '1px'));
	$sticky_header_border_color_rgb = 'rgba('.emallshop_hex2rgb_color($sticky_header_border['border-color']). ','.emallshop_get_option('sticky-header-opacity',1).')';
	
	/* Topbar */
	$topbar_background			= emallshop_get_option('topbar-background',array('background-color' => '#fcfcfc', 'background-image'=> '', 'background-repeat' => '', 'background-size' => '', 'background-attachment' => '', 'background-position' => ''));
	//$topbar_background['background-color']= ($header_wrapper_background['background-color']!='transparent') ? 'transparent' : $topbar_background['background-color'];
	$topbar_background_rgb		=  ($topbar_background['background-color']!="transparent") ? 'rgba('.emallshop_hex2rgb_color($topbar_background['background-color']). ','.emallshop_get_option('topbar-opacity',1).')' : $topbar_background['background-color'];
	$topbar_input_background	=  emallshop_get_option('topbar-input-background','#ffffff');
	$topbar_input_color			=  emallshop_get_option('topbar-input-color','#656565');
	$topbar_text_color			=  emallshop_get_option('topbar-text-color','#656565');
	$topbar_link_color			=  emallshop_get_option('topbar-link-color', array( 'regular' => '#212121', 'hover' => '#ff8400', 'active' => '#ff8400'));
	$topbar_border				=  emallshop_get_option('topbar-border', array( 'border-color' => '#e9e9e9', 'border-style'  => 'solid', 'border-top' => '1px', 'border-right' => '1px', 'border-bottom' => '1px', 'border-left'   => '1px'));
	$topbar_border_color_rgb 	= 'rgba('.emallshop_hex2rgb_color($topbar_border['border-color']). ','.emallshop_get_option('topbar-opacity',1).')';
	
	/* Navigation */
	$navigation_background		= emallshop_get_option('navigation-background',array('background-color' => '#0ba2e8', 'background-image'=> '', 'background-repeat' => '', 'background-size' => '', 'background-attachment' => '', 'background-position' => ''));
	//$navigation_background['background-color']= ($header_wrapper_background['background-color']!='transparent') ? 'transparent' : $navigation_background['background-color'];
	$navigation_background_rgb =  ($navigation_background['background-color']!="transparent") ? 'rgba('.emallshop_hex2rgb_color($navigation_background['background-color']). ','.emallshop_get_option('navigation-opacity',1).')' : $navigation_background['background-color'];
	$navigation_secondary_color	=  emallshop_get_option('navigation-secondary-color','#ff8400');
	$navigation_text_color		=  emallshop_get_option('navigation-text-color','#ffffff');
	$navigation_input_background=  emallshop_get_option('navigation-input-background','#ffffff');
	$navigation_input_color		=  emallshop_get_option('navigation-input-color','#656565');
	$navigation_link_color		=  emallshop_get_option('navigation-link-color', array( 'regular' => '#ffffff', 'hover' => '#ff8400', 'active' => '#ff8400'));
	$navigation_border			=  emallshop_get_option('navigation-border', array( 'border-color' => '#19b0f6', 'border-style'  => 'solid', 'border-top' => '1px', 'border-right' => '1px', 'border-bottom' => '1px', 'border-left'   => '1px'));
	$navigation_border_color_rgb = 'rgba('.emallshop_hex2rgb_color($navigation_border['border-color']). ','.emallshop_get_option('navigation-opacity',1).')';
	
	/* Menu */
	$menu_background_color		=  emallshop_get_option('menu-background-color','#ffffff');
	$menu_text_color			=  emallshop_get_option('menu-text-color','#656565');
	$menu_link_color			=  emallshop_get_option('menu-link-color', array( 'regular' => '#212121', 'hover' => '#ff8400', 'active' => '#ff8400'));
	$menu_border	=  emallshop_get_option('menu-border', array( 'border-color' => '#e9e9e9', 'border-style'  => 'solid', 'border-top' => '1px', 'border-right' => '1px', 'border-bottom' => '1px', 'border-left'   => '1px'));
	
	/* Breadcrumb/Heading */
	$page_heading_background	= emallshop_get_option('page-heading-background',array('background-color' => '#FCFCFC', 'background-image'=> '', 'background-repeat' => '', 'background-size' => '', 'background-attachment' => '', 'background-position' => ''));
	$page_heading_background_rgb=($page_heading_background['background-color']!="transparent") ? 'rgba('.emallshop_hex2rgb_color($page_heading_background['background-color']). ','.emallshop_get_option('page-heading-opacity',1).')' : $page_heading_background['background-color'];
	$page_heading_heading_color	=  emallshop_get_option('page-heading-heading-color','#212121');
	$page_heading_text_color 	=  emallshop_get_option('page-heading-text-color','#656565');
	$page_heading_link_color	=  emallshop_get_option('page-heading-link-color', array( 'regular' => '#212121', 'hover' => '#ff8400', 'active' => '#ff8400'));
	$page_heading_border		=  emallshop_get_option('page-heading-border', array( 'border-color' => '#f5f5f5', 'border-style'  => 'solid', 'border-top' => '1px', 'border-right' => '1px', 'border-bottom' => '1px', 'border-left'   => '1px'));
	$page_heading_border_color_rgb = 'rgba('.emallshop_hex2rgb_color($page_heading_border['border-color']). ','.emallshop_get_option('page-heading-opacity',1).')';
	$page_heading_padding		=  emallshop_get_option('page-heading-padding', array( 'padding-top' => '10px', 'padding-bottom' => '10px', 'units' => 'px' ));
	
	/* Footer */
	$footer_wrapper_background	= emallshop_get_option('footer-wrapper-background',array('background-color' => 'transparent', 'background-image'=> '', 'background-repeat' => '', 'background-size' => '', 'background-attachment' => '', 'background-position' => ''));
	$footer_wrapper_background_rgb=($footer_wrapper_background['background-color']!="transparent") ? 'rgba('.emallshop_hex2rgb_color($footer_wrapper_background['background-color']). ','.emallshop_get_option('footer-wrapper-opacity',1).')' : $footer_wrapper_background['background-color'];
	
	$footer_background			= emallshop_get_option('footer-background',array('background-color' => '#fcfcfc', 'background-image'=> '', 'background-repeat' => '', 'background-size' => '', 'background-attachment' => '', 'background-position' => ''));
	//$footer_background['background-color']= ($footer_wrapper_background['background-color']!='transparent') ? 'transparent' : $footer_background['background-color'];
	$footer_background_rgb=($footer_background['background-color']!="transparent") ? 'rgba('.emallshop_hex2rgb_color($footer_background['background-color']). ','.emallshop_get_option('footer-opacity',1).')' : $footer_background['background-color'];
	$footer_heading_color		=  emallshop_get_option('footer-heading-color','#212121');
	$footer_text_color			=  emallshop_get_option('footer-text-color','#656565');
	$footer_input_background	=  emallshop_get_option('footer-input-background','#ffffff');
	$footer_input_color			=  emallshop_get_option('footer-input-color','#656565');
	$footer_link_color			=  emallshop_get_option('footer-link-color', array( 'regular' => '#212121', 'hover' => '#ff8400', 'active' => '#ff8400'));
	$footer_border				=  emallshop_get_option('footer-border', array( 'border-color' => '#e9e9e9', 'border-style'  => 'solid', 'border-top' => '1px', 'border-right' => '1px', 'border-bottom' => '1px', 'border-left'   => '1px'));
	$footer_border_color_rgb 	= 'rgba('.emallshop_hex2rgb_color($footer_border['border-color']). ','.emallshop_get_option('footer-opacity',1).')';
	$footer_padding				=  emallshop_get_option('footer-padding', array( 'padding-top' => '42px', 'padding-bottom' => '42px', 'units' => 'px' ));
	
	/* Copyright */
	$copyright_background		= emallshop_get_option('copyright-background',array('background-color' => '#fcfcfc', 'background-image'=> '', 'background-repeat' => '', 'background-size' => '', 'background-attachment' => '', 'background-position' => ''));
	//$copyright_background['background-color']= ($footer_wrapper_background['background-color']!='transparent') ? 'transparent' : $copyright_background['background-color'];
	$copyright_background_rgb	=($copyright_background['background-color']!="transparent") ? 'rgba('.emallshop_hex2rgb_color($copyright_background['background-color']). ','.emallshop_get_option('copyright-opacity',1).')' : $copyright_background['background-color'];
	$copyright_text_color		=  emallshop_get_option('copyright-text-color','#656565');
	$copyright_link_color		=  emallshop_get_option('copyright-link-color', array( 'regular' => '#212121', 'hover' => '#ff8400', 'active' => '#ff8400'));
	$copyright_border			=  emallshop_get_option('copyright-border', array( 'border-color' => '#e9e9e9', 'border-style'  => 'solid', 'border-top' => '1px', 'border-right' => '1px', 'border-bottom' => '1px', 'border-left'   => '1px'));
	$copyright_border_color_rgb = 'rgba('.emallshop_hex2rgb_color($copyright_border['border-color']). ','.emallshop_get_option('copyright-opacity',1).')';
	$copyright_padding	=  emallshop_get_option('copyright-padding', array( 'padding-top' => '14px', 'padding-bottom' => '14px', 'units' => 'px' ));
	
	$sale_label_color 			= emallshop_get_option('sale-highlight-label-color','#60BF79');
	$new_label_color			=  emallshop_get_option('new-highlight-label-color','#48c2f5');
	$featured_label_color		=  emallshop_get_option('featured-highlight-label-color','#ff781e');
	$outofstock_label_color		=  emallshop_get_option('outofstock-highlight-label-color','#FF4557');
	
	$loading_image= EMALLSHOP_ADMIN_URI.'/images/ajax-'.emallshop_get_option('pagination-loading-image','loader').'.gif';
	$loading_image=esc_url($loading_image);	
	
	//Newsletter Set Defaul Color
	$newsletter_background		= emallshop_get_option('newsletter-background',array('background-color' => '#0ba2e8', 'background-image'=> '', 'background-repeat' => '', 'background-size' => '', 'background-attachment' => '', 'background-position' => ''));
	$newsletter_color			=  emallshop_get_option('newsletter-color','#ffffff');
	$newsletter_button_color	=  emallshop_get_option('newsletter-button-color','#FF8400');
	
	$theme_css.=<<<CSS
	/*
	* Theme Font
	*/
	body,
	button,
	input,
	select,
	textarea {
		font-family: {$theme_font['font-family']} !important;
		font-size: {$theme_font['font-size']};
		font-style: {$theme_font['font-style']};
		line-height: {$theme_font['line-height']}px;
	}
	::-webkit-input-placeholder {
		font-family: {$theme_font['font-family']}
	}
	:-moz-placeholder {
		font-family: {$theme_font['font-family']}
	}
	::-moz-placeholder {
		font-family: {$theme_font['font-family']}
	}
	:-ms-input-placeholder {
		font-family: {$theme_font['font-family']}
	}
	
	/* 
	* page width
	*/
	.wrapper.boxed-layout, .wrapper .container{
		width:{$pre_page_width}px;
	}	
	body{
		/* background:{$body_background['background-color']} url({$body_background['background-image']}) {$body_background['background-position']} {$body_background['background-repeat']} {$body_background['background-size']} {$body_background['background-attachment']} ; */
		
		background-color:{$body_background_rgb};
		background-image:url({$body_background['background-image']});
		background-repeat:{$body_background['background-repeat']};
		background-size:{$body_background['background-size']};
		background-attachment:{$body_background['background-attachment']};
		background-position:{$body_background['background-position']};
	}
	body .wrapper, body .wrapper.boxed-layout, .category-menu .categories-list{
		background-color:{$body_content_background_rgb};
		background-image:url({$body_content_background['background-image']});
		background-repeat:{$body_content_background['background-repeat']};
		background-size:{$body_content_background['background-size']};
		background-attachment:{$body_content_background['background-attachment']};
		background-position:{$body_content_background['background-position']};
	}
	
	/* 
	* Body color Scheme 
	*/
	body{
		color:{$body_text_color};
	}
	h1, h2, h3, h4, h5, h6{
		color:{$body_heading_color};
	}
	a, .woocommerce ul.cart_list li a, .emallshop-vertical-menu.main-navigation > li > a{
		color:{$body_link_color['regular']};
	}
	a:hover, a:focus, #header .header-cart-content .cart-item-detail a:hover, .category-entry:hover .category-content a, .entry-media .post-link:hover a, .woocommerce ul.cart_list li a:hover, .entry-footer a:hover, .entry-title a:hover, .emallshop-vertical-menu.main-navigation > li > a:hover, .header-navigation .emallshop-vertical-menu.main-navigation > li.menu-item-has-children:hover > a, .header-navigation .emallshop-vertical-menu.main-navigation li.current-menu-ancestor > a, .header-navigation .emallshop-vertical-menu.main-navigation li.current-page-ancestor > a, .header-navigation .emallshop-vertical-menu.main-navigation > li.current_page_item > a {
		color:{$body_link_color['hover']};
	}
	.header-cart-content .cart_list.product_list_widget .cart-box-title, .header-cart-content .cart_list.product_list_widget .empty, .header-cart-content .total, .header-cart-content .mini-cart-items, .woocommerce .single-product-entry ul.zoo-cw-variations li .label label{
		color:{$body_text_color};
	}
	.product_list_widget .cart-item-detail .quantity, .woocommerce.widget_shopping_cart .total .amount, .header-cart-content .mini-cart-items p.total .amount, .woocommerce ul.products .product-entry .product-content .price, .widget .product-price, .widget .product-categories li.current-cat-parent > a, .widget .product-categories li.current-cat-parent > span, .widget .product-categories li.current-cat > a, .widget .product-categories li.current-cat > span, .woocommerce .single-product-entry .product-price .price, .woocommerce .single-product-entry .single_variation .price, .single-product-entry .entry-summary .product-title-price .amount, .single-product-entry .entry-summary .product-title-price del, .single-product-entry .entry-summary .product-title-price ins, .entry-content .more-link, .portfolio-content .more-link, .services ul.services .service-item i, .entry-footer a, .entry-title a, .woocommerce .woocommerce-pagination ul.page-numbers span,.woocommerce .woocommerce-pagination ul.page-numbers a, .wcv_pagination .page-numbers span, .wcv_pagination .page-numbers a, .woocommerce ul.products .product-buttons .quickview:before, .woocommerce  ul.products .product-image .quickview-button a, .category-content, .category_and_sub_category_box .show-all-cate a, .categories-slider-content.sub_category_box .show-all-cate a, .entry-day, .woocommerce .single-product-entry .entry-summary .product_meta .sku_wrapper span, .woocommerce .single-product-entry .entry-summary .product_meta .brand_in a, .woocommerce .single-product-entry .entry-summary .product_meta .posted_in a, .woocommerce .single-product-entry .entry-summary .product_meta .tagged_as a, article.post .entry-header h2, .comment-list .comment-reply-link, .portfolio-list .portfolioFilter a, .portfolio-skill a, .entry-information ul p i, .portfolio-list .effect4 .portfolio-content, .portfolio-list .effect4 .portfolio-content a, .header-middle .customer-support, .posts-navigation .pagination > li > a, .posts-navigation .pagination > li > span, .live-search-results .search-product-price, .dokan-pagination-container .dokan-pagination li a, .widget .woocommerce-Price-amount, .woocommerce div.product p.price, .woocommerce div.product span.price, table.group_table .label, table.group_table .price{
		color:{$theme_color};
	}
	.product-toolbar .gridlist-toggle > a, .woocommerce ul.products .product-buttons .compare:before, .woocommerce ul.products .product-buttons .add_to_wishlist:before, .woocommerce ul.products .yith-wcwl-wishlistaddedbrowse a:before, .woocommerce ul.products .yith-wcwl-wishlistexistsbrowse a:before, .woocommerce ul.products .product-content .product-buttons .quickview:before, .owl-theme .owl-nav .owl-prev, .owl-theme .owl-nav .owl-next, .single-product-entry .slick-arrow:before, .woocommerce-product-gallery__trigger:before, .single-product-entry  .entry-summary .product-navbar, .woocommerce .single-product-entry .entry-summary .compare, .woocommerce .single-product-entry .entry-summary .yith-wcwl-add-to-wishlist a, .single-product-entry .entry-summary .product_meta .brand_in a:hover, .single-product-entry .entry-summary .product_meta .posted_in a:hover, .single-product-entry .entry-summary .product_meta .tagged_as a:hover, .post-navigation a, .header-post-navigation .nav-links li a, .woocommerce .widget_layered_nav ul.yith-wcan-label li a, .woocommerce-page .widget_layered_nav ul.yith-wcan-label li a, .woocommerce .widget_layered_nav ul.yith-wcan-label li span, .woocommerce-page .widget_layered_nav ul.yith-wcan-label li span, .footer .widget  ul.services .service-icon, .woocommerce ul.products .product-entry .product-content a:hover h3, article .hover-overlay-btn a i{
		color:{$theme_secondary_color};
	}
	button, .button, input[type="button"], input[type="reset"], input[type="submit"], .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .widget .tagcloud a:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce  ul.products .product-content .product-buttons .product-cart a.added_to_cart, .pagination .page-numbers.current, .lmp_load_more_button .lmp_button, .cwallowcookies.button, .entry-content .more-link:hover, .entry-summary .more-link:hover, .portfolio-content .more-link:hover, .entry-media blockquote, .entry-media .post-link, .woocommerce .woocommerce-pagination ul.page-numbers span.current, .woocommerce .woocommerce-pagination ul.page-numbers a:hover, .wcv_pagination .page-numbers span.current, .wcv_pagination .page-numbers a:hover, .widget_price_filter .ui-slider .ui-slider-handle, .product-section .section-tab .nav-tabs li a:hover, .product-section .section-tab .nav-tabs li.active a, .testimonials .quote-content p, .testimonials-list .quote-content p, .entry-date .entry-month, .back-to-top, .portfolio-list .portfolioFilter a.current, .portfolio-list .portfolioFilter a:hover, .portfolio-list .effect1 .hentry:hover .portfolio-content, .portfolio-list .effect2 .hentry:hover .portfolio-content, .portfolio-list .effect3 .hentry:hover .portfolio-content, .woocommerce-MyAccount-navigation > ul li a, .header-cart-content .cart-style-1 .cart-icon, .header-cart-content .heading-cart.cart-style-3 > i, .posts-navigation .pagination > li:hover > a, .topbar-notification .news-title, .owl-nav .owl-prev:hover, .owl-nav .owl-next:hover, .product-items li.product .product-image .owl-theme .owl-controls .owl-dot.active span, .product-items li.product .product-image .owl-theme .owl-controls.clickable .owl-dot:hover span, .woocommerce  ul.products.product-style3.grid-view li.product:hover .product-buttons .product-cart a, .woocommerce  ul.products.product-style3.product-carousel li.product:hover .product-buttons .product-cart a, .dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu, input.dokan-btn-theme[type="submit"], a.dokan-btn-theme, .dokan-btn-theme, .dokan-single-store .profile-frame, .pagination-wrap ul.pagination > li > a:hover, .pagination-wrap ul.pagination > li > span.current, .dokan-pagination-container .dokan-pagination li:hover a, .dokan-pagination-container .dokan-pagination li.active a, input.dokan-btn-default[type="submit"], a.dokan-btn-default, .dokan-btn-default, .search-box-wrapper .search-box, .mobile-nav-tabs li.active{
		background-color:{$theme_color};
	}
	.woocommerce .selectBox-options li.selectBox-selected a{
		background-color:{$theme_color} !important;
	}
	.category-menu .category-menu-title, button:hover, .button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover,  input[type="submit"]:focus, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .live-search-results .autocomplete-suggestion:hover, .live-search-results .autocomplete-suggestion.autocomplete-selected, .lmp_load_more_button .lmp_button:hover, .cwallowcookies.button:hover, .cwcookiesmoreinfo.button:hover, .product-toolbar .gridlist-toggle .grid-view.active, .product-toolbar .gridlist-toggle .grid-view:hover, .product-toolbar .gridlist-toggle .list-view.active, .product-toolbar .gridlist-toggle .list-view:hover, .woocommerce ul.products .product-buttons .compare:hover, .woocommerce ul.products .product-buttons .compare.added, .woocommerce ul.products .product-buttons .add_to_wishlist:hover, .woocommerce ul.products .yith-wcwl-wishlistaddedbrowse a, .woocommerce ul.products .yith-wcwl-wishlistexistsbrowse a, .woocommerce ul.products .product-content .product-buttons .quickview:hover, .owl-theme .owl-dots .owl-dot.active span, .owl-theme .owl-dots .owl-dot:hover span, .owl-theme .owl-nav .owl-prev:hover, .owl-theme .owl-nav .owl-next:hover, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .countdown .countdown-section, .single-product-entry .slick-slider .slick-prev:hover, .single-product-entry .slick-slider .slick-next:hover, .woocommerce-product-gallery__trigger:hover:before, .woocommerce .single-product-entry .entry-summary .yith-wcwl-add-to-wishlist:hover, .woocommerce .single-product-entry .entry-summary .yith-wcwl-add-to-wishlist:hover a, .woocommerce .single-product-entry .entry-summary .compare:hover, .single-product-entry .entry-summary .product-prev:hover .product-navbar, .single-product-entry .entry-summary .product-next:hover .product-navbar, .back-to-top:hover, .post-navigation .nav-previous:hover, .post-navigation .nav-next:hover, .header-post-navigation .nav-links li:hover, .portfolio-content .project-url a, .woocommerce-MyAccount-navigation > ul li a:hover, .topbar-cart .mini-cart-count, .header-cart-content .cart-style-2 .mini-cart-count, .header-wishlist .wishlist-count, .header-compare .compare-count, .topbar-cart .mini-cart-count, .header-navigation  .header-cart-content .cart-style-1 .cart-icon, .header-navigation .header-cart-content .heading-cart.cart-style-3 > i, .woocommerce .widget_layered_nav ul.yith-wcan-label li a:hover, .woocommerce-page .widget_layered_nav ul.yith-wcan-label li a:hover, .woocommerce .widget_layered_nav ul.yith-wcan-label li.chosen a, .woocommerce-page .widget_layered_nav ul.yith-wcan-label li.chosen a, .product-items li.product .product-image .owl-nav .owl-prev, .product-items li.product .product-image .owl-nav .owl-next, article .hover-overlay-btn a i:hover, .hover-overlay-buttons .icon-animation:hover, .dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li:hover, .dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li.active, .dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li.dokan-common-links a:hover, input.dokan-btn-theme[type="submit"]:hover, a.dokan-btn-theme:hover, .dokan-btn-theme:hover, input.dokan-btn-theme[type="submit"]:focus, a.dokan-btn-theme:focus, .dokan-btn-theme:focus, input.dokan-btn-theme[type="submit"]:active, a.dokan-btn-theme:active, .dokan-btn-theme:active, input.dokan-btn-theme.active[type="submit"], a.dokan-btn-theme.active, .dokan-btn-theme.active, .open .dropdown-toggleinput.dokan-btn-theme[type="submit"], .open .dropdown-togglea.dokan-btn-theme, .open .dropdown-toggle.dokan-btn-theme, .dokan-single-store .profile-frame .profile-info-box .profile-info-summery-wrapper .profile-info-summery, input.dokan-btn-default[type="submit"]:hover, a.dokan-btn-default:hover, .dokan-btn-default:hover{
		background-color:{$theme_secondary_color};
	}
	.woocommerce .selectBox-options li.selectBox-hover a{
		background-color:{$theme_secondary_color} !important;
	}
	.product-section .section-header .section-title h3:before, .widget-section .widget-title h3:before, .testimonials-section .section-header .section-title h3:before, .widget .tagcloud a:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce div.product div.products h2 span:before, .cart-collaterals .cross-sells h2 span:before, .social-share h3 span:before, .navigation h3 span:before, .related-posts h3 span:before,.related-portfolios h3 span:before , #yith-wcwl-popup-message, .pagination .page-numbers.current, .entry-content .more-link:hover, .entry-summary .more-link:hover, .woocommerce .woocommerce-pagination ul.page-numbers span.current, .woocommerce .woocommerce-pagination ul.page-numbers a:hover, .wcv_pagination .page-numbers span.current, .wcv_pagination .page-numbers a:hover, .product-section .section-tab .nav-tabs li a:hover, .product-section .section-tab .nav-tabs li.active a, .portfolio-list .portfolioFilter a.current, .portfolio-list .portfolioFilter a:hover, .portfolio-list .default_effect .portfolio-content, .related-portfolios .default_effect .portfolio-content, .posts-navigation .pagination > li:hover > a, .newsletter-section .section-header .section-title h3:before, .owl-nav .owl-prev:hover, .owl-nav .owl-next:hover, input.dokan-btn-theme[type="submit"], a.dokan-btn-theme, .dokan-btn-theme, input.dokan-btn-default[type="submit"], a.dokan-btn-default, .dokan-btn-default,  .zoo-cw-active.zoo-cw-attribute-option .zoo-cw-attr-item{
		border-color:{$theme_color};
	}
	.single-product-entry  .entry-summary .product-next .product-next-popup:before, .single-product-entry  .entry-summary .product-prev:hover .product-prev-popup:before, .woocommerce div.product .woocommerce-tabs ul.tabs:before, .product-section.products_carousel .section-tab, .post-navigation .nav-next .post-nav-thumb, .header-post-navigation .nav-next .post-nav-thumb, .post-navigation .nav-previous .post-nav-thumb, .header-post-navigation .nav-previous .post-nav-thumb{
		border-bottom-color:{$theme_color} !important;
	}
	.widget li a::before, .topbar-notification .news-title::before{
		border-left-color:{$theme_color};
	}
	.widget-area .widget, .dokan-widget-area .widget, .single-product-entry  .entry-summary .product-next .product-next-popup, .single-product-entry  .entry-summary .product-prev .product-prev-popup, .post-navigation .nav-next .post-nav-thumb:before, .header-post-navigation .nav-next .post-nav-thumb:before, .post-navigation .nav-previous .post-nav-thumb:before, .header-post-navigation .nav-previous .post-nav-thumb:before, .emallshop-main-menu .sub-menu, .emallshop-main-menu .emallshop-megamenu-wrapper, .footer {
		border-top-color:{$theme_color};
	}
	.product-toolbar .gridlist-toggle .grid-view.active, .product-toolbar .gridlist-toggle .grid-view:hover, .product-toolbar .gridlist-toggle .list-view.active, .product-toolbar .gridlist-toggle .list-view:hover, .woocommerce ul.products .product-content .product-extra-info, .owl-theme .owl-nav .owl-prev:hover, .owl-theme .owl-nav .owl-next:hover, .blogs_carousel .blog-entry .hentry:hover, .woocommerce .single-product-entry .entry-summary .yith-wcwl-add-to-wishlist:hover, .woocommerce .single-product-entry .entry-summary .yith-wcwl-add-to-wishlist:hover a, .woocommerce .single-product-entry .entry-summary .compare:hover, .single-product-entry .entry-summary .product-prev:hover .product-navbar, .single-product-entry .entry-summary .product-next:hover .product-navbar, .woocommerce .widget_layered_nav ul.yith-wcan-label li a, .woocommerce-page .widget_layered_nav ul.yith-wcan-label li a, .woocommerce .widget_layered_nav ul.yith-wcan-label li span, .woocommerce-page .widget_layered_nav ul.yith-wcan-label li span, .woocommerce .widget_layered_nav ul.yith-wcan-label li a:hover, .woocommerce-page .widget_layered_nav ul.yith-wcan-label li a:hover, .woocommerce .widget_layered_nav ul.yith-wcan-label li.chosen a, .woocommerce-page .widget_layered_nav ul.yith-wcan-label li.chosen a,  input.dokan-btn-theme[type="submit"]:hover, a.dokan-btn-theme:hover, .dokan-btn-theme:hover, input.dokan-btn-theme[type="submit"]:focus, a.dokan-btn-theme:focus, .dokan-btn-theme:focus, input.dokan-btn-theme[type="submit"]:active, a.dokan-btn-theme:active, .dokan-btn-theme:active, input.dokan-btn-theme.active[type="submit"], a.dokan-btn-theme.active, .dokan-btn-theme.active, .open .dropdown-toggleinput.dokan-btn-theme[type="submit"], .open .dropdown-togglea.dokan-btn-theme, .open .dropdown-toggle.dokan-btn-theme, input.dokan-btn-default[type="submit"]:hover, a.dokan-btn-default:hover, .dokan-btn-default:hover, .zoo-cw-attribute-option.cw-active .zoo-cw-attr-item, .zoo-cw-attribute-option:not(.disabled):hover .zoo-cw-attr-item{
		border-color:{$theme_secondary_color};
	}
	ul.main-navigation .sub-menu, ul.main-navigation .emallshop-megamenu-wrapper, .header-cart-content .mini-cart-items{
		border-top-color:{$theme_secondary_color};
	}
	.product-items .list-view li.product:hover, .header-cart-content .mini-cart-items:before, .search-box-wrapper .search-box:before{
		border-bottom-color:{$theme_secondary_color};
	}
	.woocommerce a.selectBox, .woocommerce .selectBox-dropdown, .selectBox-dropdown-menu li a .woocommerce a.selectBox, .woocommerce a.selectBox:hover, .posts-navigation .pagination > li > a, .posts-navigation .pagination > li > span, ul.zoo-cw-variations .zoo-cw-attr-item{
		border-color:{$theme_border['border-color']};
	}
	.woocommerce a.selectBox, .woocommerce a.selectBox:hover{
		border-bottom-color:{$theme_border['border-color']} !important;
	}
	.product-items .list-view li.product{
		border-bottom-color:{$theme_border['border-color']};
		border-bottom-style:{$theme_border['border-style']};
	}
	.product-toolbar .gridlist-toggle > a, table, th, td,.emallshop-main-menu .emallshop-vertical-menu, .widget, .secondary .widget > select, .widget .tagcloud a, .widget.yith-woocompare-widget .clear-all, .dokan-form-control, .comment-area-wrap, .comment-avatar img, .comment-respond, .woocommerce .single-product-entry .entry-summary .quantity .qty, .woocommerce-tabs .panel, .product-section .section-inner, .woocommerce .col2-set .col-1, .woocommerce-page .col2-set .col-1, .woocommerce .col2-set .col-2,.woocommerce-page .col2-set .col-2, .woocommerce .woocommerce-pagination ul.page-numbers span, .woocommerce .woocommerce-pagination ul.page-numbers a, .wcv_pagination .page-numbers span, .wcv_pagination .page-numbers a, .related-posts .hentry, .services ul.services .service-item, .testimonials-section .quote-meta  .client-image, .blogs_carousel .blog-entry .hentry, input, textarea, .woocommerce div.product .woocommerce-tabs ul.tabs li, .blog-posts .hentry, .portfolio-list .portfolioFilter a, .portfolio-list .hentry, .related-portfolios .hentry, .woocommerce form.checkout_coupon, .woocommerce form.login, .woocommerce form.register, .search-area, select, .emallshop-vertical-menu.main-navigation, .navigation.comment-navigation .nav-links, .search-control-group .tt-menu, .header-services .icon-service, .product-section .section-tab .nav-tabs li a, .single-product-entry .images #product-image, .single-product-entry .flex-viewport, .dokan-pagination-container .dokan-pagination li a, .pagination-wrap ul.pagination > li > a, ul.dokan-seller-wrap li.dokan-list-single-seller .dokan-store-thumbnail, .selectBox-dropdown, .woocommerce #reviews #comments ol.commentlist li .comment-text, .woocommerce #reviews #comments ol.commentlist li img.avatar, .product-thumbnails .slick-slide, .page-content .wcmp_main_page, .page-content .wcmp_regi_main .wcmp_regi_form_box{	
		border-top:{$theme_border['border-top']};
		border-bottom:{$theme_border['border-bottom']};
		border-left:{$theme_border['border-left']};
		border-right:{$theme_border['border-right']};
		border-style:{$theme_border['border-style']};
		border-color:{$theme_border['border-color']};
	}
	.dokan-pagination-container .dokan-pagination li:hover a, .dokan-pagination-container .dokan-pagination li.active a, .pagination-wrap ul.pagination > li > a:hover, .pagination-wrap ul.pagination > li > span.current{
		border-top:{$theme_border['border-top']};
		border-bottom:{$theme_border['border-bottom']};
		border-left:{$theme_border['border-left']};
		border-right:{$theme_border['border-right']};
		border-style:{$theme_border['border-style']};
		border-color:{$theme_color};
	}
	.product-items li.product:hover, .product-items li.category-entry:hover, .product-section.products_brands .brands-carousel li.brand-item:hover, .woocommerce ul.products .product-buttons .add_to_wishlist, .woocommerce ul.products .yith-wcwl-wishlistaddedbrowse a, .woocommerce ul.products .yith-wcwl-wishlistexistsbrowse a, .woocommerce ul.products .product-content .product-buttons .quickview, .woocommerce ul.products .product-buttons .compare, .owl-theme .owl-nav .owl-prev, .owl-theme .owl-nav .owl-next, .single-product-entry .slick-arrow, .woocommerce-product-gallery__trigger:before, .single-product-entry .entry-summary .product-navbar, .woocommerce .single-product-entry .entry-summary .yith-wcwl-add-to-wishlist, .post-navigation .nav-previous, .post-navigation .nav-next, .header-post-navigation .nav-links li:hover, .header-post-navigation .nav-links li, article .hover-overlay-btn a i, .woocommerce  ul.products .product-content .product-extra-info{
		border-top:{$theme_border['border-top']};
		border-bottom:{$theme_border['border-bottom']};
		border-left:{$theme_border['border-left']};
		border-right:{$theme_border['border-right']};
		border-style:{$theme_border['border-style']};
		border-color:{$theme_secondary_color};
	}
	.emallshop-main-menu > ul.emallshop-vertical-menu > li > a, .emallshop-main-menu ul.emallshop-vertical-menu .sub-menu li, .widget-title,.widget_rss li, .widget ul.post-list-widget li, .widget ul.product_list_widget li, .portfolio_one_column .entry-portfolio .portfolio-skill, .woocommerce .single-product-entry .entry-summary .cart, .woocommerce div.product div.products h2, .cart-collaterals .cross-sells h2, .social-share h3, .navigation h3, .related-posts h3, .related-portfolios h3, .product-section.categories_and_products .section-title > a h3, .product-section .section-tab .nav-tabs, .product-section .section-tab .nav-tabs li a, .product-section .section-header .section-title, .newsletter-section .section-header .section-title, .testimonials-section .section-header .section-title, .widget-section .widget-title,  .woocommerce ul.cart_list li, .woocommerce ul.product_list_widget li, .product-toolbar, .product .entry-summary .product-countdown, .portfolio-list .one_column_grid, .portfolio-list .one_column_grid  .portfolio-skill, .emallshop-vertical-menu.main-navigation > li > a, .related-posts h3, .title_with_products_tab.product-section .section-header, ul.dokan-seller-wrap li.dokan-list-single-seller .dokan-store-banner-wrap, .live-search-results .autocomplete-suggestion{
		border-bottom:{$theme_border['border-bottom']};
		border-style:{$theme_border['border-style']};
		border-color:{$theme_border['border-color']};
	}
	.portfolio_one_column .entry-portfolio .portfolio-skill, .woocommerce .single-product-entry .entry-summary .cart, .product-items .category-entry, .woocommerce-pagination, .wcv_pagination, .portfolio-list .one_column_grid  .portfolio-skill, .woocommerce  ul.products .product-content .product-attrs, .widget .maxlist-more{
		border-top:{$theme_border['border-top']};
		border-style:{$theme_border['border-style']};
		border-color:{$theme_border['border-color']};
	}
	.product-items .category-entry{
		border-right:{$theme_border['border-right']};
		border-style:{$theme_border['border-style']};
		border-color:{$theme_border['border-color']};
	}
	.product-section.categories_and_products .section-tab, .categories_and_products.brands-products .section-content, .categories_and_products.only-categories .section-content, .categories_and_products.brands-categories .section-content, .product-section .section-brands .banner-img, .search-control-group .search-bar-controls, .wcmp_main_page .wcmp_side_menu{
		border-left:{$theme_border['border-left']};
		border-style:{$theme_border['border-style']};
		border-color:{$theme_border['border-color']};
	}
	button, input, select, textarea, button,.button, input[type="button"], input[type="reset"], input[type="submit"], .lmp_load_more_button .lmp_button, ul.main-navigation li a .emallshop-menu-label span, .post-navigation .nav-next .post-nav-thumb, .header-post-navigation .nav-next .post-nav-thumb, .post-navigation .nav-previous .post-nav-thumb, .header-post-navigation .nav-previous .post-nav-thumb, .posts-navigation, ul.social-link li a, .wcaccount-topbar .wcaccount-dropdown, .search-area, .navigation.comment-navigation .nav-links, .selectBox-dropdown-menu.categories-filter-selectBox-dropdown-menu, .search-control-group .tt-menu, .header-cart-content .heading-cart.cart-style-3 > i, .header-services .icon-service, .header-cart-content .mini-cart-items, .widget .tagcloud a, .widget.yith-woocompare-widget .clear-all, .dokan-form-control, .blog-posts .hentry, .entry-thumbnail .hover-overlay-btn a i, .entry-content .more-link, .entry-summary .more-link, .portfolio-content .more-link, .blogs_carousel .blog-entry .hentry, .entry-date, .comment-area-wrap, .comment-respond, .comment-avatar img, .woocommerce-tabs #reviews .comment-text, .comment-list, .woocommerce #content div.product #reviews .comment img, .woocommerce div.product #reviews .comment img, .woocommerce-page #content div.product #reviews .comment img, .woocommerce-page div.product #reviews .comment img, .related-posts .hentry, .testimonials-section .quote-content p, .testimonials-section .quote-meta  .client-image, .testimonials .quote-content p, .testimonials-list .quote-content p, .product-section.products_brands .brands-carousel .slide-row li.brand-item, .countdown .countdown-section, .emallshop-notice-wrapper, .category-content, .woocommerce .selectBox-dropdown, .selectBox-dropdown-menu li a .woocommerce a.selectBox, .woocommerce a.selectBox:hover, .product-items li.product, .product-items li.category-entry, .woocommerce  ul.products.product-style2 .product-content .product-buttons .compare, .woocommerce  ul.products.product-style2 .product-content .product-buttons .add_to_wishlist, .woocommerce  ul.products.product-style2 .product-content .yith-wcwl-wishlistaddedbrowse a, .woocommerce  ul.products.product-style2 .product-content .yith-wcwl-wishlistexistsbrowse a, .woocommerce  ul.products.product-style2 .product-content .product-buttons .quickview, .woocommerce  ul.products.product-style1 .product-content .product-buttons .compare, .woocommerce  ul.products.product-style1 .product-content .product-buttons .add_to_wishlist, .woocommerce  ul.products.product-style1 .product-content .yith-wcwl-wishlistaddedbrowse a, .woocommerce  ul.products.product-style1 .product-content .yith-wcwl-wishlistexistsbrowse a, .woocommerce  ul.products.product-style1 .product-content .product-buttons .quickview, .woocommerce  ul.products.product-style2 .product-content .product-buttons .product-cart a, .woocommerce  ul.products.product-style1 .product-content .product-buttons .product-cart a, .woocommerce ul.products.product-style3.list-view .product-buttons .product-cart a, .woocommerce ul.products.product-style3.list-view .product-buttons .compare, .woocommerce ul.products.product-style3.list-view .product-buttons .add_to_wishlist, .woocommerce ul.products.product-style3.list-view .yith-wcwl-wishlistaddedbrowse a, .woocommerce ul.products.product-style3.list-view .yith-wcwl-wishlistexistsbrowse a, .woocommerce ul.products.product-style3.list-view .product-content .product-buttons .quickview, .woocommerce ul.products.product-style3.list-view .product-content .product-buttons .product-cart a, .single-product-entry .images #product-image, .single-product-entry .flex-viewport,  .single-product-entry  .entry-summary .product-next .product-next-popup, .single-product-entry  .entry-summary .product-prev .product-prev-popup, .woocommerce table.shop_table, .woocommerce .cart_totals, .woocommerce-checkout .order_review,  .order_details-area, .customer-details-area, .woocommerce .col2-set .col-1, .woocommerce-page .col2-set .col-1, .woocommerce .col2-set .col-2, .woocommerce-page .col2-set .col-2, .woocommerce form.checkout_coupon, .woocommerce form.login, .woocommerce form.register, .woocommerce-MyAccount-navigation > ul li a, .portfolio-list .hentry, .related-portfolios .hentry, .portfolio-content .project-url a, .woocommerce .single-product-entry .entry-summary .yith-wcwl-add-to-wishlist, .woocommerce .single-product-entry .entry-summary .compare, .portfolio-list .portfolioFilter a, .widget-area .widget, .dokan-widget-area .widget, .content-area .rev_slider_wrapper li.tp-revslider-slidesli, div.wpb_single_image .vc_single_image-wrapper img, .post-slider.owl-carousel .owl-nav .owl-prev, .post-slider.owl-carousel .owl-nav .owl-next, #cookie-notice.cn-bottom.box, .category-banner-content .category-banner, .newsletter-content.modal-content, .wpb_wrapper .vc_single_image-wrapper, .dashboard-widget, input.dokan-btn[type="submit"], a.dokan-btn, .dokan-btn, ul.dokan-seller-wrap li.dokan-list-single-seller .dokan-store-thumbnail, .search-box-wrapper .search-box, ul.main-navigation .sub-menu, ul.main-navigation .emallshop-megamenu-wrapper, .icon-animation:after, .default-search-wrapper .search-toggle, .product-thumbnails .slick-slide,.woocommerce-product-gallery__trigger:before, .page-content .wcmp_main_page, .page-content .wcmp_regi_main .wcmp_regi_form_box {
		border-radius: {$theme_border_radius}px;
	}
	.topbar-notification .news-title, .header-cart-content .cart-style-1 .cart-icon, .owl-theme .owl-nav .owl-prev, .services ul.services .service-item:first-child, .product-toolbar .gridlist-toggle > a:first-child, .woocommerce .woocommerce-pagination ul.page-numbers li:first-child .page-numbers, .wcv_pagination li:first-child .page-numbers, .product-items li.product .product-image .owl-nav .owl-prev, .single-product-entry .product-prev .product-navbar, .header-post-navigation .nav-links li:first-child{
		border-radius:{$theme_border_radius}px 0 0 {$theme_border_radius}px;
	}
	.search-area .input-search-btn .search-btn, .header-cart-content .cart-style-1 .mini-cart-count, .owl-theme .owl-nav .owl-next, .services ul.services .service-item:last-child, .product-toolbar .gridlist-toggle > a:last-child, .woocommerce .woocommerce-pagination ul.page-numbers li:last-child .page-numbers, .wcv_pagination li:last-child .page-numbers, .product-items li.product .product-image .owl-nav .owl-next, .single-product-entry .product-next .product-navbar, .header-post-navigation .nav-links li:last-child, .mobile-menu-wrapper #mobile-nav-close{
		border-radius:0 {$theme_border_radius}px {$theme_border_radius}px 0;
	}
	.back-to-top, .product-section .section-tab .nav-tabs li a, .woocommerce div.product .woocommerce-tabs ul.tabs li, .vertical-menu-section .category-menu .category-menu-title{
		border-radius:{$theme_border_radius}px {$theme_border_radius}px 0 0;
	}
	.woocommerce  ul.products .product-content .product-extra-info, .woocommerce div.product .woocommerce-tabs .panel{
		border-radius: 0 0 {$theme_border_radius}px {$theme_border_radius}px;
	}
	.pagination > li:last-child > a, .pagination > li:last-child > span, .dokan-pagination > li:last-child > a{
		border-bottom-right-radius: {$theme_border_radius}px;
		border-top-right-radius:{$theme_border_radius}px;	
	}
	.pagination > li:first-child > a, .pagination > li:first-child > span, .dokan-pagination > li:first-child > a{
		border-bottom-left-radius:{$theme_border_radius}px;
		border-top-left-radius:{$theme_border_radius}px;
	}
	::-webkit-input-placeholder {
	   color:{$body_text_color};
	}
	:-moz-placeholder { /* Firefox 18- */
	  color:{$body_text_color};
	}
	::-moz-placeholder {  /* Firefox 19+ */
	   color:{$body_text_color};
	}
	:-ms-input-placeholder {  
	   color:{$body_text_color};
	}
	input, select, textarea, .woocommerce a.selectBox{
		background-color:{$body_input_background};
	}
	input, select, textarea, .woocommerce a.selectBox{
		color:{$body_input_color};
	}
	
	@media only screen and (max-width : 480px) {		
		.woocommerce-cart table.cart tr, .woocommerce table.wishlist_table tbody tr{
			border-top:{$theme_border['border-top']};
			border-bottom:{$theme_border['border-bottom']};
			border-left:{$theme_border['border-left']};
			border-right:{$theme_border['border-right']};
			border-style:{$theme_border['border-style']};
			border-color:{$theme_border['border-color']};
		}
		.woocommerce-cart table.cart tr:last-child, .woocommerce table.wishlist_table tbody tr:last-child{
			border-bottom:{$theme_border['border-bottom']};
			border-style:{$theme_border['border-style']};
			border-color:{$theme_border['border-color']};
		}
	}
	@media (min-width:480px) and (max-width:620px){
		.woocommerce-cart table.cart tr, .woocommerce table.wishlist_table tbody tr{
			border-top:{$theme_border['border-top']};
			border-bottom:{$theme_border['border-bottom']};
			border-left:{$theme_border['border-left']};
			border-right:{$theme_border['border-right']};
			border-style:{$theme_border['border-style']};
			border-color:{$theme_border['border-color']};
		}
		.woocommerce-cart table.cart tr:last-child, .woocommerce table.wishlist_table tbody tr:last-child{
			border-bottom:{$theme_border['border-bottom']};
			border-style:{$theme_border['border-style']};
			border-color:{$theme_border['border-color']};
		}
	}
	@media only screen and (max-width : 991px) {
		.section-sub-categories{
			border-top:{$theme_border['border-top']};
			border-bottom:{$theme_border['border-bottom']};
			border-left:{$theme_border['border-left']};
			border-right:{$theme_border['border-right']};
			border-style:{$theme_border['border-style']};
			border-color:{$theme_border['border-color']};
		}
		.section-sub-categories{
			border-radius:3px;
		}
	}
	
	/*
	* header color scheme
	*/
	#header{
		background-color:{$header_wrapper_background_rgb};
		background-image:url({$header_wrapper_background['background-image']});
		background-repeat:{$header_wrapper_background['background-repeat']};
		background-size:{$header_wrapper_background['background-size']};
		background-attachment:{$header_wrapper_background['background-attachment']};
		background-position:{$header_wrapper_background['background-position']};
	}	
	.header-middle{
		background-color:{$header_background_rgb};
		background-image:url({$header_background['background-image']});
		background-repeat:{$header_background['background-repeat']};
		background-size:{$header_background['background-size']};
		background-attachment:{$header_background['background-attachment']};
		background-position:{$header_background['background-position']};
		color:{$header_text_color};
		padding: {$header_padding['padding-top']} 0 {$header_padding['padding-bottom']} 0;
	}
	.header-middle .header-right > span > a, .header-middle .header-cart.cart-style-2 > a, .header-middle .header-cart-content .heading-cart.cart-style-3 h6, .header-middle .header-cart-content .heading-cart.cart-style-3 a, .header-middle .header-cart-content .heading-cart.cart-style-3 h6, .header-services .content-service h6, .search-toggle::before, .header-middle .mobile-main-navigation .toggle-menu h4, .header-middle .customer-support-email, .header-middle .customer-support-call{
		color:{$header_text_color};
	}
	.navbar-toggle .icon-bar{
		background-color:{$header_text_color};
	}
	.header-middle .search-area, .woocommerce .header-middle .search-categories a.selectBox{
		background-color:{$header_input_background};
	}
	.header-middle .search-area .search-field, .header-middle .search-categories a.selectBox, .header-middle .search-categories .categories-filter{
		color:{$header_input_color};
	}
	.header-middle a{
		color:{$header_link_color['regular']};
	}
	.header-middle a:hover, .header-middle .header-right > span > a:hover, .header-middle .header-cart.cart-style-2 > a:hover, .header-middle ul.main-navigation > li.menu-item-has-children:hover > a, .header-middle ul.main-navigation li.current-menu-ancestor > a,  .header-middle ul.main-navigation li.current-page-ancestor > a, .header-middle ul.main-navigation > li.current_page_item > a{
		color:{$header_link_color['hover']};
	}
	.header-middle a:active{
		color:{$header_link_color['active']};
	}
	.header-middle ::-webkit-input-placeholder {
	   color:{$header_input_color};
	}
	.header-middle :-moz-placeholder { /* Firefox 18- */
	  color:{$header_input_color};
	}
	.header-middle ::-moz-placeholder {  /* Firefox 19+ */
	   color:{$header_input_color};
	}
	.header-middle :-ms-input-placeholder {  
	   color:{$header_input_color};
	}
	.header-middle .search-area, .header-middle .header-cart-content .cart-style-1 .mini-cart-count, .header-services .icon-service{
		border-top:{$header_border['border-top']};
		border-bottom:{$header_border['border-bottom']};
		border-left:{$header_border['border-left']};
		border-right:{$header_border['border-right']};
		border-style:{$header_border['border-style']};
		border-color:{$header_border_color_rgb};
	}
	.header-middle .search-control-group .search-categories {
		border-left:{$header_border['border-left']};
		border-style:{$header_border['border-style']};
		border-color:{$header_border_color_rgb};
	}	
	
	/*
	* topbar color scheme
	*/
	.header-topbar, .header-topbar .wcaccount-topbar .wcaccount-dropdown, .header-topbar .wpml-ls-statics-shortcode_actions .wpml-ls-sub-menu, .header-topbar .wcml-dropdown .wcml-cs-submenu, .header-topbar .demo-dropdown-sub-menu, .header-topbar .woocommerce-currency-switcher-form ul.dd-options, .header-topbar .dropdown-menu{
		background-color:{$topbar_background_rgb};
		background-image:url({$topbar_background['background-image']});
		background-repeat:{$topbar_background['background-repeat']};
		background-size:{$topbar_background['background-size']};
		background-attachment:{$topbar_background['background-attachment']};
		background-position:{$topbar_background['background-position']};
		color:{$topbar_text_color};
	}
	.header-topbar input[type="textbox"], .header-topbar input[type="email"], .header-topbar select, .header-topbar textarea{
		background-color:{$topbar_input_background};
		color:{$topbar_input_color};
	}
	.header-topbar a, .header-topbar .dropdown-menu > li > a{
		color:{$topbar_link_color['regular']};
	}
	.header-topbar a:hover{
		color:{$topbar_link_color['hover']};
	}
	.header-topbar a:active{
		color:{$topbar_link_color['active']};
	}
	.header-topbar ::-webkit-input-placeholder {
	   color:{$topbar_input_color};
	}
	.header-topbar :-moz-placeholder { /* Firefox 18- */
	  color:{$topbar_input_color};
	}
	.header-topbar ::-moz-placeholder {  /* Firefox 19+ */
	   color:{$topbar_input_color};
	}
	.header-topbar :-ms-input-placeholder {  
	   color:{$topbar_input_color};
	}
	.header-topbar input[type="textbox"], .header-topbar input[type="email"], .header-topbar select, .header-topbar textarea{
		border-top:{$topbar_border['border-top']};
		border-bottom:{$topbar_border['border-bottom']};
		border-left:{$topbar_border['border-left']};
		border-right:{$topbar_border['border-right']};
		border-style:{$topbar_border['border-style']};
		border-color:{$topbar_border_color_rgb};
	}
	.header-topbar, .wcaccount-topbar .wcaccount-dropdown > li {
		border-bottom:{$topbar_border['border-bottom']};
		border-style:{$topbar_border['border-style']};
		border-color:{$topbar_border_color_rgb};
	}
	.topbar-right > span:last-child, .topbar-right .nav li:last-child{
		border-right:{$topbar_border['border-right']};
		border-style:{$topbar_border['border-style']};
		border-color:{$topbar_border_color_rgb};
	}
	.topbar-right > span, .topbar-right .nav li{
		border-left:{$topbar_border['border-left']};
		border-style:{$topbar_border['border-style']};
		border-color:{$topbar_border_color_rgb};
	}	
	
	/*
	* navigation bar color scheme
	*/
	.header-navigation{
		background-color:{$navigation_background_rgb};
		background-image:url({$navigation_background['background-image']});
		background-repeat:{$navigation_background['background-repeat']};
		background-size:{$navigation_background['background-size']};
		background-attachment:{$navigation_background['background-attachment']};
		background-position:{$navigation_background['background-position']};
		color:{$navigation_text_color};
	}
	.header-navigation .category-menu .category-menu-title h4, .header-navigation .mobile-main-navigation .toggle-menu h4, .header-navigation .category-menu .category-menu-title, .header-navigation .header-cart-content .heading-cart.cart-style-3 h6, .header-navigation .header-cart-content .heading-cart.cart-style-3 a{
		color:{$navigation_text_color};
	}
	.header-navigation .category-menu .category-menu-title, .header-navigation .search-area .input-search-btn .search-btn {
		background-color:{$navigation_secondary_color};
	}
	.header-navigation .search-area, .woocommerce .header-navigation .search-categories a.selectBox{
		background-color:{$navigation_input_background};
	}
	.header-navigation .search-area .search-field, .header-navigation .search-categories a.selectBox, .header-navigation .search-categories .categories-filter{
		color:{$navigation_input_color};
	}
	.header-navigation a{
		color:{$navigation_link_color['regular']};
	}
	.header-navigation a:hover, .header-navigation ul.main-navigation > li.menu-item-has-children:hover > a, .header-navigation ul.main-navigation li.current-menu-ancestor > a, .header-navigation ul.main-navigation li.current-page-ancestor > a, .header-navigation ul.main-navigation > li.current_page_item > a{
		color:{$navigation_link_color['hover']};
	}
	.header-navigation a:active{
		color:{$navigation_link_color['active']};
	}
	.header-navigation ::-webkit-input-placeholder {
	   color:{$navigation_input_color};
	}
	.header-navigation :-moz-placeholder { /* Firefox 18- */
	  color:{$navigation_input_color};
	}
	.header-navigation ::-moz-placeholder {  /* Firefox 19+ */
	   color:{$navigation_input_color};
	}
	.header-navigation :-ms-input-placeholder {  
	   color:{$navigation_input_color};
	}
	.header-navigation .search-area, .header-navigation .header-cart-content .cart-style-1 .mini-cart-count{
		border-top:{$navigation_border['border-top']};
		border-bottom:{$navigation_border['border-bottom']};
		border-left:{$navigation_border['border-left']};
		border-right:{$navigation_border['border-right']};
		border-style:{$navigation_border['border-style']};
		border-color:{$navigation_border_color_rgb};
	}
	.header-navigation ul.emallshop-horizontal-menu.main-navigation > li, .header-navigation .search-control-group .search-categories{
		border-left:{$navigation_border['border-left']};
		border-style:{$navigation_border['border-style']};
		border-color:{$navigation_border_color_rgb};
	}
	.header-navigation ul.emallshop-horizontal-menu.main-navigation > li:last-child{
		border-right:{$navigation_border['border-right']};
		border-style:{$navigation_border['border-style']};
		border-color:{$navigation_border_color_rgb};
	}
	
	/*
	* sticky header, topbar and navigation color scheme
	*/
	.header-topbar.es-sticky, .es-sticky .wcaccount-topbar .wcaccount-dropdown, .header-middle.es-sticky, .header-navigation.es-sticky{
		background-color:{$sticky_header_background_rgb};
		background-image:url({$sticky_header_background['background-image']});
		background-repeat:{$sticky_header_background['background-repeat']};
		background-size:{$sticky_header_background['background-size']};
		background-attachment:{$sticky_header_background['background-attachment']};
		background-position:{$sticky_header_background['background-position']};
	}
	.es-sticky .header-right > span > a, .es-sticky .header-cart.cart-style-2 > a, .es-sticky .header-cart-content .heading-cart.cart-style-3 h6, .es-sticky .header-cart-content .heading-cart.cart-style-3 a, .es-sticky .header-cart-content .heading-cart.cart-style-3 h6, .header-services .content-service h6, .search-toggle::before, .es-sticky .mobile-main-navigation .toggle-menu h4{
		color:{$sticky_header_text_color};
	}
	.es-sticky .navbar-toggle .icon-bar{
		background-color:{$sticky_header_text_color};
	}
	.es-sticky.search-area, .woocommerce .es-sticky .search-categories a.selectBox{
		background-color:{$sticky_header_input_background};
	}
	.es-sticky .search-area .search-field, .es-sticky .search-categories a.selectBox, .es-sticky .search-categories .categories-filter{
		color:{$sticky_header_input_color};
	}
	
	.es-sticky a{
		color:{$sticky_header_color['regular']};
	}
	.es-sticky a:hover, .header .es-sticky ul.main-navigation > li.menu-item-has-children:hover > a, .header .es-sticky ul.main-navigation li.current-menu-ancestor > a, .header .es-sticky ul.main-navigation li.current-page-ancestor > a, .header .es-sticky ul.main-navigation > li.current_page_item > a{
		color:{$sticky_header_color['hover']};
	}
	.es-sticky a:active{
		color:{$sticky_header_color['active']};
	}
	.es-sticky .search-area, .es-sticky .header-cart-content .cart-style-1 .mini-cart-count, .es-sticky .search-area, .es-sticky .header-services .icon-service, .es-sticky input[type="textbox"], .es-sticky input[type="email"], .es-sticky select, .es-sticky textarea{
		border-top:{$sticky_header_border['border-top']};
		border-bottom:{$sticky_header_border['border-bottom']};
		border-left:{$sticky_header_border['border-left']};
		border-right:{$sticky_header_border['border-right']};
		border-style:{$sticky_header_border['border-style']};
		border-color:{$sticky_header_border_color_rgb};
	}
	.es-sticky ul.emallshop-horizontal-menu.main-navigation > li, .es-sticky .search-control-group .search-categories, .es-sticky .topbar-right > span, .es-sticky .topbar-right .nav li{
		border-left:{$sticky_header_border['border-left']};
		border-style:{$sticky_header_border['border-style']};
		border-color:{$sticky_header_border_color_rgb};
	}
	.es-sticky ul.emallshop-horizontal-menu.main-navigation > li:last-child, .es-sticky .topbar-right > span:last-child, .es-sticky .topbar-right .nav li:last-child{
		border-right:{$sticky_header_border['border-right']};
		border-style:{$sticky_header_border['border-style']};
		border-color:{$sticky_header_border_color_rgb};
	}
	
	.header-topbar.es-sticky, .es-sticky .wcaccount-topbar .wcaccount-dropdown > li {
		border-bottom:{$sticky_header_border['border-bottom']};
		border-style:{$sticky_header_border['border-style']};
		border-color:{$sticky_header_border_color_rgb};
	}	
	
	/*
	* Menu color scheme
	*/
	ul.main-navigation .sub-menu, ul.main-navigation .emallshop-megamenu-wrapper, ul.main-navigation .toggle-submenu{
		background-color:{$menu_background_color};
		color:{$menu_text_color};
	}
	ul.main-navigation .sub-menu li a, ul.main-navigation .emallshop-megamenu-title a, .emallshop-megamenu-wrapper .emallshop-megamenu-submenu .widget li a{
		color:{$menu_link_color['regular']};
	}
	ul.main-navigation .sub-menu li a:hover, ul.main-navigation .emallshop-megamenu-title a:hover, .emallshop-megamenu-wrapper .emallshop-megamenu-submenu .widget li a:hover, ul.main-navigation ul.sub-menu li.menu-item-has-children:hover > a, ul.main-navigation ul.sub-menu li.current-page-ancestor > a, ul.main-navigation ul.sub-menu li.current-menu-ancestor > a, ul.main-navigation ul.sub-menu li.current-menu-item > a, ul.main-navigation ul.sub-menu li.current_page_item > a{
		color:{$menu_link_color['hover']};
	}
	ul.main-navigation .sub-menu li a:active, ul.main-navigation .emallshop-megamenu-title a:active, .emallshop-megamenu-wrapper .emallshop-megamenu-submenu .widget li a:action{
		color:{$menu_link_color['active']};
	}
	ul.main-navigation .sub-menu li, ul.main-navigation .widget_rss li, ul.main-navigation .widget ul.post-list-widget li{
		border-bottom:{$menu_border['border-bottom']};
		border-style:{$menu_border['border-style']};
		border-color:{$menu_border['border-color']};
	}
	ul.main-navigation .emallshop-megamenu-wrapper .emallshop-megamenu > li{
		border-right:{$menu_border['border-right']};
		border-style:{$menu_border['border-style']};
		border-color:{$menu_border['border-color']};
	}
	
	/*
	* Page heading color scheme
	*/
	#header .page-heading{
		background-color:{$page_heading_background_rgb};
		background-image:url({$page_heading_background['background-image']});
		background-repeat:{$page_heading_background['background-repeat']};
		background-size:{$page_heading_background['background-size']};
		background-attachment:{$page_heading_background['background-attachment']};
		background-position:{$page_heading_background['background-position']};
		color:{$page_heading_text_color};
		padding: {$page_heading_padding['padding-top']} 0 {$page_heading_padding['padding-bottom']} 0;
	}
	.page-heading .page-header .page-title{
		color:{$page_heading_heading_color};
	}
	#header .page-heading{
		border-bottom:{$page_heading_border['border-bottom']};
		border-style:{$page_heading_border['border-style']};
		border-color:{$page_heading_border_color_rgb};
	}
	.page-heading a{
		color:{$page_heading_link_color['regular']};
	}
	.page-heading a:hover{
		color:{$page_heading_link_color['hover']};
	}
	
	/*
	* footer color scheme
	*/
	.footer {
		background-color:{$footer_wrapper_background_rgb};
		background-image:url({$footer_wrapper_background['background-image']});
		background-repeat:{$footer_wrapper_background['background-repeat']};
		background-size:{$footer_wrapper_background['background-size']};
		background-attachment:{$footer_wrapper_background['background-attachment']};
		background-position:{$footer_wrapper_background['background-position']};
	}
	.footer .footer-top, .footer .footer-middle{
		background-color:{$footer_background_rgb};
		background-image:url({$footer_background['background-image']});
		background-repeat:{$footer_background['background-repeat']};
		background-size:{$footer_background['background-size']};
		background-attachment:{$footer_background['background-attachment']};
		background-position:{$footer_background['background-position']};
		color:{$footer_text_color};
	}
	.footer .footer-middle{
		padding: {$footer_padding['padding-top']} 0 {$footer_padding['padding-bottom']} 0;
	}
	.footer .widget-title{
		color:{$footer_heading_color};
	}
	.footer input[type="textbox"], .footer input[type="email"], .footer select, .footer textarea{
		background-color:{$footer_input_background};
		color:{$footer_input_color};
	}
	.footer .footer-top a, .footer .footer-middle  a{
		color:{$footer_link_color['regular']};
	}
	.footer .footer-top a:hover, .footer .footer-middle a:hover{
		color:{$footer_link_color['hover']};
	}
	.footer .footer-top a:active, .footer .footer-middle a:active{
		color:{$footer_link_color['active']};
	}
	.footer ::-webkit-input-placeholder {
	   color:{$footer_input_color};
	}
	.footer :-moz-placeholder { /* Firefox 18- */
	  color:{$footer_input_color};
	}
	.footer ::-moz-placeholder {  /* Firefox 19+ */
	   color:{$footer_input_color};
	}
	.footer :-ms-input-placeholder {  
	   color:{$footer_input_color};
	}
	.footer input[type="textbox"], .footer input[type="email"], .footer select, .footer textarea{
		border-top:{$footer_border['border-top']};
		border-bottom:{$footer_border['border-bottom']};
		border-left:{$footer_border['border-left']};
		border-right:{$footer_border['border-right']};
		border-style:{$footer_border['border-style']};
		border-color:{$footer_border_color_rgb};
	}
	.footer .footer-top, .footer .footer-middle{
		border-bottom:{$footer_border['border-bottom']};
		border-style:{$footer_border['border-style']};
		border-color:{$footer_border_color_rgb};
	}
	.footer .popular-categories .categories-list li{
		border-right:{$footer_border['border-right']};
		border-style:{$footer_border['border-style']};
		border-color:{$footer_border_color_rgb};
	}
	
	/*
	* Copyright color scheme
	*/
	.footer-copyright{
		background-color:{$copyright_background_rgb};
		background-image:url({$copyright_background['background-image']});
		background-repeat:{$copyright_background['background-repeat']};
		background-size:{$copyright_background['background-size']};
		background-attachment:{$copyright_background['background-attachment']};
		background-position:{$copyright_background['background-position']};
		color:{$copyright_text_color};
		padding: {$copyright_padding['padding-top']} 0 {$copyright_padding['padding-bottom']} 0;
	}
	.footer-copyright a{
		color:{$copyright_link_color['regular']};
	}
	.footer-copyright a:hover{
		color:{$copyright_link_color['hover']};
	}
	.footer-copyright a:active{
		color:{$copyright_link_color['active']};
	}
	.footer-copyright{
		border-bottom:{$copyright_border['border-bottom']};
		border-style:{$copyright_border['border-style']};
		border-color:{$copyright_border_color_rgb};
	}
	
	/*
	* General color scheme
	*/
	.product .product-highlight .out-of-stock span{
		background-color:{$outofstock_label_color};
	}
	.product .product-highlight .onsale span{
		background-color:{$sale_label_color};
	}
	.product .product-highlight .new span{
		background-color:{$new_label_color};
	}
	.product .product-highlight .featured span{
		background-color:{$featured_label_color};
	}
	
	.yit-wcan-container .yith-wcan-loading {
		background: url({$loading_image}) no-repeat center;
	}
	
	/*
	* Newsletter Color
	*/
	.newsletter-content.modal-content{
		background-color:{$newsletter_background['background-color']};
		background-image:url({$newsletter_background['background-image']});
		background-repeat:{$newsletter_background['background-repeat']};
		background-size:{$newsletter_background['background-size']};
		background-attachment:{$newsletter_background['background-attachment']};
		background-position:{$newsletter_background['background-position']};
		color:{$newsletter_color};
	}
	.newsletter-content .close, .newsletter-content .newsletter-text > h1{
		color:{$newsletter_color};
	}
	.newsletter-content .mc4wp-form-fields input[type="submit"]{
		background-color:{$newsletter_button_color};
	}
	
CSS;

	/*Theme RTL CSS*/
	$theme_css_rtl=<<<CSS
	
	.topbar-notification .news-title:after{
		border-right-color:{$theme_color};
	}
	.header-cart-content .cart-style-1 .cart-icon, .topbar-notification .news-title, .woocommerce .woocommerce-pagination ul.page-numbers li:first-child .page-numbers, .wcv_pagination li:first-child .page-numbers, .single-product-entry .product-prev .product-navbar, .header-post-navigation .nav-links li:first-child{
		border-radius:0 {$theme_border_radius}px {$theme_border_radius}px 0;
	}
	.header-cart-content .cart-style-1 .mini-cart-count, .search-area .input-search-btn .search-btn, .woocommerce .woocommerce-pagination ul.page-numbers li:last-child .page-numbers, .wcv_pagination li:last-child .page-numbers, .single-product-entry .product-next .product-navbar, .header-post-navigation .nav-links li:last-child, .mobile-menu-wrapper #mobile-nav-close{
		border-radius:{$theme_border_radius}px 0 0 {$theme_border_radius}px;
	}
	.product-section .section-brands .banner-img, .product-items .category-entry{
		border-right:{$theme_border['border-right']};
		border-style:{$theme_border['border-style']};
		border-color:{$theme_border['border-color']};
	}
	
	/*
	* topbar color scheme
	*/
	.topbar-right > span, .header-topbar .social-link ul li a{
		border-right:{$topbar_border['border-right']};
		border-style:{$topbar_border['border-style']};
		border-color:{$topbar_border['border-color']};
	}
	.topbar-right > span:last-child, .header-topbar .social-link ul li:last-child a{
		border-left:{$topbar_border['border-left']};
		border-style:{$topbar_border['border-style']};
		border-color:{$topbar_border['border-color']};
	}
	
	/*
	* header color scheme
	*/
	.header-cart-content .cart-style-1 .mini-cart-count, .header-middle ul.emallshop-horizontal-menu.main-navigation > li:last-child{
		border-left:{$header_border['border-left']};
		border-style:{$header_border['border-style']};
		border-color:{$header_border['border-color']};
	}
	.header-middle .search-control-group .search-categories{
		border-right:{$header_border['border-right']};
		border-style:{$header_border['border-style']};
		border-color:{$header_border['border-color']};
	}
	
	/*
	* navigation bar color scheme
	*/
	.header-navigation ul.emallshop-horizontal-menu.main-navigation > li, .header-navigation .search-control-group .search-categories{
		border-right:{$navigation_border['border-right']};
		border-style:{$navigation_border['border-style']};
		border-color:{$navigation_border['border-color']};
	}
	.header-navigation ul.emallshop-horizontal-menu.main-navigation > li:last-child{
		border-left:{$navigation_border['border-left']};
		border-style:{$navigation_border['border-style']};
		border-color:{$navigation_border['border-color']};
	}
	
	/*
	* Sticky Header Color Scheme
	*/
	
	.es-sticky ul.emallshop-horizontal-menu.main-navigation > li, .es-sticky .search-control-group .search-categories{
		border-right:{$sticky_header_border['border-right']};
		border-style:{$sticky_header_border['border-style']};
		border-color:{$sticky_header_border['border-color']};
	}
	.es-sticky .header-cart-content .cart-style-1 .mini-cart-count, .es-sticky ul.emallshop-horizontal-menu.main-navigation > li:last-child{
		border-left:{$sticky_header_border['border-left']};
		border-style:{$sticky_header_border['border-style']};
		border-color:{$sticky_header_border['border-color']};
	}
	
	/*
	* Menu color scheme
	*/
	.header-navigation ul.main-navigation .emallshop-megamenu-wrapper .emallshop-megamenu > li, .header-middle ul.main-navigation .emallshop-megamenu-wrapper .emallshop-megamenu > li{
		border-left:{$menu_border['border-left']};
		border-style:{$menu_border['border-style']};
		border-color:{$menu_border['border-color']};
	}
	
CSS;
	
	// Remove prices everywhere
	if(emallshop_get_option('login-to-see-price', 0) && !is_user_logged_in()){
		$theme_css.='
		.woocommerce span.amount, .woocommerce span.product-price, .woocommerce div.product p.price{
			display:none !important;
		}';
	}// End remove prices everywhere
	
	// Banner/ Image Hover Effect.
	if(emallshop_get_option('banner-hover-effect', 1)){
		$theme_css.='
		.wpb_wrapper .vc_single_image-wrapper{
		  background-color: #fff;
		  overflow: hidden;
		  position: relative;
		}
		.wpb_wrapper .vc_single_image-wrapper:hover{
			background-color:#000;
		}
		.wpb_wrapper .vc_single_image-wrapper:before, .wpb_wrapper .vc_single_image-wrapper:after{
		  bottom: 10px;
		  content: "";
		  left: 10px;
		  opacity: 0;
		  position: absolute;
		  right: 10px;
		  top: 10px;
		  -webkit-transition: opacity 0.35s ease 0s, transform 0.35s ease 0s;
		  -o-transition: opacity 0.35s ease 0s, transform 0.35s ease 0s;
		  transition: opacity 0.35s ease 0s, transform 0.35s ease 0s;
		  z-index: 1;
		}
		.wpb_wrapper .vc_single_image-wrapper:before {
		  border-bottom: 1px solid #ffffff;
		  border-top: 1px solid #ffffff;
		  -webkit-transform: scale(0, 1);
		  -ms-transform: scale(0, 1);
		  -o-transform: scale(0, 1);
		  transform: scale(0, 1);
		}
		.wpb_wrapper .vc_single_image-wrapper:after {
		  border-left: 1px solid #ffffff;
		  border-right: 1px solid #ffffff;
		  -webkit-transform: scale(1, 0);
		  -ms-transform: scale(1, 0);
		  -o-transform: scale(1, 0);
		  transform: scale(1, 0);
		}
		.wpb_wrapper .vc_single_image-wrapper img {
		  opacity: 1;
		  filter: alpha(opacity=100);
		  -webkit-transition: opacity 0.55s ease 0s;
		  -o-transition: opacity 0.35s ease 0s;
		  transition: opacity 0.35s ease 0s;
		  width: 100%;
		}
		.wpb_wrapper .vc_single_image-wrapper:hover:before, .wpb_wrapper .vc_single_image-wrapper:hover:after {
		  opacity: 1;
		  filter: alpha(opacity=100);
		  -webkit-transform: scale(1);
		  -ms-transform: scale(1);
		  -o-transform: scale(1);
		  transform: scale(1);
		}
		.wpb_wrapper .vc_single_image-wrapper:hover img {
		  opacity: 0.7;
		  filter: alpha(opacity=70);
		}';
	}// Banner/Image Hover Effect.
	
	/*Custom Options*/
	if(emallshop_get_option('mobile-products-per-row', 1 )==1){
		$theme_css.='
		@media only screen and (max-width : 480px) {
			.product-items .products.grid-view li.type-product, .product-items .products.no-owl li.type-product{
				width:100%;
			}
		}';
	}
	
	if(is_rtl()){
		$theme_css.=$theme_css_rtl;
	}
	
	wp_add_inline_style( 'emallshop-style', $theme_css );
}
endif; // emallshop_theme_style 
 
function hook_javascript() {
	
	ob_start();	
	
	$product_image_hover_style=  emallshop_get_option('product-image-hover-style','product-image-style2');	
	if($product_image_hover_style=="product-image-style3" || $product_image_hover_style=="product-image-style4"):
		$navigation = ($product_image_hover_style == 'product-image-style3') ? true : false;
		$pagination = ($product_image_hover_style == 'product-image-style4') ? true : false;?>		
		
		<script type="text/javascript">			
			jQuery(document).ready(function($) {
				productGalleryCarousel();
				
				function productGalleryCarousel(){
					$('.product-items li.product').each(function(){
						var productGalleryCarousel = $(this).find('.product_image_gallery');
						var interval;
						productGalleryCarousel.owlCarousel({
							items:				1,
							loop:				true,
							autoplayTimeout:	1500,
							rtl:				<?php echo is_rtl() ? "true" : "false" ; ?>,
							smartSpeed:			450,
							mouseDrag:			false,
							touchDrag:			false,
							//nav:				true,
							navText: 			['',''],
							dots: 				<?php echo $pagination ? "true" : "false" ; ?>,	
						});
						
						$(this).hover(function(){
							productGalleryCarousel.owlCarousel('invalidate', 'all').owlCarousel('refresh');
						});
						
						function stopOwlPropagation(element) {
							jQuery(element).on('to.owl.carousel', function(e) { e.stopPropagation(); });
							jQuery(element).on('next.owl.carousel', function(e) { e.stopPropagation(); });
							jQuery(element).on('prev.owl.carousel', function(e) { e.stopPropagation(); });
							jQuery(element).on('destroy.owl.carousel', function(e) { e.stopPropagation(); });
						}
						stopOwlPropagation('.owl-carousel');

						<?php if($pagination==1):?>
							$(this).hover(
								function(){
									interval = setInterval(function() {
										productGalleryCarousel.trigger('next.owl.carousel');
									}, 1500);								
								},
								function(){
									clearInterval(interval);
								}
							);
						<?php endif;?>
						
						<?php if($navigation==1):?>						
							var nextOwl = $(this).find('.product-slider-controls .owl-next');
							var prevOwl = $(this).find('.product-slider-controls .owl-prev');
							
							prevOwl.click(function(){
								productGalleryCarousel.trigger('prev.owl.carousel');
							});								
							nextOwl.click(function(){
								productGalleryCarousel.trigger('next.owl.carousel');
							});								
						<?php endif;?>
					});	
				}				
			});
		</script>
	<?php endif;
	
	$output= ob_get_clean();
	
	$output.="<script>";
	
	$output.=trim( emallshop_get_option('custom_js', '') );
	
	$output.="</script>";
	
	
	echo $output;
}
add_action('wp_footer','hook_javascript');