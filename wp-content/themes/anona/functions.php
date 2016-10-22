<?php
/**
 * register and enqueue scripts.
 */
if( !function_exists('iva_enqueue_scripts')){
	function iva_enqueue_scripts() {
	
		wp_register_script('iva-sf-hover', THEME_JS .'/hoverIntent.js','jquery','','in_footer');
		wp_register_script('iva-sf-menu', THEME_JS .'/superfish.js','jquery','','in_footer');
		wp_register_script('iva-jgalleria', THEME_JS .'/src/galleria.js','jquery','','in_footer');
		wp_register_script('iva-jgclassic', THEME_JS .'/src/themes/classic/galleria.classic.js','jquery','','in_footer');
		wp_register_script('iva-custom', THEME_JS . '/sys_custom.js', 'jquery','1.0','in_footer');
		wp_register_script('iva-megamenu-script', THEME_JS . '/jquery.megamenu.min.js', 'jquery','1.0','in_footer');
       

		/**
		 * enqueue scripts.
		 */
		wp_enqueue_script('jquery');
		if( is_page_template( 'pest-control/template_appointment.php' ) || is_singular('appointment') ) {
        	wp_enqueue_script('jquery-ui-datepicker');
			$datepicker_language = get_option( 'iva_datepicker_language'); 
			if( $datepicker_language != '')
			{
				wp_enqueue_script('datepicker_language', THEME_URI . '/js/i18n/datepicker-'.$datepicker_language.'.js', false,false,'all' );
			}
		}
		wp_enqueue_script('iva-easing', THEME_JS .'/jquery.easing.1.3.js','jquery','','in_footer');
		wp_enqueue_script('iva-sf-hover');
		wp_enqueue_script('iva-sf-menu');
		wp_enqueue_script('iva-preloader', THEME_JS .'/jquery.preloadify.min.js','jquery','','in_footer');
		wp_enqueue_script('iva-prettyPhoto', THEME_JS .'/jquery.prettyPhoto.js','jquery','','in_footer');
		wp_enqueue_script('iva-fitvids', THEME_JS .'/jquery.fitvids.js','jquery','','in_footer');
		wp_enqueue_script('iva-custom');
        

		/**
		 * enqueue scripts in homepage only.
		 */
		wp_register_style( 'iva-responsive', THEME_CSS . '/responsive.css', array( 'iva-css-flexslider','iva-animation'), '1', 'all' ); 
		


        //AJAX URL
        $data["ajaxurl"] = admin_url("admin-ajax.php"); 

        //HOME URL
        $data["home_url"] = get_home_url();
        
        //pass data to javascript
        $params = array(
            'l10n_print_after' => 'iva_panel = ' . json_encode($data) . ';'
        );
        wp_localize_script('jquery', 'iva_panel', $params); 
		
		/**
		 * enqueue styles.
		 */
        wp_enqueue_style('datepicker', FRAMEWORK_URI.'admin/css/datepicker.css', false, false, 'all');
		wp_enqueue_style('iva_theme_front-style', get_stylesheet_uri() );
		wp_enqueue_style('iva-prettyphoto', THEME_CSS.'/prettyPhoto.css', false, false, 'all');
		wp_enqueue_style('iva-fontawesome', THEME_CSS.'/fontawesome/css/font-awesome.css', false, false, 'all');
		wp_enqueue_style('iva-fontello', THEME_CSS.'/fontello/css/aicon_.css', false, false, 'all');
		wp_enqueue_style('iva-animation', THEME_CSS.'/fontello/css/animation.css', false, false, 'all');
		wp_enqueue_style('iva-responsive' );
	
		if ( is_singular() ){
			wp_enqueue_script( 'comment-reply' );
		}
		if( get_option('atp_custom_style') != '0' ){

			$iva_custom_style = get_option('atp_custom_style');
			wp_enqueue_style('iva-custom-style', THEME_URI.'/colors/'.$iva_custom_style, false, false, 'all');
		}
	}  
	add_action( 'wp_enqueue_scripts','iva_enqueue_scripts');
}	
/**
 * Flex Slider Enqueue Scripts 
 */
