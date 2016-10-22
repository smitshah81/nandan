<?php

/*
 * Add-on Name: Location for Visual Composer
 */

if ( !class_exists( 'iva_business_hours' ) ){
	class iva_business_hours{

		// Constructor
		function __construct(){
			add_action( 'init', array( $this, 'iva_business_hours_init' ) );
			add_shortcode( 'iva_bhrs_pro', array( $this, 'iva_business_hours_shortcode' )  );
		}
		
		// Initialize the location function
		function iva_business_hours_init(){
		
			if ( function_exists( 'vc_map' ) ){
			
				global $wpdb;
				
				$ivbh_select_query  = "SELECT * FROM $wpdb->iva_businesshours" ;
				$ivbh_fetch_results = $wpdb->get_results( $ivbh_select_query ); 
				$iva_options = array();
				if( $ivbh_fetch_results ){
					foreach ( $ivbh_fetch_results as $value ) {
						$iva_options[$value->title] = $value->alias;
					}
				}
		
				// VC Map
				vc_map(
					array(
					   "name" => "Business Hours Pro",
					   "base" => "iva_bhrs_pro",
					   "class" => "",
					   "icon" => "",
					   "category" => "Aivah VC Addons",
					   "description" => __("Hours Shortcode", "iva_business_hours"),
					   "params" => array(
							array(
								"type"        => "dropdown",
								"class"       => "",
								"heading"     => __("Select Hours", "iva_business_hours"),
								"param_name"  => "name",
								"value"        => $iva_options,
								"description" => __("Select the hours shortcode to display", "iva_business_hours"),
							),
						
							array(
								"type"			 => "textfield",
								"class" 		 => "",
								"heading" 		 => __( "Width", "iva_business_hours" ),
								"param_name" 	 => "width",
								"value" 		 => "",
								"description" 	 => __( "Enter the width in only numbers, no percentage or pixels.", "iva_business_hours" ),
							),
							array(
								"type" 			=> "checkbox",
								"class" 		=> "",
								"heading" 		=> __( "Title Enable/Disable:",  "iva_business_hours" ),
								"param_name" 	=> "title",
								"value"			=> array("Enable Title" => "true"),
								"description" 	=> __( "Check this if you wish to enable/disable title.", "iva_business_hours" ),
							),
						
							array(
								"type" 			=> "checkbox",
								"class" 		=> "",
								"heading" 		=> __( "Grouping Hours:",  "iva_business_hours" ),
								"param_name" 	=> "grouping_hrs",
								"value" 		=> array("Enable grouping Hours" => "on"),
								"description" 	=> __( "Check this if you wish to group the hours display if the timings are same.", "iva_business_hours" ),
							),
							
							
							array(
								"type" 		  => "colorpicker",
								"class"       => "",
								"heading"     => __( "Current Day Color", "iva_business_hours" ),
								"param_name"  =>  "current_day_color",
								"value" 	  => "" , 
								"description" => __( "Select the day color to highlight the current day", "iva_business_hours" )
							),
							
						),
					)
				);
			}
		}
		// Shortcode handler function for Location
		function iva_business_hours_shortcode( $atts ){			
			extract(shortcode_atts(
			array(
				'width'				=> '',
				'name'				=> '',
				'title'				=> '',
				'grouping_hrs'		=> '',
				'current_day_color'	=> '',
				'single_day'		=> '',
				'openclose_text'	=> '',
				'close_days'		=> '',
				'toggle_enable'		=> '',
			), $atts));
		
			$out = $output = $today_output = $iva_bh_single_day = $toggle_output = $iva_bh_style = $iva_algncenter_hrs = $iva_bh_algn_class ='';//stores the output
		
			global $wpdb;
			
			$iva_sh_name = strtolower( trim( str_replace(' ', '-', $name ) ) ); // Replaces all spaces with hyphens.
			$iva_shortcode = '[iva_bhrs_pro name="'.$iva_sh_name.'"]';
			
			$ivbh_title = $ivbh_day_open = $ivbh_day_close = '';
			$iva_singleday_show = $single_day;
			
			$iva_bh_class = 'show'.rand('10','1000');
	
			$iva_bh_sql 	= "SELECT * FROM $wpdb->iva_businesshours where shortcode= '".$iva_shortcode."' " ;
			$iva_bh_results = $wpdb->get_results( $iva_bh_sql,ARRAY_A ); 
		
			if( $iva_bh_results ){

			$iva_bh_time_format 	= get_option('iva_bh_time_format')?get_option('iva_bh_time_format') : 'H:i';
			$iva_see_more_text		= get_option('iva_seemore_text')?get_option('iva_seemore_text'):__( 'See more','iva_business_hours');
			$iva_today_text 		= get_option('iva_today_text')?get_option('iva_today_text'):__( 'Today','iva_business_hours');
			
			$ivbh_today_hrs_array = array();
			
			foreach ( $iva_bh_results as $iva_bh_data ) {
		
				$iva_descripion_prefix = $iva_descripion_enable = $iva_descripion = $iva_todaydate_enable = $iva_grouping_enable = $iva_closed_bg_color = $iva_current_day_color = $iva_closedays_hide = $iva_oc_text_hide = '';
				$iva_toggle_enable = $closed_css = $iva_oc_css = $iva_oc_class = $iva_open_image = $iva_close_image = $iva_oc_img = $today_color = $iva_bh_start_hrs = $iva_bh_end_hrs = $iva_oc_text = '';
				
				$iva_today_timings = $iva_bh_oc_timings = array();
				
				$iva_title	= $iva_bh_data['title'];
				
				if( $iva_bh_data['closedtext'] ){
					$iva_closed_text = $iva_bh_data['closedtext'];
				}else{
					$iva_closed_text = __('Closed','iva_business_hours');
				}
				if( $iva_bh_data['opentext'] ){
					$iva_open_text = $iva_bh_data['opentext'];
				}else{
					$iva_open_text = __('Open','iva_business_hours');
				}
				if( $iva_bh_data['timeseparator'] ){
					$iva_time_separator	 = $iva_bh_data['timeseparator'];
				}else{
					$iva_time_separator	 = '-';
				}
				if( $iva_bh_data['description'] ){
					$iva_descripion	 = $iva_bh_data['description'];
				}
				if( $iva_bh_data['descriptionprefix'] ){
					$iva_descripion_prefix	 = $iva_bh_data['descriptionprefix'];
				}
				if( $iva_bh_data['descriptionenable'] ){
					$iva_descripion_enable	 = $iva_bh_data['descriptionenable'];
				}
				if( $iva_bh_data['todaydate'] ){
					$iva_todaydate_enable	 = $iva_bh_data['todaydate'];
				}
				if( isset( $iva_bh_data['grouping_enable'] ) ){
					$iva_grouping_enable = $iva_bh_data['grouping_enable'];
				}
				if( isset( $iva_bh_data['closed_bg_color'] ) ){
					$iva_closed_bg_color = $iva_bh_data['closed_bg_color'];
				}
				if( isset( $iva_bh_data['open_bg_color'] ) ){
					$iva_open_bg_color = $iva_bh_data['open_bg_color'];
				}
				if( isset( $iva_bh_data['current_day_color'] ) ){
					$iva_current_day_color = $iva_bh_data['current_day_color'];
				}
				if( isset( $iva_bh_data['toggle_enable'] ) ){
					$iva_toggle_enable = $iva_bh_data['toggle_enable'];
				}
				if( isset( $iva_bh_data['open_image'] ) ){
					$iva_open_image = $iva_bh_data['open_image'];
				}
				if( isset( $iva_bh_data['close_image'] ) ){
					$iva_close_image = $iva_bh_data['close_image'];
				}
				if( isset( $iva_bh_data['closedays_hide'] ) ){
					$iva_closedays_hide = $iva_bh_data['closedays_hide'];
				}
				if( isset( $iva_bh_data['oc_text_hide'] ) ){
					$iva_oc_text_hide = $iva_bh_data['oc_text_hide'];
				}
				if( isset( $iva_bh_data['singleday_show'] ) ){
					$iva_singleday_show = $iva_bh_data['singleday_show'];
				}
				
				if( isset( $grouping_hrs ) && $grouping_hrs!='' ){
					$iva_grouping_enable = $grouping_hrs;
				}
				if( isset( $single_day ) && $single_day!='' ){
					$iva_singleday_show = $single_day;
				}
				if( isset( $openclose_text ) && $openclose_text!='' ){
					$iva_oc_text_hide = $openclose_text;
				}
				if( isset( $close_days ) && $close_days!='' ){
					$iva_closedays_hide = $close_days;
				}
				if( isset( $toggle_enable ) && $toggle_enable!='' ){
					$iva_toggle_enable = $toggle_enable;
				}
				if( isset( $iva_bh_data['algncenter_hrs'] ) ){
					$iva_algncenter_hrs = $iva_bh_data['algncenter_hrs'];
				}

				// Open Close Image
				$iva_current_day  	=  date_i18n( 'N', strtotime( date('N') )) ;
				
				if ( $iva_current_day == '7' ) { $iva_current_day = 0; }
				
				$iva_weekday 		= 'weekday'.$iva_current_day;
				$iva_today_data 	= json_decode( $iva_bh_data[$iva_weekday] );
				
				if( $iva_today_data ){
					foreach( $iva_today_data as $key => $value){
						$iva_today_timings = $value;
					}
					foreach ( $iva_today_timings as $key => $value){
						$iva_bh_oc_timings['open'][] = $value->open;
						$iva_bh_oc_timings['close'][] = $value->close;
					}

					$max_value 			= max( $iva_bh_oc_timings['close'] );
					$min_value 			= min( $iva_bh_oc_timings['open'] );
					$iva_curent_time 	= get_date_from_gmt ( date( 'Y-m-d H:i:s', time() ), 'H:i' );

					if( !empty( $iva_bh_oc_timings ) ) {

						// Open text and image
						if ( ( strtotime( $iva_curent_time ) >=  strtotime( $min_value ) ) || 
							 ( strtotime( $iva_curent_time ) <= strtotime( $max_value ) ) ){
							 
								$iva_oc_text  	= $iva_open_text;
								$iva_oc_class 	= 'iva_oc_open';
								$open_bgcolor 	=  !empty( $iva_open_bg_color ) ? 'background-color:'.$iva_open_bg_color.';':'';
								$open_css 		= ( $open_bgcolor!='') ? ' style="'.$open_bgcolor.'"':'';
								$iva_oc_css 	=  $open_css;
							
							if(  $iva_open_image !=''){
								$iva_oc_img = '<figure><img class="ivabh_open_img" src="'.$iva_open_image.'" width="470" height="300"></figure>';
							}
						}
						// Close text and image
						if( ( strtotime( $iva_curent_time ) <  strtotime( $min_value ) ) || 
							( strtotime( $iva_curent_time ) > strtotime( $max_value ) ) ){
								
							$iva_oc_text  	= $iva_closed_text;
							$iva_oc_class 	= 'iva_oc_close';
							$closed_bgcolor =  !empty( $iva_closed_bg_color ) ? 'background-color:'.$iva_closed_bg_color.';':'';
							$closed_css 	= ( $closed_bgcolor!='') ? ' style="'.$closed_bgcolor.'"':'';
							$iva_oc_css 	= $closed_css;
							
							if(  $iva_close_image !=''){
								$iva_oc_img = '<figure><img class="ivabh_close_img" src="'.$iva_close_image.'" width="470" height="300"></figure>';
							}
						}
					}
				}
				// Open Close Image
			
				// title
				if( $title ==='true' || $title == 'on'){
					$today_output .= '<h3 class="ivabh-title">'.$iva_title.'</h3>';
				}else {
					// Empty title
				}
				
				// Open Close Image	
				if(  $iva_oc_img !=''){
					$today_output.= $iva_oc_img;	
				}
		
				$j = $k = 0;
				// Current day color
				if( isset( $current_day_color ) && $current_day_color!='' ){
					$iva_current_day_color = $current_day_color;
					$today_color = 'color:'.$iva_current_day_color;
				}else{
					$today_color = 'color:'.$iva_current_day_color;
				}
				
				// Width and inline styles
				$width 	= $width ? 'width:'.(int)$width.'px;':'';
				$iva_bh_style 	=  ( $width!='') ? ' style="'.$width.'"':'';
				$toggle_css 	= ( $iva_toggle_enable == 'on' )  ?'style="display:none;"':'';
				$closed_bgcolor =  !empty( $iva_closed_bg_color ) ? 'background-color:'.$iva_closed_bg_color.';':'';
				$closed_css 	=  ( $closed_bgcolor!='') ? ' style="'.$closed_bgcolor.'"':'';
				
				// description
				if( $iva_descripion_enable != 'on' && $iva_descripion != '' ){
					if( $iva_descripion_prefix == 'on' ){
						$out.='<div class="ivabh-desc">'.$iva_descripion.'</div>';
					}
				}
				$out.='<div class="ivabh-hours '.$iva_bh_class.'" '.$toggle_css.'>';
					// Toggle
					if ( $iva_toggle_enable == 'on' && $iva_singleday_show !='on' ) {
						$toggle_output ='<span id="'.$iva_bh_class.'" class="iva-bh-tg">';
						$toggle_output .='<span class="ivbh-seemore">'.$iva_see_more_text.'<span class="arrow"></span></span>';
						$toggle_output .='</span>';//iva-bh-tg
					}
					foreach ( iva_bh_getWeekdays() as $key => $day ) {
						$week_day_key  	= 'weekday'.$key;
						$iva_bh_day 	= json_decode( $iva_bh_data[$week_day_key] );
						$iva_bh_hrs	 	= array();
						
						foreach( $iva_bh_day as $key => $value ){
						
							$iva_row_count =  count( $value );
							foreach( $value as $time){
								
								$ivbh_day_open	 = iva_bh_formatTime( $time->open,$iva_bh_time_format );
								$ivbh_day_close	 = iva_bh_formatTime( $time->close,$iva_bh_time_format );
								$ivbh_day_start  = isset( $time->starttime ) ? $time->starttime : '';
								$ivbh_day_end   = isset( $time->latetime ) ? $time->latetime : '';
								
								if( $ivbh_day_start != '' ) {
									$ivbh_day_start = '<span class="iva-bh-stext">'.$ivbh_day_start.'</span>';
								}
								if( $ivbh_day_end != '' ) {
									$ivbh_day_end = '<span class="iva-bh-etext">'.$ivbh_day_end.'</span>';
								}

								//	 Today hours array
								if( ( $ivbh_day_open =='') && ( $ivbh_day_close =='') && ( $ivbh_day_end == '') && ( $ivbh_day_start == '') ){
									$ivbh_today_hrs_array[$day] = '<span class="closed" '.$closed_css.'>'.$iva_closed_text.'</span>';
								}elseif( ( $ivbh_day_open !='' || $ivbh_day_start != '') && ( $ivbh_day_close !='' || $ivbh_day_end != '') ){
									$ivbh_today_hrs_array[$day] = $ivbh_day_open.$ivbh_day_start.$iva_time_separator.$ivbh_day_close.$ivbh_day_end;
								}elseif( ( $ivbh_day_start != '') && ( $ivbh_day_open =='' && $ivbh_day_close =='' && $ivbh_day_end =='')){
									$ivbh_today_hrs_array[$day] = $ivbh_day_start;
								}elseif( ( $ivbh_day_end != '') && ( $ivbh_day_open =='' && $ivbh_day_start =='' && $ivbh_day_close =='')){
									$ivbh_today_hrs_array[$day] = $ivbh_day_end;
								}elseif( ( $ivbh_day_end != '') && ( $ivbh_day_close !='')){
									$ivbh_today_hrs_array[$day] = $ivbh_day_close.$iva_time_separator.$ivbh_day_end;
								}elseif( ( $ivbh_day_start != '') && ( $ivbh_day_open !='')){
									$ivbh_today_hrs_array[$day] = $ivbh_day_open.$iva_time_separator.$ivbh_day_start;
								}
								
								// with out group hours array 
								if( ( $ivbh_day_open =='') && 
									( $ivbh_day_close=='') && 
									( $ivbh_day_end == '') && 
									( $ivbh_day_start == '') ){

									if( isset( $iva_closedays_hide ) && $iva_closedays_hide != 'on' ){
										$ivbh_arr[$day] = '<span class="closed" '.$closed_css.'>'.$iva_closed_text.'</span>';
									}elseif( $iva_closedays_hide == 'on' ){
										$day = '';
									}
									
								}elseif( $ivbh_day_open !='' || $ivbh_day_start != '' ||  $ivbh_day_close !='' || $ivbh_day_end != ''){
								
									$iva_bh_start_hrs = $iva_bh_end_hrs ='';
									
									// Start hours
									if( $ivbh_day_open && $ivbh_day_start ){
										$iva_bh_start_hrs = $ivbh_day_open . $ivbh_day_start;
									}else{
										if( $ivbh_day_open != '' ){
											$iva_bh_start_hrs = $ivbh_day_open;
										}elseif( $ivbh_day_start != '' ){
											$iva_bh_start_hrs = $ivbh_day_start;
										}
									}
									
									// End hours
									if( $ivbh_day_close && $ivbh_day_end ){
										$iva_bh_end_hrs = $ivbh_day_close . $ivbh_day_end;
									}else{
										if( $ivbh_day_close !='' ){
											$iva_bh_end_hrs = $ivbh_day_close;
										}elseif( $ivbh_day_end !=''){
											$iva_bh_end_hrs = $ivbh_day_end;
										}
									}
									if( $iva_bh_start_hrs !='' && $iva_bh_end_hrs !=''){
										$ivbh_arr[$day] = $iva_bh_start_hrs . $iva_time_separator .$iva_bh_end_hrs;
									}elseif( $iva_bh_start_hrs !='' && $iva_bh_end_hrs ==''){
										$ivbh_arr[$day] = $iva_bh_start_hrs ;
									}
									elseif( $iva_bh_end_hrs !='' && $iva_bh_start_hrs ==''){	
										$ivbh_arr[$day] = $iva_bh_end_hrs;
									}
								}
								// 
								if( $iva_toggle_enable == 'on' || $iva_singleday_show == 'on' || isset( $iva_oc_text_hide) ){
									// Today result
									$iva_bh_today  =  date_i18n( 'l', strtotime( date('l') )) ;
									
									if( $iva_bh_today === $day){

										if( $k == 0 ) {
											$today_output .= '<span class="today-result">';
											$today_output .= '<p><span class="days">'.$iva_today_text;
											if( $iva_oc_text_hide != 'on' || $iva_oc_text_hide == 'off') {
												$today_output .= '<span class="iva-bh-oc-text '.$iva_oc_class.'" '.$iva_oc_css.'>'.$iva_oc_text.'</span>';
											}
											$today_output .= '</span></span><span class="hours">';
										}
										if( ( $ivbh_day_open =='') && 
											( $ivbh_day_close=='') && 
											( $ivbh_day_end == '') && 
											( $ivbh_day_start == '') ){
											$today_output .= '<span class="hours-row"><span class="closed" '.$closed_css.'>'.$iva_closed_text.'</span></span>';
										}else{
											$today_output .= '<span class="hours-row">';
											$today_output .=  $ivbh_today_hrs_array[$iva_bh_today];
											$today_output .= '<span class="iva-bh-oc-dot '.$iva_oc_class.'"></span>';
											$today_output .= '</span>';

											$k++;
											if( $iva_row_count == $k ){
												$k=0;
												$today_output .='</span></p>';
											}
										}
										if( $k == 0 ) {
											$today_output .= '</span>'; //.today-result
										}
									}
								}
								if( isset( $iva_grouping_enable ) && $iva_grouping_enable != 'on' ){
								
									if( $j == '0') {
										if( $day !=''){
											$out .='<p>';
											$iva_bh_day = '&nbsp;'.$day;
										}
									}else { 
										$iva_bh_day = '';
									}
									// Get Current Day output	
									$iva_bh_today  =  date_i18n( 'l', strtotime( date('l') )) ;
									if( $iva_bh_day !=''){
										if( $iva_bh_today === $day && $iva_todaydate_enable == 'on' ){
											$select_today = 'select-today';
											$today_css 	  = ($today_color!='') ? ' style="'.$today_color.'"':'';
										}else {
											$select_today = $today_css = '';
										}
										if( $day != ''){
											$out.='<span class="days '.$select_today.'" '.$today_css.'>'.$iva_bh_day .'</span>';
											$out.='<span class="hours '.$select_today.'" '.$today_css.'>';
										}
									}

									// with out group hours array 
									if( isset( $ivbh_arr[$day] ) && $ivbh_arr[$day] != '' ){
										$out .= '<span class="hours-row">'. $ivbh_arr[$day];
										if( $iva_bh_today === $day ){
											$out .= '<span class="iva-bh-oc-dot '.$iva_oc_class.'"></span>';
										}
										$out .= '</span>';
									}
									$j++;
									if( $iva_row_count == $j ){
										$j=0;
										if( $day !=''){
											$out.='</span>';//.hours-row
											$out.='</p>';
										}
									}
								}else{
									$iva_bh_colsedvar = false;
									// grouping hours array
									if( ( $ivbh_day_open == '') && ( $ivbh_day_close == '') && ( $ivbh_day_end == '') && ( $ivbh_day_start == '') ){
										$iva_bh_hrs[] = '<span class="closed" '.$closed_css.'>'.$iva_closed_text.'</span>';
										if( isset( $iva_closedays_hide ) && $iva_closedays_hide =='on' ){ 
											$iva_bh_colsedvar = true;
										}  
									}elseif( ( $ivbh_day_open !='' || $ivbh_day_start != '') || ( $ivbh_day_close !='' || $ivbh_day_end != '') ){
					
										// Start hours
										if( $ivbh_day_open && $ivbh_day_start ){
											$iva_bh_start_hrs = $ivbh_day_open .'&nbsp;'.$ivbh_day_start;
										}else{
											if( $ivbh_day_open !='' ){
												$iva_bh_start_hrs = $ivbh_day_open;
											}elseif( $ivbh_day_start !=''){
												$iva_bh_start_hrs = $ivbh_day_start;
											}
										}
										
										// End hours
										if( $ivbh_day_close && $ivbh_day_end ){
											$iva_bh_end_hrs = $ivbh_day_close .'&nbsp;'.$ivbh_day_end;
										}else{
											if( $ivbh_day_close !=''){
												$iva_bh_end_hrs = $ivbh_day_close;
											}elseif( $ivbh_day_end !=''){
												$iva_bh_end_hrs = $ivbh_day_end;
											}
										}
										if( $iva_bh_start_hrs !='' && $iva_bh_end_hrs !=''){
											$iva_bh_hrs[] = $iva_bh_start_hrs . $iva_time_separator .$iva_bh_end_hrs;
										}elseif( $iva_bh_start_hrs !='' && $iva_bh_end_hrs ==''){
											$iva_bh_hrs[] = $iva_bh_start_hrs ;
										}
										elseif( $iva_bh_end_hrs !='' && $iva_bh_start_hrs ==''){	
											$iva_bh_hrs[] = $iva_bh_end_hrs;
										}

									}
									if( !$iva_bh_colsedvar ){
										$ivbh_hours_array[$day] = $iva_bh_hrs;
									}
								}
							}
						}
					}
					// Grouping hours
					if( $iva_grouping_enable == 'on' ){
						$out.= iva_bh_grouping_hours( $ivbh_hours_array ,$iva_todaydate_enable,$today_color,$iva_oc_class );
					}
					$out.='</div>';
					
					// Description
					if( $iva_descripion_enable != 'on' && $iva_descripion != '' ){
						if( $iva_descripion_prefix != 'on' ){
							$out.='<div class="ivabh-desc">'.$iva_descripion.'</div>';
						}
					}
				}	
			}
			// Singleday class
			if ( $iva_singleday_show == 'on' ) {
				 $iva_bh_single_day = "iva_bh_singleday";
			}
			if( $iva_algncenter_hrs == 'on'){
				$iva_bh_algn_class = 'centeraligned';
			}
			
			// Result
			$output .= '<div class="iva_bh_shortcode '.$iva_bh_single_day.'" '.$iva_bh_style.'>';
			$output .= $today_output;
			$output .= $toggle_output;
			if( isset( $iva_singleday_show ) && $iva_singleday_show !='on'){
				$output .= '<div class="ivabh-businesshours '.$iva_bh_algn_class.'">';
				$output	.= $out;
				$output .= '</div>';//ivabh-businesshours
			}
			$output .= '</div>';//iva_bh_shortcode

			return $output;
		}
	}
}
if( class_exists('iva_business_hours') ){
	$iva_business_hours = new iva_business_hours;
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_iva_bhrs_pro extends WPBakeryShortCode {
    }
}