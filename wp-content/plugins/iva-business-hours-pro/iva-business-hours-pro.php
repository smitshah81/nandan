<?php
/** 
 * Plugin Name: Business Hours Pro
 * Plugin URI: http://www.aivahthemes.com 
 * Description: Displays Business Hours of your website. Useful for Office, Stores, Hotels and Restaurants etc. 
 * Version: 2.5.4
 * Author: AivahThemes
 * Author URI: http://www.aivahthemes.com 
 * License: 
 * This plugin and its accompanying tutorial are written for Nettuts+ at http://net.tutsplus.com 
 */ 

	/**
	 * Text domain for the plugin
	 */
	add_action( 'plugins_loaded', 'iva_business_hours_plugin_load_textdomain' );
	function iva_business_hours_plugin_load_textdomain() {
		load_plugin_textdomain( 'iva_business_hours', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
	}


	global $wpdb,$iva_bh_db_version;
	$wpdb->iva_businesshours = $wpdb->prefix.'iva_businesshours';
	
	$iva_bh_db_version = '1.0.0'; // Initial Plugin Version
	
	register_activation_hook( __FILE__, 'iva_bhinstall' );
	
	/**
	 * function iva_bh_install()
	 * installs plugin
	 */
	function iva_bhinstall(){
		
		global $wpdb,$iva_bh_db_version;
		
		$installed_version 	=  get_option('iva_bh_db_version') ? get_option('iva_bh_db_version') : $iva_bh_db_version;
		$iva_bh_plugin_data = iva_bh_plugin_data();
		$update_version 	= $iva_bh_plugin_data['Version'];
	
		$charset_collate = '';
		
		if( method_exists( $wpdb, "get_charset_collate" ) )
			$charset_collate = $wpdb->get_charset_collate();
		else{
			if ( ! empty($wpdb->charset) )
				$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
			if ( ! empty($wpdb->collate) )
				$charset_collate .= " COLLATE $wpdb->collate";
		}	
			
		if ( $wpdb->get_var("SHOW TABLES LIKE '$wpdb->iva_businesshours'") != $wpdb->iva_businesshours ){
			$sql = "CREATE TABLE " . $wpdb->iva_businesshours . " (  
						id int(10) NOT NULL AUTO_INCREMENT,   
						title longtext NOT NULL,
						alias longtext NOT NULL,
						shortcode longtext NOT NULL,
						weekday0 longtext NOT NULL,
						weekday1 longtext NOT NULL,
						weekday2 longtext NOT NULL,
						weekday3 longtext NOT NULL,
						weekday4 longtext NOT NULL,
						weekday5 longtext NOT NULL,
						weekday6 longtext NOT NULL,
						closedtext text NOT NULL,
						timeseparator text NOT NULL,
						description longtext NOT NULL,
						descriptionprefix text NOT NULL,
						descriptionenable text NOT NULL,
						todaydate text NOT NULL,
						PRIMARY KEY (id),  
						KEY id (id)
					)$charset_collate;";
			
			$wpdb->query( $sql );
		}

		$iva_bh_data_row = $wpdb->get_row("SELECT * FROM $wpdb->iva_businesshours");
		$iva_bh_columns =  array(
								'closed_bg_color',
								'grouping_enable',
								'toggle_enable',
								'open_image',
								'close_image',
								'current_day_color',
								'open_bg_color',
								'opentext',
								'closedays_hide',
								'oc_text_hide',
								'singleday_show',
								'algncenter_hrs',
								'singleday_disable' 
							);
		foreach($iva_bh_columns as $column){
			if( !isset( $iva_bh_data_row->$column )){		
				$wpdb->query("ALTER TABLE $wpdb->iva_businesshours ADD COLUMN $column VARCHAR(255) NOT NULL");
			}
		}
		if ( $installed_version != $update_version ) {
			update_option('iva_bh_db_version',$update_version);
		}
	}
	/**
	 * function iva_bh_uninstall()
	 * uninstalls plugin
	 */
	register_uninstall_hook( __FILE__, 'iva_bh_uninstall');
	function iva_bh_uninstall(){
		global $wpdb;
		
		$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}iva_businesshours");
	}
	
	/**
	 * Defining Plugin Constants
	 */
	define( 'IVA_BH_PATH', plugin_dir_path( __FILE__ ) );
	define( 'IVA_BH_URL', plugin_dir_url( __FILE__ ) );

	global $iva_bh_defaultdate;
	$iva_bh_date_format = get_option('iva_bh_date_format')?get_option('iva_bh_date_format'):'Y/m/d';
	switch( $iva_bh_date_format ){
		case 'Y/m/d':
					$iva_bh_defaultdate = 'yy/mm/dd';
					break;
		case 'm/d/Y':
					$iva_bh_defaultdate = 'mm/dd/yy';
					break;
		case 'd-m-Y':
					$iva_bh_defaultdate = 'dd-mm-yy';
					break;
		default:
					$iva_bh_defaultdate = 'yy/mm/dd';
					break;
	}
	/**
	 * function iva_bh_admin_scripts()
	 * admin enqueue scripts
	 */
	add_action('admin_enqueue_scripts', 'iva_bh_admin_scripts');
	function iva_bh_admin_scripts(){
		wp_enqueue_script('jquery');
		wp_enqueue_script('iva-business',IVA_BH_URL .'assets/js/iva-business-hours-pro.js', array( 'jquery' ), '', true );
		wp_register_script( 'jquery-timepicker' , IVA_BH_URL .'assets/js/jquery-ui-timepicker-addon.js' , array( 'jquery', 'jquery-ui-datepicker', 'jquery-ui-slider' ) , '1.4.3' );
		wp_enqueue_script( 'jquery-timepicker');
		wp_localize_script( 'jquery-timepicker', 'iva_bh_timepickerOptions', iva_bh_timepickerOptions() );
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_style( 'iva-bhrs-admin' , IVA_BH_URL . 'assets/css/iva-bh-admin.css', false,false,'all');
		wp_enqueue_style( 'iva-bhrs-fontello' , IVA_BH_URL . 'assets/fontello/css/fontello.css', false,false,'all');
		wp_enqueue_style( 'iva-bhrs-jquery-ui' , IVA_BH_URL . 'assets/css/jquery-ui.css', false,false,'all');
		wp_enqueue_style('iva-bhrs-datepicker', IVA_BH_URL.'assets/css/datepicker.css', false, false, 'all');
		
		global $iva_bh_defaultdate;
		
		$iva_bh_date_lng = get_option('iva_bh_date_lng') ? get_option('iva_bh_date_lng') :'';
		if( $iva_bh_date_lng != ''){
			wp_enqueue_script('iva-bhrs-datepicker-lng', IVA_BH_URL . 'assets/js/i18n/datepicker-'.$iva_bh_date_lng.'.js', false,false,'all' );
		}		
		wp_localize_script('iva-business', 'iva_bh_panel', 
		array(
			'date_format' 	=> $iva_bh_defaultdate,
			'date_language' => $iva_bh_date_lng
		));
		
		// Upload
		wp_enqueue_media();
		wp_enqueue_script('media-upload' );
		wp_enqueue_script('iva-bhrs-upload',IVA_BH_URL .'assets/js/bhrs_upload.js', array( 'jquery' ), '', true );
		// Modal
		wp_enqueue_style( 'iva-modal-component' , IVA_BH_URL . 'assets/css/component.css', false,false,'all');
		wp_enqueue_script('iva-classie',IVA_BH_URL .'assets/js/classie.js', array( 'jquery' ), '', true );
		wp_enqueue_script('iva-modalEffects',IVA_BH_URL .'assets/js/modalEffects.js', array( 'jquery' ), '', true );
	}

	/**
	 * function iva_bh_front_scripts()
	 * frontend enqueue scripts
	 */
	add_action('wp_enqueue_scripts', 'iva_bh_front_scripts');
	function iva_bh_front_scripts(){
		wp_enqueue_style( 'iva-bhrs-front' , IVA_BH_URL . 'assets/css/iva-bh-front.css', false,false,'all');
		wp_enqueue_script('jQuery');
		wp_enqueue_script('iva-business',IVA_BH_URL .'assets/js/iva-business-hours-pro-front.js', array( 'jquery' ), '', true );
	}
	
	/**
	 * function iva_bh_menu()
	 * adding business hours pro menu to wp admin dashboard
	 */
	add_action( 'admin_menu', 'iva_bh_menu' );
	function iva_bh_menu(){
		add_menu_page( 'Business Hours Pro', 'Biz Hours Pro', 'manage_options', 'iva-business-hours-pro', 'iva_bh_page', IVA_BH_URL .'assets/images/aivah-icon.png',59 ); 
		add_submenu_page('iva-business-hours-pro', 'Add/Edit Business Hours', 'Add New', 'manage_options', 'bhrs-operations', 'iva_bh_operations');
		add_submenu_page('iva-business-hours-pro', 'Settings', 'Settings', 'manage_options', 'bhrs-settings', 'iva_bh_settings');
	}

	/**
	 * function iva_bh_settings()
	 * fetching plugin data
	 */
	function iva_bh_settings(){
		global $wpdb;
		
		
		$time_formats_array = array(
			'H:i'	=> get_date_from_gmt ( date( 'Y-m-d H:i:s', time() ), 'H:i' ),
			'g:i a' => get_date_from_gmt ( date( 'Y-m-d H:i:s', time() ), 'g:i a' ),
			'g:i A' => get_date_from_gmt ( date( 'Y-m-d H:i:s', time() ), 'g:i A' ),
		);
		
		$date_formats_array = array(
			'Y/m/d'  => date("Y/m/d"),
			'm/d/Y'  => date("m/d/Y"),
			'd-m-Y'  => date("d-m-Y"),
		);
		 $date_languages = array(
              ''    => 'English',
              'sq'  => 'Albanian',
              'ar'   => 'Arabic',
              'bg'  => 'Bulgarian',
              'zh-CN'  => 'Chinese',
              'zh-TW'   => 'Chinese Traditiona',
              'da'  => 'Danish',
              'fr'    => 'French',
              'fa'    => 'Farsi', 
              'fi'  => 'Finnish',
              'de'  => 'German',
              'ka'  => 'Georgian',
              'he'    => 'Hebrew',
              'id'  => 'Indonesian',
              'is'  => 'Icelandic',
              'it'  => 'Italian',
              'ja'  => 'Japanese',
              'lt'  => 'Lithuanian',
              'lv'  => 'Latvian',
              'ms'  => 'Malaysian',
              'ml'  => 'Malayalam',
              'mk'  => 'Macedonian',
              'nn'  => 'Norwegian Nynorsk',
              'no'  => 'Norwegian',
              'pl'  => 'Polish',
              'pt'  => 'Portuguese',
              'pt-BR'  => 'Brazilian',
              'rm'  => 'Romansh',
              'ro'  => 'Romanian',
              'ru'  => 'Russian',
              'sk'   => 'Slovak',
              'sl'  => 'Slovenian',
              'sr'   => 'Serbian',
              'sv'  => 'Swedish',
              'ta'  => 'Tamil',
              'th'  => 'Thai',
              'tj'  => 'Tajiki',
              'tr'  => 'Turkish',
              'uk'  => 'Ukrainian',
              'vi'  => 'Vietnamese'
         );
			
		$iva_bh_holidays_array ='';
		
		$iva_bh_time_format = get_option('iva_bh_time_format')?get_option('iva_bh_time_format'):'H:i';
		$iva_bh_date_format = get_option('iva_bh_date_format')?get_option('iva_bh_date_format'):'Y/m/d';
		$iva_bh_date_lng 	= get_option('iva_bh_date_lng')?get_option('iva_bh_date_lng'):'';
		$iva_today_text 	= get_option('iva_today_text')?get_option('iva_today_text'):'';
		$iva_seemore_text 	= get_option('iva_seemore_text')?get_option('iva_seemore_text'):'';
		$iva_bh_holidays 	= get_option('iva_bh_holidays')?get_option('iva_bh_holidays'):'';
		
		if( $iva_bh_holidays!=''){ $iva_bh_holidays_array = json_decode( $iva_bh_holidays ); }
		
		$iva_bh_plugin_data = iva_bh_plugin_data();
		
		echo '<div class="bHrs-mainwrap">';
		// Logo Bar
		/*---------------------------*/
		echo '<div class="businessHrs-title main-heading"><div class="bHrs_icon green businessHrs-logo "><span class="ivaIcon"></span></div><h2>'.$iva_bh_plugin_data['Name'].' - <span>'.$iva_bh_plugin_data['Version'].'</h2></div>';
		
		echo '<div id="settings_success_msg"></div>';
		
		echo '<form method="post" id="iva_bh_settings_form" class="iva_bh_settings_form" name="iva_bh_settings_form" action="#">';
		
		// General Settings Page
		/*---------------------------*/
		echo '<div class="businessHrs-title sub-heading"><div class="bHrs_icon blue"><span class="ivaIcon "><i class="aicon_setings"></i></span></div><h2>'.__('General Settings', 'iva_business_hours').'</h2>';

		// Time Format
		echo '<div class="ivabh_bh_title">'.__('Time Format:', 'iva_business_hours').'</div>';
		echo '<div class="ivabh-input-details">';
		echo '<select name="iva_bh_time_format" id="iva_bh_time_format" class="iva_bh_time_format">';
		foreach( $time_formats_array as $key => $value ){
			$selected ='';
			if ( $iva_bh_time_format == $key ) {
				$selected = "selected= 'selected'";
			}
			echo '<option '.$selected.' value="' . $key . '"><span>' . $value . '</span></option>';
		}
		echo '</select>';
		echo '<p class="ivabh-desc">'.__(' Select the Time Format you wish to display for the Hours Shortcode.','iva_business_hours'). '</p>';
		echo '</div><hr />'; 
		
		// Date Format
		echo '<div class="ivabh_bh_title">'.__('Date Format:', 'iva_business_hours').'</div>';
		echo '<div class="ivabh-input-details">';
		echo '<select name="iva_bh_date_format" id="iva_bh_date_format" class="iva_bh_date_format">';
		foreach( $date_formats_array as $key => $value ){
			$selected = '';
			if ( $iva_bh_date_format == $key ) {
				$selected = "selected= 'selected'";
			}
			echo '<option '.$selected.' value="' . $key . '"><span>' . $value . '</span></option>';
		}
		echo '</select>';
		echo '<p class="ivabh-desc">'.__(' Select the Date Format you wish to display for the Hours Shortcode.','iva_business_hours'). '</p>';
		echo '</div><hr />';
		
		// Date Languages
		echo '<div class="ivabh_bh_title">'.__('Languages', 'iva_business_hours').'</div>';
		echo '<div class="ivabh-input-details">';
		echo '<select name="iva_bh_date_lng" id="iva_bh_date_lng" class="iva_bh_date_lng">';
		foreach( $date_languages as $key => $value ){
			$selected ='';
			if ( $iva_bh_date_lng == $key ) {
				$selected = "selected= 'selected'";
			}
			echo '<option '.$selected.' value="' . $key . '"><span>' . $value . '</span></option>';
		}
		echo '</select>';
		echo '<p class="ivabh-desc">'.__(' Select the Language for datepicker and calender inputs.','iva_business_hours'). '</p>';
		echo '</div><hr />';
		
		echo '<div class="ivabh_bh_title">'.__('Today text','iva_business_hours').'</div>';
		echo '<div class="ivabh-input-details">';
		echo '<input type="text" name="iva_today_text" value="'.$iva_today_text.'" class="">';
		echo '<p class="ivabh-desc">'.__(' \'Todays\' text string translation which appears on frontend.','iva_business_hours'). '</p>';
		echo '</div><hr />';
		
		echo '<div class="ivabh_bh_title">'.__('See more','iva_business_hours').'</div>';
		echo '<div class="ivabh-input-details">';
		echo '<input type="text" name="iva_seemore_text" value="'.$iva_seemore_text.'" class="">';
		echo '<p class="ivabh-desc">'.__(' \'See more\' text string translation which appears on frontend. ( Toggle Mode Business Hours )','iva_business_hours'). '</p>';
		echo '</div><hr />';

		echo '</div>';//.settings-tab
		
		
		// Add Holidays Bar
		/*---------------------------*/
		echo '<div class="businessHrs-title sub-heading"><div class="bHrs_icon blue"><span class="ivaIcon "><i class="aicon_cal"></i></span></div><h2>'.__('Add Holidays', 'iva_business_hours').'</h2>';
		echo '<div id="iva_bh_holiday_wrap" class="iva_bh_holiday_wrap">';
		echo '<div class="iva_bh_holiday_count">';
		
		$c = '0';
		
		if( empty( $iva_bh_holidays_array )){
			echo '<div class="iva_bh_holiday_row">';
			echo '
			<div class="ivabh_hd_input"><label>'.__( 'Name', 'iva_business_hours' ).'</label>
				<div class="ivabh-input-details">
				<input type="text" class="iva_bh_hd_name" name="iva_bh_hd_name[]" value="">
				<p class="ivabh-desc">'.__('Add display name for holiday.','iva_business_hours').'</p>
				</div>
			</div>
			<div class="ivabh_hd_input"><label>'.__( 'Start Date', 'iva_business_hours' ).'</label>
				<div class="ivabh-input-details">
				<input type="text" class="iva_bh_hd_start iva_bh_date" name="iva_bh_hd_start[]" value="">
				<p class="ivabh-desc">'.__('Select Holiday Start Date','iva_business_hours').'</p>
				</div>
			</div>
			<div class="ivabh_hd_input"><label>'.__( 'End Date', 'iva_business_hours' ).'</label>
				<div class="ivabh-input-details">
				<input type="text" class="iva_bh_hd_end iva_bh_date" name="iva_bh_hd_end[]" value="">
				<p class="ivabh-desc">'.__('Select Holiday End Date','iva_business_hours').'</p>
				</div>
			</div>
			<div class="ivabh_hd_input"><label>'.__( 'Description', 'iva_business_hours' ).'</label>
				<div class="ivabh-input-details">
				<input type="text" class="iva_bh_hd_desc" name="iva_bh_hd_desc[]" value="" maxlength="150" size="50">
				<p class="ivabh-desc">'.__('Write Description for holiday (max : 150 characters)','iva_business_hours').'</p>
				</div>
			</div>
			<div class="ivabh_hd_input"><label>&nbsp;</label><a title="Delete button"  class="delete_bh_hd button button-primary red-button">Delete</a></div>
			<div class="ivabh_hd_checkbox">
				<div class="ivabh-input-details">
				<input type="checkbox" class="iva_bh_hd_desc_disable" id="iva_bh_hd_desc_disable"  name="iva_bh_hd_desc_disable[]"><label for="iva_bh_hd_desc_disable">'.__('Check this if you wish to hide this holiday on frontend.','iva_business_hours').'</label>
				</div>
			</div>';
			echo '</div>';//.iva_bh_holiday_row
		}elseif( !empty( $iva_bh_holidays_array )){
			
			foreach ( $iva_bh_holidays_array as $key => $value){
			
				$iva_bh_date_format = get_option('iva_bh_date_format')?get_option('iva_bh_date_format'):'Y/m/d';
				
				$iva_start_date = @date( $iva_bh_date_format, $value->start );
				$iva_end_date 	= @date( $iva_bh_date_format, $value->end );
				
				$name 		= isset( $value->name ) ? strip_tags( $value->name ) :'';
				$start 		= isset( $value->start ) ? $iva_start_date :'';
				$end 		= isset( $value->end ) ? $iva_end_date :'';
				$desc 		= isset( $value->desc ) ? stripslashes( $value->desc ) :'';
				$disable 	= isset( $value->desc_disable ) ? $value->desc_disable :'';
				$checked 	= '';
				
				if ( $disable == 'on'){	$checked = 'checked="checked"';	}
				
				echo '<div class="iva_bh_holiday_row">';
				echo '<div class="ivabh_hd_input"><label>'.__( 'Name', 'iva_business_hours' ).'</label>
						<div class="ivabh-input-details">
						<input type="text" class="iva_bh_hd_name" name="iva_bh_hd_name[]" value="'.$name.'">
						<p class="ivabh-desc">'.__('Add display name for holiday.','iva_business_hours').'</p>
						</div>
					</div>';
				echo '<div class="ivabh_hd_input"><label>'.__( 'Start Date', 'iva_business_hours' ).'</label>
						<div class="ivabh-input-details">
						<input type="text" class="iva_bh_hd_start iva_bh_date" name="iva_bh_hd_start[]" value="'.$start.'">
						<p class="ivabh-desc">'.__('Select Holiday Start Date','iva_business_hours').'</p>
						</div>
					</div>';
				echo '<div class="ivabh_hd_input"><label>'.__( 'End Date', 'iva_business_hours' ).'</label>
						<div class="ivabh-input-details">
						<input type="text" class="iva_bh_hd_end iva_bh_date" name="iva_bh_hd_end[]" value="'.$end.'">
						<p class="ivabh-desc">'.__('Select Holiday End Date','iva_business_hours').'</p>
						</div>
					</div>';
				echo '<div class="ivabh_hd_input"><label>'.__( 'Description', 'iva_business_hours' ).'</label>
						<div class="ivabh-input-details">
						<input type="text" class="iva_bh_hd_desc" name="iva_bh_hd_desc[]" value=\''.$desc.'\' maxlength="150" size="50">
						<p class="ivabh-desc">'.__('Write Description for holiday (max : 150 characters)','iva_business_hours').'</p>
						</div>
					</div>';
				echo '<div class="ivabh_hd_input"><label>&nbsp;</label><a title="Delete button"  class="delete_bh_hd button button-primary red-button">'.__('Delete','iva_business_hours').'</a></div>';
				
				echo '<div class="ivabh_hd_checkbox">
						<div class="ivabh-input-details">
						<input type="checkbox" class="iva_bh_hd_desc_disable" id="iva_bh_hd_desc_disable'.$c.'"  name="iva_bh_hd_desc_disable[]"  '.$checked.'><label for="iva_bh_hd_desc_disable'.$c.'">'.__('Check this if you wish to hide this holiday on frontend.','iva_business_hours').'</label>
						</div>
					</div>';
				echo '</div>';//.iva_bh_holiday_row
				$c = $c + 1;	
			}
		}
		echo '</div>';// #iva_bh_holiday_count
		echo '<a data_ivbh_hd_url = "'.admin_url( 'admin.php?page=iva-business-hours-pro').'" id="add_bh_holidays" class="add_bh_holidays button green-button"><i class="icon-add"></i>'.__('Add Holiday','iva_business_hours').'</a>';
	
		echo '</div>';// #iva_bh_holiday_wrap
		echo '</div>';// end of .business-title
		// Ends holidays
	
		echo '</form>';
		echo '<a data_ivbh_url = "'.admin_url( 'admin.php?page=bhrs-settings').'" class="update_bh_settings button button-hero blue-button">'.__('Save All Changes','iva_business_hours').'</a>';
		
		echo '<br /><br /><div class="clear"></div><hr />';
		echo '<div id="ivabh-footer" class="clearfix">';
		echo '<p id="footer-right" class="alignleft">&copy;'.__('Plugin Developed by - <a href="http://www.aivahthemes.com" target="_blank">AivahThemes</a>','iva_business_hours').'</p>';
		echo '<p id="footer-upgrade" class="alignright">'.$iva_bh_plugin_data['Name'].'&nbsp;'.$iva_bh_plugin_data['Version'].'</p></div><hr />';

		echo '</div>';// end of .wrap
		
		}
	
	/**
	 * function iva_get_timeformat()
	 * deleting busiess hours data from database.
	 */
	add_action('wp_ajax_iva_bh_update_settings', 'iva_bh_update_settings');
	add_action('wp_ajax_nopriv_iva_bh_update_settings', 'iva_bh_update_settings');
	function iva_bh_update_settings(){

		global $wpdb;
		
		$postForm = isset( $_POST['data'] ) ? $_POST['data'] :'';

		/**
		 * function parse_str
		 * @param 'str' inpput string
		 * @param 'arr' If the second parameter arr is present, variables are stored in this variable as array elements instead. 
		 * @return No value is returned. 
		 */
		parse_str( $postForm, $formdata );
		
		$error = $iva_today_text = $iva_seemore_text = '';
		$post  = ( !empty( $_POST ) ) ? true : false;
	
		if( isset( $formdata['iva_bh_time_format'] ) && $formdata['iva_bh_time_format']!='' ){ 
			$iva_bh_time_format = $formdata['iva_bh_time_format'];
		}else{
			$iva_bh_time_format = 'H:i';
		}
		
		if( isset( $formdata['iva_bh_date_format'] ) && $formdata['iva_bh_date_format']!='' ){ 
			$iva_bh_date_format = $formdata['iva_bh_date_format'];
		}else{
			$iva_bh_date_format = 'Y/m/d';
		}
		
		if( isset( $formdata['iva_bh_date_lng'] ) && $formdata['iva_bh_date_lng']!='' ){ 
			$iva_bh_date_lng = $formdata['iva_bh_date_lng'];
		}else{
			$iva_bh_date_lng = '';
		}
	
		if( isset( $formdata['iva_today_text'] ) && $formdata['iva_today_text']!='' ){ 
			$iva_today_text = $formdata['iva_today_text'];
		}
		if( isset( $formdata['iva_seemore_text'] ) && $formdata['iva_seemore_text']!='' ){ 
			$iva_seemore_text = $formdata['iva_seemore_text'];
		}
		
		$iva_bh_settings =  array( 
			'iva_today_text'	 => $iva_today_text,
			'iva_seemore_text' 	 => $iva_seemore_text, 
			'iva_bh_time_format' => $iva_bh_time_format,
			'iva_bh_date_format' => $iva_bh_date_format,
			'iva_bh_date_lng'	 => $iva_bh_date_lng
		);
		foreach( $iva_bh_settings as $key => $value ){
			if(isset( $value )){
				update_option( $key,$value);
			}
		}
	
		// Holidays
		if( isset( $formdata['iva_bh_hd_name'] ) && $formdata['iva_bh_hd_name']!=''){
			$iva_bh_holidays = array();
			for ( $i = 0; $i <= count( $formdata['iva_bh_hd_name'] ); $i++ ){
					if ( !empty( $formdata['iva_bh_hd_name'][$i] ) &&
					 !empty( $formdata['iva_bh_hd_start'][$i] ) && 
					 !empty( $formdata['iva_bh_hd_end'][$i] ) ||
					 !empty( $formdata['iva_bh_hd_desc'][$i] )||
					 !empty( $formdata['iva_bh_hd_desc_disable'][$i] )
					){
					$iva_bh_hd_name 		= isset( $formdata['iva_bh_hd_name'][$i] )? stripslashes( $formdata['iva_bh_hd_name'][$i] ):'';
					$iva_bh_hd_start 		= isset( $formdata['iva_bh_hd_start'][$i] ) ? strtotime( $formdata['iva_bh_hd_start'][$i] ):'';
					$iva_bh_hd_end 			= isset( $formdata['iva_bh_hd_end'][$i] ) ? strtotime( $formdata['iva_bh_hd_end'][$i] ):'';
					$iva_bh_hd_desc 		= isset( $formdata['iva_bh_hd_desc'][$i] )? stripslashes( $formdata['iva_bh_hd_desc'][$i] ):'';
					$iva_bh_hd_desc_disable = isset( $formdata['iva_bh_hd_desc_disable'][$i] )? $formdata['iva_bh_hd_desc_disable'][$i]:'';
					
					$iva_bh_holidays[]  =  array(
						'name'  		=> $iva_bh_hd_name,
						'start'  		=> $iva_bh_hd_start,
						'end'  			=> $iva_bh_hd_end,
						'desc'  		=> $iva_bh_hd_desc,
						'desc_disable'  => $iva_bh_hd_desc_disable,					
					);
				}	
			}
			if( $iva_bh_holidays ){
				update_option( 'iva_bh_holidays', json_encode( $iva_bh_holidays ) );
			}
		}
		$response = '<div id="iva_bh_msg" class="updated notice success is-dismissible clearfix"><p>'.__('Settings updated successfully','aivah_businesshours').'</p><button class="notice-dismiss" type="button"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
		echo $response;
		exit;
	}
	
	/**
	 * function iva_bh_plugin_data()
	 * fetching plugin data
	 */
	function iva_bh_plugin_data(){
		global $wpdb;
		$iva_bh_plugin_data = get_plugin_data( __FILE__ );
		return $iva_bh_plugin_data;
	}
	
	/**
	 * function iva_bh_page()
	 * plugin dashboard shows business hours pro list and instructions
	 */
	function iva_bh_page(){
		global $wpdb;
		
		$iva_bh_plugin_data = iva_bh_plugin_data();
		echo '<div class="wrap about-wrap">
					<h1>'.__('Welcome to Business Hours Pro Plugin','').'</h1>
					<div class="about-text">'.__('The powerful business hours pro WordPress Plugin suitable for any business globally.','iva_business_hours').'</div>
					<div class="iva-bh-plugin_thumbnail"><img src="'.plugin_dir_url( __FILE__ ).'/assets/images/plugin-thumbnail.png" alt="Thumbnail"/><span>'.__('Version','iva_business_hours').$iva_bh_plugin_data['Version'].'</span></div>
			</div>';
		echo '<hr>';	
		echo '<div class="bHrs-mainwrap">';
	
		$sql = "SELECT * FROM $wpdb->iva_businesshours" ;
		$output = '';
		
		if ( $results = $wpdb->get_results( $sql )) {
			echo '<div class="businessHrs-title sub-heading"><div class="bHrs_icon dark"><span class="ivaIcon "><i class="aicon_hourg"></i></span></div><h2>'.__('Business Hours List', 'iva_business_hours').'</h2>';
					
			$output .= '<div class="bHrs_list">';
			$output .= '<div id="iva_bh_message"></div>';
			
			$output .= '<form method="post" name="iva_bhrslist" id="iva_bhrslist" action="">';
			$output .= '<table class="widefat fancytable" width="500">';
			
			$output .= '<thead><tr><th>'.__('ID','iva_business_hours').'</th>';
			$output .= '<th>'.__('Name','iva_business_hours').'</th>';
			$output .= '<th>'.__('Shortcode','iva_business_hours').'</th>';
			$output .= '<th colspan="2">'.__('Actions','iva_business_hours').'</th>';
			$output .= '</tr></thead>';
			
			$output .= '<tbody>';
			foreach ( $results as $value ) {
			
				$iva_bh_shortcode = strtolower( trim( str_replace('-', ' ', $value->shortcode ) ) ); // Replaces all spaces with hyphens.
				//$iva_bh_shortcode = strtolower( $value->shortcode ); // Replaces all spaces with hyphens.
			
				$output .= '<tr valign="top">';
				$output .= '<td>'.$value->id.'</td>';
				$output .= '<td>'.$value->title.'</td>';
				$output .= '<td>'.stripslashes( $value->shortcode ).'</td>';
				$output .= '<td><input type="hidden" value="edit_ivbh_data" name="edit_ivbh_data"/><a href="'.admin_url('admin.php?page=bhrs-operations&id='.$value->id.'').'" class="button green-button"><i class="aicon_edit"></i>'.__('Edit','iva_business_hours').'</a>';
				$output .= '<a id="delete_bhrs" class="delete_bhrs button red-button"  data_ivbh_url = "'.admin_url( 'admin.php?page=iva-business-hours-pro').'"  data_iva_bhid="'.$value->id.'"><i class="aicon_delete"></i>'.__('Delete','iva_business_hours').'</a></td>';
				$output .= '</tr>';
			}
			$output .= '</tbody></table>';
			
			$output .='</form>';
			$output .='</div>';
			$output .= '</div>';
			
			echo $output;
		}

		echo '<div class="btnwrap">';
		echo '<a data_ivbh_url = "'.admin_url( 'admin.php?page=bhrs-operations').'" class="add_bhrs button button-hero blue-button">'.__('Create Hours','iva_business_hours').'</a>';
		echo '</div>';

		// Documentation Wrap
		echo '<div class="businessHrs-title sub-heading"><div class="bHrs_icon orange"><span class="ivaIcon "><i class=" aicon_eye"></i></span></div><h2>' . __('Documentation and Setup', 'iva_business_hours') . '</h2>'; 
		echo '<p>' . __('Below are the instructions on how to install the plugin and start using it.', 'iva_business_hours') . '</p>'; 
		echo '<ol>';
		echo '<li>' . __('Upload `iva-business-hours-pro` directory to the `/wp-content/plugins/` directory', 'iva_business_hours') . '</li>'; 
		echo '<li>' . __('Activate the plugin through the "Plugins" menu in WordPress directory', 'iva_business_hours') . '</li>';
		echo '<li>' . __('Add shortcodes in your posts e.g: [iva_bhrs name="Office Timings" width="300" title="on" current_day_color="#ff8800" grouping_hrs="on" single_day="on" openclose_text="on" close_days="on" toggle_enable="on"  singleday_disable="on"]', 'iva_business_hours') . '</li>';
		echo '<li>' . __('Add widget in desired widget area.', 'iva_business_hours') . "</li>";
		echo '<li>' . __('If you wish to change the layout and styling for business hours display edit iva-bh-front.css file located in the iva-business-hours-pro/assets/css/', 'iva_business_hours') . '</li>';
		echo '<li>' . __('More options coming soon like import/export for the business hours.', 'iva_business_hours') . '</li>';
		echo '</ol>';
		echo '</div>';
		
		echo '<div class="bHrs_copyright"><p>&copy;'.__('All rights reserved','iva_business_hours').' - www.aivahthemes.com - '.$iva_bh_plugin_data['Name'].'&nbsp;<span>'.$iva_bh_plugin_data['Version'].'</span></p></div>';
		
		echo '<div  class=""><a id="iva_bh_update_plugin" class="button green-button button-hero iva_bh_update_plugin md-trigger" data-modal="iva_bh_update_plugin_dialog">'.__('Manual Update Plugin','iva_business_hours').'</a></div>';
		
		
		// Update Plugin Dialog Form
		echo '<div id="iva_bh_update_plugin_dialog" class="iva_bh_update_plugin_dialog md-modal md-effect-1">';
		
		echo '<div class="md-content">';
		echo '<div>';
		echo '<h3>'.__('Update Business Hours Pro','iva_business_hours').'</h3>';
		
		echo '<p>'.__('Select a file provided within the package "iva-business-hours-pro.zip" If you update the plugin The files will be overwriten.','iva_business_hours').'</p>';
		echo '<p>'.__('Choose the update file:','iva_business_hours').'</p>';
		echo '<form action="'.admin_url("admin-ajax.php").'" enctype="multipart/form-data" method="post">';
		echo '<input type="hidden" name="action" value="iva_bh_ajax_action">';
		echo '<p><input type="file" name="iva_bh_update_file" class="input_update_slider"></p>';
		echo '<p><input type="submit" class="button green-button button-hero subbtn" value="'.__('Update Plugin','iva_business_hours').'"></p>';
		echo '</form>';
		echo '<p><a class="button red-button md-close">'.__('Close me!','iva_business_hours').'</a></p>';
		echo '</div>';
		echo '</div>';//iva_bh_update_plugin_dialog
		echo '</div>';//md-content
		echo '<div class="md-overlay"></div>';
		
		echo '</div>';//bHrs-mainwrap
	}
	
	/**
	 * function iva_bh_operations()
	 * here adding and updating business hours pro operations goes here
	 */
	function iva_bh_operations() {
		
		
		global $wpdb;
		
		$iva_bh_title = $iva_bh_day_open = $iva_bh_day_close = $iva_desc_prefix_checked =  $iva_desc_enable_checked = $iva_todaydate_checked = $iva_grouping_enable_checked = $iva_toggle_enable_checked = $iva_closedays_checked = $iva_oc_text_checked = $iva_singleday_checked = $iva_algncenter_hrs_checked =$iva_singleday_disable_checked ='';
		
		$iva_bh_id    = isset( $_GET['id'] ) ?  esc_html( $_GET['id'] ) :'';
	
		echo '<div class="bHrs-mainwrap">';
		
		if( $iva_bh_id  !=''){
			
			//Fetching Business hours pro data 
			
			$iva_bh_sql 	= "SELECT * FROM $wpdb->iva_businesshours where id='".$iva_bh_id."'" ;
			$iva_bh_results = $wpdb->get_results( $iva_bh_sql,ARRAY_A ); 
		
			$iva_bh_plugin_data = iva_bh_plugin_data();

			echo '<div class="businessHrs-title main-heading"><div class="bHrs_icon green businessHrs-logo "><span class="ivaIcon"></span></div><h2>'.$iva_bh_plugin_data['Name'].' - <span>'.$iva_bh_plugin_data['Version'].'</h2></div>';

			echo '<div id="update_success_mg"></div>';
			echo '<form method="post" id="iva_bh_update_form" class="iva_bh_update_form" name="iva_bh_update_form" action="#">';
			
			echo '<div class="bHrs_wrap">';
			echo '<div class="bHrs-left">';
			echo '<div class="businessHrs-title sub-heading"><div class="bHrs_icon blue"><span class="ivaIcon "><i class="aicon_edit"></i></span></div><h2>'.__('Business Hours', 'iva_business_hours').'</h2>';
			echo '<p>&bull; '.__('Additional text field will be displayed beside the time if the field contains any text.','iva_business_hours').'</p>';
			echo '<p>&bull; '.__('To create a closed day or closed period within a day, leave both the start time and end time hours blank include text fields.','iva_business_hours').'</p>';
			echo '<table id="iva_bh_update_table" class="widefat fancytable edithours">';
			
			if(!empty($iva_bh_results)){

			foreach ( $iva_bh_results as $iva_bh_data ) {
				
				$iva_bh_title 		= $iva_bh_data['title'];
				$iva_bh_alias		= $iva_bh_data['alias'];
				$iva_time_separator = $iva_bh_data['timeseparator'];
				$iva_bh_shortcode 	= $iva_bh_data['shortcode'];
				$iva_closed_text	= $iva_bh_data['closedtext'];
				$iva_open_text		= $iva_bh_data['opentext'];
				$iva_bh_desc 		= $iva_bh_data['description'];
				$iva_today_date		= $iva_bh_data['todaydate'];
				$iva_desc_prefix	= $iva_bh_data['descriptionprefix'];
				$iva_desc_enable	= $iva_bh_data['descriptionenable'];
				
				
				$iva_grouping_enable 	= isset( $iva_bh_data['grouping_enable'] )? $iva_bh_data['grouping_enable']:'';
				$iva_closed_bg_color 	= isset( $iva_bh_data['closed_bg_color'])? $iva_bh_data['closed_bg_color']:'';
				$iva_open_bg_color 		= isset( $iva_bh_data['open_bg_color'])? $iva_bh_data['open_bg_color']:'';
				$iva_current_day_color  = isset( $iva_bh_data['current_day_color'])? $iva_bh_data['current_day_color']:'';
				$iva_hrs_enable		 	= isset( $iva_bh_data['toggle_enable'] )?$iva_bh_data['toggle_enable']:'';
				$iva_closedays_hide		= isset( $iva_bh_data['closedays_hide'] )?$iva_bh_data['closedays_hide']:'';
				$iva_oc_text_hide		= isset( $iva_bh_data['oc_text_hide'] )?$iva_bh_data['oc_text_hide']:'';
				$iva_singleday_show		= isset( $iva_bh_data['singleday_show'] )?$iva_bh_data['singleday_show']:'';
				$iva_algncenter_hrs		= isset( $iva_bh_data['algncenter_hrs'] )?$iva_bh_data['algncenter_hrs']:'';
				$iva_singleday_disable = isset( $iva_bh_data['singleday_disable'] )?$iva_bh_data['singleday_disable']:'';
				
				$iva_bh_shortcode = stripslashes( $iva_bh_shortcode );
				
				if( $iva_grouping_enable == 'on' )	{	$iva_grouping_enable_checked = "checked=checked"; }  
				if( $iva_desc_prefix == 'on' )	{	$iva_desc_prefix_checked = "checked=checked"; }  
				if( $iva_desc_enable == 'on' )	{	$iva_desc_enable_checked = "checked=checked"; }  
				if( $iva_today_date == 'on' )	{	$iva_todaydate_checked = "checked=checked"; }  
				if( $iva_hrs_enable == 'on' )	{   $iva_toggle_enable_checked = "checked=checked"; }
				if( $iva_closedays_hide == 'on' )	{   $iva_closedays_checked = "checked=checked"; }
				if( $iva_oc_text_hide 	== 'on' )	{   $iva_oc_text_checked = "checked=checked"; }
				if( $iva_singleday_show == 'on' )	{   $iva_singleday_checked = "checked=checked"; }
				if( $iva_algncenter_hrs == 'on' )	{   $iva_algncenter_hrs_checked = "checked=checked"; }
				if( $iva_singleday_disable == 'on' )	{   $iva_singleday_disable_checked = "checked=checked"; }
				
				
				
				echo '<thead><tr>';
				echo '<th><strong>'.__( 'Weekday', 'iva_business_hours' ).'</strong></th>';
				echo '<th><strong>'.__( 'Start Time', 'iva_business_hours' ).'</strong></th>';
				echo '<th><strong>'.__( 'Start Text', 'iva_business_hours' ).'</strong></th>';
				echo '<th><strong>'.__( 'End Time', 'iva_business_hours' ).'</strong></th>';
				echo '<th><strong>'.__( 'End Text', 'iva_business_hours' ).'</strong></th>';
				echo '<th><strong>'.__( 'Add / Remove Period', 'iva_business_hours' ).'</strong></th>';
				echo '</tr></thead>';
					
				echo '<tbody id="the-list">';
				
				echo '<tr id="iva_business_row" style="display: none;">';
				echo '<td>&nbsp;</td>';
				echo '<td><span class="clockicon"><i class="aicon_clock"></i></span><input type="text" class="iva_bh_input" name="iva_bh[day][period][open]" value="" style="width:90px;" id="iva_bh[day][period][open]"></td>';
				echo '<td><input type="text" name="iva_bh[day][period][starttime]" value="" class="iva_bh_latetime" id="iva_bh[day][period][starttime]"></td>';
				echo '<td><span class="clockicon"><i class="aicon_clock"></i></span><input type="text" class="iva_bh_input" name="iva_bh[day][period][close]" value="" style="width:90px;" id="iva_bh[day][period][close]"></td>';
				echo '<td><input type="text" name="iva_bh[day][period][latetime]" value="" class="iva_bh_latetime" id="iva_bh[day][period][latetime]"></td>';
				echo '<td><span class="button green-button iva_bh-add-period"><span><i class=" aicon_add"></i></span></span>';
				echo '<span class="button red-button iva_bh-remove-period"><span><i class="aicon_delete"></i></span></span></td>';
				echo '</tr>';
				
				$j = 0;
				
				$week_day_key = '';
				$iva_bh_time_format = get_option('iva_bh_time_format')?get_option('iva_bh_time_format'):'H:i';
				
				foreach ( iva_bh_getWeekdays() as $key => $day ) {
					
				// if( isset( $iva_bh_data ) ){

					$week_day_key = 'weekday'.$key;
				
					$iva_bh_day = json_decode( $iva_bh_data[$week_day_key] );
			
					foreach( $iva_bh_day as $key => $value ){
					
						$iva_row_count =  count( $value );
						
						foreach( $value as $time){
						
							$late_time  = isset( $time->latetime ) ? $time->latetime:'';
							$start_time = isset( $time->starttime ) ? $time->starttime:'';
							
							if( $j == 0 ) { 
								echo '<tr id="iva_bh-day-'.$key.'" class="iva_bh-day-'.$key.'" data-count="'.$iva_row_count.'">';
								echo '<td>&nbsp;'.$day.'</td>';
								echo '<td><span class="clockicon"><i class="aicon_clock"></i></span><input type="text" name="iva_bh['.$key.']['.$j.'][open]" value="'.iva_bh_formatTime( $time->open,$iva_bh_time_format ).'" style="width:90px;" class="iva_bh_timepicker iva_bh_input" id="iva_bh['.$key.']['.$j.'][open]"></td>';
								echo '<td><input type="text" name="iva_bh['.$key.']['.$j.'][starttime]" value="'.$start_time.'" class="iva_bh_starttime" id="iva_bh['.$key.']['.$j.'][starttime]"></td>';
								echo '<td><span class="clockicon"><i class="aicon_clock"></i></span><input type="text" name="iva_bh['.$key.']['.$j.'][close]" value="'.iva_bh_formatTime( $time->close,$iva_bh_time_format ).'" style="width:90px;" class="iva_bh_timepicker iva_bh_input" id="iva_bh['.$key.']['.$j.'][close]"></td>';
								echo '<td><input type="text" name="iva_bh['.$key.']['.$j.'][latetime]" value="'.$late_time.'" class="iva_bh_latetime" id="iva_bh['.$key.']['.$j.'][latetime]"></td>';
								echo '<td>';
								echo '<span class="button green-button iva_bh-add-period" data-day="'.$key.'"><span><i class=" aicon_add"></i></span></span></td>';
								echo '</tr>';
							}
							if( $j != 0 ) { 
							
							
								echo '<tr id="iva_bh-day-'.$key.'" class="iva_bh-day-'.$key.'" data-count="'.$iva_row_count.'">';
								echo '<td>&nbsp;</td>';
								echo '<td><span class="clockicon"><i class="aicon_clock"></i></span><input type="text" name="iva_bh['.$key.']['.$j.'][open]" value="'.iva_bh_formatTime( $time->open,$iva_bh_time_format ).'" style="width:90px;" class="iva_bh_timepicker iva_bh_input" id="iva_bh['.$key.']['.$j.'][open]"></td>';
								echo '<td><input type="text" name="iva_bh['.$key.']['.$j.'][starttime]" value="'.$start_time.'" class="iva_bh_starttime" id="iva_bh['.$key.']['.$j.'][starttime]"></td>';
								echo '<td><span class="clockicon"><i class="aicon_clock"></i></span><input type="text" name="iva_bh['.$key.']['.$j.'][close]" value="'.iva_bh_formatTime( $time->close,$iva_bh_time_format ).'" style="width:90px;" class="iva_bh_timepicker iva_bh_input" id="iva_bh['.$key.']['.$j.'][close]"></td>';
								echo '<td><input type="text" name="iva_bh['.$key.']['.$j.'][latetime]" value="'.$late_time.'" class="iva_bh_latetime" id="iva_bh['.$key.']['.$j.'][latetime]"></td>';
								echo '<td>';
								echo '<span class="button green-button iva_bh-add-period" data-day="'.$key.'"><span><i class=" aicon_add"></i></span></span>';
								echo '<span class="button red-button iva_bh-remove-period"><span><i class="aicon_delete"></i></span></span></td>';
								echo '</tr>';
							}
							$j++;
							
							if( $iva_row_count == $j ){
								$j=0;
							}
						}
					}
				// }
				}
				echo '</tbody></table>';
				echo '</div>';

				// Open Image
				echo '<div class="one_half">';
				echo '<div class="businessHrs-title sub-heading clearfix"><div class="bHrs_icon green"><span class="ivaIcon "><i class="aicon_close"></i></span></div><h2>'.__('Opening Image:', 'iva_business_hours').'</h2>';
				echo '<p>'.__('Upload the image you wish to display as we\'are open on the hours display.','iva_business_hours').'</p>';	
				$iva_bhrs_open_image = isset( $iva_bh_data['open_image'] )? stripslashes ( $iva_bh_data['open_image'] ) : ''; 
				echo '<input name="iva_open_image" id="iva_open_hidden_image"  type="hidden" class="iva_oc_upload_image" value="'.$iva_bhrs_open_image.'" />';
				echo '<input name="iva_open_image" id="iva_open_image" class="iva_oc_upload_btn button blue-button" type="button" value="'.__('Upload Image','iva_business_hours').'" />';
			
				echo '<a href="#" class="iva_oc_image_remove button red-button">remove</a>'; 
				echo '<div id="iva_oc_preview_image-iva_open_image" class="iva-oc-screenshot">';
				if ( $iva_bhrs_open_image !=''){
					$image_attributes = wp_get_attachment_image_src( iva_bhrs_get_attachment_id_from_src( $iva_bhrs_open_image ));
				
					if( $image_attributes !=''){
						echo '<img src="'.$image_attributes[0].'"  class="iva_oc_preview_image" alt="" />';
					}else{
						echo '<img src="'.$iva_bhrs_open_image.'"  class="iva_oc_preview_image" alt="" />';
					}
				}
				echo '</div>'; //iva-oc-screenshot
				echo '</div>'; //businessHrs-title
				echo '</div>'; //one_half

				// Close Image
				echo '<div class="one_half last">';
				echo '<div class="businessHrs-title sub-heading clearfix"><div class="bHrs_icon red"><span class="ivaIcon "><i class="aicon_open"></i></span></div><h2>'.__('Closing Image:', 'iva_business_hours').'</h2>';
				echo '<p>'.__('Upload the image you wish to display as we\'are closed once the shop timings are about closed','iva_business_hours').'</p>';
				$iva_bhrs_close_image	= isset( $iva_bh_data['close_image'] )? stripslashes ( $iva_bh_data['close_image'] ):''; 
				echo '<input name="iva_close_image" id="iva_close_hidden_image"  type="hidden" class="iva_oc_upload_image" value="'.$iva_bhrs_close_image.'" />';
				echo '<input name="iva_close_image" id="iva_close_image"  class="iva_oc_upload_btn button blue-button" type="button" value="'.__('Upload Image','iva_business_hours').'" />';
				echo '<a href="#" class="iva_oc_image_remove button red-button">remove</a>';
				echo '<div id="iva_oc_preview_image-iva_close_image" class="iva-oc-screenshot">';
				if ( $iva_bhrs_close_image !=''){
					$image_attributes = wp_get_attachment_image_src( iva_bhrs_get_attachment_id_from_src( $iva_bhrs_close_image ));
				
					if( $image_attributes !=''){
						echo '<img src="'.$image_attributes[0].'"  class="iva_oc_preview_image" alt="" />';
					}else{
						echo '<img src="'.$iva_bhrs_close_image.'"  class="iva_oc_preview_image" alt="" />';
					}
				}
				echo '</div>'; //iva-oc-screenshot
				echo '</div>'; //businessHrs-title
				echo '</div><div class="clear"></div>';	// clear column floats
				echo '</div>';// bHrs-left
		
				echo '<div class="bHrs-right">';
				echo '<div class="general-wrapper bhrs-settings">';
				echo '<div class="businessHrs-title sidebar-heading"><div class="bHrs_icon blue"><span class="ivaIcon "><i class="aicon_setings"></i></div><h2>'.__('Shortcode Settings','iva_business_hours').'</h2></div>';
				echo '<div class="general-input clearfix">';
				echo '<div class="one_half">';
				echo '<div class="bhs-title">'.__('Shortcode Title:', 'iva_business_hours').'</div><div class="bhs-desc"><input id="" type="text" class="bhrs-title-input" name="iva_bh_title" value="'.$iva_bh_title.'"><details>'.__('Enter the title for shortcode.','iva_business_hours').'</details></div><br />';
				echo '<div class="bhs-title">'.__('Shortcode Alias:', 'iva_business_hours').'</div><div class="bhs-desc"><input id="" type="text" class="bhrs-edit-alias" name="iva_bh_alias" value="'.trim( str_replace('-', ' ', $iva_bh_alias ) ).'"><details>'.__('Slug and the shortcode ,Do not use special characters .','iva_business_hours').'</details></div><br />';
				echo '<div class="bhs-title">'.__('Generated Shortcode:', 'iva_business_hours').'</div><div class="bhs-desc"><input id="" type="text"  name="iva_bh_shortcode" class="bhrs-edit-shortcode"  readonly="readonly"  value=\''.$iva_bh_shortcode.'\'><details>'.__('Hours Shortcode.','iva_business_hours').'</details></div><br />';
				echo '<div class="bhs-title">'.__('Description:', 'iva_business_hours').'</div><div class="bhs-desc"><textarea rows="5" cols="10" class="" name="iva_description">'.$iva_bh_desc.'</textarea><details class="tarea-align">'.__('Additional info which displays after / before the business hours.','iva_business_hours').'</details></div><br />';
				echo '<div class="bhs-title">'.__('Time Separator:', 'iva_business_hours').'</div><div class="bhs-desc"><input id="" type="text" class="" name="iva_time_separator" value="'.$iva_time_separator.'"><details>'.__('Time Separator ( eg: 09:00 <strong> - </strong> 06:00 ) add one space before and after your separator symbol.','iva_business_hours').'</details></div><br />';
				echo '<div class="bhs-title">'.__('Closed Text:', 'iva_business_hours').'</div><div class="bhs-desc"><input id="" type="text" class="" name="iva_closed_text" value="'.$iva_closed_text.'"><details>'.__('Closed text if specific day is closed.','iva_business_hours').'</details></div><br />';
				echo '<div class="bhs-title">'.__('Open Text:', 'iva_business_hours').'</div><div class="bhs-desc"><input id="" type="text" class="" name="iva_open_text" value="'.$iva_open_text.'"><details>'.__('Closed text if specific day is open.','iva_business_hours').'</details></div>';
				echo '</div>';
				echo '<div class="one_half last">';
				echo '<div class="bhs-title">'.__('Description Poistion:', 'iva_business_hours').'</div><div class="bhs-desc bhs-check"><input id="desc_prefix" type="checkbox" class="" name="iva_desc_prefix" value="on" '.$iva_desc_prefix_checked.'><label for="desc_prefix">'.__('Check this if you wish to display description above the hours.','iva_business_hours').'</label></div><br />';
				echo '<div class="bhs-title">'.__('Description Hide:', 'iva_business_hours').'</div><div class="bhs-desc bhs-check"><input id="desc_check" type="checkbox" class="" name="iva_desc_enable" value="on" '.$iva_desc_enable_checked.'><label for="desc_check">'.__('Check this if you wish to hide the description( Additional info).','iva_business_hours').'</label></div><br />';
				echo '<div class="bhs-title">'.__('Grouping Hours:', 'iva_business_hours').'</div><div class="bhs-desc bhs-check"><input id="grouping_enable" type="checkbox" class="" name="iva_grouping_enable" value="on" '.$iva_grouping_enable_checked.'><label for="grouping_enable">'.__('Check this if you wish to group the hours display if the timings are same.','iva_business_hours').'</details></div><br />';
				echo '<div class="bhs-title">'.__('Toggle Hours:', 'iva_business_hours').'</div><div class="bhs-desc bhs-check"><input id="toggle_enable" type="checkbox" class="" name="iva_toggle_enable" value="on" '.$iva_toggle_enable_checked.'><label for="toggle_enable">'.__('Check this if you wish to hide all hours and display only current day and add toggle option to see remaining days.','iva_business_hours').'</label></div><br />';
				echo '<div class="bhs-title">'.__('Current Day:', 'iva_business_hours').'</div><div class="bhs-desc bhs-check"><input id="todaydate_check" type="checkbox" class="" name="iva_today_date" value="on" '.$iva_todaydate_checked.'><label for="todaydate_check">'.__('Check this if you wish to highlight current day in hours display.','iva_business_hours').'</label></div><br />';
				echo '<div class="bhs-title">'.__('Current Day Color:', 'iva_business_hours').'</div><div class="bhs-desc"><input id="current_day_color" type="text" class="" name="iva_current_day_color" value="'.$iva_current_day_color.'"><details>'.__('Enter the color code to highlight the current day.','iva_business_hours').'</details></div><br />';
				echo '<div class="bhs-title">'.__('Closed BG color:', 'iva_business_hours').'</div><div class="bhs-desc"><input id="closed_bg_color" type="text" class="" name="iva_closed_bg_color" value="'.$iva_closed_bg_color.'"><details>'.__('Enter the color code for the closed text background.Make sure you select dark colors on the text color is white by default.','iva_business_hours').'</details></div><br />';
				
				echo '<div class="bhs-title">'.__('Open BG color:', 'iva_business_hours').'</div><div class="bhs-desc"><input id="open_bg_color" type="text" class="" name="iva_open_bg_color" value="'.$iva_open_bg_color.'"><details>'.__('Enter the color code for the open text background.Make sure you select dark colors on the text color is white by default.','iva_business_hours').'</details></div><br />';
				
				echo '<div class="bhs-title">'.__('Disable Close Days:', 'iva_business_hours').'</div><div class="bhs-desc bhs-check"><input id="closedays_hide" type="checkbox" class="" name="iva_closedays_hide" value="on" '.$iva_closedays_checked.'><label for="closedays_hide">'.__('Check this if you wish to hide close days .','iva_business_hours').'</label></div><br />';
				echo '<div class="bhs-title">'.__('Disable OpenClose Text:', 'iva_business_hours').'</div><div class="bhs-desc bhs-check"><input id="oc_text_hide" type="checkbox" class="" name="iva_oc_text_hide" value="on" '.$iva_oc_text_checked.'><label for="oc_text_hide">'.__('Check this if you wish to hide open/close text.','iva_business_hours').'</label></div><br />';
				echo '<div class="bhs-title">'.__('Single Day:', 'iva_business_hours').'</div><div class="bhs-desc bhs-check"><input id="singleday_show" type="checkbox" class="" name="iva_singleday_show" value="on" '.$iva_singleday_checked.'><label for="singleday_show">'.__('Check this if you wish to display single day.','iva_business_hours').'</label></div><br />';
				echo '<div class="bhs-title">'.__('Align hours centered:', 'iva_business_hours').'</div><div class="bhs-desc bhs-check"><input id="algncenter_hrs" type="checkbox" class="" name="iva_algncenter_hrs" value="on" '.$iva_algncenter_hrs_checked.'><label for="algncenter_hrs">'.__('Check this if you wish to display hours aligned center','iva_business_hours').'</label></div><br />';
				echo '<div class="bhs-title">'.__('Disable single day hours:', 'iva_business_hours').'</div><div class="bhs-desc bhs-check"><input id="singleday_disable" type="checkbox" class="" name="iva_singleday_disable" value="on" '.$iva_singleday_disable_checked.'><label for="singleday_disable">'.__('Check this if you wish to disable single day hours','iva_business_hours').'</label></div><br />';
				
				echo '</div>';
				echo '</div>';//general-input				
				echo '</div>';//general-wrapper
				echo '</div>';//bHrs-right

				echo '<div class="clear"></div>';	

				echo '<div class="iva_bhrs_notes">';
				echo '<a data_ivbh_url = "'.admin_url( 'admin.php?page=bhrs-operations&id='.$iva_bh_id ).'" data_iva_bhid="'.$iva_bh_id.'"id="update_bhrs" class="update_bhrs button button-hero blue-button"><i class="aicon_edit"></i>'.__('Update','iva_business_hours').'</a>';
				echo '<a data_ivbh_url = "'.admin_url( 'admin.php?page=iva-business-hours-pro').'" class="iva_bh_close button button-hero red-button"><i class="aicon_cancel"></i>'.__('Cancel','iva_business_hours').'</a>';
				echo '</div>';//.iva_bhrs_notes
				echo '</br>';

				echo '</div>';// bHrs_wrap
				echo '</form>';
			}	// Update Record
			}	
		}else{
			// Creating Business hours pro
			$iva_bh_plugin_data = iva_bh_plugin_data();
			echo '<div class="businessHrs-title main-heading"><div class="bHrs_icon green businessHrs-logo "><span class="ivaIcon"></span></div><h2>'.$iva_bh_plugin_data['Name'].' - <span>'.$iva_bh_plugin_data['Version'].'</h2></div>';
			echo '<div id="create_success_mg"></div>';
			echo '<form method="post" id="iva_bh_create_form" class="iva_bh_create_form" name="iva_bh_create_form" action="#">';
			
			echo '<div class="bHrs_wrap">';
			echo '<div class="bHrs-left">';
			echo '<div class="businessHrs-title sub-heading"><div class="bHrs_icon blue"><span class="ivaIcon "><i class="aicon_edit"></i></span></div><h2>'.__('Business Hours', 'iva_business_hours').'</h2>';
			echo '<p>&bull; '.__('Additional text field will be displayed beside the time if the field contains any text.','iva_business_hours').'</p>';
			echo '<p>&bull; '.__('To create a closed day or closed period within a day, leave both the start time and end time hours blank.','iva_business_hours').'</p>';
			echo '<table id="iva_bh_create_table" class="widefat fancytable createhours">';
			
			echo '<thead><tr>';
			echo '<th><strong>'.__( 'Weekday', 'iva_business_hours' ).'</strong></th>';
			echo '<th><strong>'.__( 'Start Time', 'iva_business_hours' ).'</strong></th>';
			echo '<th><strong>'.__( 'Start Text', 'iva_business_hours' ).'</strong></th>';
			echo '<th><strong>'.__( 'End Time', 'iva_business_hours' ).'</strong></th>';
			echo '<th><strong>'.__( 'End Text', 'iva_business_hours' ).'</strong></th>';
			echo '<th><strong>'.__( 'Add / Remove Period', 'iva_business_hours' ).'</strong></th>';
			echo '</tr></thead>';
			
			
			echo '<tbody id="the-list">';
			echo '<tr id="iva_business_row" style="display: none;" >';
			echo '<td>&nbsp;</td>';
			echo '<td><span class="clockicon"><i class="aicon_clock"></i></span><input type="text" class="iva_bh_input" name="iva_bh[day][period][open]" value=""  style="width:90px;" id="iva_bh[day][period][open]"></td>';
			echo '<td><input type="text" name="iva_bh[day][period][starttime]" value="" id="iva_bh[day][period][starttime]" class="iva_bh_starttime"></td>';
			echo '<td><span class="clockicon"><i class="aicon_clock"></i></span><input type="text" class="iva_bh_input" name="iva_bh[day][period][close]" value="" style="width:90px;" id="iva_bh[day][period][close]"></td>';
			echo '<td><input type="text" name="iva_bh[day][period][latetime]" value="" id="iva_bh[day][period][latetime]" class="iva_bh_latetime"></td>';
			echo '<td><span class="button green-button iva_bh-add-period"><span><i class="aicon_add"></i></span></span>';
			echo '<span class="button red-button iva_bh-remove-period"><span><i class="aicon_delete"></i></span></span></td>';
			echo '</tr>';

			foreach ( iva_bh_getWeekdays() as $key => $day ) {
				echo '<tr id="iva_bh-day-'.$key.'" class="iva_bh-day-'.$key.'" >';
				echo '<td>&nbsp;'.$day.'</td>';
				echo '<td><span class="clockicon"><i class="aicon_clock"></i></span><input type="text" name="iva_bh['.$key.'][0][open]" value="" style="width:90px;" class="iva_bh_timepicker iva_bh_input" id="iva_bh['.$key.'][0][open]"></td>';
				echo '<td><input type="text" name="iva_bh['.$key.'][0][starttime]" value="" class="iva_bh_starttime" id="iva_bh['.$key.'][0][starttime]"></td>';
				echo '<td><span class="clockicon"><i class="aicon_clock"></i></span><input type="text" name="iva_bh['.$key.'][0][close]" value="" style="width:90px;" class="iva_bh_timepicker iva_bh_input" id="iva_bh['.$key.'][0][close]"></td>';
				echo '<td><input type="text" name="iva_bh['.$key.'][0][latetime]" value="" class="iva_bh_latetime" id="iva_bh['.$key.'][0][latetime]"></td>';
				echo '<td><span class="button green-button iva_bh-add-period" data-day="'.$key.'"><span><i class=" aicon_add"></i></span></span></td>';
				echo '</tr>';
			} 
			echo '</tbody></table>';
			echo '</div>';
			
			// Open Image
			echo '<div class="one_half">';
			echo '<div class="businessHrs-title sub-heading clearfix"><div class="bHrs_icon green"><span class="ivaIcon "><i class="aicon_close"></i></span></div><h2>'.__('Opening Image:', 'iva_business_hours').'</h2>';
			echo '<p>'.__('Upload the image you wish to display as we\'are open on the hours display.','iva_business_hours').'</p>';	
			echo '<input name="iva_open_image" id="iva_open_hidden_image"  type="hidden" class="iva_oc_upload_image" />';
			echo '<input name="iva_open_image" id="iva_open_image"  class="iva_oc_upload_btn button blue-button" type="button" value="'.__('Upload Image','iva_business_hours').'" />';
			echo '<a href="#" class="iva_oc_image_remove button red-button">remove</a>'; 
			echo '<div id="iva_oc_preview_image-iva_open_image" class="iva-oc-screenshot">';
			echo '</div>'; //iva-oc-screenshot
			echo '</div>'; //businessHrs-title
			echo '</div>'; //one_half

			// Close Image
			echo '<div class="one_half last">';
			echo '<div class="businessHrs-title sub-heading clearfix"><div class="bHrs_icon red"><span class="ivaIcon "><i class="aicon_open"></i></span></div><h2>'.__('Closing Image:', 'iva_business_hours').'</h2>';
			echo '<p>'.__('Upload the image you wish to display as we\'are closed once the shop timings are about closed','iva_business_hours').'</p>';
			echo '<input name="iva_close_image" id="iva_close_hidden_image"  type="hidden" class="iva_oc_upload_image" />';
			echo '<input name="iva_close_image" id="iva_close_image"  class="iva_oc_upload_btn button blue-button" type="button" value="'.__('Upload Image','iva_business_hours').'" />';
			echo '<a href="#" class="iva_oc_image_remove button red-button">remove</a>'; 
			echo '<div id="iva_oc_preview_image-iva_close_image" class="iva-oc-screenshot">';
			echo '</div>'; //iva-oc-screenshot
			echo '</div>'; //businessHrs-title
			echo '</div>'; //one_half last;
			echo '<div class="clear"></div>';	// clear column floats
			echo '</div>';//bHrs-left
		
			echo '<div class="bHrs-right">';
			echo '<div class="general-wrapper bhrs-settings">';
			echo '<div class="businessHrs-title sidebar-heading"><div class="bHrs_icon blue"><span class="ivaIcon "><i class="aicon_setings"></i></div><h2>'.__('Shortcode Settings','iva_business_hours').'</h2></div>';
			echo '<div class="general-input clearfix">';
			echo '<div class="one_half">';
			echo '<div class="bhs-title">'.__('Shortcode Title:', 'iva_business_hours').'</div><div class="bhs-desc"><input id="" type="text" class="bhrs-title-input" name="iva_bh_title" value=""><details>'.__('Enter the title for shortcode.','iva_business_hours').'</details></div><br />';
			echo '<div class="bhs-title">'.__('Shortcode Alias:', 'iva_business_hours').'</div><div class="bhs-desc"><input id="" type="text" class="bhrs-alias" name="iva_bh_alias" value=""><details>'.__('Slug and the shortcode ,Do not use special characters .','iva_business_hours').'</details></div><br />';
			echo '<div class="bhs-title">'.__('Generated Shortcode:', 'iva_business_hours').'</div><div class="bhs-desc"><input id="" type="text"  name="iva_bh_shortcode" class="bhrs-shortcode"  readonly="readonly"  value=""><details>'.__('Hours Shortcode.','iva_business_hours').'</details></div><br />';
			echo '<div class="bhs-title">'.__('Description:', 'iva_business_hours').'</div><div class="bhs-desc"><textarea rows="5" cols="10" class="" name="iva_description"></textarea><details class="tarea-align">'.__('Additional info which displays after / before the business hours.','iva_business_hours').'</details></div><br />';
			echo '<div class="bhs-title">'.__('Time Separator:', 'iva_business_hours').'</div><div class="bhs-desc"><input id="" type="text" class="" name="iva_time_separator" value=""><details>'.__('Time Separator ( eg: 09:00 <strong> - </strong> 06:00 ) add one space before and after your separator symbol.','iva_business_hours').'</details></div><br />';
			echo '<div class="bhs-title">'.__('Closed Text:', 'iva_business_hours').'</div><div class="bhs-desc"><input id="" type="text" class="" name="iva_closed_text" value="Closed"><details>'.__('Closed text if specific day is closed.','iva_business_hours').'</details></div><br />';
			echo '<div class="bhs-title">'.__('Open Text:', 'iva_business_hours').'</div><div class="bhs-desc"><input id="" type="text" class="" name="iva_open_text" value="Open"><details>'.__('Closed text if specific day is open.','iva_business_hours').'</details></div>';
			echo '</div>';
			echo '<div class="one_half last">';
			echo '<div class="bhs-title">'.__('Description Poistion:', 'iva_business_hours').'</div><div class="bhs-desc bhs-check"><input id="desc_prefix" type="checkbox" class="" name="iva_desc_prefix" value="on"><label for="desc_prefix">'.__('Check this if you wish to display description above the hours.','iva_business_hours').'</label></div><br />';
			echo '<div class="bhs-title">'.__('Description Hide:', 'iva_business_hours').'</div><div class="bhs-desc bhs-check"><input id="desc_check" type="checkbox" class="" name="iva_desc_enable" value="on" ><label for="desc_check">'.__('Check this if you wish to hide the description( Additional info).','iva_business_hours').'</label></div><br />';
			echo '<div class="bhs-title">'.__('Grouping Hours:', 'iva_business_hours').'</div><div class="bhs-desc bhs-check"><input id="grouping_enable" type="checkbox" class="" name="iva_grouping_enable" value="on" ><label for="grouping_enable">'.__('Check this if you wish to group the hours display if the timings are same.','iva_business_hours').'</label></div><br />';
			echo '<div class="bhs-title">'.__('Toggle Hours:', 'iva_business_hours').'</div><div class="bhs-desc bhs-check"><input id="toggle_enable" type="checkbox" class="" name="iva_toggle_enable" value="on" ><label for="toggle_enable">'.__('Check this if you wish to hide all hours and display only current day and add toggle option to see remaining days.','iva_business_hours').'</label></div><br />';
			echo '<div class="bhs-title">'.__('Current Day:', 'iva_business_hours').'</div><div class="bhs-desc bhs-check"><input id="todaydate_check" type="checkbox" class="" name="iva_today_date" value="on" ><label for="todaydate_check">'.__('Check this if you wish to highlight current day in hours display.','iva_business_hours').'</label></div><br />';
			echo '<div class="bhs-title">'.__('Current Day Color:', 'iva_business_hours').'</div><div class="bhs-desc"><input id="current_day_color" type="text" class="" name="iva_current_day_color" value=""><details>'.__('Enter the color code to highlight the current day.','iva_business_hours').'</details></div><br />';
			echo '<div class="bhs-title">'.__('Closed BG color:', 'iva_business_hours').'</div><div class="bhs-desc"><input id="closed_bg_color" type="text" class="" name="iva_closed_bg_color" value=""><details>'.__('Enter the color code for the closed text background.Make sure you select dark colors on the text color is white by default.','iva_business_hours').'</details></div><br />';
			echo '<div class="bhs-title">'.__('Open BG color:', 'iva_business_hours').'</div><div class="bhs-desc"><input id="open_bg_color" type="text" class="" name="iva_open_bg_color" value=""><details>'.__('Enter the color code for the open text background.Make sure you select dark colors on the text color is white by default.','iva_business_hours').'</details></div><br />';
			echo '<div class="bhs-title">'.__('Disable Close Days:', 'iva_business_hours').'</div><div class="bhs-desc bhs-check"><input id="closedays_hide" type="checkbox" class="" name="iva_closedays_hide" value="on" ><label for="closedays_hide">'.__('Check this if you wish to hide close days .','iva_business_hours').'</label></div><br />';
			echo '<div class="bhs-title">'.__('Disable OpenClose Text:', 'iva_business_hours').'</div><div class="bhs-desc bhs-check"><input id="oc_text_hide" type="checkbox" class="" name="iva_oc_text_hide" value="on" ><label for="oc_text_hide">'.__('Check this if you wish to hide open/close text.','iva_business_hours').'</label></div><br />';
			echo '<div class="bhs-title">'.__('Single Day:', 'iva_business_hours').'</div><div class="bhs-desc bhs-check"><input id="singleday_show" type="checkbox" class="" name="iva_singleday_show" value="on" ><label for="singleday_show">'.__('Check this if you wish to display single day.','iva_business_hours').'</label></div><br />';
			echo '<div class="bhs-title">'.__('Align hours centered:', 'iva_business_hours').'</div><div class="bhs-desc bhs-check"><input id="algncenter_hrs" type="checkbox" class="" name="iva_algncenter_hrs" value="on"><label for="algncenter_hrs">'.__('Check this if you wish to display hours aligned center','iva_business_hours').'</label></div><br />';
			echo '<div class="bhs-title">'.__('Disable single day hours:', 'iva_business_hours').'</div><div class="bhs-desc bhs-check"><input id="singleday_disable" type="checkbox" class="" name="iva_singleday_disable" value="on"><label for="singleday_disable">'.__('Check this if you wish to disable single day hours','iva_business_hours').'</label></div><br />';
			echo '</div>';
			echo '</div>';//general-input				
			echo '</div>';//general-wrapper
			echo '</div>';//bHrs-right

			echo '<div class="clear"></div>';

			echo '<div class="iva_bhrs_notes">';
			echo '<h4>'.__( 'Note: To create a closed day or closed period within a day, leave both the start time and end time hours blank.','iva_business_hours').'</h4>';
			echo '<a data_ivbh_url = "'.admin_url( 'admin.php?page=iva-business-hours-pro').'" class="create_bhrs button button-hero green-button">'.__('Create','iva_business_hours').'</a>';
			echo '<a data_ivbh_url = "'.admin_url( 'admin.php?page=iva-business-hours-pro').'" class="iva_bh_close button button-hero red-button">'.__('Close','iva_business_hours').'</a>';
			echo '</div>';//iva_bhrs_notes
			echo '</br>';
	
			echo '</div>';//bHrs_wrap
			echo '</form>';
			
	
		} // Create Record
		echo '<div class="clear"></div><hr />';
		echo '<div id="ivabh-footer" class="clearfix">';
		echo '<p id="footer-right" class="alignleft">&copy;'.__('Plugin Developed by','iva_business_hours').' - <a href="http://www.aivahthemes.com" target="_blank">AivahThemes</a></p>';
		echo '<p id="footer-upgrade" class="alignright">'.$iva_bh_plugin_data['Name'].'&nbsp;'.$iva_bh_plugin_data['Version'].'</p></div><hr />';
		echo '</div>';//bHrs-mainwrap';
	}

	/**
	 * function iva_bh_timepickerOptions() 
	 * convert the PHP date/time format value to be jQuery UI DateTimePicker compliant.
	 */
	function iva_bh_timepickerOptions() {
	
		$iva_bh_time_format = get_option('iva_bh_time_format')?get_option('iva_bh_time_format') : 'H:i';

		$iva_bh_search  = array( 'G', 'H',  'h',  'g', 'i',  's',  'u', 'a',  'A' );
		$iva_bh_replace = array( 'H', 'HH', 'hh', 'h', 'mm', 'ss', 'c', 'tt', 'TT' );
		$iva_bh_options = array(
			'currentText'   => __( 'Now', 'iva_business_hours' ),
			'closeText'     => __( 'Done', 'iva_business_hours' ),
			'amNames'       => array( __( 'AM', 'iva_business_hours' ), __( 'A', 'iva_business_hours' ) ),
			'pmNames'       => array( __( 'PM', 'iva_business_hours' ), __( 'P', 'iva_business_hours' ) ),
			'timeFormat'    => str_replace( $iva_bh_search, $iva_bh_replace, $iva_bh_time_format ),
			'timeSuffix'    => '',
			'timeOnlyTitle' => __( 'Choose Time', 'iva_business_hours' ),
			'timeText'      => __( 'Time', 'iva_business_hours' ),
			'hourText'      => __( 'Hour', 'iva_business_hours' ),
			'minuteText'    => __( 'Minute', 'iva_business_hours' ),
			'secondText'    => __( 'Second', 'iva_business_hours' ),
			'millisecText'  => __( 'Millisecond', 'iva_business_hours' ),
			'microsecText'  => __( 'Microsecond', 'iva_business_hours' ),
			'timezoneText'  => __( 'Time Zone', 'iva_business_hours' ),
			'isRTL'         => is_rtl(),
			'parse'         => 'loose',
			// 'hourGrid'		=> 5,
			// 'minuteGrid'	=> 15,
		);

		return  $iva_bh_options;
	}


	/**
	 * function iva_bh_formatTime() 
	 * get Time Format set in the WP General Settings. 
	 */
	function iva_bh_formatTime( $value, $format = NULL ) {

		$format = is_null( $format ) ? get_option('iva_bh_time_format') : $format;
		if ( strlen( $value ) > 0 ) {
			return date( $format, strtotime( $value ) );
		} else {
			return $value;
		}
	}
	/**
	 * function iva_bh_getWeekdays()
	 * Output the weekdays sorted by the start of the week
	 * set in the WP General Settings. 
	 */
	function iva_bh_getWeekdays() {
		global $wp_locale;
		
		$weekStart =  get_option('start_of_week')?get_option('start_of_week'):'0';
		$weekday   = $wp_locale->weekday;
		for ( $i = 0; $i < $weekStart; $i++ ) {
			$day = array_slice( $weekday, 0, 1, true );
			unset( $weekday[ $i ] );
			$weekday = $weekday + $day;
		}
		return $weekday;
	}
	/**
	 * function iva_bh_insert()
	 * inserting busiess hours pro data into database.
	 */
	add_action('wp_ajax_iva_bh_insert', 'iva_bh_insert');
	add_action('wp_ajax_nopriv_iva_bh_insert', 'iva_bh_insert');
	function iva_bh_insert(){
		global $wpdb;
		
		$postForm = isset( $_POST['data'] ) ? $_POST['data'] :'';
	
		/**
		 * function parse_str
		 * @param 'str' inpput string
		 * @param 'arr' If the second parameter arr is present, variables are stored in this variable as array elements instead. 
		 * @return No value is returned. 
		 */
		parse_str( $postForm, $formdata );
		
		$error = $iva_bh_shortcode = $iva_time_separator = $iva_bh_alias = $iva_desc_enable = $iva_desc_prefix = '';
		$iva_today_date = $iva_description = $iva_closed_text = $iva_open_text = $iva_closed_bg_color = $iva_open_bg_color = $iva_current_day_color =$iva_grouping_enable = $iva_closedays_hide = $iva_oc_text_hide = $iva_singleday_show = $iva_algncenter_hrs = $iva_singleday_disable ='';
		$iva_toggle_enable = $iva_oc_image = $iva_open_image = $iva_close_image ='';
		
		$post  = ( !empty( $_POST ) ) ? true : false;

		// Name validation
		$formdata['iva_bh_title'] != '' ? $iva_bh_title = $formdata['iva_bh_title'] : $error .= __('Enter Title','iva_business_hours').'<br>';

		if( $formdata['iva_bh_alias'] != ''){
		    $alias_string = strtolower( trim( str_replace(' ', '-', $formdata['iva_bh_alias'] ) ) ); // Replaces all spaces with hyphens.
		    $iva_bh_alias = preg_replace('/[^A-Za-z0-9\-\(\) ]/', '', $alias_string ); // Removes special chars.
			
			global $wpdb;
			
			$iva_bh_alias_sql  = "SELECT alias FROM $wpdb->iva_businesshours";
			$iva_bh_result_row = $wpdb->get_col( $iva_bh_alias_sql ); 
			if( !empty( $iva_bh_result_row ) ){
				if( in_array( $iva_bh_alias,$iva_bh_result_row ) ){
					$error .= __('Alias Exist','iva_business_hours').'<br>';
				}
			}
		}else{
			$error .= __('Enter Alias','iva_business_hours').'<br>';
		}
		
		if( isset( $formdata['iva_description'] ) && $formdata['iva_description']!='' ){ $iva_description = $formdata['iva_description']; }
		if( isset( $formdata['iva_closed_text'] ) && $formdata['iva_closed_text']!='' ){ $iva_closed_text = $formdata['iva_closed_text']; }
		if( isset( $formdata['iva_open_text'] ) && $formdata['iva_open_text']!='' ){ $iva_open_text = $formdata['iva_open_text']; }
		
		if( isset( $formdata['iva_bh_shortcode'] ) && $formdata['iva_bh_shortcode']!='' ){ $iva_bh_shortcode = $formdata['iva_bh_shortcode']; }
		
		if( isset( $formdata['iva_time_separator'] ) && $formdata['iva_time_separator']!='' ){ $iva_time_separator = $formdata['iva_time_separator']; }
		
		if( isset( $formdata['iva_desc_enable'] ) && $formdata['iva_desc_enable']!='' )	{ $iva_desc_enable 	= $formdata['iva_desc_enable']; }
		if( isset( $formdata['iva_desc_prefix'] ) && $formdata['iva_desc_prefix']!='' )	{ $iva_desc_prefix 	= $formdata['iva_desc_prefix']; }
		if( isset( $formdata['iva_today_date'] ) && $formdata['iva_today_date']!='' )	{ $iva_today_date 	= $formdata['iva_today_date']; }
		
		if( isset( $formdata['iva_closed_bg_color'] ) && $formdata['iva_closed_bg_color']!='' )	{ $iva_closed_bg_color 	= $formdata['iva_closed_bg_color']; }
		if( isset( $formdata['iva_open_bg_color'] ) && $formdata['iva_open_bg_color']!='' )	{ $iva_open_bg_color 	= $formdata['iva_open_bg_color']; }
		
		if( isset( $formdata['iva_grouping_enable'] ) && $formdata['iva_grouping_enable']!='' )	{ $iva_grouping_enable 	= $formdata['iva_grouping_enable']; }
		if( isset( $formdata['iva_toggle_enable'] ) && $formdata['iva_toggle_enable']!='' )	{ $iva_toggle_enable 	= $formdata['iva_toggle_enable']; }
		
		if( isset( $formdata['iva_open_image'] ) && $formdata['iva_open_image']!='' )	{ $iva_open_image 	= $formdata['iva_open_image']; }
		if( isset( $formdata['iva_close_image'] ) && $formdata['iva_close_image']!='' )	{ $iva_close_image 	= $formdata['iva_close_image']; }
		
		if( isset( $formdata['iva_current_day_color'] ) && $formdata['iva_current_day_color']!='' )	{ $iva_current_day_color = $formdata['iva_current_day_color']; }
	
		if( isset( $formdata['iva_closedays_hide'] ) && $formdata['iva_closedays_hide']!='' )	{ $iva_closedays_hide 	= $formdata['iva_closedays_hide']; }
		if( isset( $formdata['iva_oc_text_hide'] ) && $formdata['iva_oc_text_hide']!='' )	{ $iva_oc_text_hide 	= $formdata['iva_oc_text_hide']; }
		if( isset( $formdata['iva_singleday_show'] ) && $formdata['iva_singleday_show']!='' )	{ $iva_singleday_show 	= $formdata['iva_singleday_show']; }
		if( isset( $formdata['iva_algncenter_hrs'] ) && $formdata['iva_algncenter_hrs']!='' )	{ $iva_algncenter_hrs 	= $formdata['iva_algncenter_hrs']; }
		if( isset( $formdata['iva_singleday_disable'] ) && $formdata['iva_singleday_disable']!='' )	{ $iva_singleday_disable 	= $formdata['iva_singleday_disable']; }
	
		if( !$error ){
		
			foreach ( iva_bh_getWeekdays() as $key => $day ) {
			
				$week_day_key = 'weekday'.$key;
				$label_key  = 'iva_'.$week_day_key.'_hrs';
				$iva_bh_time = $iva_bh_arr ='';
				$iva_bh_arr = $formdata['iva_bh'][$key];
			
				foreach( $iva_bh_arr as $iva_bh_arr_key => $test2 ){
					
					$iva_late_time = isset( $formdata['iva_bh'][$key][$iva_bh_arr_key]['latetime'] ) ? $formdata['iva_bh'][$key][$iva_bh_arr_key]['latetime']:'';
					$iva_start_time = isset( $formdata['iva_bh'][$key][$iva_bh_arr_key]['starttime'] ) ? $formdata['iva_bh'][$key][$iva_bh_arr_key]['starttime']:'';
				
					$iva_bh_time[$key][$iva_bh_arr_key]['open']  = iva_bh_formatTime( $formdata['iva_bh'][$key][$iva_bh_arr_key]['open'] , 'H:i' );
					$iva_bh_time[$key][$iva_bh_arr_key]['close'] = iva_bh_formatTime( $formdata['iva_bh'][$key][$iva_bh_arr_key]['close'], 'H:i' );
					$iva_bh_time[$key][$iva_bh_arr_key]['latetime'] = $iva_late_time;
					$iva_bh_time[$key][$iva_bh_arr_key]['starttime'] = $iva_start_time;
				}
				$$label_key =  json_encode ( $iva_bh_time );
				
			}
			
			$iva_bh_shortcode = stripslashes ( $iva_bh_shortcode );
	
			$result = $wpdb->insert( 
						$wpdb->iva_businesshours, 
						array(
							'title'				=> $iva_bh_title,
							'alias'				=> $iva_bh_alias,
							'shortcode' 		=> $iva_bh_shortcode,
							'weekday0' 			=> $iva_weekday0_hrs,
							'weekday1' 			=> $iva_weekday1_hrs,
							'weekday2'			=> $iva_weekday2_hrs,
							'weekday3'			=> $iva_weekday3_hrs,
							'weekday4' 			=> $iva_weekday4_hrs,
							'weekday5' 			=> $iva_weekday5_hrs,
							'weekday6' 			=> $iva_weekday6_hrs,
							'closedtext'  		=> $iva_closed_text,
							'opentext'  		=> $iva_open_text,
							'timeseparator'  	=> $iva_time_separator,
							'description' 		=> $iva_description,
							'todaydate'  		=> $iva_today_date,
							'descriptionprefix'	=> $iva_desc_prefix,
							'descriptionenable'	=> $iva_desc_enable,
							'closed_bg_color'	=> $iva_closed_bg_color,
							'open_bg_color'		=> $iva_open_bg_color,
							'grouping_enable'	=> $iva_grouping_enable,
							'toggle_enable'		=> $iva_toggle_enable,
							'open_image'		=> $iva_open_image,
							'close_image'		=> $iva_close_image,
							'current_day_color'	=> $iva_current_day_color,
							'closedays_hide'	=> $iva_closedays_hide,
							'oc_text_hide'		=> $iva_oc_text_hide,
							'singleday_show'	=> $iva_singleday_show,
							'algncenter_hrs'	=> $iva_algncenter_hrs,
							'singleday_disable'	=> $iva_singleday_disable
							
						),
						array( "%s" ,"%s" ,"%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s") 
			);
			$wpdb->insert_id;
			
			$response = '<div id="iva_bh_msg" class="updated success is-dismissible clearfix"><p>'.__('Created Successfully','iva_business_hours').'</p></div>';
		}else{
			$response = '<div id="iva_bh_msg" class="updated error is-dismissible clearfix"><p>'.$error.'</p></div>';
		}
		echo $response;
		exit;
	}
	/**
	 * function iva_bh_update()
	 * updating busiess hours pro data into database.
	 */
	add_action('wp_ajax_iva_bh_update', 'iva_bh_update');
	add_action('wp_ajax_nopriv_iva_bh_update', 'iva_bh_update');
	function iva_bh_update(){
	
		$iva_bh_id  = isset( $_POST['iva_bh_id'] ) ?  esc_html( $_POST['iva_bh_id'] ) :'';
		$postForm   = isset( $_POST['data'] ) ? $_POST['data'] :'';
		$error = $iva_bh_title ='';
		
		$error = $iva_bh_shortcode = $iva_desc_enable = $iva_desc_prefix = $iva_today_date = $iva_time_separator = '';
		$iva_bh_alias = $iva_description = $iva_closed_text = $iva_open_text = $iva_closed_bg_color = $iva_open_bg_color =  $iva_current_day_color = $iva_grouping_enable = $iva_closedays_hide = $iva_oc_text_hide = $iva_singleday_show = $iva_algncenter_hrs = $iva_singleday_disable ='';
		$iva_toggle_enable = $iva_oc_image = $iva_open_image = $iva_close_image ='';
		
		$post  = ( !empty( $_POST ) ) ? true : false;

		/**
		 * function parse_str
		 * @param 'str' inpput string
		 * @param 'arr' If the second parameter arr is present, variables are stored in this variable as array elements instead. 
		 * @return No value is returned. 
		 */
		parse_str( $postForm, $formdata );
	
		// Name validation
		if( $formdata['iva_bh_title']!=''){
			$iva_bh_title = $formdata['iva_bh_title'];
		}else{
			$error .= __('Enter Title','iva_business_hours');
		}
		
		if( $formdata['iva_bh_alias'] != ''){
			
		    $alias_string = strtolower( trim( str_replace(' ', '-', $formdata['iva_bh_alias'] ) ) ); // Replaces all spaces with hyphens.
		    $iva_bh_alias = preg_replace('/[^A-Za-z0-9\-\(\) ]/', '', $alias_string ); // Removes special chars.
				
			global $wpdb;
			
			$iva_bh_alias_sql  = "SELECT alias FROM $wpdb->iva_businesshours where id!= $iva_bh_id";
			$iva_bh_result_row = $wpdb->get_col( $iva_bh_alias_sql ); 
			if( !empty( $iva_bh_result_row ) ){
				if( in_array( $iva_bh_alias,$iva_bh_result_row ) ){
					$error .= __('Alias Exist','iva_business_hours').'<br>';
				}
			}
		}else{
			$error .= __('Enter Alias','iva_business_hours').'<br>';
		}
		
		if( isset( $formdata['iva_description'] ) && $formdata['iva_description']!='' ){ $iva_description = $formdata['iva_description']; }
		if( isset( $formdata['iva_closed_text'] ) && $formdata['iva_closed_text']!='' ){ $iva_closed_text = $formdata['iva_closed_text']; }
		if( isset( $formdata['iva_open_text'] ) && $formdata['iva_open_text']!='' ){ $iva_open_text = $formdata['iva_open_text']; }
		
		if( isset( $formdata['iva_bh_shortcode'] ) && $formdata['iva_bh_shortcode']!='' ){ $iva_bh_shortcode = $formdata['iva_bh_shortcode']; }
		if( isset( $formdata['iva_time_separator'] ) && $formdata['iva_time_separator']!='' ){ $iva_time_separator = $formdata['iva_time_separator']; }
		
		if( isset( $formdata['iva_desc_enable'] ) && $formdata['iva_desc_enable']!='' )	{ $iva_desc_enable 	= $formdata['iva_desc_enable']; }
		if( isset( $formdata['iva_desc_prefix'] ) && $formdata['iva_desc_prefix']!='' )	{ $iva_desc_prefix 	= $formdata['iva_desc_prefix']; }
		if( isset( $formdata['iva_today_date'] ) && $formdata['iva_today_date']!='' )	{ $iva_today_date 	= $formdata['iva_today_date']; }
		if( isset( $formdata['iva_closed_bg_color'] ) && $formdata['iva_closed_bg_color']!='' )	{ $iva_closed_bg_color 	= $formdata['iva_closed_bg_color']; }
		if( isset( $formdata['iva_open_bg_color'] ) && $formdata['iva_open_bg_color']!='' )	{ $iva_open_bg_color 	= $formdata['iva_open_bg_color']; }
		
		if( isset( $formdata['iva_grouping_enable'] ) && $formdata['iva_grouping_enable']!='' )	{ $iva_grouping_enable 	= $formdata['iva_grouping_enable']; }
		if( isset( $formdata['iva_toggle_enable'] ) && $formdata['iva_toggle_enable']!='' )	{ $iva_toggle_enable 	= $formdata['iva_toggle_enable']; }
		if( isset( $formdata['iva_current_day_color'] ) && $formdata['iva_current_day_color']!='' )	{ $iva_current_day_color 	= $formdata['iva_current_day_color']; }
		
		if( isset( $formdata['iva_open_image'] ) && $formdata['iva_open_image']!='' )	{ $iva_open_image 	= $formdata['iva_open_image']; }
		if( isset( $formdata['iva_close_image'] ) && $formdata['iva_close_image']!='' )	{ $iva_close_image 	= $formdata['iva_close_image']; }
		
		if( isset( $formdata['iva_closedays_hide'] ) && $formdata['iva_closedays_hide']!='' )	{ $iva_closedays_hide 	= $formdata['iva_closedays_hide']; }
		if( isset( $formdata['iva_oc_text_hide'] ) && $formdata['iva_oc_text_hide']!='' )	{ $iva_oc_text_hide 	= $formdata['iva_oc_text_hide']; }
		if( isset( $formdata['iva_singleday_show'] ) && $formdata['iva_singleday_show']!='' )	{ $iva_singleday_show 	= $formdata['iva_singleday_show']; }
		
		if( isset( $formdata['iva_algncenter_hrs'] ) && $formdata['iva_algncenter_hrs']!='' )	{ $iva_algncenter_hrs 	= $formdata['iva_algncenter_hrs']; }
		
		if( isset( $formdata['iva_singleday_disable'] ) && $formdata['iva_singleday_disable']!='' )	{ $iva_singleday_disable 	= $formdata['iva_singleday_disable']; }
	
		global $wpdb;
		
		if( !$error ){
			foreach ( iva_bh_getWeekdays() as $key => $day ) {
			
				$week_day_key = 'weekday'.$key;
				$label_key  = 'iva_'.$week_day_key.'_hrs';


				$iva_bh_time = $iva_bh_arr ='';
				$iva_bh_arr = $formdata['iva_bh'][$key];
				
				foreach( $iva_bh_arr as $iva_bh_arr_key => $test2 ){
					
					$iva_late_time = isset( $formdata['iva_bh'][$key][$iva_bh_arr_key]['latetime'] ) ? $formdata['iva_bh'][$key][$iva_bh_arr_key]['latetime']:'';
					$iva_start_time = isset( $formdata['iva_bh'][$key][$iva_bh_arr_key]['starttime'] ) ? $formdata['iva_bh'][$key][$iva_bh_arr_key]['starttime']:'';
					
					$iva_bh_time[$key][$iva_bh_arr_key]['open']  = iva_bh_formatTime( $formdata['iva_bh'][$key][$iva_bh_arr_key]['open'] , 'H:i' );
					$iva_bh_time[$key][$iva_bh_arr_key]['close'] = iva_bh_formatTime( $formdata['iva_bh'][$key][$iva_bh_arr_key]['close'], 'H:i' );
					$iva_bh_time[$key][$iva_bh_arr_key]['latetime'] = $iva_late_time;
					$iva_bh_time[$key][$iva_bh_arr_key]['starttime'] = $iva_start_time;
				}
				$$label_key =  json_encode ( $iva_bh_time );
			}

			$iva_bh_shortcode = stripslashes ( $iva_bh_shortcode );

			$wpdb->update( 
				$wpdb->iva_businesshours,
				array(	'title' 			=> $iva_bh_title,
						'alias'				=> $iva_bh_alias,
						'shortcode' 		=> $iva_bh_shortcode,
						'weekday0' 			=> $iva_weekday0_hrs,
						'weekday1' 			=> $iva_weekday1_hrs,
						'weekday2'			=> $iva_weekday2_hrs,
						'weekday3'			=> $iva_weekday3_hrs,
						'weekday4' 			=> $iva_weekday4_hrs,
						'weekday5' 			=> $iva_weekday5_hrs,
						'weekday6' 			=> $iva_weekday6_hrs,
						'closedtext'  		=> $iva_closed_text,
						'opentext'  		=> $iva_open_text,
						'timeseparator'  	=> $iva_time_separator,
						'description' 		=> $iva_description,
						'todaydate'  		=> $iva_today_date,
						'descriptionprefix'	=> $iva_desc_prefix,
						'descriptionenable'	=> $iva_desc_enable,
						'closed_bg_color'	=> $iva_closed_bg_color,
						'open_bg_color'		=> $iva_open_bg_color,
						'current_day_color'	=> $iva_current_day_color,
						'grouping_enable'	=> $iva_grouping_enable,
						'toggle_enable'		=> $iva_toggle_enable,
						'open_image'		=> $iva_open_image,
						'close_image'		=> $iva_close_image,
						'closedays_hide'	=> $iva_closedays_hide,
						'oc_text_hide'		=> $iva_oc_text_hide,
						'singleday_show'	=> $iva_singleday_show,
						'algncenter_hrs'	=> $iva_algncenter_hrs,
						'singleday_disable'	=> $iva_singleday_disable
				),
				array( 'id' => $iva_bh_id ), 
				array( "%s" ,"%s" ,"%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s"), 
				array( '%d' ) 
			);
			$response = '<div id="iva_bh_msg" class="updated success is-dismissible clearfix"><p>'.__('Updated Successfully','iva_business_hours').'</p><button class="notice-dismiss" type="button"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
		}else{
			$response = '<div id="iva_bh_msg" class="updated error is-dismissible clearfix"><p>'.$error.'</p><button class="notice-dismiss" type="button"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
		}
		echo $response;
		exit;
	}
	/**
	 * function iva_bh_delete()
	 * deleting busiess hours data from database.
	 */
	add_action('wp_ajax_iva_bh_delete', 'iva_bh_delete');
	add_action('wp_ajax_nopriv_iva_bh_delete', 'iva_bh_delete');
	function iva_bh_delete(){
		$iva_bh_id  = isset( $_POST['iva_bh_id'] ) ?  esc_html( $_POST['iva_bh_id'] ) :'';
		
		global $wpdb;
		
		$wpdb->delete( $wpdb->iva_businesshours,
			array( 'id' => $iva_bh_id ), 
			array( '%d' ) 
		);
		
		$response = '<div id="iva_bh_msg" class="updated success is-dismissible clearfix"><p>'.__('Deleted Successfully','aivah_businesshours').'</p><button class="notice-dismiss" type="button"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
		echo $response;
		exit;
	}
	
	/**
	 * Grouping clinic hours
	 */
	  if( !function_exists('iva_bh_grouping_hours')){
		function iva_bh_grouping_hours( $openHours,$iva_todaydate_enable,$today_color,$iva_oc_class ){
		
			$summaries = array(); 
			$output ='';
			
			foreach ( $openHours as $day => $hours ) {
			
				if (count( $summaries ) === 0) {
					$current = false;
				} else {
					$current = &$summaries[count($summaries) - 1];
				}
				if ( $current === false || $current['hours'] !== $hours ) {
						$summaries[] =  array(
						'hours' => $hours,
						'days' => array( $day )
					);
				} else {
					$current['days'][] = $day;
				}
			}
			$out = ''; 

			foreach ( $summaries as $summary ) { 
			
				$days_start_shortnames = reset($summary['days']);
				$days_end_shortnames   = end($summary['days']);
				
				$iva_bh_today  =  date_i18n( 'l', strtotime( date('l') )) ;
		
				if( in_array( $iva_bh_today ,$summary['days'] ) && $iva_todaydate_enable == 'on' ){
					$select_today = 'select-today';
					$today_css 		= ($today_color!='') ? ' style="'.$today_color.'"':'';
				}else {
					$select_today = $today_css = '';
				}

				if ( count( $summary['days'] ) === 1 ) {
					if ( $summary['hours'] == 'closed' ){
						$out[] = $days_start_shortnames;
					}else{
						$output .='<p><span class="days '.$select_today.'" '.$today_css.'>'.$days_start_shortnames . ' ' . '</span><span class="hours '.$select_today.'" '.$today_css.'>';
					
						foreach( $summary['hours'] as $key => $value ){
							$output .='<span class="hours-row">';
							$output .= $value;
							if( count( $summary['hours']) === 3 ){
								$output .= '<br>';
							}else{
								//  Nothing to display
							}
							// Open/Close Dot
							if( in_array( $iva_bh_today ,$summary['days'] )){
								$output .='<span class="iva-bh-oc-dot '.$iva_oc_class.'"></span>';
							}else{
								// Nothing to display
							}
							$output .= '</span>';
						}
						
						$output .='</span>';
						$output .='</p>'.PHP_EOL;
					}
				} 
				elseif ( count( $summary['days'] ) === 2 ) {
					if ( $summary['hours'] == 'closed' ){
						$out[] = $days_start_shortnames . ',' . $days_end_shortnames;
					}else{
						$output .='<p><span class="days">'.$days_start_shortnames. ' - ' . $days_end_shortnames .'</span>'. ' ' .'<span class="hours">';
						foreach( $summary['hours'] as $key => $value ){
							$output .='<span class="hours-row">';
							$output .= $value;
							// Open/Close Dot
							if( in_array( $iva_bh_today ,$summary['days'] )){
								$output .='<span class="iva-bh-oc-dot '.$iva_oc_class.'"></span>';
							}else{
								// Nothing to display
							}
							$output .='</span>';
						}
						$output .='</span>';
						$output .='</p>'. PHP_EOL;
					}
				} else {
					if ( $summary['hours'] == 'closed' ){
						if ( count( $summary['days'] )>= 3 ) {
							$out[] = $days_start_shortnames . ' - ' . $days_end_shortnames;
						}
					}else{
						$output .='<p><span class="days">'.$days_start_shortnames . ' - ' . $days_end_shortnames .'</span>'. ' ' .'<span class="hours">';
						foreach( $summary['hours'] as $hours){
							$output .='<span class="hours-row">';
							$output .= $hours;
							// Open/Close Dot
							if( in_array( $iva_bh_today ,$summary['days'] )){
								$output .='<span class="iva-bh-oc-dot '.$iva_oc_class.'"></span>';
							}else{
								// Nothing to display
							}
							$output .='</span>';
						}
						$output .='</span>';
						$output .='</p>'.PHP_EOL;
					}
				}
			}
			if( !empty( $out ) ){
				$output .='<p><span class="days '.$select_today.'">'.implode(',',$out).'</span><span class="hours closed '.$select_today.'">'.__('Closed','iva_theme_front').'</span></p>';
			}
			return $output;
		}
	}
	//
	if ( ! function_exists( 'iva_bhrs_get_attachment_id_from_src' ) ) {
		 function iva_bhrs_get_attachment_id_from_src ($image_src) {
			global $wpdb;
			$id = $wpdb->get_var( $wpdb->prepare( "SELECT * FROM $wpdb->posts WHERE guid = %s", $image_src ) );
			return $id;
		}
	}
	/**
	 * Requiring shoortcode
	 * Requiring Widget
	 */
	require_once('iva-business-hours-pro-widget.php');
	require_once('iva-business-hours-pro-shortcode.php');
	require_once('iva-bh-plugin-update-file.php');
	require_once('iva-bhrs-holidays.php');
	require_once('iva_bhrs_holidays_vc_addon.php');
	require_once('iva_bhrs_vc_addon.php');
