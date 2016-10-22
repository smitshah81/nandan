<?php
/**
 * function iva_appoint_form_insert
 * function that inserts appointment form data into database and sends mail to admin email,user email
 * @param 'str' inpput string
 * @param 'arr' If the second parameter arr is present, variables are stored in this variable as array elements instead. 
 * @return No value is returned. 
 */
add_action('wp_ajax_iva_appt_form_insert', 'iva_appt_form_insert');
add_action('wp_ajax_nopriv_iva_appt_form_insert', 'iva_appt_form_insert');
function iva_appt_form_insert(){
	$postForm = isset( $_POST['data'] ) ? $_POST['data'] :'';
	/**
	 * function parse_str
	 * @param 'str' inpput string
	 * @param 'arr' If the second parameter arr is present, variables are stored in this variable as array elements instead. 
	 * @return No value is returned. 
	 */
	global $iva_templateid;
	parse_str( $postForm, $formdata );	
	$iva_fname = $iva_lname = $iva_email = $iva_phone = $iva_addr = $iva_serv = $iva_date = $iva_time = $iva_status ='';	
	$post  = ( !empty( $_POST ) ) ? true : false;
	
 	$iva_date 	   = isset( $formdata['iva_appt_date'] ) ? $formdata['iva_appt_date'] :''; 
	$iva_fname 	   = isset( $formdata['fname'] ) ? $formdata['fname'] :''; 
	$iva_lname 	   = isset( $formdata['lname'] ) ? $formdata['lname'] :''; 
	$iva_email 	   = isset( $formdata['email'] ) ? $formdata['email']:'';
	$iva_phone     = isset( $formdata['phone'] ) ? $formdata['phone']:'';
	$iva_addr  	   = isset( $formdata['address'] ) ? $formdata['address']:'';
	$iva_cat	   = isset( $formdata['iva_category'] ) ? $formdata['iva_category']:'';
	$iva_serv	   = isset( $formdata['iva_service'] ) ? $formdata['iva_service']:'';
	$iva_time 	   = isset( $formdata['appt_timings'] ) ? $formdata['appt_timings'] :''; 
	$iva_status    = isset( $formdata['appt_status'] ) ? $formdata['appt_status'] :''; 
	$iva_time      = date('g:i a',strtotime($iva_time));
	$iva_notes     = isset( $formdata['notes'] ) ? $formdata['notes']:'';
	

	/**
	 * If error occurs display it, otherwise send the email 
	 */
	if( $iva_fname &&  $iva_email && $iva_phone && $iva_addr ){
		/**
		 * Prepare and store appointment post data and update its meta data
		 */	
		$appt_data =  array(
						'post_title' => $formdata['fname'], 
						'post_type'	 => 'appointment', 
						'post_status'=> 'publish'
		);
		
		$iva_appt_id = wp_insert_post( $appt_data );
		
		$iva_cat_ids	 = @array_map('intval',$iva_cat);
		$iva_service_ids = @array_map('intval',$iva_serv);
		
		wp_set_object_terms( $iva_appt_id, $iva_cat_ids, 'iva_appointment_cat' );
		wp_set_object_terms( $iva_appt_id, $iva_service_ids, 'iva_appointment_service' );
		
		$appt_fields =  array( 
								'fname',
								'lname', 
								'phone',
								'email',
								'address',
								'notes'
							);

		// wp_set_post_categories( $appoint_data_id, array('5'),false);		
		update_post_meta( $iva_appt_id,'iva_appt_time', $formdata['appt_timings']);
		update_post_meta( $iva_appt_id,'iva_appt_date', strtotime( $formdata['iva_appt_date'] ) );
		update_post_meta( $iva_appt_id,'iva_appt_status',$iva_status );
		
		foreach( $appt_fields as $appt_field ){
			if(isset( $formdata[$appt_field])){
				update_post_meta( $iva_appt_id,'iva_appt_'.$appt_field,$formdata[$appt_field] );
			}
		}

		/** 
		 * Prepare confirmation email to send 
		 */
		$confirm_msg	=   get_option('iva_appt_client_notify_msg'); //get email message
		$placeholders   =   array(
				               '[first_name]',
				               '[last_name]',
				               '[contact_email]',
				               '[contact_phone]',
				               '[appointment_date]',
				               '[appointment_time]',
								'[appointment_note]',
				               '[appointment_addr]',
				               '[appointment_status]'
						    ); 
		$values 	    =   array(
								$iva_fname, 
								$iva_lname, 
								$iva_email, 
								$iva_phone, 
								$iva_date,
								$iva_time,
								$iva_notes,
								$iva_addr,
								$iva_status
		                    );
		$confirm_email_msg 		= str_replace( $placeholders,$values,$confirm_msg ); // Replace the placeholders
		
		/**
		 * Admin Notification message
		 */
		$adminconfirmation_message  = get_option('iva_admin_notification_msg'); // Get email message
		$placeholders				= array('[first_name]','[last_name]','[contact_email]','[contact_phone]','[appointment_date]','[appointment_time]','[appointment_note]','[appointment_addr]','[appointment_status]');
		$values 					= array( $iva_fname, $iva_lname, $iva_email, $iva_phone, $iva_date,$iva_time,$iva_notes, $iva_addr,$iva_status);
		$adminconfirm_email_msg 	= str_replace( $placeholders,$values,$adminconfirmation_message ); // Replace the placeholders
		
		/**
		 * Subject
		 */
		$confirmation_subject	= get_option('iva_appt_client_notify_subject');
		$placeholders			= array('[appointment_id]');
		$values					= array( $iva_appt_id );
		$confirm_email_subject 	= str_replace( $placeholders,$values,$confirmation_subject ); // Replace the placeholders

	
		$confirm_email_msg .=  get_page_link($iva_templateid).'/?email='.urlencode($iva_email).'&key='.md5($iva_email);

		/** 
		 * Send email
		 */
		$client_email = $formdata['email'];
		$admin_email  = get_option('iva_admin_emailid') ? get_option('iva_admin_emailid') : get_option( 'admin_email');
		
		/**
		 * Headers
		 */
		$iva_apt_headers_msg = get_option('iva_apt_headers_msg') ? get_option('iva_apt_headers_msg'): get_option('blogname');

		$headers 	  = 'From: ' . $iva_apt_headers_msg . ' Appointment <' .$admin_email. '>' . "\r\n\\";
		$adminheaders = 'From: ' . $iva_apt_headers_msg . ' Appointment <' .$client_email. '>' . "\r\n\\";
		
		
		/**
		 * Sends mail to user mail
		 */
		wp_mail( $client_email,$confirm_email_subject, $confirm_email_msg,$headers );
	
		/**
		 * Sends mail to admin email
		 */
		wp_mail( $admin_email,$confirm_email_subject, $adminconfirm_email_msg,$adminheaders );
	
		$iva_appt_message  = get_option('iva_appt_thankyou_msg') ? get_option('iva_appt_thankyou_msg'): __( 'Thank you for booking appointment','iva_theme_front');
		$placeholders				= array('[first_name]');
		$values 					= array( $iva_fname);
		$iva_appt_thanku_message 	= str_replace( $placeholders,$values,$iva_appt_message ); // Replace the placeholders

		$response = '<div id="appoint_msg" class="iva_message_box success iva-box-solid iva-box-normal clearfix"><div class="iva_message_box_content">'.$iva_appt_thanku_message.'</div></div>';

	}else{ 
		/**
		 * If error occurs in validation
		 */
		$response = '<div id="appoint_msg" class="iva_message_box error iva-box-solid iva-box-normal clearfix"><div class="iva_message_box_content">'.__('error','iva_theme_front').'</div></div>';
	}
	echo $response;
	die();
}
add_action('wp_ajax_iva_appt_form_update', 'iva_appt_form_update');
add_action('wp_ajax_nopriv_iva_appt_form_update', 'iva_appt_form_update');


