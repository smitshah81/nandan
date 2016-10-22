<?php
/*
Template Name: Blog
*/
?>
<?php get_header(); ?>
	<div id="primary" class="pagemid">
		<div class="inner">		
		<main class="content-area" role="main">
			<div class="entry-content-wrapper clearfix">	
				<?php if ( atp_generator( 'sidebaroption', get_the_id()) != "fullwidth" ){ $width = '800'; } else { $width = '1100';  } ?>
					<?php
					$cats = '';
					if ( is_array( $blog_all_cats = get_option( 'atp_blogacats' ) ) && count( $blog_all_cats ) > 0 ) {
						$cats = implode( ', ', $blog_all_cats );
					}
						if ( get_query_var('paged') ) {
							$paged = get_query_var('paged');
							} elseif ( get_query_var('page') ) {
								$paged = get_query_var('page');
							} else {
								$paged = 1;  
						}

					$args = array(
						'cat' => $cats,
						'paged' => $paged
					);

					$wp_query = new WP_Query( $args );
					?>

				<?php if ( $wp_query->have_posts()) : while (  $wp_query->have_posts()) :  $wp_query->the_post(); ?>
					
				<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

				<?php
				if ( function_exists( 'iva_pagination' ) ){ 
					echo iva_pagination();
				}?>
				
				<?php else : ?>
				
				<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'iva_theme_front' ); ?></p>
				<?php get_search_form(); ?>
				
				<?php endif; ?>
				
				<?php wp_reset_postdata();  ?>

				<?php edit_post_link( __( 'Edit', 'iva_theme_front' ), '<span class="edit-link">', '</span>' ); ?>
				</div>
			</main><!-- .content-area -->
			
			<?php if ( atp_generator( 'sidebaroption', $post->ID ) != "fullwidth" ){ get_sidebar(); } ?>
			<!-- .sidebar -->

			<div class="clear"></div>

		</div><!-- .inner -->
	</div><!-- .pagemid -->
<?php get_footer(); ?>