<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Use for display image swatch.
 *
 * @version  2.0.0
 * @package  clever-swatches/templates
 * @category Templates
 * @author   cleversoft.co <hello.cleversoft@gmail.com>
 * @since    1.0.0
 */

$general_settings = get_option('zoo-cw-settings', true);
$is_gallery_enabled = isset($general_settings['product_gallery']) ? intval($general_settings['product_gallery']) : 1;

if (isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);
} else $product_id = get_the_ID();

if (isset ($variation_id)) {
    if ($is_gallery_enabled) {
        $gallery_images_id = get_post_meta($variation_id, 'zoo-cw-variation-gallery', true);
        $attachment_ids = array_filter(explode(',', $gallery_images_id));
    } else {
        $attachment_ids = [];
    }
} else {
    global $post, $product;

    $default_active = [];
    $default_attributes = $product->get_default_attributes();
    $variation_id = 0;
    if (count($default_attributes) && $is_gallery_enabled) {
        foreach ($default_attributes as $key => $value) {
            $default_active['attribute_' . $key] = $value;
        }
        $data_store = WC_Data_Store::load('product');
        $variation_id = $data_store->find_matching_product_variation($product, $default_active);
    }

    if ($variation_id == 0) {
        $attachment_ids = $product->get_gallery_image_ids();
        $variation_id = $product_id;
    } else {
        $gallery_images_id = get_post_meta($variation_id, 'zoo-cw-variation-gallery', true);
        $attachment_ids = array_filter(explode(',', $gallery_images_id));
    }
}

$product_swatch_data_array = get_post_meta($product_id, 'zoo_cw_product_swatch_data', true);
if ($product_swatch_data_array == '') {
    $is_gallery_enabled=0;
}

if ($product->is_type('variable') && $is_gallery_enabled!=0):
	
	if (empty($attachment_ids)) { //EmallShop 2.0.3
		$attachment_ids = $product->get_gallery_image_ids();
	}
	
	$page_layout = get_post_meta ( $product_id, '_emallshop_product_layout', true );
    if(isset($page_layout) && $page_layout!=""):
        $page_layout=$page_layout;
    else:
        $page_layout=emallshop_get_option('single-product-page-layout','none-left');
	endif;
	
	if(is_rtl())
		$slider_attr = 'data-slick=\'{"slidesToShow": 1, "slidesToScroll": 1, "asNavFor": ".product-thumbnails", "fade":true, "rtl":true}\'';
	else
		$slider_attr = 'data-slick=\'{"slidesToShow": 1, "slidesToScroll": 1, "asNavFor": ".product-thumbnails", "fade":true}\'';	
	//End Emallshop
	
    $thumbnail_size = apply_filters('woocommerce_product_thumbnails_large_size', 'full');
    $post_thumbnail_id = get_post_thumbnail_id($variation_id);
    $full_size_image = wp_get_attachment_image_src($post_thumbnail_id, $thumbnail_size);
    $placeholder = has_post_thumbnail() ? 'with-images' : 'without-images';
    $wrapper_classes = apply_filters('woocommerce_single_product_image_gallery_classes', array(
        'woocommerce-product-gallery',
        'woocommerce-product-gallery--' . $placeholder,
        'images',
		$page_layout, //Emallshop
    ));
    ?>
	
    <div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>">
		<figure class="woocommerce-product-gallery__wrapper">
			<div id="product-image" class="emallshop-slick-carousel" <?php echo wp_kses_post( $slider_attr ); ?>>
				<?php
				$attributes = array(
					'title' => get_post_field('post_title', $post_thumbnail_id),
					'data-caption' => get_post_field('post_excerpt', $post_thumbnail_id),
					'data-src' => $full_size_image[0],
					'data-large_image' => $full_size_image[0],
					'data-large_image_width' => $full_size_image[1],
					'data-large_image_height' => $full_size_image[2],
				);

				$html_thumb='';
				if (has_post_thumbnail($variation_id)) {
					$html = '<div data-thumb="' . get_the_post_thumbnail_url($variation_id, 'shop_thumbnail') . '" class="woocommerce-product-gallery__image es-image-zoom">';
					$html .= '<a class="zoom" href="' . esc_url($full_size_image[0]) . '">';
					$html .= get_the_post_thumbnail($variation_id, 'shop_single', $attributes);
					$html .= '</a>';
					$html .= '</div>';
					$html_thumb  = '<div data-thumb="' .get_the_post_thumbnail_url( $variation_id, 'shop_thumbnail' ). '">' . get_the_post_thumbnail($variation_id, 'shop_thumbnail', $attributes) . '</div>';
				} else {
					$html = '<div class="woocommerce-product-gallery__image--placeholder">';
					$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'emallshop' ) );
					$html .= '</div>';
					$html_thumb  = '<div  class="woocommerce-product-gallery__image--placeholder">' . sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'emallshop' ) ). '</div>';
				}

				//thumb image
				foreach ($attachment_ids as $attachment_id) {
					$full_size_image = wp_get_attachment_image_src($attachment_id, 'full');
					$thumbnail = wp_get_attachment_image_src($attachment_id, 'shop_thumbnail');
					$image_title = get_post_field('post_excerpt', $attachment_id);

					$attributes = array(
						'title' => $image_title,
						'data-src' => $full_size_image[0],
						'data-large_image' => $full_size_image[0],
						'data-large_image_width' => $full_size_image[1],
						'data-large_image_height' => $full_size_image[2],
					);

					$html .= '<div data-thumb="' . esc_url($thumbnail[0]) . '" class="woocommerce-product-gallery__image">';
					$html .= '<a href="' . esc_url($full_size_image[0]) . '">';
					$html .= wp_get_attachment_image($attachment_id, 'shop_single', false, $attributes);
					$html .= '</a>';
					$html .= '</div>';
					$html_thumb  .= '<div data-thumb="' . esc_url($thumbnail[0] ) . '">' . wp_get_attachment_image( $attachment_id, 'shop_thumbnail', false, $attributes ) . '</div>';

				}
				echo $html;
				//End EmallShop ?>
			</div>
			
			 <?php //thumb image		
			if ( $attachment_ids) {?>
				<div class="product-thumbnails emallshop-slick-carousel" data-slick='{"slidesToShow": <?php echo ( $page_layout == 'none-left' || $page_layout == 'none-right') ? "5": "4"; ?>,"slidesToScroll": 1,"asNavFor": "#product-image","arrows": true, "focusOnSelect": true, <?php if ( $page_layout == 'none-left' || $page_layout == 'none-right' ) echo '"vertical": true,'; ?> <?php if ( ( $page_layout != 'none-left' && $page_layout != 'none-right' ) && is_rtl()) echo '"rtl": true,'; ?> "responsive":[{"breakpoint": 639,"settings":{"slidesToShow": 4, "vertical":false <?php if ( is_rtl()) echo ',"rtl": true'; ?>}}]}'>
					<?php echo $html_thumb;?>
				</div>
			<?php }?>			
        </figure>
		<div class="pl-loading"></div>
    </div>
    <?php
else:
    wc_get_template_part('single-product/product', 'image');
endif;
?>