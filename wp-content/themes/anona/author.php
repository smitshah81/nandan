<?php
/**
 * The template for displaying Author archive pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 */

get_header(); ?>

	<div id="primary" class="pagemid">
		<div class="inner">			
			
			<main class="content-area" role="main">
				<div class="entry-content-wrapper clearfix">
				
					<div id="about-author" class="abt-archive">
						<div class="author_containter">
							
							<div class="author-avatar">
								<?php echo get_avatar(get_the_author_meta( 'email' ), $size = '80', $default=''); ?>
							</div>
							
							<div class="author-description">
								<h4><?php echo __( 'About','iva_theme_front' ) .' '; the_author_meta( 'display_name' ); ?></h4>
								<p><?php the_author_meta('description'); ?></p>
							</div>
	
						</div>
					</div>
					

					<?php if ( atp_generator( 'sidebaroption', get_the_id() ) != "fullwidth" ) { $width = '520'; } else { $width = '960';  } ?>

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() );  ?>

					<?php endwhile; ?>
						
					<?php if ( function_exists('iva_pagination') ) { echo iva_pagination(); } ?>

					<?php else : ?>

					<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'iva_theme_front' ); ?></p>

					<?php get_search_form(); ?>

					<?php endif;?>
				</div>
		
			</main><!-- .content-area -->

			<?php if ( atp_generator( 'sidebaroption', $post->ID ) != 'fullwidth' ){ get_sidebar(); } ?>

			<div class="clear"></div>
			
		</div><!-- .inner -->
	</div><!-- .pagemid -->

<?php 
get_footer();