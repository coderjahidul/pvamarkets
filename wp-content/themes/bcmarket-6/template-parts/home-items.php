 <div class="soc-bl">

    <?php 
    
  

        $terms = get_terms( array(
            'taxonomy' => 'item_cat',
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => 'item_order',
                    'compare' => 'NOT EXISTS'
                ),
                array(
                    'key' => 'item_order',
                    'value' => 0,
                    'compare' => '>='
                )
            ),
            'hide_empty' => true,
            'parent' => 0
        ) );

        if($terms) : 

            foreach($terms as $term) : 
                $termchildren = get_term_children( $term->term_id, 'item_cat');

                $terms = get_terms( array(
                    'taxonomy' => 'item_cat',
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC',
                    'meta_query' => array(
                        'relation' => 'OR',
                        array(
                            'key' => 'item_order',
                            'compare' => 'NOT EXISTS'
                        ),
                        array(
                            'key' => 'item_order',
                            'value' => 0,
                            'compare' => '>='
                        )
                    ),
                    'hide_empty' => true,
                    'parent' => $term->term_id
                ) );


                if($terms) : 

                    foreach ( $terms as $child ) :

                        $pr_query = new WP_Query(array(
                            'post_type' => 'item', 
                            'posts_per_page' => 5, 
                            
                            
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'item_cat',
                                    'terms'    => $child->term_id,
                                ),
                            ),
                        ));

                        $new_query = new WP_Query(array(
                            'post_type' => 'item', 
                            'posts_per_page' => -1, 
                            
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'item_cat',
                                    'terms'    => $child->term_id,
                                ),
                            ),
                        ));
                        // echo "<pre>";
                        // print_r($new_query);
                        // echo "</pre>";
                        if($pr_query->have_posts() || $new_query->have_posts()) : 
                        ?>
                            <div class="soc-title" data-help="<?php echo $child->description; ?>">
                                <h2 class="soc-name" data-id="10"><a href="<?php echo get_term_link($child); ?>"><?php echo $term->name; ?> <?php echo $child->name; ?></a></h2>
                                <p class="soc-qty">In stock</p>
                                <p class="soc-cost-label"></p>
                                <p class="soc-cost">Price</p>
                                <p class="soc-control"></p>
                            </div>

                            <div class="socs ">
                                <div class="first_div">
                                <?php 
                                   while($pr_query->have_posts()) : $pr_query->the_post();
                                       get_template_part('template-parts/content', 'item');
                                   endwhile; wp_reset_postdata();
                                ?>
                                </div>
                            
                                    <div class=" new_div_toggle" style="display:none;">
                                        <?php 
                                            while($new_query->have_posts()) : $new_query->the_post();
                                                get_template_part('template-parts/content', 'item');
                                            endwhile; wp_reset_postdata();
                                            
                                        ?>
                                        
                                    </div> 
                            <div class="collapse"></div>
                                <button type="button" data-cat="<?php echo $child->term_id; ?>" class="expand_subcat_button">View all</button>
                            </div> 
                         

                        <?php 

                        endif; 
                    endforeach; 

                else : 

                    $parent_pro_query = new WP_Query(array(
                        'post_type' => 'product', 
                        'posts_per_page' => 5, 
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'item_cat',
                                'terms'    => $term->term_id,
                            ),
                        ),
                    ));
                   
                    if($parent_pro_query->have_posts()) : 
                        ?>
                            <div class="soc-title" data-help="<?php echo $term->description; ?>">
                                <h2 class="soc-name" data-id="10"><a href="<?php echo get_term_link($term); ?>"><?php echo $term->name; ?> <?php echo $term->name; ?></a></h2>
                                <p class="soc-qty">In stock</p>
                                <p class="soc-cost-label"></p>
                                <p class="soc-cost">Price</p>
                                <p class="soc-control"></p>
                            </div>

                            <div class="socs">
                                <?php while($parent_pro_query->have_posts()) : $parent_pro_query->the_post();
                                    get_template_part('content', 'item');
                                    ?>
                                   
                                <?php endwhile; wp_reset_postdata(); ?>
                                
                                <div class="collapse"></div>
                                <button type="button" data-cat="<?php echo $term->term_id; ?>" class="expand_subcat_button">View all</button>
                            </div>

                        <?php 

                        endif;

                endif; 
            endforeach; 
        endif; 
    ?>
</div>


<script>
jQuery(document).ready(function($) {
    $(document).on('click', '.expand_subcat_button', function() {
        // Find the parent .socs container
        var socsContainer = $(this).closest('.socs');

        // Toggle visibility of items within the specific category
        socsContainer.find('.first_div, .new_div_toggle').toggle();

        // Toggle the button text
        if ($(this).hasClass('hide_subcat')) {
            $(this).removeClass('hide_subcat').html('View All');
        } else {
            $(this).addClass('hide_subcat').html('Hide accounts');
        }
    });
});
</script>