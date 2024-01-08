<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @subpackage EmallShop
 * @since EmallShop 1.0
 */

?>
<footer id="footer" class="footer">
	
	<div class="footer-middle">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-3">					
					<?php dynamic_sidebar('footer-widget-area-1');?>
				</div>
				<div class="col-sm-6 col-md-3">
					<?php dynamic_sidebar('footer-widget-area-2');?>
				</div>
				<div class="col-sm-6 col-md-3">
					<?php dynamic_sidebar('footer-widget-area-3');?>
				</div>
				<div class="col-sm-6 col-md-3">
					<?php dynamic_sidebar('footer-widget-area-4');?>					
				</div>
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="popular-categories">
						<?php $footer_categories=emallshop_get_option('footer-categories', array());
						if(!empty($footer_categories)):?>
							<?php foreach($footer_categories as $cat_ID):
									$args=array('child_of' =>$cat_ID , 'taxonomy'=> 'product_cat','number' => 10, 'title_li'=>''); ?>
									
									<ul class="categories-list">
									<li class="cate_title"><?php echo get_the_category_by_ID( $cat_ID );?>: </li>
									<?php wp_list_categories( $args ); ?>
									</ul>
							<?php endforeach; ?>
						<?php endif;?>
					</div>
				</div>				
			</div>
		</div>
	</div>
	<div class="footer-copyright">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<p><?php echo force_balance_tags(emallshop_get_option('copyright-text',esc_html__('&copy; 2016 presslayouts.com. All Rights Reserved.','emallshop')));?></p>
				</div>
				<div class="col-xs-12 col-sm-6 text-right">
					<?php if(emallshop_get_option('show-payments-logo',1)):?>
						<div class="payments-method">
							<?php $payments_url=emallshop_get_option('payments-logo',array( 'url' => EMALLSHOP_IMAGES.'/payments-method.png'));?>
							<img src="<?php echo esc_url($payments_url['url']);?>" alt="Payments">
						</div>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
</footer><!-- .site-footer -->