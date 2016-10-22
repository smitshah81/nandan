<?php
	// T W I T T E R 
	//--------------------------------------------------------
if( !function_exists('iva_sc_twitter')){
	function iva_sc_twitter ($atts, $content = null) {
		extract(shortcode_atts(array(
			'limit'		=> '',
			'username'	=> '',
			'consumerkey'	=> '',
			'consumersecret'	=> '',
			'accesstoken'	=> '',
			'accesstokensecret'	=> '',
			'animation' => '',
			'color'		=> 'light',
		), $atts));
			

		$twitter_array = array(
			'username' 				=>  $username,
			'limit' 				=>  $limit,
			'encode_utf8' 			=>  'false',
			'twitter_cons_key' 		=>	$consumerkey,
			'twitter_cons_secret' 	=>	$consumersecret,
			'twitter_oauth_token' 	=>	$accesstoken,
			'twitter_oauth_secret' 	=>	$accesstokensecret
		);

		// Animation Effects 
		//--------------------------------------------------------
		$animation = $animation ? ' data-id="' . $animation . '"' : '';
		$out = '<div '.$animation.' class="iva_anim">';
		ob_start();
		$out .= twitter_parse_cache_feed( $twitter_array, $color );
		$out .= ob_get_contents();
		ob_clean();

		$out .= '</div>';
		return $out;
	}
	add_shortcode('twitter','iva_sc_twitter');
}
?>