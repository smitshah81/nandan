<?php
/**
 * Plugin Name: Minicartbag Widget
 * Description: A widget used for displaying Minicartbag.
 * Version: 1.0
 * Author: Fem Khan
 * Author URI: http://www.aivahthemes.com
 *
 */
	// Register Widget 
	function minicartbag_widgets() {
		register_widget( 'minicartbag_widget' );
	}

	// Define the Widget as an extension of WP_Widget
	class minicartbag_widget extends WP_Widget {

		function __construct() {
			
			/* Widget settings. */
			$widget_ops = array( 
				'classname'		=> 'minicartbag-wg',
				'description'	=> __('Minicartbag widget for sidebar.', 'iva_theme_admin')
			);
	
			/* Widget control settings. */
			$control_ops = array(
				'width'		=> 300,
				'height'	=> 350,
				'id_base'	=> 'minicartbag_widget'
			);

			/* Create the widget. */
			parent::__construct( 'minicartbag_widget',THEMENAME.' - Mini Cart Bag', $widget_ops, $control_ops );
		}

		// outputs the content of the widget
		function widget( $args, $instance ) {
			extract( $args );

			$title = $instance['title'];
			echo $before_widget;
			if ($title) {
				echo $before_title.$title.$after_title;
			}
			
			if ( class_exists('woocommerce') ) {
						iva_minicart();
			}
					
			echo $after_widget;
		}
		
		//processes widget options to be saved
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			/* Strip tags for title and name to remove HTML (important for text inputs). */
			$instance['title'] = strip_tags( $new_instance['title'] );
			
			
			return $instance;
		}
		
		// outputs the options form on admin
		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
			$title = strip_tags($instance['title']);
						
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'Title' ); ?>"><?php _e('Title:', 'iva_theme_admin'); ?></label>
				<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" style="width:100%;" />
					
			</p>
		<?php 
		} 
	} 
	/* Add our function to the widgets_init hook. */
	add_action( 'widgets_init', 'minicartbag_widgets' );
?>
