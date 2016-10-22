<?php
/**
 * Plugin Name: Aivah Shortcodes
 * Plugin URI: http://aivahthemes.net/
 * Description: A brief description of the plugin.
 * Version: 1.1.0
 * Author: AivahThemes
 * Author URI: URI: http://themeforest.net/user/AivahThemes
 * Text Domain: Optional. Plugin's text domain for localization. Example: mytextdomain
 * Domain Path: Optional. Plugin's relative directory path to .mo files. Example: /locale/
 * Network: Optional. Whether the plugin can only be activated network wide. Example: true
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
if (!class_exists('Aivah_shortcodes')) {
	
	class Aivah_shortcodes {
		
		public function  __construct()
		{			
			define( 'IVA_SC_DIR', plugin_dir_path( __FILE__ ).'/shortcode' );
			define( 'IVA_SC_INC_DIR', plugin_dir_path( __FILE__ ).'includes/' );			
			define( 'IVA_SC_JS_URI', plugin_dir_url( __FILE__ ).'js/' );
			define( 'IVA_SC_CSS_URI', plugin_dir_url( __FILE__ ) .'css/');
			define( 'IVA_SC_IMG_URI', plugin_dir_url( __FILE__ ) .'images/');
			
			$this->iva_common();
			$this->iva_shortcode_generator();
			$this->iva_shortcodes();
		}
		
		/* Shortcodes  generator*/
		public function iva_common(){
			require_once( IVA_SC_INC_DIR . 'plugin_functions.php' );
			require_once( IVA_SC_INC_DIR . 'plugin-love.php' );
			require_once( IVA_SC_INC_DIR . 'image_resize.php' );
			require_once( IVA_SC_INC_DIR . 'class_twitter.php' );
		}	
		
		/* Shortcodes  generator*/
		public function iva_shortcode_generator(){
			global $pagenow;
			if( is_admin() && ( $pagenow =='post-new.php' || $pagenow =='post.php') ) {
				require_once( IVA_SC_INC_DIR . 'shortcode-generator.php' );    
		   }
		}
	
		/* Shortcodes */
		public function iva_shortcodes()
		{
			require_once(IVA_SC_DIR .'/accordion.php');
			require_once(IVA_SC_DIR .'/boxes.php');
			require_once(IVA_SC_DIR .'/blog.php');
			require_once(IVA_SC_DIR .'/buttons.php');
			require_once(IVA_SC_DIR .'/contactinfo.php');
			require_once(IVA_SC_DIR .'/flickr.php');
			require_once(IVA_SC_DIR .'/general.php');
			require_once(IVA_SC_DIR .'/feature_box.php');
			require_once(IVA_SC_DIR .'/image.php');
			require_once(IVA_SC_DIR .'/layout.php');
			require_once(IVA_SC_DIR .'/lightbox.php');
			require_once(IVA_SC_DIR .'/tabs_toggles.php');
			require_once(IVA_SC_DIR .'/twitter.php');
			require_once(IVA_SC_DIR .'/gmap.php');
			require_once(IVA_SC_DIR .'/sociable.php');
			require_once(IVA_SC_DIR .'/videos.php');
			require_once(IVA_SC_DIR .'/staff.php');
			require_once(IVA_SC_DIR .'/services.php');
			require_once(IVA_SC_DIR .'/icon_box.php');
			require_once(IVA_SC_DIR .'/blogcarousel.php');			
			require_once(IVA_SC_DIR .'/messageboxes.php');
			require_once(IVA_SC_DIR .'/progresscircle.php');
	        require_once(IVA_SC_DIR .'/progressbar.php');
			require_once(IVA_SC_DIR .'/process_icon.php');
			require_once(IVA_SC_DIR .'/partial_section.php');
			require_once(IVA_SC_DIR .'/gallery.php');
			require_once(IVA_SC_DIR .'/logocarousel.php');
			require_once(IVA_SC_DIR .'/testimonials.php');
			require_once(IVA_SC_DIR .'/services_box.php');
			
			// Aditional shortcodes require only if post type exist
			global $wp_post_types;
			$iva_pest 		= post_type_exists( 'pest');
			$iva_booking 	= post_type_exists( 'booking');
			
			/**
			 * Pest Control Shortcodes used in niche theme
			 * @package Anona - Pest Control WordPress Theme
			 * @link http://themeforest.net/item/anona-pest-control-wordpress-theme/11056153
			 */
			if ( $iva_pest = true ) {
				require_once(IVA_SC_DIR . '/appointmentcallout.php');
				require_once(IVA_SC_DIR . '/pest_categories.php');
				require_once(IVA_SC_DIR . '/pests.php');
				require_once(IVA_SC_DIR . '/pest.php');
			}
			//
			if ( $iva_booking = true ) {
				require_once(IVA_SC_DIR . '/booking_callout.php');
			}
		}
	
		public function iva_variable( $type=null , $taxonomy=null )
		{
			$iva_terms = array();
			switch( $type ){
				case 'pages': // Get Page Titles
						$iva_entries = get_pages( 'sort_column=post_parent,menu_order' );
						if ( ! empty( $iva_entries ) && ! is_wp_error( $iva_entries ) ){
							foreach ( $iva_entries as $ivaPage ) {
								$iva_terms[$ivaPage->ID] = $ivaPage->post_title;
							}
						}
						break;
						
				case 'slider': // Get Slider Slug and Name
						$iva_entries = get_terms( 'slider_cat', 'orderby=name&hide_empty=1' );
						if ( ! empty( $iva_entries ) && ! is_wp_error( $iva_entries ) ){
							foreach ( $iva_entries as $ivaSlider ) {
								$iva_terms[$ivaSlider->slug] = $ivaSlider->name;
								$slider_ids[] = $ivaSlider->slug;
							}
						}
						break;			
			
				case 'posts': // Get Posts Slug and Name
						$iva_entries = get_categories( 'hide_empty=1' );
						if ( ! empty( $iva_entries ) && ! is_wp_error( $iva_entries ) ){
							foreach ( $iva_entries as $ivaPosts ) {
								$iva_terms[$ivaPosts->slug] = $ivaPosts->name;
								$iva_posts_ids[] = $ivaPosts->slug;
							}
						}
						break;
						
				case 'categories': //categories slug and name
							$iva_entries = get_categories('hide_empty=true');
							if ( ! empty( $iva_entries ) && ! is_wp_error( $iva_entries ) ){
								foreach ($iva_entries as $iva_posts) {
								$iva_terms[$iva_posts->term_id] = $iva_posts->name;
								$iva_posts_ids[] = $iva_posts->term_id;
								}
							}
						break;
				
				case 'testimonial': // Get Testimonial Slug and Name
						$iva_entries = get_terms( 'testimonial_cat', 'orderby=name&hide_empty=1' );
						if ( ! empty( $iva_entries ) && ! is_wp_error( $iva_entries ) ){
							foreach ( $iva_entries as $ivaTestimonial ) {
								$iva_terms[$ivaTestimonial->slug] = $ivaTestimonial->name;
								$testimonialvalue_id[] = $ivaTestimonial->slug;
							}
						}
						break;
						
				case 'tags': // Get Taxonomy Tags
						$iva_entries = get_tags( array( 'taxonomy' => 'post_tag' ) );
							if ( ! empty( $iva_entries ) && ! is_wp_error( $iva_entries ) ){
							foreach ( $iva_entries as $ivaTags ) {
								$iva_terms[$ivaTags->slug] = $ivaTags->name;
							}
						}
						break;
						
				case 'taxonomy': // Get Custom Post Categories Slug and Name
						$iva_entries = get_terms($taxonomy, 'orderby=name&hide_empty=0' );
						if ( ! empty( $iva_entries ) && ! is_wp_error( $iva_entries ) ){
							foreach ( $iva_entries as $ivaTaxonomies ) {
								$iva_terms[$ivaTaxonomies->slug] = $ivaTaxonomies->name;
							}
						}
						break;
			}							
			return $iva_terms;
		}

		
	}
	
	$iva_sc_obj = new Aivah_shortcodes();	
}