function iva_appt_form_update(){
	$postForm = isset( $_POST['data'] ) ? $_POST['data'] :'';
	/**
	 * function parse_str
	 * @param 'str' inpput string
	 * @param 'arr' If the second parameter arr is present, variables are stored in this variable as array elements instead. 
	 * @return No value is returned. 
	 */
	global $iva_templateid;
	parse_str( $postForm, $formdata );	
	$iva_fname = $iva_lname = $iva_email = $iva_phone = $iva_addr = $iva_serv = $iva_date = $iva_time = $iva_status ='';	
	$post  = ( !empty( $_POST ) ) ? true : false;
	
 	$iva_date 	   = isset( $formdata['iva_appt_date'] ) ? $formdata['iva_appt_date'] :''; 
	$iva_fname 	   = isset( $formdata['fname'] ) ? $formdata['fname'] :''; 
	$iva_lname 	   = isset( $formdata['lname'] ) ? $formdata['lname'] :''; 
	$iva_email 	   = isset( $formdata['email'] ) ? $formdata['email']:'';
	$iva_phone     = isset( $formdata['phone'] ) ? $formdata['phone']:'';
	$iva_addr  	   = isset( $formdata['address'] ) ? $formdata['address']:'';
	$iva_notes     = isset( $formdata['notes'] ) ? $formdata['notes']:'';
	$iva_cat	   = isset( $formdata['iva_category'] ) ? $formdata['iva_category']:'';
	$iva_serv	   = isset( $formdata['iva_service'] ) ? $formdata['iva_service']:'';
	$iva_time 	   = isset( $formdata['appt_timings'] ) ? $formdata['appt_timings'] :''; 
	$iva_status    = isset( $formdata['appt_status'] ) ? $formdata['appt_status'] :''; 
	$iva_time      = date('g:i a',strtotime($iva_time));
	$iva_appt_id = isset($_POST['upost_id']) ? $_POST['upost_id'] : '' ;
	/**
	 * If error occurs display it, otherwise send the email 
	 */
	if( $iva_fname &&  $iva_email && $iva_phone && $iva_addr ){
		/**
		 * Prepare and store appointment post data and update its meta data
		 */	
		

		$appt_data = array(
						'post_title' =>$formdata['fname'], 
						'ID'           =>$iva_appt_id,
						'post_type' => 'appointment', 
						'post_status' => 'publish'
					);
		 wp_update_post($appt_data);
		
		$iva_cat_ids	 = @array_map('intval',$iva_cat);
		$iva_service_ids = @array_map('intval',$iva_serv);
		
		wp_set_object_terms( $iva_appt_id, $iva_cat_ids, 'iva_appointment_cat' );
		wp_set_object_terms( $iva_appt_id, $iva_service_ids, 'iva_appointment_service' );
		
		$appt_fields =  array( 
							'fname',
							'lname', 
							'phone',
							'email',
							'address',
							'notes',
						);

			
		update_post_meta( $iva_appt_id,'iva_appt_time', $formdata['appt_timings']);
		update_post_meta( $iva_appt_id,'iva_appt_date', strtotime( $formdata['iva_appt_date'] ) );
		update_post_meta( $iva_appt_id,'iva_appt_status',$iva_status );
		
		foreach( $appt_fields as $appt_field ){
			if(isset( $formdata[$appt_field])){
				update_post_meta( $iva_appt_id,'iva_appt_'.$appt_field,$formdata[$appt_field] );
			}
		}

		/** 
		 * Prepare confirmation email to send 
		 */
		$confirm_msg	=   get_option('iva_appt_client_notify_msg'); //get email message
		$placeholders   =   array(
				               '[first_name]',
				               '[last_name]',
				               '[contact_email]',
				               '[contact_phone]',
				               '[appointment_date]',
				               '[appointment_time]',
								'[appointment_addr]',
				               '[appointment_note]',
				               '[appointment_status]'
						    ); 
		$values 	    =   array(
								$iva_fname, 
								$iva_lname, 
								$iva_email, 
								$iva_phone, 
								$iva_date,
								$iva_time,
								$iva_addr,
								$iva_notes,
								$iva_status
		                    );
		$confirm_email_msg 		= str_replace( $placeholders,$values,$confirm_msg ); // Replace the placeholders
		
		$confirm_email_msg .=  get_page_link($iva_templateid).'/?email='.urlencode($iva_email).'&key='.md5($iva_email);

		/** 
		 * Admin Notification message
		 */
		$adminconfirmation_message  = get_option('iva_admin_notification_msg'); // Get email message
		$placeholders				= array('[first_name]','[last_name]','[contact_email]','[contact_phone]','[appointment_date]','[appointment_time]','[appointment_addr]','[appointment_note]','[appointment_status]');
		$values 					= array( $iva_fname, $iva_lname, $iva_email, $iva_phone, $iva_date,$iva_time,$iva_addr,$iva_notes,$iva_status);
		$adminconfirm_email_msg 	= str_replace( $placeholders,$values,$adminconfirmation_message ); // Replace the placeholders
		
		/**
		 * Subject
		 */
		$confirmation_subject	= get_option('iva_appt_client_notify_subject');
		$placeholders			= array('[appointment_id]');
		$values					= array( $iva_appt_id );
		$confirm_email_subject 	= str_replace( $placeholders,$values,$confirmation_subject ); // Replace the placeholders

		
		/** 
		 * Send email
		 */
		$client_email = $formdata['email'];
		$admin_email  = get_option('iva_admin_emailid')?get_option('iva_admin_emailid'):get_option('admin_email');
				
		
		/**
		 * Headers
		 */
		$iva_apt_headers_msg = get_option('iva_apt_headers_msg') ? get_option('iva_apt_headers_msg') :get_option('blogname');

		$headers 	  = 'From: ' . $iva_apt_headers_msg . ' Appointment <' .$admin_email. '>' . "\r\n\\";
		$adminheaders = 'From: ' . $iva_apt_headers_msg . ' Appointment <' .$client_email. '>' . "\r\n\\";
		
		/**
		 * Sends mail to user mail
		 */
		wp_mail( $client_email,$confirm_email_subject, $confirm_email_msg,$headers );
	
		/**
		 * Sends mail to admin email
		 */
		wp_mail( $admin_email,$confirm_email_subject, $adminconfirm_email_msg,$adminheaders );

		$iva_appt_message 	= get_option('iva_appt_thankyou_msg') ? get_option('iva_appt_thankyou_msg'): __( 'Thank you for booking appointment','iva_theme_front');
		$placeholders				= array('[first_name]');
		$values 					= array( $iva_fname);
		$iva_appt_thanku_message 	= str_replace( $placeholders,$values,$iva_appt_message ); // Replace the placeholders

		$response = '<div id="appoint_msg" class="iva_message_box success iva-box-solid iva-box-normal clearfix"><div class="iva_message_box_content">'.$iva_appt_thanku_message.'</div></div>';

	}else{ 
		/**
		 * If error occurs in validation
		 */
		$response = '<div id="appoint_msg" class="iva_message_box error iva-box-solid iva-box-normal clearfix"><div class="iva_message_box_content">'.__('error','iva_theme_front').'</div></div>';
	}
	echo $response;
	die();
}

