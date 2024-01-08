<?php 
/**
 * @author  PressLayouts
 * @package PL EmallShop Extensions
 * @version 1.0.0
 */
 
class EmallShop_Post_Content{
	
	function __construct() {

		add_action('init', array( $this, 'emallshop_addTestimonialContentType' ) );
		//add_action('init', array( $this, 'addServicesContentType' ) );
        add_action('init', array( $this, 'emallshop_addPortfolioContentType' ) );
		add_action('init', array( $this, 'emallshop_addProductBrand' ) );
		
		add_action('admin_enqueue_scripts', array( $this,'emallshop_admin_scripts' ) );
		//add_action( 'admin_head', array( $this, 'emallshop_admin_head_style') );
		//add_action( 'admin_footer', array( $this, 'emallshop_admin_footer_script') );
		
		// Add Brand Image Field 
		add_action( 'product_brand_add_form_fields', array( $this, 'emallshop_add_brand_fields' ) );
		add_action( 'product_brand_edit_form_fields', array( $this, 'emallshop_edit_brand_fields' ), 10, 2 );
		add_action( 'created_term', array( $this, 'save_brand_fields' ), 10, 3 );
		add_action( 'edit_term', array( $this, 'save_brand_fields' ), 10, 3 );
		
		// Add Brand Image Columns
		add_filter( 'manage_edit-product_brand_columns', array( $this, 'product_brand_columns' ) );
		add_filter( 'manage_product_brand_custom_column', array( $this, 'product_brand_column' ), 10, 3 );
		
		// Add Product Category Banner Image
		add_action( 'product_cat_add_form_fields', array( $this, 'emallshop_add_prod_cat_banner_fields' ), 10, 2 );
		add_action( 'product_cat_edit_form_fields', array( $this, 'emallshop_edit_prod_cat_banner_fields' ),10 ,2 );
		add_action( 'created_term', array( $this, 'emallshop_save_prod_cat_banner_fields' ), 10, 3  );
		add_action( 'edit_term', array( $this, 'emallshop_save_prod_cat_banner_fields' ), 10, 3 );
    }
	
	// add css
	function emallshop_admin_head_style(){
		
	}
	
	// add js
	function emallshop_admin_scripts(){		
		wp_enqueue_media();
	}
	
	// Register testimonial content type
    function emallshop_addTestimonialContentType() {
        register_post_type(
            'testimonial',
            array(
                'labels' => $this->getLabels(esc_html__('Testimonials', 'pl-emallshop-extensions'), esc_html__('Testimonials', 'pl-emallshop-extensions')),
                'exclude_from_search' => true,
                'has_archive' => true,
                'public' => true,
                'rewrite' => array('slug' => 'testimonial'),
                'supports' => array('title', 'editor', 'thumbnail'),
                'can_export' => true,
            )
        );
    }

    // Register portfolio content type
    function emallshop_addPortfolioContentType() {
        register_post_type(
            'portfolio',
            array(
                'labels' => $this->getLabels(esc_html__('Portfolio', 'pl-emallshop-extensions'), esc_html__('Portfolios', 'pl-emallshop-extensions')),
                'exclude_from_search' => false,
                'has_archive' => true,
                'public' => true,
				'rewrite' => array('slug' => 'portfolio'),
                'supports' => array('title', 'editor', 'thumbnail'),
                'can_export' => true
            )
        );
		//flush_rewrite_rules( false );

        register_taxonomy(
            'portfolio_cat',
            'portfolio',
            array(
                'hierarchical' => true,
                'show_in_nav_menus' => true,
                'labels' => $this->getTaxonomyLabels(esc_html__('Portfolio Category', 'pl-emallshop-extensions'), esc_html__('Portfolio Categories', 'pl-emallshop-extensions')),
                'query_var' => true,
                'rewrite' => true
            )
        );

        register_taxonomy(
            'portfolio_skills',
            'portfolio',
            array(
                'hierarchical' => true,
                'show_in_nav_menus' => true,
                'labels' => $this->getTaxonomyLabels(esc_html__('Portfolio Skill', 'pl-emallshop-extensions'), esc_html__('Portfolio Skills', 'pl-emallshop-extensions')),
                'query_var' => true,
                'rewrite' => true
            )
        );
    }

