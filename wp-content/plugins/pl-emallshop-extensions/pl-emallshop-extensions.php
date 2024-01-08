<?php
/*
Plugin Name: PL EmallShop Extensions
Plugin URI: http://themeforest.net/user/presslayouts
Description: VC Shortcode, Posts, widget and Data Importer for EmallShop eCommerce Theme.
Version: 1.2.3
Author: PressLayouts
Author URI: http://presslayouts.com
Text Domain: pl-emallshop-extensions
*/

// don't load directly
if (!defined('ABSPATH'))
    die('-1');
if ( 'emallshop' !== get_template() ) {
	return;
}
define("ES_EXTENSIONS_PATH", trailingslashit( plugin_dir_path(__FILE__) ) );
define("ES_EXTENSIONS_URL", trailingslashit( plugin_dir_url(__FILE__) ) );


// Load Custom Post types
require_once ES_EXTENSIONS_PATH .'posts/posts-content.php';

// Load Custom widget
require_once ES_EXTENSIONS_PATH .'widgets/widgets.php';

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

// Load plugin text domain
load_plugin_textdomain( 'pl-emallshop-extensions', false, plugin_basename( dirname( __FILE__ ) ) . "/languages" );

if ( !class_exists ( 'ReduxFramework' ) && file_exists ( ES_EXTENSIONS_PATH.'inc/redux-core/framework.php' ) ) {
    require_once ( ES_EXTENSIONS_PATH .'inc/redux-core/framework.php' );
} 

if ( !class_exists ( 'RWMB_Loader' ) && file_exists ( ES_EXTENSIONS_PATH.'inc/meta-box/meta-box.php' ) ) {
    require_once ( ES_EXTENSIONS_PATH.'inc/meta-box/meta-box.php' );
} 

// Load Wordpress Importer plugin
require_once ES_EXTENSIONS_PATH .'inc/importer/importer.php';

// Load Cookie
require_once ES_EXTENSIONS_PATH .'inc/cookie-notice.php';


/**
 * Initialising Visual Composer
 */ 
if ( class_exists( 'Vc_Manager', false ) ) {
	require_once ES_EXTENSIONS_PATH . 'js_composer/visual-composer.php';
}

/* 	Get Social share
/* --------------------------------------------------------------------- */
if( ! function_exists( 'emallshop_single_sharing' ) ) {
	function emallshop_single_sharing() {
		if( !emallshop_get_option('show-social-sharing', 1) || !is_single() ) return; 
		
		global $post;		
		$post_link	= esc_url( get_permalink() );
		$post_title = wp_strip_all_tags( get_the_title() );
		$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), false, '' );?>
		
		<div class="social-share <?php echo emallshop_get_option('social-sharing-style', 'style-1'); ?>">	
			<?php $post_title = htmlspecialchars(urlencode(html_entity_decode( $post_title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?>
			<ul class="social-link">	
				<?php if( emallshop_get_option( 'social-share-fb', 1 ) ): ?>
					<li class="icon-facebook"><a title="<?php echo esc_html__( 'Share on Facebook', 'emallshop' ); ?>" href="//www.facebook.com/sharer.php?u=<?php echo esc_url( $post_link ); ?>" onclick="window.open(this.href,this.title,'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=500,height=500,top=300px,left=300px');  return false;">
						<i class="fa fa-facebook"></i>
					</a></li>
				<?php endif; ?>	
				<?php if( emallshop_get_option( 'social-share-tw', 1 ) ): ?>
					<li class="icon-twitter"><a title="<?php echo esc_html__( 'Share on Twitter', 'emallshop' ); ?>" href="//twitter.com/share?url=<?php echo esc_url( $post_link ); ?>" onclick="window.open(this.href,this.title,'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=500,height=500,top=300px,left=300px');  return false;">
						<i class="fa fa-twitter"></i>
					</a></li>
				<?php endif; ?>
				<?php if( emallshop_get_option( 'social-share-in', 1 ) ): ?>
					<li  class="icon-linkedin"><a title="<?php echo esc_html__( 'Share on LinkedIn', 'emallshop' ); ?>" href="//www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url( $post_link ); ?>&title=<?php echo esc_attr( $post_title ); ?>" onclick="window.open(this.href,this.title,'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=500,height=500,top=300px,left=300px');  return false;">
						<i class="fa fa-linkedin"></i>
					</a></li>
				<?php endif; ?>		
				<?php if( emallshop_get_option( 'social-share-sl', 1 ) ): ?>
					<li  class="icon-submit"><a title="<?php echo esc_html__( 'Share on Stumbleupon', 'emallshop' ); ?>" href="//www.stumbleupon.com/submit?url=<?php echo esc_url( $post_link ); ?>&title=<?php echo esc_attr( $post_title ); ?>" onclick="window.open(this.href,this.title,'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=500,height=500,top=300px,left=300px');  return false;">
						<i class="fa fa-stumbleupon"></i>
					</a></li>
				<?php endif; ?>
				<?php if( emallshop_get_option( 'social-share-pr', 1 ) ): ?>
					<li  class="icon-pinterest"><a title="<?php echo esc_html__( 'Share on Pinterest', 'emallshop' ); ?>" href="//pinterest.com/pin/create/button/?url=<?php echo esc_url( $post_link ); ?>&media=<?php echo esc_url( $src[0] ); ?>&description=<?php echo esc_attr( $post_title ); ?>" onclick="window.open(this.href,this.title,'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=500,height=500,top=300px,left=300px');  return false;">
						<i class="fa fa-pinterest"></i>
					</a></li>
				<?php endif; ?>
				<?php if( emallshop_get_option( 'social-share-tl', 1 ) ): ?>
					<li  class="icon-tumblr"><a title="<?php echo esc_html__( 'Share on Tumblr', 'emallshop' ); ?>" href="//tumblr.com/widgets/share/tool?canonicalUrl=<?php echo esc_url( $post_link ); ?>" onclick="window.open(this.href,this.title,'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=500,height=500,top=300px,left=300px');  return false;">
						<i class="fa fa-tumblr"></i>
					</a>
				<?php endif; ?>
				
			</ul>
		</div>
		<div class="clear"></div> 
	<?php }
}