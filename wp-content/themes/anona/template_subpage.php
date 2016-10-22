<?php
/*
Template Name: Sub Navigation
*/
?>
<?php get_header(); ?>

	<div id="primary" class="pagemid">
		<div class="inner">				
			<main class="content-area" role="main">		
				<div class="entry-content-wrapper clearfix">
					<?php if ( atp_generator( 'sidebaroption', $post->ID) != "fullwidth" ){ $width = '650'; }else{ $width = '980';  }  ?>
					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
						<?php the_content(); ?>
						
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'iva_theme_front' ), 'after' => '</div>' ) ); ?>

					</div>
					<!-- #POST-<?php the_ID(); ?> -->
						
					<?php endwhile; ?>

					<div class="clear"></div>
					<?php edit_post_link( __( 'Edit', 'iva_theme_front' ), '<span class="edit-link">', '</span>' ); ?>

					<?php 
					// Comments - Disable from theme options panel - post options panel
					$comments = get_option( 'atp_commentstemplate' );
					if ( $comments == "pages" ||  $comments == "both" ) {
						comments_template('', true); 
					}?>
				</div>
			</main><!-- .content-area -->

			<div id="sidebar">
				<div class="content widget-area">
					<?php
						if ($post->post_parent)	{
							$ancestors=get_post_ancestors($post->ID);
							$root=count($ancestors)-1;
							$parent = $ancestors[$root];
						} else {
							$parent = $post->ID;
						}
						
						$children = wp_list_pages("title_li=&child_of=". $parent ."&echo=0");
						
						if ($children) { ?>
						<ul class="sub_nav">
						<?php echo $children; ?>
						</ul>
					<?php } ?>
				</div>
			</div>
			<!-- .sidebar -->

			<div class="clear"></div>

		</div><!-- .inner -->
	</div><!-- .pagemid -->
<?php get_footer(); ?>