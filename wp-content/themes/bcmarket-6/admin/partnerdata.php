<?php 
if(is_user_logged_in()){
    $current_user = wp_get_current_user();
    $roles = array('administrator', 'employee');
    $found = 0; 
    foreach($roles as $role){
        if(in_array( $role, (array) $current_user->roles) ){
            $found = 1;
           
        }
    }

    if($found == 0){
         wp_redirect( home_url('/my/') );
            exit(); 
    }
    
}else{
    wp_redirect( home_url('/my/') );
    exit(); 
}
get_header(); ?>

<section class="soc-category" id="content">
    
    <?php get_template_part('template-parts/admin', 'breadcrumb'); ?>

    <div class="container">
        <div class="flex">
            <h1><?php the_title(); ?></h1>
           
            <?php get_template_part( 'admin/admin', 'menu'); ?>
            <div class="body _cabinet">

            	<div class="search_user_by">
            		
					<form action="<?php echo esc_url(home_url($wp->request)); ?>" method="GET">
						<input type="text" placeholder="Search by ID or Email" name="query" value="<?php echo isset($_GET['query']) ? esc_attr($_GET['query']) : ''; ?>">
						<button type="submit">Search</button>
					</form>

				</div>
             
                <?php 
					$current_url = esc_url_raw($_SERVER['REQUEST_URI']);
					$page_number = intval(preg_replace('/[^0-9]+/', '', $current_url), 10);

					$paged = $page_number == 0 ? 1 : $page_number;


					if (isset($_GET['query']) && !empty($_GET['query'])) {
						$args = array(
							'role__in' => array('partner'),
							'search' => $_GET['query'],
							'search_columns' => array('ID', 'user_email', 'user_login'),
						);
					} else {
						$args = array(
							'role__in' => array('partner'),
							'number' => 10,
							'paged' => $paged,
							'orderby' => 'user_registered', // Sort by user registration date
    						'order' => 'DESC', // Sort in descending order
						);
					}


					$user_query = new WP_User_Query($args);


					$users = $user_query->get_results();
					$total_users = $user_query->get_total();
					$total_pages = ceil($total_users / 10);

                    if($users) : ?>

		                <table class="bids list zebra ac">
		                    <tbody>
		                        <tr>
		                            <th>Id</th>
		                            <th>Balance</th>
		                            <th>Waller Info</th>
		                            <th>Minus</th>
		                            <th>Ban</th>
		                        </tr>

		                        <?php 
		                        foreach($users as $user) :
		                            
		                        	?>
		                        		<tr>
											
											<td><?php echo $user->ID; ?></td>
											<td><?php echo wc_price(get_pending_total_by_user_id($user->ID)); ?></td>
											<td>
												<?php 
												$user_id = $user->ID;


	                                            $wallets = get_user_meta($user_id, 'wallets', true);

	                                            $bitcoin_min = get_theme_mod('bitcoin_min');
					                            $litecoin_min = get_theme_mod('litecoin_min');
					                            $etherium_min = get_theme_mod('etherium_min');
					                            $usdt_min = get_theme_mod('usdt_min');


	                                            if($wallets) : foreach($wallets as $key => $value) :

	                                                $gat_name = '';

	                                                if($key == 52){
					                                    $gat_name = 'Litecoin (LTC)(min. $'. $litecoin_min .'):';
					                                }
					                                if($key == 74){
					                                    $gat_name = 'USDT(TRC20) (min. $'. $usdt_min .'):';
					                                }
					                                if($key == 11){
					                                    $gat_name = 'Bitcoin (BTC) (min. $'. $bitcoin_min .'):';
					                                }
					                                if($key == 60){
					                                    $gat_name = 'Etherium (ETH) (min. $'. $etherium_min .'):';
					                                }

					                                if(!empty($value)){
					                                	echo '<strong>'. $gat_name .'</strong>'; 
		                                                echo ' ';
		                                                echo $value; 
		                                                echo '<br>';
					                                }
	                                                

	                                            endforeach; endif; 
											 ?>
											 	
											 </td>
											<td>
												<form  class="deduct_partner_payment">
													<div class="deduct_payment_con">
														<input required type="date" name="cost">
														<button type="submit" class="btn btn-primary">Submit</button>
													</div>
													<input type="hidden" name="action" value="deduct_payment">
													<input type="hidden" name="partner_id" value="<?php echo $user->ID; ?>">
													<div class="deduct_msg"></div>
												</form>
											</td>
											<td>
												<?php if(get_user_meta($user->ID, 'account_status' , true) == 'rejected') : ?>
													<button data-id="<?php echo $user->ID; ?>" class="btn  btn-danger ">Banned</button>
													<button data-id="<?php echo $user->ID; ?>" class="btn  btn-danger rec_partner_account">Re-activate</button>
												<?php else : ?>
													 <input class="ban_inp" type="text" placeholder="Add Ban Reason">
	                                            	<button data-id="<?php echo $user->ID; ?>" class="btn  btn-danger ban_account">Ban</button>
	                                            <?php endif; ?>
											</td>
										</tr>
		                        	<?php 

		                        endforeach; ?>
		                       
		                    </tbody>
		                </table>

                <?php else : echo 'No partner found!'; endif; ?>

                <div class="pager_wrap" style="display:flex;justify-content:center;">

					<?php
						if ($total_pages > 1) {
							$pagination_args = array(
								'base' => get_pagenum_link(1) . '%_%',
								'format' => 'page/%#%',
								'current' => $paged,
								'total' => $total_pages,
								'prev_text' => __('&laquo; Prev'),
								'next_text' => __('Next &raquo;'),
							);

							echo '<div class="pagination">';
							echo paginate_links($pagination_args);
							echo '</div>';
						}
					?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer() ?>