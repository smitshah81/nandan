<?php
// CONTACT INFO 
//--------------------------------------------------------
if ( !function_exists( 'iva_sc_contact_info' ) ){
	function iva_sc_contact_info( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'name'			=> '',
			'address'		=> '',
			'phone'			=> '',
			'email'			=> '',
			'website_name'	=> '',
			'website_url'   => '',
			'fax'           => '',
			'animation' 	=> '',
		), $atts));

		// Animation Effects
		//--------------------------------------------------------	
		$animation = $animation ? ' data-id="' . $animation . '"' : '';
		$out = '<div '.$animation.' class="contactinfo-wrap iva_anim ">';
		if( $name ) {
			$out .= '<p class="contactinfo-title"><strong>'.$name.'</strong></p>';
		}
		if( $address ) {
			$out .= '<p><i class="fa fa-map-marker fa-fw"></i>';
			$out .= $address;
			$out .= '</p>';
		}
		if( $phone ) {
			$out .= '<p><i class="fa fa-phone fa-fw"></i>'.$phone.'</p>';
		}
		if( $email ) {
			$out .= '<p><i class="fa fa-envelope fa-fw"></i><a href="mailto:'.$email.'">'.$email.'</a></p>';
		}
		if( $website_url ) {
			$out .= '<p><i class="fa fa-link fa-fw"></i><a href="'.esc_url($website_url).'">'.$website_name.'</a></p>';
		}
		if( $fax ) {
			$out .= '<p><i class="fa fa-fax fa-fw"></i>'.$fax.'</p>';
		}
		$out .= '</div>';
		
		return $out;
	}
	add_shortcode('contactinfo', 'iva_sc_contact_info');
}


?>