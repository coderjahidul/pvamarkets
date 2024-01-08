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
    "name"                  => esc_html__( "Products Carousel", "pl-emallshop-extensions"),
    "base"                  => "products_carousel",
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
			"value" 		=> "12",
			"description" 	=> esc_html__( "Show number of display product", "pl-emallshop-extensions" ),
		),
		array(
			"type" 			=> "dropdown",
			"heading" 		=> esc_html__( "Show No. Of Products row", "pl-emallshop-extensions" ),
			"param_name" 	=> "products_row",
			"std"           => "1",
			"value" 		=> array(
				"1 Row" => "1",
				"2 Row" => "2",
				"3 Row" => "3",
			),
			"description" 	=> esc_html__( "Show number of products row", "pl-emallshop-extensions" ),
		),		
		array(
			"type"        	=> "checkbox",
			"heading"     	=> esc_html__( "Autoplay", "pl-emallshop-extensions" ),
			"param_name"  	=> "auto_play",
			"group"       	=> esc_html__( "Carousel options", "pl-emallshop-extensions" ),
			"value"       	=> array( esc_html__( "Yes", "pl-emallshop-extensions" ) => "true" ),
			"description" 	=> esc_html__( "Enables autoplay mode", "pl-emallshop-extensions" ),
		),
		array(
			"type"        	=> "checkbox",
			"heading"     	=> esc_html__( "Loop", "pl-emallshop-extensions" ),
			"param_name"  	=> "loop",
			"group"       	=> esc_html__( "Carousel options", "pl-emallshop-extensions" ),
			"value"       	=> array( esc_html__( "Yes", "pl-emallshop-extensions" ) => "true" ),
			"description" 	=> esc_html__( "Inifnity loop. Duplicate last and first items to get loop illusion", "pl-emallshop-extensions" ),
		),
		array(
			"type"        	=> "checkbox",
			"heading"     	=> esc_html__( "Navigation", "pl-emallshop-extensions" ),
			"param_name"  	=> "navigation",
			"group"       	=> esc_html__( "Carousel options", "pl-emallshop-extensions" ),
			"value"       	=> array( esc_html__( "No", "pl-emallshop-extensions" ) => "false" ),
			"description" 	=> esc_html__( "Show next/prev buttons", "pl-emallshop-extensions" ),
		),
		array(
			"type"        	=> "checkbox",
			"heading"     	=> esc_html__( "Dots Navigation", "pl-emallshop-extensions" ),
			"param_name"  	=> "dots",
			"group"       	=> esc_html__( "Carousel options", "pl-emallshop-extensions" ),
			"value"       	=> array( esc_html__( "Yes", "pl-emallshop-extensions" ) => "true" ),
			"description" 	=> esc_html__( "Show dots navigation.", "pl-emallshop-extensions" ),
		),
		array(
			"type" 			=> "dropdown",
			"heading" 		=> esc_html__( "Show Items on Desktop (Screen resolution of device >= 1199px )", "pl-emallshop-extensions" ),
			"param_name" 	=> "rp_desktop",
			"group"       	=> esc_html__( "Carousel options", "pl-emallshop-extensions" ),
			"std"           => 5,
			"value" 		=> array(
				"1 Item"  => 1,
				"2 Items" => 2,
				"3 Items" => 3,
				"4 Items" => 4,
				"5 Items" => 5,
			),
			"description" 	=> esc_html__( "Show number of items on desktop", "pl-emallshop-extensions")
		),
		array(
			"type" 			=> "dropdown",
			"heading" 		=> esc_html__( "Show Items on Small Desktop (Screen resolution of device >=992px and < 1199px )", "pl-emallshop-extensions" ),
			"param_name" 	=> "rp_small_desktop",
			"group"       	=> esc_html__( "Carousel options", "pl-emallshop-extensions" ),
			"std"           => 4,
			"value" 		=> array(
				"1 Item"  => 1,
				"2 Items" => 2,
				"3 Items" => 3,
				"4 Items" => 4,
			),
			"description" 	=> esc_html__( "Show number of items on small desktop", "pl-emallshop-extensions")
		),
		array(
			"type" 			=> "dropdown",
			"heading" 		=> esc_html__( "Show Items on Tablet (Screen resolution of device >=621px and < 992px )", "pl-emallshop-extensions" ),
			"param_name" 	=> "rp_tablet",
			"group"       	=> esc_html__( "Carousel options", "pl-emallshop-extensions" ),
			"std"           => 3,
			"value" 		=> array(
				"1 Item"  => 1,
				"2 Items" => 2,
				"3 Items" => 3,
			),
			"description" 	=> esc_html__( "Show number of items on Tablet", "pl-emallshop-extensions")
		),
		array(
			"type" 			=> "dropdown",
			"heading" 		=> esc_html__( "Show Items on Mobile (Screen resolution of device >=445px and < 621px )", "pl-emallshop-extensions" ),
			"param_name" 	=> "rp_mobile",
			"group"       	=> esc_html__( "Carousel options", "pl-emallshop-extensions" ),
			"std"           => 2,
			"value" 		=> array(
				"1 Item"  => 1,
				"2 Items" => 2,
			),
			"description" 	=> esc_html__( "Show number of items on mobile", "pl-emallshop-extensions")
		),
		array(
			"type" 			=> "dropdown",
			"heading" 		=> esc_html__( "Show Items on Small Mobile (Screen resolution of device < 445px )", "pl-emallshop-extensions" ),
			"param_name" 	=> "rp_small_mobile",
			"group"       	=> esc_html__( "Carousel options", "pl-emallshop-extensions" ),
			"std"           => 1,
			"value" 		=> array(
				"1 Item"  => 1,
				"2 Items" => 2,
			),
			"description" 	=> esc_html__( "Show number of items on small mobile", "pl-emallshop-extensions")
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

class WPBakeryShortCode_Products_Carousel extends WPBakeryShortCode {	
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'products_carousel', $atts ) : $atts;
        extract( shortcode_atts( array(
		
            "title"          => "Products Title",
            "products_type"   => "recent-products",
			"category"       => -1,
			"orderby"		 => "date",
			"order"          => "desc",
			"per_page"       => 12,
			"products_row"   => 1,
            "auto_play"      => "false",
            "loop"    		 => "false", 
            "navigation"     => "true",
            "dots"         	 => "false",
			"rp_desktop"     => 5,
			"rp_small_desktop" => 4,
			"rp_tablet"     => 3,
			"rp_mobile"     => 2,
			"rp_small_mobile" => 1,
            "css"            => "",       
            "el_class"       => "",        
           
        ), $atts ) );
        
		$shortcode_class = array(
        	'base' => apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'products_carousel '.$products_type, $this->settings['base'], $atts ),
        	'extra' => $this->getExtraClass( $el_class ),
            'shortcode_custom' => vc_shortcode_custom_css_class( $css, ' ' )
        );        
        $shortcode_class = preg_replace( array( '/\s+/', '/^\s|\s$/' ), array( ' ', '' ), implode( ' ', $shortcode_class ) );
		
		//Get Products
        global $woocommerce_loop;		
		
		// Global Query
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
		
			$args['orderby'] 	= $atts['orderby'];
			$args['order'] 		= $atts['order'];
			$args['tax_query']	= $tax_query;
			
			$products = new WP_Query( $args );
			
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
			$products = new WP_Query( $args );
			
		endif;
		
		//best selling
		if(isset($products_type) && ( $products_type=="best-seller-products" )):
			
			$args['meta_key'] 	= 'total_sales';
			$args['orderby'] 	= 'meta_value_num';	
			$args['tax_query']	= $tax_query;
			
			$products = new WP_Query( $args );
			
		endif;
		
		//top reviews
		if(isset($products_type) && ( $products_type=="top-reviews-products" )):
		
			$args['orderby'] 	= $atts['orderby'];
			$args['order'] 		= $atts['order'];
			$args['tax_query']	= $tax_query;
			
			add_filter( 'posts_clauses', array( 'WC_Shortcodes', 'order_by_rating_post_clauses' ) );
			$products = new WP_Query( $args );
			remove_filter( 'posts_clauses', array( 'WC_Shortcodes', 'order_by_rating_post_clauses' ) );
			
		endif;
		
		//sale products
		if(isset($products_type) && ( $products_type=="sale-products" )):
		
			$product_ids_on_sale 	= wc_get_product_ids_on_sale();
			$args['orderby'] 		= $atts['orderby'];
			$args['order'] 			= $atts['order'];
			$args['tax_query']	= $tax_query;
			$args['post__in'] 		= array_merge( array( 0 ), $product_ids_on_sale );
		
			$products = new WP_Query( $args );
			
		endif;
		
        $id = uniqid();
		global $emallshop_owlparam;
		$emallshop_owlparam['productsCarousel']['section-'.$id] = array(
			'autoplay'    => $auto_play ? $auto_play : 'false',
			'loop'        => $loop ? $loop : 'false',
			'navigation'  => $navigation ? $navigation : 'true',
			'dots'  => $dots ? $dots : 'false',
			'rp_desktop'     => $rp_desktop,
			'rp_small_desktop' => $rp_small_desktop,
			'rp_tablet'     => $rp_tablet,
			'rp_mobile'     => $rp_mobile,
			'rp_small_mobile' => $rp_small_mobile,
		);
		
		$product_style='product-style1';
		if( function_exists( 'emallshop_get_option' ) ) {
			$product_style= emallshop_get_option('product-layout-style','product-style1') ;
		}
		
		ob_start();	?>		
		<div id="section-<?php echo esc_attr($id);?>" class="product-section <?php echo esc_attr($shortcode_class);?>">
			<div class="section-header">
				<div class="section-title">
					<h3><?php echo esc_attr($title);?></h3>
				</div>
			</div>
			<div class="section-content woocommerce">
				<?php if ( $products->have_posts() ) :?>
					<?php $row=1;?>
					<div class="product-items">
						<ul class="products product-carousel owl-carousel <?php echo esc_attr($product_style);?>">
						<?php while ( $products->have_posts() ) : $products->the_post(); ?>
							<?php if($row==1){?>
								<li class="slide-row">
									<ul>
							<?php }?>
								<?php wc_get_template_part( 'content', 'product' ); ?>
							<?php if($row==$products_row || $products->current_post+1==$products->post_count){ $row=0;?>
									</ul>
								</li>
							<?php } $row++;?>
						<?php endwhile; // end of the loop. ?>		
						</ul>
					</div>
				<?php endif;
				wp_reset_postdata();?>
			</div>
		</div>
		<?php
		$result = ob_get_clean();
        return $result;
    }

}