/**
 * register and enqueue scripts & styles for short codes
 */

if( !function_exists('admin_sc_scripts') ){
	
	function admin_sc_scripts(){
		
		wp_enqueue_media();
		
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_script('media-upload' );
		wp_enqueue_script('iva-sc-magnific-popup', IVA_SC_JS_URI.'admin/magnific-popup.js', array( 'jquery' ), '', true);		
		wp_enqueue_script('iva-sc-plugin-shortcode',IVA_SC_JS_URI . 'admin/shortcode.js');
		wp_enqueue_script('iva-shortcode-script',IVA_SC_JS_URI . 'admin/shortcode_script.js');
		wp_register_script('iva-shortcode-upload', IVA_SC_JS_URI .'admin/shortcode_upload.js', array( 'jquery', 'thickbox' ) );
		wp_enqueue_script('iva-shortcode-upload');	
		
		wp_enqueue_style('wp-color-picker');
		wp_enqueue_style('magnific-popup_css', IVA_SC_CSS_URI.'admin/magnific-popup.css', false, false, 'all');		
		wp_enqueue_style('shortcode_admin', IVA_SC_CSS_URI . 'admin/shortcode_admin.css');		
	
	}	
	
	add_action( 'admin_enqueue_scripts', 'admin_sc_scripts' );
}

