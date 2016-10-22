<?php
	// SOCIABLES 
	//--------------------------------------------------------
 if( !function_exists('iva_sc_sociable')){
	function iva_sc_sociable ($atts, $content = null) {
		extract(shortcode_atts(array(
			'title'		=> '',
			'color'     => 'black'
		), $atts));

		$out = '';
		if($title) {
			$out .= '<h4 class="widget-title">'.$title.'<span></span></h4>'; 
		}
		$out .= atp_social($color);
		return $out;
	}
	add_shortcode('sociable','iva_sc_sociable');
 }
	
?>