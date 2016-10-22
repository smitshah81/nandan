<?php
	// E N Q U E U E   S C R I P T S   I N   A D M I N 
	if( !function_exists('iva_admin_enqueue_scripts')){
		function iva_admin_enqueue_scripts(){
			wp_enqueue_script('iva-of-script',FRAMEWORK_URI . 'admin/js/script.js');
			wp_enqueue_script('jquery-ui-core ');
			wp_enqueue_script('jquery-ui-datepicker');
			$datepicker_language = get_option( 'iva_datepicker_language'); 
			if( $datepicker_language != '')
			{
				wp_enqueue_script('datepicker_language', THEME_URI . '/js/i18n/datepicker-'.$datepicker_language.'.js', false,false,'all' );
			}

			wp_enqueue_script( 'wp-color-picker');

			wp_localize_script( 'iva-of-script', 'atp_panel', array(
				'SiteUrl' =>get_template_directory_uri()
			));
			wp_enqueue_style( 'wp-color-picker');
			wp_enqueue_style('iva-admin-css', FRAMEWORK_URI . 'admin/css/ivaadmin.css');
			wp_enqueue_style('datepicker-ui', FRAMEWORK_URI.'admin/css/datepicker.css', false, false, 'all');
		}
	}
	add_action( 'admin_enqueue_scripts', 'iva_admin_enqueue_scripts' );
?>