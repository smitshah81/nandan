<?php
/**
 * function iva_appt_callout()
 */
function iva_appt_callout( $atts, $content = null,$code ) {
	extract( shortcode_atts( array(
		'title'		=> '',
		'padding' 	=> '',
		'textcolor'	=> '',
		'bgcolor'	=> '',
		'buttontext'=> '',
		'buttoncolor'=> 'yellow',
		'rounded'	=> '',
		'shortinfo'	=> '',

	), $atts ));
	
	//Defines null value
	$out = '';		

	//Outputs variables
	$iva_textcolor	= $textcolor ? 'color:'.$textcolor.';':'';
	$iva_bgcolor 	= $bgcolor ? 'background-color:'.$bgcolor.';':'';
	$iva_padding	= $padding ? 'padding:'.$padding.';' : '' ;

	$iva_buttontext =  $buttontext ? $buttontext : __('Appointment','iva_theme_front');

	$iva_callouttitle =  $title ? $title :'';

	//Appointment Section Styles
	if ( !empty( $iva_textcolor ) || !empty( $iva_bgcolor ) || !empty( $iva_padding ) ) {
		$iva_styles = ' style="'.$iva_bgcolor.$iva_textcolor.'"';
	} else {
		$iva_styles = '';
	}
	global $atp_defaultdate;
	
	$iva_cal_fstday			= get_option('iva_first_day')? get_option('iva_first_day'):'0';
	$iva_disable_days  		=  get_option('iva_disable_days') ? get_option('iva_disable_days'):'';

	$fname_txt    = get_option('iva_fname_txt') ? get_option('iva_fname_txt') : __('First Name', 'iva_theme_front');
	$date_txt 	= get_option('iva_date_txt') ? get_option('iva_date_txt'):__('Date','iva_theme_front');
	$email_txt    = get_option('iva_email_txt') ? get_option('iva_email_txt') : __('Email', 'iva_theme_front');
	$phone_txt    = get_option('iva_phone_txt') ? get_option('iva_phone_txt') : __('Phone', 'iva_theme_front');

	$out .='<script type="text/javascript">
			jQuery(document).ready(function($) {
				var disabledDays 	= ['.$iva_disable_days.'];
			
				// Disabled specific days:
				function disable_specificdays(date) {
					var m = date.getMonth() + 1, d = date.getDate(), y = date.getFullYear();
				
					for (var i = 0; i < disabledDays.length; i++) {
						if (date.getDate() == disabledDays[i]) {
							return [0];
						}
					}
					return [1];
				}
				
				jQuery("#dateselect").datepicker({ 
					dateFormat: "'.$atp_defaultdate.'",
					showOtherMonths: true,
					selectOtherMonths: true,
					beforeShowDay : disable_specificdays,
					minDate: 0,
					firstDay:"'.$iva_cal_fstday.'"
				});
				
				jQuery("#button_submit").on("click",function(){
					var apt_name  = jQuery("#iva_apt_name").val();
					var apt_date  = jQuery("#dateselect").val();
					var apt_email = jQuery("#iva_apt_email").val();
					var apt_phone = jQuery("#iva_apt_phone").val();
					
					var proceed = true;
					
					filter = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
					if( filter.test( apt_email ) ){
					 jQuery(".iva_email").removeClass("error"); 
					  proceed = true;
					}else{
					 jQuery(".iva_email").addClass("error");
					   proceed = false;
					}
					if( apt_name ==="" ){
					  jQuery(".iva_name").addClass("error");
					  proceed = false;
					}
					if( apt_name ){
						jQuery(".iva_name").removeClass("error"); 
					}

					if( apt_phone ==="" ){
					  jQuery(".iva_phone").addClass("error");
					  proceed = false;
					}
					if( apt_phone ){
						jQuery(".iva_phone").removeClass("error"); 
					}

					if( apt_date ==="" ){
					  jQuery(".iva_date").addClass("error");
					  proceed = false;
					}
					if( apt_date ){
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

	// Appointment callout form
	$out .='<div class="iva_appt_section" '.$iva_styles.'>';
	$out .='<div class="iva_appt_inner"><div class="iva_appt_content">';

	$out .='<div class="one_third mb0">';

	if ($title) {
		$out .='<div class="fancyheading">';
		$out .='<h1 class="fancy-title large"><span>'.$iva_callouttitle.'<br>';
		$out .='</span>';
		if ($shortinfo) {
			$out .='<small>'.$shortinfo.'</small>';
		}
		$out .='</h1></div>';
	}
	($rounded == 'true')  ? ($rounded = 'rounded') : $rounded = '';

	$out .='</div>';
	$out .='<div class="two_third mb0 last">';

	$out .='<div class="iva_apptform_wrap">';
	$out .='<form name="iva_apptform" method="post" action="'.esc_url( get_permalink( get_option( 'iva_appt_template_page' ) ) ).'">';
	$out .='<div class="one_half form_col"><input type="text" name="iva_apt_name" id="iva_apt_name" value="" placeholder="'.$fname_txt.'" class="iva_name"></div>';
	$out .='<div class="one_half form_col last"><input type="text" name="iva_apt_email" value="" placeholder="'.$email_txt.'"  id="iva_apt_email" class="iva_email"></div>';
	$out .='<div class="one_half form_col"><input type="text" name="appointmentdate" readonly="readyonly" value="" placeholder="'.$date_txt.'" id="dateselect" class="iva_date"></div>';
	$out .='<div class="one_half form_col last"><input type="text" name="phone" id="iva_apt_phone" value="" placeholder="'.$phone_txt.'" class="iva_phone"></div>';
	$out .='<div class="clear"></div>';
	$out .='<button id="button_submit" type="submit" class="mb0 btn '.$buttoncolor.' '.$rounded.' large"><span>'.$iva_buttontext.'</span></button>';
	$out .='</form>';
	$out .='</div>';

	$out .='</div>';

	$out .='</div></div>';
	$out .='</div>';
	wp_enqueue_script('jquery-ui-datepicker');
	$datepicker_language = get_option( 'iva_datepicker_language'); 
			if( $datepicker_language != '')
			{
				wp_enqueue_script('datepicker_language', get_template_directory_uri() . '/js/i18n/datepicker-'.$datepicker_language.'.js', false,false,'all' );
			}
	//Returns output
	return $out;
}

//Adds a hook for a shortcode tag('appointment_callout'). 
add_shortcode('appointment_callout','iva_appt_callout');
	