	// Register brand content type
    function emallshop_addProductBrand() {

        register_taxonomy(
            'product_brand',
            'product',
            array(
                'hierarchical' => true,
                'show_in_nav_menus' => true,
                'labels' => $this->getTaxonomyLabels(esc_html__('Brands', 'pl-emallshop-extensions'), esc_html__('Brands', 'pl-emallshop-extensions')),
				'show_admin_column'     => true,
				'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => true
            )
        );
    }
	
    // load plugin text domain
    function loadTextDomain() {
        load_plugin_textdomain( 'pl-emallshop-extensions', false, dirname( __FILE__ ) . '/languages/' );
    }

    // Get content type labels
    function getLabels($singular_name, $name, $title = FALSE) {
        if( !$title )
            $title = $name;

        return array(
            "name" => $title,
            "singular_name" => $singular_name,
            "add_new" => esc_html__("Add New", 'pl-emallshop-extensions'),
            "add_new_item" => sprintf( esc_html__("Add New %s", 'pl-emallshop-extensions'), $singular_name),
            "edit_item" => sprintf( esc_html__("Edit %s", 'pl-emallshop-extensions'), $singular_name),
            "new_item" => sprintf( esc_html__("New %s", 'pl-emallshop-extensions'), $singular_name),
            "view_item" => sprintf( esc_html__("View %s", 'pl-emallshop-extensions'), $singular_name),
            "search_items" => sprintf( esc_html__("Search %s", 'pl-emallshop-extensions'), $name),
            "not_found" => sprintf( esc_html__("No %s found", 'pl-emallshop-extensions'), $name),
            "not_found_in_trash" => sprintf( esc_html__("No %s found in Trash", 'pl-emallshop-extensions'), $name),
            "parent_item_colon" => ""
        );
    }

    // Get content type taxonomy labels
    function getTaxonomyLabels($singular_name, $name) {
        return array(
            "name" => $name,
            "singular_name" => $singular_name,
            "search_items" => sprintf( esc_html__("Search %s", 'pl-emallshop-extensions'), $name),
            "all_items" => sprintf( esc_html__("All %s", 'pl-emallshop-extensions'), $name),
            "parent_item" => sprintf( esc_html__("Parent %s", 'pl-emallshop-extensions'), $singular_name),
            "parent_item_colon" => sprintf( esc_html__("Parent %s:", 'pl-emallshop-extensions'), $singular_name),
            "edit_item" => sprintf( esc_html__("Edit %", 'pl-emallshop-extensions'), $singular_name),
            "update_item" => sprintf( esc_html__("Update %s", 'pl-emallshop-extensions'), $singular_name),
            "add_new_item" => sprintf( esc_html__("Add New %s", 'pl-emallshop-extensions'), $singular_name),
            "new_item_name" => sprintf( esc_html__("New %s Name", 'pl-emallshop-extensions'), $singular_name),
            "menu_name" => $name,
        );
    }
	
	/**
	 * Brand thumbnail fields.
	 *
	 * @access public
	 * @return void
	 */
	function emallshop_add_brand_fields() {
		?>
		<div class="form-field">
			<label><?php esc_html_e( 'Thumbnail', 'pl-emallshop-extensions' ); ?></label>
			<div id="product_brand_thumbnail" style="float:left;margin-right:10px;"><img src="<?php echo wc_placeholder_img_src(); ?>" width="60px" height="60px" /></div>
			<div style="line-height:60px;">
				<input type="hidden" id="product_brand_thumbnail_id" name="product_brand_thumbnail_id" />
				<button type="button" class="upload_image_button button"><?php esc_html_e( 'Upload/Add image', 'pl-emallshop-extensions' ); ?></button>
				<button type="button" class="remove_image_button button"><?php esc_html_e( 'Remove image', 'pl-emallshop-extensions' ); ?></button>
			</div>
			<script type="text/javascript">

				 // Only show the "remove image" button when needed
				 if ( ! jQuery('#product_brand_thumbnail_id').val() )
					 jQuery('.remove_image_button').hide();

				// Uploading files
				var brand_thumbnail_frame;

				jQuery(document).on( 'click', '.upload_image_button', function( event ){

					event.preventDefault();

					// If the media frame already exists, reopen it.
					if ( brand_thumbnail_frame ) {
						brand_thumbnail_frame.open();
						return;
					}

					// Create the media frame.
					brand_thumbnail_frame = wp.media.frames.downloadable_file = wp.media({
						title: '<?php _e( 'Choose an image', 'pl-emallshop-extensions' ); ?>',
						button: {
							text: '<?php _e( 'Use image', 'pl-emallshop-extensions' ); ?>',
						},
						multiple: false
					});

					// When an image is selected, run a callback.
					brand_thumbnail_frame.on( 'select', function() {
						attachment = brand_thumbnail_frame.state().get('selection').first().toJSON();

						jQuery('#product_brand_thumbnail_id').val( attachment.id );
						jQuery('#product_brand_thumbnail img').attr('src', attachment.url );
						jQuery('.remove_image_button').show();
					});

					// Finally, open the modal.
					brand_thumbnail_frame.open();
				});

				jQuery(document).on( 'click', '.remove_image_button', function( event ){
					jQuery('#product_brand_thumbnail img').attr('src', '<?php echo wc_placeholder_img_src(); ?>');
					jQuery('#product_brand_thumbnail_id').val('');
					jQuery('.remove_image_button').hide();
					return false;
				});

			</script>
			<div class="clear"></div>
		</div>
		<?php
	}

