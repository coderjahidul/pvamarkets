<?php $item_id = get_the_ID(); ?>

<div class="soc-body">
    <div class="soc-img">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('thumbnail'); ?>
        </a>
    </div>
    <div class="soc-text">
        <p>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </p>
        <a href="<?php the_permalink(); ?>" class="learn-more">More...</a>
    </div>
    <div class="soc-price">
        <p><?php echo get_total_pcs_by_item($item_id); ?> pcs.
            <br>
            <span>Price per pc<br></span>
            <div class="">from $<?php 
        //  $soldoutPrice =  get_field('item_price');
           $price = get_post_meta($item_id, 'item_price', true);
        
        if($price == " "){
        echo get_per_pcs_by_item($item_id);
        }else{
            echo $price;
        }
        ?></div>
        </p>
    </div>
    <div class="soc-qty">
    <?php 
        echo get_total_pcs_by_item($item_id);
    ?> pcs.</div>
    <div class="soc-cost-label">Price per pc</div>
    <div class="soc-cost">from $
      <?php 
        //  $soldoutPrice =  get_field('item_price');
           $price = get_post_meta($item_id, 'item_price', true);
        
        if($price == " "){
        echo get_per_pcs_by_item($item_id);
        }else{
            echo $price;
        }
        ?>
    </div>

   
    <?php if(get_total_pcs_by_item($item_id) != 0) : ?>
        <div class="soc-cell">
            <button type="button" class="basket-button" data-id="<?php echo $item_id; ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/img/ic-basket.png" alt=""><span>Buy</span>
            </button>
        </div>
    <?php else : ?>
         <div class="subscribe-cell" data-help="Subscribe to newsletter">
            <button class="subscribe_button" type="button" data-id="<?php echo $item_id; ?>">
                <i class="fa-regular fa-envelope"></i>
            </button>
        </div>
    <?php  endif; ?>

</div>
