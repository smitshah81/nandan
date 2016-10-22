<?php
/**
 * Plugin Name: Twitter Widget
 * Description: A widget used for displaying twitter tweets.
 * Version: 1.0
 * Author: Fem Khan
 * Author URI: http://www.aivahthemes.com
 *
 */

	// Register Widget 
	function iva_twitter_widgets() {
		register_widget('iva_twitter_widget');
	}

	// Define the Widget as an extension of WP_Widget
	class iva_twitter_widget extends WP_Widget {
		
		public function __construct() {

			/* Widget settings. */ 
			$widget_ops = array(
				'classname'		=> 'twitter_widget',
				'description'	=> __('Use this widget to display the latest tweet from twitter', 'iva_theme_admin')
			);

			/* Widget control settings. */
			$control_ops = array(
				'width'		=> 300,
				'height'	=> 350,
				'id_base'	=> 'iva_twitter_widget'
			);
	
			/* Create the widget. */
			parent::__construct('iva_twitter_widget',THEMENAME.' - Twitter', $widget_ops, $control_ops );
		}

		// outputs the content of the widget
		function widget( $args,$instance ) {

			extract( $args );

			$title 					= $instance['iva_twitter_title'];
			$iva_twitter_username	= $instance['iva_twitter_username'];
			$iva_twitter_limits 	= $instance['iva_twitter_limits'];
			$iva_twitter_color 		= $instance['iva_twitter_color'];


			$iva_twitter_consumerkey 		= get_option( 'atp_consumerkey' ) ? get_option( 'atp_consumerkey' ) :'';
			$iva_twitter_consumersecret 	= get_option( 'atp_consumersecret' ) ? get_option( 'atp_consumersecret' ) :'';
			$iva_twitter_accesstoken 		= get_option( 'atp_accesstoken' ) ? get_option( 'atp_accesstoken' ):'';
			$iva_twitter_accesstokensecret 	= get_option( 'atp_accesstokensecret') ? get_option( 'atp_accesstokensecret') :'';

			$twitter_array = array(
					'username'				=> 	$iva_twitter_username,
					'limit' 				=> 	$iva_twitter_limits,
					'encode_utf8' 			=>	'false',
					'twitter_cons_key' 		=>	$iva_twitter_consumerkey,
					'twitter_cons_secret' 	=>	$iva_twitter_consumersecret,
					'twitter_oauth_token'	=>	$iva_twitter_accesstoken,
					'twitter_oauth_secret'	=> 	$iva_twitter_accesstokensecret
			);

			echo $before_widget;

			if ( $title ) {
				echo $before_title .$title.$after_title;
			}

			echo twitter_parse_cache_feed( $twitter_array, $iva_twitter_color );

			/* After widget (defined by themes). */
			echo $after_widget;
		}

		//Processes widget options to be saved
		function update( $new_instance, $old_instance ) {
	
			$instance = $old_instance;
	
			/* Strip tags for title and name to remove HTML (important for text inputs). */
			$instance['iva_twitter_username'] 	= strip_tags( $new_instance['iva_twitter_username'] );
			$instance['iva_twitter_limits'] 	= strip_tags( $new_instance['iva_twitter_limits'] );
			$instance['iva_twitter_title'] 		= strip_tags( $new_instance['iva_twitter_title'] );
			$instance['iva_twitter_color'] 		= strip_tags( $new_instance['iva_twitter_color'] );
	
			return $instance;
		}

		// Outputs the options form on admin
		function form( $instance ) {
			
			/* Set up some default widget settings. */
			$instance = wp_parse_args( (array) $instance, array(
				'iva_twitter_title'		=> '', 
				'iva_twitter_username'	=> '',
				'iva_twitter_limits'	=> '',
				'iva_twitter_color'		=> '',
			));


			$title 					= strip_tags( $instance['iva_twitter_title']);
			$iva_twitter_username 	= strip_tags( $instance['iva_twitter_username']);
			$iva_twitter_limits 	= strip_tags( $instance['iva_twitter_limits']);
			$iva_twitter_color 		= strip_tags( $instance['iva_twitter_color'] );

			?>

			<!-- Twitter Widget Inputs -->
			<p>
				<label for="<?php echo $this->get_field_id( 'iva_twitter_title' ); ?>"><?php _e('Twitter Title:', 'iva_theme_admin'); ?></label>
				<input id="<?php echo $this->get_field_id( 'iva_twitter_title' ); ?>" name="<?php echo $this->get_field_name( 'iva_twitter_title' ); ?>" value="<?php echo $title; ?>" type="text" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'iva_twitter_username' ); ?>"><?php _e('Twitter Username:', 'iva_theme_admin'); ?></label>
				<input id="<?php echo $this->get_field_id( 'iva_twitter_username' ); ?>" type="text" name="<?php echo $this->get_field_name( 'iva_twitter_username' ); ?>" value="<?php echo $iva_twitter_username; ?>" style="width:100%;" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'iva_twitter_limits' ); ?>"><?php _e('Twitter Limits:', 'iva_theme_admin'); ?></label>
				<input id="<?php echo $this->get_field_id( 'iva_twitter_limits' ); ?>" type="text" name="<?php echo $this->get_field_name( 'iva_twitter_limits' ); ?>" value="<?php echo $iva_twitter_limits; ?>" style="width:100%;" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'iva_twitter_color' ); ?>"><?php _e('Color:', 'iva_theme_admin'); ?></label>
				<select id="<?php echo $this->get_field_id( 'iva_twitter_color' ); ?>" name="<?php echo $this->get_field_name( 'iva_twitter_color' );?>" >
					<option value="dark" <?php if( $iva_twitter_color == 'dark' ) { echo 'selected="selected"'; } ?>>Dark</option>
					<option value="light" <?php if( $iva_twitter_color == 'light' ) { echo 'selected="selected"'; } ?>>Light</option>
				</select>
			</p>
		<?php
		}
	} 
	/* Add our function to the widgets_init hook. */
	add_action( 'widgets_init', 'iva_twitter_widgets' );
?>