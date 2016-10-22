<?php
/**
 * Plugin Name: Contact Info Widget
 * Description: A widget used for displaying Contact Info.
 * Version: 1.0
 * Author: Fem Khan
 * Author URI: http://www.aivahthemes.com
 *
 */
	// Register Widget 
	function contactinfo_widgets() {
		register_widget( 'contactinfo_widgets' );
	}
	
	// Define the Widget as an extension of WP_Widget
	class contactinfo_widgets extends WP_Widget {

		public function __construct() {
			
			/* Widget settings. */
			$widget_ops = array(
				'classname'		=> 'contactinfo-wg',
				'description'	=> __('Add Contact Info to your widget  .', 'iva_theme_admin')
			);

			/* Widget control settings. */
			$control_ops = array(
				'width'		=> 300,
				'height'	=> 350,
				'id_base'	=> 'contactinfo_widgets'
			);

			/* Create the widget. */
			parent::__construct( 'contactinfo_widgets',THEMENAME.' - Contact Info', $widget_ops, $control_ops );
		}
	
		// outputs the content of the widget
		function widget( $args, $instance ) {
			extract( $args );

			$title = $instance['contactinfo_title'];
			$syscontact_name = $instance['syscontact_name'];
			$syscontact_address = $instance['syscontact_address'];
			$syscontact_phone = $instance['syscontact_phone'];
			$syscontact_email = $instance['syscontact_email'];
			$syscontact_websiteurl = $instance['syscontact_websiteurl'];
			
			echo $before_widget;
			if($title) :
			echo $before_title.$title.$after_title; 
			endif;
			echo '<div class="contactinfo-wrap">';
			if($syscontact_name){
				echo '<p><strong><span class="details">'.$syscontact_name.'</span></strong></p>';
			}
			if($syscontact_address){
				echo '<p><span class="icon"><i class="fa fa-map-marker fa-lg"></i></span>';
				echo '<span class="details">'. stripslashes(nl2br($syscontact_address)) .'</span>';
				echo '</p>';
			}

			if($syscontact_phone){
				echo '<p class="phone"><span class="icon"><i class="fa fa-phone fa-lg"></i></span><span class="details">'.$syscontact_phone.'</span></p>';
			}
			if($syscontact_email){
				echo '<p><span class="icon"><i class="fa fa-envelope fa-lg"></i></span><span class="details"><a href="mailto:'.$syscontact_email.'">'.$syscontact_email.'</a></span></p>';
			}
			if($syscontact_websiteurl){
				echo '<p><span class="icon"><i class="fa fa-link fa-lg"></i></span><span class="details"><a href="'.esc_url($syscontact_websiteurl).'">'.esc_url($syscontact_websiteurl).'</a></span></p>';
			}
			echo '</div>';
			echo $after_widget;
		}
		
		//processes widget options to be saved
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			/* Strip tags for title and name to remove HTML (important for text inputs). */
			$instance['contactinfo_title'] = strip_tags( $new_instance['contactinfo_title'] );
			$instance['syscontact_name'] = strip_tags( $new_instance['syscontact_name'] );
			$instance['syscontact_address'] = strip_tags( $new_instance['syscontact_address'] );
			$instance['syscontact_email'] = strip_tags( $new_instance['syscontact_email'] );
			$instance['syscontact_phone'] = strip_tags( $new_instance['syscontact_phone'] );
			$instance['syscontact_websiteurl'] = strip_tags( $new_instance['syscontact_websiteurl'] );

			return $instance;
		}

		// outputs the options form on admin
		function form( $instance ) {
			/* Set up some default widget settings. */
			$instance = wp_parse_args( (array) $instance, array( 'contactinfo_title' => '', 'syscontact_name' => '', 'syscontact_address' => '', 'syscontact_phone' => '', 'syscontact_email' => '','syscontact_websiteurl' =>'') );
			$title = strip_tags($instance['contactinfo_title']);
			$syscontact_name = strip_tags($instance['syscontact_name']);
			$syscontact_address = strip_tags($instance['syscontact_address']);
			$syscontact_phone = strip_tags($instance['syscontact_phone']);
			$syscontact_email = strip_tags($instance['syscontact_email']);
			$syscontact_websiteurl = strip_tags($instance['syscontact_websiteurl']);
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'contactinfo_title' ); ?>"><?php _e('Title', 'iva_theme_admin'); ?></label>
				<input id="<?php echo $this->get_field_id( 'contactinfo_title' ); ?>" name="<?php echo $this->get_field_name( 'contactinfo_title' ); ?>" value="<?php echo $title; ?>" type="text" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'syscontact_name' ); ?>"><?php _e('Name', 'iva_theme_admin'); ?></label>
				<input id="<?php echo $this->get_field_id( 'syscontact_name' ); ?>" name="<?php echo $this->get_field_name( 'syscontact_name' ); ?>" value="<?php echo $syscontact_name; ?>" type="text" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'syscontact_address' ); ?>"><?php _e('Address', 'iva_theme_admin'); ?></label>
				<textarea  rows="8" style="width:100%" id="<?php echo $this->get_field_id( 'syscontact_address' ); ?>" name="<?php echo $this->get_field_name( 'syscontact_address' ); ?>"><?php echo $syscontact_address; ?></textarea>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'syscontact_phone' ); ?>"><?php _e('Phone', 'iva_theme_admin'); ?></label>
				<input id="<?php echo $this->get_field_id( 'syscontact_phone' ); ?>" name="<?php echo $this->get_field_name( 'syscontact_phone' ); ?>" value="<?php echo $syscontact_phone; ?>" type="text" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'syscontact_email' ); ?>"><?php _e('Email', 'iva_theme_admin'); ?></label>
				<input id="<?php echo $this->get_field_id( 'syscontact_email' ); ?>" name="<?php echo $this->get_field_name( 'syscontact_email' ); ?>" value="<?php echo $syscontact_email; ?>" type="text" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'syscontact_websiteurl' ); ?>"><?php _e('Website Url', 'iva_theme_admin'); ?></label>
				<input id="<?php echo $this->get_field_id( 'syscontact_websiteurl' ); ?>" name="<?php echo $this->get_field_name( 'syscontact_websiteurl' ); ?>" value="<?php echo $syscontact_websiteurl; ?>" type="text" style="width:100%;" />
			</p>
		<?php 
		} 
	}
	/* Add our function to the widgets_init hook. */
	add_action( 'widgets_init', 'contactinfo_widgets' );
?>