if(!function_exists('iva_flexslider_enqueue_scripts')){
	add_action( 'wp_enqueue_scripts','iva_flexslider_enqueue_scripts' );
	function iva_flexslider_enqueue_scripts() {
		wp_enqueue_script('iva-flexslider', THEME_JS .'/jquery.flexslider-min.js', 'jquery', '', 'in_footer' );
		wp_enqueue_style('iva-css-flexslider', THEME_CSS. '/flexslider.css', array(), '1', 'all' );
	}
}
/**
 * get options from theme options.
 */
$iva_readmoretxt	  = get_option('atp_readmoretxt')	? get_option('atp_readmoretxt')	: __('Read more','iva_theme_front');
$iva_layout_option 	  = get_option('atp_defaultlayout');
$iva_sidebarwidget 	  = get_option('atp_customsidebar');
 

/**
 * corner ribbons.
 */
require_once(get_template_directory() . '/framework/includes/ribbons_array.php');
require_once(get_template_directory() . '/theme_functions.php');
require_once( get_template_directory() . '/framework/common/theme-love.php' );

/* Importer */
require_once( get_template_directory() . '/framework/admin/iva-importer/iva-importer.php' );
require_once( get_template_directory() . '/framework/admin/ob_import_export.php' );


/**
 * sociable icons array.
 */
$staff_social = array(
    '' => 'Select Sociable',
    'blogger'       => 'Blogger',
    'delicious'     => 'Delicious',
    'digg'          => 'Digg',
    'facebook'      => 'Facebook',
    'flickr'        => 'Flickr',
    'forrst'        => 'Forrst',
    'google'        => 'Goolge',
    'linkedin'      => 'Linkedin',
    'pinterest'     => 'Pinterest',
    'skype'         => 'Skype',
    'stumbleupon'   => 'Stumbleupon',
    'twitter'       => 'Twitter',
    'dribbble'      => 'Dribbble',
    'yahoo'         => 'Yahoo',
    'youtube'       => 'Youtube',
	'instagram'		=> 'instagram'
);
ksort( $staff_social );//sort alphabetical order.

/**
 * animation effects array.
 */
$iva_anim = array(
	''  			=> 'Select Animation',
	'fadeIn'		=>	'fadeIn',
	'fadeInLeft'	=> 	'fadeInLeft',
	'fadeInRight'	=>	'fadeInRight',
	'fadeInUp'      =>  'fadeInUp',
	'fadeInDown'    =>  'fadeInDown'
);

/**
 * ATP_Theme class.
 */
