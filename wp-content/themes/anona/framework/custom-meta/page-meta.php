<?php
	/**
	 * page metabox
	 */
	$prefix = '';
	$this->meta_box = array();
	/**
	 * defines custom sidebar widget based on custom option
	 */
	$iva_sidebar_widget  = get_option('atp_customsidebar');
	$iva_pagetitle_align = get_option('atp_sub_styling');
	$iva_sidebar_layout  = get_option('atp_defaultlayout');

	$this->meta_box[] = array(
		'id'		=> 'page-meta-box',
		'title'		=> '&nbsp;Page Options',
		'context'	=> 'normal',
		'page'		=> array('page'),
		'priority'	=> 'core',
		'fields'	=> array(

			/**
			 * Page Slider
			 */
			array(
				'name'	=> __('Page Slider','iva_theme_admin'),
				'desc'	=> __('Select the Slider you wish to use for the this page. Make sure you add the slide posts','iva_theme_admin'),
				'id'	=> $prefix . 'page_slider',
				'std'	=> '',
				'class' => 'select300',
				'type'	=> 'select',
				'options'=> $this->atp_variable('slider_type')
			),
			array(
				'name'	=> __('FlexSlider Category','iva_theme_admin'),
					'desc'	=> __('Select Slider Category to hold the posts from.','iva_theme_admin'),
					'id'	=> $prefix.'flexslidercat',
					'class' => 'page_slider flexslider',
					'std'	=> '',
					'options' => $this->atp_variable('slider'),
					'type'	=> 'multiselect'
			),
			array(
				'name'	=> __('Static Image','iva_theme_admin'),
					'desc'	=> __('Upload Image.','iva_theme_admin'),
					'id'	=> $prefix.'staticimage',
					'class' => 'page_slider static_image',
					'std'	=> '',
					'type'	=> 'upload'
			),
			array(
				'name'	=> __('Image Link','iva_theme_admin'),
					'desc'	=> __('Enter Image Link for the Static Slider Image (Optional)','iva_theme_admin'),
					'id'	=> $prefix.'cimage_link',
					'class' => 'page_slider static_image',
					'std'	=> '',
					'type'	=> 'text'
			),
			array(
				'name'	=> __('Custom Slider','iva_theme_admin'),
					'desc'	=> __('Use in Your custom slider Plugin shortcodes Example:[revslider id="1"].','iva_theme_admin'),
					'id'	=> $prefix.'customslider',
					'class' => 'page_slider customslider',
					'std'	=> '',
					'type'	=> 'textarea'
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
				'std' 		=> $iva_pagetitle_align,
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
						'fullwidth'		=>  FRAMEWORK_URI . 'admin/images/fullwidth.png'
						)	
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
				'options'	=> $iva_sidebar_widget
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