	/**
	 * Edit brand thumbnail field.
	 *
	 * @access public
	 * @param mixed $term Term (brand) being edited
	 * @param mixed $taxonomy Taxonomy of the term being edited
	 */
	function emallshop_edit_brand_fields( $term, $taxonomy ) {

		$image 			= '';
		$thumbnail_id 	= absint( get_term_meta( $term->term_id, 'thumbnail_id', true ) );
		if ( $thumbnail_id )
			$image = wp_get_attachment_thumb_url( $thumbnail_id );
		else
			$image = wc_placeholder_img_src();
		?>
		<tr class="form-field">
			<th scope="row" valign="top"><label><?php esc_html_e( 'Thumbnail', 'pl-emallshop-extensions' ); ?></label></th>
			<td>
				<div id="product_brand_thumbnail" style="float:left;margin-right:10px;"><img src="<?php echo $image; ?>" style="max-width: 150px; height: auto;" /></div>
				<div style="line-height:60px;">
					<input type="hidden" id="product_brand_thumbnail_id" name="product_brand_thumbnail_id" value="<?php echo $thumbnail_id; ?>" />
					<button type="submit" class="upload_image_button button"><?php esc_html_e( 'Upload/Add image', 'pl-emallshop-extensions' ); ?></button>
					<button type="submit" class="remove_image_button button"><?php esc_html_e( 'Remove image', 'pl-emallshop-extensions' ); ?></button>
				</div>
				<script type="text/javascript">

					// Uploading files
					var brand_thumbnail_frame;

					jQuery(document).on( 'click', '.upload_image_button', function( event ){

						event.preventDefault();

						// If the media frame already exists, reopen it.
						if ( brand_thumbnail_frame ) {
							brand_thumbnail_frame.open();
							return;
						}

						// Create the media frame.
						brand_thumbnail_frame = wp.media.frames.downloadable_file = wp.media({
							title: '<?php esc_html_e( 'Choose an image', 'pl-emallshop-extensions' ); ?>',
							button: {
								text: '<?php esc_html_e( 'Use image', 'pl-emallshop-extensions' ); ?>',
							},
							multiple: false
						});

						// When an image is selected, run a callback.
						brand_thumbnail_frame.on( 'select', function() {
							attachment = brand_thumbnail_frame.state().get('selection').first().toJSON();

							jQuery('#product_brand_thumbnail_id').val( attachment.id );
							jQuery('#product_brand_thumbnail img').attr('src', attachment.url );
							jQuery('.remove_image_button').show();
						});

						// Finally, open the modal.
						brand_thumbnail_frame.open();
					});

					jQuery(document).on( 'click', '.remove_image_button', function( event ){
						jQuery('#product_brand_thumbnail img').attr('src', '<?php echo wc_placeholder_img_src(); ?>');
						jQuery('#product_brand_thumbnail_id').val('');
						jQuery('.remove_image_button').hide();
						return false;
					});

				</script>
				<div class="clear"></div>
			</td>
		</tr>
		<?php
	}

