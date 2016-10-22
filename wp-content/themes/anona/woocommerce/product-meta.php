<?php

// Woocommerce Product Meta Box
$prefix = 'iva';
	
$this->meta_box[]  = array(
	'id'		=> 'iva-products',
	'title'		=> THEMENAME.'&nbsp;Product Options',
	'page'		=> array('product'),
	'context'	=> 'normal',
	'priority'	=> 'low',
	'fields'	=> array(

			array(
				'name'		=> __('Layout Option','ATP_ADMIN_SITE'),
				'desc'		=> __('Select the Layout style you wish to use for this page, Left Sidebar, Right Sidebar or Full Width.','ATP_ADMIN_SITE'),
				'id'		=> $prefix . 'sidebar_options',
				'std'		=> 'rightsidebar',
				'type'		=> 'layout',
				'options'	=> array(
								'rightsidebar'	=>  FRAMEWORK_URI . 'admin/images/right-sidebar.png', 
								'leftsidebar'	=>  FRAMEWORK_URI . 'admin/images/left-sidebar.png',
								'fullwidth'		=>  FRAMEWORK_URI . 'admin/images/fullwidth.png')	
			),

		),
			
);
?>