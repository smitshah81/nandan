<?php
/*
Template Name: Gallery
*/
get_header(); ?>
	<div id="primary" class="pagemid">
		<div class="inner">		
		<main class="content-area" role="main">
			<div class="entry-content-wrapper clearfix">
				<?php
				/** 
				 * columns for gallery thumbs.
				 */
				$column_index = 0; $columns = 3;
				if( $columns == '4' ) { $class = 'col_fourth'; }
				if( $columns == '3' ) { $class = 'col_third'; }
				
				/** 
				 * full width gallery image sizes
				 */
				if( $columns == '4' ) { $width='470'; $height = '320' ; }
				if( $columns == '3' ) { $width='470'; $height = '320' ; }
				$orderby = get_option('atp_gallery_orderby') ? get_option('atp_gallery_orderby') : 'date';
				$order   = get_option('atp_gallery_order') ? get_option('atp_gallery_order') : 'ASC';	
				
				if ( get_query_var('paged') ) {
					$paged = get_query_var('paged');
				}elseif ( get_query_var('page') ) {
					$paged = get_query_var('page');
				} else {
					$paged = 1;  
				}
				
				/** 
				 * full width gallery image sizes
				 */
				$pagination = get_option('atp_gallery_pagination');
				if($pagination == 'on'){
					$gallery_limit = get_option( 'atp_gallery_limits' );
				}else{
					$gallery_limit = '-1' ;
				}

				$args = array(
					'post_type' 	=> 'gallery',
					'posts_per_page'=> $gallery_limit, 
					'paged' 		=> $paged,
					'orderby'		=> $orderby,
					'order'			=> $order
				);
				/** 
				 * the query
				 */
				$wp_query = new WP_Query( $args );
					
				if ( $wp_query->have_posts()) : while (  $wp_query->have_posts()) :  $wp_query->the_post(); 

					$gallery_venue		= get_post_meta( $post->ID, 'gallery_venue', true );
					$gallery_upload		= get_post_meta( $post->ID, 'gallery_upload', true );
					$img_alt_title 		= get_the_title();
					$column_index++;
					$column_index;
					$last = ( $column_index == $columns && $columns != 1 ) ? 'end ' : '';
					$attachments = get_children("post_parent=$post->ID&post_type=attachment&post_mime_type=image&order=ASC");
					?>

					<div class="iva_gallery_item <?php echo $class.' '.$last; ?>">
						<div class="iva_gallery_thumb">
							<?php 
							if ( has_post_thumbnail()) { 
								echo '<figure>'. atp_resize( $post->ID, '', $width, $height, '', $img_alt_title ). '</figure>'; 
								
							} ?>
							
						</div>
						<!-- .iva_gallery_thumb -->

						<div class="iva_gallery-desc">
							<h2 class="gallery-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( __( "Permanent Link to %s", 'iva_theme_front' ), esc_attr( get_the_title() ) ); ?>"><?php the_title(); ?></a></h2>
							<?php if(count($attachments) != 0){  ?>
								<span class="iva-img-count"><?php echo count($attachments).' Photos'?></span>
							<?php } ?>
						</div><!-- .iva_gallery-desc -->
						
						
						
					</div><!--.gallery-list -->

					<?php 
					if( $column_index == $columns ){
						$column_index = 0;
						echo '<div class="clear"></div>';
					}
					?>
					<?php endwhile; ?>
				
					
					<?php if ( $pagination == 'on' ) { echo iva_pagination(); }?>
					
					<?php else : ?>
					
					<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'iva_theme_front' ); ?></p>
					<?php get_search_form(); ?>
					
					<?php endif;?>
					
					<?php wp_reset_postdata(); ?>
					
					<?php edit_post_link( __( 'Edit', 'iva_theme_front' ), '<span class="edit-link">', '</span>' );?>
					
				</div><!-- .content-area -->
			</main><!-- main -->		
			<?php if ( atp_generator( 'sidebaroption', $post->ID) != "fullwidth" ){ get_sidebar(); } ?>		
		</div><!-- inner -->	
	</div><!-- #primary.pagemid 
<?php get_footer(); ?>