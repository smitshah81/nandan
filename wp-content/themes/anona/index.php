<?php get_header(); ?>

<div id="primary" class="pagemid">
	<div class="inner">			
		<div class="content-area">
			
			<div class="entry-content-wrapper clearfix">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php get_template_part( 'content', get_post_format() );  ?>			
			<?php endwhile; ?>

			<?php if(function_exists('iva_pagination')){ echo iva_pagination(); }?>
			<?php else : ?>
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'iva_theme_front' ); ?></p>
			<?php get_search_form(); ?>
			<?php endif;?>
			</div>
			
		</div><!-- .content-area -->

		<?php get_sidebar(); ?>

		<div class="clear"></div>
			
	</div><!-- .inner -->
</div><!-- .pagemid -->
<?php get_footer(); ?>