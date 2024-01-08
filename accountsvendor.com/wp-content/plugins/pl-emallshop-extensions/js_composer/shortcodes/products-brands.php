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
    "name"                  => esc_html__( "Products Brands", "pl-emallshop-extensions"),
    "base"                  => "products_brands",
	"description"           => esc_html__( "Display products brands with carousel slider.", "pl-emallshop-extensions"),
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
            "type"        	=> "emallshop_brands",
            "heading"     	=> esc_html__("Select Brands", "pl-emallshop-extensions"),
            "param_name"  	=> "brand",
            "admin_label" 	=> true,
			"description" 	=> esc_html__( "If you want to display brands of specific brand then select parent brand otherwise skip it.", "pl-emallshop-extensions" ),
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
			"description" 	=> esc_html__( "Select to sort brands", "pl-emallshop-extensions")
		),
		array(
			"type" 			=> "dropdown",
			"heading" 		=> esc_html__( "Order Direction", "pl-emallshop-extensions" ),
			"param_name" 	=> "order",
			"std"           => "DESC",
			"value" 		=> array(
				esc_html__( "Descending", "pl-emallshop-extensions" ) => "DESC",
				esc_html__( "Ascending", "pl-emallshop-extensions" )   => "ASC",
			),
			"description" 	=> esc_html__( "Select to sort brands", "pl-emallshop-extensions")
		),
		array(
			"type" 			=> "textfield",
			"heading" 		=> esc_html__( "Show No. Of Brands", "pl-emallshop-extensions" ),
			"param_name" 	=> "per_page",
			"value" 		=> "14",
			"description" 	=> esc_html__( "Show number of brands per page", "pl-emallshop-extensions" ),
		),
		array(
			"type" 			=> "dropdown",
			"heading" 		=> esc_html__( "Show No. Of Brands rows", "pl-emallshop-extensions" ),
			"param_name" 	=> "brands_row",
			"std"           => "1",
			"value" 		=> array(
				"1 Row" => "1",
				"2 Row" => "2",
				"3 Row" => "3",
			),
			"description" 	=> esc_html__( "Show number of Brands row", "pl-emallshop-extensions" ),
		),
		array(
			"type"        	=> "textfield",
			"heading"     	=> esc_html__( "Show No. Of Brands Columns", "pl-emallshop-extensions" ),
			"param_name"  	=> "brands_columns",
			"group"       	=> esc_html__( "Carousel options", "pl-emallshop-extensions" ),
			"value"       	=> 7,
			"description" 	=> esc_html__( "Show numbers of brands columns you want to display.", "pl-emallshop-extensions" ),
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

class WPBakeryShortCode_Products_Brands extends WPBakeryShortCode {	
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'products_brands', $atts ) : $atts;
        extract( shortcode_atts( array(
		
            "title"          => "Brands Title",
			"brand"          => -1,
			"orderby"		 => "ID",
			"order"          => "DESC",
			"per_page"       => 14,
			"brands_row"   	=> 1,
			"brands_columns"=> 5,
            "auto_play"      => "false",
            "loop"    		 => "false", 
            "navigation"     => "true",
            "dots"         	 => "false",          
            "css"            => "",       
            "el_class"       => "",        
           
        ), $atts ) );
        
		$shortcode_class = array(
        	'base' => apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'products_brands', $this->settings['base'], $atts ),
        	'extra' => $this->getExtraClass( $el_class ),
            'shortcode_custom' => vc_shortcode_custom_css_class( $css, ' ' )
        );        
        $shortcode_class = preg_replace( array( '/\s+/', '/^\s|\s$/' ), array( ' ', '' ), implode( ' ', $shortcode_class ) );
		
		//Get Brands		
		$args = array(
					'orderby' => $atts['orderby'],
					'order' => $atts['order'],
					'number' => $atts['per_page'],
					'hierarchical' => 1,
				    'show_option_none' => '',
				    'hide_empty' => 1,
				    'taxonomy' => 'product_brand'
				);
		
		$term = get_term_by( 'slug', $brand, 'product_brand' );
		if(!empty($term)):
			$args['parent']=$term->term_id;
		endif;
		
		$brands = get_categories($args);
		
        $id = uniqid();
		global $emallshop_owlparam;
		$emallshop_owlparam['productsBrands']['section-'.$id] = array(
			'item_columns'     => $brands_columns,
			'autoplay'    => $auto_play ? $auto_play : 'false',
			'loop'        => $loop ? $loop : 'false',
			'navigation'  => $navigation ? $navigation : 'true',
			'dots'  	  => $dots ? $dots : 'false',
		);
		
		ob_start();?>		
		<div id="section-<?php echo esc_attr($id);?>" class="product-section <?php echo esc_attr($shortcode_class);?>">
			<div class="section-header">
				<div class="section-title">
					<h3><?php echo esc_attr($title);?></h3>
				</div>
			</div>
			<div class="section-content woocommerce owl-nav-position">
				<?php if ( !empty($brands) ) :?>
					<?php $row=1;?>
					<div class="product-items">
						<ul class="brands brands-carousel owl-carousel">
						<?php foreach($brands as $brand): ?>
							<?php if($row==1){?>
								<li class="slide-row">
									<ul>
							<?php }
								$thumbnail_id = get_woocommerce_term_meta( $brand->term_id, 'thumbnail_id' ) ;
								$image_src = wp_get_attachment_image_src( $thumbnail_id, 'full' ) ;
								$brand_link = get_term_link( $brand, 'product_brand' ) ;?>
								<li class="brand-item">
									<a href="<?php echo esc_url($brand_link) ?>">									
									<?php if ( !empty($image_src) ) {?>
										<img class="lazyOwl" alt="<?php echo esc_attr($brand->cat_name)?>" src="<?php echo esc_url($image_src[0])?>"/>
									<?php }else{?>
										<img src="<?php echo esc_url(ES_EXTENSIONS_URL.'assets/img/brand-placeholder.jpg');?>"/>
									<?php }?>									
									</a>
								</li>
							<?php if($row==$brands_row){ $row=0;?>
								</ul>
									</li>
							<?php } $row++;?>
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