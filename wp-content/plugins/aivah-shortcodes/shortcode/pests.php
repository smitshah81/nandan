<?php
function iva_pest_list ($atts, $content = null,$code) {
	extract(shortcode_atts(array(
			'cats'		=> '',
			'order'		=> 'ASC',
			'orderby'	=> 'menu_order',
			'columns'	=> '6',
			'limit'		=> -1,
			'pagination'=> 'true',	
			'title'		=> 'true',	
		), $atts));
		
	global $post;		
			
	$width="570"; $height = "570" ;	
	
	if( $columns == '6' ) { $class = "one_sixth nomargin";	$columns_id = "sixth"; }
	if( $columns == '5' ) { $class = "one_fifth nomargin";	$columns_id = "fifth";	}
	if( $columns == '4' ) { $class = "one_fourth nomargin";	$columns_id = "fourth"; }
	if( $columns == '3' ) { $class = "one_third nomargin";	$columns_id = "third";	}
	
	$out = '';
	$column_index = 0; //used to identify the column number and move the further results to next row

	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;	
	$args = array(
			'post_type'	=> 'pest', 
			'showposts'	=> $limit, 
			'tax_query'	=> array(
				'relation'	=> 'OR',
			),
			'paged'		=> $paged,
			'orderby'	=> 'ID',
			'order'		=> 'ASC'
		);

		if( $cats ){
			$cats = explode( ",",$cats );
			$tax_pest = array(
				'taxonomy' 	=> 'pest_category',
				'field' 	=> 'slug',
				'terms' 	=> $cats
			);
			array_push( $args['tax_query'],$tax_pest );
		}
	
		//get the results
		query_posts( $args );
		
		if( have_posts() ) : 
		
			while( have_posts() ) : the_post(); 

			//Get the post details
			$post_title	= get_the_title( get_the_id() );
			$permalink	= get_permalink( get_the_id() );
			
			$column_index++;
			
			$last = ( $column_index == $columns && $columns != 1 ) ? 'end ' : '';
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full', true );
		
			$out .= '<div class="'.$class.'">';
			$out .= '<div class="iva-pests">';
			if( has_post_thumbnail( $post->ID )){
				$out .= '<div class="pest-img">';				
				$out .= '<figure><a href="'.esc_url( $permalink ).'">';
				$out .= atp_resize( $post->ID,'',$width,$height,'pest-thumb','' );
				$out .= '</a></figure>';
				$out .= '<span class="imgoverlay"></span>';
				$out .= '</div>';
			}
			if ( $title == 'true') {
				$out .= '<div class="cs-title">';
				$out .= '<h2><a href="'.esc_url( $permalink ).'">'.$post_title.'</a></h2>';
				$out .= '</div>';
			}
			$out .= '</div>'; //  .pest-list end
			$out .= '</div>'; //  .column end
			if( $column_index == $columns ){
				$column_index = 0;
				$out .='<div class="clear"></div>'; // clear class
			}

		endwhile;
		
		$out .='<div class="clear"></div>'; // clear class
		
		// Pagination
		if( $pagination === 'true' ){ 
			$out .= iva_pagination();
		}
		wp_reset_query();
		else :
			$out .= '<h2>'.__('No records Found','iva_theme_front').'</h2>';
		endif;
		return $out;
		
}
add_shortcode('pests','iva_pest_list'); //add shortcode
?>