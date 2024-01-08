<?php
/*
* Cookie Notice allows you to elegantly inform users that your site uses cookies and to comply with the EU cookie law regulations.
*/

// exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

// set plugin instance
$cookie_notice = new EmallShop_Cookie_Notice();

/**
 * Cookie Notice class.
 *
 * @class Cookie_Notice
 * @version	1.0.0
 */
class EmallShop_Cookie_Notice {
	
	/**
	 * @var $cookie, holds cookie name
	 */
	private static $cookie = array(
		'name'	 => 'cookie_notice_accepted',
		'value'	 => 'TRUE'
	);

	/**
	 * Constructor.
	 */
	public function __construct() {

		
		// actions
		add_action( 'wp_enqueue_scripts', array( $this, 'es_front_load_scripts_styles' ) );
		add_action( 'wp_print_footer_scripts', array( $this, 'es_wp_print_footer_scripts' ) );
		add_action( 'wp_footer', array( $this, 'es_add_cookie_notice' ), 1000 );
	}
	
	public function emallshop_get_option($name, $default = '') {
		global $emallshop_options;
		if ( isset($emallshop_options[$name]) ) {
			return $emallshop_options[$name];
		}
		return $default;
	}
	public function pl_emallshop_hex2rgb_color($hex) {
	   $hex = str_replace("#", "", $hex);

	   if(strlen($hex) == 3) {
		  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
		  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
		  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
		  $r = hexdec(substr($hex,0,2));
		  $g = hexdec(substr($hex,2,2));
		  $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   return implode(",", $rgb); // returns the rgb values separated by commas
	   //return $rgb; // returns an array with the rgb values
	}
	
	/**
	 * Cookie notice output.
	 */
	public function es_add_cookie_notice() {
		if ( ! $this->es_cookie_setted()  && $this->emallshop_get_option('cookie_enable', 0)) {			
			// get cookie container args
			$options = apply_filters( 'cn_cookie_notice_args', array(
				'position'			=> $this->emallshop_get_option('cookie_positions', 'bottom'),
				'cookie_style'		=> $this->emallshop_get_option('cookie_style', 'box'),
				'cookie_title'		=> $this->emallshop_get_option('cookie_title', 'Cookies Notice'),
				'colors'			=> array('text'=>$this->emallshop_get_option('cookie_text_color', '#212121'), 'bar'=> $this->emallshop_get_option('cookie_background_color', '#fcfcfc')),
				'message_text'		=> $this->emallshop_get_option('cookie_message_text','We use cookies to ensure that we give you the best experience on our website. If you continue to use this site we will assume that you are happy with it.'),
				'accept_text'		=> $this->emallshop_get_option('cookie_accept_text', 'Ok'),
				'refuse_text'		=> $this->emallshop_get_option('cookie_refuse_text', 'No'),
				'refuse_opt'		=> $this->emallshop_get_option('cookie_refuse_opt',0),
				'see_more'			=> $this->emallshop_get_option('cookie_see_more_opt', 0),
				'see_more_text'		=> $this->emallshop_get_option('cookie_see_more_text','Read more'),
				'see_more_link_type'=> $this->emallshop_get_option('cookie_see_more_link_type','custom'),
				'see_more_link_custom'=> $this->emallshop_get_option('cookie_see_more_link_custom','#'),
				'see_more_link_pages'=> $this->emallshop_get_option('cookie_see_more_link_pages',''),
				'link_target'		=> $this->emallshop_get_option('cookie_see_more_link_target','_blank'),
			) );

			// message output
			$output = '
			<div id="cookie-notice" class="cn-' . $options['position'] .' '.($options['position'] == 'bottom' ? $options['cookie_style'] : ''). '" style="color: ' . $options['colors']['text'] . '; background-color: rgba(' . $this->pl_emallshop_hex2rgb_color($options['colors']['bar']) . ',0.96);">'
				. '<div class="cookie-notice-container"><h2>'.$options['cookie_title'].'</h2><span id="cn-notice-text">'. $options['message_text'] .'</span>'
				. '<a href="#" id="cn-accept-cookie" data-cookie-set="accept" class="cn-set-cookie button' . '">' . $options['accept_text'] . '</a>'
				. ($options['refuse_opt'] == 1 ? '<a href="#" id="cn-refuse-cookie" data-cookie-set="refuse" class="cn-set-cookie button' . '">' . $options['refuse_text'] . '</a>' : '' )
				. ($options['see_more'] == 1 ? '<a href="' . ($options['see_more_link_type'] === 'custom' ? $options['see_more_link_custom'] : get_permalink( $options['see_more_link_pages'] )) . '" target="' . $options['link_target'] . '" id="cn-more-info" class="button' . '">' . $options['see_more_text'] . '</a>' : '') . '
				</div>
			</div>';

			echo apply_filters( 'cn_cookie_notice_output', $output, $options );
		}
	}

	/**
	 * Checks if cookie is setted
	 */
	public function es_cookie_setted() {
		return isset( $_COOKIE[self::$cookie['name']] );
	}

	/**
	 * Checks if third party non functional cookies are accepted
	 */
	public static function es_cookies_accepted() {
		return ( isset( $_COOKIE[self::$cookie['name']] ) && strtoupper( $_COOKIE[self::$cookie['name']] ) === self::$cookie['value'] );
	}

	/**
	 * Load scripts and styles - frontend.
	 */
	public function es_front_load_scripts_styles() {
		if ( ! $this->es_cookie_setted() ) {
			wp_enqueue_script(
				'cookie-notice-front', ES_EXTENSIONS_URL .'assets/js/cookie-notice.js', array( 'jquery' ), '1.0.0', ( $this->emallshop_get_option('cookie_script_placements','footer')) === 'footer' ? true : false
			);

			wp_localize_script(
				'cookie-notice-front', 'cnArgs', array(
					'ajaxurl'				=> admin_url( 'admin-ajax.php' ),
					'hideEffect'			=> 'fade',
					'onScroll'				=> $this->emallshop_get_option('cookie_on_scroll',0),
					'onScrollOffset'		=> $this->emallshop_get_option('cookie_on_scroll_offset', 100),
					'cookieName'			=> self::$cookie['name'],
					'cookieValue'			=> self::$cookie['value'],
					'cookieTime'			=> $this->emallshop_get_option('cookie_expiry_times', '2592000'),
					'cookiePath'			=> ( defined( 'COOKIEPATH' ) ? COOKIEPATH : '' ),
					'cookieDomain'			=> ( defined( 'COOKIE_DOMAIN' ) ? COOKIE_DOMAIN : '' )
				)
			);

			wp_enqueue_style( 'cookie-notice-front', ES_EXTENSIONS_URL .'assets/css/cookie-notice.css' );
		}
	}
	
	/**
	 * Print non functional javascript.
	 * 
	 * @return mixed
	 */
	public function es_wp_print_footer_scripts() {
		$scripts = html_entity_decode( trim( wp_kses_post( $this->emallshop_get_option('cookie_refuse_code','') ) ) );
		
		if ( $this->es_cookie_setted() && ! empty( $scripts ) ) {
			?>
			<script type='text/javascript'>
				<?php echo $scripts; ?>
			</script>
			<?php
		}
	}
	
}

/**
 * Get the cookie notice status
 * 
 * @return boolean
 */
function es_cn_cookies_accepted() {
	return (bool) EmallShop_Cookie_Notice::cookies_accepted();
}
