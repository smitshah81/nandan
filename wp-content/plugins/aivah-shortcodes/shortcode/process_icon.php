<?php
	// P R O G R E S S I C O N
	//--------------------------------------------------------
 if( !function_exists('iva_sc_process_steps')){
	function iva_sc_process_steps( $atts, $content = null ){
		extract(shortcode_atts(array(
			'process_type'	=> '',
			'steps'		=>'',
		), $atts));
		
		//
		
		$steps 		= $steps ? $steps : '';
		$out = '';

		//
	
		$process_class = 'process_steps step'.$steps;
		

		//
		$out .= '<div class="'.$process_class.' clearfix">';
		$out .=  '<ul>';
		$out .=  do_shortcode($content);
		$out .=  '</ul>';
		$out .=  '</div>';

		return $out;
	}
	add_shortcode('process-steps', 'iva_sc_process_steps');
 }	
	
	
 if( !function_exists('iva_sc_step')){
	function iva_sc_step( $atts, $content = null ){
		extract(shortcode_atts(array(
			'color'	=> '',
			'icon'	=> ''
		), $atts));

		//
		$color 		= $color ? $color : '';
		$icon 		= $icon ? $icon : '';
		
		//
		$out = '';
		$out .='<li>';
		$out .= '<div class="pIcn_wrap"><div class="process_icon '.$color.'"><i class="fa '.$icon.'"></i></div></div>';
		$out .='<div class="pIcn_heading">'.do_shortcode($content).'</div>';
		$out .='</li>';
		
		return $out;
	}
	add_shortcode('step', 'iva_sc_step');
 }
	
	