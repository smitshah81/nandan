<?php get_header(); ?>
    <div id="primary" class="pagemid">
        <div class="inner">
            <div class="content-area">
			 <div class="entry-content-wrapper">
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php
					global $wp_query;
					if ( get_query_var('paged') ) {
						$paged = get_query_var('paged');
					}elseif ( get_query_var('page') ) {
						$paged = get_query_var('page');
					} else {
						$paged = 1;  
					}
					$columns = '4'; $column_index = 0;
					
					$width="480"; $height = "480" ;	
				
					if( $columns == '6' ) { $class = "one_sixth nomargin";	$columns_id = "6"; }
					if( $columns == '5' ) { $class = "one_fifth nomargin";	$columns_id = "5";	}
					if( $columns == '4' ) { $class = "one_fourth nomargin";	$columns_id = "4"; }
					if( $columns == '3' ) { $class = "one_third nomargin";	$columns_id = "3";	}
					
					if ( have_posts()) : while ( have_posts()) : the_post();
						
						$post_title	= get_the_title( $post->ID );
						$permalink	= get_permalink( $post->ID );
						
						$column_index++;
						
						$last = ( $column_index == $columns && $columns != 1 ) ? 'end ' : '';
						echo '<div class="'.$class.'">';
						echo '<div class="iva-pests">';
						if( has_post_thumbnail( $post->ID )){
							echo '<div class="pest-img">';				
							echo '<a href="'.esc_url( $permalink ).'" targrt="_blank">';
							echo '<figure>'. atp_resize( $post->ID,'',$width,$height,'pest-thumb','' ).'</figure>';
							echo '</a>';
							echo '<span class="imgoverlay"></span>';
							echo '</div>';
						}
					
						echo '<div class="cs-title">';
						echo '<h2><a href="'.esc_url( $permalink ).'" targrt="_blank">'.$post_title.'</a></h2>';
						echo '</div>';
						echo '</div>'; //  .pest-list end	
						echo '</div>'; //  .column end	

						if( $column_index == $columns ){
							$column_index = 0;
							echo '<div class="clear"></div>'; // clear class
						}
						endwhile; 
					?>
					<div class="clear"></div>
					<?php 
					if(function_exists('iva_pagination')) { 
						echo iva_pagination(); 
					} ?><!-- #pagination -->
			
					<?php else : ?>
					
					<?php echo '<h2 class="center">'.__('No posts found'.'iva_theme_front').'</h2>'; ?>
					
					<?php get_search_form(); ?>
					
					<?php endif; ?>

				</div><!-- post-id -->
			</div><!-- .content-area -->
			</div><!-- .entry-content-wrapper -->
		<div class="clear"></div>
	</div><!-- .inner -->
</div><!-- .pagemid -->
<?php 
get_footer();