if (!class_exists('ATP_Theme')) {
    
    class ATP_Theme
    {
        public $theme_name;
   		public $meta_box;
		
        public function __construct()
        {
            $this->atp_constant();
            $this->atp_themesupport();
            $this->atp_head();
            $this->atp_themepanel();
            $this->atp_widgets();
		    $this->atp_custom_meta();
			$this->atp_meta_generators();
            $this->atp_common();
        }
        
        function atp_constant(){
			/**
			 * framework general variables and directory paths.
			 */
         	$theme_data   = wp_get_theme();
			$themeversion = $theme_data->Version;
			$theme_name   = $theme_data->Name;
            
            /**
             * Set the file path based on whether the Options 
             * Framework is in a parent theme or child theme
             * Directory Structure
             */
			/**
			 * theme framework.
			 */
            define('FRAMEWORK', '2.0'); 
            define('THEMENAME', $theme_name);
            define('THEMEVERSION', $themeversion);
            
            define('THEME_URI', get_template_directory_uri());
            define('THEME_DIR', get_template_directory());
            define('THEME_JS', THEME_URI . '/js');
            define('THEME_CSS', THEME_URI . '/css');
            define('FRAMEWORK_DIR', THEME_DIR . '/framework/');
            define('FRAMEWORK_URI', THEME_URI . '/framework/');
			define('ADMIN_URI', FRAMEWORK_URI . 'admin');
			define('ADMIN_DIR', FRAMEWORK_DIR . 'admin');
			define('THEME_WIDGETS', FRAMEWORK_DIR . 'widgets/');
			define('THEME_CUSTOMMETA', FRAMEWORK_DIR . 'custom-meta/');
			define('THEME_PATTDIR', THEME_URI . '/images/patterns/');
        }
        
        /** 
         * allows a theme to register its support of a certain features
         */
        function atp_themesupport(){
            add_theme_support('post-formats', array(
                'aside',
                'audio',
                'link',
                'image',
                'gallery',
                'quote',
                'status',
                'video',
				'event'				
            ));
            add_theme_support('post-thumbnails');
            add_theme_support('automatic-feed-links');
            add_theme_support('editor-style');
            add_theme_support('menus');
			add_theme_support( 'title-tag' );

			/** 
			 * register menu.
			 */
            register_nav_menus(array(
                'primary-menu' => __('Primary Menu', 'iva_theme_admin')
            ));
            
           
			/** 
			 * define content width.
			 */
            if (!isset( $content_width ))
                $content_width = 1100;
        }
	
       
		/** 
		 * scripts and styles enqueue .
		 */
        function atp_head(){
            require_once(FRAMEWORK_DIR . 'common/head.php');
        }
        
		/** 
		 * admin interface .
		 */
        function atp_themepanel(){
            require_once(FRAMEWORK_DIR . 'common/atp_googlefont.php');
            require_once(FRAMEWORK_DIR . 'admin/admin-interface.php');
            require_once(FRAMEWORK_DIR . 'admin/theme-options.php');
        }
      
		/** 
		 * widgets .
		 */
        function atp_widgets(){
			require_once(THEME_WIDGETS . '/register_widget.php');
			require_once(THEME_WIDGETS . '/contactinfo.php');
			require_once(THEME_WIDGETS . '/flickr.php');
			require_once(THEME_WIDGETS . '/twitter.php');
			require_once(THEME_WIDGETS . '/sociable.php');
			require_once(THEME_WIDGETS . '/recentpost.php');
			require_once(THEME_WIDGETS . '/testimonials_submit.php');
			require_once(THEME_WIDGETS . '/gallery.php');
        }
        
        
        
        /** load meta generator templates
         * @files slider, Menus, testimonial, page, posts, shortcodes generator
         */
        function atp_custom_meta(){
            require_once(THEME_CUSTOMMETA . '/page-meta.php');
            require_once(THEME_CUSTOMMETA . '/post-meta.php');
            require_once(THEME_CUSTOMMETA . '/slider-meta.php');
            require_once(THEME_CUSTOMMETA . '/testimonial-meta.php');
            require_once(THEME_CUSTOMMETA . '/gallery-meta.php');
			require_once(THEME_CUSTOMMETA . '/logosc-meta.php');
		}
		
		function atp_meta_generators(){
			require_once( THEME_CUSTOMMETA . '/meta-generator.php' );
		}

    
        /** 
         * theme functions
         * @uses skin generator
         * @uses twitter class
         * @uses pagination
         * @uses sociables
         * @uses Aqua imageresize // Credits : http://aquagraphite.com/
         * @uses plugin activation class
         */
        function atp_common(){
            require_once(THEME_DIR . '/css/skin.php');
            require_once(FRAMEWORK_DIR . 'common/class_twitter.php');
            require_once(FRAMEWORK_DIR . 'common/atp_generator.php');
            require_once(FRAMEWORK_DIR . 'common/sociables.php');
            require_once(FRAMEWORK_DIR . 'includes/image_resize.php');
            require_once(FRAMEWORK_DIR . 'includes/class-activation.php');
        }
        
        /** 
         * custom switch case for fetching
         * posts, post-types, custom-taxonomies, tags
         */
        
        function atp_variable( $type ){
            $iva_terms = array();
            switch( $type ) {
				/** 
				 * get page titles.
		         */
                case 'pages': 
                    $atp_entries = get_pages('sort_column=post_parent,menu_order');
					if ( ! empty( $atp_entries ) && ! is_wp_error( $atp_entries ) ){
						foreach ($atp_entries as $atpPage) {
							$iva_terms[$atpPage->ID] = $atpPage->post_title;
						}
					}
                    break;
				/** 
				 * get slider slug and name.
				 */
                case 'slider': 
                    $atp_entries = get_terms('slider_cat', 'orderby=name&hide_empty=0');
					if ( ! empty( $atp_entries ) && ! is_wp_error( $atp_entries ) ){
						foreach ($atp_entries as $atpSlider) {
							$iva_terms[$atpSlider->slug] = $atpSlider->name;
						}	
					}
                    break;
					
				/** 
				 * get posts slug and name.
				 */	
                case 'posts': 
                    $atp_entries = get_categories('hide_empty=0');
					if ( ! empty( $atp_entries ) && ! is_wp_error( $atp_entries ) ){
						foreach ($atp_entries as $atpPosts) {
							$iva_terms[$atpPosts->slug] = $atpPosts->name;
						}
					}
                    break;
					
				/** 
				 * get categories slug and name.
				 */	
                case 'categories':
                    $atp_entries = get_categories('hide_empty=true');
					if ( ! empty( $atp_entries ) && ! is_wp_error( $atp_entries ) ){
						foreach ($atp_entries as $atp_posts) {
							$iva_terms[$atp_posts->term_id] = $atp_posts->name;
						}
					}
                    break;
					
				/** 
				 * get testimonial slug and name.
				 */	
                case 'testimonial': 
                    $atp_entries = get_terms('testimonial_cat', 'orderby=name&hide_empty=0');
					if ( ! empty( $atp_entries ) && ! is_wp_error( $atp_entries ) ){
						foreach ($atp_entries as $atpTestimonial) {
							$iva_terms[$atpTestimonial->slug] = $atpTestimonial->name;
						}
					}
                    break;

				/** 
				 * get taxonomy tags.
				 */	
                case 'tags': 
                    $atp_entries = get_tags(array(
                        'taxonomy' => 'post_tag'
                    ));
					if ( ! empty( $atp_entries ) && ! is_wp_error( $atp_entries ) ){
						foreach ($atp_entries as $atpTags) {
							$iva_terms[$atpTags->slug] = $atpTags->name;
						}
					}
                    break;
					
				/** 
				 * slider arrays for theme options.
				 */	
                case 'slider_type': 
                    $iva_terms = array(
                        '' 					=> 'Select Slider',
                        'flexslider' 		=> 'Flex Slider',
                        'static_image' 		=> 'Static Image',
                        'customslider'		=> 'Custom Slider'
                    );
                    break;

				case 'logosc_categories': // Get Events Slug and Name
                    $atp_entries = get_terms('logosc_cat', 'orderby=name&hide_empty=0');
					if ( ! empty( $atp_entries ) && ! is_wp_error( $atp_entries ) ){
						foreach ($atp_entries as $atpEvents) {
							$iva_terms[$atpEvents->slug] = $atpEvents->name;
						}
					}
                    break;			
            }
            
            return $iva_terms;
        }

    }
}

