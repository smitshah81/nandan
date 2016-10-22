<?php
function child_scripts( $file ){
	$child_file = str_replace( get_template_directory_uri(),get_stylesheet_directory_uri(),$file);
	return( $child_file );
}
/**
 * Enqueue the files in child theme
 * If you wish to change any js file or css file then use 'child_scripts' function for that specific file and place it in relevant folder.
 * for eg:wp_register_script('iva-countTo', child_scripts(THEME_JS . '/jquery.countTo.js'), 'jquery','1.0','in_footer'); 
 */
function child_require_file($file){
	global $atp_shortcodes;
	$child_file = str_replace(get_template_directory(),get_stylesheet_directory(),$file);
	if( file_exists( $child_file )){
		return( $child_file );
	}else{
		return( $file );
	}
}
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
		 * enqueue scripts in homepage only.
		 */
		wp_enqueue_script('jquery');
		if( is_page_template( 'pest-control/template_appointment.php' ) || is_singular('appointment') ) {
			$datepicker_language = get_option( 'iva_datepicker_language'); 
        	wp_enqueue_script('jquery-ui-datepicker');
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
$iva_readmoretxt	  = get_option('atp_readmoretxt')	? get_option('atp_readmoretxt')		: 'Read more';
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
            $this->child_require_once(FRAMEWORK_DIR . 'common/head.php');
        }
        
		/** 
		 * admin interface .
		 */
        function atp_themepanel(){
           $this->child_require_once(FRAMEWORK_DIR . 'common/atp_googlefont.php');
            $this->child_require_once(FRAMEWORK_DIR . 'admin/admin-interface.php');
            $this->child_require_once(FRAMEWORK_DIR . 'admin/theme-options.php');
        }
      
		/** 
		 * widgets .
		 */
        function atp_widgets(){
			$this->child_require_once(THEME_WIDGETS . '/register_widget.php');
			$this->child_require_once(THEME_WIDGETS . '/contactinfo.php');
			$this->child_require_once(THEME_WIDGETS . '/flickr.php');
			$this->child_require_once(THEME_WIDGETS . '/twitter.php');
			$this->child_require_once(THEME_WIDGETS . '/sociable.php');
			$this->child_require_once(THEME_WIDGETS . '/recentpost.php');
			$this->child_require_once(THEME_WIDGETS . '/testimonials_submit.php');
			$this->child_require_once(THEME_WIDGETS . '/gallery.php');
        }
        
        /** load meta generator templates
         * @files slider, Menus, testimonial, page, posts, shortcodes generator
         */
        function atp_custom_meta(){
            $this->child_require_once(THEME_CUSTOMMETA . '/page-meta.php');
            $this->child_require_once(THEME_CUSTOMMETA . '/post-meta.php');
            $this->child_require_once(THEME_CUSTOMMETA . '/slider-meta.php');
            $this->child_require_once(THEME_CUSTOMMETA . '/testimonial-meta.php');
            $this->child_require_once(THEME_CUSTOMMETA . '/gallery-meta.php');
			$this->child_require_once(THEME_CUSTOMMETA . '/logosc-meta.php');
		}
		
		function atp_meta_generators(){
			$this->child_require_once( THEME_CUSTOMMETA . '/meta-generator.php' );
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
            $this->child_require_once(THEME_DIR . '/css/skin.php');
            $this->child_require_once(FRAMEWORK_DIR . 'common/class_twitter.php');
            $this->child_require_once(FRAMEWORK_DIR . 'common/atp_generator.php');
            $this->child_require_once(FRAMEWORK_DIR . 'common/sociables.php');
            $this->child_require_once(FRAMEWORK_DIR . 'includes/image_resize.php');
            $this->child_require_once(FRAMEWORK_DIR . 'includes/class-activation.php');
        }
		
		
		function child_require_once($file){
			global $atp_shortcodes;
			$child_file = str_replace(get_template_directory(),get_stylesheet_directory(),$file);
			if( file_exists( $child_file ) ){
				require_once( $child_file );
			}else{
				require_once( $file );
			}
		}
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


if( !defined('PESTCONTROL_DIR') ) {
    define( 'PESTCONTROL_DIR', get_template_directory() . '/pest-control/');
}