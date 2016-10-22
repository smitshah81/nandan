<?php
add_filter('add_timings','iva_add_timings');
	function iva_add_timings( $options ) {
		global $post,$default_date;
		$output  = '';
		$fieldid = $options['field_id'];
		$post_id = $post->ID;
		$meta 	 = $options['meta'] ?  $options['meta'] :'';	
		echo "<script>
		jQuery(document).ready(function($){
			'use strict';			
			$('#iva_appt_date').change(function () {
				var iva_appt_date = jQuery('#iva_appt_date').datepicker('getDate');				
				var iva_appt_day  = iva_appt_date.getDay();
				$.ajax({
					url: admin_ajax_url,
					type: 'post',
					dataType: 'html',
					data: {
						'action': 'iva_get_appt_time',
						'week_day': iva_appt_day,
						'post_id': $post_id,
						'field_id': '".$fieldid."',
						'field_meta': '".$meta."',
					},
					success: function(response){ 
						jQuery('.iva_appt_timings').html(response).show();
					}
		        });
			}).change();	
		});
		</script>";
		echo '<div class="iva_appt_timings"></div>';
	}
	add_action('wp_ajax_iva_get_appt_time', 'iva_get_appt_time');
	add_action( 'wp_ajax_nopriv_iva_get_appt_time', 'iva_get_appt_time' );
	function iva_get_appt_time() {	
		global $default_date,$post;
		$output 	  ='';
		$iva_week_day = esc_html( $_POST['week_day'] );
		$fieldid 	  = $_POST['field_id'];
		$post_id 	  = $_POST['post_id'];
		$field_meta   = $_POST['field_meta'];
		// Gets weekday,date values
		$iva_weekdays = array('sunday','monday','tuesday','wednesday','thursday','friday','saturday');
		$iva_hrs 	  = get_option( 'iva_'.$iva_weekdays[$iva_week_day] );
		$interval 	  = get_option( 'iva_timeinterval') ? get_option('iva_timeinterval'):'15';
		$iva_format   = get_option( 'iva_time_format')? get_option( 'iva_time_format') :'12';
		if( $iva_format == '12'){
			$timeformat = "h:i A";
		}elseif( $iva_format == '24'){
			$timeformat = "H:i";
		}else{
			$timeformat = "h:i A";
		}
		$iva_time_interval = '+'.$interval.'minutes';
		$open_hrs   	   =  strtotime( $iva_hrs['opening'] );
		$close_hrs 		   =  strtotime( $iva_hrs['closing']);
		$closed_hrs 	   =  $iva_hrs['close'];
		$iva_appt_hours    = get_option('iva_hrs') ? get_option('iva_hrs'):'';
		if( isset( $iva_appt_hours) &&  $iva_appt_hours!='' ){
			$hide_hours = $iva_appt_hours[$iva_week_day];
		}
		if( $closed_hrs == 'off' ) {
			$output .='<div class="appt_timings">';
			$output .='<select name="'.$fieldid.'" id="'.$fieldid.'">';
			$output .='<option value="">'.__('Select Timings','iva_theme_admin').'</option>';
			while( $open_hrs < $close_hrs ){
				$iva_time_hrs = date( $timeformat,$open_hrs );
		
				if( $field_meta == date( 'H:i',$open_hrs ) ) {
				  $selected = 'selected="selected"'; 
				}else {
				  $selected = ''; 
				}							
				if( !empty( $iva_appt_hours ) && ( $iva_appt_hours !='' ) ) {
					if( @!in_array( $iva_time_hrs , $hide_hours  )) { 
						$output .='<option value="'.date( 'H:i',$open_hrs ).'" '.$selected.'>'.$iva_time_hrs.'-'.date( $timeformat,strtotime( $iva_time_interval, $open_hrs ) ).'</option>'; 
					}
					$open_hrs	  = strtotime( $iva_time_interval, $open_hrs );
				}	
			}
			$output .='</select>';
			$output .='</div>';
			}else { 
			$closed_msg = get_option('iva_closed_msg') ? get_option('iva_closed_msg') : __('Sorry we are closed this day', 'iva_theme_admin');
			$output .='<div class="appt-closed">';
			$output .= $closed_msg;
			$output .='</div>';
		}	
		echo $output;
		exit;
	}
	add_filter('add_custom_meta','iva_add_custom_meta');
	function iva_add_custom_meta( $options ) {
	
		$output  = '';
		$fieldid = $options['field_id'];
		$c = 0;
		?>
		
		
		<?php
		$meta 	 = $options['meta'] ?  $options['meta'] :'';	
		
		$output = '<div class="doctormetawrap">';
		if( !empty( $meta ) ) {
			foreach ( $meta as $optionvalues ){
				$output .= '<div class="iva_meta_row clearfix">';
				$output .= '<div class="iva_meta_label"><label>Label</label><input  name="'.$fieldid.'['.$c.'][label]" class="meta_label" type="text" value="'.$optionvalues['label'].'" /></div>';
				$output .= '<div class="iva_meta_value"><label>Value</label><input  name="'.$fieldid.'['.$c.'][value]" class="meta_value" type="text" value="'.$optionvalues['value'].'"/></div>';
				$output .= '<span><a title="Delete metainfo" href="javascript:void(0)" class="delete-meta-info red-button button-primary red">Delete</a></span>';
				$output .= '</div>';
					$c = $c + 1;
			}
		}			
		$output .= '</div>';//.doctormetawrap
		?>
		<script>
		$ = jQuery.noConflict();
		jQuery(document).ready(function($) {
			'use strict';
			$(".delete-meta-info").live('click', function() {
				$(this).parent().parent().remove();
			});
			var count = <?php echo $c; ?>;
			$("#add-metainfo").click(function() {
				count = count + 1;
				$('.doctormetawrap').append('<div class="iva_meta_row clearfix"><div class="iva_meta_label"><label>Label</label><input type="text" name="<?php echo $fieldid; ?>['+count+'][label]" value=""></div><div class="iva_meta_value"><label>Value</label><input type="text" name="<?php echo $fieldid; ?>['+count+'][value]"></div><span><a title="Delete Meta Info" href="javascript:(void)" class="delete-meta-info red-button button-primary">Delete</a></span></div>');	
				
				return false;
			});
		});
		</script>
		<?php
		$output .='<button type="button" id="add-metainfo" class="add_meta_button green-button button-primary">'.__('Add Meta Info','iva_theme_admin').'</button>';
		echo $output;
	}
?>