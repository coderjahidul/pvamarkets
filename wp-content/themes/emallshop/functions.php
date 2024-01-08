<?php
/**
 * EmallShop functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage EmallShop
 * @since EmallShop 2.0
 */

 
 
/**
 * Define variables
 * @package WordPress
 * @subpackage EmallShop
 * @since EmallShop 2.0
 */

define('EMALLSHOP_DIR',                   	get_template_directory());                  // template directory
define('EMALLSHOP_URI',                   	get_template_directory_uri());              // template directory uri
define('EMALLSHOP_LIB',                   	EMALLSHOP_DIR . '/framework');              // library directory
define('EMALLSHOP_INC',                   	EMALLSHOP_DIR . '/inc');                    // library directory
define('EMALLSHOP_ADMIN',                	EMALLSHOP_DIR . '/admin');                  // admin directory
define('EMALLSHOP_ADMIN_URI',               EMALLSHOP_URI . '/admin');                  // admin directory uri
define('EMALLSHOP_CSS',                   	EMALLSHOP_URI . '/css');                    // css uri
define('EMALLSHOP_JS',                    	EMALLSHOP_URI . '/js');                     // javascript uri
define('EMALLSHOP_IMAGES',                	EMALLSHOP_URI . '/images');                 // image url
define('EMALLSHOP_ADMIN_IMAGES',            EMALLSHOP_ADMIN_URI . '/images');           // admin images
define('EMALLSHOP_PLUGINS_URI',             EMALLSHOP_URI . '/inc/plugins');            // plugins uri
define('EMALLSHOP_API', 					'http://presslayouts.com/demo/api/');

$theme = wp_get_theme();
define('EMALLSHOP_VERSION',               $theme->get('Version'));                    // get current version

define('EMALLSHOP_PREFIX', '_pl_');

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since EmallShop 2.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1200;
}

/**
 * EmallShop only works in WordPress 4.1 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'emallshop_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since EmallShop 1.0
 */
function emallshop_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on emallshop, use a find and replace
	 * to change 'emallshop' to the name of your theme in all the template files
	 */
	// wp-content/themes/emallshop/languages/it_IT.mo
	load_theme_textdomain( 'emallshop', get_template_directory() . '/languages' );
	
	// wp-content/languages/themes/emallshop-it_IT.mo
	load_theme_textdomain( 'emallshop', trailingslashit( WP_LANG_DIR ) . 'themes/' );

	// wp-content/themes/emallshop-child/languages/it_IT.mo
	load_theme_textdomain( 'emallshop', get_stylesheet_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	add_editor_style( array( 'style.css') );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );
		
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'emallshop' ),
		'vertical_menu' => esc_html__( 'Vertical Menu', 'emallshop' ),
		//'topbar_menu' => esc_html__( 'Topbar Menu', 'emallshop' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'image', 'video', 'quote', 'link', 'gallery', 'audio'
	) );

	$color_scheme  = emallshop_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'emallshop_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( get_template_directory_uri() . '/css/editor-style.css' );
}
endif; // emallshop_setup
add_action( 'after_setup_theme', 'emallshop_setup' );

