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
    "name"                  => esc_html__( "Services", "pl-emallshop-extensions"),
    "base"                  => "services",
	"description"           => esc_html__( "Display your services.", "pl-emallshop-extensions"),
    "category"              => esc_html__("EmallShop Theme", "pl-emallshop-extensions" ),
    "params"                => array(
		array(
            "type"        	=> "emallshop_service_category_with_none",
            "heading"     	=> esc_html__("Select Category", "pl-emallshop-extensions"),
            "param_name"  	=> "category",
            "admin_label" 	=> true,
			"description" 	=> esc_html__( "If you want to display services of specific category then select category otherwise skip it.", "pl-emallshop-extensions" ),
        ),
		array(
			"type" 			=> "dropdown",
			"heading" 		=> esc_html__( "Service Style", "pl-emallshop-extensions" ),
			"param_name" 	=> "service_style",
			"admin_label" 	=> true,
			"std"           => "style-1",
			"value" 		=> array(
				esc_html__( "Style 1", "pl-emallshop-extensions" )   => "style-1",
				esc_html__( "Style 2", "pl-emallshop-extensions" )   => "style-2",
			),
			"description" 	=> esc_html__( "Select service style", "pl-emallshop-extensions")
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
			"description" 	=> esc_html__( "Select to sort services", "pl-emallshop-extensions")
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
			"description" 	=> esc_html__( "Select to sort services", "pl-emallshop-extensions")
		),
		array(
			"type" 			=> "textfield",
			"heading" 		=> esc_html__( "Show No. Of Services", "pl-emallshop-extensions" ),
			"param_name" 	=> "per_page",
			"value" 		=> "4",
			"description" 	=> esc_html__( "Show number of services", "pl-emallshop-extensions" ),
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

class WPBakeryShortCode_Services extends WPBakeryShortCode {	
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'services', $atts ) : $atts;
        extract( shortcode_atts( array(
			"category"       => -1,
			"service_style"  => "style-1",
			"orderby"		 => "date",
			"order"          => "desc",
			"per_page"       => 4,         
            "css"            => "",       
            "el_class"       => "",        
           
        ), $atts ) );
        
		$shortcode_class = array(
        	'base' => apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'services '.$service_style, $this->settings['base'], $atts ),
        	'extra' => $this->getExtraClass( $el_class ),
            'shortcode_custom' => vc_shortcode_custom_css_class( $css, ' ' )
        );        
        $shortcode_class = preg_replace( array( '/\s+/', '/^\s|\s$/' ), array( ' ', '' ), implode( ' ', $shortcode_class ) );
		
		//Get Service Categories
		$term = get_term_by( 'slug', $category, 'service_cat' );
		if(!empty($term)):
			$tax_query=array(
							array(
								'taxonomy' => 'service_cat',
								'field'    => 'id',
								'terms'    => $term->term_id,
								'operator' => 'IN'
							)
						);
		endif;
		
		//Get Services
		$args = array(
			'post_type'				=> 'service',
			'post_status'			=> 'publish',
			'ignore_sticky_posts'	=> 1,
			'posts_per_page' 		=> $atts['per_page'],
			'orderby' 			    => $atts['orderby'],
			'order' 				=> $atts['order'],
			);			
		if(!empty($term)):
			$args['tax_query']=$tax_query;
		endif;
		
		$services = new WP_Query( $args );
		
        $id = uniqid();
		ob_start();	?>		
		<div id="section-<?php echo esc_attr($id);?>" class="services-section <?php echo esc_attr($shortcode_class);?>">
				<div class="section-content">
					<?php if ( $services->have_posts() ) : ?>
						<ul class="services row">
							<?php while( $services->have_posts() ): $services->the_post();
							$service_meta = get_post_meta( get_the_ID());
							?>
								<?php if(isset($service_style) && $service_style=='style-2'):?>
									<li class="service-item col-md-3 col-sm-6 col-xs-6">
										<?php if( isset( $service_meta['service_icon'] ) ):?>
											<i class="fa <?php echo esc_attr($service_meta['service_icon'][0]);?> fa-2x"></i>
										<?php endif;?>
										<div class="service-content">
											<h3><?php the_title();?></h3>
											<?php the_content();?>
										</div>
									</li>
								<?php else:?>								
									<li class="service-item col-md-3 col-sm-6 col-xs-6">
										<?php if( isset( $service_meta['service_icon'] ) ):?>
											<i class="fa <?php echo esc_attr($service_meta['service_icon'][0]);?> fa-2x"></i>
										<?php endif;?>
										<h3><?php the_title();?></h3>
										<?php the_content();?>
									</li>
								<?php endif;?>
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