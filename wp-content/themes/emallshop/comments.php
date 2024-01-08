<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage EmallShop
 * @since EmallShop 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title"> <i class="fa fa-comments"></i>
			<?php
				printf( _nx( '', 'Comments (%1$s)', get_comments_number(), 'comments title', 'emallshop' ),
					number_format_i18n( get_comments_number() ), get_the_title() );
			?>
		</h3>
		
		<ol class="comment-list">
			<?php
				wp_list_comments( array( 'callback' => 'emallshop_comment' ));
			?>
		</ol><!-- .comment-list -->

		<?php emallshop_comment_nav(); ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'emallshop' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- .comments-area -->
