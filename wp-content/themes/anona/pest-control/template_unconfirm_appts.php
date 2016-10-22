<?php
/**
 * Template Name: UnConfirm Appointments
 */
 get_header();
?>
<div id="primary" class="pagemid">
  <div class="inner">   
    <main class="content-area" role="main">
		<div class="entry-content-wrapper clearfix">
	
		<div class="iva_apptervation"></div>
		<?php
		$iva_appt_action = isset( $_GET['action']) ? $_GET['action'] : '';
		
		if( $iva_appt_action == 'confirm' || $iva_appt_action == 'cancel'){
		
			$booking_id 	=  	$_GET['id'] ?  $_GET['id'] : '';
			$default_date 	=  	get_option('atp_date_format');
			$iva_fname		= 	get_the_title( $booking_id );
			$iva_lname 		=	get_post_meta( $booking_id,'iva_appt_lname',true );
			$iva_email 		=	get_post_meta( $booking_id,'iva_appt_email',true );
			$iva_phone 		= 	get_post_meta( $booking_id,'iva_appt_phone',true );
			$iva_address 	=	get_post_meta( $booking_id,'iva_appt_address',true );
			$iva_date     	= 	date_i18n( $default_date,get_post_meta( $booking_id,'iva_appt_date', true ) );
			$iva_status    	= 	get_post_meta( $booking_id,'iva_appt_status',true );
			$iva_time 	   	= 	get_post_meta( $booking_id,'iva_appt_time',true );
			$iva_time      	= 	date('g:i a',strtotime( $iva_time ) );
			

			if( $iva_appt_action == 'confirm' ){
			
				// Update post status
				update_post_meta( $booking_id,'iva_appt_status','confirmed' );

				// User and admin mailids
				$admin_emailid 	= get_option('iva_admin_emailid')?get_option('iva_admin_emailid'):get_option('admin_email');
				$user_emailid 	= get_post_meta( $booking_id,'iva_appt_email', true );
			
				// Assigns message details for appointment
				$placeholders 				=	 array(
													'[first_name]',
													'[last_name]',
													'[contact_email]',
													'[contact_phone]',
													'[appointment_date]',
													'[appointment_time]',
													'[appointment_note]',
													'[appointment_status]'
												);
				$values 				 	=	 array(
													$iva_fname, 
													$iva_lname, 
													$iva_email, 
													$iva_phone, 
													$iva_date,
													$iva_time,
													$iva_address,
													$iva_status
												);	
												
				$status_changed_notify_msg  = get_option('iva_admin_status_chng_msg');
				$status_changed_email_msg 	= str_replace( $placeholders,$values,$status_changed_notify_msg ); //replace the placeholders
				
				// Assigns subject for appointment
				$status_subject 			= get_option('iva_admin_status_chng_sub');		
				$appt_placeholders 			= array('[appointment_id]' );			
				$appt_values 				= array( $booking_id );
				$status_email_subject 		= str_replace( $appt_placeholders,$appt_values,$status_subject); //replace the placeholders
				
				/**
				 * Headers
				 */
				$iva_apt_headers_msg = get_option('iva_apt_headers_msg') ? get_option('iva_apt_headers_msg') :get_option('blogname');
				
				$headers 	  = 'From: ' . $iva_apt_headers_msg . ' Appointment <' .$admin_emailid. '>' . "\r\n\\";
				
				//
				wp_mail( $user_emailid, $status_email_subject, $status_changed_email_msg, $headers );
				wp_mail( $admin_emailid, $status_email_subject, $status_changed_email_msg, $headers );
				
				$response = '<div class="iva_message_box success iva-box-solid iva-box-normal"><div class="messagebox_content">'.__('Your Appointment is Confirmed', 'iva_theme_front').'</div></div>';
				echo $response;
			}
			if( $iva_appt_action == 'cancel' ){
				
				// Update post status
				update_post_meta( $booking_id,'iva_appt_status','cancelled' );
				
				// User and admin mailids
				$admin_emailid 	= get_option('iva_admin_emailid')?get_option('iva_admin_emailid'):get_option('admin_email');
				$user_emailid 	= get_post_meta( $booking_id,'iva_appt_email', true );
			
				// Assigns message details for appointment
				$placeholders 				=	 array(
													'[first_name]',
													'[last_name]',
													'[contact_email]',
													'[contact_phone]',
													'[appointment_date]',
													'[appointment_time]',
													'[appointment_note]',
													'[appointment_status]'
												);
				$values 				 	=	 array(
													$iva_fname, 
													$iva_lname, 
													$iva_email, 
													$iva_phone, 
													$iva_date,
													$iva_time,
													$iva_address,
													$iva_status
												);	
												
				$status_changed_notify_msg  = get_option('iva_admin_status_chng_msg');
				$status_changed_email_msg 	= str_replace( $placeholders,$values,$status_changed_notify_msg ); //replace the placeholders
				
				// Assigns subject for appointment
				$status_subject 			= get_option('iva_admin_status_chng_sub');		
				$appt_placeholders 			= array('[appointment_id]' );			
				$appt_values 				= array( $booking_id );
				$status_email_subject 		= str_replace( $appt_placeholders,$appt_values,$status_subject); //replace the placeholders
				
				/**
				 * Headers
				 */
				$iva_apt_headers_msg = get_option('iva_apt_headers_msg') ? get_option('iva_apt_headers_msg') :get_option('blogname');
				
				$headers 	  = 'From: ' . $iva_apt_headers_msg . ' Appointment <' .$admin_emailid. '>' . "\r\n\\";
				
				//
				wp_mail( $user_emailid, $status_email_subject, $status_changed_email_msg, $headers );
				wp_mail( $admin_emailid, $status_email_subject, $status_changed_email_msg, $headers );
				
				$response = '<div class="iva_message_box success iva-box-solid iva-box-normal"><div class="messagebox_content">'.__('Your Appointment is Cancelled', 'iva_theme_front').'</div></div>';
				echo $response;
			}
		
		}
		
		global $default_date,$iva_unconfirm_templateid;
		
		
		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;  
		}
			
		$iva_uncnfrm_apt_limit = get_option('iva_uncnfrm_apt_limit') ?  get_option('iva_uncnfrm_apt_limit') : '-1';
		$args = array(
			'post_type' => 'appointment',
			'meta_query' 	=> array(
				'relation' 		=> 'AND',
				array(
					'key' 		=> 'iva_appt_status',
					'value' 	=> 'unconfirmed',
					'compare' 	=> '='
				),
			),
			'paged' 		=> $paged,
			'posts_per_page'=> $iva_uncnfrm_apt_limit, 
			'orderby'    	=> 'title',
			'order'    		=> 'ASC',
		);
			
		$iva_appt_query = query_posts( $args );

		global $wp_query; 
		
		$iva_count_posts = $wp_query->found_posts;
		
		$out ='';
		$iva_appt_name_txt			= get_option('iva_fname_txt') ? get_option('iva_fname_txt') : __('Name','iva_theme_front');
		$iva_appt_date_txt			= get_option('iva_date_txt') ? get_option('iva_date_txt') : __('Date','iva_theme_front');
		$iva_appt_time_txt			= get_option('iva_time_txt') ? get_option('iva_time_txt') : __('Time','iva_theme_front');
		$iva_appt_details_txt		= get_option('iva_details_txt') ? get_option('iva_details_txt') : __('Details','iva_theme_front');
		$iva_appt_confirm_txt		= get_option('iva_confirm_txt') ? get_option('iva_confirm_txt') : __('Confirm','iva_theme_front');
		$iva_appt_cancelled_txt		= get_option('iva_cancelled_txt') ? get_option('iva_cancelled_txt') : __('Cancelled','iva_theme_front');
		$iva_appt_update_txt		= get_option('iva_update_txt') ? get_option('iva_update_txt') : __('Update','iva_theme_front');
		$iva_appt_cancel_txt		= get_option('iva_cancel_txt') ? get_option('iva_cancel_txt') : __('Cancel','iva_theme_front');
		$iva_appt_ago_txt			= get_option('iva_ago_txt') ? get_option('iva_ago_txt') : __('ago','iva_theme_front');
		$iva_appt_for_txt			= get_option('iva_for_txt') ? get_option('iva_for_txt') : __('for','iva_theme_front');
		$iva_appt_placed_txt		= get_option('iva_placed_txt') ? get_option('iva_placed_txt') : __('Placed','iva_theme_front');
		$iva_appt_by_txt			= get_option('iva_by_txt') ? get_option('iva_appt_by_txt') : __('by','iva_theme_front');
		$iva_appt_service_txt		= get_option('iva_service_txt') ? get_option('iva_service_txt') : __('Services','iva_theme_front');
		$iva_appt_category_txt		= get_option('iva_category_txt') ? get_option('iva_category_txt') : __('Category','iva_theme_front');
		$iva_no_data_txt 			= get_option('iva_no_data_txt') ? get_option('iva_no_data_txt') : __('No Data','iva_theme_front');
		$iva_appt_status_txt 		= get_option('iva_status_txt') ? get_option('iva_status_txt') :__('Status','iva_theme_front');
		$iva_appt_action_txt 		= get_option('iva_action_txt') ? get_option('iva_action_txt') :__('Action','iva_theme_front');
		$iva_no_appts_txt 			= get_option('iva_no_appts_txt') ? get_option('iva_no_appts_txt') :__('No Appointments','iva_theme_front');
		$iva_login_to_action_txt 	= get_option('iva_login_to_action_txt') ? get_option('iva_login_to_action_txt') :__('Login to perform an action','iva_theme_front');
		
		$out .= '<table class="iva_rev_table fancy_table" width="100%" border="1px">';
		$out .= '<thead><tr>';
		$out .= '<th width="20%" class="iva_appt_title">'.$iva_appt_name_txt.'</th>';
		$out .= '<th width="6%" class="iva_appt_date">'.$iva_appt_date_txt.'</th>';
		$out .= '<th width="4%" class="iva_appt_time">'.$iva_appt_time_txt.'</th>';
		$out .= '<th width="12%" class="iva_appt_service">'.$iva_appt_service_txt.'</th>';
		$out .= '<th width="12%" class="iva_appt_category">'.$iva_appt_category_txt.'</th>';
		$out .= '<th width="20%" class="iva_appt_details">'.$iva_appt_details_txt.'</th>';
		$out .= '<th width="6%" class="iva_appt_status">'.$iva_appt_status_txt.'</th>';
		$out .= '<th width="20%" class="iva_ucd">'.$iva_appt_action_txt.'</th>';
	
		$out .= '</tr></thead>';
			
		if( have_posts()):
	
		while( have_posts()):the_post();
			$title          	 	= get_the_title( $post->ID );
			$permalink       		= get_permalink( get_the_id() );
			$iva_pub_date 			= human_time_diff( get_the_time('U'), current_time('timestamp') ).' '.$iva_appt_ago_txt;
			$iva_appointment_email 	= get_post_meta( $post->ID,'iva_appt_email',true );
			$iva_services           = get_the_terms( $post->ID, 'iva_appointment_service', true );
			$iva_category           = get_the_terms( $post->ID, 'iva_appointment_cat', true );
			$iva_appointment_date  	= get_post_meta( $post->ID,'iva_appt_date',true );
			$iva_appointment_status	= get_post_meta( $post->ID,'iva_appt_status',true );
			$iva_appointment_time 	= get_post_meta( $post->ID,'iva_appt_time',true );
			
			$appt_date = date_i18n( $default_date,$iva_appointment_date );

			$disabled = '';
			$iva_appt_date_time = strtotime( $appt_date. '+' .$iva_appointment_time );
			if ( $iva_appt_date_time < time() ){
				$disabled = 'onclick="return false"';
			}else{
				$disabled ='';
			}
			
			
			$out .= '<tr><tbody>';
			$out .= '<td class="iva_appt_title">'.$title.'</td>';
			// Date
			if( $iva_appointment_date !='' ){
				$out .= '<td class="iva_appt_date_val">'.$appt_date.'</td>';
			}else{
				$out .= '<td class="iva_appt_date_val">'.$iva_no_data_txt.'</td>';
			}
			
			// Time
			if( $iva_appointment_time !='' ){
				if( get_option('iva_time_format') == '12'){
					$data_appt = date('h:i A',strtotime( $iva_appointment_time ));
					$out .= '<td class="iva_appt_time_val">'.$data_appt.'</td>';
				}else{
					$out .= '<td class="iva_appt_time_val">'.date("H:i", strtotime( $iva_appointment_time )).'</td>';
				}
			}else{
				$out .= '<td class="iva_appt_time_val">'.$iva_no_data_txt.'</td>';
			}
		
			// Services
			//If the terms array contains items... (dupe of core)
			if ( !empty($iva_services) ) {
				//Loop through terms
				$post_services_terms ='';
				foreach ( $iva_services as $services_term ){
					//Add tax name & link to an array
					$post_services_terms[] = esc_html(sanitize_term_field('name', $services_term->name, $services_term->term_id, '', 'edit'));
				}
				//Spit out the array as CSV
				$out .= '<td class="iva_appt_services">'.implode( ', ', $post_services_terms ).'</td>';
			} else {
				//Text to show if no terms attached for post & tax
				$out .= '<td class="iva_appt_services">'.__('No terms','iva_theme_front').'</td>';
			}
				
			//Category
			//If the terms array contains items... (dupe of core)
			if ( !empty($iva_category) ) {
				//Loop through terms
				$post_cat_terms ='';
				foreach ( $iva_category as $term_cat ){
					//Add tax name & link to an array
					$post_cat_terms[] = esc_html(sanitize_term_field('name', $term_cat->name, $term_cat->term_id, '', 'edit'));
				}
				//Spit out the array as CSV
				$out .= '<td class="iva_appt_category">'.implode( ', ', $post_cat_terms ).'</td>';
			} else {
				//Text to show if no terms attached for post & tax
				$out .='<td class="iva_appt_category">'.__('No terms','iva_theme_front').'</td>';
			}

			// 
			if( $iva_appointment_status !='' ){
				$out .= '<td class="iva_appt_details_val">'.$iva_appt_placed_txt.' <strong>'.$iva_pub_date.'</strong>'.' '.$iva_appt_by_txt.'<strong> '.$title.'</strong></td>';
			}else{
				$out .= '<td class="iva_appt_details_val">'.$iva_no_data_txt.'</td>';
			}

			//
			if( $iva_appointment_status !='' ){
				$out .= '<td class="iva_appt_status_val"><span class="status status_'.$iva_appointment_status.'">'.$iva_appointment_status.'</span></td>';
			}else{
				$out .= '<td class="iva_appt_status_val">'.$iva_no_data_txt.'</td>';
			}
			//
			if ( is_super_admin() ) {
				$out .='<td class="iva_ucd_val">';
				$out .= '<input type="hidden" name="iva_postid" id="iva_post_id" value="'.$post->ID.'">';
				$out .= '<a class="confirm btn green small mr10" '.$disabled.' href="'.esc_url( get_page_link( $iva_unconfirm_templateid ).'/?email='.urlencode($iva_appointment_email).'&key='.md5( $iva_appointment_email ).'&action=confirm&id='.get_the_id()).'">'.$iva_appt_confirm_txt.'</a>';
				$out .= '<a class="cancel btn red small mr10" '.$disabled.' href="'.esc_url( get_page_link( $iva_unconfirm_templateid ).'/?email='.urlencode($iva_appointment_email).'&key='.md5( $iva_appointment_email ).'&action=cancel&id='.get_the_id()).'" >'.$iva_appt_cancelled_txt.'</a>';
				$out .= '</td>';
			}else{
				$out .='<td class="iva_ucd_val"><a href="'.wp_login_url( home_url() ).'" title="Login">'.$iva_login_to_action_txt.'</a></td>';
			}
			$out .= '</tr></tbody>';
		endwhile; 
		
		if( $iva_uncnfrm_apt_limit !=-1 ){
			if( function_exists('iva_pagination') ){ 
				$out .= '<tr><td colspan="7">';	
				$out .= iva_pagination();
				$out .= '</td></tr>';
			}
		}
		wp_reset_query();
		endif; 
		
		if( $iva_count_posts < '1'){
			$out .= '<tr><td colspan="7" align="center">';	
			$out .= $iva_no_appts_txt;
			$out .= '</td></tr>';
		}

		$out .= '</table>'; 
		echo $out;
		?>
		<div class="clear"></div>
		</div><!-- .content-area -->

      </main><!-- main -->    

	</div><!-- inner -->  
</div>
<?php get_footer(); ?>