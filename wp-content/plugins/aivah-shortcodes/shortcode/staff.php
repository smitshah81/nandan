<?php
	// STAFF BOX
	//--------------------------------------------------------
 if( !function_exists('iva_sc_staff')){
	function iva_sc_staff ($atts, $content= null){
		extract(shortcode_atts(array(
			'photo'			=> '',
			'title'			=> '',
			'role'			=> '',
			'blogger'		=> '',
			'delicious'		=> '',
			'digg'			=> '',
			'facebook'		=> '',
			'flickr'		=> '',
			'forrst'		=> '',
			'google'		=> '',
			'linkedin'		=> '',
			'pinterest'		=> '',
			'skype'			=> '',
			'stumbleupon'	=> '',
			'twitter'		=> '',
			'dribbble'		=> '',
			'yahoo'			=> '',
			'youtube'		=> '',
			'instagram'		=> '',
			'animation' 	=> '',
		), $atts));
		
				/**
		 * sociable icons array.
		 */
		$staff_social = array(
			'' => 'Select Sociable',
			'blogger'       => 'Blogger',
			'delicious'     => 'Delicious',
			'digg'          => 'Digg',
			'facebook'      => 'Facebook',
			'flickr'        => 'Flickr',
			'forrst'        => 'Forrst',
			'google'        => 'Goolge',
			'linkedin'      => 'Linkedin',
			'pinterest'     => 'Pinterest',
			'skype'         => 'Skype',
			'stumbleupon'   => 'Stumbleupon',
			'twitter'       => 'Twitter',
			'dribbble'      => 'Dribbble',
			'yahoo'         => 'Yahoo',
			'youtube'       => 'Youtube',
			'instagram'		=> 'instagram'
		);
		ksort( $staff_social );//sort alphabetical order.

		$before_staff = $after_staff = $out = '';
		
		// Animation Effects
		//--------------------------------------------------------					
		$animation = $animation ? ' data-id="' . $animation . '"' : '';
		$out .= '<div '.$animation.' class="iva_anim bio">';
		$out .= '<div class="staff-pic">';
		if( $photo != '' ){
			$image_photo = iva_sc_resize('',$photo,'520','','','');
			$out .= $image_photo;	
		}
		$out .= '<span class="imgoverlay"></span>';
		$out .= '</div>';
		$out .= '<div class="details bio_meta">';
		if( $title != '' ){
			$out .= '<hgroup>';
			$out .= '<h3>'.$title.'</h3>';
			if( $role != '' ){
				$out .= '<span class="staff-role">'.$role.'</span>';	
			}
			$out .= '</hgroup>';
		}

		if( $content != '' ){
			$out .= do_shortcode($content);
		}
		$out .= '</div>';	
		$count=0;
		foreach( $staff_social as $key => $value ){
		if($key !=''){
			if( $$key != '' ){
				if( $count<1 ){
					$before_staff = '<div class="sociables"><ul class="atpsocials">';
					$after_staff = '</ul></div>';
				}
				$count++;
			}
			}
		}
		
		$out .= $before_staff;
		foreach( $staff_social as $key => $value )	{ 
			if($key !=''){
				if( $$key != '' ){
					$out .= '<li class="'.$key.'"><a class="'.$key.'" href="'.$$key.'"><i title="'.$key.'" class="fa fa-'.$key.' fa-1x"></i></a><span class="ttip">'.ucfirst($key).'</span></li>';	
				}
			}
		}
		$out .= $after_staff;
	
		$out .= '</div><div class="clear"></div>';
		return $out;
	}
	add_shortcode('staff', 'iva_sc_staff');
 }
	
?>