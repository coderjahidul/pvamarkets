<?php
defined( 'ABSPATH' ) || exit;

get_header( );

 $term = get_queried_object();


  $parent =$term->parent;



 
  


?>
<section class="soc-category" id="content">
    <div class="wrap-breadcrumbs">
        <div class="container">
            <div class="flex">
                <div class="block" itemscope="" itemtype="http://schema.org/BreadcrumbList" id="breadcrumbs">
                    <div itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                        <a href="<?php echo esc_url(home_url( '/' )); ?>" itemprop="item">
                            <span itemprop="name">Home</span>
                            <meta itemprop="position" content="0">
                        </a>
                        <span class="divider">/</span>
                    </div>
                    <?php if( $parent ): ?>
	                    <div itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
	                        <a href="<?php echo get_term_link($parent); ?>" itemprop="item">
	                            <span itemprop="name"><?php echo $term->name; ?></span>
	                            <meta itemprop="position" content="1">
	                        </a>
	                        <span class="divider">/</span>
	                    </div>
	                <?php endif; ?>
                    <div itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                        <span class="current" itemprop="name"><?php woocommerce_page_title(); ?></span>
                        <meta itemprop="position" content="2">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="flex">
        	<?php if( $parent ): ?>
        		<h1><?php echo $term->name; ?> accounts for sale - <?php woocommerce_page_title(); ?></h1>
        	<?php else : ?>
            	<h1><?php woocommerce_page_title(); ?></h1>
            <?php endif; ?>
            <div class="soc-bl">

<?php 


    if($parent == 0){

   

       
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

                                                $new_query = new WP_Query(array(
                                                    'post_type' => 'item', 
                                                    'posts_per_page' => -1, 
                                                    'orderby' => 'meta_value_num',
                                                    'meta_key' => 'item_price',
                                                    'order' => 'ASC',
                                                    'tax_query' => array(
                                                        array(
                                                            'taxonomy' => 'item_cat',
                                                            'field'    => 'term_id',
                                                            'terms'    => $child->term_id,
                                                        ),
                                                    ),
                                                ));
                                        while($new_query->have_posts()) : $new_query->the_post();
                                            get_template_part('template-parts/content', 'item');
                                        endwhile;
                                        
                                    ?>
                            </div>
                            </div>
                        
                              
                       
                     

                    <?php 

                endforeach; 

  

         

            endif; 
        }else{  ?>

                        <div class="soc-title" data-help="<?php echo $term->name; ?>">
                            <h2 class="soc-name" data-id="10"><a href="<?php echo get_term_link($term); ?>"><?php echo $term->name; ?> <?php echo $term->name; ?></a></h2>
                            <p class="soc-qty">In stock</p>
                            <p class="soc-cost-label"></p>
                            <p class="soc-cost">Price</p>
                            <p class="soc-control"></p>
                        </div>

                        <div class="socs ">
                            <div class="first_div">
                            <?php 

                                                $new_query = new WP_Query(array(
                                                    'post_type' => 'item', 
                                                    'posts_per_page' => -1, 
                                                    'orderby' => 'meta_value_num',
                                                    'meta_key' => 'item_price',
                                                    'order' => 'ASC',
                                                    'tax_query' => array(
                                                        array(
                                                            'taxonomy' => 'item_cat',
                                                            'field'    => 'term_id',
                                                            'terms'    => $term->term_id,
                                                        ),
                                                    ),
                                                ));
                                        while($new_query->have_posts()) : $new_query->the_post();
                                            get_template_part('template-parts/content', 'item');
                                        endwhile;
                                        
                                    ?>
                            </div>
                            </div>



  <?php      }
         
   
?>


            <div class="recat">
                <?php echo get_term_meta(get_queried_object_id(), 'long_description', true); ?>
                <?php echo $term->description; ?>
            </div>
        </div>
    </div>
</section>


<?php get_footer( 'shop' );
