<?php
if ( post_password_required() )
	return;
?>
<?php if ( have_comments() ) : ?>
<div id="comments" class="comments-area">

		<h2 class="comments-title">
			<?php
				printf( _n( '%2$s (1)', '%2$s (%1$s)', get_comments_number() ),
					number_format_i18n( get_comments_number() ), get_the_title() );
			?>
		</h2>

		<ol class="comment-list">
			<?php wp_list_comments( array( 'callback' => 'atp_custom_comment' ) ); ?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'iva_theme_front' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'iva_theme_front' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'iva_theme_front' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<?php
		/* If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.' , 'iva_theme_front' ); ?></p>
		<?php endif; ?>
</div><!-- #comments .comments-area -->

<?php endif; ?>
<?php
// Comment Form Args
$comments_args = array(
	'label_submit'=> __('Post Comment','iva_theme_front'),
	'title_reply'=>'<h4 class="fancyheading textleft"><span>'.__( 'Leave a Reply' , 'iva_theme_front' ).'</span></h4>'
);

// Comment Form
comment_form($comments_args); ?>