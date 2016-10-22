<?php
	/**
	 * function iva_bk_callout()
	 */	
	function iva_bk_callout($atts, $content = null, $code) {
		extract( shortcode_atts( array(
			'title'			=> '',
			'padding' 		=> '',
			'textcolor'		=> '',
			'buttoncolor'	=> 'yellow',
			'bgcolor'		=> '',
			'margintop'		=> '',
			'buttontext'	=> '',
			'rounded'		=> '',
			'shortinfo'		=> '',

		), $atts )); 
	
		// Defines null value
		$out = '';
	
		// Outputs variables
		$iva_textcolor	= $textcolor ? 'color:'.$textcolor.';':'';
		$iva_buttoncolor= $buttoncolor ? 'color:'.$buttoncolor.';':'';
		$iva_bgcolor 	= $bgcolor ? 'background-color:'.$bgcolor.';':'';
		
		$iva_margintop = $margintop ? 'margin-top: '. $margintop .';':'';
		
		$iva_padding	= $padding ? 'padding:'.$padding.';' : '' ;

		$iva_buttontext =  $buttontext ? $buttontext : __('Booking', 'aivah_shortcodes');

		$iva_callouttitle =  $title ? $title :'';

		// Booking Section Styles
		if (!empty( $iva_textcolor ) || !empty( $iva_bgcolor ) || !empty( $iva_padding ) || !empty( $iva_margintop ) ) {
			$iva_styles = ' style="'. $iva_bgcolor.$iva_textcolor.$iva_padding.$iva_margintop.'"';
		} else {
			$iva_styles = '';
		}
		global $atp_defaultdate;
		
		$firstday		  = get_option( 'iva_first_day' ) ? get_option( 'iva_first_day' ) : '0';
		$iva_disable_days = get_option( 'iva_disable_days' ) ? get_option( 'iva_disable_days' ) : '';	
		
		$iva_lb_name 	  = get_option( 'iva_bk_fnametxt' ) ? get_option( 'iva_bk_fnametxt' ) :__( 'Name','aivah_shortcodes' );
		$iva_lb_date 	  = get_option( 'iva_bk_date_txt' ) ? get_option( 'iva_bk_date_txt' ) :__( 'Date','aivah_shortcodes' );
		$iva_lb_email	  = get_option( 'iva_bk_emailtxt' ) ? get_option( 'iva_bk_emailtxt' ) :__( 'Email','aivah_shortcodes' );
		$iva_lb_phone	  = get_option( 'iva_bk_phonetxt' ) ? get_option( 'iva_bk_phonetxt' ) :__( 'Phone Number','aivah_shortcodes' ); 

		$out .= '<script type="text/javascript">
				jQuery(document).ready(function($) {
						
					var disabledDays 	= ['.$iva_disable_days.'];
				
					// Disabled specific days:
					function disable_specificdays(date) {
						var m = date.getMonth() + 1, d = date.getDate(), y = date.getFullYear();
					
						for ( var i = 0; i < disabledDays.length; i++ ) {
							if ( date.getDate() == disabledDays[i] ) {
								return [0];
							}
						}
						return [1];
					}
					
					jQuery( "#dateselect" ).datepicker({ 
						dateFormat: "'.$atp_defaultdate.'",
						showOtherMonths: true,
						selectOtherMonths: true,
						beforeShowDay : disable_specificdays,
						minDate: 0,
						firstDay:"'.$firstday.'"
					});
					
					jQuery("#button_submit").on("click",function(){
						var bk_name  = jQuery("#iva_bk_name").val();
					    var bk_date  = jQuery("#dateselect").val();
					    var bk_email = jQuery("#iva_bk_email").val();
						var bk_phone = jQuery("#iva_bk_phone").val();
						
					    var proceed = true;
						
					    filter = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
					    if( filter.test( bk_email ) ){
					     jQuery(".iva_email").removeClass("error"); 
					      proceed = true;
					    }else{
					     jQuery(".iva_email").addClass("error");
					       proceed = false;
					    }
					    if(bk_name ===""){
					      jQuery(".iva_name").addClass("error");
					      proceed = false;
					    }
						if(bk_name){
							jQuery(".iva_name").removeClass("error"); 
						}

						if(bk_phone ===""){
					      jQuery(".iva_phone").addClass("error");
					      proceed = false;
					    }
						if(bk_phone){
							jQuery(".iva_phone").removeClass("error"); 
						}

						if(bk_date ===""){
					      jQuery(".iva_date").addClass("error");
					      proceed = false;
					    }
						if(bk_date){
							jQuery(".iva_date").removeClass("error"); 
						}
					    if(proceed){
					      return true;
					    }else{
					      return false;
					    }
					});
         		});
				</script>';

		// Booking callout form
		$out .='<div class="iva_bk_section" '.$iva_styles.'>';
		$out .='<div class="iva_bk_inner"><div class="iva_bk_content">';

		$out .= '<div class="one_third mb0">';

		if ($title) {
			$out .= '<div class="fancyheading">';
			$out .='<h1 class="fancy-title large"><span>'.$iva_callouttitle.'<br>';
			$out .= '</span>';
			if ($shortinfo) {
				$out .='<small>'.$shortinfo.'</small>';
			}
			$out .= '</h1></div>';
		}
		($rounded == 'true')  ? ($rounded = 'rounded') : $rounded = '';

		$out .= '</div>';
		$out .= '<div class="two_third mb0 last">';

		$out .='<div class="iva_bkform_wrap">';
		$out .='<form name="iva_bkform" method="post" action="'.esc_url(get_permalink(get_option('iva_bk_template_page'))).'">';
		$out .='<div class="one_half form_col"><input type="text" name="iva_bk_name" id="iva_bk_name" value="" placeholder="'.$iva_lb_name.'" class="iva_name"></div>';
		$out .='<div class="one_half form_col last"><input type="text" name="iva_bk_email" value="" placeholder="'.$iva_lb_email.'"  id="iva_bk_email" class="iva_email"></div>';
		$out .='<div class="one_half form_col"><input type="text" name="bookingdate" readonly="readyonly" value="" placeholder="'.$iva_lb_date.'" id="dateselect" class="iva_date"></div>';
		$out .='<div class="one_half form_col last"><input type="text" name="phone" id="iva_bk_phone" value="" placeholder="'.$iva_lb_phone.'" class="iva_phone"></div>';
		$out .='<div class="clear"></div>';
		$out .='<button id="button_submit" type="submit" class="mb0 btn '.$buttoncolor.' '.$rounded.' large"><span>'.$iva_buttontext.'</span></button>';
		$out .='</form>';
		$out .='</div>';

		$out .= '</div>';

		$out .='</div></div>';
		$out .='</div>';
		
		wp_enqueue_script('jquery-ui-datepicker');
		// Returns output
		return $out;
	}

	// Adds a hook for a shortcode tag('booking_callout'). 
	add_shortcode('booking_callout', 'iva_bk_callout');