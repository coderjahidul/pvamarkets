<?php  if ( ! defined( 'ABSPATH' ) )  exit;

class EmallShop_Verify_Purchase {

    private $theme_name = '';
    private $api_url = '';
    private $ignore_key = 'presslayouts_notice';
    public $information;
    public $api_key;
    public $notices;


    function __construct() {
        $theme_data = wp_get_theme('emallshop');
        $activated_data = get_option( 'emallshop_activated_data' );
        $this->current_version = $theme_data->get('Version');
        $this->theme_name = strtolower($theme_data->get('Name'));
        $this->api_url = EMALLSHOP_API;
        $this->api_key = ( ! empty( $activated_data['api_key'] ) ) ? $activated_data['api_key'] : false;

        add_action('admin_init', array($this, 'dismiss_notices'));
        add_action('admin_notices', array($this, 'show_notices'), 50 );

        if( ! emallshop_is_activated() ) {
            add_action( 'admin_menu', array( $this, 'activation_page_menu' ) );           
            return;
        }

        add_action( 'switch_theme', array( $this, 'update_dismiss' ) );
        
        add_filter( 'themes_api', array(&$this, 'api_results'), 10, 3);

    }

    public function activation_page_menu() {
        add_menu_page( 
            __( 'EmallShop Active', 'emallshop' ), 
            __( 'EmallShop Active', 'emallshop' ), 
            'manage_options', 
            'emallshop_activation_page', 
            array( $this, 'activation_page' ),
            EMALLSHOP_IMAGES . '/icon-theme.png',
            62 
        );
    }

    public function activation_page() {
        $this->process_form();
        ?>
            <h1><?php esc_html_e( 'Activate Theme', 'emallshop' ); ?></h1>
            <?php if ( emallshop_is_activated() ): ?>
                <div class="emallshop-options-success">
                    <p><strong><?php esc_html_e('Thank you for activation','emallshop');?></strong></p>
                    <p><?php esc_html_e('Now you have lifetime updates, 6 months of free top-notch support, 18/7 live support and much more.','emallshop');?></p>
                </div>
            <?php else: ?>
                <p><?php esc_html_e('Use your purchase code to activate PressLayouts template. Please, note, that you won’t be able to use it without activation.', 'emallshop'); ?></p>
                <p><?php esc_html_e('To find your Purchase code, please, enter your ThemeForest account > Downloads tab > choose PressLayouts > Download > License Certificate & Purchase code', 'emallshop'); ?> <a href="http://prntscr.com/gvx076" target="_blank">http://prntscr.com/gvx076</a></p>
                <p><?php esc_html_e('Activate PressLayouts template and get lifetime updates, 6 months of free top-notch support, 18/7 live support and much more.', 'emallshop'); ?></p>
                <form action="" class="emallshop-form" method="post">
                    <p>
                        <label for="purchase-code"><?php esc_html_e('Purchase code', 'emallshop'); ?></label>
                        <input type="text" name="purchase-code" placeholder="Example: bced85eb-546e-420e-8966-9984d043bbe1" id="purchase-code" />
                    </p>
                    <p>
                            <input class="button-primary" name="emallshop-purchase-code" type="submit" value="<?php esc_attr_e( 'Activate theme', 'emallshop' ); ?>" />

                    </p>
                </form>

                <p><img src="<?php echo EMALLSHOP_ADMIN_IMAGES . '/purchase.jpg'; ?>" alt="purchase"></p>
            <?php endif ?>
        <?php 
    }

    public function show_notices() {
        global $current_user;
        $user_id = $current_user->ID;
        if( ! empty( $this->notices ) ) {
            foreach ($this->notices as $key => $notice) {
                if ( ! get_user_meta($user_id, $this->ignore_key . $key) ) {
                    echo '<div class="updated emallshop-notification">'; 
                    echo $notice['message'];
                    echo "</div>";
                }
            }
        }
    }

    public function dismiss_notices() {
        global $current_user;
        $user_id = $current_user->ID;
        if ( isset( $_GET['es-hide-notice'] ) && isset( $_GET['_es_notice_nonce'] ) ) {
            if ( ! wp_verify_nonce( $_GET['_es_notice_nonce'], 'emallshop_hide_notices_nonce' ) ) {
                return;
            }

            add_user_meta($user_id, $this->ignore_key . '_' . $_GET['es-hide-notice'], 'true', true);
        }
    }

    public function update_dismiss() {
        global $current_user;
        #$user_id = $current_user->ID;
        #delete_user_meta($user_id, $this->ignore_key);
    }

    public function api_results($result, $action, $args) {    

        if( isset( $args->slug ) && $args->slug == $this->theme_name && $action == 'theme_information') {
            if( is_object( $this->information ) && ! empty( $this->information ) ) {
                $result = $this->information;
            }
        }

        return $result;
    }
	
    public function activate( $purchase, $args ) {

        $data = array(
            'api_key' => $args['token'],
            'theme' => EMALLSHOP_PREFIX,
            'purchase' => $purchase,
        );

        foreach ( $args as $key => $value ) {
           $data['item'][$key] = $value;
        }

        update_option( 'emallshop_activated_data', maybe_unserialize( $data ) );
        update_option( 'emallshop_is_activated', true );
    }

    public function process_form() {
        if( isset( $_POST['emallshop-purchase-code'] ) && ! empty( $_POST['emallshop-purchase-code'] ) ) {
            $code = trim( $_POST['purchase-code'] );

            if( empty( $code ) ) {
               echo  '<p class="error">Enter the purchase code</p>';
                return;
            }

            $theme_id = 18513022;
            $response = wp_remote_get( $this->api_url . 'activate/' . $code . '?envato_id='. $theme_id );
            $response_code = wp_remote_retrieve_response_code( $response );
			
            if( $response_code != '200' ) {
                echo  '<p class="error">API request call error. Contact your server providers and ask to update OpenSSL system library to the 1.0 version</p>';
                return;
            }

            $data = json_decode( wp_remote_retrieve_body($response), true );

            if( isset( $data['error'] ) ) {
               echo  '<p class="error">' . $data['error'] . '</p>';
                return;
            } 

            if( ! $data['verified'] ) {
               echo  '<p class="error">Code is not verified!</p>';
                return;
            }

            $this->activate( $code, $data );

            $redirect_url = ( class_exists( 'Redux' ) ) ? admin_url( 'themes.php?page=theme_options' ) : admin_url( 'themes.php?page=es-install-plugins' ) ;

             echo  '<p class="updated">Theme is activated! You will be redirected in a few seconds
                <script type="text/javascript"> setTimeout( function() { window.location.href = "' . $redirect_url . '"; }, 3000 ); </script>
             </p>';

        }
    }

}

if(!function_exists('emallshop_check_verify_purchase')) {
    add_action('init', 'emallshop_check_verify_purchase');
    function emallshop_check_verify_purchase() {
        new EmallShop_Verify_Purchase();
    }
}