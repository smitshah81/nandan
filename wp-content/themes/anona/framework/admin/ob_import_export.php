<?php
$path 		= __FILE__;
$pathwp 	= explode( 'wp-content', $path );
$wp_url		= $pathwp[0];
require_once( $wp_url.'/wp-load.php' );

// Export Options Backup
add_action('wp_ajax_iva_export_ob', 'iva_export_ob');
add_action('wp_ajax_nopriv_iva_export_ob', 'iva_export_ob');
function iva_export_ob(){
	global $wpdb;
	
	$theme_options = base64_encode( serialize(( get_option('atp_template_option_values') )));
	$timestamp = date('d-m-y').'_'.time(); 
	$export_filename   = 'theme_options_'.$timestamp.'.txt';
	$theme_options_dir = get_template_directory() . '/framework/admin/options_backup/'.$export_filename;
	
	$fp  = fopen( $theme_options_dir , "w");
    fwrite( $fp, $theme_options);
	$filesize = filesize( $theme_options_dir );
	fclose( $fp );
	exit;
}

// Import Options Backup from file
add_action('wp_ajax_iva_import_ob_from_file', 'iva_import_ob_from_file');
add_action('wp_ajax_nopriv_iva_import_ob_from_file', 'iva_import_ob_from_file');
function iva_import_ob_from_file(){
	global $wpdb;
	
	$theme_options_txt = isset( $_POST['import_ob_file'] ) ? $_POST['import_ob_file'] :'';

	if( isset( $theme_options_txt ) ){
		global $iva_of_options;
		
		$options_data = unserialize( base64_decode( $theme_options_txt )  );
		update_option( 'atp_template_option_values', $options_data ); // update theme options
		if(count($options_data) > 1 ) {
			update_option_values( $iva_of_options,$options_data);
		}
	}
	exit;
}

// Import Options Backup
add_action('wp_ajax_iva_import_ob', 'iva_import_ob');
add_action('wp_ajax_nopriv_iva_import_ob', 'iva_import_ob');
function iva_import_ob(){
	global $wpdb;
	
	$ob_import_filename = isset( $_POST['ob_import'] ) ? $_POST['ob_import'] :'';
	$theme_options_txt = get_template_directory_uri() . '/framework/admin/options_backup/'.$ob_import_filename;

	if( isset( $theme_options_txt ) ){
		global $iva_of_options;
		$theme_options_txt = wp_remote_get( $theme_options_txt );
		$options_data = unserialize( base64_decode( $theme_options_txt['body'])  );
		update_option( 'atp_template_option_values', $options_data ); // update theme options
		if(count($options_data) > 1 ) {
			update_option_values( $iva_of_options,$options_data);
		}
	}
	exit;
}

// Download File
$ob_download_file 	= isset( $_GET['download_file'] ) ? $_GET['download_file'] : '' ;
if( $ob_download_file ) {
	$ob_file_path = get_template_directory() . '/framework/admin/options_backup/'.$ob_download_file;
	$filesize = filesize( $ob_file_path );
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment;  filename= '.$ob_download_file );
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	 header('Content-Length: ' . $filesize);
	readfile( $ob_file_path );
}
// Delete File
add_action('wp_ajax_iva_delete_ob', 'iva_delete_ob');
add_action('wp_ajax_nopriv_iva_delete_ob', 'iva_delete_ob');
function iva_delete_ob(){
	global $wpdb;
	
	$ob_delete_file = isset( $_POST['delete_file'] ) ? $_POST['delete_file'] :'';
	$ob_delete_path = get_template_directory() . '/framework/admin/options_backup/'.$ob_delete_file;
	unlink( $ob_delete_path );
}
?>