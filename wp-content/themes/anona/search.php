<?php get_header(); ?>

	<div id="primary" class="pagemid">
		<div class="inner">			
			
			<div class="content-area">
			
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<div <?php post_class('searchresults');?> id="post-<?php the_ID(); ?>">
					
					<div class="post_desc_holder">
						<div class="post_desc">

							<h2 class="entry-title">
								<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
							</h2>	

							<div class="postmeta">
							<?php 
							echo 'On ';
							the_time("F j, Y"); 
							echo '<span class="meta-author"> by ';
							the_author_posts_link(); 
							echo ' &#45; </span>';
							echo '<span class="meta-category">';
							the_category(',') ; 
							echo ' &#45; </span>';
							if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ){
							comments_popup_link( __( '0 Comment', 'iva_theme_front' ), __( '1 Comment', 'iva_theme_front' ), __( '% Comments', 'iva_theme_front' ) );
							}
							?>
							<a class="more-link" href="<?php the_permalink() ?>"><span class="btn small dark border"><?php _e( 'Read More', 'iva_theme_front' ); ?></span></a>
							</div>
						</div><!-- .postmeta-->
					</div>
				
				</div><!-- #post-<?php the_ID();?> -->

				<?php endwhile; ?>

				<?php

				// Displays pagination
				if ( function_exists( 'atp_pagination' ) ) { 
					echo atp_pagination(); 
				}?> 
					
				<?php else : ?>

				<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'iva_theme_front' ); ?></p>
				
				<?php get_search_form(); ?>
				
				<?php endif; ?>		

			</div><!-- .content-area -->

			<?php get_sidebar();?>
			<!-- .pagemid -->

			<div class="clear"></div>

		</div><!-- .inner -->
	</div><!-- .pagemid -->

<?php 
get_footer(); 
