<?php get_header(); ?>
<div id="primary" class="pagemid">
	<div class="inner">

		<main class="content-area">

			<div class="entry-content-wrapper clearfix">

			<?php if( atp_generator( 'sidebaroption', get_the_id() ) != "fullwidth" ){ $width = '800'; } else { $width = '1100'; } ?>
					
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
			<?php get_template_part( 'content', get_post_format() );?>

			<?php get_template_part('share','link'); ?>
			</div><!-- .entry-content-wrapper-->
			
			<?php

			if ( get_option( 'atp_aboutauthor' ) != "on" ) {
				echo atp_generator( 'aboutauthor' ); 
			}

			if ( get_option( 'atp_relatedposts' ) != "on" ) {
				echo atp_generator( 'relatedposts', $post->ID);
			}

			if ( get_option( 'atp_commentstemplate' ) == "posts" ||  get_option( 'atp_commentstemplate' ) == "both" ) {
				comments_template( '', true ); 
			}

			if ( get_option( 'atp_singlenavigation' ) != "on" ) { 
				if(get_previous_post_link()  OR  get_next_post_link()) { ?>
					<div class="navigation-section">
						<div class="navigation-post">
							<div class="nav-previous">
								<div class="innerlinks">
									<?php previous_post_link('<span class="nav-icon-left"><i class="fa  fa-chevron-left fa-lg"></i></span>
									<p> %link </p>') ?>
								</div>
							</div>		
							<div class="nav-next">
								<div class="innerlinks">
									<?php next_post_link('<span class="nav-icon-right"><i class="fa  fa-chevron-right fa-lg"></i></span>
									<p>%link</p>') ?>
								</div>
							</div>		
						</div>		
					</div>
				<?php
				}
			} else {
				posts_nav_link();
			}
			?>

			<?php endwhile; ?>
				
			<?php else: ?>
			<?php '<p>'.__('Sorry, no posts matched your criteria.', 'iva_theme_front').'</p>';?>
				
			<?php endif; ?>

		</main><!-- .content-area -->
		<?php if ( atp_generator( 'sidebaroption', $post->ID ) != "fullwidth" ){ get_sidebar(); } ?>			
		
		<div class="clear"></div>
		
	</div><!-- .inner -->
</div><!-- .pagemid -->
<?php get_footer(); ?>