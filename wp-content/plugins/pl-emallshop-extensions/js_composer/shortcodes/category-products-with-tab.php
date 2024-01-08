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
    "name"                  => esc_html__( "Category Products With Tab", "pl-emallshop-extensions"),
    "base"                  => "category_products_tab",
	"description"           => esc_html__( "Display category products with tabs", "pl-emallshop-extensions"),
    "category"              => esc_html__("EmallShop Theme", "pl-emallshop-extensions" ),
    "params"                => array(
		array(
			"type" 			=> "dropdown",
			"heading" 		=> esc_html__( "Category Products Tab Style", "pl-emallshop-extensions" ),
			"param_name" 	=> "category_products_tab_style",
			"std"           => "only_products_tab",
			"value" 		=> array(
				esc_html__( "Only Products Tab", "pl-emallshop-extensions" ) => "only_products_tab",
				esc_html__( "Name/Title With Products Tab", "pl-emallshop-extensions" ) => "title_with_products_tab",
				esc_html__( "Name/Title With Sub Categories", "pl-emallshop-extensions" ) => "title_with_sub_categories",
			),
			"description" 	=> esc_html__( "Choose category products tab style.", "pl-emallshop-extensions" ),
		),
		array(
			"type" 			=> "textfield",
			"heading" 		=> esc_html__( "Title", "pl-emallshop-extensions" ),
			"param_name" 	=> "title",
			"description"   => esc_html__( "Enter category name/title.", "pl-emallshop-extensions" ),
			"admin_label"   => true,
			"dependency"  	=> array("element" => "category_products_tab_style","value" => array("title_with_products_tab","title_with_sub_categories")),
		),
		/*array(
            "type"        	=> "emallshop_product_cates_with_none",
            "heading"     	=> esc_html__("Select Category", "pl-emallshop-extensions"),
            "param_name"  	=> "category_with_none",
            "admin_label" 	=> true,
			"description" 	=> esc_html__( "Choose any one parent category", "pl-emallshop-extensions" ),
			"dependency"  	=> array("element" => "category_products_tab_style","value" => array("only_products_tab")),
        ),*/
		array(
            "type"        	=> "emallshop_product_cates_with_none",
            "heading"     	=> esc_html__("Select Category", "pl-emallshop-extensions"),
            "param_name"  	=> "category",
            "admin_label" 	=> true,
			"description" 	=> esc_html__( "Choose any one category and display this category products and with tab", "pl-emallshop-extensions" ),
			//"dependency"  	=> array("element" => "category_products_tab_style","value" => array("title_with_products_tab","title_with_sub_categories")),
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
			"dependency"  	=> array("element" => "section_style","value" => array("banner-products","only-products")),
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
			"dependency"  	=> array("element" => "section_style","value" => array("banner-products","only-products")),
			"description" 	=> esc_html__( "Select to sort products", "pl-emallshop-extensions")
		),
		array(
			"type" 			=> "textfield",
			"heading" 		=> esc_html__( "Show No. Of Products Per Page", "pl-emallshop-extensions" ),
			"param_name" 	=> "per_page",
			"value" 		=> "12",
			"description" 	=> esc_html__( "Show number of product per page", "pl-emallshop-extensions" ),
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

class WPBakeryShortCode_Category_Products_Tab extends WPBakeryShortCode {
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'category_products_tab', $atts ) : $atts;
        extract( shortcode_atts( array(
		
			"category_products_tab_style" => "only_products_tab",
            "title"          => "Category Name",
			//"category_with_none" => -1,
            "category"       => -1,
			"orderby"		 => "date",
			"order"          => "desc",
			"per_page"       => "12",
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
        	'base' => apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'category_products_tab '.$category_products_tab_style, $this->settings['base'], $atts ),
        	'extra' => $this->getExtraClass( $el_class ),
            'shortcode_custom' => vc_shortcode_custom_css_class( $css, ' ' )
        );        
        $shortcode_class = preg_replace( array( '/\s+/', '/^\s|\s$/' ), array( ' ', '' ), implode( ' ', $shortcode_class ) );
		
		//Get Categories 
		//echo $category_with_none;
		/* if($category_with_none !=""){
			$category=$category_with_none;
		} */	
			
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
		$recent_args				= $args;
		$recent_args['orderby'] 	= $atts['orderby'];
		$recent_args['order'] 		= $atts['order'];
		$recent_args['tax_query']	= $tax_query;
		
		$recent_products = new WP_Query( $recent_args );
		
		if($category_products_tab_style != "title_with_sub_categories"){
			
			//featured products
			$f_tax_query   =$tax_query;
			$f_tax_query[] = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'name',
				'terms'    => 'featured',
				'operator' => 'IN',
			);
			
			$featured_args				= $args;
			$featured_args['orderby'] 	= $atts['orderby'];
			$featured_args['order'] 	= $atts['order'];
			$featured_args['tax_query']	= $f_tax_query;
			
			$featured_products = new WP_Query( $featured_args );
			
			//best selling
			$best_selling_args				= $args;
			$best_selling_args['meta_key'] 	= 'total_sales';
			$best_selling_args['orderby'] 	= 'meta_value_num';
			$best_selling_args['tax_query']	= $tax_query;
			
			$best_selling_products = new WP_Query( $best_selling_args );
			
			//top reviews
			$top_reviews_args				= $args;
			$top_reviews_args['orderby'] 	= $atts['orderby'];
			$top_reviews_args['order'] 		= $atts['order'];
			$top_reviews_args['tax_query']	= $tax_query;
			
			add_filter( 'posts_clauses', array( 'WC_Shortcodes', 'order_by_rating_post_clauses' ) );
			$top_reviews_products = new WP_Query( $top_reviews_args );
			remove_filter( 'posts_clauses', array( 'WC_Shortcodes', 'order_by_rating_post_clauses' ) );
			
			//sale products
			$product_ids_on_sale = wc_get_product_ids_on_sale();			
			$sale_args				= $args;
			$sale_args['orderby'] 	= $atts['orderby'];
			$sale_args['order'] 	= $atts['order'];
			$sale_args['tax_query']	= $tax_query;
			$sale_args['post__in'] 	= array_merge( array( 0 ), $product_ids_on_sale );
			
			$sale_products = new WP_Query( $sale_args );
		}
		
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
			<?php if($category_products_tab_style == "title_with_sub_categories"){?>			
			
				<?php if(!empty($term)){
						$args = array(
							'orderby'      	=> 'name',
							'order'        	=> 'asc',
							'number' 		=> 5,
							'hierarchical' 	=> 1,
							'show_option_none' => '',
							'hide_empty'	=> 1,
							'parent'		=> $term->term_id,
							'taxonomy' 		=> 'product_cat'
						);
				}else{
					$args = array(
							'orderby'      	=> 'name',
							'order'        	=> 'asc',
							'number' 		=> 5,
							'hierarchical' 	=> 1,
							'show_option_none' => '',
							'hide_empty'	=> 1,
							'taxonomy' 		=> 'product_cat'
						);
				}
				$subcats = get_categories($args);?>
				
				<div class="section-header">
					<div class="section-title">
						<h3><?php echo esc_attr($title);?></h3>
					</div>
					<div class="section-sub-categories">
						<ul class="sub-categories">
							<?php foreach($subcats as $cate):?>
								<?php $cate_link = get_term_link( $cate ); ?>
								<li><a href="<?php echo esc_url($cate_link);?>"><?php echo esc_html($cate->name);?></a></li>
							<?php endforeach;?>
						</ul>
					</div>
				</div>
				<div class="section-content woocommerce">
					<?php if ( $recent_products->have_posts() ) :?>
						<?php $row=1;?>
						<div class="product-items">
							<ul class="products product-carousel owl-carousel <?php echo esc_attr($product_style);?>">
							<?php while ( $recent_products->have_posts() ) : $recent_products->the_post(); ?>
								<?php if($row==1){?>
									<li class="slide-row">
										<ul>
								<?php }?>
									<?php wc_get_template_part( 'content', 'product' ); ?>
								<?php if($row==$products_row || $recent_products->current_post+1==$recent_products->post_count){ $row=0;?>
										</ul>
									</li>
								<?php } $row++;?>
							<?php endwhile; // end of the loop. ?>						
							</ul>
						</div>
					<?php endif;
					wp_reset_postdata();?>
				</div>
				
			<?php }else{?>
				
				<div class="section-header">
					<?php if($category_products_tab_style != "only_products_tab"){?>
						<div class="section-title">
							<h3><?php echo esc_attr($title);?></h3>
						</div>
					<?php }?>
					<div class="section-tab">
					<?php $t=0;?>
						<ul class="nav nav-tabs"><?php 
						if ( $recent_products->have_posts() ) :?>
							<li <?php echo  $t == 0 ? 'class="active"': '' ?>>
								<a href="#recent-<?php echo esc_attr($id);?>" data-toggle="tab"><?php _e('Recent Products','pl-emallshop-extensions');?></a>
							</li><?php $t++;						
						endif;
						if ( $best_selling_products->have_posts() ) :?>
							<li <?php echo  $t == 0 ? 'class="active"': '' ?>>
								<a href="#seller-<?php echo esc_attr($id);?>" data-toggle="tab"><?php _e('Best Selling','pl-emallshop-extensions');?></a>
							</li><?php $t++;						
						endif;						
						if ( $featured_products->have_posts() ) :?>
							<li <?php echo  $t == 0 ? 'class="active"': '' ?>>
								<a href="#featured-<?php echo esc_attr($id);?>" data-toggle="tab"><?php _e('Featured Products','pl-emallshop-extensions');?></a>
							</li><?php $t++;						
						endif;
						
						if ( $top_reviews_products->have_posts() ) :?>
							<li <?php echo  $t == 0 ? 'class="active"': '' ?>>
								<a href="#reviews-<?php echo esc_attr($id);?>" data-toggle="tab"><?php _e('Top Reviews','pl-emallshop-extensions');?></a>
							</li><?php $t++;						
						endif;
						
						if ( $sale_products->have_posts() ) :?>
							<li <?php echo  $t == 0 ? 'class="active"': '' ?>>
								<a href="#sale-<?php echo esc_attr($id);?>" data-toggle="tab"><?php _e('Sale Products','pl-emallshop-extensions');?></a>
							</li><?php $t++;						
						endif;?>
						</ul>						
					</div>
				</div>
				<div class="section-content woocommerce">
					<div class="tab-content">
					<?php $p=0;
					if ( $recent_products->have_posts() ) :?>
						<div class="tab-pane fade<?php echo  $p == 0 ? ' in active': '' ?>" id="recent-<?php echo esc_attr($id);?>">
							<?php $row=1;?>
							<div class="product-items">
								<ul class="products product-carousel owl-carousel <?php echo esc_attr($product_style);?>">
								<?php while ( $recent_products->have_posts() ) : $recent_products->the_post(); ?>
									<?php if($row==1){?>
										<li class="slide-row">
											<ul>
									<?php }?>
												<?php wc_get_template_part( 'content', 'product' ); ?>
									<?php if($row==$products_row || $recent_products->current_post+1==$recent_products->post_count){ $row=0;?>
											</ul>
										</li>
									<?php } $row++;?>
								<?php endwhile; // end of the loop. ?>
								</ul>
							</div>
						</div>
						<?php $p++;						
					endif;
					
					if ( $best_selling_products->have_posts() ) :?>
						<div class="tab-pane fade<?php echo  $p == 0 ? ' in active': '' ?>" id="seller-<?php echo esc_attr($id);?>">
							<?php $row=1;?>
							<div class="product-items">
								<ul class="products product-carousel owl-carousel <?php echo esc_attr($product_style);?>">
								<?php while ( $best_selling_products->have_posts() ) : $best_selling_products->the_post(); ?>
									<?php if($row==1){?>
										<li class="slide-row">
											<ul>
									<?php }?>
												<?php wc_get_template_part( 'content', 'product' ); ?>
									<?php if($row==$products_row || $best_selling_products->current_post+1==$best_selling_products->post_count){ $row=0;?>
											</ul>
										</li>
									<?php } $row++;?>
								<?php endwhile; // end of the loop. ?>
								</ul>
							</div>
						</div>
						<?php $p++;						
					endif;
					
					if ( $featured_products->have_posts() ) :?>
						<div class="tab-pane fade<?php echo  $p == 0 ? ' in active': '' ?>" id="featured-<?php echo esc_attr($id);?>">
							<?php $row=1;?>
							<div class="product-items">
								<ul class="products product-carousel owl-carousel <?php echo esc_attr($product_style);?>">
								<?php while ( $featured_products->have_posts() ) : $featured_products->the_post(); ?>
									<?php if($row==1){?>
										<li class="slide-row">
											<ul>
									<?php }?>
											<?php wc_get_template_part( 'content', 'product' ); ?>
									<?php if($row==$products_row || $featured_products->current_post+1==$featured_products->post_count){ $row=0;?>
											</ul>
										</li>
									<?php } $row++;?>
								<?php endwhile; // end of the loop. ?>
								</ul>
							</div>
						</div>
						<?php $p++;						
					endif;
					
					if ( $top_reviews_products->have_posts() ) :?>
						<div class="tab-pane fade<?php echo  $p == 0 ? ' in active': '' ?>" id="reviews-<?php echo esc_attr($id);?>">
							<?php $row=1;?>
							<div class="product-items">
								<ul class="products product-carousel owl-carousel <?php echo esc_attr($product_style);?>">
								<?php while ( $top_reviews_products->have_posts() ) : $top_reviews_products->the_post(); ?>
									<?php if($row==1){?>
										<li class="slide-row">
											<ul>
									<?php }?>
												<?php wc_get_template_part( 'content', 'product' ); ?>
									<?php if($row==$products_row || $top_reviews_products->current_post+1==$top_reviews_products->post_count){ $row=0;?>
											</ul>
										</li>
									<?php } $row++;?>
								<?php endwhile; // end of the loop. ?>
								</ul>
							</div>
						</div>
						<?php $p++;					
					endif;
					
					if ( $sale_products->have_posts() ) :?>
						<div class="tab-pane fade<?php echo  $p == 0 ? ' in active': '' ?>" id="sale-<?php echo esc_attr($id);?>">
							<?php $row=1;?>
							<div class="product-items">
								<ul class="products product-carousel owl-carousel <?php echo esc_attr($product_style);?>">
								<?php while ( $sale_products->have_posts() ) : $sale_products->the_post(); ?>
									<?php if($row==1){?>
										<li class="slide-row">
											<ul>
									<?php }?>
												<?php wc_get_template_part( 'content', 'product' ); ?>
									<?php if($row==$products_row || $sale_products->current_post+1==$sale_products->post_count){ $row=0;?>
											</ul>
										</li>
									<?php } $row++;?>
								<?php endwhile; // end of the loop. ?>
								</ul>
							</div>
						</div>
						<?php $p++;					
					endif;
					wp_reset_postdata();?>
					</div>
				</div>			
			<?php }?>
		</div>
		<?php
		$result = ob_get_clean();
        return $result;
    }

}