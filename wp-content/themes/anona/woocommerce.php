<?php get_header(); ?>
<div class="pagemid">
	<div class="inner">

		<div id="main">

			<div class="entry-content">

				<?php $woocommerce_shop_page_id = get_option ('woocommerce_shop_page_id'); ?>
				
				<?php if ( atp_generator( 'sidebaroption', $woocommerce_shop_page_id ) != "fullwidth" ) { $width = '650'; } else { $width = '1020';  }  ?>
				
				

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php woocommerce_content(); ?>

					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'THEME_FRONT_SITE' ), 'after' => '</div>' ) ); ?>

				</div>
				<!-- #post-<?php the_ID(); ?> -->

				<div class="clear"></div>

				<?php 
				$comments = get_option('atp_commentstemplate');
				if ( $comments == 'pages' ||  $comments == 'both' ) {
					comments_template( '', true ); 
				}?>

			</div><!-- .entry-content -->
		
		</div>
		<!-- #main -->

		<?php
		if ( atp_generator( 'sidebaroption', $woocommerce_shop_page_id ) != 'fullwidth') { get_sidebar(); } ?>
		<!-- .sidebar -->

		<div class="clear"></div>

	</div><!-- .inner -->
</div><!-- .pagemid -->
<?php get_footer(); ?>