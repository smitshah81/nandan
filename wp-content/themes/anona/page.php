<?php 

	//Includes the header.php template file from your current theme's directory
	get_header(); 
	
?>
<div id="primary" class="pagemid">
	<div class="inner">
		<main class="content-area" role="main">
			<div class="entry-content-wrapper clearfix">
		
				<?php if ( atp_generator( 'sidebaroption', $post->ID ) != "fullwidth" ) { $width = '650'; } else { $width = '1100';  }  ?>
				
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'iva_theme_front' ), 'after' => '</div>' ) ); ?>

				</div>
				<!-- #post-<?php the_ID(); ?> -->

				<?php endwhile; ?>

				<div class="clear"></div>
				<?php edit_post_link( __( 'Edit', 'iva_theme_front' ), '<span class="edit-link">', '</span>' ); ?>

				<?php 
				$comments = get_option('atp_commentstemplate');
				if ( $comments == 'pages' ||  $comments == 'both' ) {
					comments_template( '', true ); 
				}?>
			</div>
		</main><!-- .content-area -->

		<?php 
		
		if ( atp_generator( 'sidebaroption', $post->ID ) != 'fullwidth') { get_sidebar(); } ?>
		<!-- .sidebar -->

		<div class="clear"></div>

	</div><!-- .inner -->
</div><!-- .pagemid -->
<?php get_footer(); ?>