<?php
/**
 * @author  PressLayouts
 * @package PL EmallShop Extensions
 * @version 1.1.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

vc_map( array(
    "name"                  => esc_html__( "Products Sidebar", "pl-emallshop-extensions"),
    "base"                  => "products_sidebar",
	"description"           => esc_html__( "Display products with carousel slider.", "pl-emallshop-extensions"),
    "category"              => esc_html__("EmallShop Theme", "pl-emallshop-extensions" ),
    "params"                => array(
		array(
			"type" 			=> "textfield",
			"heading" 		=> esc_html__( "Title", "pl-emallshop-extensions" ),
			"param_name" 	=> "title",
			"description"   => esc_html__( "Enter products title", "pl-emallshop-extensions" ),
			"admin_label"   => true,
		),	
		array(
            "type"        	=> "dropdown",
            "heading"     	=> esc_html__("Select Products Type", "pl-emallshop-extensions"),
            "param_name"  	=> "products_type",
            "admin_label" 	=> true,
            "std"         	=> "recent-products",
            "value"       	=> array(
				esc_html__( "Recent Products", "pl-emallshop-extensions" ) => "recent-products",
        		esc_html__( "Featured Products", "pl-emallshop-extensions" ) => "featured-products",
				esc_html__( "Top Reviews Products", "pl-emallshop-extensions" ) => "top-reviews-products",
                esc_html__( "Sale Products", "pl-emallshop-extensions" ) => "sale-products",
				esc_html__( "Best Selling Products", "pl-emallshop-extensions" ) => "best-seller-products",
        	),
			"description" 	=> esc_html__( "Choose any one product type.", "pl-emallshop-extensions" ),
        ),
		array(
            "type"        	=> "emallshop_product_cates_with_none",
            "heading"     	=> esc_html__("Select Category", "pl-emallshop-extensions"),
            "param_name"  	=> "category",
            "admin_label" 	=> true,
			"description" 	=> esc_html__( "If you want to display above products of specific category then select category otherwise skip it.", "pl-emallshop-extensions" ),
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
			"description" 	=> esc_html__( "Select to sort products", "pl-emallshop-extensions")
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
			"description" 	=> esc_html__( "Select to sort products", "pl-emallshop-extensions")
		),
		array(
			"type" 			=> "textfield",
			"heading" 		=> esc_html__( "Show No. Of Products", "pl-emallshop-extensions" ),
			"param_name" 	=> "per_page",
			"value" 		=> "10",
			"description" 	=> esc_html__( "Show number of display product", "pl-emallshop-extensions" ),
		),
		array(
			"type"        	=> "checkbox",
			"heading"     	=> esc_html__( "Enable Slider", "pl-emallshop-extensions" ),
			"param_name"  	=> "enable_slider",
			"group"       	=> esc_html__( "Carousel options", "pl-emallshop-extensions" ),
			"value"       	=> array( esc_html__( "Yes", "pl-emallshop-extensions" ) => "false" ),
			"description" 	=> esc_html__( "Enable product slider", "pl-emallshop-extensions" ),
		),
		array(
			"type"        	=> "textfield",
			"heading"     	=> esc_html__( "Show No. Of Product Per Slide", "pl-emallshop-extensions" ),
			"param_name"  	=> "product_per_slide",
			"group"       	=> esc_html__( "Carousel options", "pl-emallshop-extensions" ),
			"value"       	=> 5,
			"description" 	=> esc_html__( "Show numbers of product columns you want to display.", "pl-emallshop-extensions" ),
		),
		array(
			"type"        	=> "checkbox",
			"heading"     	=> esc_html__( "Autoplay", "pl-emallshop-extensions" ),
			"param_name"  	=> "auto_play",
			"group"       	=> esc_html__( "Carousel options", "pl-emallshop-extensions" ),
			"value"       	=> array( esc_html__( "Yes", "pl-emallshop-extensions" ) => "false" ),
			"description" 	=> esc_html__( "Enable autoplay mode", "pl-emallshop-extensions" ),
		),
		array(
			"type"        	=> "checkbox",
			"heading"     	=> esc_html__( "Loop", "pl-emallshop-extensions" ),
			"param_name"  	=> "loop",
			"group"       	=> esc_html__( "Carousel options", "pl-emallshop-extensions" ),
			"value"       	=> array( esc_html__( "Yes", "pl-emallshop-extensions" ) => "false" ),
			"description" 	=> esc_html__( "Inifnity loop. Duplicate last and first items to get loop illusion", "pl-emallshop-extensions" ),
		),
		array(
			"type"        	=> "checkbox",
			"heading"     	=> esc_html__( "Navigation", "pl-emallshop-extensions" ),
			"param_name"  	=> "navigation",
			"group"       	=> esc_html__( "Carousel options", "pl-emallshop-extensions" ),
			"value"       	=> array( esc_html__( "No", "pl-emallshop-extensions" ) => "false" ),
			"description" 	=> esc_html__( "Hide next/prev buttons", "pl-emallshop-extensions" ),
		),
		array(
			"type"        	=> "checkbox",
			"heading"     	=> esc_html__( "Dots Navigation", "pl-emallshop-extensions" ),
			"param_name"  	=> "dots",
			"group"       	=> esc_html__( "Carousel options", "pl-emallshop-extensions" ),
			"value"       	=> array( esc_html__( "Yes", "pl-emallshop-extensions" ) => "false" ),
			"description" 	=> esc_html__( "Show dots navigation.", "pl-emallshop-extensions" ),
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

class WPBakeryShortCode_Products_Sidebar extends WPBakeryShortCode {	
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'products_sidebar', $atts ) : $atts;
        extract( shortcode_atts( array(
		
            "title"          => "Products Title",
            "products_type"   => "recent-products",
			"category"       => -1,
			"orderby"		 => "date",
			"order"          => "desc",
			"per_page"       => 10,
			"enable_slider"	 => false,
			"product_per_slide" => 5,
            "auto_play"      => false,
            "loop"    		 => false, 
            "navigation"     => true,
            "dots"         	 => false,        
            "css"            => "",       
            "el_class"       => "",        
           
        ), $atts ) );
        
		$shortcode_class = array(
        	'base' => apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'products_sidebar '.$products_type, $this->settings['base'], $atts ),
        	'extra' => $this->getExtraClass( $el_class ),
            'shortcode_custom' => vc_shortcode_custom_css_class( $css, ' ' )
        );        
        $shortcode_class = preg_replace( array( '/\s+/', '/^\s|\s$/' ), array( ' ', '' ), implode( ' ', $shortcode_class ) );
		
       //Get Products
        global $woocommerce_loop;
			
		//Global Query
		$args = array(
				'post_type'				=> 'product',
				'post_status'			=> 'publish',
				'ignore_sticky_posts'	=> 1,
				'posts_per_page' 		=> $atts['per_page'],
			);
		$args['meta_query'] = WC()->query->get_meta_query();
		$tax_query   		= WC()->query->get_tax_query();
		
		//Get Categories
		$term = get_term_by( 'slug', $category, 'product_cat' );
		if(!empty($term)):
			$tax_query[]=array(
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'id',
								'terms'    => $term->term_id,
								'operator' => 'IN'
							)
						);
		endif;
		
		//recent products
		if(isset($products_type) && ( $products_type=="recent-products" )):	
			$args['orderby'] 		= $atts['orderby'];
			$args['order'] 			= $atts['order'];
			$args['tax_query']		= $tax_query;
		endif;
		
		//featured products
		if(isset($products_type) && ( $products_type=="featured-products" )):
			$tax_query[] = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'name',
				'terms'    => 'featured',
				'operator' => 'IN',
			);
			
			$args['orderby'] 	= $atts['orderby'];
			$args['order'] 		= $atts['order'];
			$args['tax_query']	= $tax_query;
		endif;
		
		//best selling
		if(isset($products_type) && ( $products_type=="best-seller-products" )):
			$args['meta_key'] 		= 'total_sales';
			$args['orderby'] 		= 'meta_value_num';
			$args['tax_query']		= $tax_query;
		endif;
		
		//top reviews
		if(isset($products_type) && ( $products_type=="top-reviews-products" )):
			$args['orderby'] 	= $atts['orderby'];
			$args['order'] 		= $atts['order'];
			$args['tax_query']	= $tax_query;
			add_filter( 'posts_clauses', array( 'WC_Shortcodes', 'order_by_rating_post_clauses' ) );
		endif;
		
		//sale products
		if(isset($products_type) && ( $products_type=="sale-products" )):
		
			$product_ids_on_sale 	= wc_get_product_ids_on_sale();
			$args['orderby'] 		= $atts['orderby'];
			$args['order'] 			= $atts['order'];
			$args['tax_query']		= $tax_query;
			$args['post__in'] 		= array_merge( array( 0 ), $product_ids_on_sale );
			
		endif;
		$products = new WP_Query( $args );
		
		if(isset($products_type) && ( $products_type=="top-reviews-products" )):
			remove_filter( 'posts_clauses', array( 'WC_Shortcodes', 'order_by_rating_post_clauses' ) );
		endif;
		
		ob_start();	
		
		$id = uniqid("productsCarousel-");
        if ($products->have_posts()) : ?>
			
			<?php if($enable_slider):
				$slider_class=" owl-carousel ".$id;
			else:
				$slider_class=""; 
			endif;?>
			<div class="widget-section widget emallshop_widget_products">
				<div class="widget-title"><h3><?php esc_html_e($title);?></h3></div>
				<ul class="product_list_widget<?php echo esc_attr($slider_class); ?> woocommerce">
					<?php $row=1; while ($products->have_posts()) : $products->the_post();?>
						<?php if( $enable_slider == true && $row==1){?>
							<li class="slide-row">
								<ul>
						<?php }?>
							
							<?php wc_get_template( 'emallshop-content-widget-product.php' );?>
							
						<?php if( $enable_slider == true && $row==$product_per_slide){ $row=0;?>
								</ul>
							</li>
						<?php } $row++;?>
					<?php endwhile;?>
				</ul>
			</div>
			<?php if($enable_slider): ?>
                <script type="text/javascript">
                    jQuery(document).ready(function($) {
						var emallshop_rtl = false;
						if($("body").hasClass("rtl")){
							emallshop_rtl =  true;
						}					
                        jQuery(".<?php echo esc_attr($id); ?>").owlCarousel({
							autoplay:<?php echo $auto_play ? "true" : "false" ; ?>,
							autoplayHoverPause: true,
							loop: <?php echo $loop ? "true" : "false" ; ?>,
							rtl: emallshop_rtl,
                            items:1,
                            nav: <?php echo $navigation ? "false" : "true" ; ?>,
							navText: ['',''],
							dots:<?php echo $dots ? "true" : "false" ; ?>,
                            lazyLoad: true,
							smartSpeed: 1000,
							rewind: true,
                            addClassActive: true,
                        });
						$( '.owl-carousel').addClass('owl-theme');
                    });
                </script>
            <?php endif; ?>
		
		<?php wp_reset_query();
			wp_reset_postdata();  // Restore global post data stomped by the_post().
        endif;
		
		$result = ob_get_clean();
        return $result;
    }

}