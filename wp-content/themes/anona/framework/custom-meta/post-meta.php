<?php
	//
	//--------------------------------------------------------
	$prefix = '';
	global $iva_sidebarwidget, $layout_option;
	$pagetitle_align = get_option('atp_sub_styling');
	$iva_sidebar_layout = get_option('atp_defaultlayout');
	$this->meta_box[] = array(
		'id'		=> 'post-meta-box',
		'title'		=> '&nbsp;Post Options',
		'page'		=> array('post'),
		'context'	=> 'normal',
		'priority'	=> 'core',
		'fields'	=> array(

			
			/**
			 * link
			 */
			array( 
				'name' => __('The URL','iva_theme_admin'),
				'desc' => __('Insert the URL you wish to link to. Including http://','iva_theme_admin'),
				'class' => 'postformatmetabox-link',
				'id' => $prefix.'link_url',
				'std' => '',
				'type' => 'text',
			),
			/**
			 * quote
			 */
			array( 
				'name' => __('The Quote','iva_theme_admin'),
				'desc' => __('Write your blockquote in above textarea.','iva_theme_admin'),
				'id' => $prefix.'postformatmetabox-quote',
				'class'	=> 'postformatmetabox-quote',
				'std' => '',
				'type' => 'textarea',
			),

			/**
			 * status
			 */
			array(
				'name' => __('The Status','iva_theme_admin'),
				'desc' => __('Write your status in above textarea.','iva_theme_admin'),
				'id' => $prefix.'status',
				'class'	=> 'postformatmetabox-status',
				'std' => '',
				'type' => 'textarea',
			),
				
			/**
			 * page background
			 */
			array(
				'name'		=> __('Page Background','iva_theme_admin'),
				'desc'		=> __('Upload the image for the page background. This will apply only if the layout is selected as boxed in options panel','iva_theme_admin'),
				'id'		=> 'page_bg_image',
				'std'		=> '',
				'type'		=> 'upload',
			),
			/**
			 * subheader content alignment
			 */
			array( 'name'  	=> 'Subheader Alignment',
				'desc'   	=> __('Select subheader content alignment. Choose between 1, 2 or 3 position layout.','iva_theme_admin'),
				'id' 		=> $prefix.'sub_styling',
				'std' 		=> $pagetitle_align,
				'type'   	=> 'layout',
				'options'  	=> array(
					'left'   =>  FRAMEWORK_URI . 'admin/images/columns/sh-left.png', 
					'center' =>  FRAMEWORK_URI . 'admin/images/columns/sh-center.png',
					'right'  =>  FRAMEWORK_URI . 'admin/images/columns/sh-right.png')
			),
			/**
			 * subheader options 
			 */
			array(
				'name'		=> __('Subheader Options','iva_theme_admin'),
				'desc'		=> __('Select the Teaser type you wish to display in subheader of the this Post/Page','iva_theme_admin'),
				'id'		=> $prefix . 'subheader_teaser_options',
				'std'		=> '',
				'type'		=> 'select',
				'class'		=> 'select300',
				'options'	=> array(
							'default'		=> 'Default ( Options Panel )',
							'twitter'		=> 'Twitter', 	
							'customtitle'	=> 'Custom', 
							'disable'		=> 'Disable')
			),
			/**
			 * subheader twitter username
			 */
			array(
				'name'		=> __('Twitter Username','iva_theme_admin'),
				'desc'		=> __('Enter the username to display the twitter feed','iva_theme_admin'),
				'id'		=> 'iva_twitter_username',
				'class'		=> 'sub_teaser_option twitter',
				'std'		=> '',
				'type'		=> 'text',
			),

			/**
			 * subheader custom title
			 */
			array(
				'name'		=> __('Subheader Custom Title','iva_theme_admin'),
				'desc'		=> __('Type the custom text you wish to display in the subheader of this page/post. If you wish to use bold text then use strong element example &lt;strong&gt;bold text &lt;/strong&gt;','iva_theme_admin'),
				'id'		=> 'page_title',
				'class'		=> 'sub_teaser_option customtitle',
				'std'		=> '',
				'type'		=> 'text',
			),	


			/**
			 * subheader custom text
			 */
			array(
				'name'		=> __('Subheader Custom Text','iva_theme_admin'),
				'desc'		=> __('Type the custom text you wish to display in the subheader of this page/post. If you wish to use bold text then use strong element example &lt;strong&gt;bold text &lt;/strong&gt;','iva_theme_admin'),
				'id'		=> 'page_desc',
				'class'		=> 'sub_teaser_option customtitle',
				'std'		=> '',
				'type'		=> 'textarea',
			),
			/**
			 * subheader background
			 */
			array(
				'name'		=> __('Subheader Background','iva_theme_admin'),
				'desc'		=> __('Upload Subheader Image and its properties','iva_theme_admin'),
				'id'		=> $prefix.'subheader_img',
				'type'		=> 'background',
				'std' 		=> '',
				'options'	=> array(
							'image'		=> '',
							'color'		=> '',
							'repeat' 	=> 'repeat',
							'position'	=> 'center top',
							'attachment'=> 'scroll'
				),
			),
			/**
			 * subheader text color
			 */
			array(
				'name'		=> __('Subheader Text Color','iva_theme_admin'),
				'desc'		=> __('Select the color for the content in the subheader','iva_theme_admin'),
				'id'		=> $prefix.'sh_txtcolor',
				'std'		=> '',
				'type'		=> 'color',
			),
			/**
			 * subheader padding
			 */
			array(
				'name'		=> __('Subheader Padding','iva_theme_admin'),
				'desc'		=> __('Enter the padding for the subheader area. Padding should be in the following format - 20px 0 20px 0 - directions are Top Right Bottom Left.','iva_theme_admin'),
				'id'		=> $prefix.'sh_padding',
				'std'		=> '',
				'type'		=> 'text',
			),
			/**
			 * sidebar position
			 */
			array(
				'name'		=> __('Sidebar Position','iva_theme_admin'),
				'desc'		=> __('Select the sidebar position you wish to use for this page, Left Sidebar or Right Sidebar or Full Width.','iva_theme_admin'),
				'id'		=> $prefix . 'sidebar_options',
				'std'		=> $iva_sidebar_layout,
				'type'		=> 'layout',
				'options'	=> array(
						'rightsidebar'	=>  FRAMEWORK_URI . 'admin/images/right-sidebar.png', 
						'leftsidebar'	=>  FRAMEWORK_URI . 'admin/images/left-sidebar.png',
						'fullwidth'		=>  FRAMEWORK_URI . 'admin/images/fullwidth.png')	
			),
			/**
			 * custom sidebar
			 */
			array(
				'name'		=> __('Custom Sidebar','iva_theme_admin'),
				'desc' 		=> __('Select the Sidebar you wish to assign for this page.','iva_theme_admin'),
				'id' 		=> $prefix . 'custom_widget',
				'type' 		=> 'customselect',
				'class'		=> 'select300',
				'std' 		=> '',
				'options'	=> $iva_sidebarwidget
			),
			/**
			 * breadcrumb
			 */
			array(
				'name'		=> __('Breadcrumb','iva_theme_admin'),
				'desc'		=> __('Check this if you wish to disable the breadcrumb for this page.','iva_theme_admin'),
				'id'		=> $prefix.'breadcrumb',
				'std' 		=> 'off',
				'type'		=> 'checkbox',
			),
		)
	);
?>