<?php

// F A N C Y B O X 
//--------------------------------------------------------
if ( !function_exists( 'iva_sc_fancy_box' ) ){
	function iva_sc_fancy_box( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'title'				=> '',
			'title_color'		=> '',
			'title_bgcolor'		=> '',
			'box_textcolor'		=> '',
			'box_bgcolor'		=> '',
			'ribbon_text'    	=> '',
			'default_color'		=> '',
			'ribbon_size'		=> '',
			'rib_custom_color'  => '',
			'ribbon_check'		=> '',
			'animation' 		=> ''
		), $atts));
		
		$titlebgcolor 		= $title_bgcolor 	? 'background-color:'.$title_bgcolor.';' : '';
		$titlecolor			= $title_color 		? 'color:'.$title_color.';' : '';
		$boxbgcolor			= $box_bgcolor 		? 'background-color:'.$box_bgcolor.';' : '';
		$boxtextcolor		= $box_textcolor 	? 'color:'.$box_textcolor.';' : '';

		if( !empty($boxbgcolor) || !empty($boxtextcolor)){
			$boxextras = ' style="'.$boxbgcolor.$boxtextcolor.'"';
		}else{
			$boxextras = '';
		}

		if( !empty($titlebgcolor) || !empty($titlecolor)){
			$extras = ' style="'.$titlebgcolor.$titlecolor.'"';
		}else{
			$extras = '';
		}
		$banner_class ='';
		if($ribbon_check == 'true'){
			$banner_class = 'class ="banner"';
		}
		// Animation Effects 
		//--------------------------------------------------------	
		$animation = $animation ? ' data-id="' . $animation . '"' : '';
		$out  = '<div '.$animation.' class="fancybox iva_anim" '.$boxextras.'>';					
		$out .= '<div class="ribbon ribbon-'.$ribbon_size.' ribbon-'.$default_color.'">';			
		$out .=	'<div '.$banner_class.' >';
		$out .=	'<div class="text '.$default_color.'"  >'.$ribbon_text.'</div>';
		$out .=	'</div>';
		$out .=	'</div>';

		if( $title ){
			$out .= '<h4 class="fancytitle" '.$extras.'>' .$title. '</h4>';
		}
		
		$out .= '<div class="boxcontent">';
		$out .= do_shortcode($content) .'</div></div>';
		return $out;
	}
	add_shortcode('fancybox', 'iva_sc_fancy_box');
}
	
		
		
	// Callout Box
	//--------------------------------------------------------
if ( !function_exists( 'iva_sc_callout_box' ) ){
	function iva_sc_callout_box( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'bgcolor'		=> '',
			'textcolor'		=> '',
			'buttontext'	=> '',
			'buttoncolor'	=> '',
			'buttonlink'	=> '',
			'buttonsize'	=> 'small',
			'linktarget'	=> '',
			'btn_color'		=> '',
			'btn_border'	=> '',
			'fullwidth'     => '',
			'btn_style'		=> '',
			'animation'		=> ''
		), $atts));

		$link_target = '';

		if($fullwidth == 'yes' ){
			$fullwidth = "fullwidth";
		}
		if($linktarget == 'true'){

			$link_target = 'target = "_blank"';
		}
		
		$buttonlink 	= $buttonlink 	? ' href="'.esc_url($buttonlink).'"':'';
		$bgcolor 		= $bgcolor 		? ' background-color:'.$bgcolor.';' : '';
		$textcolor		= $textcolor ? ' color:'.$textcolor.';' : '';

		if( !empty($bgcolor)){
			$bg_color = ' style="'.$bgcolor.'"';
		}else{
			$bg_color = '';
		}
		
		if(!empty($textcolor)){
			$text_color = ' style="'.$textcolor.'"';
		}else{
			$text_color = '';
		}

		// Animation Effects
		//--------------------------------------------------------	
		$animation = $animation ? ' data-id="' . $animation . '"' : '';
		$out = '<div '.$animation.' class="callOutBox iva_anim '.$fullwidth .'" '.$bg_color.'>';
		$out .= '<div class="teaser_content">';
		$out .= '<div class="callout_text" '.$text_color.'>';
		$out .= do_shortcode($content);
		$out .= '</div>';
		$out .= '<div class="callout_btn"><a '.$buttonlink.' '.$link_target.' class="btn '.$btn_style.' '.$buttonsize.' '.$btn_color.' '.$btn_border.'"><span>'.$buttontext.'</span></a></div>';
		$out .= '</div></div>';
		$out .='<div class="clear"></div>';
		return $out;
	}
	add_shortcode('calloutbox', 'iva_sc_callout_box');
}

?>