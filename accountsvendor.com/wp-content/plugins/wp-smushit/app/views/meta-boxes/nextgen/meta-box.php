<?php
/**
 * NextGen meta box.
 *
 * @package WP_Smush
 *
 * @var bool                   $all_done         If all the images are smushed.
 * @var int                    $count            Resmush + unsmushed image count.
 * @var bool                   $lossy_enabled    Lossy compression status.
 * @var WP_Smush_Nextgen_Admin $ng               NextGen admin class.
 * @var int                    $remaining_count  Remaining images.
 * @var array                  $resmush_ids      Resmush ID.
 * @var bool                   $show             Show resmush window.
 * @var int                    $total_count      Total count.
 * @var string                 $url              Media library URL.
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

// Get the counts.
if ( $show ) {
	WP_Smush::get_instance()->admin()->bulk_resmush_content( $count, $show );
}

// If there are no images in Media Library.
if ( 0 >= $total_count ) : ?>
	<?php if ( ! $this->hide_wpmudev_branding() ) : ?>
		<span class="wp-smush-no-image tc">
			<img src="<?php echo esc_url( WP_SMUSH_URL . 'app/assets/images/smush-no-media.png' ); ?>" alt="<?php esc_attr_e( 'No attachments found - Upload some images', 'wp-smushit' ); ?>">
		</span>
	<?php endif; ?>
	<p class="wp-smush-no-images-content tc">
		<?php
		printf(
			/* translators: %1$s: opening a tga, %2$s: closing a tag */
			esc_html__(
				'We haven\'t found any images in your %1$sgallery%2$s yet, so there\'s no smushing to be
			done! Once you upload images, reload this page and start playing!',
				'wp-smushit'
			),
			'<a href="' . esc_url( admin_url( 'admin.php?page=ngg_addgallery' ) ) . '">',
			'</a>'
		);
		?>
	</p>
	<span class="wp-smush-upload-images sui-no-padding-bottom tc">
	<a class="sui-button sui-button-blue" href="<?php echo esc_url( admin_url( 'admin.php?page=ngg_addgallery' ) ); ?>">
		<?php esc_html_e( 'UPLOAD IMAGES', 'wp-smushit' ); ?></a>
	</span>
<?php else : ?>
	<!-- Hide All done div if there are images pending -->
	<div class="sui-notice sui-notice-success wp-smush-all-done<?php echo $all_done ? '' : ' sui-hidden'; ?>">
		<p><?php esc_html_e( 'All images are smushed and up to date. Awesome!', 'wp-smushit' ); ?></p>
	</div>
	<div class="wp-smush-bulk-wrapper <?php echo $all_done ? ' sui-hidden' : ''; ?>">
		<!-- Do not show the remaining notice if we have resmush ids -->
		<div class="sui-notice sui-notice-warning wp-smush-remaining  <?php echo count( $resmush_ids ) > 0 ? ' sui-hidden' : ''; ?>">
			<p>
				<span class="wp-smush-notice-text">
					<?php
					printf(
						/* translators: %1$s: user name, %2$s: strong opening tag, %3$s: span opening tag, %4$d: remaining count, %5$s: closing span tag, %6$s: closing strong tag */
						_n(
							'%1$s, you have %2$s%3$s%4$d%5$s attachment%6$s that needs smushing!',
							'%1$s, you have %2$s%3$s%4$d%5$s attachments%6$s that need smushing!',
							$remaining_count,
							'wp-smushit'
						),
						esc_html( WP_Smush_Helper::get_user_name() ),
						'<strong>',
						'<span class="wp-smush-remaining-count">',
						absint( $remaining_count ),
						'</span>',
						'</strong>'
					);
					?>
				</span>
			</p>
		</div>
		<div class="sui-actions-right">
			<button type="button" class="sui-button sui-button-blue wp-smush-nextgen-bulk">
				<?php esc_html_e( 'BULK SMUSH', 'wp-smushit' ); ?>
			</button>
		</div>
		<?php if ( ! $lossy_enabled ) : ?>
			<span class="wp-smush-enable-lossy">
				<?php
				printf(
					/* translators: %1$s: opening a tag, %2$s: closing a tag */
					esc_html__(
						'Enable Super-Smush in the %1$sSettings%2$s area to get even more savings with
					almost no visible drop in quality.',
						'wp-smushit'
					),
					'<a href="' . esc_url( $url ) . '" target="_blank">',
					'</a>'
				);
				?>
			</span>
		<?php endif; ?>
	</div>

	<?php
	$this->view(
		'blocks/progress-bar',
		array(
			'count' => $ng,
		)
	);
	?>

	<div class="smush-final-log sui-hidden">
		<div class="smush-bulk-errors"></div>
		<div class="smush-bulk-errors-actions">
			<a href="<?php echo esc_url( admin_url( 'upload.php' ) ); ?>" class="sui-button sui-button-icon sui-button-ghost">
				<i class="sui-icon-photo-picture" aria-hidden="true"></i>
				<?php esc_html_e( 'View all', 'wp-smushit' ); ?>
			</a>
		</div>
	</div>
<?php endif; ?>
