<?php
	//  I C O N  B O X
if ( !function_exists( 'iva_sc_icon_box' ) ){
	function iva_sc_icon_box( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'title'				=> '',
			'style'				=> '',
			'icon'				=> '',
			'icon_color'		=> '',
			'align'				=> 'left',
			'def_icon_color'	=> '',
			
		), $atts));
		//style2,3
		$iconbgcolor	= $def_icon_color ? ' background-color:'.$def_icon_color.';':'';
		$icon_bgcolor 	= $iconbgcolor ? 'style="'.$iconbgcolor.'"':'';
		//style1
		$iconcolor 	= $icon_color ? 'color:'.$icon_color.';':'';
		$extras_style1 	= $iconcolor ? 'style="'.$iconcolor.'"':'';
		//Style 4,5
		$icon_bgcolor3	= $icon_color ? 'background-color:'.$icon_color.';':'';
		$icon_bgcolor_style3	= $icon_bgcolor3 ? 'style='.$icon_bgcolor3.'':'';
		
		//
		$icon_border_style4	= $def_icon_color ? ' border:1px solid '.$def_icon_color.';':'';
		$icon_bgcolor_style4 	= $iconbgcolor ? 'style="'.$icon_border_style4.' '.$iconbgcolor.'"':'';
		
		$out ='';
		$out .= '<div class="atp-services">';
	
		//
		if($style == 'style1'){
			$out .= '<div class="serviceIcn_style1">';
			$out .= '<div class="sIcn_heading">';
			$out .= '<i class="fa '.$icon.' services_icon1" '.$extras_style1.'></i>';
			$out .= '</div>';
			$out .= '<div class="sIcn_content"><h3>'.$title.'</h3>'.do_shortcode($content).'</div>';
			$out .= '</div>';
		}
		if($style == 'style2'){
			$out .= '<div class="serviceIcn_style2a">';
			$out .= '<div class="services_icon2a '.$def_icon_color.'" >';
			$out .= '<i   class="fa '.$icon.'"></i>';
			$out .= '</div>';
			$out .= '<div class="sIcn_heading2a">';	
			$out .= '<h3>'.$title.'</h3>';
			$out .= '<div class="sIcn_content2a">'.do_shortcode($content).'</div>';
			$out .= '</div>';
			$out .= '</div>';
		}
		if($style == 'style3'){
			$out .= '<div class="serviceIcn_style2b">';
			$out .= '<div class="services_icon2b '.$def_icon_color.'" >';
			$out .= '<i class="fa '.$icon.'"></i>';
			$out .= '</div>';
			$out .= '<div class="sIcn_heading2b">';	
			$out .= '<h3>'.$title.'</h3>';
			$out .= '<div class="sIcn_content2b">'.do_shortcode($content).'</div>';
			$out .= '</div>';
			$out .= '</div>';
		}

		if($style == 'style4'){
			$out .= '<div class="Icnbox_style top">';
			$out .= '<i class="fa '.$icon.' services_icon3" '.$icon_bgcolor_style3.'></i>';
			$out .= '<div class="sIcn_heading2">';
			$out .= '<h3>'.$title.'</h3>';
			$out .= '<div class="sIcn_content2">'.do_shortcode($content).'</div>';
			$out .= '</div>';
			$out .= '</div>';
		}
		if($style == 'style5'){
			$out .= '<div class="Icnbox_style left">';
			$out .= '<i class="fa fa-shopping-cart services_icon4" '.$icon_bgcolor_style3.'></i>';
			$out .= '<div class="sIcn_heading2">';
			$out .= '<h3>'.$title.'</h3>';
			$out .= '<div class="sIcn_content4">'.do_shortcode($content).'</div>';	
			$out .=	'</div>';
			$out .=	'</div>';
		}
		$out .=	'</div>';
		return $out;
	
	}
	add_shortcode('iconbox', 'iva_sc_icon_box');
}
	

?>