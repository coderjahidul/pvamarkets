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
    "name"                  => esc_html__( "Blogs Listing", "pl-emallshop-extensions"),
    "base"                  => "blogs_listing",
	"description"           => esc_html__( "Display blogs listing.", "pl-emallshop-extensions"),
    "category"              => esc_html__("EmallShop Theme", "pl-emallshop-extensions" ),
    "params"                => array(
		array(
            "type"        	=> "emallshop_categories_with_none",
            "heading"     	=> esc_html__("Select Category", "pl-emallshop-extensions"),
            "param_name"  	=> "category",
			"description" 	=> esc_html__( "If you want to display  blogs of specific category then select category otherwise skip it.", "pl-emallshop-extensions" ),
        ),
		array(
			"type" 			=> "dropdown",
			"heading" 		=> esc_html__( "Choose Blogs Listing Style", "pl-emallshop-extensions" ),
			"param_name" 	=> "blog_page_style",
			"admin_label" 	=> true,
			"std"           => "large_image",
			"value" 		=> array(
				esc_html__( "Large Image", "pl-emallshop-extensions" )   => "large_image",
				esc_html__( "Small Image", "pl-emallshop-extensions" )   => "small_image",
				esc_html__( "Grid Column (Masonry Grid)", "pl-emallshop-extensions" ) => "grid_column",
				esc_html__( "Timeline", "pl-emallshop-extensions" )   => "timeline",
			),
			"description" 	=> esc_html__( "Choose blogs listing style.", "pl-emallshop-extensions")
		),
		array(
			"type" 			=> "dropdown",
			"heading" 		=> esc_html__( "Choose Blog Grid Columns", "pl-emallshop-extensions" ),
			"param_name" 	=> "blog_page_show_column",
			"std"           => "two",
			"value" 		=> array(
				esc_html__( "2 Columns", "pl-emallshop-extensions" )   => "two",
				esc_html__( "3 Columns", "pl-emallshop-extensions" )   => "three",
				esc_html__( "4 Columns", "pl-emallshop-extensions" ) => "four",
			),
			"dependency"  	=> array("element" => "blog_page_style","value" => array("grid_column")),
			"description" 	=> esc_html__( "Show blog grid column of the post/blog page.", "pl-emallshop-extensions")
		),
		array(
			"type" 			=> "textfield",
			"heading" 		=> __( "Show No. Of Blogs", "pl-emallshop-extensions" ),
			"param_name" 	=> "per_page",
			"value" 		=> "10",
			"description" 	=> __( "Show number of blogs per page.", "pl-emallshop-extensions" ),
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
			"description" 	=> esc_html__( "Select to sort blogs", "pl-emallshop-extensions")
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
			"description" 	=> esc_html__( "Select to sort blogs", "pl-emallshop-extensions")
		),
		array(
			"type" 			=> "dropdown",
			"heading" 		=> esc_html__( "Blog Pagination Style", "pl-emallshop-extensions" ),
			"param_name" 	=> "blog_pagination",
			"std"           => "default_pagination",
			"value" 		=> array(
				esc_html__( "Default Pagination", "pl-emallshop-extensions" )   => "default_pagination",
				esc_html__( "Infinity Scroll", "pl-emallshop-extensions" )   => "infinity_scroll",
				esc_html__( "Load More Button", "pl-emallshop-extensions" ) => "more_button",
				esc_html__( "AJAX Pagination", "pl-emallshop-extensions" )   => "pagination",
			),
			"description" 	=> esc_html__( "Select blog pagination style.", "pl-emallshop-extensions")
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

class WPBakeryShortCode_Blogs_Listing extends WPBakeryShortCode {	
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'blogs_listing', $atts ) : $atts;
        extract( shortcode_atts( array(
		
            "blog_page_style"          => "large_image",
			"blog_page_show_column"    => "two",
			"category"       => -1,
			"orderby"		 => "date",
			"order"          => "desc",
			"blog_pagination"	=> "default_pagination",
            "css"            => "",       
            "el_class"       => "",        
           
        ), $atts ) );
        
		$shortcode_class = array(
        	'base' => apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'blogs_listing', $this->settings['base'], $atts ),
        	'extra' => $this->getExtraClass( $el_class ),
            'shortcode_custom' => vc_shortcode_custom_css_class( $css, ' ' )
        );        
        $shortcode_class = preg_replace( array( '/\s+/', '/^\s|\s$/' ), array( ' ', '' ), implode( ' ', $shortcode_class ) );
		
		$GLOBALS['emall_blog_columns']=$blog_page_show_column;
		$GLOBALS['blog_pagination']=$blog_pagination;
		
		$blog_content_class="post_".$blog_page_style;
		if($blog_page_style=='small_image'):
			$blog_content_class.=" small-image";
		elseif($blog_page_style=='grid_column'):
			$blog_content_class.=" row masonry-grid";
		endif;

		//Get Categories
		$term = get_term_by( 'slug', $category, 'category' );
		if(!empty($term)):
			$tax_query=array(
							array(
								'taxonomy' => 'category',
								'field'    => 'id',
								'terms'    => $term->term_id,
								'operator' => 'IN'
							)
						);
		endif;
		
		//Get Blogs
		$paged =  ( ( get_query_var('paged') ) ? get_query_var('paged') : get_query_var('page') ) ? get_query_var('page') : 1;
		$args = array(
				'post_type'				=> 'post',
				'post_status'			=> 'publish',
				'posts_per_page' 		=> $atts['per_page'],
				'orderby' 			    => $atts['orderby'],
				'order' 				=> $atts['order'],
				'paged' 				=> $paged,
			);
			
		if(!empty($term)):
			$args['tax_query']=$tax_query;
		endif;
		
		query_posts( $args ); 
		
		ob_start();?>							
				
			<?php if ( have_posts() ) : ?>
			
				<div class="blog-posts <?php echo esc_attr($blog_content_class);?>">	
				
					<?php
					// Start the loop.
					while ( have_posts() ) : the_post();
						 /*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'templates/blog/'.$blog_page_style ); 
						
					// End the loop.
					endwhile;?>
				
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
		
		<?php
		$result = ob_get_clean();		
        return $result;
    }
}