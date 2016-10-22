<?php get_header(); ?>

<div id="primary" class="pagemid">
	<div class="inner">	
		<div class="content-area">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', get_post_format() );  ?><!-- /postmetadata -->	
			<div id="post-<?php the_ID(); ?>" <?php post_class('post');?>>
				<div class="post_content">
					<?php if(has_post_thumbnail()) {
					echo '<div class="postimg">';
					echo '<div class="post_thumb">';
						$width=(atp_generator('sidebaroption',$post->ID) != "fullwidth") ? '600':'980';
						echo atp_generator('getPostAttachments',$post->ID,'','',$width,'200',''); 
					echo '</div>';
					echo '</div>';
					} ?>
					<div class="post-entry">
						<h2 class="entry-title">
						<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" title="<?php printf( __( "Permanent Link to %s", 'iva_theme_front' ), esc_attr( get_the_title() ) ); ?>">
						<?php the_title(); ?></a></h2>
						<?php the_content(); ?>
					</div><!-- /post-entry -->
				</div><!-- Post Content -->

				<?php the_tags('<div class="tags">'.__('Tags','iva_theme_front').': ',',&nbsp; ','</div>');?>

			</div><!-- #post-<?php the_ID(); ?> -->

			<?php  
			if(get_option('atp_aboutauthor') != "on") {
				echo atp_generator('aboutauthor'); 
			} ?>	

			<?php if(get_option('atp_singlenavigation') != "on" ) { ?>
			<div id="nav-below" class="navigation">
				<div class="nav-previous"><?php previous_post_link('&larr; %link') ?></div>
				<div class="nav-next"><?php next_post_link('%link &rarr;') ?></div>
			</div>
			<!-- #nav-below-->
			<?php } ?>

			<?php
			if(get_option('atp_relatedposts') != "on") {
				echo atp_generator( 'relatedposts', $post->ID);
			} ?>
			
			<?php edit_post_link( __( 'Edit', 'iva_theme_front' ), '<span class="edit-link">', '</span>' ); ?>

			<?php
			if(get_option('atp_commentstemplate') == "posts" ||  get_option('atp_commentstemplate') == "both") {
				comments_template('', true); 
			}
			?>

			<?php endwhile; else: ?>
			<?php '<p>'.__('Sorry, no posts matched your criteria.', 'iva_theme_front').'</p>';?>
			<?php endif; ?>
				
		</div><!-- .content-area -->

		<?php if(atp_generator('sidebaroption',$post->ID) != "fullwidth"){ get_sidebar(); } ?>			
		<div class="clear"></div>			
	</div><!-- /inner -->
				
</div>
	<!-- /pagemid -->
	<?php get_footer(); ?>