	/**
	 * save_brand_fields function.
	 *
	 * @access public
	 * @param mixed $term_id Term ID being saved
	 * @param mixed $tt_id
	 * @param mixed $taxonomy Taxonomy of the term being saved
	 * @return void
	 */
	function save_brand_fields( $term_id, $tt_id, $taxonomy ) {

		if ( isset( $_POST['product_brand_thumbnail_id'] ) )
			update_woocommerce_term_meta( $term_id, 'thumbnail_id', absint( $_POST['product_brand_thumbnail_id'] ) );

		delete_transient( 'wc_term_counts' );
	}

	/**
	 * Thumbnail column added to brand admin.
	 *
	 * @access public
	 * @param mixed $columns
	 * @return array
	 */
	function product_brand_columns( $columns ) {
		$new_columns          = array();
		$new_columns['cb']    = $columns['cb'];
		$new_columns['thumb'] = esc_html__( 'Image', 'pl-emallshop-extensions' );

		unset( $columns['cb'] );

		unset( $columns['description'] );

		return array_merge( $new_columns, $columns );
	}

	/**
	 * Thumbnail column value added to brand admin.
	 *
	 * @access public
	 * @param mixed $columns
	 * @param mixed $column
	 * @param mixed $id
	 * @return array
	 */
	function product_brand_column( $columns, $column, $id ) {

		if ( $column == 'thumb' ) {

			$image 			= '';
			$thumbnail_id 	= get_term_meta( $id, 'thumbnail_id', true );

			if ($thumbnail_id)
				$image = wp_get_attachment_thumb_url( $thumbnail_id );
			else
				$image = wc_placeholder_img_src();

			// Prevent esc_url from breaking spaces in urls for image embeds
			// Ref: http://core.trac.wordpress.org/ticket/23605
			$image = str_replace( ' ', '%10', $image );

			$columns .= '<img src="' . esc_url( $image ) . '" alt="Thumbnail" class="wp-post-image" style="max-width: 150px; max-height: 65px;" />';

		}

		return $columns;
	}

	/**
	 * Product Category Banner Fields.
	 *
	 * @access public
	 * @return void
	 */
	function emallshop_add_prod_cat_banner_fields() {
		?>
		<div class="form-field term-banner-wrap">
			<label><?php esc_html_e( 'Banner', 'pl-emallshop-extensions' ); ?></label>
			<div id="category_banner_thumbnail" style="float:left;margin-right:10px;"><img src="<?php echo wc_placeholder_img_src(); ?>" width="60px" height="60px" /></div>
			<div style="line-height:63px;">
				<input type="hidden" id="category_banner_thumbnail_id" name="category_banner_thumbnail_id" />
				<button type="button" class="upload_banner_button button"><?php esc_html_e( 'Upload/Add Banner', 'pl-emallshop-extensions' ); ?></button>
				<button type="button" class="remove_banner_button button"><?php esc_html_e( 'Remove Banner', 'pl-emallshop-extensions' ); ?></button>
			</div>
			<p class="description"><?php esc_html_e("This field is not required, but if you add banner then can view this banner on this category page.","pl-emallshop-extensions");?></p>
			<script type="text/javascript">

				// Only show the "remove image" button when needed
				if ( ! jQuery('#category_banner_thumbnail_id').val() )
					jQuery('.remove_banner_button').hide();

				// Uploading files
				var category_banner_frame;

				jQuery(document).on( 'click', '.upload_banner_button', function( event ){
					
					event.preventDefault();

					// If the media frame already exists, reopen it.
					if ( category_banner_frame ) {
						category_banner_frame.open();
						return;
					}

					// Create the media frame.
					category_banner_frame = wp.media.frames.downloadable_file = wp.media({
						title: '<?php _e( 'Choose an image', 'pl-emallshop-extensions' ); ?>',
						button: {
							text: '<?php _e( 'Use image', 'pl-emallshop-extensions' ); ?>',
						},
						multiple: false
					});

					// When an image is selected, run a callback.
					category_banner_frame.on( 'select', function() {
						attachment = category_banner_frame.state().get('selection').first().toJSON();

						jQuery('#category_banner_thumbnail_id').val( attachment.id );
						jQuery('#category_banner_thumbnail img').attr('src', attachment.url );
						jQuery('.remove_banner_button').show();
					});

					// Finally, open the modal.
					category_banner_frame.open();
				});

				jQuery(document).on( 'click', '.remove_banner_button', function( event ){
					jQuery('#category_banner_thumbnail img').attr('src', '<?php echo wc_placeholder_img_src(); ?>');
					jQuery('#category_banner_thumbnail_id').val('');
					jQuery('.remove_banner_button').hide();
					return false;
				});

			</script>
			<div class="clear"></div>
		</div>
		<?php
	}

