<?php

	/**
	 * Register Sidebars
	 */
	if(function_exists('register_sidebar')){

		// Default Sidebar 
		register_sidebar( array(
			'name'			=> __( 'Main Sidebar', 'iva_theme_admin' ),
			'id'			=> 'defaultsidebar',
			'before_title'	=>'<h3 class="widget-title">',
			'after_title'	=>'</h3>',
			'before_widget'	=>'<aside id="%1$s" class="widget %2$s">',
			'after_widget'	=>'<div class="clear"></div></aside>',
		));
		
		// Header Widget Area
		register_sidebar(array(
			'name'			=> 'Header Widget Area',
			'id'			=> 'heaer_widget_area',
			'description'	=> __('Select only one widget which will appear on your headers', 'iva_theme_admin'),
			'before_widget'	=> '<div id="%1$s" class="header-widget-area %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<strong>',
			'after_title'	=> '</strong>',
		));
	}
	/**
	 * Custom Sidebars
	 */
	if(function_exists('register_sidebar')){

		/**
		 * TOP Widgets
		 *-----------------------------
		 */
		 // Left Topbar
		register_sidebar(array(
			'name'			=> 'Topbar Left',
			'id'			=> 'topbarleft',
			'description'	=> __('Select only one widget which will appear on your Left topbar', 'iva_theme_admin'),
			'before_widget'	=> '<aside id="%1$s" class="%2$s">',
			'after_widget'	=> '</aside>',
			'before_title'	=> '<h3 class="widget-title">',
			'after_title'	=> '</h3>',
		));	
 		// Right Topbar
		register_sidebar(array(
			'name'			=> 'Topbar Right',
			'id'			=> 'topbarright',
			'description'	=> __('Select only one widget which will appear on your Right topbar', 'iva_theme_admin'),
			'before_widget'	=> '<aside id="%1$s" class="%2$s">',
			'after_widget'	=> '</aside>',
			'before_title'	=> '<h3 class="widget-title">',
			'after_title'	=> '</h3>',
		));	

		/**
		 * Footer Column Widgets
		 *-----------------------------
		 */
		 // footer column1
		register_sidebar(array(
			'name'			=> 'Footer Column1',
			'id'			=> 'footercolumn1',
			'description'	=> __('Select only one widget which will appear on your Footer column1', 'iva_theme_admin'),
			'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</aside>',
			'before_title'	=> '<h3 class="widget-title">',
			'after_title'	=> '</h3>',
		));
		// footer column2
		register_sidebar(array(
				'name'			=> 'Footer Column2',
				'id'			=> 'footercolumn2',
				'description'	=> __('Select only one widget which will appear on your Footer column2', 'iva_theme_admin'),
				'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
				'after_widget'	=> '</aside>',
				'before_title'	=> '<h3 class="widget-title">',
				'after_title'	=> '</h3>',
		));
		// footer column3
		register_sidebar(array(
				'name'			=> 'Footer Column3',
				'id'			=> 'footercolumn3',
				'description'	=> __('Select only one widget which will appear on your Footer column3', 'iva_theme_admin'),
				'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
				'after_widget'	=> '</aside>',
				'before_title'	=> '<h3 class="widget-title">',
				'after_title'	=> '</h3>',
		));
		// footer column4
		register_sidebar(array(
				'name'			=> 'Footer Column4',
				'id'			=> 'footercolumn4',
				'description'	=> __('Select only one widget which will appear on your Footer column4', 'iva_theme_admin'),
				'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
				'after_widget'	=> '</aside>',
				'before_title'	=> '<h3 class="widget-title">',
				'after_title'	=> '</h3>',
		));
		// footer column5
		register_sidebar(array(
				'name'			=> 'Footer Column5',
				'id'			=> 'footercolumn5',
				'description'	=> __('Select only one widget which will appear on your Footer column5', 'iva_theme_admin'),
				'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
				'after_widget'	=> '</aside>',
				'before_title'	=> '<h3 class="widget-title">',
				'after_title'	=> '</h3>',
		));
		// footer column6
		register_sidebar(array(
				'name'			=> 'Footer Column6',
				'id'			=> 'footercolumn6',
				'description'	=> __('Select only one widget which will appear on your Footer column6', 'iva_theme_admin'),
				'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
				'after_widget'	=> '</aside>',
				'before_title'	=> '<h3 class="widget-title">',
				'after_title'	=> '</h3>',
		));
	}

	/**
	 * Custom Sidebar Widget
	 *
	 */
	if ( function_exists('register_sidebar') ) {
		$atp_template_custom_widget = get_option('atp_customsidebar');
		if(is_array($atp_template_custom_widget)) { 
			foreach ($atp_template_custom_widget as $page_name){
				if($page_name != "")
				register_sidebar(array(
					'name'			=> $page_name,
					'id'			=> 'sidebar-'.strtolower(preg_replace('/\s+/', '-', $page_name)),
					'before_widget'	=>'<aside id="%1$s" class="widget %2$s">',
					'after_widget'	=>'</aside>',
					'before_title'	=>'<h3 class="widget-title">',
					'after_title'	=>'</h3>',

				));
			}
		}
	}

	// Footer Widget Limits
	$footerwidgetcounts=get_option("atp_footerwidgetcount");
	if($footerwidgetcounts){
		if($footerwidgetcounts == '6') { $fclass="one_sixth";}
		if($footerwidgetcounts == '5') { $fclass="one_fifth";}
		if($footerwidgetcounts == '4') { $fclass="one_fourth";}
		if($footerwidgetcounts == '2') { $fclass="half_width";}
		if($footerwidgetcounts == '3') { $fclass="one_third";}
	}
	
	// Frontpage Widget Limits
	$atp_frontpagewidgetcount=get_option("atp_frontpagewidgetcount");
	if($atp_frontpagewidgetcount){
		if($atp_frontpagewidgetcount == '1') { $frontclass="full_width";}
		if($atp_frontpagewidgetcount == '2') { $frontclass="half_width";}
		if($atp_frontpagewidgetcount == '3') { $frontclass="one_third";}
	}

	//Add input fields(priority 5, 3 parameters)
	add_action('in_widget_form', 'iva_add_widget_form',5,3);
	//Callback function for options update (priorität 5, 3 parameters)
	add_filter('widget_update_callback', 'iva_widget_form_update',5,3);
	//add class names (default priority, one parameter)
	add_filter('dynamic_sidebar_params', 'iva_from_params');

	function iva_add_widget_form($t,$return,$instance){
	    $instance = wp_parse_args( (array) $instance, array( 'iva_extracss' => ''));
		$iva_extracss 			= strip_tags($instance['iva_extracss']);
	    if( $t->id_base != 'iva_business_hrs') { ?>
		<p>
		<label for="<?php echo $t->get_field_id( 'iva_extracss' ); ?>"><?php _e('Sub Class:', 'iva_theme_admin'); ?></label>
		<input id="<?php echo $t->get_field_id( 'iva_extracss' ); ?>" type="text" name="<?php echo $t->get_field_name( 'iva_extracss' ); ?>" value="<?php echo $iva_extracss; ?>" style="width:100%;" />
		</p>
	    <?php
		}
	    $retrun = null;
	    return array($t,$return,$instance);
	}

	function iva_widget_form_update($instance, $new_instance, $old_instance){
	    $instance['iva_extracss'] = strip_tags($new_instance['iva_extracss']);
	    return $instance;
	}

	function iva_from_params($params){
	 
		global $wp_registered_widgets;
	    $widget_id = $params[0]['widget_id'];
	    $widget_obj = $wp_registered_widgets[$widget_id];
	    $widget_opt = get_option($widget_obj['callback'][0]->option_name);
	    $widget_num = $widget_obj['params'][0]['number'];
	    if (isset($widget_opt[$widget_num]['iva_extracss'])){
	            if(isset($widget_opt[$widget_num]['iva_extracss']))
	                    $float = $widget_opt[$widget_num]['iva_extracss'];
	            else
	                $float = '';
	            $params[0]['before_widget'] = preg_replace('/class="/', 'class="'.$float.' ',  $params[0]['before_widget']);
				
	    }
	    return $params;
	}
?>