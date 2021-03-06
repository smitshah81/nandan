<?php

	// F L A S H   V I D E O 
	//--------------------------------------------------------
if( !function_exists('iva_sc_flash')){
	function iva_sc_flash($atts, $content = null) {
		extract(shortcode_atts(array (
			'width'		=> '560',
			'height'	=> '315',
			'id'		=> '',
			'src'		=> '',
		), $atts));

		$out = '<div class="video-stage" style="width:'.$width.'; height:'.$height.'">
				<object id="'.$id.'" width="'.$width.'" height="'.$height.'">
				<param name="movie" value="'.$src.'"></param>
				<param name="allowFullScreen" value="true"></param>
				<param name="expressInstaller" value="'.THEME_DIR.'/swf/expressInstall.swf"></param>
				<param name="allowscriptaccess" value="always"></param>
				<embed src="'.$src.'" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="'.$width.'" height="'.$height.'" wmode="opaque">
				</embed>
				</object>';
		$out .= '</div>';
		return $out;
	}
	add_shortcode('flash','iva_sc_flash');
}

	// Y O U T U B E   V I D E O 
	//--------------------------------------------------------
if( !function_exists('iva_sc_youtube')){
	function iva_sc_youtube($atts, $content = null) {
		extract(shortcode_atts(array (
			'width'		=> '560',
			'height'	=> '315',
			'clipid'	=> '',
			'autoplay'	=> '',
		), $atts));
		
		$out = '';
		
		if (!empty($clipid)){
			$out .= '<div class="video-stage">';
			if (empty($clipid)) $out.='Invalid Youtube clipid';
			if ($height && !$width) $width = intval($height * 16 / 9);
			if (!$height && $width) $height = intval($width * 9 / 16);
			$out .='<iframe  src="http://www.youtube.com/embed/'.$clipid.'?autoplay='.$autoplay.'&amp;wmode=transparent" width='.$width.' height='.$height.' frameborder="0"></iframe></div>';
		}
		return $out;
	}
	add_shortcode('youtube','iva_sc_youtube');
}

	// V I M E O   V I D E O 
	//--------------------------------------------------------
if( !function_exists('iva_sc_vimeo')){
	function iva_sc_vimeo($atts, $content = null) {
		extract(shortcode_atts(array (
			'width'		=> '560',
			'height'	=> '315',
			'clip_id'	=> '',
			'autoplay'	=> '',
		), $atts));

		$out = '';
		if (!empty($clip_id) && is_numeric($clip_id)){
			$out .= '<div class="video-stage">';
			if (empty($clip_id) || !is_numeric($clip_id)) $out.='Invalid Vimeo clipid';
			if ($height && !$width) $width = intval($height * 16 / 9);
			if (!$height && $width) $height = intval($width * 9 / 16);
		
			$out .= "<iframe src='http://player.vimeo.com/video/$clip_id?autoplay=$autoplay&ampportrait=0' width='$width' height='$height' frameborder='0'></iframe>"; 
			$out .= '</div>';
		}
		return $out;
	}
	add_shortcode('vimeo','iva_sc_vimeo');
}
	
	// S O U N D   C L O U D   P L A Y E R
	//--------------------------------------------------------
if( !function_exists('iva_sc_soundcloud')){
	function iva_sc_soundcloud($atts, $content = null) {
		extract(shortcode_atts(array (
			'type' 		=> '',
			'width'		=> '100%',
			'height'	=> '',
			'audio_id'	=> '',
			'autoplay'	=> 'false',
			'show_art'	=> 'true',
			'color' 	=> 'ff6600',
			
		), $atts));
		
		 $color = str_replace("#", "",$color);;
		if($type == "html5") $return = "<div class='soundcloud-html5'><iframe width='$width' height='$height' src='https://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F$audio_id&amp;color=$color&amp;auto_play=$autoplay&amp;show_artwork=$show_art'></iframe></div>";
		else if($type == "flash") $return = "<div class='soundcloud-flash'><object height='$height' width='$width'><param name='movie' value='https://player.soundcloud.com/player.swf?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F$audio_id&amp;color=$color&amp;auto_play=$autoplay&amp;show_artwork=$show_art&amp;show_playcount=true&amp;show_comments=true'></param><param name='allowscriptaccess' value='always'></param><embed allowscriptaccess='always' src='https://player.soundcloud.com/player.swf?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F$audio_id&amp;color=$color&amp;auto_play=$autoplay&amp;show_artwork=$show_art&amp;show_playcount=true&amp;show_comments=true' type='application/x-shockwave-flash' width='$width' height='height'></embed></object></div>";		
		return $return;
	}
	add_shortcode('soundcloud','iva_sc_soundcloud');
}
?>