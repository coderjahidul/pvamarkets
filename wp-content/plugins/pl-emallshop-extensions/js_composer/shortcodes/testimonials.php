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
    "name"                  => esc_html__( "Testimonials", "pl-emallshop-extensions"),
    "base"                  => "testimonials",
	"description"           => esc_html__( "Display your testimonials.", "pl-emallshop-extensions"),
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
			"type" 			=> "dropdown",
			"heading" 		=> esc_html__( "Order By", "pl-emallshop-extensions" ),
			"param_name" 	=> "orderby",
			"admin_label" 	=> true,
			"std"           => "date",
			"value" 		=> array(
				esc_html__( "Date", "pl-emallshop-extensions" )   => "date",
				esc_html__( "Title", "pl-emallshop-extensions" )   => "title",
				esc_html__( "Name(Slug)", "pl-emallshop-extensions" ) => "name",
				esc_html__( "Random", "pl-emallshop-extensions" )   => "rand",
				esc_html__( "ID", "pl-emallshop-extensions" )   => "id",
			),
			"description" 	=> esc_html__( "Select to sort testimonials", "pl-emallshop-extensions")
		),
		array(
			"type" 			=> "dropdown",
			"heading" 		=> esc_html__( "Order Direction", "pl-emallshop-extensions" ),
			"param_name" 	=> "order",
			"std"           => "desc",
			"value" 		=> array(
				esc_html__( "Descending", "pl-emallshop-extensions" ) => "desc",
				esc_html__( "Ascending", "pl-emallshop-extensions" )   => "asc",
			),
			"description" 	=> esc_html__( "Select to sort testimonials", "pl-emallshop-extensions")
		),
		array(
			"type" 			=> "textfield",
			"heading" 		=> esc_html__( "Show No. Of Testimonials", "pl-emallshop-extensions" ),
			"param_name" 	=> "per_page",
			"value" 		=> "10",
			"description" 	=> esc_html__( "Show number of testimonials", "pl-emallshop-extensions" ),
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

class WPBakeryShortCode_Testimonials extends WPBakeryShortCode {	
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'testimonials', $atts ) : $atts;
        extract( shortcode_atts( array(
			"title"          => "title",
			"orderby"		 => "date",
			"order"          => "desc",
			"per_page"       => 10,         
            "css"            => "",       
            "el_class"       => "",        
           
        ), $atts ) );
        
		$shortcode_class = array(
        	'base' => apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'testimonials', $this->settings['base'], $atts ),
        	'extra' => $this->getExtraClass( $el_class ),
            'shortcode_custom' => vc_shortcode_custom_css_class( $css, ' ' )
        );        
        $shortcode_class = preg_replace( array( '/\s+/', '/^\s|\s$/' ), array( ' ', '' ), implode( ' ', $shortcode_class ) );
		
		//Get Testimonials
		$args = array(
			'post_type'				=> 'testimonial',
			'post_status'			=> 'publish',
			'ignore_sticky_posts'	=> 1,
			'posts_per_page' 		=> $atts['per_page'],
			'orderby' 			    => $atts['orderby'],
			'order' 				=> $atts['order'],
			);
		
		$testimonials = new WP_Query( $args );
		
        $id = uniqid();
		ob_start();	?>		
		<div id="section-<?php echo esc_attr($id);?>" class="testimonials-section <?php echo esc_attr($shortcode_class);?>">
			<div class="section-header">
				<div class="section-title">
					<h3><?php echo esc_html($title);?></h3>
				</div>
			</div>
			<div class="section-content">
				<?php if ( $testimonials->have_posts() ) : ?>
					<ul class="testimonials testimonial-carousel owl-carousel owl-theme owl-theme">
						<?php while( $testimonials->have_posts() ): $testimonials->the_post();
						$testimonial_meta = get_post_meta( get_the_ID());?>
							<li class="blockquote">
								<div class="quote-content">
									<?php the_content();?>
								</div>
								<div class="quote-meta">
									<div class="name-designation">
										<a href="<?php echo esc_url(get_permalink());?>"><?php the_title()?></a>,<?php
										if( isset( $testimonial_meta['es_client_designation'] ) ):
											echo esc_attr($testimonial_meta['es_client_designation'][0]);
										endif;?><br>
										<span class="client-company">
										<?php
										if( isset( $testimonial_meta['es_client_company'] ) ):
											echo esc_attr($testimonial_meta['es_client_company'][0]);
										endif;?>
										</span>
									</div>
									<div class="client-image">
										<?php echo get_the_post_thumbnail( $testimonials->ID, 'thumbnail' ); ?>
									</div>
								</div>
							</li>
						<?php endwhile; // end of the loop. ?>
					</ul>
				<?php endif;
				wp_reset_postdata();?>
			</div>
		</div>
		<?php
		$result = ob_get_clean();
        return $result;
    }
}