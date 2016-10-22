<?php 

/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 */

get_header(); ?>

	<div id="primary" class="pagemid">
		<div class="inner">
	
			<main class="content-area">
	
				<div class="entry-content-wrapper clearfix">
					
					<?php

					global $iva_readmoretxt;

					// Get sidebaroption for content area width
					if ( atp_generator( 'sidebaroption', get_the_id() ) != "fullwidth" ) { 
						$width = '670'; 
					} else { 
						$width = '960';
					}?>

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() );  ?>
					<?php endwhile; ?>

					<?php
					// Pagination
					if ( function_exists ('iva_pagination') ) { 
						echo iva_pagination();
					}
					?>

					<?php else : ?>

					<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'iva_theme_front' ); ?></p>

					<?php get_search_form(); ?>

					<?php endif;?>
			
				</div><!-- .entry-content-wrapper-->
			</main><!-- .content-area -->

			<?php get_sidebar(); ?>

		</div><!-- inner -->
	</div><!-- #primary.pagemid -->

<?php 
get_footer();