/**
 * register and enqueue scripts & styles for short codes
 */

if( !function_exists('iva_sc_scripts') ){
	function iva_sc_scripts()
	{
		$iva_protocol = is_ssl() ? 'https' : 'http';
		wp_register_script('iva-sc-gmap',  $iva_protocol.'://maps.google.com/maps/api/js?sensor=false','jquery','','in_footer');
		wp_register_script('iva-sc-gmapmin', IVA_SC_JS_URI . 'frontend/jquery.gmap.js', 'jquery','','in_footer');
		wp_register_script('iva-sc-progresscircle', IVA_SC_JS_URI .'frontend/jquery.easy-pie-chart.js', 'jquery','','in_footer');
		wp_register_script('iva-sc-excanvas', IVA_SC_JS_URI.'frontend/excanvas.js', 'jquery','','in_footer');
		wp_register_script('iva-sc-countTo',IVA_SC_JS_URI.'frontend/jquery.countTo.js', 'jquery','1.0','in_footer');
		wp_register_script('iva-sc-owl-carousel', IVA_SC_JS_URI .'frontend/owl.carousel.js', 'jquery', '', 'in_footer');	
		wp_register_script('iva-sc-appear',  IVA_SC_JS_URI.'frontend/jquery.appear.js', 'jquery','1.0','in_footer');
		wp_register_script('iva-sc-countDown', IVA_SC_JS_URI.'frontend/jquery.countdown.min.js', 'jquery','1.0','in_footer');
		
		wp_enqueue_script('iva_sc_script',IVA_SC_JS_URI.'frontend/sc_script.js', array( 'jquery' ), '', true);				
		wp_enqueue_script('iva_sc_waypoint',IVA_SC_JS_URI . 'frontend/waypoints.js');
		wp_enqueue_script('iva-sc-appear');		
		wp_enqueue_script('iva-sc-countTo');
		wp_enqueue_script('iva-sc-countDown');
		wp_enqueue_script('iva-sc-progresscircle');
		wp_enqueue_script('iva-sc-excanvas');
		wp_enqueue_script('wp-mediaelement');
			
		wp_register_style('iva-sc-shortcodes',IVA_SC_CSS_URI.'frontend/plugin_shortcodes.css', '', 'null', 'all' ); 
		wp_enqueue_style('iva_sc_animation',IVA_SC_CSS_URI . 'frontend/animate.css');
		wp_register_style('iva-sc-owl-style', IVA_SC_CSS_URI .'frontend/owl.carousel.css', array(), '1', 'all' ); 
		wp_register_style('iva-sc-owl-theme', IVA_SC_CSS_URI .'frontend/owl.theme.css', array(), '1', 'all' ); 
		wp_enqueue_style('iva-sc-fontawesome', IVA_SC_CSS_URI.'fontawesome/css/font-awesome.css', false, false, 'all');
		wp_enqueue_style('iva-sc-shortcodes');  
	}
	add_action( 'wp_enqueue_scripts', 'iva_sc_scripts' );
}

if( !function_exists('iva_sc_buttons') ){
	add_action('media_buttons','iva_sc_buttons',11);
	function iva_sc_buttons() {
		echo '<a class="button button-primary iva-shortcode-generator" href="#iva-sc-generator"><img src="'.esc_url( IVA_SC_IMG_URI.'plugin-icon.png' ).'" />'.__('Aivah Shortcodes', 'aivah-shortcodes').'</a>';
	}
}
?>