$shortname = 'atp';

add_action( 'after_setup_theme', 'atp_theme_setup' );
define( 'PSTCTRL_DIR', get_template_directory() . '/pest-control/');

if( !defined('PESTCONTROL_DIR') ) {
    define( 'PESTCONTROL_DIR', get_template_directory() . '/pest-control/');
}
if( defined('PESTCONTROL_DIR') ) {
    require_once(PESTCONTROL_DIR . 'index.php' );
} else {
	$atp_theme = new ATP_Theme();	
	$url =  FRAMEWORK_URI . 'admin/images/';
}

if( !function_exists('atp_theme_setup') ){
	add_action('after_setup_theme', 'atp_theme_setup');
	function atp_theme_setup(){
		load_theme_textdomain('iva_theme_front', get_template_directory() . '/languages');
		load_theme_textdomain('iva_theme_admin', get_template_directory() . '/languages');
		add_filter('the_content', 'pre_process_shortcode');
		add_filter('widget_text', 'do_shortcode');
		add_filter('posts_where', 'multi_tax_terms');
		add_filter('wp_trim_excerpt', 'new_excerpt_more');
		add_filter('upload_mimes', 'atp_custom_upload_mimes');
		// This theme uses its own gallery styles.
		add_filter( 'use_default_gallery_style', '__return_false' );
	}
}

if( !function_exists('pre_process_shortcode')){
	function pre_process_shortcode($content) {
		global $shortcode_tags;
		$shortcode = array();
		foreach ($shortcode_tags as $key => $value){
			if( is_string(($value) ) ) {
				if( @stristr($value, 'iva_') ) {
					$shortcode[$key]=$key;
				}
			}
		}
		$block = join("|",$shortcode);
		// Opening tag
		$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
		// Closing tag
		$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
		 
		return $rep;
	}
}

