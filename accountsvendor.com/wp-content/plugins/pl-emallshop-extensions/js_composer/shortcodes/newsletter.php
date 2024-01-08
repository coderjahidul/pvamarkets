<?php
/**
 * @author  PressLayouts
 * @package PL EmallShop Extensions
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

vc_map( array(
    "name"                  => esc_html__( "Newsletter", "pl-emallshop-extensions"),
    "base"                  => "newsletter",
	"description"           => esc_html__( "Display newsletter.", "pl-emallshop-extensions"),
    "category"              => esc_html__("EmallShop Theme", "pl-emallshop-extensions" ),
    "params"                => array(
		array(
			"type" 			=> "textfield",
			"heading" 		=> esc_html__( "Title", "pl-emallshop-extensions" ),
			"param_name" 	=> "title",
			"description"   => esc_html__( "Enter title", "pl-emallshop-extensions" ),
			"admin_label"   => true,
		),
		array(
			"type" 			=> "textfield",
			"heading" 		=> esc_html__( "Newsletter Tag line.", "pl-emallshop-extensions" ),
			"param_name" 	=> "newsletter_tagline",
			"description" 	=> esc_html__( "Enter newsletter tag line.", "pl-emallshop-extensions" ),
		),
		array(
            "type"        	=> "css_editor",
            "heading"     	=> esc_html__( "Css", "pl-emallshop-extensions" ),
            "param_name"  	=> "css",
            "group"       	=> esc_html__( "Design options", "pl-emallshop-extensions" ),
            "admin_label" 	=> false,
		),
		array(
            "type"        	=> "textfield",
            "heading"     	=> esc_html__( "Extra class name", "pl-emallshop-extensions" ),
            "param_name"  	=> "el_class",
            "description" 	=> esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "pl-emallshop-extensions" ),
            "admin_label" 	=> false,
        ),     
    ),
));

class WPBakeryShortCode_Newsletter extends WPBakeryShortCode {	
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'newsletter', $atts ) : $atts;
        extract( shortcode_atts( array(
			"title"          => "title",
			"newsletter_tagline"  => "",      
            "css"            => "",       
            "el_class"       => "",           
        ), $atts ) );
        
		$shortcode_class = array(
        	'base' => apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'newsletter', $this->settings['base'], $atts ),
        	'extra' => $this->getExtraClass( $el_class ),
            'shortcode_custom' => vc_shortcode_custom_css_class( $css, ' ' )
        );        
        $shortcode_class = preg_replace( array( '/\s+/', '/^\s|\s$/' ), array( ' ', '' ), implode( ' ', $shortcode_class ) );

        $id = uniqid();
		ob_start();	?>	
		<div id="section-<?php echo esc_attr($id);?>" class="newsletter-section <?php echo esc_attr($shortcode_class);?>">
			<div class="section-header">
				<div class="section-title">
					<h3><?php echo esc_html($title);?></h3>
				</div>
			</div>
			<div class="section-content">
				<p><?php echo esc_html($newsletter_tagline);?></p>
				<?php if( function_exists( 'mc4wp_show_form' ) ) {
					mc4wp_show_form();
				}?>
			</div>
		</div>
		<?php
		$result = ob_get_clean();
        return $result;
    }
}