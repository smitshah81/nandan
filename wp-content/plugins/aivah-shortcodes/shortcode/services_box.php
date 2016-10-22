<?php
	// S E R V I C E S  B O X
	//--------------------------------------------------------
 if( !function_exists('iva_sc_services_box')){
	function iva_sc_services_box( $atts, $content = null ) {
		extract( shortcode_atts(array(
			'title'		=> '',
			'sb_content'=> '',
			'bg_color'	=> '',
			'text_color'=> '',
			'margin_top'=> '',
			'btn_text'=> '',
			'btn_color'=> 'dark',
		), $atts ) );

		$bg_color 	= $bg_color ? 'background-color: '. $bg_color .'; ' : '';
		$text_color = $text_color ? 'color: '. $text_color .';':'';
		$margin_top = $margin_top ? 'margin-top: '. $margin_top .';':'';
		
		$styling 	= ( $bg_color || $text_color || $margin_top ) ? ' style="'. $bg_color.$text_color.$margin_top.'"' : '' ;
		
		$btn_color = ( $btn_color ) ? $btn_color :'dark';
		
		$out = '<div class="services-box" '.$styling.'>';
		$out .= '<div class="services-inner">';
		if( $title !='' ) {
			$out .= '<div class="services-title">';
			$out .= '<h3>'.$title.'</h3>';
			$out .= '</div>';//.services-title
		}

		if( $sb_content !='' ) {
			$out .= '<div class="services-content">';
			$out .= $sb_content;
			
			if( $btn_text !='' ) {
				$out .= '<div class="btn-wrap">';
				$out .= '<a href="#" class=" btn medium '.$btn_color.' border"><span>'.$btn_text.'</span></a>';
				$out .= '</div>';//.btn-wrap
			}
			$out .= '</div>';//.services-content
		}
		$out .= '</div>';//.services-inner
		$out .= '</div>';//.services-box
		return $out;
	}
	add_shortcode('services_box', 'iva_sc_services_box');
 }
?>