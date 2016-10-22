<?php
add_filter('customlocalization_themeoptions','iva_customlocalization_themeoptions');
function iva_customlocalization_themeoptions( $iva_of_options ) {	
	global $iva_of_options;	
		$shortname = 'iva';
		
		// Form Labels	
		//---------------------------------------------------------------------------------------------------
		$iva_of_options[] = array( 'name'	=> 'Form Labels', 'desc' => '<h3>Form Labels</h3> Text translation for the Appointment form section.', 'type' => 'subnav');
		//---------------------------------------------------------------------------------------------------
			$iva_of_options[] = array( 'name'		=> 'First Name Text',
										'desc'		=> 'Custom text which appears on Appointment Form',
										'id'		=> $shortname.'_fname_txt',
										'std'		=> '',
										'type'		=> 'text',
										'inputsize' => '300'
							    );
			$iva_of_options[] = array( 'name'		=> 'Last Name Text',
										'desc'		=> 'Custom text which appears on Appointment Form',
										'id'		=> $shortname.'_lname_txt',
										'std'		=> '',
										'type'		=> 'text',
										'inputsize' => '300'
								);
			$iva_of_options[] = array( 'name'		=> 'Email Text',
										'desc'		=> 'Custom text which appears on Appointment Form',
										'id'		=> $shortname.'_email_txt',
										'std'		=> '',
										'type'		=> 'text',
										'inputsize'	=> '300'
								);
			$iva_of_options[] = array( 'name'		=> 'Phone Text',
										'desc'		=> 'Custom text which appears on Appointment Form',
										'id'		=> $shortname.'_phone_txt',
										'std'		=> '',
										'type'		=> 'text',
										'inputsize'	=> '300'
								);

			$iva_of_options[] = array( 'name'		=> 'Notes Text',
										'desc'		=> 'Custom text which appears on Appointment Form',
										'id'		=> $shortname.'_notes_txt',
										'std'		=> '',
										'type'		=> 'text',
										'inputsize'	=> '300'
								);

			$iva_of_options[] = array( 'name'		=> 'Services Text',
										'desc'		=> 'Custom text which appears on Appointment Form',
										'id'		=> $shortname.'_services_txt',
										'std'		=> '',
										'type'		=> 'text',
										'inputsize'	=> '300'
								);
								
			$iva_of_options[] = array( 'name'		=> 'Category Text',
										'desc'		=> 'Custom text which appears on Appointment Form',
										'id'		=> $shortname.'_category_txt',
										'std'		=> '',
										'type'		=> 'text',
										'inputsize'	=> '300'
								);	

											
			$iva_of_options[] = array( 'name'		=> 'Address Text',
										'desc'		=> 'Custom text which appears on Appointment Form',
										'id'		=> $shortname.'_address_txt',
										'std'		=> '',
										'type'		=> 'text',
										'inputsize'	=> '300'
								);
			$iva_of_options[] = array( 'name'		=> 'Time Text',
										'desc'		=> 'Custom text which appears on Appointment Form',
										'id'		=> $shortname.'_time_txt',
										'std'		=> '',
										'type'		=> 'text',
										'inputsize'	=> '300'
								);	
								
			$iva_of_options[] = array( 'name'		=> 'Select Time Text',
										'desc'		=> 'Custom text which appears on Appointment Form',
										'id'		=> $shortname.'_time_select_txt',
										'std'		=> '',
										'type'		=> 'text',
										'inputsize'	=> '300'
								);		
								
			$iva_of_options[] = array( 'name'		=> 'Date Text',
										'desc'		=> 'Custom text which appears on Appointment callout form',
										'id'		=> $shortname.'_date_txt',
										'std'		=> '',
										'type'		=> 'text',
										'inputsize'	=> '300'
								);
			$iva_of_options[] = array( 'name'		=> 'Closed Message',
										'desc'		=> 'Custom text which appears on Appointment Form',
										'id'		=> $shortname.'_closed_msg',
										'std'		=> '',
										'type'		=> 'text',
										'inputsize'	=> '300'
								);						
		
			$iva_of_options[] = array( 'name'		=> 'Form Heading1 Text',
										'desc'		=> 'Custom text which appears on Appointment Form',
										'id'		=> $shortname.'_form_heading1_txt',
										'std'		=> '',
										'type'		=> 'text',
										'inputsize' => '300'
							    );
			$iva_of_options[] = array( 'name'		=> 'Form Heading2 Text',
										'desc'		=> 'Custom text which appears on Appointment Form',
										'id'		=> $shortname.'_form_heading2_txt',
										'std'		=> '',
										'type'		=> 'text',
										'inputsize' => '300'
							    );

			$iva_of_options[] = array( 'name'	=> 'Appointment Cancelled',
										'desc'	=> 'Text which appears in the Admin area as Reservation Cancelled',
										'id'	=> $shortname.'_apt_cancel',
										'std'	=> '',
										'type'	=> 'text',
										'inputsize'=> '300');
	
			$iva_of_options[] = array( 'name'	=> 'Appointment Confirmed',
										'desc'	=> 'Text which appears in the Admin area as Reservation Confirmed',
										'id'	=> $shortname.'_apt_confirm',
										'std'	=> '',
										'type'	=> 'text',
										'inputsize'=> '300');
	
			$iva_of_options[] = array( 'name'	=> 'Appointment UnConfirmed',
										'desc'	=> 'Text which appears in the Admin area as Reservation Un Confirmed',
										'id'	=> $shortname.'_apt_unconfirm',
										'std'	=> '',
										'type'	=> 'text',
										'inputsize'=> '300');

			$iva_of_options[] = array( 'name'	=> 'Appointment Details text',
										'desc'	=> '',
										'id'	=> $shortname.'_details_txt',
										'std'	=> '',
										'type'	=> 'text',
										'inputsize'=> '490');
			
			$iva_of_options[] = array( 'name'	=> 'Appointment Confirm text',
										'desc'	=> '',
										'id'	=> $shortname.'_confirm_txt',
										'std'	=> '',
										'type'	=> 'text',
										'inputsize'=> '490');

			$iva_of_options[] = array( 'name'	=> 'Appointment Un Confirm text',
										'desc'	=> '',
										'id'	=> $shortname.'_unconfirm_txt',
										'std'	=> '',
										'type'	=> 'text',
										'inputsize'=> '490');


			$iva_of_options[] = array( 'name'	=> 'Appointment Cancelled text',
										'desc'	=> '',
										'id'	=> $shortname.'_cancelled_txt',
										'std'	=> '',
										'type'	=> 'text',
										'inputsize'=> '490');

			$iva_of_options[] = array( 'name'	=> 'Appointment Update text',
										'desc'	=> '',
										'id'	=> $shortname.'_update_txt',
										'std'	=> '',
										'type'	=> 'text',
										'inputsize'=> '490');

			$iva_of_options[] = array( 'name'	=> 'Appointment Cancel text',
										'desc'	=> '',
										'id'	=> $shortname.'_cancel_txt',
										'std'	=> '',
										'type'	=> 'text',
										'inputsize'=> '490');

			$iva_of_options[] = array( 'name'	=> 'Appointment ago text',
										'desc'	=> 'Type the text which you want to display at the place of ago text in the front end',
										'id'	=> $shortname.'_ago_txt',
										'std'	=> '',
										'type'	=> 'text',
										'inputsize'=> '490');
			
			$iva_of_options[] = array( 'name'	=> 'Appointment for text',
										'desc'	=> '',
										'id'	=> $shortname.'_for_txt',
										'std'	=> '',
										'type'	=> 'text',
										'inputsize'=> '490');
		
			$iva_of_options[] = array( 'name'	=> 'Appointment Placed text',
										'desc'	=> '',
										'id'	=> $shortname.'_placed_txt',
										'std'	=> '',
										'type'	=> 'text',
										'inputsize'=> '490');
			
			$iva_of_options[] = array( 'name'	=> 'Appointment By text',
										'desc'	=> '',
										'id'	=> $shortname.'_by_txt',
										'std'	=> '',
										'type'	=> 'text',
										'inputsize'=> '490');

			$iva_of_options[] = array( 'name'	=> 'Appointment Action text',
										'desc'	=> '',
										'id'	=> $shortname.'_action_txt',
										'std'	=> '',
										'type'	=> 'text',
										'inputsize'=> '490');

			$iva_of_options[] = array( 'name'	=> 'Appointment No Data text',
										'desc'	=> '',
										'id'	=> $shortname.'_no_data_txt',
										'std'	=> '',
										'type'	=> 'text',
										'inputsize'=> '490');

			$iva_of_options[] = array( 'name'	=> 'Appointment Status text',
										'desc'	=> '',
										'id'	=> $shortname.'_status_txt',
										'std'	=> '',
										'type'	=> 'text',
										'inputsize'=> '490');

			$iva_of_options[] = array( 'name'	=> ' No Appointments text',
										'desc'	=> '',
										'id'	=> $shortname.'_no_appts_txt',
										'std'	=> '',
										'type'	=> 'text',
										'inputsize'=> '490');

			$iva_of_options[] = array( 'name'	=> 'Login to perform an action text',
										'desc'	=> '',
										'id'	=> $shortname.'_login_to_action_txt',
										'std'	=> '',
										'type'	=> 'text',
										'inputsize'=> '490');




					
			return $iva_of_options;
}	
?>