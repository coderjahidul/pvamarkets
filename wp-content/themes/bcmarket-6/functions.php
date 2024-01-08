<?php 
function bcmarket_setup() {


	load_theme_textdomain( 'bcmarket', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'woocommerce' );

	register_nav_menus(
		array(
			'top_menu' => __( 'Top Menu', 'bcmarket' ),
			'main_menu' => __( 'Main Menu', 'bcmarket' ),
            'partner_menu' => __( 'Partner Menu', 'bcmarket' ),
            'admin_menu' => __( 'Admin Menu', 'bcmarket' ),
            'footer_menu' => __( 'Footer Menu', 'bcmarket' ),
		)
	);


	add_theme_support('custom-logo');
	add_theme_support('post-thumbnails');

	if (!current_user_can('administrator') && !is_admin()) {
	  show_admin_bar(false);
	}


	if ( post_type_exists( 'product' ) ) {
		add_post_type_support( 'product', 'author' );
	}


	add_image_size('blog', 440, 522, true);

	add_image_size('blog_post', 560, 385, true);


	remove_theme_support( 'widgets-block-editor' );

}

add_action( 'after_setup_theme', 'bcmarket_setup' );

add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**

 * Enqueue scripts and styles.

 */



function bcmarket_scripts() {

    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/new/bootstrap.min.css');
    wp_enqueue_style('minf1bc', get_template_directory_uri() . '/css/new/style.minf1bc.css');
    wp_enqueue_style('selectize', 'https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.14.0/css/selectize.css');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css');

	wp_enqueue_style( 'bcmarket-style', get_stylesheet_uri() );

    wp_enqueue_style('admincss', get_template_directory_uri() . '/css/admin.css',array() ,time());

    if(is_checkout()){
        wp_enqueue_style('checkout', get_template_directory_uri() . '/css/checkout.css');
    }

    wp_enqueue_style('responsive', get_template_directory_uri() . '/css/responsive.css');
    wp_enqueue_style('sweet_alert_css', get_template_directory_uri() . '/css/sweetalert2.min.css');
    


    wp_enqueue_script('md5', get_template_directory_uri() . '/js/md5.min.js');
    wp_enqueue_script('min4b23', get_template_directory_uri() . '/js/lang/en.min4b23.js');
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/new/bootstrap.min.js', array('jquery'), '', true);
    wp_enqueue_script('scrollTo', get_template_directory_uri() . '/js/jquery.scrollTo.min.js', array('jquery'), '', true);
    wp_enqueue_script('select2f', get_template_directory_uri() . '/js/select2/dist/js/select2.full.min.js', array('jquery'), '', true);
    wp_enqueue_script('common2', get_template_directory_uri() . '/js/new/common2.min.js', array('jquery'), '', true);
    wp_enqueue_script('jqueryuii', get_template_directory_uri() . '/js/jquery-ui/jquery-ui.min.js', array('jquery'), '', true);
    wp_enqueue_script('easingj', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array('jquery'), '', true);
    wp_enqueue_script('select2ru', get_template_directory_uri() . '/js/select2/dist/js/i18n/ru.js', array('jquery'), '', true);
    wp_enqueue_script('selectize', 'https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.14.0/js/standalone/selectize.js', array('jquery'), '', true);
    wp_enqueue_script('commonmin2333', get_template_directory_uri() . '/js/common.min2333.js', array('jquery'), time(), true);
    wp_enqueue_script('min0cbd', get_template_directory_uri() . '/js/default.min0cbd.js', array('jquery'), '', true);
    wp_enqueue_script('tooltipster', get_template_directory_uri() . '/js/tooltipster.bundle.min.js', array('jquery'), '', true);
      wp_enqueue_script('sweet_alert_all_min', get_template_directory_uri() . '/js/sweetalert2.all.min.js', array('jquery'), time(), true);
    wp_enqueue_script('sweet_alert', get_template_directory_uri() . '/js/sweetalert2.min.js', array('jquery'), time(), true);
    wp_enqueue_script('custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), time(), true);
    

    wp_enqueue_script('admin-interface', get_template_directory_uri() . '/js/admin.js', array('jquery'), time(), true);

     wp_localize_script( 'min0cbd', 'my_ajax_object', array( 
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'template_url' => get_template_directory_uri()
     ));

     wp_localize_script( 'commonmin2333', 'my_ajax_object', array( 
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'template_url' => get_template_directory_uri()
     ));

     wp_localize_script( 'admin-interface', 'my_ajax_object', array( 
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'template_url' => get_template_directory_uri()
    ) );


    wp_dequeue_style('wp-block-library');
   
}

add_action( 'wp_enqueue_scripts', 'bcmarket_scripts' );


// Register POst types
function bcmarket_setup_post_type() {

    
   $args = array(
        'public'    => true,
        'label'     => __( 'FAQ', 'bcmarket' ),
        'exclude_from_search' => true,
        'show_in_admin_bar'   => false,
        'show_in_nav_menus'   => false,
        'publicly_queryable'  => false,
        'query_var'           => false, 
        'supports' => array('title', 'editor')

    );
    register_post_type( 'faq', $args );

    $args = array(
        'label'        => __( 'FAQ Category', 'bcmarket' ),
        'public'       => true,
        'hierarchical' => true
    );

    register_taxonomy( 'faq-category', 'faq', $args );

    $args = array(
        'public'    => true,
        'label'     => __( 'Bids', 'bcmarket' ),
        'exclude_from_search' => true,
        'show_in_admin_bar'   => false,
        'show_in_nav_menus'   => false,
        'publicly_queryable'  => false,
        'query_var'           => false, 
        'supports' => array('title', 'editor')

    );
    register_post_type( 'bids', $args );

    $args = array(
        'public'    => true,
        'label'     => __( 'Tickets', 'bcmarket' ),
        'exclude_from_search' => true,
        'supports' => array('title', 'editor'), 
        'rewrite' => array('slug' => 'tickets/view')

    );
    register_post_type( 'tickets', $args );

    $args = array(
        'public'    => true,
        'label'     => __( 'Payment Request', 'bcmarket' ),
        'exclude_from_search' => true,
        'show_in_admin_bar'   => false,
        'show_in_nav_menus'   => false,
        'publicly_queryable'  => false,
        'query_var'           => false, 
        'supports' => array('title', 'editor')

    );
    register_post_type( 'payment', $args );

    $args = array(
        'public'    => true,
        'label'     => __( 'Items', 'bcmarket' ),
        'supports' => array('title', 'editor', 'thumbnail'), 
        'rewrite' => array('slug' => 'item'), 

    );
    register_post_type( 'item', $args );

    $args = array(
        'label'        => __( 'Category', 'textdomain' ),
        'public'       => true,
        'hierarchical' => true, 
        'rewrite'      => array( 'slug' => 'catalog' )
    );
    
    register_taxonomy( 'item_cat', 'item', $args );
}

add_action( 'init', 'bcmarket_setup_post_type' );


// Add Classes to Menus
add_filter('nav_menu_link_attributes', 'bcmarket_custom_nav_menu_link_attributes', 10, 4);
function bcmarket_custom_nav_menu_link_attributes($atts, $item, $args, $depth){
    if ($item->ID == 52){
        $class = "important_link";
        $atts['class'] = (!empty($atts['class'])) ? $atts['class'].' '.$class : $class; 
    }
     if ($item->ID == 53){
        $class = "ic-provider";
        $atts['class'] = (!empty($atts['class'])) ? $atts['class'].' '.$class : $class; 
    }

    return $atts;
}


add_action( 'init', 'bcmarket_add_customrewrite_emdpoint' );
function bcmarket_add_customrewrite_emdpoint() {
    
    add_rewrite_endpoint( 'partnerdata', EP_PAGES );
    add_rewrite_endpoint( 'buyerdata', EP_PAGES );
    add_rewrite_endpoint( 'view', EP_PAGES );
    add_rewrite_endpoint( 'pticket', EP_PAGES );
    add_rewrite_endpoint( 'itemdata', EP_PAGES );
    add_rewrite_endpoint( 'payment', EP_PAGES );
    add_rewrite_endpoint( 'admin-chat', EP_PAGES );
    add_rewrite_endpoint( 'bid-request', EP_PAGES );
    add_rewrite_endpoint( 'aorders', EP_PAGES );
       
}

add_filter('request', function($vars) {

    if (isset($vars['partnerdata'])) {
        $vars['partnerdata'] = true;
    }
    if (isset($vars['buyerdata'])) {
        $vars['buyerdata'] = true;
    } 
    if (isset($vars['view'])) {
        $vars['view'] = true;
    }
    if (isset($vars['pticket'])) {
        $vars['pticket'] = true;
    } 
    if (isset($vars['itemdata'])) {
        $vars['itemdata'] = true;
    }
    if (isset($vars['payment'])) {
        $vars['payment'] = true;
    }
    if (isset($vars['admin-chat'])) {
        $vars['admin-chat'] = true;
    }
    if (isset($vars['bid-request'])) {
        $vars['bid-request'] = true;
    }
    if (isset($vars['aorders'])) {
        $vars['aorders'] = true;
    }

    return $vars;
});


add_filter('template_include', function($template) {
    
    
    if (get_query_var('partnerdata') && strpos( $_SERVER['REQUEST_URI'], 'admin-interface') !== false) {
        $post = get_queried_object();
        return locate_template(['admin/partnerdata.php']);
    }
    if (get_query_var('buyerdata') && strpos( $_SERVER['REQUEST_URI'], 'admin-interface') !== false) {
        $post = get_queried_object();
        return locate_template(['admin/buyerdata.php']);
    }
    if (get_query_var('view')) {
        $post = get_queried_object();
        return locate_template(['partner/view.php']);
    }
    if (get_query_var('pticket')) {
        $post = get_queried_object();
        return locate_template(['partner/ticket.php']);
    }
    if (get_query_var('itemdata') && strpos( $_SERVER['REQUEST_URI'], 'admin-interface') !== false) {
        $post = get_queried_object();
        return locate_template(['admin/itemdata.php']);
    }
    if (get_query_var('payment') && strpos( $_SERVER['REQUEST_URI'], 'admin-interface') !== false) {
        $post = get_queried_object();
        return locate_template(['admin/payment-request.php']);
    }
    if (get_query_var('admin-chat') && strpos( $_SERVER['REQUEST_URI'], 'admin-interface') !== false) {
        $post = get_queried_object();
        return locate_template(['admin/admin-chat.php']);
    }
    if (get_query_var('bid-request') && strpos( $_SERVER['REQUEST_URI'], 'admin-interface') !== false) {
        $post = get_queried_object();
        return locate_template(['admin/bid-request.php']);
    }
    if (get_query_var('aorders') && strpos( $_SERVER['REQUEST_URI'], 'admin-interface') !== false) {
        $post = get_queried_object();
        return locate_template(['admin/orders.php']);
    }


    return $template;
});




require get_template_directory() . '/inc/auth.php';
require get_template_directory() . '/inc/search.php';
require get_template_directory() . '/inc/woocommerce.php';
require get_template_directory() . '/inc/product-buy.php';
require get_template_directory() . '/inc/accounts.php';
require get_template_directory() . '/inc/partner-functions.php';
require get_template_directory() . '/inc/admin-functions.php';
require get_template_directory() . '/inc/tickets.php';
require get_template_directory() . '/inc/customizer.php';

function get_total_pcs_by_item($item_id){

    $args = array(
        'role__in' => array('partner', 'Administrator'),
        'number' => 50,
    );

    $user_query = new WP_User_Query( $args );
    $users = $user_query->get_results();

    $total_items = array();

    if($users){

        foreach($users as $user){

            $partner_id = $user->ID; 

            $pro_query = new WP_Query(array(
                'post_type' => 'product', 
                'posts_per_page' => -1, 
                'author' => $partner_id,
                'post_status' => 'publish', 
                'meta_query' => array(
                    array(
                        'key' => 'item_id', 
                        'value' => $item_id
                    ), 
                    array(
                        'key' => 'bid_status', 
                        'value' => 'onsale'
                    )
                )
            ));

            if($pro_query->have_posts()) :

                $partner_total_arr = array();

                while($pro_query->have_posts()) : $pro_query->the_post(); 

                    $partner_total_arr[] = total_free_accounts_by_id(get_the_ID());

                endwhile; wp_reset_postdata();

                $total_items[] = array_sum($partner_total_arr);

            endif; 

        }
    }

    if(count($total_items) > 0){
        return array_sum($total_items);
    }else{
        return 0;
    }

}

function get_per_pcs_by_item($item_id){

    $args = array(
        'role__in' => array('partner', 'Administrator'),
        'number' => 50,
    );

    $user_query = new WP_User_Query( $args );
    $users = $user_query->get_results();

    $per_items = array();

    if($users){

        foreach($users as $user){

            $partner_id = $user->ID; 

            $pro_query = new WP_Query(array(
                'post_type' => 'product', 
                'posts_per_page' => -1, 
                'author' => $partner_id,
                'post_status' => 'publish', 
                'meta_query' => array(
                    array(
                        'key' => 'item_id', 
                        'value' => $item_id
                    ), 
                    array(
                        'key' => 'bid_status', 
                        'value' => 'onsale'
                    )
                )
            ));

            if($pro_query->have_posts()) :

                while($pro_query->have_posts()) : $pro_query->the_post(); 
                    $product = wc_get_product( get_the_ID() );
                    $per_items[] = $product->get_price();

                endwhile; wp_reset_postdata();


            endif; 

        }
    }

    if(count($per_items) > 0){
        $min_price = min($per_items);
        update_option('min_product_price', $min_price);
        return $min_price;
    }else{
        $saved_price = get_option('min_product_price');
       return $saved_price;
    }

}


function get_available_partner_by_item($item_id){

    $args = array(
        'role__in' => array('partner', 'Administrator'),
        'number' => 50,
    );

    $user_query = new WP_User_Query( $args );
    $users = $user_query->get_results();

    $availale_users = array();

    if($users){

        foreach($users as $user){

            $partner_id = $user->ID; 

            $pro_query = new WP_Query(array(
                'post_type' => 'product', 
                'posts_per_page' => 100, 
                'post_status' => 'publish', 
                'author' => $partner_id,
                'post_status' => 'publish', 
                'meta_query' => array(
                    array(
                        'key' => 'item_id', 
                        'value' => $item_id
                    ), 
                    array(
                        'key' => 'bid_status', 
                        'value' => 'onsale'
                    )
                )
            ));

            $total_items = 0;
            $item_price = array();
            $product_ids= array();

            if($pro_query->have_posts()) :

                $partner_total_arr = array();

                while($pro_query->have_posts()) : $pro_query->the_post(); 
                    $product = wc_get_product( get_the_ID() );
                    $partner_total_arr[] = total_free_accounts_by_id(get_the_ID());
                    $item_price[] = $product->get_price();
                    $product_ids[] = get_the_ID();
                endwhile; wp_reset_postdata();

                $total_items = array_sum($partner_total_arr);

            endif; 


            if($total_items > 0){

                $min_price = min($item_price);

                $availale_users[] = array(
                    'user_id' => $partner_id, 
                    'qty' => $total_items,
                    'price' => $min_price,
                    'product_ids' => implode(',', $product_ids)
                ); 

            }

        }
    }

    return $availale_users;

}


function acccincrease_wp_search_query_length( $query ) {
    if ( isset( $query->query_vars['s'] ) && strlen( $query->query_vars['s'] ) > 225 ) {
        $query->query_vars['s'] = substr( $query->query_vars['s'], 0, 500 );
    }
}
add_action( 'parse_query', 'acccincrease_wp_search_query_length' );


// Add custom column
function my_custom_post_type_columns( $columns ) {
    $columns['custom_product_id'] = 'Custom Product Id';
    return $columns;
}
add_filter( 'manage_product_posts_columns', 'my_custom_post_type_columns' );
// Populate custom column with meta key value
function my_custom_post_type_column_content( $column_name, $post_id ) {
    if ( $column_name == 'custom_product_id' ) {
        $meta_value = get_post_meta( $post_id, 'custom_product_id', true );
        echo $meta_value;
    }
}
add_action( 'manage_product_posts_custom_column', 'my_custom_post_type_column_content', 10, 2 );

add_filter( 'posts_search', 'extend_product_search', 20, 2 );
function extend_product_search( $where, $query ) {
    global $pagenow, $wpdb;

    if ( 'edit.php' != $pagenow || ! is_search() || ! isset( $query->query_vars['s'] ) || 'product' != $query->query_vars['post_type'] ) {
        return $where;
    }
    // Here your post meta keys
    $meta_keys = array('custom_product_id', '_sku_2');
    $meta_keys = implode("','", $meta_keys);
    // get the search value
    $term      = sanitize_text_field( $query->query_vars['s'] );
    // Light SQL Query to get the corresponding product IDs 
    $search_ids = $wpdb->get_col( "SELECT ID FROM {$wpdb->prefix}posts as p
        LEFT JOIN {$wpdb->prefix}postmeta as pm ON p.ID = pm.post_id
        WHERE pm.meta_key IN ('$meta_keys') AND pm.meta_value LIKE '%$term%'" );
    // Cleaning
    $search_ids = array_filter( array_unique( array_map( 'absint', $search_ids ) ) );
    // Alter the WHERE clause in the WP_Query search
    if ( count( $search_ids ) > 0 ) {
        $where = str_replace( 'AND (((', "AND ( ({$wpdb->posts}.ID IN (" . implode( ',', $search_ids ) . ")) OR ((", $where );
    }
    return $where;
}





// add_action( 'phpmailer_init', 'my_phpmailer_smtp' );
// function my_phpmailer_smtp( $phpmailer ) {
//     $phpmailer->isSMTP();     
//     $phpmailer->Host = SMTP_server;  
//     $phpmailer->SMTPAuth = SMTP_AUTH;
//     $phpmailer->Port = SMTP_PORT;
//     $phpmailer->Username = SMTP_username;
//     $phpmailer->Password = SMTP_password;
//     $phpmailer->SMTPSecure = SMTP_SECURE;
//     $phpmailer->From = SMTP_FROM;
//     $phpmailer->FromName = SMTP_NAME;
// }


add_action('woocommerce_admin_order_data_after_billing_address', 'add_custom_field_to_order');
function add_custom_field_to_order($order)
{
    // Get the meta value of the custom field
    $custom_field_value = get_post_meta($order->get_id(), 'item_id_data', true);

    // Output the custom field HTML
    echo '<p class="form-field form-field-wide">
    <label for="custom_field_name">Item ID:</label>
    <input type="text" class="wide-fat" id="custom_field_name" name="item_id_data" value="' . esc_attr($custom_field_value) . '" />
</p>';
}

function enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'enqueue_font_awesome');






