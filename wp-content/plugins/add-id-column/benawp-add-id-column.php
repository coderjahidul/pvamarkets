<?php
/**
 * Plugin Name:       Ajouter une colonne d'ID
 * Plugin URI:        https://wordpress.org/plugins/add-id-column/
 * Description:       Gagner du temps ! Installer puis Activer cette extension et vous récupérerez facilement l'ID d'un article ou d'une page que vous voulez !
 * Version:           1.0.0
 * Requires at least: 3.0
 * Requires PHP:      5.6
 * Author:            BenaWP
 * Author URI:        https://www.linkedin.com/in/yvon-aulien-benahita-733350164/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       benawp-add-id-column
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Get with the filter
if ( ! function_exists( 'benawp_add_id_column' ) ) :
	function benawp_add_id_column( $columns ) {
		$columns['post_id_clmn'] = __( 'ID', 'benawp-add-id-column' );

		return $columns;
	}

	add_filter( 'manage_posts_columns', 'benawp_add_id_column', 5 ); // for posts
	add_filter( 'manage_pages_columns', 'benawp_add_id_column', 5 ); // for pages
endif;

// Print with an action hook
if ( ! function_exists( 'benawp_column_content' ) ) :
	function benawp_column_content( $column, $id ) {
		if ( $column === 'post_id_clmn' ) {
			esc_html_e( $id );
		}
	}

	add_action( 'manage_posts_custom_column', 'benawp_column_content', 5, 2 ); // for posts
	add_action( 'manage_pages_custom_column', 'benawp_column_content', 5, 2 ); // for pages
endif;

// Internationalization
if ( ! function_exists( 'benawp_load_text_domain' ) ) :
	function benawp_load_text_domain() {
		load_plugin_textdomain( 'benawp-add-id-column', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	add_action( 'init', 'benawp_load_text_domain' );
endif;
