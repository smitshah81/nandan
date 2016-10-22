<?php
	/**
	 * function iva_message_box()
	 * 
	 * Alter message box shortcode function
	 *
	 * @param  array $atts
	 * @param  string $content 
	 * @param  [type] $code   
	 * @return mixed          
	 */
 if( !function_exists('iva_sc_message_box')){
	function iva_sc_message_box( $atts, $content = null, $code ) {
		extract( shortcode_atts( array(
			'align'		=> false,
			'msg_type'	=> '',
			'note'		=> '',
			'border'	=> '',
			'size'  	=> '',
			'close'		=> '',
			'bgcolor'	=> '',
			'text_color'=> '',
		), $atts));
		$out = '';

		$msg_type 	= $msg_type ? ''.$msg_type:'';
		$border 	= $border ? ''.$border:'';
		$size 		= $size ? ''.$size:'';

		$bgcolor 	= $bgcolor ? 'background-color: '. $bgcolor .'; ' : '';
		$text_color = $text_color ? 'color: '. $text_color .';':'';
		$styling 	= ( $msg_type == 'custom' ) ? ' style="'. $bgcolor.$text_color. '"' : '' ;
		
		//
		if ( $border == 'solid' ) {
			$border = 'iva-box-solid';
		} elseif ( $border == 'dashed' ) {
			$border = 'iva-box-dashed';
		} else {
			$border = '';
		}

		//
		if ( $size == 'large' ) {
			$size = 'iva-box-large';
		} else {
			$size = 'iva-box-normal';
		}

		// Generate Output
		$out .= '<div class="iva_message_box ' . $msg_type .' '.$border .' '.$size . ' clearfix" '.$styling.'>';
		$out .= '<span class="iva_message_box_title">'. $note .'</span>';
		$out .= '<div class="iva_message_box_content">';	
		
		$out .= do_shortcode( $content );
		
		if ( $close == 'true' ) {
			$out .='<span class="close">x</span>';
		}
		$out .= '</div>';
		$out .= '</div>';

		return $out;
	}
	add_shortcode( 'message', 'iva_sc_message_box' );
 }
	

?>