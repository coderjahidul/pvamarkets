<?php
defined( 'ABSPATH' ) or die( 'You cannot access this script directly' );

// Hook importer into admin init
add_action( 'admin_init', 'emallshop_importer' );
function emallshop_importer() {
	global $wpdb;

	if ( current_user_can( 'manage_options' ) && isset( $_GET['import_data_content'] )) {
		if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true); // we are loading importers

		if ( ! class_exists( 'WP_Importer' ) ) { // if main importer class doesn't exist
			$wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
			include $wp_importer;
		}

		if ( ! class_exists('WP_Import') ) { // if WP importer doesn't exist
			$wp_import = ES_EXTENSIONS_PATH . 'inc/importer/wordpress-importer.php';
			include $wp_import;
		}
		
		
		if ( class_exists( 'WP_Importer' ) && class_exists( 'WP_Import' ) ) { // check for main import class and wp import class
			$preset_type = $_GET['preset_type'];
			if(isset($preset_type)){				
					$shop_demo = true;
					$theme_xml_file = ES_EXTENSIONS_PATH . 'inc/importer/demo_data/'.$preset_type.'/sample_data.xml';
					$theme_options_file = ES_EXTENSIONS_URL . 'inc/importer/demo_data/'.$preset_type.'/theme_options.json';

					// Sidebar Widgets File
					$widgets_file = ES_EXTENSIONS_URL . 'inc/importer/demo_data/'.$preset_type.'/widget_data.json';

					$revslider_exists = true;
					$rev_directory = ES_EXTENSIONS_PATH . 'inc/importer/demo_data/'.$preset_type.'/';

					// reading settings
					$homepage_title = 'Home';	
			}			
			
			/* Import Posts, Pages, Product, Portfolio Content, FAQ, Images, Menus */
			$importer = new WP_Import();
			
			$theme_xml = $theme_xml_file;
			$importer->fetch_attachments = false;
			ob_start();
			//set_time_limit(0);
			$importer->import($theme_xml);
			ob_end_clean();	
			
			/* Import Woocommerce if WooCommerce Exists */
			if( class_exists('Woocommerce') && $shop_demo == true ) {

				// Set pages
				$woopages = array(
					'woocommerce_shop_page_id' => 'Shop',
					'woocommerce_cart_page_id' => 'Cart',
					'woocommerce_checkout_page_id' => 'Checkout',
					'woocommerce_myaccount_page_id' => 'My Account'
				);
				foreach($woopages as $woo_page_name => $woo_page_title) {
					$woopage = get_page_by_title( $woo_page_title );
					if(isset( $woopage ) && $woopage->ID) {
						update_option($woo_page_name, $woopage->ID); // Front Page
					}
				}

				// We no longer need to install pages
				$notices = array_diff( get_option( 'woocommerce_admin_notices', array() ), array( 'install', 'update' ) );
				update_option( 'woocommerce_admin_notices', $notices );
				delete_option( '_wc_needs_pages' );
				delete_transient( '_wc_activation_redirect' );
			}
			// Flush rules after install
			flush_rewrite_rules();
			
			// Import Theme Options
			$options_json = wp_remote_get( $theme_options_file );
			$options=json_decode($options_json['body'], true);
            $redux = ReduxFrameworkInstances::get_instance('emallshop_options');
            $redux->set_options($options);
			
			
			// Set imported menus to registered theme locations
			$locations = get_theme_mod( 'nav_menu_locations' ); // registered menu locations in theme
			$menus = wp_get_nav_menus(); // registered menus

			if($menus) {				
				foreach($menus as $menu) { // assign menus to theme locations
					
					if( $menu->name == 'Primary Menu' ) {
						$locations['primary'] = $menu->term_id;
					}elseif( $menu->name == 'Vertical Menu' ) {
						$locations['vertical_menu'] = $menu->term_id;
					//} elseif( $menu->name == 'Footer Menu' ) {
						//$locations['footer_menu'] = $menu->term_id;
					}					
				}
			}
			set_theme_mod( 'nav_menu_locations', $locations ); // set menus to locations
				

			// Add data to widgets
			if( isset( $widgets_file ) && $widgets_file ) {
				$widgets_json = $widgets_file; // widgets data file
				$widgets_json = wp_remote_get( $widgets_json );
				$widget_data = $widgets_json['body'];
				$import_widgets = emallshop_import_widget_data( $widget_data );
			}

			// Import Revslider
			if( class_exists('UniteFunctionsRev') && $revslider_exists == true ) { // if revslider is activated
				foreach( glob( $rev_directory . '*.zip' ) as $filename ) { // get all files from revsliders data dir
					$filename = basename($filename);
					$rev_files[] = $rev_directory . $filename;
				}
				
				$slider = new RevSlider();				
				foreach( $rev_files as $rev_file ) { // finally import rev slider data files
					$filepath = $rev_file;
						
					ob_start();
						$result = $slider->importSliderFromPost( true, false, $filepath );
					ob_clean();
					ob_end_clean();
				}
			}

			// Set reading options
			$homepage = get_page_by_title( $homepage_title );
			if(isset( $homepage ) && $homepage->ID) {
				update_option('show_on_front', 'page');
				update_option('page_on_front', $homepage->ID); // Front Page
			}

			wp_redirect( admin_url( 'themes.php?page=theme_options&imported=success' ) );

			exit;
		}
	}
}

// Parsing Widgets Function
// Thanks to http://wordpress.org/plugins/widget-settings-importexport/
function emallshop_import_widget_data( $widget_data ) {
	$json_data = $widget_data;
	$json_data = json_decode( $json_data, true );

	$sidebar_data = $json_data[0];
	$widget_data = $json_data[1];

	foreach ( $widget_data as $widget_data_title => $widget_data_value ) {
		$widgets[ $widget_data_title ] = '';
		foreach( $widget_data_value as $widget_data_key => $widget_data_array ) {
			if( is_int( $widget_data_key ) ) {
				$widgets[$widget_data_title][$widget_data_key] = 'on';
			}
		}
	}
	unset($widgets[""]);

	foreach ( $sidebar_data as $title => $sidebar ) {
		$count = count( $sidebar );
		for ( $i = 0; $i < $count; $i++ ) {
			$widget = array( );
			$widget['type'] = trim( substr( $sidebar[$i], 0, strrpos( $sidebar[$i], '-' ) ) );
			$widget['type-index'] = trim( substr( $sidebar[$i], strrpos( $sidebar[$i], '-' ) + 1 ) );
			if ( !isset( $widgets[$widget['type']][$widget['type-index']] ) ) {
				unset( $sidebar_data[$title][$i] );
			}
		}
		$sidebar_data[$title] = array_values( $sidebar_data[$title] );
	}

	foreach ( $widgets as $widget_title => $widget_value ) {
		foreach ( $widget_value as $widget_key => $widget_value ) {
			$widgets[$widget_title][$widget_key] = $widget_data[$widget_title][$widget_key];
		}
	}

	$sidebar_data = array( array_filter( $sidebar_data ), $widgets );

	emallshop_parse_import_data( $sidebar_data );
}

function emallshop_parse_import_data( $import_array ) {
	global $wp_registered_sidebars;
	$sidebars_data = $import_array[0];
	$widget_data = $import_array[1];
	$current_sidebars = get_option( 'sidebars_widgets' );
	$new_widgets = array( );

	foreach ( $sidebars_data as $import_sidebar => $import_widgets ) :

		foreach ( $import_widgets as $import_widget ) :
			//if the sidebar exists
			if ( isset( $wp_registered_sidebars[$import_sidebar] ) ) :
				$title = trim( substr( $import_widget, 0, strrpos( $import_widget, '-' ) ) );
				$index = trim( substr( $import_widget, strrpos( $import_widget, '-' ) + 1 ) );
				$current_widget_data = get_option( 'widget_' . $title );
				$new_widget_name = emallshop_get_new_widget_name( $title, $index );
				$new_index = trim( substr( $new_widget_name, strrpos( $new_widget_name, '-' ) + 1 ) );

				if ( !empty( $new_widgets[ $title ] ) && is_array( $new_widgets[$title] ) ) {
					while ( array_key_exists( $new_index, $new_widgets[$title] ) ) {
						$new_index++;
					}
				}
				$current_sidebars[$import_sidebar][] = $title . '-' . $new_index;
				if ( array_key_exists( $title, $new_widgets ) ) {
					$new_widgets[$title][$new_index] = $widget_data[$title][$index];
					$multiwidget = $new_widgets[$title]['_multiwidget'];
					unset( $new_widgets[$title]['_multiwidget'] );
					$new_widgets[$title]['_multiwidget'] = $multiwidget;
				} else {
					$current_widget_data[$new_index] = $widget_data[$title][$index];
					$current_multiwidget = isset($current_widget_data['_multiwidget']) ? $current_widget_data['_multiwidget'] : false;
					$new_multiwidget = isset($widget_data[$title]['_multiwidget']) ? $widget_data[$title]['_multiwidget'] : false;
					$multiwidget = ($current_multiwidget != $new_multiwidget) ? $current_multiwidget : 1;
					unset( $current_widget_data['_multiwidget'] );
					$current_widget_data['_multiwidget'] = $multiwidget;
					$new_widgets[$title] = $current_widget_data;
				}

			endif;
		endforeach;
	endforeach;

	if ( isset( $new_widgets ) && isset( $current_sidebars ) ) {
		update_option( 'sidebars_widgets', $current_sidebars );

		foreach ( $new_widgets as $title => $content )
			update_option( 'widget_' . $title, $content );

		return true;
	}

	return false;
}

function emallshop_get_new_widget_name( $widget_name, $widget_index ) {
	$current_sidebars = get_option( 'sidebars_widgets' );
	$all_widget_array = array( );
	foreach ( $current_sidebars as $sidebar => $widgets ) {
		if ( !empty( $widgets ) && is_array( $widgets ) && $sidebar != 'wp_inactive_widgets' ) {
			foreach ( $widgets as $widget ) {
				$all_widget_array[] = $widget;
			}
		}
	}
	while ( in_array( $widget_name . '-' . $widget_index, $all_widget_array ) ) {
		$widget_index++;
	}
	$new_widget_name = $widget_name . '-' . $widget_index;
	return $new_widget_name;
}
