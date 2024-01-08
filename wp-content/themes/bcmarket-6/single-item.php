<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$item_id = get_the_ID();
get_header(); ?>

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
                    <meta itemprop="lowPrice" content="<?php  echo get_per_pcs_by_item($item_id); ?>">
                    <meta itemprop="highPrice" content="<?php  echo get_per_pcs_by_item($item_id); ?>">
                    <meta itemprop="offerCount" content="1">
                    <meta itemprop="priceCurrency" content="USD">
                </div>
                <div class="magazines-left">
                    <div class="mag-img">
                        <?php the_post_thumbnail('thumbnail'); ?>
                    </div>
                    <p><span class="bold">In stock </span><?php echo get_total_pcs_by_item($item_id); ?> pcs.</p> 
                    <span>
                        <span class="bold">Price for each </span><br> from $<span><?php  echo get_per_pcs_by_item($item_id); ?></span>
                        <p></p> 

                        <?php if(get_total_pcs_by_item($item_id) != 0) : ?>
                            <div class="soc-cell">
                                <a type="button" class="basket-button" data-id="<?php echo $item_id; ?>">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/ic-basket.png" alt=""><span>Buy</span>
                                </a>
                            </div>
                        <?php else : ?>
                             <div class="subscribe-cell" data-help="Subscribe to newsletter">
                                <a class="subscribe_button" style="margin-right:0;background-color:#fff;" type="button" data-id="<?php echo $item_id; ?>">
                                    <i class="fa-regular fa-envelope"></i>
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