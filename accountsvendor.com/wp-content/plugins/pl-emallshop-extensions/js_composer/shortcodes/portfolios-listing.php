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
    "name"                  => esc_html__( "Portfolio Listing", "pl-emallshop-extensions"),
    "base"                  => "portfolio_listing",
	"description"           => esc_html__( "Display portfolio listing.", "pl-emallshop-extensions"),
    "category"              => esc_html__("EmallShop Theme", "pl-emallshop-extensions" ),
    "params"                => array(
		array(
			"type" 			=> "dropdown",
			"heading" 		=> esc_html__( "Portfolio Listing Style", "pl-emallshop-extensions" ),
			"param_name" 	=> "portfolio_style",
			"admin_label" 	=> true,
			"std"           => "portfolio_grid",
			"value" 		=> array(
				esc_html__( "Portfolio Grid", "pl-emallshop-extensions" )   => "portfolio_grid",
				esc_html__( "Timeline", "pl-emallshop-extensions" )   => "timeline",
			),
			"description" 	=> esc_html__( "portfolio listing style.", "pl-emallshop-extensions")
		),
		array(
			"type" 			=> "dropdown",
			"heading" 		=> esc_html__( "Portfolio Grid Style", "pl-emallshop-extensions" ),
			"param_name" 	=> "portfolio_grid_style",
			"std"           => "masonry_grid",
			"value" 		=> array(
				esc_html__( "Normal Grid", "pl-emallshop-extensions" )   => "normal_grid",
				esc_html__( "Masonry Grid", "pl-emallshop-extensions" )   => "masonry_grid",				
			),
			"dependency"  	=> array("element" => "portfolio_style","value" => array("portfolio_grid")),
			"description" 	=> esc_html__( "Choose portfolio grid style.", "pl-emallshop-extensions")
		),
		array(
			"type" 			=> "dropdown",
			"heading" 		=> esc_html__( "Grid Hover Effect", "pl-emallshop-extensions" ),
			"param_name" 	=> "grid_hover_effect",
			"std"           => "default_effect",
			"value" 		=> array(
				esc_html__( "Default Effect", "pl-emallshop-extensions" )   => "default_effect",
				esc_html__( "Effect 1", "pl-emallshop-extensions" )   => "effect1",
				esc_html__( "Effect 2", "pl-emallshop-extensions" )   => "effect2",
				esc_html__( "Effect 3", "pl-emallshop-extensions" )   => "effect3",
				esc_html__( "Effect 4", "pl-emallshop-extensions" )   => "effect4",
				esc_html__( "Effect 5", "pl-emallshop-extensions" )   => "effect5",
			),
			"dependency"  	=> array("element" => "portfolio_style","value" => array("portfolio_grid")),
			"description" 	=> esc_html__( "Choose portfolio grid hover effect.", "pl-emallshop-extensions")
		),
		array(
			"type" 			=> "dropdown",
			"heading" 		=> esc_html__( "Choose Portfolio Grid Columns", "pl-emallshop-extensions" ),
			"param_name" 	=> "portfolio_grid_column",
			"std"           => "two",
			"value" 		=> array(
				esc_html__( "1 Column", "pl-emallshop-extensions" )   => "one",
				esc_html__( "2 Columns", "pl-emallshop-extensions" )   => "two",
				esc_html__( "3 Columns", "pl-emallshop-extensions" )   => "three",
				esc_html__( "4 Columns", "pl-emallshop-extensions" ) => "four",
			),
			"dependency"  	=> array("element" => "portfolio_style","value" => array("portfolio_grid")),
			"description" 	=> esc_html__( "Show numner of portfolio grid column in the portfolio page.", "pl-emallshop-extensions")
		),
		array(
			"type" 			=> "textfield",
			"heading" 		=> __( "Show No. Of Portfolio", "pl-emallshop-extensions" ),
			"param_name" 	=> "per_page",
			"value" 		=> "10",
			"description" 	=> __( "Show number of portfolio per page.", "pl-emallshop-extensions" ),
		),
		array(
			"type" 			=> "dropdown",
			"heading" 		=> esc_html__( "Order By", "pl-emallshop-extensions" ),
			"param_name" 	=> "orderby",
			"std"           => "date",
			"value" 		=> array(
				esc_html__( "Date", "pl-emallshop-extensions" )   => "date",
				esc_html__( "Title", "pl-emallshop-extensions" )   => "title",
				esc_html__( "Name(Slug)", "pl-emallshop-extensions" ) => "name",
				esc_html__( "Random", "pl-emallshop-extensions" )   => "rand",
				esc_html__( "ID", "pl-emallshop-extensions" )   => "id",
			),
			"description" 	=> esc_html__( "Select to sort portfolio.", "pl-emallshop-extensions")
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
			"description" 	=> esc_html__( "Select to sort portfolio.", "pl-emallshop-extensions")
		),
		array(
			"type" 			=> "dropdown",
			"heading" 		=> esc_html__( "Portfolio Pagination Style", "pl-emallshop-extensions" ),
			"param_name" 	=> "portfolio_pagination",
			"std"           => "infinity_scroll",
			"value" 		=> array(
				esc_html__( "Default Pagination", "pl-emallshop-extensions" )   => "default_pagination",
				esc_html__( "Infinity Scroll", "pl-emallshop-extensions" )   => "infinity_scroll",
				esc_html__( "Load More Button", "pl-emallshop-extensions" ) => "more_button",
				esc_html__( "AJAX Pagination", "pl-emallshop-extensions" )   => "pagination",
			),
			"description" 	=> esc_html__( "Select portfolio pagination style.", "pl-emallshop-extensions")
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

class WPBakeryShortCode_Portfolio_Listing extends WPBakeryShortCode {	
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'portfolio_listing', $atts ) : $atts;
        extract( shortcode_atts( array(
		
            "portfolio_style"	=> "portfolio_grid",
			"portfolio_grid_style"	=> "masonry_grid",
			"grid_hover_effect"	=> "default_effect",
			"portfolio_grid_column"	=> "two",
			"per_page"		=> 10,		
			"orderby"		=> "date",
			"order"         => "desc",
			"portfolio_pagination"	=> "infinity_scroll",
            "css"           => "",       
            "el_class"      => "",        
           
        ), $atts ) );
        
		$shortcode_class = array(
        	'base' => apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'portfolio_listing', $this->settings['base'], $atts ),
        	'extra' => $this->getExtraClass( $el_class ),
            'shortcode_custom' => vc_shortcode_custom_css_class( $css, ' ' )
        );        
        $shortcode_class = preg_replace( array( '/\s+/', '/^\s|\s$/' ), array( ' ', '' ), implode( ' ', $shortcode_class ) );
		
		$GLOBALS['portfolio_pagination']=$portfolio_pagination;
		$GLOBALS['portfolio_grid_column']=$portfolio_grid_column;
		
		$portfolio_content_class="portfolio-item";
		if($portfolio_grid_column=='one'):
			$portfolio_content_class.=" one_column_grid";
		elseif($portfolio_grid_column=='two'):
			$portfolio_content_class.=" col-xs-6 col-sm-6 multi_grid";
		elseif($portfolio_grid_column=='three'):
			$portfolio_content_class.=" col-xs-6 col-sm-6 col-md-4 multi_grid";
		elseif($portfolio_grid_column=='four'):
			$portfolio_content_class.=" col-xs-6 col-sm-6 col-md-3 multi_grid";
		endif;
		
		$gridMode=($portfolio_grid_style=='masonry_grid') ? ' masorny-grid' : ' normal-grid';
		$grid_hover_effect=($portfolio_style=='portfolio_grid' && $portfolio_grid_column!='one') ? $grid_hover_effect : '';
		
		
		//Get Portfolios
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
				'post_type'				=> 'portfolio',
				'post_status'			=> 'publish',
				'posts_per_page' 		=> $atts['per_page'],
				'orderby' 			    => $atts['orderby'],
				'order' 				=> $atts['order'],
				'paged' 				=> $paged,
			);
		
		query_posts( $args ); 
		
		ob_start();?>							
			
			<div class="portfolio-list <?php echo esc_attr($portfolio_style);?>">
			
				<?php if ( have_posts() ) : 
						
					$portfolio_cats = get_categories(array(
						'taxonomy' => 'portfolio_cat'
					));
				
					if (!empty($portfolio_cats)) :	?>
						<ul class="portfolioFilter">
							<li><a href="#" data-filter="*" class="current"><?php echo esc_html__('Show All', 'pl-emallshop-extensions'); ?></a></li>
							<?php foreach ($portfolio_cats as $portfolio_cat) : ?>
							<li><a href="#" data-filter=".<?php echo esc_attr($portfolio_cat->slug);?>"><?php echo esc_html($portfolio_cat->name);?></a></li>
							<?php endforeach; ?>
						</ul> 
					<?php endif;?>
					
					<div class="row">
					
						<div class="portfolioContainer <?php echo esc_attr($grid_hover_effect.''.$gridMode);?>">

							<?php
							// Start the loop.
							while ( have_posts() ) : the_post();
								$item_class='';
								$item_cats = get_the_terms(get_the_ID(), 'portfolio_cat');
								if ($item_cats) :
									foreach ($item_cats as $item_cat) :
										$item_class .=' '. urldecode($item_cat->slug);
									endforeach;
								endif; ?>
								
								<div class="<?php echo esc_attr($item_class.' '.$portfolio_content_class);?>">
								
									<?php get_template_part( 'templates/portfolio/'.$portfolio_style );	?>
									
								</div>
								
							<?php // End the loop.
							endwhile;?>
							
						</div>

					</div>
					
					<?php // Previous/next page navigation.
					if ( function_exists( 'emallshop_pagination_nav' ) ) :
						emallshop_pagination_nav();  
					endif;
					
				// If no content, include the "No posts found" template.
				else :
					get_template_part( 'content', 'none' );        
				endif;
				
				wp_reset_query(); ?>
				
			</div>
		<?php
		$result = ob_get_clean();		
        return $result;
    }
}