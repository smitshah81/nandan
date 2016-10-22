<?php
	// Register Widget 
	function iva_buisness_holidays() {
		register_widget( 'iva_buisness_holidays' );
	}
	
	// Define the Widget as an extension of WP_Widget
	class iva_buisness_holidays extends WP_Widget {
	
		/* constructor */
		public function __construct() {
		
				
			/* Widget settings. */
			$widget_ops = array(
				'classname'		=> 'ivabh-hd-hours',
				'description'	=> __('Display Holidays.', 'iva_business_hours')
			);
			
			/* Widget control settings. */
			$control_ops = array(
				'width'		=> 300,
				'height'	=> 350,
				'id_base'	=> 'iva_bhrs_holidays'
			);
			/* Create the widget. */
			parent::__construct( 'iva_bhrs_holidays','Business Hours Holidays', $widget_ops, $control_ops );
		}

		function widget( $args, $instance ) {
		
			extract( $args );
			
			/* Our variables from the widget settings. */
			
			$iva_bh_hd_title 	= $instance['iva_bh_hd_title'];
		
			
			// Fetch Data
			global $wpdb;

			echo $before_widget;
			
			$iva_bhrs_holidays = get_option('iva_bh_holidays')?get_option('iva_bh_holidays') : '';
			
			if( $iva_bh_hd_title !='' ) { 
				echo $before_title.$iva_bh_hd_title.$after_title; 
			}
			
			$iva_bh_date_format = get_option('iva_bh_date_format')?get_option('iva_bh_date_format'):'Y/m/d';
			
			if( !empty( $iva_bhrs_holidays )){
			
				$iva_bh_hd_data = json_decode( $iva_bhrs_holidays );
				foreach ( $iva_bh_hd_data as $key => $value ) {
					$name 			= isset( $value->name ) ? strip_tags( $value->name ):'';
					$start 			= isset( $value->start )? @date( $iva_bh_date_format, $value->start  ):'';
					$end 			= isset( $value->end )? @date( $iva_bh_date_format, $value->end ):'';
					$desc 			= isset( $value->desc )? stripslashes( $value->desc ) :'';
					$desc_disable 	= isset( $value->desc_disable ) ? $value->desc_disable : '';
					
					if( $desc_disable != 'on' ){
					
						echo '<div class="ivabh-hd-hours"><p>';
						echo '<span class="days ">' .$name.'</span>';
						if( $start === $end ) {
							echo '<span class="hours ">'.$start.'</span>';
						}else{
							echo '<span class="hours ">'.$start.' - '.$end .'</span>';
						}
						echo '<small>'.$desc.'</small>';
						echo '</p></div>';
					}
				}
			}

			echo $after_widget;
		}
		//processes widget options to be saved

		function update( $new_instance, $old_instance ) {
		
			$instance = $old_instance;
			
			/* Strip tags for title and name to remove HTML (important for text inputs). */
			$instance['iva_bh_hd_title'] = strip_tags( $new_instance['iva_bh_hd_title'] );
				
			return $instance;
		}
		
		// Outputs the options form on admin
		function form( $instance ) {
		
			/* Set up some default widget settings. */
			$instance = wp_parse_args( (array) $instance, 
											array( 
											'iva_bh_hd_title'  	=> '',
											)  
						);
			$iva_bhrs_title  = strip_tags( $instance['iva_bh_hd_title'] );
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'iva_bh_hd_title' ); ?>"><?php _e('Title', 'iva_business_hours'); ?></label>
				<input id="<?php echo $this->get_field_id( 'iva_bh_hd_title' ); ?>" name="<?php echo $this->get_field_name( 'iva_bh_hd_title' ); ?>" value="<?php echo $iva_bhrs_title; ?>" type="text" style="width:100%;" />
			</p>
		<?php	
		} 
	}
	/* Add our function to the widgets_init hook. */
	add_action( 'widgets_init', 'iva_buisness_holidays' );
?>