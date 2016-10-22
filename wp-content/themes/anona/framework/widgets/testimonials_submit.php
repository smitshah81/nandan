<?php
/**
 * Testimonials Widget
 *
 * @since 2.8.0
 */
class WP_Widget_Testimonials_submission extends WP_Widget {
	function __construct() {
		$widget_ops = array('classname' => 'testimonial_sub', 'description' => __('Testimonials submission','iva_theme_admin'));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('testimonialssubmission',THEMENAME. __('-Testimonials submission','iva_theme_admin'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) { ?>
		<script type="text/javascript">
		function validateresult() {
		jQuery.post('<?php echo THEME_URI; ?>/framework/includes/testimonial_submission.php', 
			jQuery("#testimonialid").serialize(),
			function(responseText) {
				document.getElementById("testimonialstatus").innerHTML = responseText;
				if(responseText.search('success') > -1){
					jQuery("#testimonialid").find('input:text, textarea').val("");
				}
			});
		}
		</script>
	<?php
	extract($args);
	
	echo $before_widget;
	
	$thankyou_msg = isset( $instance['testimonial_thankyou_msg'] ) ? $instance['testimonial_thankyou_msg'] : 'Thank You';
	$title		  = isset( $instance['title'] ) ? $instance['title'] : '';
	
	
	if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>
	
	<?php 
	function random_string( $length ) {
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$size = strlen( $chars );
		$str ='';
		for( $i = 0; $i < $length; $i++ ) {
			$str .= $chars[ rand( 0, $size - 1 ) ];
		}
		
		return $str;
	}
	$captcha = random_string( 6 );
	?>
							
	<div id="testimonialstatus"></div>
	
	<form id="testimonialid" name="testimonialform" action="#" method="post">
		<p><input class="widefat txtfield" id="title" name="title" type="text"  placeholder="Name" /></p>
		<p><textarea class="widefat" rows="5" cols="25" id="text" name="content" placeholder="Content"></textarea></p>
		<p><input  class="widefat txtfield" id="testimonial_email" name="testimonial_email" type="text" placeholder="Email" /></p>
			<input  type="hidden"  id="thankyou_msg" name="thankyoumsg" value="<?php echo $thankyou_msg; ?>"/>
		<p>	<input  class="widefat txtfield" id="website_name" name="website_name" placeholder="Website Name" type="text"/></p>
		<p>	<input  class="widefat txtfield" id="company_name" name="company_name" placeholder="Company Name" type="text"/></p>
		<p><input  class="widefat txtfield" id="website_url" name="website_url" type="text"  placeholder="Website Url"/></p>
		<p><input type="text" name="testimonial_captcha" id="testimonial_captcha" class="widefat txtfield" placeholder="Enter Captcha"></p>
		<p>
		<span class="atpcaptcha"><?php echo $captcha; ?></span>
		<input type="hidden" id="captcha_text" name="captchatext" value="<?php echo $captcha; ?>">
		</p>
		<button type="button" class="btn medium gray" onclick="validateresult();" value="submit"><span><?php echo get_option('atp_testimonialsformtxt') ? get_option('atp_testimonialsformtxt') :'Submit'; ?></span></button>
	</form>
		<?php echo $after_widget; ?>
	<?php
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['testimonial_thankyou_msg'] = strip_tags($new_instance['testimonial_thankyou_msg']);
	
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '','testimonial_thankyou_msg' => '') );
		$title = esc_attr( $instance['title'] );
		$testimonial_thankyou_msg = esc_attr( $instance['testimonial_thankyou_msg'] );?>
	<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','iva_theme_admin'); ?></label> 
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</p>

	<p>
	<label for="<?php echo $this->get_field_id('testimonial_thankyou_msg'); ?>"><?php _e('Thank you Message:','iva_theme_admin'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('testimonial_thankyou_msg'); ?>" name="<?php echo $this->get_field_name('testimonial_thankyou_msg'); ?>" type="text" value="<?php echo esc_attr($testimonial_thankyou_msg); ?>" />
	</p>
<?php
	}
}

function WP_Widget_Testimonials_submission() {
	register_widget('WP_Widget_Testimonials_submission');
}
add_action('widgets_init', 'WP_Widget_Testimonials_submission', 1);
?>