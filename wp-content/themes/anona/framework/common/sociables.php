<?php 
	// Sociables
	function atp_social($color) {
	
		$out = '';
		if ( get_option( 'atp_social_bookmark' ) != '' ) {
		
			$sys_social_bookmark_icons = explode('#;', get_option('atp_social_bookmark'));
			$out = '<ul class="atpsocials">';
			for ( $i=0; $i < count( $sys_social_bookmark_icons ); $i++ ) {
				$sys_social_bookmark_icon = explode('#|', $sys_social_bookmark_icons[$i]);
				if ( $sys_social_bookmark_icon[1] == '' ) {
					$sys_social_bookmark_icon[1] = '#';	
				}
				if( $color =="black" ){
					$icon_color = "_bio";
				}else {
					$icon_color ='';
				}				

				if ( $color == 'black' ){
					$out .= '<li class="'.$sys_social_bookmark_icon[1].'"><a href="'.esc_url( $sys_social_bookmark_icon[2] ).'" target="_blank">';
					$out .= '<i class="fa fa-'.$sys_social_bookmark_icon[1].' fa-lg" title="'.$sys_social_bookmark_icon[0].'"></i></a></li>';
				}else{
					$out .= '<li class="'.$sys_social_bookmark_icon[1].'"><a href="'.esc_url( $sys_social_bookmark_icon[2] ).'" target="_blank">';
					$out .= '<i class="fa fa-'.$sys_social_bookmark_icon[1].' fa-lg white" title="'.$sys_social_bookmark_icon[0].'"></i></a></li>';
				}

			} //End for
			$out .= '</ul>';
		}

		return $out;
	}
?>