/**
 * function atp_custom_login_logo
 */
if( !function_exists('pre_process_shortcode')){
	add_action('login_head', 'atp_custom_login_logo');
	function atp_custom_login_logo(){
		if ( get_option('atp_admin_logo') ) {
			echo '<style type="text/css">.login h1 a { background-image:url(' . get_option('atp_admin_logo') . ') !important; }</style>';
		}
	}
}



$default_date = get_option('atp_date_format') ? get_option('atp_date_format') :'Y/m/d';

switch( $default_date ){

    case 'Y/m/d':
                $atp_defaultdate = 'yy/mm/dd';
                break;
    case 'm/d/Y':
                $atp_defaultdate = 'mm/dd/yy';
                break;
    case 'd-m-Y':
                $atp_defaultdate = 'dd-mm-yy';
                break;
    default:
                $atp_defaultdate = 'yy/mm/dd';
                break;
}
/**
 * Multiple taxonomies
 */
if(!function_exists('multi_tax_terms')){
	function multi_tax_terms( $where ){
	    global $wp_query, $wpdb;
	    
	    if (isset($wp_query->query_vars['term']) && (strpos($wp_query->query_vars['term'], ',') !== false && strpos($where, "AND 0") !== false)) {
	        
			/**
			 * Get the terms
			 */
	        $term_arr = explode(",", $wp_query->query_vars['term']);
	        foreach ($term_arr as $term_item) {
	            $terms[] = get_terms($wp_query->query_vars['taxonomy'], array(
	                'slug' => $term_item
	            ));
	        } 
			
	   		/**
			 * get the id of posts with that term in that taxonomy.
			 */ 
	        foreach ($terms as $term) {
				if($term){
					$term_ids[] = $term[0]->term_id;
				}
	        } //$terms as $term
	        
	        $post_ids = get_objects_in_term($term_ids, $wp_query->query_vars['taxonomy']);
	        //echo $post_ids;
	        if (!is_wp_error($post_ids) && count($post_ids)) {
	            // Build the new query
	            $new_where = " AND $wpdb->posts.ID IN (" . implode(', ', $post_ids) . ") ";
	            $where     = str_replace("AND 0", $new_where, $where);
	        } else {
	        }
	    } //$wp_query
	
	    return $where;
	}
}
/**
 *  Excerpt removes 
 */
if(!function_exists('new_excerpt_more')){
	function new_excerpt_more( $excerpt ){
	    return str_replace('[...]', '...', $excerpt);
	}
}
/**
 * Custom Upload file extension
 */
if(!function_exists('atp_custom_upload_mimes')){
	function atp_custom_upload_mimes( $existing_mimes ){
	    // add the file extension to the array
	    $existing_mimes['eot']  = 'font/eot';
	    $existing_mimes['ttf']  = 'font/ttf';
	    $existing_mimes['woff'] = 'font/woff';
	    $existing_mimes['svg']  = 'font/svg';
	    
	    return $existing_mimes;
	}
}

if ( ! function_exists( 'iva_get_attachment_id_from_src' ) ) {
     function iva_get_attachment_id_from_src ($image_src) {
        global $wpdb;
        $id = $wpdb->get_var( $wpdb->prepare( "SELECT * FROM $wpdb->posts WHERE guid = %s", $image_src ) );
        return $id;
    }
}

/**
 * Limit Post Title by amount of characters
 */
if ( ! function_exists( 'short_title' ) ) {
	function short_title() {
		$producttitle = get_the_title();
		$title = html_entity_decode($producttitle, ENT_QUOTES, "UTF-8"); 
		$limit = "20";
		$pad="...";
	
		if(strlen($title) >= ($limit+3)) {
			$title = mb_substr($title, 0, $limit) . $pad; 
		}
		echo $title;
	
	}
}

/**
 * Gallery Image lightbox
 */
if( !function_exists('gallery_add_rel_attribute')){  
	function gallery_add_rel_attribute($link) {
		global $post;
		return str_replace('<a href', '<a data-rel="prettyPhoto[pp_gal]" href', $link);
	}
	add_filter('wp_get_attachment_link', 'gallery_add_rel_attribute');
}

// Woocommerce Config File
if ( class_exists('woocommerce') ) {
	require_once( 'woocommerce/config.php' );
}
?>