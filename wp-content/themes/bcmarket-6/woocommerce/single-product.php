<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$product = wc_get_product( get_the_ID() );
get_header( 'shop' ); ?>

<section class="soc-category" id="content">

    <div class="wrap-breadcrumbs">
        <div class="container">
            <div class="flex">
                <?php woocommerce_breadcrumb(); ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="flex">
            <div itemscope="" itemtype="http://schema.org/Product">
                <div class="recat">
                    <h1 itemprop="name"><?php the_title(); ?></h1>
                </div>
                <div itemprop="offers" itemtype="https://schema.org/AggregateOffer" itemscope="">
                    <meta itemprop="lowPrice" content="<?php echo $product->get_price(); ?>">
                    <meta itemprop="highPrice" content="<?php echo $product->get_price(); ?>">
                    <meta itemprop="offerCount" content="1">
                    <meta itemprop="priceCurrency" content="USD">
                </div>
                <div class="magazines-left">
                    <div class="mag-img">
                        <img src="<?php echo get_template_directory_uri(); ?>/content/images/89.png" alt="" itemprop="image"> </div>
                    <p><span class="bold">In stock </span><?php echo total_free_accounts_by_id(get_the_ID()); ?> pcs.</p> 
                    <span>
                        <span class="bold">Price for each </span><br> from <span><?php echo wc_price($product->get_price()); ?></span>
                        <p></p> 

                        <?php if(total_free_accounts_by_id(get_the_ID()) != 0) : ?>
                            <div class="soc-cell">
                                <a type="button" class="basket-button" data-id="<?php echo get_the_ID(); ?>">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/ic-basket.png" alt=""><span>Buy</span>
                                </a>
                            </div>
                        <?php else : ?>
                             <div class="subscribe-cell" data-help="Subscribe to newsletter">
                                <a class="subscribe_button" style="margin-right:0;background-color:#fff;" type="button" data-id="<?php echo get_the_ID(); ?>">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/ic-subscribe.png" height="18" width="21" alt="">
                                </a>
                            </div>
                        <?php endif; ?>
                         
                    </span>
                </div>
                <div class="magazines-right recat" itemprop="description">
                    <?php the_content(); ?>
                </div>
                <div style="clear: both;"></div>
            </div>
        </div>
    </div>
</section>
<?php
get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */