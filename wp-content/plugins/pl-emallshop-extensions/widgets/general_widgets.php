<?php
/**
 * @author  PressLayouts
 * @package PL EmallShop Extensions
 * @version 1.1.4
 */

// **********************************************************************// 
// ! Brands Filter Widget
// **********************************************************************// 
class EmallShop_Brand_Filter_Widget extends WP_Widget {
	
	public function __construct() {
		
         $widget_ops = array('classname' => 'emallshop_widget_brands', 'description' => esc_html__( "Products Filter by brands", 'pl-emallshop-extensions') );

		$control_ops = array('id_base' => 'emallshop-brands');
		
        parent::__construct('emallshop-brands', 'EmallShop '.esc_html__('Filter by brands', 'pl-emallshop-extensions'), $widget_ops, $control_ops);
	}

    function widget($args, $instance) {
        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? false : $instance['title']);
        echo $before_widget;
		if ( $title ) echo $before_title . $title . $after_title;
		
        $current_term = get_queried_object();
		$args = array( 'hide_empty' => true);
		$terms = get_terms('product_brand', $args);
		$count = count($terms); $i=0;
		if ($count > 0) { ?>
			<ul>
				<?php
				foreach ($terms as $term) {
					$i++;
					$curr = false;
					$thumbnail_id 	= absint( get_term_meta( $term->term_id, 'thumbnail_id', true ) );
					if(isset($current_term->term_id) && $current_term->term_id == $term->term_id) {
						$curr = true;
					}?>
					<li>
						<a href="<?php echo get_term_link( $term ); ?>" title="<?php echo sprintf(esc_html__('View all products from %s', 'pl-emallshop-extensions'), $term->name); ?>"><?php if($curr) echo '<strong>'; ?><?php echo $term->name; ?><?php if($curr) echo '</strong>'; ?></a>
					</li>
					<?php
				}
				?>
			</ul>
			<?php
        }
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];

        return $instance;
    }

    function form( $instance ) {
        $title = isset($instance['title']) ? $instance['title'] : 'Filter by brands';
		
		emallshop_widget_input_text(esc_html__('Title', 'pl-emallshop-extensions'), $this->get_field_id('title'),$this->get_field_name('title'), $title); ?>

	<?php
    }
}

// **********************************************************************// 
// ! Brands Slider Widget
// **********************************************************************// 
class EmallShop_Brand_Slider_Widget extends WP_Widget {
	
	public function __construct() {
		
        $widget_ops = array('classname' => 'emallshop_widget_brands_slider', 'description' => esc_html__( "Display product brands with slider.", 'pl-emallshop-extensions') );
		$control_ops = array('id_base' => 'emallshop-brands-slide');		
        parent::__construct('emallshop-brands-slide', 'EmallShop '.esc_html__('Product Brands', 'pl-emallshop-extensions'), $widget_ops, $control_ops);
	}

    function widget($args, $instance) {
        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? false : $instance['title']);
		$orderby = (!empty($instance['orderby'])) ?  $instance['orderby'] : 'date';
		$order = (!empty($instance['order'])) ?  $instance['order'] : 'desc';
		$number = (!empty($instance['number'])) ? (int) $instance['number'] : 12;
		$number_slide = (!empty($instance['number_slide'])) ? (int) $instance['number_slide'] : 4;		

        //Get Products
        global $woocommerce_loop;		
		
		$args = array(
					'orderby' => $orderby,
					'order' => $order,
					'number' => $number,
					'hierarchical' => 1,
				    'show_option_none' => '',
				    'hide_empty' => 1,
				    'taxonomy' => 'product_brand'
				);
		$brands = get_categories($args);
		
       if ( !empty($brands) ) : ?>
        
			<?php echo $before_widget;
			if ( $title ) echo $before_title . $title . $after_title;?>			
			
			<?php $row=1;?>
			<ul class="brands-carousel owl-carousel">
			<?php foreach($brands as $brand): ?>
				<?php if($row==1){?>
					<li class="slide-row">
						<ul>
				<?php }
					$thumbnail_id = get_term_meta( $brand->term_id, 'thumbnail_id', true ) ;
					$image_src = wp_get_attachment_image_src( $thumbnail_id, 'full' ) ;
					$brand_link = get_term_link( $brand, 'product_brand' ) ;?>
					<li class="brand-item">
						<a href="<?php echo esc_url($brand_link) ?>">									
						<?php if ( !empty($image_src) ) {?>
							<img alt="<?php echo esc_attr($brand->cat_name)?>" src="<?php echo esc_url($image_src[0])?>"/>
						<?php }?>									
						</a>
					</li>
				<?php if($row==$number_slide){ $row=0;?>
					</ul>
						</li>
				<?php } $row++;?>
			<?php endforeach; // end of the loop. ?>
			</ul>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					var emallshop_rtl = false;
					if($("body").hasClass("rtl")){
						emallshop_rtl =  true;
					}					
					jQuery(".brands-carousel").owlCarousel({
						loop: true,
						rtl: emallshop_rtl,
						items:2,
						nav: true,
						navText: ['',''],
						dots:false,
						slideSpeed: 1000,
						rewind: true,
						addClassActive: true,
						itemsCustom: [1600, 1]
					});
					$( '.owl-carousel').addClass('owl-theme');
				});
			</script>
		
        <?php echo $after_widget; ?>
		<?php wp_reset_query();
			wp_reset_postdata();  // Restore global post data stomped by the_post().
        endif;		
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
		$instance['orderby'] = strip_tags($new_instance['orderby']);
		$instance['order'] = strip_tags($new_instance['order']);
        $instance['number'] = (int) $new_instance['number'];

        return $instance;
    }
		
    function form( $instance ) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : esc_html__('Product Brands','pl-emallshop-extensions');
		$orderby = isset($instance['orderby']) ? esc_attr($instance['orderby']) : 'date';
		$order = isset($instance['order']) ? esc_attr($instance['order']) : 'desc';
		$number = isset($instance['number']) ? (int) $instance['number'] : 12;
		$number_slide = isset($instance['number_slide']) ? (int) $instance['number_slide'] : 4;
		
		emallshop_widget_input_text(esc_html__('Title:', 'pl-emallshop-extensions'), $this->get_field_id('title'),$this->get_field_name('title'), $title);
		emallshop_widget_input_text(esc_html__('Number of show brands:', 'pl-emallshop-extensions'), $this->get_field_id('number'),$this->get_field_name('number'), $number);
		$orderby_options = array('date'=>esc_html__('Date','pl-emallshop-extensions'), 'title'=>esc_html__('Title','pl-emallshop-extensions'), 'name'=>esc_html__('Name(Slug)','pl-emallshop-extensions'),'rand'=>esc_html__('Rand','pl-emallshop-extensions'),'id'=>esc_html__('ID','pl-emallshop-extensions'));
		emallshop_widget_select(esc_html__('Order By:', 'pl-emallshop-extensions'), $this->get_field_id('orderby'),$this->get_field_name('orderby'), $orderby,$orderby_options);
		$order_options = array('desc'=>'Descending', 'asc'=>'Ascending');
		emallshop_widget_select(esc_html__('Order:', 'pl-emallshop-extensions'), $this->get_field_id('order'),$this->get_field_name('order'), $order,$order_options);
		emallshop_widget_input_text(esc_html__('Display per slide brands:', 'pl-emallshop-extensions'), $this->get_field_id('number_slide'),$this->get_field_name('number_slide'), $number_slide);
		
		
    }
}

// **********************************************************************// 
// ! QR code Widget
// **********************************************************************// 
class EmallShop_QRCode_Widget extends WP_Widget {
	
	public function __construct() {
		
         $widget_ops = array('classname' => 'emallshop_widget_qr_code', 'description' => esc_html__( "You can add a QR code image in sidebar to allow your users get quick access from their devices", 'pl-emallshop-extensions') );
		$control_ops = array('id_base' => 'emallshop-qr-code');		
        parent::__construct('emallshop-qr-code', 'EmallShop '.esc_html__('QR Code', 'pl-emallshop-extensions'), $widget_ops, $control_ops);
	}

    function widget($args, $instance) {
        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? false : $instance['title']);
        $info = apply_filters('qrcode_info', empty($instance['info']) ? false : $instance['info']);
        $text = apply_filters('qrcode_text', empty($instance['text']) ? false : $instance['text']);
        $size = !empty( $instance['size'] )  ? (int) $instance['size'] : false;
        $lightbox = !empty( $instance['lightbox'] )  ? (bool) $instance['lightbox'] : false;
        $currlink = !empty( $instance['currlink'] )  ? (bool) $instance['currlink'] : false; 

        echo $before_widget;
        if ( $title ) echo $before_title . $title . $after_title;
        echo emallshop_generate_qr_code($info, 'Open', $size, '', $currlink, $lightbox );
        if($text != '') 
            echo $text;
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['info'] = strip_tags($new_instance['info']);
        $instance['text'] = ($new_instance['text']);
        $instance['size'] = (int) $new_instance['size'];
        $instance['lightbox'] = (bool) $new_instance['lightbox'];
        $instance['currlink'] = (bool) $new_instance['currlink'];

        return $instance;
    }

    function form( $instance ) {
        $block_id = 0;
        if(!empty($instance['block_id']))
            $block_id = esc_attr($instance['block_id']);

        $info = isset($instance['info']) ? $instance['info'] : '';
        $text = isset($instance['text']) ? $instance['text'] : '';
        $title = isset($instance['title']) ? $instance['title'] : esc_html__('QR Code','pl-emallshop-extensions');
        $size = isset($instance['size']) ? (int) $instance['size'] : 265;
        $lightbox = isset($instance['lightbox']) ? (bool) $instance['lightbox'] : false;
        $currlink = isset($instance['currlink']) ? (bool) $instance['currlink'] : true;?>
		
        <?php emallshop_widget_input_text(esc_html__('Title:', 'pl-emallshop-extensions'), $this->get_field_id('title'),$this->get_field_name('title'), $title); ?>

        <?php emallshop_widget_textarea(esc_html__('Information to encode:', 'pl-emallshop-extensions'), $this->get_field_id('info'),$this->get_field_name('info'), $info); ?>

        <?php emallshop_widget_input_text(esc_html__('Image size:', 'pl-emallshop-extensions'), $this->get_field_id('size'), $this->get_field_name('size'), $size); ?>

        <?php emallshop_widget_input_checkbox(esc_html__('Show in lightbox', 'pl-emallshop-extensions'), $this->get_field_id('lightbox'), $this->get_field_name('lightbox'),checked($lightbox, true, false), 1); ?>

        <?php emallshop_widget_input_checkbox(esc_html__('Encode link to the current page', 'pl-emallshop-extensions'), $this->get_field_id('currlink'), $this->get_field_name('currlink'),checked($currlink, true, false), 1); ?>

        <?php emallshop_widget_textarea(esc_html__('Additional information in widget', 'pl-emallshop-extensions'), $this->get_field_id('text'),$this->get_field_name('text'), $text); ?>

	<?php
    }
}

// **********************************************************************// 
// ! Recent posts Widget
// **********************************************************************// 
class EmallShop_Recent_Posts_Widget extends WP_Widget {
	
	public function __construct() {
		
        $widget_ops = array('classname' => 'emallshop_widget_recent_entries', 'description' => esc_html__( "Your most resent post with slider.", 'pl-emallshop-extensions') );
		$control_ops = array('id_base' => 'emallshop-recent-posts');		
        parent::__construct('emallshop-recent-posts', 'EmallShop '.esc_html__('Recent Posts', 'pl-emallshop-extensions'), $widget_ops, $control_ops);
	}

    function widget($args, $instance) {
        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? false : $instance['title']);
		$number = (!empty($instance['number'])) ? (int) $instance['number'] : 10;
		$number_slide = (!empty($instance['number_slide'])) ? (int) $instance['number_slide'] : 5;
		$slider = (!empty($instance['slider'])) ? (bool) $instance['slider'] : false;
		$autoplay = (!empty($instance['autoplay'])) ? (bool) $instance['autoplay'] : false;
		$loop = (!empty($instance['loop'])) ? (bool) $instance['loop'] : false;
		$navigation = (!empty($instance['navigation'])) ? (bool) $instance['navigation'] : false;
		$dots = (!empty($instance['dots'])) ? (bool) $instance['dots'] : false;

        $recent_posts = new WP_Query(array('posts_per_page' => $number, 'post_type' => 'post', 'post_status' => 'publish', 'ignore_sticky_posts' => 1));

		$id = uniqid("postCarousel-");
        if ($recent_posts->have_posts()) : ?>
        
			<?php echo $before_widget;
			if ( $title ) echo $before_title . $title . $after_title;?>
			
			<?php if($slider):
				$slider_class=" owl-carousel ".$id;
			else:
				$slider_class=""; 
			endif;?>
			
            <ul class="post-list-widget<?php echo esc_attr($slider_class); ?>">
				<?php $row=1; while ($recent_posts->have_posts()) : $recent_posts->the_post();?>
					<?php if( $slider == true && $row==1){?>
						<li class="slide-row">
							<ul>
					<?php }?>
						<li class="post-item">
							<div class="post-image">
								<a href="<?php the_permalink() ?>" title="<?php get_the_title();?>"><?php echo get_the_post_thumbnail($recent_posts->ID,'thumbnail')?></a>
							</div>
							<div class="post-widget-content">
								<a href="<?php the_permalink() ?>" title="<?php get_the_title();?>"><?php the_title(); ?></a>
								<!--<?php _e('by', 'pl-emallshop-extensions') ?> <strong><?php the_author(); ?></strong>--> 
								<span><?php the_time(get_option('date_format')); ?></span>
							</div>
						</li>
					<?php if( $slider == true && $row==$number_slide){ $row=0;?>
							</ul>
						</li>
					<?php } $row++;?>
				<?php endwhile;?>
			</ul>
			<?php if($slider): ?>
                <script type="text/javascript">
					
                    jQuery(document).ready(function($) {				
						var emallshop_rtl = false;
						if($("body").hasClass("rtl")){
							emallshop_rtl =  true;
						}	
                        jQuery(".<?php echo esc_attr($id); ?>").owlCarousel({
							autoplay:<?php echo $autoplay ? "true" : "false" ; ?>,
							autoplayHoverPause: true,
							loop: <?php echo $loop ? "true" : "false" ; ?>,
							rtl: emallshop_rtl,
							items:1,
							nav: <?php echo $navigation ? "true" : "false" ; ?>,
							navText: ['',''],
							dots:<?php echo $dots ? "true" : "false" ; ?>,
							lazyLoad: true,
							smartSpeed: 1000,
							rewind: true,
							addClassActive: true
                        });
						$( '.owl-carousel').addClass('owl-theme');
                    });
                </script>
            <?php endif; ?>
		
        <?php echo $after_widget; ?>
		<?php wp_reset_query();  // Restore global post data stomped by the_post().
        endif;		
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $instance['slider'] = (bool) $new_instance['slider'];
		$instance['number_slide'] = (int) $new_instance['number_slide'];
		$instance['autoplay'] = (bool) $new_instance['autoplay'];
		$instance['loop'] = (bool) $new_instance['loop'];
		$instance['navigation'] = (bool) $new_instance['navigation'];
		$instance['dots'] = (bool) $new_instance['dots'];

        return $instance;
    }
		
    function form( $instance ) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : esc_html__('Recent Posts','pl-emallshop-extensions');
		$number = isset($instance['number']) ? (int) $instance['number'] : 10;
		$number_slide = isset($instance['number_slide']) ? (int) $instance['number_slide'] : 5;
        $slider = isset($instance['slider']) ? (bool) $instance['slider'] : false;
		$autoplay = isset($instance['autoplay']) ? (bool) $instance['autoplay'] : false;
		$loop = isset($instance['loop']) ? (bool) $instance['loop'] : false;
		$navigation = isset($instance['navigation']) ? (bool) $instance['navigation'] : true;
		$dots = isset($instance['dots']) ? (bool) $instance['dots'] : false;
		
		emallshop_widget_input_text(esc_html__('Title:', 'pl-emallshop-extensions'), $this->get_field_id('title'),$this->get_field_name('title'), $title);
		emallshop_widget_input_text(esc_html__('Number of posts to show:', 'pl-emallshop-extensions'), $this->get_field_id('number'),$this->get_field_name('number'), $number);
		emallshop_widget_input_checkbox(esc_html__('Enable slider', 'pl-emallshop-extensions'), $this->get_field_id('slider'), $this->get_field_name('slider'),checked($slider, true, false), 1); 
		emallshop_widget_input_text(esc_html__('Per slide show posts:', 'pl-emallshop-extensions'), $this->get_field_id('number_slide'),$this->get_field_name('number_slide'), $number_slide);
		emallshop_widget_input_checkbox(esc_html__('Enable Auto play slider', 'pl-emallshop-extensions'), $this->get_field_id('autoplay'), $this->get_field_name('autoplay'),checked($autoplay, true, false), 1);
		emallshop_widget_input_checkbox(esc_html__('Continue slider loop', 'pl-emallshop-extensions'), $this->get_field_id('loop'), $this->get_field_name('loop'),checked($loop, true, false), 1);	
		emallshop_widget_input_checkbox(esc_html__('Show slider navigation', 'pl-emallshop-extensions'), $this->get_field_id('navigation'), $this->get_field_name('navigation'),checked($navigation, true, false), 1);
		emallshop_widget_input_checkbox(esc_html__('Show slider navigation dots', 'pl-emallshop-extensions'), $this->get_field_id('dots'), $this->get_field_name('dots'),checked($dots, true, false), 1);	
		
    }
}

// **********************************************************************// 
// ! Portfolio Widget
// **********************************************************************// 
class EmallShop_Portfolio_Widget extends WP_Widget {
	
	public function __construct() {
		
        $widget_ops = array('classname' => 'emallshop_widget_portfolio', 'description' => esc_html__( "Display portfolios with slider.", 'pl-emallshop-extensions') );
		$control_ops = array('id_base' => 'emallshop-portfolio');		
        parent::__construct('emallshop-portfolio', 'EmallShop '.esc_html__('Portfolio', 'pl-emallshop-extensions'), $widget_ops, $control_ops);
	}

    function widget($args, $instance) {
        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? false : $instance['title']);
		$orderby = (!empty($instance['orderby'])) ?  $instance['orderby'] : 'date';
		$order = (!empty($instance['order'])) ?  $instance['order'] : 'desc';
		$number = (!empty($instance['number'])) ? (int) $instance['number'] : 10;
		$number_slide = (!empty($instance['number_slide'])) ? (int) $instance['number_slide'] : 5;
		$slider = (!empty($instance['slider'])) ? (bool) $instance['slider'] : false;
		$autoplay = (!empty($instance['autoplay'])) ? (bool) $instance['autoplay'] : false;
		$loop = (!empty($instance['loop'])) ? (bool) $instance['loop'] : false;
		$navigation = (!empty($instance['navigation'])) ? (bool) $instance['navigation'] : false;
		$dots = (!empty($instance['dots'])) ? (bool) $instance['dots'] : false;

        $portfolios = new WP_Query(array('posts_per_page' => $number, 'post_type' => 'portfolio', 'post_status' => 'publish','orderby' => $orderby, 'order' => $order,'ignore_sticky_posts' => 1));

		$id = uniqid("portfolioCarousel-");
        if ($portfolios->have_posts()) : ?>
        
			<?php echo $before_widget;
			if ( $title ) echo $before_title . $title . $after_title;?>
			
			<?php if($slider):
				$slider_class=" owl-carousel ".$id;
			else:
				$slider_class=""; 
			endif;?>
			
            <ul class="post-list-widget<?php echo esc_attr($slider_class); ?>">
				<?php $row=1; while ($portfolios->have_posts()) : $portfolios->the_post();?>
					<?php if( $slider == true && $row==1){?>
						<li class="slide-row">
							<ul>
					<?php }?>
						<li class="post-item">
							<div class="post-image">
								<a href="<?php the_permalink() ?>" title="<?php get_the_title();?>"><?php echo get_the_post_thumbnail($portfolios->ID,'thumbnail')?></a>
							</div>
							<div class="post-widget-content">
								<a href="<?php the_permalink() ?>" title="<?php get_the_title();?>"><?php the_title(); ?></a>
								<!--<?php _e('by', 'pl-emallshop-extensions') ?> <strong><?php the_author(); ?></strong>--> 
								<span><?php the_time(get_option('date_format')); ?></span>
							</div>
						</li>
					<?php if( $slider == true && $row==$number_slide){ $row=0;?>
							</ul>
						</li>
					<?php } $row++;?>
				<?php endwhile;?>
			</ul>
			<?php if($slider): ?>
                <script type="text/javascript">
					
                    jQuery(document).ready(function($) {
						var emallshop_rtl = false;
						if($("body").hasClass("rtl")){
							emallshop_rtl =  true;
						}
                        jQuery(".<?php echo esc_attr($id); ?>").owlCarousel({
							autoplay:<?php echo $autoplay ? "true" : "false" ; ?>,
							autoplayHoverPause: true,
							loop: <?php echo $loop ? "true" : "false" ; ?>,
							rtl: emallshop_rtl,
							items:1,
							nav: <?php echo $navigation ? "true" : "false" ; ?>,
							navText: ['',''],
							dots:<?php echo $dots ? "true" : "false" ; ?>,
							lazyLoad: true,
							smartSpeed: 1000,
							rewind: true,
							addClassActive: true
                        });
						$( '.owl-carousel').addClass('owl-theme');
                    });
                </script>
            <?php endif; ?>
		
        <?php echo $after_widget; ?>
		<?php wp_reset_query();  // Restore global post data stomped by the_post().
        endif;		
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
		$instance['orderby'] = strip_tags($new_instance['orderby']);
		$instance['order'] = strip_tags($new_instance['order']);
        $instance['number'] = (int) $new_instance['number'];
        $instance['slider'] = (bool) $new_instance['slider'];
		$instance['number_slide'] = (int) $new_instance['number_slide'];
		$instance['autoplay'] = (bool) $new_instance['autoplay'];
		$instance['loop'] = (bool) $new_instance['loop'];
		$instance['navigation'] = (bool) $new_instance['navigation'];
		$instance['dots'] = (bool) $new_instance['dots'];

        return $instance;
    }
		
    function form( $instance ) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : esc_html__('Portfolios','pl-emallshop-extensions');
		$orderby = isset($instance['orderby']) ? esc_attr($instance['orderby']) : 'date';
		$order = isset($instance['order']) ? esc_attr($instance['order']) : 'desc';
		$number = isset($instance['number']) ? (int) $instance['number'] : 10;
		$number_slide = isset($instance['number_slide']) ? (int) $instance['number_slide'] : 5;
        $slider = isset($instance['slider']) ? (bool) $instance['slider'] : false;
		$autoplay = isset($instance['autoplay']) ? (bool) $instance['autoplay'] : false;
		$loop = isset($instance['loop']) ? (bool) $instance['loop'] : false;
		$navigation = isset($instance['navigation']) ? (bool) $instance['navigation'] : true;
		$dots = isset($instance['dots']) ? (bool) $instance['dots'] : false;
		
		emallshop_widget_input_text(esc_html__('Title:', 'pl-emallshop-extensions'), $this->get_field_id('title'),$this->get_field_name('title'), $title);
		emallshop_widget_input_text(esc_html__('Number of show portfolio:', 'pl-emallshop-extensions'), $this->get_field_id('number'),$this->get_field_name('number'), $number);
		$orderby_options = array('date'=>esc_html__('Date','pl-emallshop-extensions'), 'title'=>esc_html__('Title','pl-emallshop-extensions'), 'name'=>esc_html__('Name(Slug)','pl-emallshop-extensions'),'rand'=>esc_html__('Rand','pl-emallshop-extensions'),'id'=>esc_html__('ID','pl-emallshop-extensions'));
		emallshop_widget_select(esc_html__('Order By:', 'pl-emallshop-extensions'), $this->get_field_id('orderby'),$this->get_field_name('orderby'), $orderby,$orderby_options);
		$order_options = array('desc'=>'Descending', 'asc'=>'Ascending');
		emallshop_widget_select(esc_html__('Order:', 'pl-emallshop-extensions'), $this->get_field_id('order'),$this->get_field_name('order'), $order,$order_options);
		emallshop_widget_input_checkbox(esc_html__('Enable slider', 'pl-emallshop-extensions'), $this->get_field_id('slider'), $this->get_field_name('slider'),checked($slider, true, false), 1); 
		emallshop_widget_input_text(esc_html__('Per slide show posts:', 'pl-emallshop-extensions'), $this->get_field_id('number_slide'),$this->get_field_name('number_slide'), $number_slide);
		emallshop_widget_input_checkbox(esc_html__('Enable Auto play slider', 'pl-emallshop-extensions'), $this->get_field_id('autoplay'), $this->get_field_name('autoplay'),checked($autoplay, true, false), 1);
		emallshop_widget_input_checkbox(esc_html__('Show slider loop', 'pl-emallshop-extensions'), $this->get_field_id('loop'), $this->get_field_name('loop'),checked($loop, true, false), 1);	
		emallshop_widget_input_checkbox(esc_html__('Show slider navigation', 'pl-emallshop-extensions'), $this->get_field_id('navigation'), $this->get_field_name('navigation'),checked($navigation, true, false), 1);
		emallshop_widget_input_checkbox(esc_html__('Show slider navigation dots', 'pl-emallshop-extensions'), $this->get_field_id('dots'), $this->get_field_name('dots'),checked($dots, true, false), 1);	
    }
}

// **********************************************************************// 
// ! Testimonial Widget
// **********************************************************************// 
class EmallShop_Testimonial_Widget extends WP_Widget {
	
	public function __construct() {
		
        $widget_ops = array('classname' => 'emallshop_widget_testimonial', 'description' => esc_html__( "Testimonials with slider.", 'pl-emallshop-extensions') );
		$control_ops = array('id_base' => 'emallshop-testimonial');		
        parent::__construct('emallshop-testimonial', 'EmallShop '.esc_html__('Testimonial', 'pl-emallshop-extensions'), $widget_ops, $control_ops);
	}

    function widget($args, $instance) {
        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? false : $instance['title']);
		$orderby = (!empty($instance['orderby'])) ?  $instance['orderby'] : 'date';
		$order = (!empty($instance['order'])) ?  $instance['order'] : 'desc';
		$number = (!empty($instance['number'])) ? (int) $instance['number'] : 10;
		$autoplay = (!empty($instance['autoplay'])) ? (bool) $instance['autoplay'] : false;
		$loop = (!empty($instance['loop'])) ? (bool) $instance['loop'] : false;
		$navigation = (!empty($instance['navigation'])) ? (bool) $instance['navigation'] : false;
		$dots = (!empty($instance['dots'])) ? (bool) $instance['dots'] : false;

        //Get Testimonials
		$args = array(
			'post_type'				=> 'testimonial',
			'post_status'			=> 'publish',
			'ignore_sticky_posts'	=> 1,
			'posts_per_page' 		=> $number,
			'orderby' 			    => $orderby,
			'order' 				=> $order,
			);
		
		$testimonials = new WP_Query( $args );

        if ($testimonials->have_posts()) : ?>
        
			<?php echo $before_widget;
			if ( $title ) echo $before_title . $title . $after_title;?>			
			
            <ul class="testimonials owl-carousel">
				<?php while( $testimonials->have_posts() ): $testimonials->the_post();
				$testimonial_meta = get_post_meta( get_the_ID());?>
					<li class="blockquote">
						<div class="quote-content">
							<?php the_content();?>
						</div>
						<div class="quote-meta">
							<div class="client-image">
								<?php echo get_the_post_thumbnail( $testimonials->ID, 'thumbnail' ); ?>
							</div>
							<div class="name-designation">
								<a href="<?php echo get_permalink();?>"> <h6 class="name"><?php the_title();?></h6></a>
								<div class="designation">
								<?php if( isset( $testimonial_meta['es_client_designation'] ) ):
									echo esc_attr($testimonial_meta['es_client_designation'][0]);
								endif;?>
								</div>								
							</div>							
						</div>
					</li>
				<?php endwhile; // end of the loop. ?>
			</ul>
			<script type="text/javascript">
				
				jQuery(document).ready(function($) {
					var emallshop_rtl = false;
					if($("body").hasClass("rtl")){
						emallshop_rtl =  true;
					}					
					jQuery(".testimonials").owlCarousel({
						autoplay:<?php echo $autoplay ? "true" : "false" ; ?>,
						autoplayHoverPause: true,
						loop: <?php echo $loop ? "true" : "false" ; ?>,
						rtl: emallshop_rtl,
						items:1,
						nav: <?php echo $navigation ? "true" : "false" ; ?>,
						navText: ['',''],
						dots:<?php echo $dots ? "true" : "false" ; ?>,
						lazyLoad: true,
						smartSpeed: 1000,
						rewind: true,
						addClassActive: true
					});
					$( '.owl-carousel').addClass('owl-theme');
				});
			</script>
		
        <?php echo $after_widget; ?>
		<?php wp_reset_postdata();  // Restore global post data stomped by the_post().
        endif;		
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
		$instance['orderby'] = strip_tags($new_instance['orderby']);
		$instance['order'] = strip_tags($new_instance['order']);
        $instance['number'] = (int) $new_instance['number'];
		$instance['autoplay'] = (bool) $new_instance['autoplay'];
		$instance['loop'] = (bool) $new_instance['loop'];
		$instance['navigation'] = (bool) $new_instance['navigation'];
		$instance['dots'] = (bool) $new_instance['dots'];

        return $instance;
    }
		
    function form( $instance ) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : esc_html__('Testimonial','pl-emallshop-extensions');
		$orderby = isset($instance['orderby']) ? esc_attr($instance['orderby']) : 'date';
		$order = isset($instance['order']) ? esc_attr($instance['order']) : 'desc';
		$number = isset($instance['number']) ? (int) $instance['number'] : 5;
		$autoplay = isset($instance['autoplay']) ? (bool) $instance['autoplay'] : false;
		$loop = isset($instance['loop']) ? (bool) $instance['loop'] : false;
		$navigation = isset($instance['navigation']) ? (bool) $instance['navigation'] : true;
		$dots = isset($instance['dots']) ? (bool) $instance['dots'] : false;
		
		emallshop_widget_input_text(esc_html__('Title:', 'pl-emallshop-extensions'), $this->get_field_id('title'),$this->get_field_name('title'), $title);
		$orderby_options = array('date'=>esc_html__('Date','pl-emallshop-extensions'), 'title'=>esc_html__('Title','pl-emallshop-extensions'), 'name'=>esc_html__('Name(Slug)','pl-emallshop-extensions'),'rand'=>esc_html__('Rand','pl-emallshop-extensions'),'id'=>esc_html__('ID','pl-emallshop-extensions'));
		emallshop_widget_select(esc_html__('Order By:', 'pl-emallshop-extensions'), $this->get_field_id('orderby'),$this->get_field_name('orderby'), $orderby,$orderby_options);
		$order_options = array('desc'=>'Descending', 'asc'=>'Ascending');
		emallshop_widget_select(esc_html__('Order:', 'pl-emallshop-extensions'), $this->get_field_id('order'),$this->get_field_name('order'), $order,$order_options);
		emallshop_widget_input_text(esc_html__('Show Number of testimonials:', 'pl-emallshop-extensions'), $this->get_field_id('number'),$this->get_field_name('number'), $number);
		emallshop_widget_input_checkbox(esc_html__('Enable Auto play slider', 'pl-emallshop-extensions'), $this->get_field_id('autoplay'), $this->get_field_name('autoplay'),checked($autoplay, true, false), 1);
		emallshop_widget_input_checkbox(esc_html__('Show slider loop', 'pl-emallshop-extensions'), $this->get_field_id('loop'), $this->get_field_name('loop'),checked($loop, true, false), 1);
		emallshop_widget_input_checkbox(esc_html__('Show slider navigation', 'pl-emallshop-extensions'), $this->get_field_id('navigation'), $this->get_field_name('navigation'),checked($navigation, true, false), 1);
		emallshop_widget_input_checkbox(esc_html__('Show slider navigation dots', 'pl-emallshop-extensions'), $this->get_field_id('dots'), $this->get_field_name('dots'),checked($dots, true, false), 1);			
    }
}

// **********************************************************************// 
// ! Products Widget
// **********************************************************************// 
class EmallShop_Products_Widget extends WP_Widget {
	
	public function __construct() {
		
        $widget_ops = array('classname' => 'emallshop_widget_products', 'description' => esc_html__( "Display a list of products with slider.", 'pl-emallshop-extensions') );
		$control_ops = array('id_base' => 'emallshop-products');		
        parent::__construct('emallshop-products', 'EmallShop '.esc_html__('Products', 'pl-emallshop-extensions'), $widget_ops, $control_ops);
	}

    function widget($args, $instance) {
        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? false : $instance['title']);
		$product_type = (!empty($instance['product_type'])) ?  $instance['product_type'] : 'recent-products';
		$orderby = (!empty($instance['orderby'])) ?  $instance['orderby'] : 'date';
		$order = (!empty($instance['order'])) ?  $instance['order'] : 'desc';
		$number = (!empty($instance['number'])) ? (int) $instance['number'] : 10;
		$number_slide = (!empty($instance['number_slide'])) ? (int) $instance['number_slide'] : 5;
		$slider = (!empty($instance['slider'])) ? (bool) $instance['slider'] : false;
		$autoplay = (!empty($instance['autoplay'])) ? (bool) $instance['autoplay'] : false;
		$loop = (!empty($instance['loop'])) ? (bool) $instance['loop'] : false;
		$navigation = (!empty($instance['navigation'])) ? (bool) $instance['navigation'] : false;
		$dots = (!empty($instance['dots'])) ? (bool) $instance['dots'] : false;

        //Get Products
        global $woocommerce_loop;		
		
		
		$args = array(
					'post_type'				=> 'product',
					'post_status'			=> 'publish',
					'ignore_sticky_posts'	=> 1,
					'posts_per_page' 		=> $number,
				);
		$args['meta_query'] = WC()->query->get_meta_query();
		$tax_query   		= WC()->query->get_tax_query();
		
