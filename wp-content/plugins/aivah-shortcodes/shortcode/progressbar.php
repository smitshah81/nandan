<?php
// P R O G R E S S B A R
//--------------------------------------------------------
 if( !function_exists('iva_sc_progressbar')){
	function iva_sc_progressbar( $atts, $content = null ){
		extract(shortcode_atts(array(
			'progress'	=> '',
			'title'		=> '',
			'color'		=> ''
		), $atts));
		
		$progress_bg 		= (int)$progress;
		$progressvalue  = $progress   ? ' width:'.$progress.'%':'';
		$barcolor 		= $color  ? 'background-color:'.$color.';':'';
		$extras 		=	( $barcolor!==''||$progressvalue!='' ) ? ' style="'.$barcolor.'"':'';
		$style  = 'style="opacity: 1;"';	
		$out = '';
		
		// Animation Effects
		
		$out .= '<div class="iva-progress-bar">';
		//
		$out .= '<p>'. $title .'</p>';
		$out .= '<div class="bar-wrap">';
		$out .= '<span data-width="'. $progress_bg .'%" class="bar-color" '. $extras .'>';
		$out .= '<span>'. $progress_bg .'%</span>';
		$out .= '</span>';
		$out .= '</div>';
		$out .= '</div>';

		return $out;
	}
	add_shortcode('progressbar', 'iva_sc_progressbar');
 }


?>