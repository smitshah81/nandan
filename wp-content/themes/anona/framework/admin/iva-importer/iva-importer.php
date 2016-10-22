<?php
defined( 'ABSPATH' ) or die( 'You cannot access this script directly' );
add_action('wp_ajax_iva_importer', 'iva_importer');
add_action('wp_ajax_nopriv_iva_importer', 'iva_importer');
function iva_importer() {
	global $wpdb;
	
	// if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true); // we are loading importers
	
	if ( ! class_exists( 'WP_Importer' ) ) { // if main importer class doesn't exist
		$wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
		require_once ( $wp_importer );
	}
	
	
	if ( ! class_exists('WP_Import') ) { // if WP importer doesn't exist
		$wp_import = get_template_directory() . '/framework/admin/iva-importer/iva-wordpress-importer.php';
		require_once $wp_import;
	}
	if ( class_exists( 'WP_Importer' ) && class_exists( 'WP_Import' ) ) { // check for main import class and wp import class
		ob_start();
		
		$iva_importer = new WP_Import();

		/* Import Posts, Pages, Portfolio Content, FAQ, Images, Menus */
		$ob_path 		= get_template_directory() . '/framework/admin/iva-importer/xml_data/'; 
		$latest_ctime  	= 0;
		
		$entry = $latest_filename = '';    
		
		$dir_instance = dir( $ob_path );
		while ( false !== ( $entry = $dir_instance->read() ) ) {
			$ob_filepath = "{$ob_path}/{$entry}";
				if ( is_file( $ob_filepath ) && filectime( $ob_filepath ) > $latest_ctime ) {
				$latest_ctime = filectime( $ob_filepath );
				$latest_filename = $entry;
			}
		}
	
		if( $latest_filename ){ 
			$theme_xml_path = get_template_directory() . '/framework/admin/iva-importer/xml_data/'.$latest_filename;
			$iva_importer->fetch_attachments = true;
			$returned_value = $iva_importer->import( $theme_xml_path );
			
			echo $returned_value;
			
			if( is_wp_error( $returned_value ) ){
				echo '<p id="iva_import_msg">'.__("An Error Occurred During Import", "iva_theme_admin") . '</p>';
			}else {
				echo '<p id="iva_import_msg">'.__("Content Imported Successfully. Now save the settings in bottom right.", "iva_theme_admin"). '</p>';
			}
			//Get all registered menu locations
			$iva_menu_locations   = get_theme_mod('nav_menu_locations');

			//Get all created menus
			$iva_menus  = wp_get_nav_menus();
			if( !empty( $iva_menus ) )
			{
				foreach( $iva_menus as $iva_menu )
				{
					if( $iva_menu->name == 'Primary Menu' ) {
						//If we have found a menu with the correct menu name apply the id to the menu location
						$iva_menu_locations['primary-menu'] = $iva_menu->term_id;
					}
				}
			}
			//Update the theme
			set_theme_mod( 'nav_menu_locations', $iva_menu_locations );
		
			// Set reading options
			$homepage_title = 'Frontpage';
			$homepage = get_page_by_title( $homepage_title );
			if(isset( $homepage ) && $homepage->ID) {
				update_option('show_on_front', 'page');
				update_option('page_on_front', $homepage->ID); // Front Page
			}
		
			// Widget Import option
			$widgets_json_file 	= get_template_directory_uri() . '/framework/admin/iva-importer/widget_data/widget_data.json'; 
			if( $widgets_json_file ){
			
				$widgets_json 		= wp_remote_get( $widgets_json_file );
				$widget_data 		= $widgets_json['body'];
				
				if( function_exists('iva_import_widget_data') ){
					iva_import_widget_data( $widget_data );
				}
			}
		}else{
			echo '<p id="iva_import_msg">'.__("No xml file exists in data folder", "iva_theme_admin") . '</p>';
		}
	}
	exit;
}
if( !function_exists('iva_import_widget_data') ){
	function iva_import_widget_data( $widget_data ){

		$json_data 		= $widget_data;
		$json_data		= json_decode( $json_data, true );
		$sidebar_data 	= $json_data[0];
		$widget_data	= $json_data[1];
		
		foreach ( $widget_data as $widget_data_title => $widget_data_value ) {
			$widgets[ $widget_data_title ] = '';
			foreach( $widget_data_value as $widget_data_key => $widget_data_array ) {
				if( is_int( $widget_data_key ) ) {
					$widgets[$widget_data_title][$widget_data_key] = 'on';
				}
			}
		}	
		unset($widgets[""]);
		foreach ( $sidebar_data as $title => $sidebar ) {
			$count = count( $sidebar );
			for ( $i = 0; $i < $count; $i++ ) {
				$widget = array();
				$widget['type'] = trim( substr( $sidebar[$i], 0, strrpos( $sidebar[$i], '-' ) ) );
				$widget['type-index'] = trim( substr( $sidebar[$i], strrpos( $sidebar[$i], '-' ) + 1 ) );
				if ( !isset( $widgets[$widget['type']][$widget['type-index']] ) ) {
					unset( $sidebar_data[$title][$i] );
				}
			}
			$sidebar_data[$title] = array_values( $sidebar_data[$title] );
		}
		foreach ( $widgets as $widget_title => $widget_value ) {
			foreach ( $widget_value as $widget_key => $widget_value ) {
				$widgets[$widget_title][$widget_key] = $widget_data[$widget_title][$widget_key];
			}
		}
		$sidebar_data = array( array_filter( $sidebar_data ), $widgets );
		if( function_exists('iva_parse_import_data') ){
			iva_parse_import_data( $sidebar_data );
		}
	}
}
if( !function_exists('iva_parse_import_data') ){
	function iva_parse_import_data( $import_array ) {
	
		global $wp_registered_sidebars;
		
		$sidebars_data 		= $import_array[0];
		$widget_data 		= $import_array[1];
		$current_sidebars 	= get_option( 'sidebars_widgets' );
		$new_widgets		= array();

		foreach ( $sidebars_data as $import_sidebar => $import_widgets ) :

			foreach ( $import_widgets as $import_widget ) :
				if ( isset( $wp_registered_sidebars[$import_sidebar] ) ) :
				
					$title 				 = trim( substr( $import_widget, 0, strrpos( $import_widget, '-' ) ) );
					$index 				 = trim( substr( $import_widget, strrpos( $import_widget, '-' ) + 1 ) );
					$current_widget_data = get_option( 'widget_' . $title );
					$new_widget_name 	 = iva_get_new_widget_name( $title, $index );
					$new_index 			 = trim( substr( $new_widget_name, strrpos( $new_widget_name, '-' ) + 1 ) );

					if ( !empty( $new_widgets[ $title ] ) && is_array( $new_widgets[$title] ) ) {
						while ( array_key_exists( $new_index, $new_widgets[$title] ) ) {
							$new_index++;
						}
					}
					$current_sidebars[$import_sidebar][] = $title . '-' . $new_index;
					if ( array_key_exists( $title, $new_widgets ) ) {
						$new_widgets[$title][$new_index] = $widget_data[$title][$index];
						$multiwidget 					 = $new_widgets[$title]['_multiwidget'];
						
						unset( $new_widgets[$title]['_multiwidget'] );
						
						$new_widgets[$title]['_multiwidget'] = $multiwidget;
					} else {
						$current_widget_data[$new_index] = $widget_data[$title][$index];
						$current_multiwidget 			 = $current_widget_data['_multiwidget'];
						$new_multiwidget 				 = isset($widget_data[$title]['_multiwidget']) ? $widget_data[$title]['_multiwidget'] : false;
						$multiwidget 					 = ($current_multiwidget != $new_multiwidget) ? $current_multiwidget : 1;
						
						unset( $current_widget_data['_multiwidget'] );
						
						$current_widget_data['_multiwidget'] = $multiwidget;
						$new_widgets[$title] 				 = $current_widget_data;
					}

				endif;
			endforeach;
		endforeach;

		if ( isset( $new_widgets ) && isset( $current_sidebars ) ) {
			update_option( 'sidebars_widgets', $current_sidebars );
			foreach ( $new_widgets as $title => $content ) {
				update_option( 'widget_' . $title, $content );
			}

			return true;
		}

		return false;
	}
}

if( !function_exists('iva_get_new_widget_name') ){
	 function iva_get_new_widget_name( $widget_name, $widget_index ) {
		$current_sidebars = get_option( 'sidebars_widgets' );
		$all_widget_array = array( );
		foreach ( $current_sidebars as $sidebar => $widgets ) {
			if ( !empty( $widgets ) && is_array( $widgets ) && $sidebar != 'wp_inactive_widgets' ) {
				foreach ( $widgets as $widget ) {
					$all_widget_array[] = $widget;
				}
			}
		}
		while ( in_array( $widget_name . '-' . $widget_index, $all_widget_array ) ) {
			$widget_index++;
		}
		$new_widget_name = $widget_name . '-' . $widget_index;
		return $new_widget_name;
	}
}