		//recent products
		if(isset($product_type) && ( $product_type=="recent-products" )):	
			$args['orderby'] = $orderby;
			$args['order'] = $order;
			$args['tax_query']	= $tax_query;
		endif;
		
		//featured products
		if(isset($product_type) && ( $product_type=="featured-products" )):
			$f_tax_query=$tax_query;
			$f_tax_query[] = array(
				'key'   => '_featured',
				'value' => 'yes'
			);
			
			$args['orderby'] 	= $orderby;
			$args['order']		= $order;
			$args['tax_query']	= $f_tax_query;
		endif;
		
		//best selling
		if(isset($product_type) && ( $product_type=="best-seller-products" )):
			$args['meta_key'] 	= 'total_sales';
			$args['orderby'] 	= 'meta_value_num';
			$args['tax_query']	= $tax_query;			
		endif;
		
		//top reviews
		if(isset($product_type) && ( $product_type=="top-reviews-products" )):
			$args['tax_query']	= $tax_query;
			add_filter( 'posts_clauses', array( 'WC_Shortcodes', 'order_by_rating_post_clauses' ) );
		endif;
		
		//sale products
		if(isset($product_type) && ( $product_type=="sale-products" )):
		
			$product_ids_on_sale = wc_get_product_ids_on_sale();
			$args['orderby'] 	= $orderby;
			$args['order'] 		= $order;
			$args['tax_query']	= $tax_query;
			$args['post__in'] 	= array_merge( array( 0 ), $product_ids_on_sale );
			
		endif;
		$products = new WP_Query( $args );
		
		if(isset($product_type) && ( $product_type=="top-reviews-products" )):
			remove_filter( 'posts_clauses', array( 'WC_Shortcodes', 'order_by_rating_post_clauses' ) );
		endif;
		
		$id = uniqid("productsCarousel-");
        if ($products->have_posts()) : ?>
        
			<?php echo $before_widget;
			if ( $title ) echo $before_title . $title . $after_title;?>
			
			<?php if($slider):
				$slider_class=" owl-carousel ".$id;
			else:
				$slider_class=""; 
			endif;?>
            <ul class="product_list_widget<?php echo esc_attr($slider_class); ?> woocommerce">
				<?php $row=1; while ($products->have_posts()) : $products->the_post();?>
					<?php if( $slider == true && $row==1){?>
						<li class="slide-row">
							<ul>
					<?php }?>
						
						<?php wc_get_template( 'emallshop-content-widget-product.php' );?>
						
					<?php if( $slider == true && ($row==$number_slide || $products->current_post+1==$products->post_count)){ $row=0;?>
							</ul>
						</li>
					<?php } $row++;?>
				<?php endwhile;?>
			</ul>
			<?php if($slider): ?>
                <script type="text/javascript">
                    jQuery(document).ready(function($) {
						var emallshop_rtl = false;
						if($("body").hasClass("rtl")){
							emallshop_rtl =  true;
						}					
                        $(".<?php echo esc_attr($id); ?>").owlCarousel({
							autoplay:<?php echo $autoplay ? "true" : "false" ; ?>,
							autoplayHoverPause: true,
							loop: <?php echo $loop ? "true" : "false" ; ?>,
							rtl: emallshop_rtl,
                            items:1,
                            nav: <?php echo $navigation ? "true" : "false" ; ?>,
							navText: ['',''],
							dots:<?php echo $dots ? "true" : "false" ; ?>,
                            lazyLoad: true,
							smartSpeed: 1000,
							rewind: true,
                            addClassActive: true
                        });
						$( '.owl-carousel').addClass('owl-theme');
                    });
                </script>
            <?php endif; ?>
		
        <?php echo $after_widget; ?>
		<?php wp_reset_query();
			wp_reset_postdata();  // Restore global post data stomped by the_post().
        endif;		
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
		$instance['product_type'] = strip_tags($new_instance['product_type']);
		$instance['orderby'] = strip_tags($new_instance['orderby']);
		$instance['order'] = strip_tags($new_instance['order']);
        $instance['number'] = (int) $new_instance['number'];
        $instance['slider'] = (bool) $new_instance['slider'];
		$instance['number_slide'] = (int) $new_instance['number_slide'];
		$instance['autoplay'] = (bool) $new_instance['autoplay'];
		$instance['loop'] = (bool) $new_instance['loop'];
		$instance['navigation'] = (bool) $new_instance['navigation'];
		$instance['dots'] = (bool) $new_instance['dots'];

        return $instance;
    }
		
    function form( $instance ) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : esc_html__('Recent Products','pl-emallshop-extensions');
		$product_type = isset($instance['product_type']) ? esc_attr($instance['product_type']) : 'recent-products';
		$orderby = isset($instance['orderby']) ? esc_attr($instance['orderby']) : 'date';
		$order = isset($instance['order']) ? esc_attr($instance['order']) : 'desc';
		$number = isset($instance['number']) ? (int) $instance['number'] : 10;
		$number_slide = isset($instance['number_slide']) ? (int) $instance['number_slide'] : 5;
        $slider = isset($instance['slider']) ? (bool) $instance['slider'] : false;
		$autoplay = isset($instance['autoplay']) ? (bool) $instance['autoplay'] : false;
		$loop = isset($instance['loop']) ? (bool) $instance['loop'] : false;
		$navigation = isset($instance['navigation']) ? (bool) $instance['navigation'] : true;
		$dots = isset($instance['dots']) ? (bool) $instance['dots'] : false;
		
		emallshop_widget_input_text(esc_html__('Title:', 'pl-emallshop-extensions'), $this->get_field_id('title'),$this->get_field_name('title'), $title);
		$product_type_options = array('recent-products'=>esc_html__('Recent Products','pl-emallshop-extensions'), 'featured-products'=>esc_html__('Featured Products','pl-emallshop-extensions'), 'top-reviews-products'=>esc_html__('Top Reviews Products','pl-emallshop-extensions'),'sale-products'=>esc_html__('Sale Products','pl-emallshop-extensions'),'best-seller-products'=>esc_html__('Best Seller Products','pl-emallshop-extensions'));
		emallshop_widget_select(esc_html__('Product Type:', 'pl-emallshop-extensions'), $this->get_field_id('product_type'),$this->get_field_name('product_type'), $product_type,$product_type_options);
		emallshop_widget_input_text(esc_html__('Show number of products:', 'pl-emallshop-extensions'), $this->get_field_id('number'),$this->get_field_name('number'), $number);
		$orderby_options = array('date'=>esc_html__('Date','pl-emallshop-extensions'), 'title'=>esc_html__('Title','pl-emallshop-extensions'), 'name'=>esc_html__('Name(Slug)','pl-emallshop-extensions'),'rand'=>esc_html__('Rand','pl-emallshop-extensions'),'id'=>esc_html__('ID','pl-emallshop-extensions'));
		emallshop_widget_select(esc_html__('Order By:', 'pl-emallshop-extensions'), $this->get_field_id('orderby'),$this->get_field_name('orderby'), $orderby,$orderby_options);
		$order_options = array('desc'=>'Descending', 'asc'=>'Ascending');
		emallshop_widget_select(esc_html__('Order:', 'pl-emallshop-extensions'), $this->get_field_id('order'),$this->get_field_name('order'), $order,$order_options);
		emallshop_widget_input_checkbox(esc_html__('Enable slider', 'pl-emallshop-extensions'), $this->get_field_id('slider'), $this->get_field_name('slider'),checked($slider, true, false), 1); 
		emallshop_widget_input_text(esc_html__('Show products per slide:', 'pl-emallshop-extensions'), $this->get_field_id('number_slide'),$this->get_field_name('number_slide'), $number_slide);
		emallshop_widget_input_checkbox(esc_html__('Enable Auto play slider', 'pl-emallshop-extensions'), $this->get_field_id('autoplay'), $this->get_field_name('autoplay'),checked($autoplay, true, false), 1);
		emallshop_widget_input_checkbox(esc_html__('Show slider loop', 'pl-emallshop-extensions'), $this->get_field_id('loop'), $this->get_field_name('loop'),checked($loop, true, false), 1);
		emallshop_widget_input_checkbox(esc_html__('Show slider navigation', 'pl-emallshop-extensions'), $this->get_field_id('navigation'), $this->get_field_name('navigation'),checked($navigation, true, false), 1);
		emallshop_widget_input_checkbox(esc_html__('Show slider navigation dots', 'pl-emallshop-extensions'), $this->get_field_id('dots'), $this->get_field_name('dots'),checked($dots, true, false), 1);
		
    }
}

// **********************************************************************// 
// ! Twitter Widget
// **********************************************************************// 

class EmallShop_Twitter_Widget extends WP_Widget {
	
