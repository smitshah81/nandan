<?php
add_filter('custompost_themeoptions','iva_custompost_themeoptions');
function iva_custompost_themeoptions( $iva_of_options ) {	
	global $url, $iva_of_options,$atp_theme;
			$shortname = 'iva';

		// APPOINTMENT	 ###########################################################################################
		//---------------------------------------------------------------------------------------------------
		$iva_of_options[] = array( 'name' => 'Appointment', 'icon' => ADMIN_URI.'/images/reservation.png','type' => 'heading');
		//---------------------------------------------------------------------------------------------------
		// Time Setup		
		//---------------------------------------------------------------------------------------------------
		$iva_of_options[] = array( 'name'	=> 'General Settings', 'type' => 'subnav');
		//---------------------------------------------------------------------------------------------------


				$iva_of_options[] = array( 'name'	=> 'Appointment Slug',
											'desc'	=> 'Slugs are meant to be used with permalinks as they help describe what the you wish to have at the URL. (default slug: appointment)',
											'id'	=> $shortname.'_apt_slug',
											'std'	=> '',
											'type'	=> 'text',
											'inputsize'=> '330'
									);

				$iva_of_options[] = array( 'name'		=> 'Appointments Page',
											'desc'		=> 'Please select the page that is to display the appointment form.',
											'id'		=> $shortname.'_appt_template_page',
											'std'		=> '',
											'class' 	=> 'select300',
											'options'	=> $atp_theme->atp_variable('pages'),
											'type'		=> 'select'
									);

				$iva_of_options[] = array(	'name'	=> 'Appointment Page Weather Background',
											'desc'	=> 'Weather background properties includes the sidebar footer widgets area as well. If you wish to disable footer area you can go to Footer Tab and do that..',
											'id'	=> $shortname.'_weatherbg',
											'std'	=> array(
															'image'		=> '',
															'color'		=> '',
															'style' 	=> 'repeat',
															'position'	=> 'center top',
															'attachment'=> 'scroll'),
											'type'	=> 'background');


				$iva_of_options[] = array(	'name'	=> 'Appointment Page Weather  Text Color',
											'desc'	=> 'Appointment Page Weather  Text Color',
											'id'	=> $shortname.'_weather_textcolor',
											'std'	=> '', 
											'type'	=> 'color');
			
		
				$iva_of_options[] = array( 'name'	  => 'Weather Location',
											'desc'	  => 'Location of the weather like New York, USA. This is used on appointments page above the calendar',
											'id'	   => $shortname.'_weather_loc',
											'std'	   => '',
											'type'	   => 'text',
											'inputsize'=> '330'
							        );
				$iva_of_options[] = array( 'name'		=> 'Weather Unit',
											'desc'		=> 'Select the weather unit. This is used on appointments page above the calendar',
											'id'		=> $shortname.'_weather_unit',
											'std'		=> 'f',
											'type'		=> 'radio',
											'class'		=> '',
											'inputsize'	=> '',
											'options'   => array( 
															'f' => 'Fahrenheit',
															'c'	=> 'Celsius'
														   )
   						            );

				$iva_of_options[] = array( 'name'	=> 'Calendar Week Start Day',
											'desc'	=> 'Set the first day of the week: Sunday is 0, Monday is 1, etc.',
											'id'	=> $shortname.'_first_day',
											'std'	=> '',
											'class' => 'select300',
											'type'	=> 'select',
											'options'	=> array(
															'0' => 'Sunday',
															'1' => 'Monday',
															'2' => 'Tuesday',
															'3' => 'Wednesday',
															'4' => 'Thursday',
															'5' => 'Friday',
															'6' => 'Saturday',
											             ),
							        );				
				$iva_of_options[] = array( 'name'	=> __('Calendar Language','iva_theme_admin'),
											'desc'	=> __('Select the language you wish to display for calendar on appointments page.','iva_theme_admin'),
											'id'	=> $shortname.'_datepicker_language',
											'std'	=> '',
											'type'	=> 'select',
											'class'	=> 'select300',
											'options'	=> array(
																''  		=> 'English',
																'sq'		=> 'Albanian',
																'ar' 		=> 'Arabic',
																'bg'		=> 'Bulgarian',
																'zh-CN'		=> 'Chinese',
																'zh-TW'  	=> 'Chinese Traditiona',
																'da'		=> 'Danish',
																'fr'  		=> 'French',
																'fa'  		=> 'Farsi',	
																'fi'		=> 'Finnish',
																'de'		=> 'German',
																'ka'		=> 'Georgian',
																'he'  		=> 'Hebrew',
																'id'		=> 'Indonesian',
																'is'		=> 'Icelandic',
																'it'		=> 'Italian',
																'ja'		=> 'Japanese',
																'lt'		=> 'Lithuanian',
																'lv'		=> 'Latvian',
																'ms'		=> 'Malaysian',
																'ml'		=> 'Malayalam',
																'mk'		=> 'Macedonian',
																'nn'		=> 'Norwegian Nynorsk',
																'no'		=> 'Norwegian',
																'pl'		=> 'Polish',
																'pt'		=> 'Portuguese',
																'pt-BR'		=> 'Brazilian',
																'rm'		=> 'Romansh',
																'ro'		=> 'Romanian',
																'ru'		=> 'Russian',
																'sk' 		=> 'Slovak',
																'sl'		=> 'Slovenian',
																'sr' 		=> 'Serbian',
																'sv'		=> 'Swedish',
																'ta'		=> 'Tamil',
																'th'		=> 'Thai',
																'tj'		=> 'Tajiki',
																'tr'		=> 'Turkish',
																'uk'		=> 'Ukrainian',
																'vi'		=> 'Vietnamese'
																),
									);


				$iva_of_options[] = array( 'name'	 	=> 'Disable Calender Days',
											'desc'	 	=> 'Select the days you wish to make it off by default in the calendar. This is used on appointments page above the calendar',
											'id'	  	=> $shortname.'_disable_days',
											'std'	  	=> '',
											'type'	  	=> 'text',
											'inputsize' => '330'
							        );
				$iva_of_options[] = array( 'name'		=> 'Appointment interval',
											'desc'		=> 'Please select the time interval between appointments at a single table.',
											'id'		=> $shortname.'_timeinterval',
											'std'		=> '',
											'class' 	=> 'select300',
											'type'		=> 'select',
											'options'	=> array(
															'' 	 => __('Select Time Interval','iva_theme_admin'),
															'60' => '1 Hour',
															'30' => '30 Minutes',
															'15' => '15 Minutes',
														),
							        );

				$iva_of_options[] = array( 'name'		=> 'Time Format',
											'desc'		=> 'Please select the format in which you would like to display appointment times on your website\'s frontend.',
											'id'		=> $shortname.'_time_format',
											'std'		=> '',
											'class' 	=> 'select300',
											'type'		=> 'select',
											'options'	=> array(
															'24' => '24 Hours',
															'12' => '12 Hours',
														),
									);
			
				
				$iva_of_options[] = array( 'name'		=> 'Manage Appointments limit',
											'desc'		=> 'Enter the limit you wish to display for the Manage Appointments which displays the list of items for the customer. Template used for this is template_manage_reservation.php',
											'id'		=> $shortname.'_appt_list_limit',
											'std'		=> '',
											'type'		=> 'text',
											'inputsize'	=> '330'
									);
									
			$iva_of_options[] = array( 'name' => 'Confirm Appointments limit',
									   'desc' => 'Enter the number of items to display in the Confirm Appointments page template.',
									   'id'   => $shortname.'_cnfrm_apt_limit',
									   'std'  => '',
									   'type' => 'text',
									   'inputsize'=> '330'
									);
									
			$iva_of_options[] = array( 'name' => 'Cancel Appointments limit',
									   'desc' => 'Enter the number of items to display in the Cancel Appointments page template.',
									   'id'   => $shortname.'_cancel_apt_limit',
									   'std'  => '',
									   'type' => 'text',
									   'inputsize'=> '330'
									);
									
			$iva_of_options[] = array( 'name' => 'UnConfirm Appointments limit',
									   'desc' => 'Enter the number of items to display in the UnConfirm Appointments page template.',
									   'id'   => $shortname.'_uncnfrm_apt_limit',
									   'std'  => '',
									   'type' => 'text',
									   'inputsize'=> '330'
									);	
									
			$iva_of_options[] = array( 'name'	=> 'Pest Category Order',
										'desc'	=> 'Displaying order for pest categories in template_pestcategories page',
										'id'	=> $shortname.'_pest_cat_order',
										'std'	=> '',
										'class' => 'select300',
										'type'	=> 'select',
										'options'	=> array(	
															'none'	=>'None',
															'id' 	=> 'ID',
															'count' => 'Count',
															'name'	=> 'Name',
															'slug'	=> 'Slug',
															'term_group' => 'Term Group',
															'display_order' => 'Display Order',
														),			
									);
	
			// Business Hours setup		
			//---------------------------------------------------------------------------------------------------
			$iva_of_options[] = array( 'name'	=> 'Business Hours Setup', 'type' => 'subnav');
			//---------------------------------------------------------------------------------------------------	
				$iva_of_options[] = array(	'name'	=> 'Sunday',
									'desc'	=> '',
									'id'	=> $shortname.'_sunday',
									'std'	=> '',
									'type'	=> 'businesshours');
				$iva_of_options[] = array(	'name'	=> 'Monday',
									'desc'	=> '',
									'id'	=> $shortname.'_monday',
									'std'	=> '',
									'type'	=> 'businesshours');
				$iva_of_options[] = array(	'name'	=> 'Tuesday',
									'desc'	=> '',
									'id'	=> $shortname.'_tuesday',
									'std'	=> '',
									'type'	=> 'businesshours');
				$iva_of_options[] = array(	'name'	=> 'Wednesday',
									'desc'	=> '',
									'id'	=> $shortname.'_wednesday',
									'std'	=> '',
									'type'	=> 'businesshours');
				$iva_of_options[] = array(	'name'	=> 'Thursday',
									'desc'	=> '',
									'id'	=> $shortname.'_thursday',
									'std'	=> '',
									'type'	=> 'businesshours');
				$iva_of_options[] = array(	'name'	=> 'Friday',
									'desc'	=> '',
									'id'	=> $shortname.'_friday',
									'std'	=> '',
									'type'	=> 'businesshours');
				$iva_of_options[] = array(	'name'	=> 'Saturday',
									'desc'	=> '',
									'id'	=> $shortname.'_saturday',
									'std'	=> '',
									'type'	=> 'businesshours');

			// Closed Hours setup		
			//---------------------------------------------------------------------------------------------------
			$iva_of_options[] = array( 'name'	=> 'Closed Hours Setup', 'type' => 'subnav');
			//---------------------------------------------------------------------------------------------------	
				$iva_of_options[] = array(	'name'	=> 'We\'re closed on these hours',
											'desc'	=> '',
											'id'	=> $shortname.'_hrs',
											'std'	=> '',
											'type'	=> 'closehours');

			// Email Setup 
			//------------------------------------------------------------------------------------------------
			$iva_of_options[] = array( 'name'	=> 'Front end E-mails Setup', 'icon' => ADMIN_URI.'/images/reservation.png', 'type' => 'subnav');
			//------------------------------------------------------------------------------------------------					
				$iva_of_options[] = array(  'name'	=> 'Shortcodes for Email Setup',
											'desc'	=> 'Custom shortcodes defined for this theme in use for the Email Message systems<br><br> 
														[first_name]		- <em>First Name of the Patient </em><br>
														[last_name]			- <em>Last Name of the Patient </em><br>
														[contact_email]		- <em>Email of the Patient </em><br>
														[contact_phone]		- <em>Phone of the Patient </em><br>
														[appointment_date]	- <em>Appointment date </em><br>
														[appointment_time]	- <em>Appointment time </em><br>
														[appointment_addr]	- <em>Appointment address</em><br>
														[appointment_note]	- <em>Appointment instructions</em><br>',
											'type'	=> 'subsection'
									);
			
				
				$iva_of_options[] = array(	'name'	=> 'Appointment Form Thank you message',
											'desc'	=> __('Message which displays when appointment form has been submitted successfully.','iva_theme_admin'),
											'id'	=> $shortname.'_appt_thankyou_msg',
											'std'	=>'Thank you! [first_name], Your Appointment has been scheduled and you will be notified soon for confirmation by our consultant.',
											'type'	=> 'textarea'
									);								
				$iva_of_options[] = array(	'name'	=> 'Appointment Notification Subject',
											'desc'	=> __('Subject for the appointment confirmation email message.','iva_theme_admin'),
											'id'	=> $shortname.'_appt_client_notify_subject',
											'std'	=>' : Appointment ID - [appointment_id]',
											'type'	=> 'text',
											'inputsize'	=> '330'
									);
				$iva_of_options[] = array(	'name'	=> 'Appointment Notification message',
											'desc'	=> __('Email Message which appears when a user gets a confirmation for the appointment he fixed.','iva_theme_admin'),
											'id'	=> $shortname.'_appt_client_notify_msg',
											'std'	=>'Dear [first_name]
														Thank you for making an appointment to  for [first_name] at [appointment_time] on [appointment_date]. The last thing we require from you is to please confirm your appointment.
														Sincerely,',
											'type'	=> 'textarea'
									);

				$iva_of_options[] = array(	'name'	=> 'User Cancelled subject message',
											'desc'	=> __('Subject for the user appointment cancelled email message.','iva_theme_admin'),
											'id'	=> $shortname.'_usr_cancelled_subject',
											'std'	=> '[first_name] : Booking Request ID [appointment_id].',
											'type'	=> 'text',
											'inputsize'	=> '330');
									
			
			
				$iva_of_options[] = array(	'name'	=> 'User Cancelled E-mail Message',
											'desc'	=> __('User Appointment Cancelled notification email message which goes to Client/Patient.','iva_theme_admin'),
											'id'	=> $shortname.'_usr_cancelled_em_msg',
											'std'	=> 'Dear [first_name],
													This is a courtesy e-mail to inform you that the status of your 
													appointment at [first_name] at [appointment_time] on [appointment_date] 
													has been updated.
													The new appointment status is "[appointment_status]".
													Sincerely,
													The staff at [first_name].',
											'type'	=> 'textarea');

			
				// $iva_of_options[] = array(	'name'	=> 'User Confirmed Subject',
											// 'desc'	=> '',
											// 'id'	=> $shortname.'_usr_confirmed_subject',
											// 'std'	=>' : Appointment ID - [appointment_id]',
											// 'type'	=> 'text',
											// 'inputsize'	=> '330'
									// );
		

				// $iva_of_options[] = array(	'name'	=> 'User Confirmed E-mail Message',
											// 'desc'	=> '',
											// 'id'	=> $shortname.'_usr_confirmed_em_msg',
											// 'std'	=> 'Dear [first_name],
											// This is a courtesy e-mail to inform you that the status of your 
											// appointment at [first_name] at [appointment_time] on [appointment_date] 
											// has been updated.
											// The new appointment status is "[appointment_status]".
											// Sincerely,
											// The staff at [first_name].',
											// 'type'	=> 'textarea');

	//------------------------------------------------------------------------------------------------
	$iva_of_options[] = array( 'name'	=> 'Admin E-mails Setup', 'icon' => ADMIN_URI.'/images/reservation.png', 'type' => 'subnav');
	//------------------------------------------------------------------------------------------------
	$iva_of_options[] = array(  'name'	=> 'Shortcodes for Email Setup',
								'desc'	=> 'Custom shortcodes defined for this theme in use for the Email Message systems<br><br> 
											[first_name]		- <em>First Name of the Patient </em><br>
											[last_name]			- <em>Last Name of the Patient </em><br>
											[contact_email]		- <em>Email of the Patient </em><br>
											[contact_phone]		- <em>Phone of the Patient </em><br>
											[appointment_date]	- <em>Appointment date </em><br>
											[appointment_time]	- <em>Appointment time </em><br>
											[appointment_addr]	- <em>Appointment address</em><br>
											[appointment_note]	- <em>Appointment instructions</em><br>',
								'type'	=> 'subsection'
						);


	$iva_of_options[] = array(	'name'	=> 'Appointment Form Headers Message',
									'desc'	=> __('Message which displays when appointment form has been submitted successfully.','iva_theme_admin'),
									'id'	=> $shortname.'_apt_headers_msg',
									'std'	=>'',
									'type'	=> 'textarea'
							);	
			
	$iva_of_options[] = array(	'name'		=> 'Admin Email ID',
								'desc'		=> __('Email id where you want to get all the appointment requests.','iva_theme_admin'),
								'id'		=> $shortname.'_admin_emailid',
								'std'		=>'',
								'type'		=> 'text',
								'inputsize'	=> '330'
						);

	$iva_of_options[] = array(	'name'	=> 'Admin Notification Email Message',
								'desc'	=> __('Email message format which goes to Admin when a new appointment is requested. For admin email-ID please see the field below <strong>Appointment Email</strong>','iva_theme_admin'),
								'id'	=> $shortname.'_admin_notification_msg',
								'std'	=> 'Name : [first_name]
											Email : [contact_email]
											Instructions : [appointment_note]

											You have a New Appointment Scheduled to for [first_name] at [appointment_time] on [appointment_date].

												For more information to contact [first_name] you can make a call on [contact_phone].

											Regards
											Admin',
								'type'	=> 'textarea'
						);	

	$iva_of_options[] = array(	'name'	=> 'Subject - Status Email',
								'desc'	=> __('Subject for the appointment status changed notification email message.','iva_theme_admin'),
								'id'	=> $shortname.'_admin_status_chng_sub',
								'std'	=>' : Appointment ID - [appointment_id] Status Changed',
								'type'	=> 'text',
								'inputsize'	=> '330'
						);

	$iva_of_options[] = array(	'name'	=> 'Status Changed E-mail Message',
								'desc'	=> __('Appointment Status change notification email message which goes to Client/Patient.','iva_theme_admin'),
								'id'	=> $shortname.'_admin_status_chng_msg',
								'std'	=> 'Dear [first_name],
											This is a courtesy e-mail to inform you that the status of your appointment with  for [first_name] at [appointment_time] on [appointment_date] has been updated.

											The new appointment status is "[appointment_status]".

											Sincerely,',
								'type'	=> 'textarea'
						);	

	// $iva_of_options[] = array(	'name'	=> 'User Confirmed E-mail Message to admin',
								// 'desc'	=> __('User booking Cancelled notification email message which goes to admin.','iva_theme_admin'),
								// 'id'	=> $shortname.'_usr_confirmed_msg_to_admin',
								// 'std'	=> 'Dear Admin,
											// This is a courtesy e-mail to inform you that the status of [first_name] 
											// booking at [first_name] at [appointment_time] on [appointment_date] 
											// has been updated.
											// The new booking status is "[appointment_status]".
											// Sincerely,
											// [first_name].',
											// 'type'	=> 'textarea');
								
				
	$iva_of_options[] = array(	'name'	=> 'User Cancelled E-mail Message to admin',
								'desc'	=> __('User booking Cancelled notification email message which goes to admin.','iva_theme_admin'),
								'id'	=> $shortname.'_usr_cancelled_msg_to_admin',
								'std'	=> 'Dear Admin,
											This is a courtesy e-mail to inform you that the status of [first_name] 
											booking at [first_name] at [appointment_time] on [appointment_date] 
											has been updated.
											The new booking status is "[appointment_status]".
											Sincerely,
											[first_name].',
								'type'	=> 'textarea');		
							
	return $iva_of_options;
}
?>