/**
 * Register widget area.
 *
 * @since EmallShop 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function emallshop_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Widget Area', 'emallshop' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'emallshop' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Shop Page Widget Area', 'emallshop' ),
		'id'            => 'shop-page',
		'description'   => esc_html__( 'Add widgets here to appear in shop page sidebar.', 'emallshop' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Single Product Widget Area', 'emallshop' ),
		'id'            => 'single-product',
		'description'   => esc_html__( 'Add widgets here to appear in single product page sidebar.', 'emallshop' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Dokan Widget Area', 'emallshop' ),
		'id'            => 'dokan-widget-area',
		'description'   => esc_html__( 'Add widgets here to appear in dokan page sidebar.', 'emallshop' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Menu Widget Area 1', 'emallshop' ),
		'id'            => 'menu-widget-area-1',
		'description'   => esc_html__( 'Add widgets here to appear in your menu.', 'emallshop' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Menu Widget Area 2', 'emallshop' ),
		'id'            => 'menu-widget-area-2',
		'description'   => esc_html__( 'Add widgets here to appear in your menu.', 'emallshop' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Menu Widget Area 3', 'emallshop' ),
		'id'            => 'menu-widget-area-3',
		'description'   => esc_html__( 'Add widgets here to appear in your menu.', 'emallshop' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area 1', 'emallshop' ),
		'id'            => 'footer-widget-area-1',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'emallshop' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area 2', 'emallshop' ),
		'id'            => 'footer-widget-area-2',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'emallshop' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area 3', 'emallshop' ),
		'id'            => 'footer-widget-area-3',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'emallshop' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area 4', 'emallshop' ),
		'id'            => 'footer-widget-area-4',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'emallshop' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area 5', 'emallshop' ),
		'id'            => 'footer-widget-area-5',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'emallshop' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
}
add_action( 'widgets_init', 'emallshop_widgets_init' );

if ( ! function_exists( 'emallshop_enqueue_google_fonts' ) ) :
/**
 * Register Google fonts for EmallShop.
 *
 * @since EmallShop 2.0
 *
 * @return string Google fonts URL for the theme.
 */
add_action( 'wp_enqueue_scripts', 'emallshop_enqueue_google_fonts', 10000 );

function emallshop_enqueue_google_fonts() {

	$default_google_fonts = 'Open Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800';

	if( ! class_exists('Redux') )
		wp_enqueue_style( 'emallshop-google-fonts', emallshop_get_fonts_url( $default_google_fonts ), array(), '2.0' );
}
endif;

/**
 * ------------------------------------------------------------------------------------------------
 * Get google fonts URL
 * ------------------------------------------------------------------------------------------------
 */
if( ! function_exists( 'emallshop_get_fonts_url') ) {
	function emallshop_get_fonts_url( $fonts ) {
	    $font_url = '';

        $font_url = add_query_arg( 'family', urlencode( $fonts ), "//fonts.googleapis.com/css" );

	    return $font_url;
	}
}

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since EmallShop 1.1
 */
function emallshop_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'emallshop_javascript_detection', 0 );

/**
 * Add Post navigation.
 *
 * @since EmallShop 1.0
 *
 */
if ( ! function_exists( 'emallshop_pagination_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 * @since EmallShop 1.0
 * @return void
 */
function emallshop_pagination_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	
    $big = 999999999; // need an unlikely integer
    $pages = paginate_links( array(
            'base' 			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' 		=> '?paged=%#%',
            'current' 		=> max( 1, get_query_var('paged') ),
            'total' 		=> $wp_query->max_num_pages,
            'prev_next'	 	=> true,
			'prev_text' 	=> '<i class="fa fa-chevron-left"></i>',
			'next_text' 	=> '<i class="fa fa-chevron-right"></i>',
            'type'  		=> 'array',
			'end_size'     	=> 2,
			'mid_size'     	=> 2
        ) );
        if( is_array( $pages ) ) {
            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
            echo '<nav class="posts-navigation">';
			echo '<ul class="pagination">';
            foreach ( $pages as $page ) {
                echo "<li>$page</li>";
            }
           echo '</ul></nav>';
        }
		?>
	<?php
}
endif;

/**
 * Display descriptions in main navigation.
 *
 * @since EmallShop 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function emallshop_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'emallshop_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since EmallShop 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function emallshop_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'emallshop_search_form_modify' );

/**
 * Implement the Custom Header feature.
 *
 * @since EmallShop 1.0
 */
require EMALLSHOP_DIR . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 *
 * @since EmallShop 1.0
 */
require EMALLSHOP_DIR . '/inc/template-tags.php';

/**
 * Customizer additions.
 *
 * @since EmallShop 1.0
 */
require EMALLSHOP_DIR . '/inc/customizer.php';

/**
 * Include Customizer Function.
 * @since EmallShop 1.0
 */
include ( EMALLSHOP_INC . '/theme-function.php' );

/**
 * Implement the Customize theme style.
 *
 * @since EmallShop 1.0
 */
require EMALLSHOP_DIR . '/inc/customize-style.php';