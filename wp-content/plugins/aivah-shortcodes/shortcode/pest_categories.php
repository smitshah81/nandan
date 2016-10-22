<?php
function iva_pest_categories_list ($atts, $content = null,$code) {
	extract(shortcode_atts(array(
			'cats'		=> '',
			'order'		=> 'ASC',
			'orderby'	=> 'menu_order',
			'columns'	=> '6',
			'title'		=> 'true',	
			'limit'		=> '',
		), $atts));
		
	global $post;		
			
	$width="480"; $height = "480" ;	
	
	if( $columns == '6' ) { $class = "one_sixth nomargin";	$columns_id = "sixth"; }
	if( $columns == '5' ) { $class = "one_fifth nomargin";	$columns_id = "fifth";	}
	if( $columns == '4' ) { $class = "one_fourth nomargin";	$columns_id = "fourth"; }
	if( $columns == '3' ) { $class = "one_third nomargin";	$columns_id = "third";	}
	
	$out = '';
	$column_index = 0; //used to identify the column number and move the further results to next row
	
	$last = ( $column_index == $columns && $columns != 1 ) ? 'end ' : '';

	$iva_cats_array = get_terms('pest_category','include='.$cats.'&hide_empty=0&orderby='.$orderby.'&order='.$order.'&number='.$limit.''); 
	foreach ( $iva_cats_array as $pest_order ) {
		
		$column_index++;
		
		$term_id  	= $pest_order->term_id; 	
		$term_meta 	= get_option("taxonomy_$term_id");
		
		$out .= '<div class="'.$class.'">';
		$out .= '<div class="iva-pests">';
		if( isset( $term_meta['img'] ) && $term_meta['img']!=''){
			$out .= '<div class="pest-img">';				
			$out .= '<a href="'.esc_url( get_term_link( $pest_order->slug,'pest_category')).'" targrt="_blank">';
			$out .= '<figure>'. atp_resize( $post->ID,$term_meta['img'],$width,$height,'pest-thumb','' ).'</figure>';
			$out .= '</a>';
			$out .= '<span class="imgoverlay"></span>';
			$out .= '</div>';//.pest-img
		}
		if ( $title == 'true') {
			$out .= '<div class="cs-title">';
			$out .= '<h2><a href="'.esc_url( get_term_link( $pest_order->slug,'pest_category')).'" targrt="_blank">'.$pest_order->name.'</a></h2>';
			$out .= '</div>';//.cs-title
		}
		$out .= '</div>'; //.iva-pests end	
		$out .= '</div>'; //.column end

		if( $column_index == $columns ){
			$column_index = 0;
			$out .='<div class="clear"></div>'; // clear class
		}
	}
	
	$out .='<div class="clear"></div>'; // clear class
	wp_reset_query();
	return $out;
}
add_shortcode('pest_categories','iva_pest_categories_list'); //add shortcode
?>