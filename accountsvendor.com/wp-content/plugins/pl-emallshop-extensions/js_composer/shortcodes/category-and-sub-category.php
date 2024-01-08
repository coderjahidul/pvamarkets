<?php
/**
 * @author  PressLayouts
 * @package EmallShop
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

vc_map( array(
    "name"                  => __( "Categories & Sub Categories", "pl-emallshop-extensions"),
    "base"                  => "category_and_sub_category",
	"description"           => esc_html__( "Display product categories and sub categories.", "pl-emallshop-extensions"),
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
			"heading" 		=> esc_html__( "Category Style", "pl-emallshop-extensions" ),
			"param_name" 	=> "category_style",
			"std"           => "only_category",
			"value" 		=> array(
				esc_html__( "Only Category", "pl-emallshop-extensions" )   => "only_category",
				esc_html__( "Category and Sub Category Box", "pl-emallshop-extensions" )   => "category_and_sub_category_box",
			),
			"description" 	=> esc_html__( "Display Category view style.", "pl-emallshop-extensions"),
			"admin_label"   => true,
		),
		array(
            "type"        	=> "emallshop_product_cates_with_none",
            "heading"     	=> esc_html__("Select Category", "pl-emallshop-extensions"),
            "param_name"  	=> "category",
            "admin_label" 	=> true,
			"description" 	=> esc_html__( "If you want to display categories of specific category then select category otherwise skip it.", "pl-emallshop-extensions" ),
        ),
		array(
			"type" 			=> "dropdown",
			"heading" 		=> esc_html__( "Order By", "pl-emallshop-extensions" ),
			"param_name" 	=> "orderby",
			"std"           => "name",
			"value" 		=> array(
				esc_html__( "ID", "pl-emallshop-extensions" )   => "id",
				esc_html__( "Name", "pl-emallshop-extensions" )   => "name",
				esc_html__( "Slug", "pl-emallshop-extensions" )   => "slug",
			),
			"description" 	=> esc_html__( "Select to sort categories", "pl-emallshop-extensions")
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
			"description" 	=> esc_html__( "Select to sort categories", "pl-emallshop-extensions")
		),
		array(
			"type" 			=> "textfield",
			"heading" 		=> esc_html__( "Show No. Of Categories", "pl-emallshop-extensions" ),
			"param_name" 	=> "per_page",
			"value" 		=> 8,
			"description" 	=> esc_html__( "Show number of display categories", "pl-emallshop-extensions" ),
		),
		array(
			"type" 			=> "dropdown",
			"heading" 		=> esc_html__( "Show No. Of Categories row", "pl-emallshop-extensions" ),
			"param_name" 	=> "categories_row",
			"std"           => 1,
			"value" 		=> array(
								"1 Row" => "1",
								"2 Row" => "2",
								"3 Row" => "3",
			),
			"description" 	=> esc_html__( "Show number of categories row", "pl-emallshop-extensions" ),
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
			"std"           => 4,
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

class WPBakeryShortCode_Category_And_Sub_Category extends WPBakeryShortCode {	
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'category_and_sub_category', $atts ) : $atts;
        extract( shortcode_atts( array(
		
            "title"          => "Categories Title",
			"category_style" => "only_category",
			"category"       => -1,
			"orderby"		 => "date",
			"order"          => "desc",
			"per_page"       => 8,
			"categories_row"   => 1,
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
        	'base' => apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'category_and_sub_category '.$category_style, $this->settings['base'], $atts ),
        	'extra' => $this->getExtraClass( $el_class ),
            'shortcode_custom' => vc_shortcode_custom_css_class( $css, ' ' )
        );        
        $shortcode_class = preg_replace( array( '/\s+/', '/^\s|\s$/' ), array( ' ', '' ), implode( ' ', $shortcode_class ) );
		
		//Get Categories		
		$args = array(
					'orderby' => $atts['orderby'],
					'order' => $atts['order'],
					'number' => $atts['per_page'],
					'hierarchical' => 1,
				    'show_option_none' => '',
				    'hide_empty' => 1,
				    'taxonomy' => 'product_cat'
				);
		
		$term = get_term_by( 'slug', $category, 'product_cat' );
		if(!empty($term)):
			$args['parent']=$term->term_id;
		endif;
		
		$subcats = get_categories($args);
		
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
		
		ob_start();	?>		
		<div id="section-<?php echo esc_attr($id);?>" class="product-section <?php echo esc_attr($shortcode_class);?>">
			<div class="section-header">
				<div class="section-title">
					<h3><?php echo esc_attr($title);?></h3>
				</div>
			</div>
			<div class="section-content woocommerce">
				<?php if ( !empty($subcats) ) : $lastElement = end($subcats);?>
					<?php $row=1;?>
					<div class="product-items">
						<ul class="products product-carousel owl-carousel">
						<?php foreach($subcats as $cate): 
							
							$cate_link = get_term_link( $cate );
							
							//Get Sub Categories								
							$args['parent']= $cate->term_id;
							$args['number']= 4;
							$inner_subcats = get_categories($args);
							if($category_style=="category_and_sub_category_box" && !empty($inner_subcats)){
								if($row==1){?>
									<li class="slide-row">
										<ul>
								<?php }?>							
								
								<li class="category-entry">	
									<h6 class="category-title">
										<a href="<?php echo esc_url($cate_link);?>"><?php echo esc_html($cate->name);?></a>
									</h6>
									<div class="category-image">
										<a href="<?php echo esc_url($cate_link);?>">
											<?php $thumbnail_id = get_woocommerce_term_meta( $cate->term_id, 'thumbnail_id', true );
											$catalog_img = wp_get_attachment_image_src( $thumbnail_id, 'shop_catalog' );
											if ( !empty($catalog_img) ) {?>											
												<img src="<?php echo esc_url($catalog_img[0]);?>" alt="<?php echo esc_html($cate->name);?>" />
											<?php }else{?>
												<img src="<?php echo esc_url(ES_EXTENSIONS_URL.'assets/img/product-listing-placeholder.jpg');?>"/>
											<?php }?>
										</a>
									</div>
									<div class="sub-categories-list">
										<?php if(!empty($inner_subcats)){?>
											<ul class="sub-categories">
												<?php foreach($inner_subcats as $iner_cate){ 
													$inner_subcat_link = get_term_link( $iner_cate ); ?>
													<li>
														<a href="<?php echo esc_url($inner_subcat_link);?>"><?php echo esc_html($iner_cate->name);?></a>
													</li>
												<?php }?>
												<li class="show-all-cate">
													<a href="<?php echo esc_url($cate_link);?>"><?php echo esc_html__('Show All', 'pl-emallshop-extensions');?></a>
												</li>
										</ul>
										<?php }?>
									</div>
								</li>
								<?php if($row==$categories_row || $cate==$lastElement){ $row=0;?>
										</ul>
									</li>
								<?php } $row++;
							}elseif($category_style=="only_category"){
								if($row==1){?>
									<li class="slide-row">
										<ul>
								<?php }?>
									<li class="category-entry">
										<a href="<?php echo esc_url($cate_link);?>">
											<div class="category-image">
												<?php $thumbnail_id = get_woocommerce_term_meta( $cate->term_id, 'thumbnail_id', true );
												$catalog_img = wp_get_attachment_image_src( $thumbnail_id, 'shop_catalog' );
												if ( !empty($catalog_img) ) {?>											
													<img src="<?php echo esc_url($catalog_img[0]);?>" alt="<?php echo esc_html($cate->name);?>" />
												<?php }else{?>
													<img src="<?php echo esc_url(ES_EXTENSIONS_URL.'assets/img/product-listing-placeholder.jpg');?>"/>
												<?php }?>											
											</div>
											<div class="category-content">
												<h3><?php echo esc_html($cate->name);?></h3>
												<?php echo apply_filters( 'woocommerce_subcategory_count_html', sprintf( '<span class="category-items" />%s %s</span>', $cate->count, __( 'Items', 'pl-emallshop-extensions' ) ), $cate );?>											
											</div>
										</a>
									</li>
								<?php if($row==$categories_row || $cate==$lastElement){ $row=0;?>
										</ul>
									</li>
								<?php } $row++;
							}?>
						<?php endforeach; // end of the loop. ?>
						</ul>
					</div>
				<?php endif;
				wp_reset_query();?>
			</div>
		</div>
		<?php
		$result = ob_get_clean();
        return $result;		
    }

}