	public function __construct() {
		
         $widget_ops = array('classname' => 'emallshop_twitter', 'description' => esc_html__('Display most recent Twitter feed', 'pl-emallshop-extensions') );
		$control_ops = array('id_base' => 'emallshop-twitte');		
        parent::__construct('emallshop-twitte', 'EmallShop '.esc_html__('Twitter Feed', 'pl-emallshop-extensions'), $widget_ops, $control_ops);
	}
 
    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters('widget_title', !empty( $instance['title'] ) ? $instance['title'] : '' );
        echo $before_widget;
        if ( $title ) echo $before_title . $title . $after_title;
        $attr['interval'] = !empty( $instance['interval'] )  ? $instance['interval'] * 10 : '';
		
		include_once(ES_EXTENSIONS_PATH.'/inc/twitteroauth/twitteroauth.php');
		
		$usernames					= !empty( $instance['usernames'] )  ? $instance['usernames'] : '';
		$twitter_customer_key           = !empty( $instance['consumer_key'] )  ? $instance['consumer_key'] : '';
		$twitter_customer_secret        = !empty( $instance['consumer_secret'] )  ? $instance['consumer_secret'] : '';
		$twitter_access_token           = !empty( $instance['user_token'] )  ? $instance['user_token'] : '';
		$twitter_access_token_secret    = !empty( $instance['user_secret'] )  ? $instance['user_secret'] : '';
		$count							= !empty( $instance['limit'] )  ? $instance['limit'] : '';

		$connection = new TwitterOAuth($twitter_customer_key, $twitter_customer_secret, $twitter_access_token, $twitter_access_token_secret);

		$my_tweets = $connection->get('statuses/user_timeline', array('screen_name' => $usernames, 'count' => $count));

		echo '<div class="twitter-bubble">';
		if(isset($my_tweets->errors))
		{           
			echo 'Error :'. $my_tweets->errors[0]->code. ' - '. $my_tweets->errors[0]->message;
		}else{
			$html = '<ul class="twitter-list">';
			if(!empty($my_tweets)):
				foreach ($my_tweets as $tweet) {
					if(!isset($tweet->message)) :
						$html .= '<li class="lastItem firstItem"><div class="media"><i class="pull-left fa fa-twitter"></i><div class="media-body">' . makeClickableLinks($tweet->text) . '</div></div></li>';
					else :
						$html .= '<li class="lastItem firstItem"><div class="media tweet-error"><div class="media-body">' . $tweet->message . '</div></div></li>';
					endif;	
				}
			else:
				$html .= '<li class="lastItem firstItem"><div class="media"><div class="media-body">' ._e('Connection or authontication problem.','pl-emallshop-extensions'). '</div></div></li>';
			endif;
			$html .= '</ul>';
			echo $html;
		}
		echo '</div>';
		
        echo $after_widget;
    }
	
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['usernames'] = strip_tags( $new_instance['usernames'] );
        $instance['consumer_key'] = strip_tags( $new_instance['consumer_key'] );
        $instance['consumer_secret'] = strip_tags( $new_instance['consumer_secret'] );
        $instance['user_token'] = strip_tags( $new_instance['user_token'] );
        $instance['user_secret'] = strip_tags( $new_instance['user_secret'] );
        $instance['limit'] = strip_tags( $new_instance['limit'] );
        $instance['interval'] = strip_tags( $new_instance['interval'] );
        return $instance;
    }
    function form( $instance ) {
        $defaults = array( 'title' => esc_html__('Twitter Feed','pl-emallshop-extensions'), 'usernames' => '', 'consumer_key'=>'', 'consumer_secret'=>'', 'user_token'=>'', 'user_secret'=>'', 'limit' => '2', 'interval' => '5' );
        $instance = wp_parse_args( (array) $instance, $defaults );
        emallshop_widget_input_text( esc_html__('Title:', 'pl-emallshop-extensions'), $this->get_field_id( 'title' ), $this->get_field_name( 'title' ), $instance['title'] );
        emallshop_widget_input_text( esc_html__('Username:', 'pl-emallshop-extensions'), $this->get_field_id( 'usernames' ), $this->get_field_name( 'usernames' ), $instance['usernames'] );
        emallshop_widget_input_text( esc_html__('Customer Key:', 'pl-emallshop-extensions'), $this->get_field_id( 'consumer_key' ), $this->get_field_name( 'consumer_key' ), $instance['consumer_key'] );
        emallshop_widget_input_text( esc_html__('Customer Secret:', 'pl-emallshop-extensions'), $this->get_field_id( 'consumer_secret' ), $this->get_field_name( 'consumer_secret' ), $instance['consumer_secret'] );
        emallshop_widget_input_text( esc_html__('Access Token:', 'pl-emallshop-extensions'), $this->get_field_id( 'user_token' ), $this->get_field_name( 'user_token' ), $instance['user_token'] );
        emallshop_widget_input_text( esc_html__('Access Token Secret:', 'pl-emallshop-extensions'), $this->get_field_id( 'user_secret' ), $this->get_field_name( 'user_secret' ), $instance['user_secret'] );
        emallshop_widget_input_text( esc_html__('Number of tweets:', 'pl-emallshop-extensions'), $this->get_field_id( 'limit' ), $this->get_field_name( 'limit' ), $instance['limit'] );
    }
}

// **********************************************************************// 
// ! About Us Widget
// **********************************************************************// 
class EmallShop_About_Us_Widget extends WP_Widget {
	
	public function __construct() {
		
         $widget_ops = array('classname' => 'emallshop_about_us', 'description' => esc_html__('Display about us', 'pl-emallshop-extensions') );
		$control_ops = array('id_base' => 'emallshop-about-us');		
        parent::__construct('emallshop-about-us', 'EmallShop '.esc_html__('About Us', 'pl-emallshop-extensions'), $widget_ops, $control_ops);
	}

    function widget($args, $instance) {
        extract($args);

        $title 				= apply_filters('widget_title', empty($instance['title']) ? false : $instance['title']);
		$hide_title 		= (!empty($instance['hide_title'])) ? (bool) $instance['hide_title'] : false;
		$logo_url 			= (!empty($instance['logo_url'])) ?  $instance['logo_url'] : '';
		$our_site_url 		= (!empty($instance['our_site_url'])) ?  $instance['our_site_url'] : '#';
		$about_tagline 		= apply_filters('about_tagline', empty($instance['about_tagline']) ? false : $instance['about_tagline']);
		$address 			= (!empty($instance['address'])) ?  $instance['address'] : '';
		$phone_number 		= (!empty($instance['phone_number'])) ?  $instance['phone_number'] : '';
		$fax_number 		= (!empty($instance['fax_number'])) ?  $instance['fax_number'] : '';
		$email_address 		= (!empty($instance['email_address'])) ?  $instance['email_address'] : '';
		$website 			= (!empty($instance['website'])) ?  $instance['website'] : '';
		$days_hours 		= (!empty($instance['days_hours'])) ?  $instance['days_hours'] : '';

        // About Us        
		echo $before_widget;
		if ( $title && !$hide_title) echo $before_title . $title . $after_title;		
			
		$html='<div class="about-us-widget">';
		
		if($logo_url != '')
			$html.='<p class="about-logo"><a href="'.esc_url($our_site_url) .'"><img src="'. esc_url($logo_url) .'" alt="pl-emallshop-extensions" /></a></p>';			
		
		if($about_tagline != '')
			$html.='<p>'. esc_attr($about_tagline) .'</p>';			
		
		$html.='<ul class="about-us">';
			if($address != '')
				$html.='<li><i class="fa fa-home"></i><span>'. esc_attr($address) .'</span></li>';				
			
			if($phone_number != '')
				$html.='<li><i class="fa fa-phone"></i><span>'. esc_attr($phone_number) .'</span></li>';
			
			if($fax_number != '')
				$html.='<li><i class="fa fa-print"></i><span>'. esc_attr($fax_number) .'</span></li>';
			
			if($email_address != ''):
				$html.='<li><i class="fa fa-envelope-o"></i><span>';
				if(is_email($email_address)){
					$html.='<a href="mailto:'. esc_attr($email_address).' ">'.esc_attr($email_address) .'</a>';
				}else{
					esc_html_e("Invalid Email Address","pl-emallshop-extensions");
				}
				$html.='</span>';
				$html.='</li>';
			endif;
			
			if($website != '')
				$html.='<li><i class="fa fa-globe"></i><span><a href="'.esc_url($website) .'">'.  $website .'</a></span></li>';
			
			if($days_hours != '')
				$html.='<li><i class="fa fa-clock-o"></i><span>'. esc_attr($days_hours) .'</span></li>';

		$html.='</ul>';
		$html.='</div>';
		
		echo $html;
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
		$instance['hide_title'] = (bool) $new_instance['hide_title'] ;
        $instance['logo_url'] = strip_tags( $new_instance['logo_url'] );
		$instance['our_site_url'] = strip_tags( $new_instance['our_site_url'] );
        $instance['about_tagline'] = strip_tags( $new_instance['about_tagline'] );
        $instance['address'] = strip_tags( $new_instance['address'] );
        $instance['phone_number'] = strip_tags( $new_instance['phone_number'] );
        $instance['fax_number'] = strip_tags( $new_instance['fax_number'] );
        $instance['email_address'] = strip_tags( $new_instance['email_address'] );
        $instance['website'] = strip_tags( $new_instance['website'] );
		$instance['days_hours'] = strip_tags( $new_instance['days_hours'] );
        return $instance;
    }
		