add_action('wp_ajax_iva_get_appt_timings','iva_get_appt_timings');
add_action('wp_ajax_nopriv_iva_get_appt_timings','iva_get_appt_timings');
	function iva_get_appt_timings(){
	
		// Gets weekday,date values
		$iva_weekday			= isset( $_POST['week_day'] ) ? esc_html( $_POST['week_day'] ) :'';
		$iva_time_txt			= get_option('iva_time_txt') ? get_option('iva_time_txt') : 'Time';
		$iva_time_select_txt	= get_option('iva_time_select_txt') ? get_option('iva_time_select_txt') : __('Select Time','iva_theme_front');
		$iva_weekdays 			= array('sunday','monday','tuesday','wednesday','thursday','friday','saturday');
		$iva_hrs 				= get_option( 'iva_'.$iva_weekdays[$iva_weekday] );		
		$interval 				= get_option('iva_timeinterval') ? get_option('iva_timeinterval'):'15';
		$iva_format 			= get_option( 'iva_time_format')? get_option( 'iva_time_format') :'12';
		
		if( $iva_format == '12'){
			$timeformat = "h:i A";
		}elseif( $iva_format == '24'){
			$timeformat = "H:i";
		}else{
			$timeformat = "h:i A";
		}
		$iva_time_interval  = '+'.$interval.'minutes';
		$open_hrs   		=  strtotime( $iva_hrs['opening'] );
		$close_hrs 			=  strtotime( $iva_hrs['closing']);
		$closed_hrs 		=  $iva_hrs['close'];		
		$iva_appt_hours  	= get_option('iva_hrs') ? get_option('iva_hrs'):'';
		
		if( isset( $iva_appt_hours) &&  $iva_appt_hours!='' ){
			$hide_hours = $iva_appt_hours[$iva_weekday];
		}
		
		if( $closed_hrs == 'off' ){
			echo '<label for="appt_timings" class="appt_req">'.$iva_time_txt.'</label>';
			echo '<div class="iva_appt_timings">';
			echo '<select name="appt_timings" id="appt_timings">';
			echo '<option value="">'.$iva_time_select_txt.'</option>';
			while( $open_hrs < $close_hrs ){
				$iva_time_hrs = date( $timeformat,$open_hrs );
				if( !empty( $iva_appt_hours ) && ( $iva_appt_hours !='' ) ){
					if( @!in_array( $iva_time_hrs , $hide_hours  )) { 
						echo '<option value="'.date( 'H:i',$open_hrs ).'">'.$iva_time_hrs.'-'.date( $timeformat,strtotime( $iva_time_interval, $open_hrs ) ).'</option>'; 
					}
					$open_hrs = strtotime( $iva_time_interval, $open_hrs );	
				}
			}
			echo '</select>';
			echo '</div>';			
		}else{ 
			$closed_msg = get_option('iva_closed_msg') ? get_option('iva_closed_msg') : __('Sorry we are closed this day', 'iva_theme_front');
			echo '<label for="appt_timings" class="appt_req">'.$iva_time_txt.'</label>';
			echo '<div class="iva_appt_timings">';
			echo '<select name="appt_timings" id="appt_timings">';
			echo '<option value="">'.$closed_msg.'</option>';
			echo '</select>';
			echo '</div>';
		}
		exit; // This is required to end AJAX requests properly.
	}


