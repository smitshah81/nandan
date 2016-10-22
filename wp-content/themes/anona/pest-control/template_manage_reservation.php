<?php
/**
 * Template Name: Manage Appointments
 */
 get_header();
?>
<div id="primary" class="pagemid">
  <div class="inner">   
    <main class="content-area" role="main">
		<div class="entry-content-wrapper clearfix">
	
		<div class="iva_reservation"></div>

		<?php
		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		}
		elseif ( get_query_var('page') ) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;  
		}
				
		global $default_date,$iva_templateid;
		
		$iva_res_email = isset($_GET['email']) ? $_GET['email'] : '';
		$iva_appt_key = isset($_GET['key']) ?  $_GET['key'] : '';
		
		if(md5($iva_res_email) == $iva_appt_key){

			$iva_emai_id = trim($iva_res_email,"");
			$iva_appt_limit = get_option('iva_appt_list_limit') ?  get_option('iva_appt_list_limit') : '-1';

			$args = array(
				'post_type' => 'appointment',
				'order'    	=> 'ASC',
				'tax_query' => array(
					'relation' => 'OR',
				),
				'posts_per_page'=> $iva_appt_limit, 
				'paged' 		=> $paged,
				'meta_query' 	=> array(
					'relation' 		=> 'AND',
					array(
						'key' 		=> 'iva_appt_email',
						'value' 	=> $iva_emai_id,
						'compare' 	=> '='
					),
				)

			);
			
			query_posts( $args );
			
			$out ='';
			$iva_res_date		= get_option('iva_date_txt') ? get_option('iva_date_txt') : __('Appointment Date','iva_theme_front');
			$iva_res_time		= get_option('iva_time_txt') ? get_option('iva_time_txt') : __('Appointment Time','iva_theme_front');
			$iva_res_details	= get_option('iva_details_txt') ? get_option('iva_details_txt') : __('Appointment Details','iva_theme_front');
			$iva_res_confirm	= get_option('iva_confirm_txt') ? get_option('iva_confirm_txt') : __('Confirm','iva_theme_front');
			$iva_res_cancelled	= get_option('iva_cancelled_txt') ? get_option('iva_cancelled_txt') : __('Cancelled','iva_theme_front');
			$iva_res_update		= get_option('iva_update_txt') ? get_option('iva_update_txt') : __('Update','iva_theme_front');
			$iva_res_cancel		= get_option('iva_cancel_txt') ? get_option('iva_cancel_txt') : __('Cancel','iva_theme_front');
			$iva_res_ago		= get_option('iva_ago_txt') ? get_option('iva_ago_txt') : __('ago','iva_theme_front');
			$iva_res_for		= get_option('iva_for_txt') ? get_option('iva_for_txt') : __('for','iva_theme_front');
			$iva_res_placed		= get_option('iva_placed_txt') ? get_option('iva_placed_txt') : __('Placed','iva_theme_front');
			$iva_res_by			= get_option('iva_by_txt') ? get_option('iva_res_by_txt') : __('by','iva_theme_front');
			$iva_res_service	= get_option('iva_service_txt') ? get_option('iva_service_txt') : __('Services','iva_theme_front');
			$iva_res_category	= get_option('iva_category_txt') ? get_option('iva_category_txt') : __('Category','iva_theme_front');
			$iva_no_data_txt 	= get_option('iva_no_data_txt') ? get_option('iva_no_data_txt') : __('No Data','iva_theme_admin');
			
			$iva_appt_action = isset($_GET['action']) ? $_GET['action'] : '';
		
			if( $iva_appt_action == 'cancel'){
				
				$booking_id 	= $_GET['id'] ?  $_GET['id'] : '';
				$default_date 	= get_option('atp_date_format');
				$iva_fname		= get_the_title( $booking_id );
				$iva_lname 		= get_post_meta( $booking_id,'iva_appt_lname',true );
				$iva_email 		= get_post_meta( $booking_id,'iva_appt_email',true );
				$iva_phone 		= get_post_meta( $booking_id,'iva_appt_phone',true );
				$iva_address 	= get_post_meta( $booking_id,'iva_appt_address',true );
				$iva_date    	= date_i18n( $default_date,get_post_meta( $booking_id,'iva_appt_date',true ) );
				$iva_status    	= get_post_meta( $booking_id,'iva_appt_status',true );
				$iva_time 	   	= get_post_meta( $booking_id,'iva_appt_time',true );
			
				// Update post status
				update_post_meta( $booking_id,'iva_appt_status','cancelled' );
				
				// User and admin mailids
				$admin_emailid 	= get_option('iva_admin_emailid');
				$user_emailid 	= get_post_meta( $booking_id,'iva_appt_email', true );
				
				// Cancellation subject to user and admin
				$cancellation_subject 	= get_option('iva_usr_cancelled_subject') ? get_option('iva_usr_cancelled_subject') : '' ;
				$cncl_sub_placeholders 	= array('[first_name]','[appointment_id]');
				$cncl_sub_values 		= array( get_bloginfo('name'),$booking_id );
				$cancel_email_subject 	= str_replace( $cncl_sub_placeholders,$cncl_sub_values,$cancellation_subject ); //replace the placeholders
				
				// cancellation mail send to user 
				$usr_cncl_placeholders   =   array(
									   '[first_name]',
									   '[last_name]',
									   '[contact_email]',
									   '[contact_phone]',
									   '[appointment_date]',
									   '[appointment_time]',
									   '[appointment_note]',
									   '[appointment_status]'
									); 
				$usr_cncl_values 	   =   array(
										$iva_fname, 
										$iva_lname, 
										$iva_email, 
										$iva_phone, 
										$iva_date,
										$iva_time,
										$iva_address,
										$iva_status
									);
									
				$usr_cancellation_message 	= get_option('iva_usr_cancelled_em_msg') ? get_option('iva_usr_cancelled_em_msg') : ''; //get email message				
				$usr_cancel_email_msg 		= str_replace( $usr_cncl_placeholders,$usr_cncl_values,$usr_cancellation_message ); //replace the placeholders
				$usr_cncl_headers 			= 'From: ' . get_option('blogname') . ' Appointments <' .$admin_emailid. '>' . "\r\n\\";
				wp_mail( $user_emailid,$cancel_email_subject, $usr_cancel_email_msg,$usr_cncl_headers );
		
				// Cancellation mail send to admin 
				$admin_cncl_placeholders   =   array(
									   '[first_name]',
									   '[last_name]',
									   '[contact_email]',
									   '[contact_phone]',
									   '[appointment_date]',
									   '[appointment_time]',
									   '[appointment_note]',
									   '[appointment_status]'
									); 
				$admin_cncl_values 	    =   array(
										$iva_fname, 
										$iva_lname, 
										$iva_email, 
										$iva_phone, 
										$iva_date,
										$iva_time,
										$iva_address,
										$iva_status
									);
									
				$admin_cancellation_message = get_option('iva_usr_cancelled_msg_to_admin'); //get email message
				$admin_cancel_email_msg 	= str_replace( $admin_cncl_placeholders,$admin_cncl_values,$admin_cancellation_message ); //replace the placeholders
				$admin_cncl_headers 		= 'From: ' . get_option('blogname') . ' Appointments <' .$user_emailid. '>' . "\r\n\\";
				wp_mail( $admin_emailid,$cancel_email_subject, $admin_cancel_email_msg,$admin_cncl_headers);
				
				$response = '<div class="iva_message_box success iva-box-solid iva-box-normal"><div class="messagebox_content">'.__('Your Appointment is Cancelled', 'iva_theme_front').'</div></div>';
				echo $response;
			}
			$out .= '<table class="iva_rev_table fancy_table" width="100%" border="1px">';
			$out .= '<thead><tr>';
			$out .= '<th class="iva_res_date">'.$iva_res_date.'</th>';
			$out .= '<th class="iva_res_time">'.$iva_res_time.'</th>';
			$out .= '<th class="iva_res_service">'.$iva_res_service.'</th>';
			$out .= '<th class="iva_res_category">'.$iva_res_category.'</th>';
			$out .= '<th class="iva_res_details">'.$iva_res_details.'</th>';
			$out .= '<th class="iva_ucd"></th>';
			$out .= '</tr></thead>';
		
			if ( have_posts() ) : while ( have_posts() ) : the_post(); 
			
				$title          	 	= get_the_title( $post->ID );
				$permalink       		= get_permalink( get_the_id() );
				$iva_pub_date 			= human_time_diff( get_the_time('U'), current_time('timestamp') ).' '.$iva_res_ago;
				$iva_appointment_email 	= get_post_meta( $post->ID,'iva_appt_email',true );
				$iva_services           = get_the_terms( $post->ID, 'iva_appointment_service', true );
				$iva_category           = get_the_terms( $post->ID, 'iva_appointment_cat', true );
				$iva_appointment_date  	= get_post_meta( $post->ID,'iva_appt_date',true );
				$iva_appointment_status	= get_post_meta( $post->ID,'iva_appt_status',true );
				$iva_appointment_time 	= get_post_meta( $post->ID,'iva_appt_time',true );
				
				$res_date 		= date_i18n( $default_date,$iva_appointment_date );
		
				$disabled = '';
				$iva_appt_date_time = strtotime( $res_date. '+' .$iva_appointment_time );
				if ( $iva_appointment_date < time() ){
					$disabled = 'onclick="return false"';
				}else{
					$disabled ='';
				}

				$out .= '<tr><tbody>';
				
				// Date
				if( $iva_appointment_date !='' ){
					$out .= '<td class="iva_res_date_val">'.$res_date.'</td>';
				}else{
					$out .= '<td class="iva_appt_date_val">'.$iva_no_data_txt.'</td>';
				}
				
				// Time
				if( $iva_appointment_time !='' ){
					if( get_option('iva_time_format') == '12'){
						$data_res = date('h:i A',strtotime( $iva_appointment_time ));
						$out .= '<td class="iva_res_time_val">'.$data_res.'</td>';
					}else{
						$out .= '<td class="iva_res_time_val">'.date("H:i", strtotime( $iva_appointment_time )).'</td>';
					}
				}else{
					$out .= '<td class="iva_res_time_val">'.$iva_no_data_txt.'</td>';
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
					$out .= '<td class="iva_res_services">'.implode( ', ', $post_services_terms ).'</td>';
				} else {
					//Text to show if no terms attached for post & tax
					$out .= '<td class="iva_res_services">'.__('No terms','iva_theme_admin').'</td>';
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
					$out .= '<td class="iva_res_category">'.implode( ', ', $post_cat_terms ).'</td>';
				} else {
					//Text to show if no terms attached for post & tax
					$out .='<td class="iva_res_category">'.__('No terms','iva_theme_admin').'</td>';
				}

				if( $iva_appointment_status !='' ){
					$out .= '<td class="iva_res_details_val">'.$iva_res_placed.' <strong>'.$iva_pub_date.'</strong>'.' '.$iva_res_by.'<strong> '.$title.'</strong>-<span class="status status_'.$iva_appointment_status.'">'.$iva_appointment_status.'</span></td>';
				}else{
					$out .= '<td class="iva_appt_details_val">'.__('No details','iva_theme_admin').'</td>';
				}
				
				$out .='<td class="iva_ucd_val">';
				$out .= '<input type="hidden" name="iva_postid" id="iva_post_id" value="'.$post->ID.'">';
				if( $iva_appointment_status != "cancelled") { 
					$out .='<a class="update btn blue small mr10" '.$disabled.' href="'.esc_url( get_permalink( $post->ID )).'" >'.$iva_res_update.'</a>'; 
				}
				if( $iva_appointment_status != "cancelled") { 
					$out .='<a class="cancel btn red small mr10" '.$disabled.' href="'.esc_url( get_page_link($iva_templateid).'/?email='.urlencode($iva_appointment_email).'&key='.md5($iva_appointment_email).'&action=cancel&id='.get_the_id()).'" >'.$iva_res_cancel.'</a>';
				}else{
					$out .= '<span class="btn red small mr10">'.$iva_res_cancelled.'</span>';
				}
				$out .='</td>';
				$out .= '</tr></tbody>';
			endwhile; 
			if( $iva_appt_limit!='-1' ){
				if( function_exists('iva_pagination') ){ 
					$out .= '<tr><td colspan="6">';	
					$out .= iva_pagination();
					$out .= '</td></tr>';
				}
			}
			wp_reset_query();
			endif; 
			$out .= '</table>'; 
			echo $out;
		}
		?>
		<div class="clear"></div>
		</div><!-- .content-area -->

      </main><!-- main -->    
      <?php if ( atp_generator( 'sidebaroption', $post->ID) != "fullwidth" ){ get_sidebar(); } ?>
	</div><!-- inner -->  
</div>
<?php get_footer(); ?>