	/**
	 * Edit Product Category Banner Field.
	 *
	 * @access public
	 * @param mixed $term Term (brand) being edited
	 * @param mixed $taxonomy Taxonomy of the term being edited
	 */
	function emallshop_edit_prod_cat_banner_fields( $term, $taxonomy ) {

		$image 			= '';
		$banner_thumbnail_id 	= absint( get_term_meta( $term->term_id, 'banner_thumbnail_id', true ) );
		if ( $banner_thumbnail_id )
			$image = wp_get_attachment_thumb_url( $banner_thumbnail_id );
		else
			$image = wc_placeholder_img_src();
		?>
		<tr class="form-field">
			<th scope="row" valign="top"><label><?php esc_html_e( 'Banner', 'pl-emallshop-extensions' ); ?></label></th>
			<td>
				<div id="category_banner_thumbnail" style="float:left;margin-right:10px;"><img src="<?php echo $image; ?>" style="max-width: 60px; height: auto;" /></div>
				<div style="line-height:63px;">
					<input type="hidden" id="category_banner_thumbnail_id" name="category_banner_thumbnail_id" value="<?php echo $banner_thumbnail_id; ?>" />
					<button type="submit" class="upload_banner_button button"><?php esc_html_e( 'Upload/Add Banner', 'pl-emallshop-extensions' ); ?></button>
					<button type="submit" class="remove_banner_button button"><?php esc_html_e( 'Remove Banner', 'pl-emallshop-extensions' ); ?></button>
				</div>
				<p class="description"><?php esc_html_e("This field is not required, but if you add banner then can view this banner on this category page.","pl-emallshop-extensions");?></p>
				<script type="text/javascript">

					// Uploading files
					var category_banner_frame;

					jQuery(document).on( 'click', '.upload_banner_button', function( event ){

						event.preventDefault();

						// If the media frame already exists, reopen it.
						if ( category_banner_frame ) {
							category_banner_frame.open();
							return;
						}

						// Create the media frame.
						category_banner_frame = wp.media.frames.downloadable_file = wp.media({
							title: '<?php esc_html_e( 'Choose an image', 'pl-emallshop-extensions' ); ?>',
							button: {
								text: '<?php esc_html_e( 'Use image', 'pl-emallshop-extensions' ); ?>',
							},
							multiple: false
						});

						// When an image is selected, run a callback.
						category_banner_frame.on( 'select', function() {
							attachment = category_banner_frame.state().get('selection').first().toJSON();

							jQuery('#category_banner_thumbnail_id').val( attachment.id );
							jQuery('#category_banner_thumbnail img').attr('src', attachment.url );
							jQuery('.remove_banner_button').show();
						});

						// Finally, open the modal.
						category_banner_frame.open();
					});

					jQuery(document).on( 'click', '.remove_banner_button', function( event ){
						jQuery('#category_banner_thumbnail img').attr('src', '<?php echo wc_placeholder_img_src(); ?>');
						jQuery('#category_banner_thumbnail_id').val('');
						jQuery('.remove_banner_button').hide();
						return false;
					});

				</script>
				<div class="clear"></div>
			</td>
		</tr>
		<?php
	}

	/**
	 * Save Product Category Banner Fields.
	 *
	 * @access public
	 * @param mixed $term_id Term ID being saved
	 * @param mixed $tt_id
	 * @param mixed $taxonomy Taxonomy of the term being saved
	 * @return void
	 */
	function emallshop_save_prod_cat_banner_fields( $term_id, $tt_id, $taxonomy ) {

		if ( isset( $_POST['category_banner_thumbnail_id'] ) )
			update_woocommerce_term_meta( $term_id, 'banner_thumbnail_id', absint( $_POST['category_banner_thumbnail_id'] ) );

		delete_transient( 'wc_term_counts' );
	}
	
}
new EmallShop_Post_Content();
?>