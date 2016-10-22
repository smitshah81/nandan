<?php
/**
 * Template Name: Pest Categories
 */
get_header();
?>
<div id="primary" class="pagemid">
  <div class="inner">   
    <main class="content-area" role="main">
      <div class="entry-content-wrapper clearfix">
					<?php
					if ( have_posts() ) : while ( have_posts() ) : the_post(); 
						the_content();
					endwhile;
					endif;
					?>
					<div class="pest_container clearfix">
						<?php
						/**
						 * Retrieve the terms in a given taxonomy or list of taxonomies.
						 * orderby - Default is 'name'. Can be name, count, term_group, slug or nothing
						 * (will use term_id), Passing a custom value other than these will cause it to
						 * order based on the custom value.
						 * order - Default is ASC. Can use DES
						 */
						$iva_cat_order = get_option('iva_pest_cat_order')?get_option('iva_pest_cat_order'):'id';
						
						if ( $iva_cat_order == 'display_order' ) {
							$iva_cats_array = get_terms('pest_cat','hide_empty=0&parent=0&order=ASC');
							
							foreach ( $iva_cats_array as $iva_pest_cat ){
								$dynamic_cats[$iva_pest_cat->slug] = $iva_pest_cat->name;
								$t_id 							   = $iva_pest_cat->term_id;
								$term_meta 						   = get_option("taxonomy_$t_id");
								$pest_orders[] 					   = $term_meta['display_order'];
							}
							
							$pest_orders = array_unique($pest_orders,SORT_REGULAR);
							
							sort( $pest_orders );
							
							foreach( $pest_orders as $pest_order ) {
								foreach ( $iva_cats_array as $pest_order ) {
								
									$dynamic_cats[$pest_order->slug] = $pest_order->name;
									$t_id 							 = $pest_order->term_id; 	
									$term_meta 						 = get_option("taxonomy_$t_id");
									
									if( $term_meta['display_order'] == $iva_cat_order ) {
										echo '<div class="iva_pest_col3">';
										echo '<div class="pest_cat_item">';
										echo '<h1 class="pest_cat_title"><a href="'.get_term_link($pest_order->slug,'pest_cat') .'">'.$pest_order->name.'</a></h1>';
										echo '<h5 class="pest_cat_desc">'.$pest_order->description.'</h5>';
										echo '<div class="pest_cat"><div class="pest_cat_img"><a href="'.get_term_link($pest_order->slug,'pest_cat') .'">';
										if( $term_meta['img']!='' ){
											echo atp_resize( $post->ID,$term_meta['img'],'250','250','','' );
										}
										echo '</a></div></div>';	
										echo '</div>';
										echo '</div>';
									}
								}
							}
						}else{
							$iva_cats_array = get_terms('pest_cat','hide_empty=0&parent=0&orderby='.$iva_cat_order.'&order=ASC');
							foreach ( $iva_cats_array as $pest_order ) {
								$dynamic_cats[$pest_order->slug] = $pest_order->name;
								$t_id 							 = $pest_order->term_id; 	
								$term_meta 						 = get_option("taxonomy_$t_id");
								echo '<div class="iva_pest_col3">';
								echo '<div class="pest_cat_item">';
								echo '<h1 class="pest_cat_title"><a href="'.get_term_link($pest_order->slug,'pest_cat') .'">'.$pest_order->name.'</a></h1>';
								echo '<h5 class="pest_cat_desc">'.$pest_order->description.'</h5>';
								echo '<div class="pest_cat"><div class="pest_cat_img"><a href="'.get_term_link($pest_order->slug,'pest_cat') .'">';
								if( $term_meta['img'] != '' ){
									echo atp_resize( $post->ID,$term_meta['img'],'250','250','','' );
								}
								echo '</a></div></div>';	
								echo '</div>';
								echo '</div>';
							}
						}?>
					</div><!-- .pest_container -->
				<div class="clear"></div>
				<?php edit_post_link( __( 'Edit', 'iva_theme_front' ), '<span class="edit-link">', '</span>' );?>        
			</div><!-- .content-area -->
      </main><!-- main -->    
      <?php if ( atp_generator( 'sidebaroption', $post->ID) != "fullwidth" ){ get_sidebar(); } ?>
	</div><!-- inner -->  
 </div><!-- pagemid -->
<?php get_footer(); ?>