    function form( $instance ) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : esc_html__('About Us','pl-emallshop-extensions');
		$hide_title = isset($instance['hide_title']) ? (bool) $instance['hide_title'] : false;
		$logo_url = isset($instance['logo_url']) ? esc_attr($instance['logo_url']) : '';
		$our_site_url = isset($instance['our_site_url']) ? esc_attr($instance['our_site_url']) : '';
		$about_tagline = isset($instance['about_tagline']) ? esc_attr($instance['about_tagline']) : '';
		$address = isset($instance['address']) ? $instance['address'] : '';
		$phone_number = isset($instance['phone_number']) ? $instance['phone_number'] : '';
		$fax_number = isset($instance['fax_number']) ? $instance['fax_number'] : '';
		$email_address = isset($instance['email_address']) ? $instance['email_address'] : '';
		$website = isset($instance['website']) ? $instance['website'] : '';
		$days_hours = isset($instance['days_hours']) ? $instance['days_hours'] : '';
		
        emallshop_widget_input_text( esc_html__('Title:', 'pl-emallshop-extensions'), $this->get_field_id( 'title' ), $this->get_field_name( 'title' ), $title );
		emallshop_widget_input_checkbox(esc_html__('Hide Widget Title', 'pl-emallshop-extensions'), $this->get_field_id('hide_title'), $this->get_field_name('hide_title'),checked($hide_title, true, false), 1);
        emallshop_widget_input_text( esc_html__('Logo URL:', 'pl-emallshop-extensions'), $this->get_field_id( 'logo_url' ), $this->get_field_name( 'logo_url' ), $logo_url );
		emallshop_widget_input_text( esc_html__('Our Site URL:', 'pl-emallshop-extensions'), $this->get_field_id( 'our_site_url' ), $this->get_field_name( 'our_site_url' ), $our_site_url );
		emallshop_widget_textarea(esc_html__('About Tagline:', 'pl-emallshop-extensions'), $this->get_field_id('about_tagline'),$this->get_field_name('about_tagline'), $about_tagline);
        emallshop_widget_input_text( esc_html__('Address:', 'pl-emallshop-extensions'), $this->get_field_id( 'address' ), $this->get_field_name( 'address' ), $address );
        emallshop_widget_input_text( esc_html__('Phone Number:', 'pl-emallshop-extensions'), $this->get_field_id( 'phone_number' ), $this->get_field_name( 'phone_number' ), $phone_number );
		emallshop_widget_input_text( esc_html__('Fax Number:', 'pl-emallshop-extensions'), $this->get_field_id( 'fax_number' ), $this->get_field_name( 'fax_number' ), $fax_number );
        emallshop_widget_input_text( esc_html__('Email Address:', 'pl-emallshop-extensions'), $this->get_field_id( 'email_address' ), $this->get_field_name( 'email_address' ), $email_address );
		emallshop_widget_input_text( esc_html__('Website:', 'pl-emallshop-extensions'), $this->get_field_id( 'website' ), $this->get_field_name( 'website' ), $website );
        emallshop_widget_input_text( esc_html__('Working Days/Hours:', 'pl-emallshop-extensions'), $this->get_field_id( 'days_hours' ), $this->get_field_name( 'days_hours' ), $days_hours );		
    }
}

// **********************************************************************// 
// ! Newsletter Widget
// **********************************************************************// 
class EmallShop_Newsletter_Widget extends WP_Widget {
	
	public function __construct() {
		
         $widget_ops = array('classname' => 'emallshop_newsletter', 'description' => esc_html__('Display newsletter', 'pl-emallshop-extensions') );
		$control_ops = array('id_base' => 'emallshop-newsletter');		
        parent::__construct('emallshop-newsletter', 'EmallShop '.esc_html__('Newsletter', 'pl-emallshop-extensions'), $widget_ops, $control_ops);
	}

    function widget($args, $instance) {
        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? false : $instance['title']);
		$newsletter_tagline = apply_filters('newsletter_tagline', empty($instance['newsletter_tagline']) ? false : $instance['newsletter_tagline']);
		
        // About Us        
		echo $before_widget;
		if ( $title ) echo $before_title . $title . $after_title;?>	
			
		<div class="newsletter-widget">
		
			<?php if($newsletter_tagline != '')?>
				<p><?php echo esc_attr($newsletter_tagline);?></p>						
			
			<?php if( function_exists( 'mc4wp_show_form' ) ) {
				//echo do_shortcode($emallshop_options['newsletter_shortcode']);
				mc4wp_show_form();
			}?>
		</div>
			
		<?php echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );		
        $instance['newsletter_tagline'] = strip_tags( $new_instance['newsletter_tagline'] );       
        return $instance;
    }
		
    function form( $instance ) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : esc_html__('Newsletter','pl-emallshop-extensions');		
		$newsletter_tagline = isset($instance['newsletter_tagline']) ? esc_attr($instance['newsletter_tagline']) : '';		
		
        emallshop_widget_input_text( esc_html__('Title:', 'pl-emallshop-extensions'), $this->get_field_id( 'title' ), $this->get_field_name( 'title' ), $title );
		emallshop_widget_textarea(esc_html__('Newsletter Tagline:', 'pl-emallshop-extensions'), $this->get_field_id('newsletter_tagline'),$this->get_field_name('newsletter_tagline'), $newsletter_tagline);     	
    }
}

// **********************************************************************// 
// ! Stay Connected Widget
// **********************************************************************// 
class EmallShop_Stay_Connected_Widget extends WP_Widget {
	
	public function __construct() {
		
         $widget_ops = array('classname' => 'emallshop_stay_connected', 'description' => esc_html__('Display social link.', 'pl-emallshop-extensions') );
		$control_ops = array('id_base' => 'emallshop-stay-connected');		
        parent::__construct('emallshop-stay-connected', 'EmallShop '.esc_html__('Stay Connected', 'pl-emallshop-extensions'), $widget_ops, $control_ops);
	}

    function widget($args, $instance) {
        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? false : $instance['title']);
		$hide_title = (!empty($instance['hide_title'])) ? (bool) $instance['hide_title'] : false;
		$social_style = (!empty($instance['social_style'])) ?  $instance['social_style'] : 'style-1';
		
        // About Us        
		echo $before_widget;
		if ( $title && !$hide_title) echo $before_title . $title . $after_title;?>	
		
		<div class="stay-connected-widget <?php echo esc_attr($social_style);?>">
			<?php //Get Social link
			if ( function_exists( 'emallshop_social_link' ) ){
				emallshop_social_link();
			}?>
		</div>
			
		<?php echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
		$instance['hide_title'] = (bool) $new_instance['hide_title'] ;
		$instance['social_style'] = strip_tags( $new_instance['social_style'] );
		
        return $instance;
    }
		
    function form( $instance ) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : esc_html__('Stay Connected','pl-emallshop-extensions');
		$hide_title = isset($instance['hide_title']) ? (bool) $instance['hide_title'] : false;
		$social_style = isset($instance['social_style']) ? esc_attr($instance['social_style']) : 'style-1';
		
        emallshop_widget_input_text( esc_html__('Title:', 'pl-emallshop-extensions'), $this->get_field_id( 'title' ), $this->get_field_name( 'title' ), $title ); 
		emallshop_widget_input_checkbox(esc_html__('Hide Widget Title', 'pl-emallshop-extensions'), $this->get_field_id('hide_title'), $this->get_field_name('hide_title'),checked($hide_title, true, false), 1);
		$social_style_option = array('style-1'=>esc_html__('Style 1','pl-emallshop-extensions'), 'style-2'=>esc_html__('Style 2','pl-emallshop-extensions'));
		emallshop_widget_select(esc_html__('Social Style:', 'pl-emallshop-extensions'), $this->get_field_id('social_style'),$this->get_field_name('social_style'), $social_style,$social_style_option);
    }
}

// **********************************************************************// 
// ! Services Widget
// **********************************************************************// 
class EmallShop_Services_Widget extends WP_Widget {
	
