<?php if(is_user_logged_in() && current_user_has_approve_bid()) :
    $wallet = get_user_meta(get_current_user_id(), 'wallets', true);
    $min_walllet = 999999999999;
    if($wallet){
        foreach(array_filter($wallet) as $key => $value){
            if($key == 74){
                $min_walllet = get_theme_mod('usdt_min');
            }
            if($key == 60){
                $min_walllet = get_theme_mod('etherium_min');
            }
            if($key == 52){
                $min_walllet = get_theme_mod('litecoin_min');
            }
            if($key == 11){
                $min_walllet = get_theme_mod('bitcoin_min');
            }
        }
    }
 ?>
    <div class="partner_cost">
        <div class="partner_cost_amount">Amount to withdraw: <span><?php echo wc_price(get_pending_total_by_user_id(get_current_user_id())); ?></span></div>
        <button class="partner_cost_button" data-user="<?php echo get_current_user_id(); ?>" id="partner_payment_button" <?php if(get_pending_total_by_user_id(get_current_user_id()) < $min_walllet){ echo 'disabled=""';} ?>>Order withdrawal</button>
    </div>
<?php endif; ?>
<?php
    global $post;
    $post_slug = $post->post_name;
?>

<div class="partner-menu">
    <button class="button"><img src="<?php echo get_template_directory_uri(); ?>/img/menu-icons/line-menu.svg" /><span>Menu Cabinet</span></button>
    <ul class="partner-menu-items partner-menu-mobile-hide">
        <li class="partner-menu-item">
            <a href="/partner/pfaq" class="<?php if($post_slug == 'pfaq'){echo 'partner-menu__active';} ?>">
                <div class="partner-menu-icon partner_menu_faq"></div>
                Answers on questions
            </a>
        </li>
        <li class="partner-menu-item">
            <a href="<?php echo home_url();?>/partner" class="<?php if($post_slug == 'partner' || $post_slug == 'offers' || $post_slug == 'new_offer'){echo 'partner-menu__active';} ?>">
                <div class="partner-menu-icon partner_menu_bids"></div>
                My bids
            </a>
        </li>

        <?php if(is_user_logged_in() && !current_user_has_approve_bid()) : ?>
            <li class="partner-menu-item">
                <div>
                    <div class="partner-menu-icon partner_menu_upload"></div>
                    Accounts upload
                </div>
            </li>
            <li class="partner-menu-item">
                <div>
                    <div class="partner-menu-icon partner_menu_payments"></div>
                    Payments
                </div>
            </li>
            <?php else : ?>
            <li class="partner-menu-item">
                <a href="<?php echo home_url();?>/partner/upload" class="<?php if($post_slug == 'upload'){echo 'partner-menu__active';} ?>">
                    <div class="partner-menu-icon partner_menu_upload"></div>
                    Accounts upload
                </a>
            </li>
            <li class="partner-menu-item">
                <a href="<?php echo home_url();?>/partner/payments" class="<?php if($post_slug == 'payments'){echo 'partner-menu__active';} ?>">
                    <div class="partner-menu-icon partner_menu_payments"></div>
                    Payments
                </a>
            </li>
        <?php endif; ?>

        <li class="partner-menu-item">
            <a href="<?php echo home_url();?>/partner/profile_settings" class="<?php if($post_slug == 'profile_settings'){echo 'partner-menu__active';} ?>">
                <div class="partner-menu-icon partner_menu_profile"></div>
                Profile settings
            </a>
        </li>
        <li class="partner-menu-item">
            <a href="<?php echo wp_logout_url( home_url('/') ); ?>" >
                <div class="partner-menu-icon partner_menu_logout"></div>
                Sign out
            </a>
        </li>
    </ul>
</div>