<?php
/**
 * @author  PressLayouts
 * @package PL EmallShop Extensions
 * @version 1.1.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

vc_map( array(
    "name"                  => esc_html__( "Hot Deal Products", "pl-emallshop-extensions"),
    "base"                  => "hot_deal_products",
	"description"           => esc_html__( "Display hot deal products with carousel.", "pl-emallshop-extensions"),
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
            "type"        	=> "emallshop_product_cates_with_none",
            "heading"     	=> esc_html__("Select Category", "pl-emallshop-extensions"),
            "param_name"  	=> "category",
            "admin_label" 	=> true,
			"description" 	=> esc_html__( "If you want to display hot deal products of specific category then select category otherwise skip it.", "pl-emallshop-extensions" ),
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

class WPBakeryShortCode_Hot_Deal_Products extends WPBakeryShortCode {	
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'hot_deal_products', $atts ) : $atts;
        extract( shortcode_atts( array(
		
            "title"          => "Products Title",
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
        	'base' => apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'hot_deal_products', $this->settings['base'], $atts ),
        	'extra' => $this->getExtraClass( $el_class ),
            'shortcode_custom' => vc_shortcode_custom_css_class( $css, ' ' )
        );        
        $shortcode_class = preg_replace( array( '/\s+/', '/^\s|\s$/' ), array( ' ', '' ), implode( ' ', $shortcode_class ) );
						
		//Get Products
        global $woocommerce_loop, $wpdb;
		
		// Get products on sale
		$product_ids_raw = $wpdb->get_results(
		"SELECT posts.ID, posts.post_parent
		FROM `$wpdb->posts` posts
		INNER JOIN `$wpdb->postmeta` ON (posts.ID = `$wpdb->postmeta`.post_id)
		INNER JOIN `$wpdb->postmeta` AS mt1 ON (posts.ID = mt1.post_id)
		WHERE
			posts.post_status = 'publish'
			AND  (mt1.meta_key = '_sale_price_dates_to' AND mt1.meta_value >= ".time().") 
			GROUP BY posts.ID 
			ORDER BY posts.post_title");

		$product_ids_on_sale = array();

		foreach ( $product_ids_raw as $product_raw ) 
		{
			if(!empty($product_raw->post_parent))
			{
				$product_ids_on_sale[] = $product_raw->post_parent;
			}
			else
			{
				$product_ids_on_sale[] = $product_raw->ID;  
			}
		}
		$product_ids_on_sale = array_unique($product_ids_on_sale);
		
		//Hot Deal products
		$args = array(
				'post_type'				=> 'product',
				'post_status'			=> 'publish',
				'ignore_sticky_posts'	=> 1,
				'posts_per_page' 		=> $atts['per_page'],
				'orderby' 			    => $atts['orderby'],
				'order' 				=> $atts['order'],
				'post__in'			    => array_merge( array( 0 ), $product_ids_on_sale ),
			);
		$meta_query			= WC()->query->get_meta_query();
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
		
		$args['meta_query']	= $meta_query;
		$args['tax_query']	= $tax_query;
		
		$products = new WP_Query( $args );
		
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
							<?php if($row==$products_row || $products->current_post+1==$products->post_count){ 
								$row=0;?>
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