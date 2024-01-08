<?php  $product = wc_get_product( get_the_ID() ); ?>
<div class="soc-body">
    <div class="soc-img">
        <a href="<?php the_permalink(); ?>" data-help="Click to read detailed description">
            <?php if($product->get_image_id()) : ?>
                <?php echo $product->get_image(); ?>
            <?php else : ?>
                <?php 
                    $cat_ids = $product->get_category_ids();

                    if($cat_ids){
                        foreach($cat_ids as $cat_id){
                            $term = get_term_by('term_id', $cat_id, 'product_cat');
                            if($term->parent == 0){
                                $thumbnail_id = get_term_meta( $cat_id, 'thumbnail_id', true );
                                echo wp_get_attachment_image( $thumbnail_id, 'thumbnail' );
                            }
                        }
                    }
            endif; ?>
        </a>
    </div>
    <div class="soc-text">
        <p>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </p>
        <a href="<?php the_permalink(); ?>" class="learn-more">More...</a>
    </div>
    <div class="soc-price">
        <p><?php echo total_free_accounts_by_id(get_the_ID()); ?> pcs.
            <br>
            <span>Price per pc<br></span>
            <div class="">from <?php echo wc_price($product->get_price()); ?></div>
        </p>
    </div>
    <div class="soc-qty"><?php echo total_free_accounts_by_id(get_the_ID()); ?> pcs.</div>
    <div class="soc-cost-label">Price per pc</div>
    <div class="soc-cost">from <?php echo wc_price($product->get_price()); ?></div>

   
    <?php if(total_free_accounts_by_id(get_the_ID()) != 0) : ?>
        <div class="soc-cell">
            <button type="button" class="basket-button" data-id="<?php echo get_the_ID(); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/img/ic-basket.png" alt=""><span>Buy</span>
            </button>
        </div>
    <?php else : ?>
         <div class="subscribe-cell" data-help="Subscribe to newsletter">
            <button class="subscribe_button" type="button" data-id="<?php echo get_the_ID(); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/img/ic-subscribe.png" height="18" width="21" alt="">
            </button>
        </div>
    <?php endif; ?>
</div>