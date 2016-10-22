<?php
/*
Template Name: Site Map
*/
?>
<?php get_header(); ?>
	<div id="primary" class="pagemid">
		<div class="inner">
			<div class="content-area">
					
					<?php if (have_posts()): while (have_posts()): the_post(); ?>
						
						<?php the_content(); ?> 

					<?php endwhile; endif; ?>

					<div class="one_fourth">
						<h3><?php _e('Pages', 'iva_theme_front'); ?></h3>
						<ul class="sitemap"><?php $args = array('title_li' => '', 'depth' => 0); wp_list_pages($args); ?></ul>
					</div>
		
					<div class="one_fourth">
						<h3><?php _e('Feeds', 'iva_theme_front'); ?></h3>
						<ul class="sitemap">
							<li><a title="<?php _e('Main RSS', 'iva_theme_front'); ?>" href="<?php bloginfo('rss2_url'); ?>"><?php _e('Main RSS', 'iva_theme_front'); ?></a></li>
							<li><a title="<?php _e('Comment Feed', 'iva_theme_front'); ?>" href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comment Feed', 'iva_theme_front'); ?></a></li>
						</ul>
					</div>
		
					<div class="one_fourth">
						<h3><?php _e('Categories', 'iva_theme_front'); ?></h3>
						<ul class="sitemap"><?php $args = array('title_li' => ''); wp_list_categories($args); ?></ul>
					</div>
		
					<div class="one_fourth last">
						<h3><?php _e('Archives', 'iva_theme_front'); ?></h3>
						<ul class="sitemap">
							<?php wp_get_archives('type=monthly&show_post_count=true'); ?>
						</ul>
					</div>		
			</div><!-- .content-area -->

			<?php if( atp_generator( 'sidebaroption',$post->ID ) != "fullwidth" ) { get_sidebar(); } ?>
			<!-- #sidebar -->

			<div class="clear"></div>

		</div>
		<!-- .inner -->
	</div>
	<!-- .pagemid -->
	
	<?php get_footer(); ?>