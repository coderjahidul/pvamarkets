<div class="partner-menu">
    <button class="button"><img src="<?php echo get_template_directory_uri(); ?>/img/menu-icons/line-menu.svg" /><span>Menu Cabinet</span></button>
    <ul class="partner-menu-items partner-menu-mobile-hide">

        <li class="partner-menu-item">
            <a href="<?php echo home_url();?>/admin-interface/" class="<?php if($_SERVER['REQUEST_URI'] == '/admin-interface/'){echo 'partner-menu__active';} ?>">All</a>
        </li>
        <li class="partner-menu-item">
            <a href="<?php echo home_url();?>/admin-interface/bid-request/" class="<?php if(get_query_var('bid-request')){echo 'partner-menu__active';} ?>">Bid Request</a>
        </li>
        <li class="partner-menu-item">
            <a href="<?php echo home_url();?>/admin-interface/admin-chat/" class="<?php if(get_query_var('admin-chat')){echo 'partner-menu__active';} ?>">Admin Chat
            <span class="badge_count" style="color:red; margin-left:8px;font-size:8px;background-color:red;border-radius:50%;color:#fff;padding:3px;">
             <?php 
                		$args = array(
        				'post_type' => 'tickets',
        				'posts_per_page' => -1,
        				'paged' => $paged
        				
        			);

		     	$tickets_query = new WP_Query($args); 
		     	global $wpdb;
    	     	$table = $wpdb->prefix.'ticket_chats';
				$countBadge = 0 ;
		                	while($tickets_query->have_posts()) : $tickets_query->the_post();
		                	

		                		$ticket_id = get_the_ID();
		                		$chat_read = 1; 
		                	

		                		$results = $wpdb->get_results( "SELECT * FROM $table WHERE ticket_id = $ticket_id  AND from_user = 1 ORDER BY id DESC LIMIT 1" );
		               

		                		if($results){
		                			foreach($results as $item){
		                				if($item->chat_read != 1){
		                					$chat_read = 0;
		                				}
		                			}
		                		}else{
		                			$chat_read = get_post_meta(get_the_ID(), 'unread', true);
		                		}

		                	  if($chat_read == 0){
			                        
			                        $countBadge++ ;
			                    } 

                 endwhile ;
                // $totalChat = get_option( 'totalTicket' );
                
                if($countBadge > 0){
                    echo $countBadge;
                }else{
                    echo 0;
                }
                ?>
                </span>
            </a>
        </li>
        <li class="partner-menu-item">
            <a href="<?php echo home_url();?>/admin-interface/payment/" class="<?php if(get_query_var('payment')){echo 'partner-menu__active';} ?>">Payment</a>
        </li>
        <li class="partner-menu-item">
            <a href="<?php echo home_url();?>/admin-interface/partnerdata/" class="<?php if(get_query_var('partnerdata')){echo 'partner-menu__active';} ?>">Partner</a>
        </li>
        <li class="partner-menu-item">
            <a href="<?php echo home_url();?>/admin-interface/buyerdata/" class="<?php if(get_query_var('buyerdata')){echo 'partner-menu__active';} ?>">Buyer</a>
        </li>
        <li class="partner-menu-item">
            <a href="<?php echo home_url();?>/admin-interface/itemdata/" class="<?php if(get_query_var('itemdata')){echo 'partner-menu__active';} ?>">Items</a>
        </li>
        <li class="partner-menu-item">
            <a href="<?php echo home_url();?>/admin-interface/aorders/" class="<?php if(get_query_var('aorders')){echo 'partner-menu__active';} ?>">Orders</a>
        </li>
    </ul>
</div>