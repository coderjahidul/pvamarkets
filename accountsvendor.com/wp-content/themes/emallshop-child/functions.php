<?php
// Insert your Customization Functions. Read More - http://codex.wordpress.org/Child_Themes

add_action('wp_enqueue_scripts', 'emallshop_child_css');

/* 	EmallShop child css
 *
 * @ since EmallShop child 1.0.2
 */
if (!function_exists('emallshop_child_css')) {
	function emallshop_child_css() {		
			
		$parent_style = 'parent-style';
		wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css', array( 'emallshop-plugins' ) );
		wp_enqueue_style( 'child-style',
			get_stylesheet_directory_uri() . '/style.css',
			array( $parent_style, 'emallshop-plugins')
		);
	}
}
?>