<?php
/** 
 * The Header for our theme.
 * Includes the header.php template file. 
 */
get_header(); ?>
<div id="primary" class="pagemid">
	<div class="inner">
		<main class="content-area">
			<div class="entry-contents-wrapper clearfix">
		
			<?php if( have_posts() ): while( have_posts() ): the_post(); ?>	
			
			<div  id="post-<?php the_ID(); ?>">
				<?php
				$img_alt_title 			= get_the_title();
				$iva_pest_custom_meta  	= get_post_meta( $post->ID, 'iva_pest_meta', true );
				?>
				<div class="pest-info">

					<?php if( has_post_thumbnail() ) { ?>
						<div class="pest-single-image">
							<div class="pest-single-thumb">
								<figure><?php echo atp_resize($post->ID, '', '150', '150', '', $img_alt_title  ); ?></figure>
							</div>
						</div>
					<?php } ?>

					<?php 
					if ( $iva_pest_custom_meta != '' ) {
						echo '<div class="pest-single-details">';
						echo '<div class="pest-details">';
						foreach ( $iva_pest_custom_meta as $pestcustom_meta ) {	
							echo '<div class="pest-meta-info">';
							echo '<span class="pest-meta-label">'. $pestcustom_meta['label'] .'</span>';
							echo '<span class="pest-meta-value">'. $pestcustom_meta['value'].'</span>';
							echo '</div>';
			  			} 
						echo '</div>';
						echo '</div>';
					}
					?>
					</div><!-- / -->

					<div class="pest-single-content">
						<?php the_content(); ?>			
					</div><!-- .pest-single-content -->

			</div><!-- #post-<?php the_ID();?> -->
			
			<?php endwhile; ?>
			
			<?php else: ?>
			<?php '<p>' . __('Sorry, no projects matched your criteria.', 'iva_theme_front') . '</p>';?>
			<?php endif; ?>

			<?php 
			if( get_option('atp_commentstemplate') == "posts" ||  get_option('atp_commentstemplate') == "both") {
				comments_template('', true); 
			}
			?>
			
			</div><!-- .entry-content-wrapper-->
		</main><!-- .content-area -->
		
		<?php if ( atp_generator( 'sidebaroption', $post->ID ) != "fullwidth" ){ get_sidebar(); } ?>			
		<div class="clear"></div>
	</div><!-- .inner -->
</div><!-- .pagemid -->
<?php get_footer(); ?>