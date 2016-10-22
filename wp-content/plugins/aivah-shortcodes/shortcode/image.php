<?php
	// I M A G E  
	//--------------------------------------------------------	
if ( !function_exists( 'iva_sc_image' ) ){
	function iva_sc_image( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'link'		=> '',
			'lightbox'	=> 'false',
			'alt'		=> '',
			'class'		=> '',
			'align'		=> false,
			'width'		=> false,
			'height'	=> false,
			'caption'	=> '',
			'target'	=> '',
			'src'		=> '',
			'position'  => '',
			'animation' => '',
		), $atts));
		
		$tooltip_position = "ivatip_".$position;
		if ( !$width || !$height ) {
			if( !$width )  { $width = ''; }
			if( !$height ) { $height = ''; }
		}
		
		$no_link = $rel = $out = '';
		$content = '<figure>'.iva_sc_resize( '', $src, $width, $height, $class, $alt ).'</figure>';
		$default_attr = array(
			'src'	=> $src,
			'class'	=> $class,
			'alt'	=> $alt 
		);
		
		
		if ( $lightbox == 'true' ){
			if ( preg_match_all('!http://.+\.(?:jpe?g|png|gif)!Ui',$link,$matches ) ) {
				$src = $link;
			}
			$rel = ' data-rel="prettyPhoto"';
			$rel .= ' class="lightbox"';
			$link = $src;
		} else {
			if ( $link == '#' ){ $no_link = 'image_no_link'; }
			$target = ' target="_blank"';
		}

		// Animation Effects
		//--------------------------------------------------------	
		$out ='';
		$animation = $animation ? ' data-id="' . $animation . '"' : '';	
		if ( $lightbox=="true" ) {
			$out .= '<span '.$animation.' class="iva_anim iva-tooltip'.'  '.( $align ? ' align'.$align:'' ).'">';
			$out .= '<a   '.$target.''.$rel.' '.( $no_link ? ' class="'.$no_link.'  "':'' ).' alt="'.$alt.'" href="'.$link.'">' . $content . '</a>';
			
			if ( $caption ){
				$out .= '<span class="image_caption ivatip '.$tooltip_position.'">'.$caption.'</span>';
			}
			$out .= '</span>';
		} else {
			$out .= '<span '.$animation.' class=" iva_anim iva-tooltip '.'  '.( $align?' align'.$align:'' ).'" >' ;
			if ( $link != '' ){
				if ( preg_match_all('!http://.+\.(?:jpe?g|png|gif)!Ui',$link,$matches ) ) {
					$link = "#";
				}
				$out .= '<a '.$target.''.$rel.' '.( $no_link? ' class="'.$no_link.'"':'' ).' alt="'.$alt.'" href="'.esc_url($link).'">';
			}
			$out .= $content;
			if ( $link != '' ) {
				$out .= '</a>';
			}
			
			if ( $caption ) {
				$out .= '<span class="image_caption ivatip '.$tooltip_position.'">'.$caption.'</span>';
			}
			
			$out .= '</span>';
			
		}
		return $out;
	}
	add_shortcode('image', 'iva_sc_image');
}
	// EOF iva_image
	
	
?>