add_action('wp_ajax_iva_get_appt_single_timings','iva_get_appt_single_timings');
add_action('wp_ajax_nopriv_iva_get_appt_single_timings','iva_get_appt_single_timings');
	function iva_get_appt_single_timings(){

	
		$iva_postid = isset($_POST['iva_postid']) ? $_POST['iva_postid'] : '' ;
		$iva_timings = get_post_meta($iva_postid ,'iva_appt_time','true');


		// Gets weekday,date values
		$iva_weekday			= isset( $_POST['week_day'] ) ? esc_html( $_POST['week_day'] ) :'';
		$iva_time_txt			= get_option('iva_time_txt') ? get_option('iva_time_txt') : 'Time';
		$iva_time_select_txt	= get_option('iva_time_select_txt') ? get_option('iva_time_select_txt') : __('Select Time','iva_theme_front');
		$iva_weekdays 			= array('sunday','monday','tuesday','wednesday','thursday','friday','saturday');
		$iva_hrs 				= get_option( 'iva_'.$iva_weekdays[$iva_weekday] );		
		$interval 				= get_option('iva_timeinterval') ? get_option('iva_timeinterval'):'15';
		$iva_format 			= get_option( 'iva_time_format')? get_option( 'iva_time_format') :'12';
		
		if( $iva_format == '12'){
			$timeformat = "h:i A";
		}elseif( $iva_format == '24'){
			$timeformat = "H:i";
		}else{
			$timeformat = "h:i A";
		}
		$iva_time_interval  = '+'.$interval.'minutes';
		$open_hrs   		=  strtotime( $iva_hrs['opening'] );
		$close_hrs 			=  strtotime( $iva_hrs['closing']);
		$closed_hrs 		=  $iva_hrs['close'];		
		$iva_appt_hours  = get_option('iva_hrs') ? get_option('iva_hrs'):'';
	
		if( isset( $iva_appt_hours) &&  $iva_appt_hours!='' ){
			$hide_hours = $iva_appt_hours[$iva_weekday];
		}
		if( $closed_hrs == 'off' ){
			echo '<label for="appt_timings" class="appt_req">'.$iva_time_txt.'</label>';
			echo '<div class="iva_appt_timings">';
			echo '<select name="appt_timings" id="appt_timings">';
			echo '<option value="">'.$iva_time_select_txt.'</option>';
			while( $open_hrs < $close_hrs ){
				$iva_time_hrs = date( $timeformat,$open_hrs );
				$selected ='';
				if( $iva_timings === date( 'H:i',$open_hrs )){ 
					$selected = 'selected = "selected"';
				}
				if( !empty( $iva_appt_hours ) && ( $iva_appt_hours !='' ) ){
					if( @!in_array( $iva_time_hrs , $hide_hours  )) { 
						echo '<option value="'.date( 'H:i',$open_hrs ).'" '.$selected.'>'.$iva_time_hrs.'-'.date( $timeformat,strtotime( $iva_time_interval, $open_hrs ) ).'</option>'; 
					}
				}
				$open_hrs = strtotime( $iva_time_interval, $open_hrs );	
			}
			echo '</select>';
			echo '</div>';			
		}else{ 
			$closed_msg = get_option('iva_closed_msg') ? get_option('iva_closed_msg') : __('Sorry we are closed this day', 'iva_theme_front');
			echo '<label for="appt_timings"  class="appt_req">'.$iva_time_txt.'</label>';
			echo '<div class="iva_appt_timings">';
			echo '<select name="appt_timings" id="appt_timings">';
			echo '<option value="">'.$closed_msg.'</option>';
			echo '</select>';
			echo '</div>';
		}
		exit; // This is required to end AJAX requests properly.
	}
?>