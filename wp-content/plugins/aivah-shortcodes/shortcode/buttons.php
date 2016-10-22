<?php

	// B U T T O N 
	//--------------------------------------------------------
if ( !function_exists( 'iva_sc_button' ) ){
	function iva_sc_button( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'style'				=> '',
			'size'				=> 'medium',
			'button_color'		=> '',
			'id'				=> '',
			'sub_class'			=> '',
			'link'				=> '',
			'link_target'		=> '',
			'full_width'		=> '',
			'align'				=> '',
			'bgcolor'			=> '',
			'hover_bgcolor'		=> '',
			'hover_textcolor'	=> '',
			'text_color'		=> '',
			'lightbox'			=> '',
			'width'				=> '',
			'border_color' 		=> '',
			'button_icon'		=> ''

		), $atts));
		$rel = $linktarget = $icon_style = '';
		$button = "btn";

		if($hover_bgcolor){
			$hoverbgcolor	= $hover_bgcolor 	? ($bgcolor ? ' data-btn-bg="'.$bgcolor.'"':'').' data-btn-hoverBg="'.$hover_bgcolor.'"':'';
		}else{
			$hoverbgcolor	= $hover_bgcolor 	? ($bgcolor ? ' data-btn-bg="'.$bgcolor.'"':'').' data-btn-hoverBg="'.$bgcolor.'"':'';
		}	
		if($hover_textcolor !=''){
			$hovertextcolor	= $hover_textcolor 	? ($text_color ? ' data-btn-color="'.$text_color.'"':'').' data-btn-hoverColor="'.$hover_textcolor.'"':'';
		}else{
			$hovertextcolor	= $hover_textcolor 	? ($text_color ? ' data-btn-color="'.$text_color.'"':'').' data-btn-hoverColor="'.$text_color.'"':'';
		}
		$bgcolor 		= $bgcolor ? 'background-color:'.$bgcolor.';':'';
		$btn_color 		= $button_color ? ''.$button_color:'';
		$bordercolor 	= $border_color ? ''.$border_color:'';
		$id 			= $id ? 'id="'.$id.'"':'';
		$sub_class 		= $sub_class ? ''.$sub_class:'';
		$link 			= $link ? ' href="'.esc_url($link).'"':'';
			
		if($link_target== 'true'){
			$linktarget = 'target = "_blank"';
		}	
	
		$width 			= $width ? 'width:'.$width.';':'';
		$textcolor 		= $text_color ? 'color:'.$text_color.';':'';
		$cssextras 		= ($bgcolor!='') ? ' style="'.$bgcolor.$textcolor.$width.'"':'';
		$button_icon    = ($button_icon) ? $button_icon : '';
		
		if( $full_width == 'true' ){
			$full_width = 'full';
		}else{
			$full_width = '';
		}
		if( $lightbox =="true" ) { $rel = 'data-rel="prettyPhoto[iframes]"'; }
		
		if($style =='border'){
			$icon_color = 'class='.$bordercolor;
		}else{
			$icon_color = ($text_color!=='') ? ' style="'.$textcolor.'"':'';	
		}
		if($button_icon){
			$icon_style ="<i class='fa ".$button_icon."'></i>";
		}
		if($content){
			$content = "<a $rel $id $link $linktarget $hoverbgcolor $hovertextcolor $cssextras  class=' $button $align $size $full_width $btn_color $bordercolor $sub_class $style'>".$icon_style."<span>" .trim($content). "</span></a>";
			if( $align === 'center' ){
				return '<p class="center">'.$content.'</p>';
			}else {
				return $content;	
			}
		}
			
	}
	add_shortcode('button', 'iva_sc_button');
}
	
?>