<?php
$path = __FILE__;
$pathwp = explode( 'wp-content', $path );
$wp_url = $pathwp[0];

// Loading the wp core functions and variables
require_once( $wp_url.'/wp-load.php' );
global $shortname;

// Do not edit this if you are not familiar with php
error_reporting (E_ALL ^ E_NOTICE);
$post = ( !empty($_POST) ) ? true : false;

$thankyou_msg			= $_POST['thankyoumsg'];
$captcha_text			= $_POST['captchatext'];
$testimonial_captcha	= $_POST['testimonial_captcha'];

$error = "";

// Validation for Name
if( $_POST['title'] != ""){

}else{
	$error .= '<p>Enter  Title</p>';
}

// Validation for email
if ( filter_var( $_POST['testimonial_email'], FILTER_VALIDATE_EMAIL ) ) {
	$testimonial_email = $_POST['testimonial_email'];
}else {
	$error .= '<p>Enter a valid  E-mail ID</p>';
}

// Validation for companyname
if( $_POST['company_name'] != ""){

}else{
	$error .= '<p>Enter  Company Name</p>';
}

// Validation for websitename
if( $_POST['website_name'] != ""){

}else{
	$error .= '<p>Enter  Website Name</p>';
}



// Validation for Content
if( $_POST['content'] != ""){
	
}else{
	$error .= '<p>Enter Content</p>';
}

// Validation for captcha
if ( $testimonial_captcha == $captcha_text ) {
	
}else{
	$error.='Enter a Correct Captcha<br/>';
}
if( !$error ){
	$testim_content = isset($_POST['content'])?$_POST['content']:'';
	$testimonialdata = array(
							'post_title'  => $_POST['title'], 
							'post_type'   => 'testimonialtype', 
							'post_status' => 'pending'
						);
						
	$testimonial_fields = array( 'testimonial_email','website_name','company_name','website_url');
	
	$testimonial_id = wp_insert_post( $testimonialdata );
	
	//update post_content
	wp_update_post( array('ID' => $testimonial_id, 'post_content' => $testim_content ));
	
	foreach( $testimonial_fields as $testimonial_field ){
		update_post_meta( $testimonial_id,$testimonial_field,$_POST[$testimonial_field] );
	}
	$response = '<div class="iva_message_box success iva-box-solid iva-box-large clearfix">
	<div class="iva_message_box_content">'. $thankyou_msg.'</div></div>';

}else{ //if error occurs in validation
	$response = '<div class="iva_message_box error iva-box-solid iva-box-large clearfix">
	<div class="iva_message_box_content">'. $error.'</div></div>';
}
echo $response;
?>