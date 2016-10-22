<?php
	// S E R V I C E S
	//--------------------------------------------------------
 if( !function_exists('iva_sc_services_contents')){
	function iva_sc_services_contents( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'image'		=> '',
			'title'		=> '',
			'link'		=> '',
			'width'		=> '640',
			'height'	=> '640',
			'animation'	=> '',
		), $atts));

		// Animation Effects
		//--------------------------------------------------------	
		$animation = $animation ? ' data-id="'.$animation.'"' : '';
		$out = '<div '.$animation.' class="iva-services iva_anim">';
		if($image !='') {

			$out .= '<div class="service-img">';
			if( $link != ''){
				$out .= '<a href="'.esc_url( $link ).'" target="_blank">';
				$out .= '<figure><img src="'.$image.'" width="'.$width.'" height="'.$height.'" alt=""></figure>';
				$out .= '<span class="imgoverlay"></span>';
				$out .= '</a>';
			}else {
				$out .= '<figure><img src="'.$image.'" width="'.$width.'" height="'.$height.'" alt=""></figure>';
				$out .= '<span class="imgoverlay"></span>';
			}
			$out .= '</div>';

			if ( $title != '' || $link != '' ) {
				$out .= '<div class="cs-title">';
				$out .= '<h2><a href="'.esc_url($link).'" targrt="_blank">'.$title.'</a></h2>';
				$out .= '</div>';
			}
		}
		
		$out .= '</div>';
	
		return $out;
	}
	add_shortcode('services', 'iva_sc_services_contents');
 }
	
?>