<?php 
if(is_user_logged_in() && !current_user_has_approve_bid()){
    wp_safe_redirect( home_url('/partner/offers') );
}else if(!is_user_logged_in()){
    wp_safe_redirect( home_url('/my/') );
}
/*
Template Name: Payment
*/
get_header(); ?>
<section class="soc-category" id="content">
    <div class="wrap-breadcrumbs">
        <div class="container">
            <div class="flex">
                <div class="block" itemscope="" itemtype="http://schema.org/BreadcrumbList" id="breadcrumbs">
                    <div itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                        <a href="/" itemprop="item">
                            <span itemprop="name">Home</span>
                            <meta itemprop="position" content="0" />
                        </a>
                        <span class="divider">/</span>
                    </div>
                    <div itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                        <span class="current" itemprop="name">Partner interface</span>
                        <meta itemprop="position" content="1" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="flex">
            <h1>Partner interface</h1>
            
            <?php get_template_part( 'partner/menu'); ?>
            <div class="body">
                <h2>Summary</h2>
                <table class="list zebra ac">
                    <tbody>
                        <tr>
                            <th>Date</th>
                            <th>Comment</th>
                            <th>Sum</th>
                            <th>Status</th>
                            <th>Comment to the payment</th>
                           
                        </tr>

                        <?php
                            $current_url = esc_url_raw($_SERVER['REQUEST_URI']);
                            $page_number = intval(preg_replace('/[^0-9]+/', '', $current_url), 10);

                            $paged = $page_number == 0 ? 1 : $page_number;
                            
                            $payment_query = new WP_Query(array(
                                'post_type' => 'payment', 
                                'posts_per_page' => 10, 
                                'paged' => $paged, 
                                // 'author' => get_current_user_id()
                            ));
                            
                            if ($payment_query->have_posts()) {
                                while ($payment_query->have_posts()) : $payment_query->the_post(); ?>
                                <tr>
                                    <td><?php echo get_the_date(); ?></td>
                                    <td>
                                        <?php 
                                            global $wpdb;
                                            $order_ids = get_post_meta(get_the_ID(), 'order_ids', true); 
                                        
                                            $order_ids = explode(',', $order_ids);
                                            $user_id = get_current_user_id();

                                            // if($order_ids){
                                            //     $count_total = count($order_ids);
                                            //     $num = 1; 
                                            //     foreach($order_ids as $order_id){
                                            //         $quantity = '';
                                            //         $order = wc_get_order( $order_id );
                                            //         foreach ( $order->get_items() as $item_id => $item ) {

                                            //             $product_id = $item->get_product_id();

                                            //             $post_author_id = get_post_field( 'post_author', $product_id );

                                            //             if($post_author_id == $user_id){
                                            //                 $quantity = $item->get_quantity();
                                            //             }
                                            //         }
                                                

                                            //         echo 'Payment application #'. get_post_meta($product_id, 'custom_product_id', true) .'('. $quantity .')';
                                                    
                                            //         if($count_total != $num){
                                            //             echo '<br/>';
                                            //         }
                                            //     }
                                            // }
                                        ?>
                                    </td>
                                    <td><?php echo wc_price(get_payment_request_total(get_post_meta(get_the_ID(), 'order_ids', true), get_current_user_id()) - deduct_payment_by_payment_id(get_the_ID())); ?></td>
                                    <td>
                                        <?php 
                                            if(get_post_meta(get_the_ID(), 'payment_status', true) == 'payment_requested'){
                                                echo 'Payment Requested';
                                            }
                                            if(get_post_meta(get_the_ID(), 'payment_status', true) == 'paid'){
                                                echo 'Paid';
                                            }
                                        ?>
                                    </td>
                                    <td class="pay_comment">
                                        <?php echo get_post_meta(get_the_ID(), 'payment_comment', true); ?>
                                    </td>
                                </tr>
                            <?php
                                endwhile;
                                
                                wp_reset_postdata(); 
                            }
                            else{
                                echo '<tr><td colspan="5">No Payment found.</td></tr>';
                            }
                            
                            ?>
                    </tbody>
                </table>
                <div class="pager_wrap" style="display: flex; justify-content: center;">
                    <?php echo paginate_links(array(
                        'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                        'format' => '?paged=%#%',
                        'current' => max(1, $paged),
                        'total' => $payment_query->max_num_pages,
                        'prev_text' => __('&laquo; Prev'),
                        'next_text' => __('Next &raquo;'),
                    )); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer() ?>