<?php get_header(); ?>
<div id="primary" class="pagemid">
	<div class="inner">   
    	<main class="content-area" role="main">
      		<div class="entry-content-wrapper clearfix">
				<?php
				global $atp_defaultdate,$default_date,$iva_templateid;
				$iva_fname_txt        	=  get_option('iva_fname_txt') ? get_option('iva_fname_txt') : __('First Name', 'iva_theme_front');
				$iva_lname_txt        	=  get_option('iva_lname_txt') ? get_option('iva_lname_txt') : __('Last Name', 'iva_theme_front');
				$iva_email_txt        	=  get_option('iva_email_txt') ? get_option('iva_email_txt') : __('Email', 'iva_theme_front');
				$iva_phone_txt       	=  get_option('iva_phone_txt') ? get_option('iva_phone_txt') : __('Phone', 'iva_theme_front');
				$iva_notes_txt       	=  get_option('iva_notes_txt') ? get_option('iva_notes_txt') : __('Notes', 'iva_theme_front');
				$iva_services_txt    	=  get_option('iva_services_txt') ? get_option('iva_services_txt') : __('Services', 'iva_theme_front');
				$iva_category_txt      	=  get_option('iva_category_txt') ? get_option('iva_category_txt') : __('Category', 'iva_theme_front');
				$iva_address_txt      	=  get_option('iva_address_txt') ? get_option('iva_address_txt') : __('Address', 'iva_theme_front');
				$iva_frm_heading1_txt   =  get_option('iva_form_heading1_txt') ? get_option('iva_form_heading1_txt') : __('User Details', 'iva_theme_front');
				$iva_frm_heading2_txt   =  get_option('iva_form_heading2_txt') ? get_option('iva_form_heading2_txt') : __('Appointment Information', 'iva_theme_front');
				$timeformat 			=  get_option('iva_timeformat');//get timeformat
				$iva_fname				= 	get_the_title( $post->ID );
				$iva_lname 				=	get_post_meta( $post->ID,'iva_appt_lname',true );
				$iva_email 				=	get_post_meta( $post->ID,'iva_appt_email',true );
				$iva_phone 				= 	get_post_meta( $post->ID,'iva_appt_phone',true );
				$iva_notes 				=	get_post_meta($post->ID,'iva_appt_notes',true);
				$iva_services       	= 	get_the_terms( $post->ID, 'iva_appointment_service', true );
				$iva_category       	= 	get_the_terms( $post->ID, 'iva_appointment_cat', true );
				$iva_address 			=	get_post_meta($post->ID,'iva_appt_address',true);
				$iva_appt_date    		= 	get_post_meta($post->ID,'iva_appt_date',true);
				$iva_status    			= 	get_post_meta($post->ID,'iva_appt_status',true);
				$iva_weather_loc  		=  get_option('iva_weather_loc') ? get_option('iva_weather_loc'):'Hyderabad,IN';
				$iva_weather_unit 		=  get_option('iva_weather_unit') ? get_option('iva_weather_unit') : 'f';
				$iva_cal_fstday     	=  get_option('iva_first_day');
				$iva_disable_days   	=  get_option('iva_disable_days') ? get_option('iva_disable_days'):'';
				$datepicker_language = get_option( 'iva_datepicker_language');
				if(!empty($iva_appt_date )){	
					$iva_appt_date  = date( $default_date,$iva_appt_date);
				}
				?>
					
				<script type="text/javascript">
					var date_monthNames = '';
					<?php if( $datepicker_language !='' ){  ?>
						$.datepicker.setDefaults($.datepicker.regional[ '<?php echo $datepicker_language; ?>' ] );
						var date_monthNames = $.datepicker.regional[ '<?php echo $datepicker_language; ?>' ].monthNames;
					<?php } ?>

					jQuery(document).ready(function($) {
						// Simple Weather
						jQuery.simpleWeather({
							location: '<?php echo esc_js( $iva_weather_loc ); ?>',
							woeid: '',
							unit: '<?php echo esc_js( $iva_weather_unit ); ?>',
							success: function(weather) {
								html = '<h2><span class="wi icon-'+weather.code+'"></span> '+weather.temp+'&deg;'+weather.units.temp+'</h2>';
								html += '<ul><li>'+weather.city+', '+weather.region+'</li>';
								html += '<li class="currently">'+weather.currently+'</li>';
								html += '<li>'+weather.wind.direction+' '+weather.wind.speed+' '+weather.units.speed+'</li></ul>';
								$("#iva_weather").html(html);
							},
							error: function(error) {
								$("#iva_weather").html('<p>'+error.message+'</p>');
							}
						}); 
						// Callender Date,Month,Year
						var iva_cur_date      = new Date();
						if( date_monthNames != '' ){
						var iva_months = date_monthNames;
						}else{
							var	iva_months 		= [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
						}

						var iva_current_date  = iva_cur_date.getDate(); 
						var iva_current_month = iva_months[iva_cur_date.getMonth()]; 
						var iva_current_year  = iva_cur_date.getFullYear(); 
						
						// Callender Date,Month,Year
						jQuery('.iva-calDate').html(iva_current_date);
						jQuery('.iva-calMonth').html(iva_current_month);
						jQuery('.iva-calYear').html(iva_current_year);
						
						var iva_disabled_Days   = [<?php echo esc_js( $iva_disable_days );?>]; 
						
						// Disable Specific Days:
						function iva_disable_specificdays(date) {
						  var m = date.getMonth() + 1, d = date.getDate(), y = date.getFullYear();
						  for (var i = 0; i < iva_disabled_Days.length; i++) {
							if (date.getDate() == iva_disabled_Days[i]) {
							  return [0];
							}
						  }
							return [1];
						}
						
						// Callender 
						jQuery("#iva_apptdate").datepicker({
							showOtherMonths: true,
							selectOtherMonths: true,
							nextText: "<?php echo __('Next', 'iva_theme_front'); ?>",
							prevText: "<?php echo __('Prev', 'iva_theme_front'); ?>",
							beforeShowDay : iva_disable_specificdays,
							dateFormat:'<?php echo esc_js( $atp_defaultdate ); ?>', 
							months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
							dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
							minDate: 0,
							firstDay: <?php echo ( $iva_cal_fstday !='' ) ? esc_js(  $iva_cal_fstday ) :'0';?>,
							altField: "#iva_appt_date",
							<?php 
							if( isset( $iva_appt_date) ){ ?>defaultDate: '<?php echo esc_js( $iva_appt_date ); ?>',<?php } ?>
							onSelect: iva_appointment_timings,
						});
						<?php if(isset( $iva_appt_name ) && isset( $iva_appt_email ) && isset( $iva_appt_phone ) ){ ?>
						jQuery( '[name="fname"]' ).attr('value','<?php echo esc_js( $iva_appt_name ); ?>');
						jQuery( '[name="email"]' ).attr('value','<?php echo esc_js ( $iva_appt_email ); ?>');
						jQuery( '[name="phone"]' ).attr('value','<?php echo esc_js ( $iva_appt_phone ); ?>');
						<?php } ?>       
						iva_appointment_timings();
						
						function iva_appointment_timings(){
							var iva_appt_date = jQuery("#iva_apptdate").datepicker('getDate');
							var iva_appt_day  = iva_appt_date.getDay();
							var iva_day       = iva_appt_date.getDate();  
							var iva_month     = iva_appt_date.getMonth() + 1;  
							var iva_year      = iva_appt_date.getFullYear();
							var iva_post_id   = jQuery('#res_post_id').val();    
							$.ajax({
								url: iva_panel.ajaxurl,
								type: 'post',
								dataType: 'html',
								data: {
								  'iva_postid'	: iva_post_id,
								  'action'  	: 'iva_get_appt_single_timings',
								  'week_day'	: iva_appt_day,
								  'get_date'	: iva_day + '-' + iva_month + '-' + iva_year,
								},
								success: function(response) { 
								   // Shows appointments list
								  jQuery('.appointmenttime').html(response).show();
								}
							}); // ajax function closed
						  }
					 });
				</script>  
		<div class="iva-date-wrap">
			<div class="col_half nomargin">
				<div class="iva-date">
					<span class="iva-calDate"></span><span class="iva-calMonth"></span><span class="iva-calYear"></span>
				</div>
			</div>

			<div class="col_half nomargin end">
				<div id="iva_weather"></div>
			</div>
		</div>
		<div class="demo_height" style="height:60px;"></div>			
		<?php
		echo '<div id="formstatus"></div>';
		echo '<form id="iva-appt-form-update" class="clearfix iva-form" name="appt_form">';

		echo '<div class="one_third">';
		echo '<input type="hidden" id="res_post_id" name="res_post_id" value="'.$post->ID.'">';
		
		// Calender Field 
		echo '<h4>'.$iva_frm_heading1_txt.'</h4>';
		echo '<div id="iva_apptdate"></div>';
		echo '<input type="hidden" name="iva_appt_date" id="iva_appt_date" value="">';
		echo '</div>';// One_half ends here end
		
		echo '<div class="iva_appointment one_third">'; 
		echo '<h4>'.$iva_frm_heading2_txt.'</h4>';
		
		//first name
		echo '<div class="iva_fname">';
		echo '<label for="fname" class="appt_req">'.$iva_fname_txt.'</label>';
		echo '<input type="text" id="fname" name="fname" value="'.$iva_fname.'" size="25" class="iva_appt_fname" />';
		echo '</div>';

		//last name
		echo '<div class="iva_lanme">';
		echo '<label for="lname" class="appt_req">'.$iva_lname_txt.'</label>';
		echo '<input type="text" id="lname" name="lname" value="'.$iva_lname.'" size="25" class="iva_appt_lname" />';
		echo '</div>';

		//email
		echo '<div class="iva_text">';
		echo '<label for="email" class="appt_req">'.$iva_email_txt.'</label>';
		echo '<input type="email" id="email" name="email" value="'.$iva_email.'" size="25" class="iva_appt_email" readonly="readonly"/>';
		echo '</div>';

		//Phone
		echo '<div class="iva_text">';
		echo '<label for="phone" class="appt_req">'.$iva_phone_txt.'</label>';
		echo '<input type="text" id="phone" name="phone" value="'.$iva_phone.'" size="25" class="iva_appt_phone"/>';
		echo '</div>';

		//Notes
		echo '<div class="iva_notes">';
		echo '<label for="notes" class="appt_req">'.$iva_notes_txt.'</label>';
		echo '<textarea id="notes" class="iva_appt_notes" name="notes" rows="3" cols="1">'.$iva_notes.'</textarea>';
		echo '</div>';
		
		echo '</div>';//one_third

		echo '<div class="iva_appointment one_third last">'; 
		echo '<h4>'.$iva_frm_heading2_txt.'</h4>';
		

		// Categories
		$iva_appt_categories = get_terms('iva_appointment_cat', 'orderby=name&hide_empty=0');
		if ( ! empty( $iva_appt_categories ) && ! is_wp_error( $iva_appt_categories ) ){
			echo '<div class="iva_category">';
			echo '<label for="iva_category" class="appt_req">'.$iva_category_txt.'</label>';
			echo '<div class="check-wrap">';
			foreach( $iva_category as $category_value ){
				$iva_category_keys[] = $category_value->term_id;
			}	
			foreach ( $iva_appt_categories as $iva_category ) { 
				$cat_check ='';
				if(in_array($iva_category->term_id,$iva_category_keys)){
					$cat_check = 'checked="checked"';
				}
				echo '<div class="iva_cat"><span class="iva_checkbox"><input type="checkbox" multiple="multiple" name="iva_category[]" id="iva_category'.$iva_category->term_id . '"  class="iva_category" value='. $iva_category->term_id . ' '.$cat_check.'>' ;
				echo '<label for="iva_category'.$iva_category->term_id . '">'. $iva_category->name.'</label></span></div>';
			}
			echo '</div>';
			echo '</div>';
		}
		echo '<div class="clear"></div>';
		
		// Services
		$iva_appt_services = get_terms('iva_appointment_service', 'orderby=name&hide_empty=0');
		if ( ! empty( $iva_appt_services ) && ! is_wp_error( $iva_appt_services ) ){
			echo '<div class="iva_service">';
			echo '<label for="iva_service" class="appt_req">'.$iva_services_txt.'</label>';
			echo '<div class="check-wrap">';
			foreach( $iva_services as $services_value ){
				$iv_services_keys[] = $services_value->term_id;
			}
			foreach ( $iva_appt_services as $iva_service ) { 
				$check ='';
				if(in_array($iva_service->term_id,$iv_services_keys)){
					$check = 'checked="checked"';
				}
				echo '<div class="iva_serv"><span class="iva_checkbox"><input type="checkbox"  multiple="multiple" name="iva_service[]" id="iva_service'.$iva_service->term_id . '"  class="iva_service" value='. $iva_service->term_id . '  '.$check.'>' ;
				echo '<label for="iva_service'.$iva_service->term_id . '">'. $iva_service->name.'</label></span></div>';
			}
			echo '</div>';
			echo '</div>';
		}
		
		//Address
		echo '<div class="iva_address">';
		echo '<label for="address" class="appt_req">'.$iva_address_txt.'</label>';
		echo '<textarea id="address" class="iva_appt_address" name="address" rows="3" cols="1">'.$iva_address.'</textarea>';
		echo '</div>';	

		//timings
		echo '<div class="appointmenttime" style="display:none;"></div>';

	
		//submit
		echo '<div class="iva_subbtn">';
		echo '<input type="button" name="update" value="Make Appointment" class="btn medium black" size="25" id="iva_update"/>';
		echo '&nbsp; <a class="btn medium green" target="_blank" href="'.esc_url( get_page_link($iva_templateid).'/?email='.urlencode($iva_email).'&key='.md5($iva_email)).'"><span>'.__('View Results','iva_theme_front').'</span></a>';
		echo '</div>';

		// Appointment Status
		echo '<input type="hidden" name="appt_status" id="status" value="unconfirmed" />'; 
		echo '</div>';
		echo '</div>';
		echo '</form>';
		edit_post_link( __( 'Edit', 'iva_theme_front' ), '<span class="edit-link">', '</span>' );
		?>        
        </div><!-- .content-area -->

      </main><!-- main -->    
    </div><!-- #primary.pagemid -->
<?php get_footer(); ?>