<?php
/**
 * Plugin Name: Gallery Post  Widget
 * Description: A widget used for displaying Gallery  Info.
 * Version: 1.0
 * Author: Fem Khan
 * Author URI: http://www.aivahthemes.com
 *
 */
	
	/**
	 * register widget 
	 */
	function gallery_post_widgets() {
		register_widget( 'gallery_post_widgets' );
	}
	

	/**
	 * define the widget as an extension of WP_Widget 
	 */
	class gallery_post_widgets extends WP_Widget {

		public function __construct() {
		
			/**
			*  widget settings
			*/
			$widget_ops = array(
				'classname'		=> 'gallery_post-wg',
				'description'	=> __('Add Post Gallery to your widget  .', 'iva_theme_admin')
			);

			/**
			*  widget control settings.
			*/
			$control_ops = array(
				'width'		=> 300,
				'height'	=> 350,
				'id_base'	=> 'gallery_post_widgets'
			);

			/**
			* create the widget.
			*/
			parent::__construct( 'gallery_post_widgets',THEMENAME.' - Post Gallery', $widget_ops, $control_ops );
		}
	
		/**
		 * outputs the content of the widget.
		 */
		function widget( $args, $instance ) {
			global $post;
			extract( $args );
			$title = $instance['gallery_post_title'];
			$gallerypost_id = $instance['gallery_post_postid'];
			
			echo $before_widget;
			if( $title ) {
				echo $before_title.$title.$after_title; 
			}

			$postid_array = array();
		    $postid_array = explode(',',$gallerypost_id);
			$post_args     	= array(
					'post_type' 	=> 'gallery',
					'post__in'		=>  $postid_array,
			);
		
			$the_query = new WP_Query( $post_args );
			if ($the_query->have_posts()) :
				echo '<div class="gallery-list">';
				while ($the_query->have_posts()):$the_query->the_post();
					$img_alt_title 		= get_the_title();
					?>
					<div class="custompost_thumb">
						<h2 class="post-title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
						<?php 
						echo '<div class="custompost_thumb port_img">';
						if ( has_post_thumbnail()) { 
							echo '<figure><a class="hovergallery"  href="' .esc_url( get_permalink() ). '" title="' . get_the_title() . '">'. atp_resize( $post->ID, '', '300', '220', '', $img_alt_title ). '</a></figure>'; 
							
						} 
						echo '</div>';
						?>
					
					</div>
				<?php 
				endwhile;
				echo '</div>';
			endif;
			echo $after_widget;
		}
		
		/**
		 * processes widget options to be saved.
		 */
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			/**
		     * strip tags for title and name to remove HTML (important for text inputs).
		     */
			$instance['gallery_post_title'] 			= strip_tags( $new_instance['gallery_post_title'] );
			$instance['gallery_post_postid'] 			= strip_tags( $new_instance['gallery_post_postid'] );
		
			return $instance;
		}

		/**
		 * outputs the options form on admin.
		 */
		function form( $instance ) {
			/**
		     * set up some default widget settings.
		     */
			$instance = wp_parse_args( (array) $instance, array( 'gallery_post_title' => '', 'gallery_post_postid' => '' ) );
			$title 					= strip_tags($instance['gallery_post_title']);
			$gallery_postid			= strip_tags($instance['gallery_post_postid']);
			
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'gallery_post_title' ); ?>"><?php _e('Title', 'iva_theme_admin'); ?></label>
				<input id="<?php echo $this->get_field_id( 'gallery_post_title' ); ?>" name="<?php echo $this->get_field_name( 'gallery_post_title' ); ?>" value="<?php echo $title; ?>" type="text" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'gallery_post_postid' ); ?>"><?php _e('Post ID', 'iva_theme_admin'); ?></label>
				<input id="<?php echo $this->get_field_id( 'gallery_post_postid' ); ?>" name="<?php echo $this->get_field_name( 'gallery_post_postid' ); ?>" value="<?php echo $gallery_postid; ?>" type="text" style="width:100%;" />
			</p>
			
			<?php 
		} 
	}

	/**
	 * add our function to the widgets_init hook.
	 */
	add_action( 'widgets_init', 'gallery_post_widgets' );
?>