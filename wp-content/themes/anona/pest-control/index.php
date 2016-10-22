<?php 
/**
 * this class extends ATP_Theme.
 */
if(!class_exists('ATP_theme_pest')){
	class ATP_theme_pest extends ATP_Theme {
	
		

		/**
	     * load pestcontrol custom meta.
	     */		
		function atp_custom_meta(){
	
			parent::atp_custom_meta();
			require_once( PSTCTRL_DIR . 'appointment/appointment-meta.php');
			require_once( PSTCTRL_DIR . 'pest/pest-meta.php');
		}
	}
	
	$atp_theme = new ATP_theme_pest();
}

/**
 * provides pestcontrol options details
 */

define( 'PSTCTRL_URI', get_template_directory_uri() . '/pest-control/');

/**
 * require appointment functions
 */
require_once( PSTCTRL_DIR . 'appointment/appointment-functions.php');
require_once( PSTCTRL_DIR . 'additional-meta.php');
require_once( PSTCTRL_DIR . 'additional-themeoptions.php');
require_once( PSTCTRL_DIR . 'posttype-labeloptions.php');


/**
 * Additional Meta Class
 */
require_once( PSTCTRL_DIR . 'additional-sh-meta.php');


/**
 * Manage Reservation page id
 */
	
   $iva_templateid = '';
   $page_query = new WP_Query(
	array(
		 'post_type'  => 'page',
		 'meta_key'   => '_wp_page_template',
		 'meta_value' => 'pest-control/template_manage_reservation.php'
	)
   );
 
   if ( $page_query->have_posts()) : while (  $page_query->have_posts()) :  $page_query->the_post();
   
   $iva_templateid = get_the_id();
   
   endwhile;
   endif;

  
/**
 * Manage Confirm template page id
 */
$iva_confirm_templateid = '';
   $confirm_page_query = new WP_Query(
	array(
		 'post_type'  => 'page',
		 'meta_key'   => '_wp_page_template',
		 'meta_value' => 'pest-control/template_confirm_appts.php'
	)
);

if ( $confirm_page_query->have_posts()) : while (  $confirm_page_query->have_posts()) :  $confirm_page_query->the_post();
$iva_confirm_templateid = get_the_id();

endwhile;
endif; 

/**
 * Manage UnConfirm template page id
 */
$iva_unconfirm_templateid = '';
   $unconfirm_page_query = new WP_Query(
	array(
		 'post_type'  => 'page',
		 'meta_key'   => '_wp_page_template',
		 'meta_value' => 'pest-control/template_unconfirm_appts.php'
	)
);

if ( $unconfirm_page_query->have_posts()) : while (  $unconfirm_page_query->have_posts()) :  $unconfirm_page_query->the_post();
$iva_unconfirm_templateid = get_the_id();

endwhile;
endif; 

/**
 * Manage Cancel template page id
 */
$iva_cancel_templateid = '';
   $cancel_page_query = new WP_Query(
	array(
		 'post_type'  => 'page',
		 'meta_key'   => '_wp_page_template',
		 'meta_value' => 'pest-control/template_cancel_appts.php'
	)
);

if ( $cancel_page_query->have_posts()) : while (  $cancel_page_query->have_posts()) :  $cancel_page_query->the_post();
$iva_cancel_templateid = get_the_id();

endwhile;
endif; 

//S I N G L E  P O S T T Y P E S
//---------------------------------------------------------------------------
if(!function_exists('atp_single_posttypes')){
	function atp_single_posttypes() {
		global $wp_query, $post;  
		$customtype = $post->post_type;
		if(file_exists( PSTCTRL_DIR .$customtype.'/'. 'single-'.$customtype.'.php')){
			return PSTCTRL_DIR . $customtype.'/'. 'single-'.$customtype.'.php';
		}
		elseif(file_exists( THEME_DIR . '/single-'.$customtype.'.php')){
			return THEME_DIR . '/single-'.$customtype.'.php';
		}else{
			return THEME_DIR .'/single.php';
		}
	}
	add_filter('single_template', 'atp_single_posttypes');
}

//Retrieve path of taxonomy template in current or parent template. 
if(!function_exists('atp_taxonomy_posttypes')){
	function atp_taxonomy_posttypes(){
	
		global $wp_query, $post;  
		$customtype = $post->post_type;
		$name 		= get_queried_object()->taxonomy;
		
		if(file_exists( PSTCTRL_DIR .$customtype.'/'. 'taxonomy-'.$name.'.php')){
			return PSTCTRL_DIR . $customtype.'/'. 'taxonomy-'.$name.'.php';
		}elseif(file_exists( THEME_DIR . '/taxonomy-'.$name.'.php')){
			return THEME_DIR . '/taxonomy-'.$name.'.php';
		}else{
			return THEME_DIR .'/archive.php';
		} 
	}
	add_filter('taxonomy_template', 'atp_taxonomy_posttypes');
}