	public function __construct() {
		
         $widget_ops = array('classname' => 'emallshop_services', 'description' => esc_html__('Display our service with different style.', 'pl-emallshop-extensions') );
		$control_ops = array('id_base' => 'emallshop-services');		
        parent::__construct('emallshop-services', 'EmallShop '.esc_html__('Our Services', 'pl-emallshop-extensions'), $widget_ops, $control_ops);
	}

    function widget($args, $instance) {
        extract($args);

        $title 				= apply_filters('widget_title', empty($instance['title']) ? false : $instance['title']);
		$show_title 		= (!empty($instance['show_title'])) ? (bool) $instance['show_title'] : false;
		$services_category 	= (!empty($instance['services_category'])) ?  $instance['services_category'] : '';
		$services_style 	= (!empty($instance['services_style'])) ?  $instance['services_style'] : 'style-1';
		
        // About Us        
		//Get Services
		$args = array(
				'post_type'				=> 'service',
				'post_status'			=> 'publish',
				'ignore_sticky_posts'	=> 1,
				'posts_per_page' 		=> 4,
			);			
		if(isset($services_category)):
			$args['tax_query']=array(
							array(
								'taxonomy' => 'service_cat',
								'field'    => 'id',
								'terms'    => $services_category,
								'operator' => 'IN'
							)
						);
		endif;
		
		$services = new WP_Query( $args );
		
		echo $before_widget;
		if ( $title && $show_title) echo $before_title . $title . $after_title;?>	
		
		<div class="services-widget <?php echo esc_attr($services_style);?>">
			<?php if ( $services->have_posts() ) : ?>
				<div class="row">
				<ul class="services">
					<?php while( $services->have_posts() ): $services->the_post();
					$service_meta = get_post_meta( get_the_ID());
					?>
						<?php if($services_style=='style-1'):?>
							<li class="service-item col-md-3 col-sm-6 col-xs-6">
								<?php if( isset( $service_meta['service_icon'] ) ):?>
									<span class="service-icon"><i class="fa <?php echo esc_attr($service_meta['service_icon'][0]);?> fa-2x"></i></span>
								<?php endif;?>
								<div class="service-content">
									<h5><?php the_title();?></h5>
									<?php the_content();?>
								</div>
							</li>
						<?php elseif($services_style=='style-2'):?>
							<li class="service-item col-md-3 col-sm-6 col-xs-6">
								<?php if( isset( $service_meta['service_icon'] ) ):?>
									<span class="service-icon"><i class="fa <?php echo esc_attr($service_meta['service_icon'][0]);?> fa-2x"></i></span>
								<?php endif;?>
								<div class="service-content">
									<h5><?php the_title();?></h5>
								</div>
							</li>
						<?php elseif($services_style=='style-3'):?>					
							<li class="service-item col-md-3 col-sm-6 col-xs-6">
								<?php if( isset( $service_meta['service_icon'] ) ):?>
									<span class="service-icon"><i class="fa <?php echo esc_attr($service_meta['service_icon'][0]);?> fa-2x"></i></span>
								<?php endif;?>
								<div class="service-content">
									<h5><?php the_title();?></h5>
									<?php the_content();?>
								</div>
							</li>
						<?php elseif($services_style=='vertica-style'):?>
							<li class="service-item">
								<?php if( isset( $service_meta['service_icon'] ) ):?>
									<span class="service-icon"><i class="fa <?php echo esc_attr($service_meta['service_icon'][0]);?> fa-2x"></i></span>
								<?php endif;?>
								<div class="service-content">
									<h5><?php the_title();?></h5>
									<?php the_content();?>
								</div>
							</li>
						<?php endif;?>
					<?php endwhile; // end of the loop. ?>
				</ul>
				</div>
			<?php endif;?>
		</div>
			
		<?php echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance 						= $old_instance;
        $instance['title'] 				= strip_tags( $new_instance['title'] );
		$instance['show_title'] 		= (bool) $new_instance['show_title'] ;
		$instance['services_category'] 	= strip_tags( $new_instance['services_category'] );
		$instance['services_style'] 	= strip_tags( $new_instance['services_style'] );
		
        return $instance;
    }
		
    function form( $instance ) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : __('Our Services','pl-emallshop-extensions');
		$show_title = isset($instance['show_title']) ? (bool) $instance['show_title'] : false;
		$services_category = isset($instance['services_category']) ? esc_attr($instance['services_category']) : '';
		$services_style = isset($instance['services_style']) ? esc_attr($instance['services_style']) : 'style-1';
		
		$args 			= array(
					'hierarchical' 	=> 0,
				    'hide_empty' 	=> 1,
				    'taxonomy' 		=> 'service_cat'
		);
		$service_cats 	= get_categories($args);
		$services_category_option=array();
		if(! empty( $service_cats ) ){
			foreach( $service_cats as $service_cat ){
				$services_category_option[$service_cat->term_id]=$service_cat->name;
			}
		}	
        emallshop_widget_input_text( esc_html__('Title:', 'pl-emallshop-extensions'), $this->get_field_id( 'title' ), $this->get_field_name( 'title' ), $title ); 
		emallshop_widget_input_checkbox(esc_html__('Show Widget Title', 'pl-emallshop-extensions'), $this->get_field_id('show_title'), $this->get_field_name('show_title'),checked($show_title, true, false), 1);		
		emallshop_widget_select(esc_html__('Services Category:', 'pl-emallshop-extensions'), $this->get_field_id('services_category'),$this->get_field_name('services_category'), $services_category,$services_category_option);		
		$social_style_option = array('style-1'=>esc_html__('Style 1','pl-emallshop-extensions'), 'style-2'=>esc_html__('Style 2','pl-emallshop-extensions'), 'style-3'=>esc_html__('Style 3','pl-emallshop-extensions'), 'vertica-style'=>esc_html__('Vertical Style','pl-emallshop-extensions'));
		emallshop_widget_select(esc_html__('Services Style:', 'pl-emallshop-extensions'), $this->get_field_id('services_style'),$this->get_field_name('services_style'), $services_style,$social_style_option);
    }
}

//function to convert text url into links.
function makeClickableLinks($s) {
  return preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a target="blank" rel="nofollow" href="$1" target="_blank">$1</a>', $s);
}
	
/* Forms
-------------------------------------------------------------- */
function emallshop_widget_label( $label, $id ) {
    echo "<label for='{$id}'>{$label}</label>";
}
function emallshop_widget_input_checkbox( $label, $id, $name, $checked, $value = 1 ) {
    echo "\n\t\t\t<p>";
    echo "<label for='{$id}'>";
    echo "<input type='checkbox' id='{$id}' value='{$value}' name='{$name}' {$checked} /> ";
    echo "{$label}</label>";
    echo '</p>';
}
function emallshop_widget_textarea( $label, $id, $name, $value ) {
    echo "\n\t\t\t<p>";
    emallshop_widget_label( $label, $id );
    echo "<textarea id='{$id}' name='{$name}' rows='3' cols='10' class='widefat'>" . strip_tags( $value ) . "</textarea>";
    echo '</p>';
}
function emallshop_widget_input_text( $label, $id, $name, $value ) {
    echo "\n\t\t\t<p>";
    emallshop_widget_label( $label, $id );
    echo "<input type='text' id='{$id}' name='{$name}' value='" . strip_tags( $value ) . "' class='widefat' />";
    echo '</p>';
}
function emallshop_widget_select( $label, $id, $name, $value, $options ) {
	echo "\n\t\t\t<p>";
	emallshop_widget_label( $label, $id );
	echo "<select name='{$name}' id='{$id}' class='widefat'>";
	foreach ($options as $key=>$option) { 
		echo "<option value=$key". selected($value,$key).">$option</option>";
	}
	echo '</select>';
	echo '</p>';
}

/*  QR Code generation
/* --------------------------------------------------------------------- */ 
if(!function_exists('emallshop_generate_qr_code')) {
    function emallshop_generate_qr_code($text='QR Code', $title = 'QR Code', $size = 128, $class = '', $self_link = false, $lightbox = false ) {
        if($self_link) {
            global $wp;
            $text = @(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
            if ( $_SERVER['SERVER_PORT'] != '80' )
                $text .= $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
            else 
                $text .= $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        }
        $image = 'https://chart.googleapis.com/chart?chs=' . $size . 'x' . $size . '&cht=qr&chld=H|1&chl=' . $text;

        if($lightbox) {
            $class .= 'fancybox';
            $output = '<a href="'.$image.'" data-fancybox-type="image" class="'.$class.'">'.$title.'</a>';
        } else{
            $class .= ' qr-code-image';
            $output = '<img src="'.$image.'"  class="'.$class.'" />';
        }
        return $output;
    }
}