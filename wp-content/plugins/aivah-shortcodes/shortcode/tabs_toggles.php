<?php
	// T A B S G R O U P
 	//--------------------------------------------------------
if( !function_exists('iva_sc_tab_group')){
	function iva_sc_tab_group($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'tabtype'	=> '',
			'position'	=> '',
			'animation' => '',
		), $atts));

		$icons = $out = $customtabcolor = $customtabtextcolor = '';
		if ( $tabtype == "vertabs" ) {
			$tabtype = 'vertabs';
		} else { 
			$tabtype = 'hortabs';
		}
		switch($position){
			case'centertabs':
							$positiontype = "centertabs";
							break;
			case'righttabs':
							$positiontype = "righttabs";
							break;
			default:
							$positiontype = "";
		}

        if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
			return do_shortcode($content);
        } else {
			for($i = 0; $i < count($matches[0]); $i++) {
				$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
			}

			// Animation Effects 
			//--------------------------------------------------------	
			$animation = $animation ? ' data-id="' . $animation . '"' : '';			
			$out .= '<div '.$animation.' id="tab'.rand(9,1999).'" class="iva_anim systabspane '.$tabtype.'">';
			$out .= '<ul  class="tabs">';
				for($i = 0; $i < count($matches[0]); $i++) {
					if(isset($matches[3][$i]['tabcolor'])){
						if (strpos($matches[3][$i]['tabcolor'], '#') !== false) {
						$customtabcolor = ' style="background-color:'.$matches[3][$i]['tabcolor'].'"';
						}
					}
					if(isset($matches[3][$i]['textcolor'])){
						if (strpos($matches[3][$i]['textcolor'], '#') !== false) {
							$customtabtextcolor = ' style="color:'.$matches[3][$i]['textcolor'].'"';
						}
					}
					if(isset($matches[3][$i]['icon'])){
						$icons=$matches[3][$i]['icon'];
						
					}
					echo $icons;
					$out .= '<li class="'.$icons.'"  id="#'.$tabtype.$i.'" ' .$customtabcolor. '  ><a '.$customtabtextcolor.' href="#'.$tabtype.$i.'">' . $matches[3][$i]['title'] . '</a></li>';
				}
			$out .= '</ul>';
			$out .= '<div class="panes">';
			for($i = 0; $i < count($matches[0]); $i++) {
				$out .= '<div  class="tab_content" id="'.$tabtype.$i.'" >' . do_shortcode(trim($matches[5][$i])) . '</div>';
			}
			$out .= '</div></div>';
		       
			return $out;
		}
	}
	
	add_shortcode('tab', 'iva_sc_tab_group');
	add_shortcode('minitabs', 'iva_sc_tab_group');
}
?>