/**
 * function iva_admin_enqueue_custompostscripts()
 * admin enqueue styles and scripts
 */
if(!function_exists('iva_admin_enqueue_custompostscripts')){
	function iva_admin_enqueue_custompostscripts(){
		/**
		 * enqueue the admin scripts and css here.
		 */
		wp_enqueue_script('atp-pest-shortcode.js', PSTCTRL_URI . 'js/pest-shortcode.js', false,false,'all' );  
	}
	add_action( 'admin_enqueue_scripts', 'iva_admin_enqueue_custompostscripts' );
}
/**
 * function iva_front_enqueue_custompostscripts()
 *
 * enqueues both scripts and styles on front end.
 * @uses wp_enqueue_style().
 * @uses wp_enqueue_script()
 */
if(!function_exists('iva_front_enqueue_custompostscripts')){
	function iva_front_enqueue_custompostscripts()
	{
		wp_enqueue_script('iva-form', PSTCTRL_URI .'js/form.js','jquery','','in_footer');
		wp_register_script('iva-weather', PSTCTRL_URI . 'js/jquery.simpleWeather.min.js', 'jquery','1.0','in_footer');
		wp_enqueue_script('iva-weather'); 
	}
	add_action( 'wp_enqueue_scripts', 'iva_front_enqueue_custompostscripts' );
}
// Sending admin notification email
$status_changed_notification_msg = get_option('iva_admin_status_chng_msg');
$iva_status = isset( $_POST['iva_appt_status'] ) ? $_POST['iva_appt_status'] : '';
if( $iva_status ) {	
	switch( $iva_status ){
	
		case 'cancelled':
			$status_txt = get_option('iva_apt_cancel') ? get_option('iva_apt_cancel') : __('Cancelled','iva_theme_admin');
			break;
			
		case 'unconfirmed':
			$status_txt = get_option('iva_apt_unconfirm') ? get_option('iva_apt_unconfirm') : __('UnConfirmed','iva_theme_admin');
			break;
			
		case 'confirmed':
			$status_txt = get_option('iva_apt_confirm') ? get_option('iva_apt_confirm') : __('Confirmed','iva_theme_admin');
			break;
	}

	$iva_appttime  = get_post_meta( $_POST['post_ID'],'iva_appt_time',true );
	$iva_appttime  = date( 'g:i a', strtotime( $iva_appttime ));
	$iva_appt_notes = isset( $_POST['iva_appt_notes'] )? $_POST['iva_appt_notes'] :'';

	// Assigns message details for appointment

	$placeholders 				=	 array(
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
	$values 				 	=	 array(
										get_the_title( $_POST['post_ID'] ),
										$_POST['iva_appt_lname'],
										$_POST['iva_appt_email'],
										$_POST['iva_appt_phone'],
										$_POST['iva_appt_date'],
										$iva_appttime,
										$_POST['iva_appt_address'],
										$iva_appt_notes,
										$status_txt
									);	

	$status_changed_email_msg 	= str_replace( $placeholders,$values,$status_changed_notification_msg ); //replace the placeholders

	$status_subject 			= get_option('iva_admin_status_chng_sub');
	
	// Assigns subject for appointment
	$appt_placeholders 	= array('[appointment_id]' );			
	$appt_values 		= array( $_POST['post_ID'] );
	
	$status_email_subject = str_replace( $appt_placeholders,$appt_values,$status_subject); //replace the placeholders
	
	$aivah_booking_email = isset( $_POST['iva_appt_email'] ) ? $_POST['iva_appt_email'] :'';
	
	/**
	 * Headers
	 */
	$iva_apt_headers_msg = get_option('iva_apt_headers_msg') ? get_option('iva_apt_headers_msg') :get_option('blogname');
	$headers 	  = 'From: ' . $iva_apt_headers_msg . ' Appointment <' .get_option('iva_admin_emailid'). '>' . "\r\n\\";
	
	// Sends email
	wp_mail( $aivah_booking_email, $status_email_subject, $status_changed_email_msg, $headers );
}
if( !function_exists('aivah_pest_add_query_vars_filter')){ 
	function aivah_pest_add_query_vars_filter( $vars ){
	  $vars[] = "email";
	  return $vars;
	}
	add_filter( 'query_vars', 'aivah_pest_add_query_vars_filter' );
}
?>