<?php
	// Google Map shortcode
	//--------------------------------------------------------
if ( !function_exists( 'iva_sc_googlemap' ) ){
	function iva_sc_googlemap( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'width'     		=> '',
			'height'    		=> '500',
			'address'   		=> '',
			'controls'  		=> '[]',
			'longitude' 		=> '',
			'latitude'			=> '',
			'html'      		=> '',
			'infowindow' 		=> 'false',
			'zoom'      		=> 12,
			'align'     		=> false,
			'maptype' 			=> 'ROADMAP',
			'controller' 		=> 'false', 
			'mapTypeControl'	=> 'true',
			'streetViewControl' => 'true',
			'color'				=> '#ff8800',
		), $atts));
	
		// Width set as integer
		if( is_numeric($width) ){
			$width = 'width:'.$width.'px;';
		}else{
			$width = 'width:'.$width;
		}
		// Height set as integer
		if( is_numeric($height) ){
			$height = 'height:'.$height.'px';
		}else{
			$height = 'height:'.$height;
		}
				
		$align 				= $align ?' align'.$align:'';
		$controller 		= ($controller == "true" ) ? 'true':'false';
		$infowindow 		= ($infowindow == "true" ) ? 'true':'false';
		$mapTypeControl 	= ($mapTypeControl == "true" ) ? 'true':'false';
		$streetViewControl 	= ($streetViewControl == "true" ) ? 'true':'false';
		
		$id = rand(1,1000);
		
		add_action('wp_footer', 'ivafw_sc_gmap_script');
		
		$out = '<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery("#g_map'.$id.'").gMap({
				icon: {
					image: "'.IVA_SC_IMG_URI.'gmap_marker.png",
					iconsize: [37, 51],
					iconanchor: [20, 51],
					infowindowanchor: [-5, 20],
				},
				zoom:'.$zoom.',
				scrollwheel: '.$controller.',
				zoomControl :'.$controller.',
				scaleControl: '.$controller.',
				maptype: google.maps.MapTypeId.' . $maptype . ',
				mapTypeControl : '.$mapTypeControl.',
				streetViewControl: '.$streetViewControl.',
				markers:[';
				
				if( $latitude && $longitude ){
					$array_address 	= @explode("|", $address);
					$array_html		= @explode("|", $html);
					
					$out .= '{
								latitude:'.$latitude.',
								longitude:'.$longitude.',
								popup :'.$infowindow.',
								html:"'.html_entity_decode($address).'" 
							} ';
				}else{
					$array_address 	= @explode("|", $address);
					$array_html 	= @explode("|", $html);
					$counts			= count($array_address);
					$j = 1;
					for( $i=0; $i<$counts; $i++ ) {
						$html_address = $array_html[$i] ? $array_html[$i]: '_address';
						$out .= '{
									address:"'.$array_address[$i].'",
									popup :'.$infowindow.',
									html:"'.html_entity_decode($html_address).'"
								}';
						if( $counts != $j ){
							$out .= ',';
						}
						$j++;
					}
				}
				$out .= '],
				controls: false,
				styles: [
							{
								stylers: [
									{ hue: "'.$color.'", },
									{ saturation: -20 }
								]
							},{
								featureType: "road",
								elementType: "geometry",
								stylers: [
									{ lightness: 100 },
									{ visibility: "simplified" }
								]
							},{
								featureType: "road",
								elementType: "labels",
								stylers: [
									{ visibility: "off" }
								]
							}
				]
			});
		});	
		</script>';
		$out .= '<div class="atpmap" id="g_map'.$id.'"  style="'.$width.';'.$height.'"></div>';
		return $out;
	}
	add_shortcode('gmap', 'iva_sc_googlemap');
}
	

	function ivafw_sc_gmap_script() {
		wp_print_scripts('iva-sc-gmap');
		wp_print_scripts('iva-sc-gmapmin');
	}
?>