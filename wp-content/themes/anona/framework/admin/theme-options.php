<?php
add_action('init','atp_options');
// Get theme version from style.css
	
	if ( !function_exists( 'atp_options' ) ) {
		$iva_of_options = array();
		function atp_options(){
		global $iva_of_options,$shortname,$atp_theme ;
			//More Options
			$uploads_arr = wp_upload_dir();
			$all_uploads_path = $uploads_arr['path'];
			$all_uploads = get_option('atp_uploads');
	
			$iva_colors = array();
			if(is_dir(THEME_DIR . "/colors/")) {
				if($style_dirs = opendir(THEME_DIR . "/colors/")) {
					while(($color = readdir($style_dirs)) !== false) {
						if(stristr($color, ".css") !== false) {
							$iva_colors[$color] = $color;
						}
					}
				}
			}
			$iva_colors_select = $iva_colors;
			array_unshift($iva_colors_select,'Default Color');

			$iva_fontface = array(
				' ' 									=> 'Select a font',
				'Arial'									=> 'Arial',
				'Verdana'								=> 'Verdana',
				'Tahoma'								=> 'Tahoma',
				'Sans-serif'							=> 'Sans-serif',
				'Lucida Grande'							=> 'Lucida Grande',
				'Georgia,serif'							=> 'Georgia',
				'Trebuchet MS,Tahoma,sans-serif'		=> 'Trebuchet',
				'Times New Roman,Geneva,sans-serif'		=> 'Times New Roman',
				'Palatino,Palatino Linotyp,serif'		=> 'Palatino',
				'Helvetica Neue,Helvetica,sans-serif'	=> 'Helvetica'
			);


					
			// GENERAL 
			//-----------------------------------------------------------------------------------------------
			$iva_of_options[] = array( 'name' => 'General','icon' => ADMIN_URI.'/images/cog-icon.png','type' => 'heading');
			//-----------------------------------------------------------------------------------------------
			
				$iva_of_options[] = array(  
										'name'	=> 'One Click Demo Content - w-p-l-o-c-k-e-r-.-c-o-m',
										'desc'	=> 'This will import the following content from a WordPress export file included in package:<br>
File Location : theme/framework/admin/iva-importer/data<br>
<br>
&bull;Posts, pages and other custom post types<br>
&bull;Comments<br>
&bull;Custom fields and post meta<br>
&bull;Categories, tags and terms from custom taxonomies<br>
&bull;Authors<br>

										',
										'id'	=> $shortname.'_importdata',
										"std" 	=> '',
										'class' => 'atp-importdata',
										'type'	=> 'importsampledata'
									); 
			 		
				$iva_of_options[] = array( 'name'	=> 'Custom Logo',
									'desc'	=> 'Select the Logo style you wish to use title or image.',
									'id'	=> $shortname.'_logo',
									'std'	=> 'title',
									'class' => 'select300',
									'options' => array( 'title' => 'Title', 'logo' => 'Logo',),
									'type'	=> 'select'
									);

				$iva_of_options[] = array( 'name'	=> 'Logo Image',
									'desc'	=> 'Upload a logo for your theme, or specify the image url of your online logo. (http://yoursite.com/logo.png)',
									'id'	=> $shortname.'_header_logo',
									'std'	=> '',
									'class' => 'atplogo logo',
									'type'	=> 'upload'
									);
				$iva_of_options[] = array( 'name'	=> 'Admin Login Logo',
									'desc'	=> 'Upload a logo for your wordpress admin area which displays only when the login screen appears.',
									'id'	=> $shortname.'_admin_logo',
									'std'	=> '',
									'class' => 'atplogo logo',
									'type'	=> 'upload'
									);
				$iva_of_options[] = array(	'name'	=> 'Site Title',
									'desc'	=> 'Site Title Color Properties',
									'id'	=> $shortname.'_logotitle',
									'std'	=> array('size' => '', 'lineheight' => '', 'style' => '', 'fontvariant' =>''),
									'class' => 'atplogo title',
									'type'	=> 'typography'
									);
				$iva_of_options[] = array(	'name'	=> 'Site Description',
									'desc'	=> 'Site Description Color and properties',
									'id'	=> $shortname.'_tagline',
									'std'	=> array('size' => '', 'lineheight' => '', 'style' => '', 'fontvariant' =>''),
									'class' => 'atplogo title',
									'type'	=> 'typography'
									);
				$iva_of_options[] = array( 'name'	=> 'Custom Favicon',
									'desc'	=> 'Upload a 16px x 16px ICO icon format that will represent your website favicon.',
									'id'	=> $shortname.'_custom_favicon',
									'std'	=> '',
									'type'	=> 'upload'
									); 
				$iva_of_options[] = array( 'name' 	=> 'Subheader Content Alignment',
									'desc'	=> 'Select subheader content alignment. Choose between 1, 2 or 3 position layout.',
									'id'	=> $shortname.'_sub_styling',
									'std'	=> 'left',
									'type'  	=> 'images',
									'options' 	=> array(
										   'left'   =>  FRAMEWORK_URI . 'admin/images/columns/sh-left.png', 
										   'center' =>  FRAMEWORK_URI . 'admin/images/columns/sh-center.png',
										   'right'  =>  FRAMEWORK_URI . 'admin/images/columns/sh-right.png')
									);
				$iva_of_options[] = array( 'name'	=> 'Subheader Teaser',
									'desc'	=> 'Teaser call out for the subheader section of the theme.',
									'id'	=> $shortname.'_teaser',
									'std'	=> 'default',
									'class' => 'select300',
									'options' => array( 
											'default'	=> 'Default (post title)',
											'twitter'   => 'Twitter Tweets',
											'disable'	=> 'Disable Subheader'),
									'type'	=> 'select'
									);
				$iva_of_options[] = array( 'name'	=> 'Breadcrumbs',
									'desc'	=> 'Check this if you wish to disable the breadcrumbs for the theme which appears in the subheader. If you wish to disable the breadcrumb for a specific page then go to edit page and select option in from there.',
									'id'  	=> $shortname.'_breadcrumbs',
									'std' 	=> 'true',
									'type' 	=> 'checkbox'
									);	
				$iva_of_options[] = array( 'name'	=> 'Testimonial Fade Speed',
									'desc'	=> 'Integer: Set the speed of Testimonial fade animations, in milliseconds. 1000 = 1 second',
									'id'  	=> $shortname.'_tm_speed',
									'std' 	=> '',
									'inputsize' => '',
									'type'	=> 'text'
									);
				$iva_of_options[] = array( 'name'	=> 'Slider Single Page Slug',
									'desc'	=> 'For example if you enter "my-slider" the link to the post will display as <strong>/my-slider/post-name</strong><br/><br/>Do not use this same slug anywere else on your website.',
									'id'	=> $shortname.'_sliderslug',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> ''
									);
				$iva_of_options[] = array( 'name'	=> 'Testimonial Single Page Slug',
									'desc'	=> 'For example if you enter "my-clients" the link to the post will display as <strong>/my-clients/post-name</strong><br/><br/>Do not use this same slug anywere else on your website.',
									'id'	=> $shortname.'_testimonialslug',
									'std'	=> '',    
									'type'	=> 'text',
									'inputsize'=> ''
									);
				$iva_of_options[] = array( 'name'	=> 'Date Format',
									'desc'	=> 'This date format is used only for jQuery DatePicker whick appears in Appointment form calender',
									'id'	=> $shortname.'_date_format',
									'std'	=> '',
									'type'	=> 'select',
									'class'	=> 'select300',
									'options'	=> array(
														'Y/m/d'  => date("Y/m/d"),
														'm/d/Y'  => date("m/d/Y"),
														'd-m-Y'  => date("d-m-Y"),
												 	),
				);
				

			// TWITER 
			//---------------------------------------------------------------------------------------------------
			$iva_of_options[] = array( 'name' => 'Twitter API','icon' => ADMIN_URI.'/images/twitter-icon.png','type' => 'heading');
			//---------------------------------------------------------------------------------------------------

				$iva_of_options[] = array( 'name'	=> 'Twitter Username',
									'desc'	=> 'Enter Twitter username to display tweets in subheader area of the theme. <br>You will need to visit <a href="https://dev.twitter.com/apps/" target="_blank">https://dev.twitter.com/apps/</a>, sign in with your account and create your own keys.',
									'id'	=> $shortname.'_teaser_twitter',
									'std'	=> '',
									'inputsize' => '300',
									'type'	=> 'text'
									);
				$iva_of_options[] = array( "name"	=> "Twitter API key",
									"desc"	=> "Twitter Consumer key",
									"id"	=> $shortname."_consumerkey",
									'inputsize' => '300',
									"std"	=> "",
									"type"	=> "text");
				$iva_of_options[] = array( "name"	=> "Twitter API secret",
									"desc"	=> "Twitter Consumer secret",
									"id"	=> $shortname."_consumersecret",
									'inputsize' => '300',
									"std"	=> "",
									"type"	=> "text");
				$iva_of_options[] = array( "name"	=> "Twitter Access token",
									"desc"	=> "Twitter Access token",
									"id"	=> $shortname."_accesstoken",
									'inputsize' => '300',
									"std"	=> "",
									"type"	=> "text");
				$iva_of_options[] = array( "name"	=> "Twitter Token secret",
									"desc"	=> "Twitter Access secret",
									"id"	=> $shortname."_accesstokensecret",
									'inputsize' => '300',
									"std"	=> "",
									"type"	=> "text");
										
			// HEADER STYLE #########################################################################################
			//---------------------------------------------------------------------------------------------------
			$iva_of_options[] = array( 'name' => 'Headers','icon' => ADMIN_URI.'/images/header-icon.png','type' => 'heading');
			//---------------------------------------------------------------------------------------------------
				
						$iva_of_options[] = array( "name"	=> "Header Style",
												"desc"	=> 'Select the style you wish to choose for the Header.',
												"id"	=> $shortname."_headerstyle",
												"std"	=> "",
												'class' => 'select300',
												"options" => array(
													'' => 'Choose Header Style',
													'headerstyle1' => 'Header Style1',
													'headerstyle2' => 'Header Style2',
													'headerstyle3' => 'Header Style3',
													'fixedheader'  => 'Fixed Header',
													),
												"type"	=> "select");

						$iva_of_options[] = array(	'name'	=> 'Header Background Properties',
											'desc'	=> 'Select the Background Image for Header and assign its Properties according to your requirements.',
											'id'	=> $shortname.'_headerproperties',
											'std'	=> array(
															'image'		=> '',
															'color'		=> '',
															'style' 	=> 'repeat',
															'position'	=> 'center top',
															'attachment'=> 'scroll'),
											'type'	=> 'background');

				
						$iva_of_options[] = array( "name"	=> "Topbar Background Color",
											"desc"	=> "This will apply the background color to the topbar.",
											"id"	=> $shortname."_topbar_bgcolor",
											"std"	=> "",
											"type"	=> "color");

						$iva_of_options[] = array(	'name'	=> 'Topbar Text Color',
												'desc'	=> 'This will apply text color to the topbar',
												'id'	=> $shortname.'_topbar_text',
												'std'	=> '', 
												'type'	=> 'color');

						$iva_of_options[] = array(	'name'	=> 'Topbar Link Color',
												'desc'	=> 'This will apply link color in the topbar.',
												'id'	=> $shortname.'_topbar_link',
												'std'	=> '', 
												'type'	=> 'color');

						$iva_of_options[] = array( "name"	=> "Top Bar",
											"desc"	=> 'Check this if you wish to disable the Top Bar.',
											"id"	=> $shortname."_topbar",
											"std"	=> "",
											"type"	=> "checkbox");

			// COLORS ###########################################################################################
			//---------------------------------------------------------------------------------------------------
			$iva_of_options[] = array( 'name' => 'Styling', 'icon' => ADMIN_URI.'/images/colors-icon.png','type' => 'heading');
			//---------------------------------------------------------------------------------------------------
			
						//---------------------------------------------------------------------------------------------------
						$iva_of_options[] = array( 'name'	=> 'General Elements', 'type' => 'subnav');
						//---------------------------------------------------------------------------------------------------

						$iva_of_options[] = array( 'name' 		=> 'Layout Option',
											'desc'	=> 'Select the layout option BOXED/STRETCHED',
											'id'	=> $shortname.'_layoutoption',
											'std' 		=> 'stretched',
											'type'  	=> 'images',
											'class' => 'select300',
											'options' 	=> array(
												   'stretched' 	=>  FRAMEWORK_URI . 'admin/images/columns/stretched.png',
												   'boxed'  	=>  FRAMEWORK_URI . 'admin/images/columns/boxed.png')
											);			
						
						$iva_of_options[] =array(	'name'	=> 'Colors',
											'desc'	=> 'Select your themes alternative color scheme for this Theme Current theme has no extra custom made skins',
											'id'	=> $shortname.'_style',
											'std'	=> '', 
											'class' => 'select300',
											'options'=> $iva_colors_select,
											'type'	=> 'select');


						$iva_of_options[] = array(	'name'	=> 'Theme Color',
											'desc'	=> 'Theme Color set to default with theme if you choose color from here it will change all the links and backgrounds used in the theme.',									
											'id'	=> $shortname.'_themecolor',
											'std'	=> '', 
											'type'	=> 'color');


						$iva_of_options[] = array(	'name'	=> 'Body Background Properties',
											'desc'	=> 'Select the Background Image for Body and assign its Properties according to your requirements.',
											'id'	=> $shortname.'_bodyproperties',
											'std'	=> array(
															'image'		=> '',
															'color'		=> '',
															'style' 	=> '',
															'position'	=> '',
															'attachment'=> ''),
											'type'	=> 'background');
			
						$iva_of_options[] = array( 'name' => 'Background Pattern Images',
											'desc' => 'Patter overlay on the body background color or image, displays on if the layout is selected as boxed in General Options Panel',
											'id'   => $shortname.'_overlayimages',
											'std'  => '',
											'type' => 'images',
											'options' => array(
															''			 => THEME_URI . '/images/patterns/no-pat.png',
															'pat_01.png' => THEME_URI . '/images/patterns/pattern-1-Preview.jpg',
															'pat_02.png' => THEME_URI . '/images/patterns/pattern-2-Preview.jpg',
															'pat_03.png' => THEME_URI . '/images/patterns/pattern-3-Preview.jpg',
															'pat_04.png' => THEME_URI . '/images/patterns/pattern-4-Preview.jpg',
															'pat_05.png' => THEME_URI . '/images/patterns/pattern-5-Preview.jpg',
															'pat_06.png' => THEME_URI . '/images/patterns/pattern-6-Preview.jpg',
															'pat_07.png' => THEME_URI . '/images/patterns/pattern-7-Preview.jpg',
															'pat_08.png' => THEME_URI . '/images/patterns/pattern-8-Preview.jpg',
														),
													);
					

						$iva_of_options[] = array(	'name'	=> 'Subheader Background Properties',
											'desc'	=> 'Select the Background Image for Subheader and assign its Properties according to your requirements.',
											'id'	=> $shortname.'_subheaderproperties',
											'std'	=> array(
															'image'		=> '',
															'color'		=> '',
															'style' 	=> 'repeat',
															'position'	=> 'center top',
															'attachment'=> 'scroll'),
											'type'	=> 'background');

						$iva_of_options[] = array(	'name'	=> 'Footer Background',
											'desc'	=> 'Footer background properties includes the sidebar footer widgets area as well. If you wish to disable footer area you can go to Footer Tab and do that..',
											'id'	=> $shortname.'_footerbg',
											'std'	=> array(
															'image'		=> '',
															'color'		=> '',
															'style' 	=> 'repeat',
															'position'	=> 'center top',
															'attachment'=> 'scroll'),
											'type'	=> 'background');

						$iva_of_options[] = array(	'name'	=> 'Subheader',
											'desc'	=> 'Subheader Text Color',
											'id'	=> $shortname.'_subheader_textcolor',
											'std'	=> '', 
											'type'	=> 'color');

						$iva_of_options[] = array(	'name'	=> 'Content Area Background Color',
											'desc'	=> 'This will apply color to the primary content area of theme.',
											'id'	=> $shortname.'_wrapbg',
											'std'	=> '', 
											'type'	=> 'color');

						$iva_of_options[] = array(	'name'	=> 'Breadcrumb',
											'desc'	=> 'Breadcrumb Text Color.',
											'id'	=> $shortname.'_breadcrumbtext',
											'std'	=> '', 
											'type'	=> 'color');
	
						//---------------------------------------------------------------------------------------------------
						$iva_of_options[] = array( 'name' => 'Menu', 'type' => 'subnav');
						//---------------------------------------------------------------------------------------------------

						$iva_of_options[] = array( 'name'  => 'Menu Background',
											'desc'  => 'This applies the background color for Header Style2 and Header Styl3 only .',
											'id'    => $shortname.'_mmenu',
											'std'   => '', 
											'type'  => 'color');			

						$iva_of_options[] = array(	'name'	=> 'Menu Font and Link Color',
											'desc'	=> 'Select the Color and Font Properties for Menu Parent Lists.',
											'id'	=> $shortname.'_topmenu',
											'std'	=> array(
															'size' 		=> '',
															'lineheight'=> '',
															'fontvariant' => '',
															'style' 	=> '',
															'color' 	=> ''),
											'type'	=> 'typography');
						
						$iva_of_options[] = array( 'name'  => 'Menu Hover BG',
											'desc'  => 'Select the Color for Menu Hover BG.',
											'id'    => $shortname.'_topmenu_hoverbg',
											'std'   => '', 
											'type'  => 'color');			
										
						$iva_of_options[] = array(	'name'	=> 'Menu Hover Text',
											'desc'	=> 'Select the Color for Menu Hover Text.',
											'id'	=> $shortname.'_topmenu_linkhover',
											'std'	=> '', 
											'type'	=> 'color');

						$iva_of_options[] = array(	'name'	=> 'Menu Dropdown Background Color',
											'desc'	=> 'Select the Color for Dropdown Menu Background Color',
											'id'	=> $shortname.'_topmenu_sub_bg',
											'std'	=> '', 
											'type'	=> 'color');

						$iva_of_options[] = array(	'name'	=> 'Menu Dropdown Text Color',
											'desc'	=> 'Select the Color for Dropdown Menu Text Color',
											'id'	=> $shortname.'_topmenu_sub_link',
											'std'	=> '', 
											'type'	=> 'color');
			
						$iva_of_options[] = array(	'name'	=> 'Menu Dropdown Text Hover Color',
											'desc'	=> 'Select the Color for Dropdown Menu Text Hover Color',
											'id'	=> $shortname.'_topmenu_sub_linkhover',
											'std'	=> '', 
											'type'	=> 'color');

						$iva_of_options[] = array(	'name'	=> 'Menu Dropdown Hover Background Color',
											'desc'	=> 'Select the Color for Dropdown Menu Hover Background Color',
											'id'	=> $shortname.'_topmenu_sub_hoverbg',
											'std'	=> '', 
											'type'	=> 'color');

						$iva_of_options[] = array(	'name'	=> 'Menu Active Link Color',
											'desc'	=> 'Select the Color for Active Link Color',
											'id'	=> $shortname.'_topmenu_active_link',
											'std'	=> '', 
											'type'	=> 'color');

						$iva_of_options[] = array(	'name'	=> 'Menu Dropdown Border Color',
											'desc'	=> 'Select the Color for Menu Dropdown Border Color',
											'id'	=> $shortname.'_menu_dropdown_border_color',
											'std'	=> '', 
											'type'	=> 'color');

						//---------------------------------------------------------------------------------------------------
						$iva_of_options[] = array( 'name' => 'Link Colors', 'type' => 'subnav');
						//---------------------------------------------------------------------------------------------------

						$iva_of_options[] = array(	'name'	=> 'Link Color',
											'desc'	=> 'Select the Color for Theme links',
											'id'	=> $shortname.'_link',
											'std'	=> '', 
											'type'	=> 'color');
				
						$iva_of_options[] = array(	'name'	=> 'Link Hover Color',
											'desc'	=> 'Select the Color for Theme links hover',
											'id'	=> $shortname.'_linkhover',
											'std'	=> '', 
											'type'	=> 'color');
				
						$iva_of_options[] = array(	'name'	=> 'Subheader Link Color',
											'desc'	=> 'Links under subheader section',
											'id'	=> $shortname.'_subheaderlink',
											'std'	=> '', 
											'type'	=> 'color');

						$iva_of_options[] = array(	'name'	=> 'Subheader Link Hover Color',
											'desc'	=> 'Links Hover under subheader section',
											'id'	=> $shortname.'_subheaderlinkhover',
											'std'	=> '', 
											'type'	=> 'color');

						$iva_of_options[] = array(	'name'	=> 'Footer Link Color',
											'desc'	=> 'Footer containing links under widget or text widget, (link color).',
											'id'	=> $shortname.'_footerlinkcolor',
											'std'	=> '', 
											'type'	=> 'color');
				
						$iva_of_options[] = array(	'name'	=> 'Footer Link Hover Color',
											'desc'	=> 'Footer content containing any links under widget or text widget, (link hover color).',
											'id'	=> $shortname.'_footerlinkhovercolor',
											'std'	=> '', 
											'type'	=> 'color');

						$iva_of_options[] = array(	'name'	=> 'Copyright Link Color',
											'desc'	=> 'Copyright content containing any links color. (link color).',
											'id'	=> $shortname.'_copylinkcolor',
											'std'	=> '', 
											'type'	=> 'color');

						//---------------------------------------------------------------------------------------------------
						$iva_of_options[] = array( 'name'	=> 'Typography', 'type' => 'subnav');
						//---------------------------------------------------------------------------------------------------
						//---------------------------------------------------------------------------------------------------
						$iva_of_options[] = array( 'name'	=> 'Google Font', 'desc' => '<br>Select the fonts you wish to use for the website fonts or google webfonts. If you select the headings font it will replace all the heading font family for the whole theme including footer and sidebar widget titles.', 'type' => 'subsection');
						//---------------------------------------------------------------------------------------------------
						
						$iva_of_options[] = array( 
												'name' 		=> 'Body Font Family',
												'desc' 		=> 'Select a font family for body content',
												'id' 		=>  $shortname.'bodyfont',
												'class'		=> '',
												'preview' 	=>  array(
																	'text' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s',
																	'size' => '13px'
																),
												'options' 	=> $iva_fontface,
												'type' 		=> 'atpfontfamily'
											);

						$iva_of_options[] = array( 
												'name' 		=> 'Headings Font Family',
												'desc' 		=> 'Select a font family for Headings ( h1, h2, h3, h4, h5, h6 )',
												'id' 		=> $shortname.'_headings',
												'class'		=> '',
												'preview' 	=>	array(
																	'text' => 'This is font preview text!',
																	'size' => '25px'
																),
												'options' 	=> $iva_fontface,
												'type' 		=> 'atpfontfamily'
											);
											
						$iva_of_options[] = array( 
												'name' 		=> 'Menu Font Family',
												'desc' 		=> 'Select a font family for Top Navigation Menu',
												'id' 		=>  $shortname.'_mainmenufont',
												'class'		=> '',
												'preview' 	=>  array(
																	'text' => 'This is font preview text!',
																	'size' => '25px'
																),
												'options'	=> $iva_fontface,
												'type' 		=> 'atpfontfamily'
											);

						$iva_of_options[] = array( 
												'name' 		=> 'CountDown Font Family',
												'desc' 		=> 'Select a font for the CountDown Shortcode',
												'id' 		=>  $shortname.'_countdown_font',
												'class'		=> '',
												'preview' 	=>  array(
																	'text' => '0123456789 - DAYS - MONTHS - MIN - SECS',
																	'size' => '25px'
																),
												'options'	=> $iva_fontface,
												'type' 		=> 'atpfontfamily'
											);

						//---------------------------------------------------------------------------------------------------
						$iva_of_options[] = array( 'name'	=> 'Various Font Properties', 'desc' => '<br>Select the front properties like font size, line-height, font-style and font-weight for various elements used in the theme.', 'type' => 'subsection');
						//---------------------------------------------------------------------------------------------------										

						$iva_of_options[] = array(	'name'	=> 'Body',
											'desc'	=> 'Select the Color and Font Properties for Body Font.',
											'id'	=> $shortname.'_bodyp',
											'std'	=> array(
															'color'		=> '',
															'size'		=> '',	
															'lineheight'=> '',
															'style'		=> '',
															'fontvariant' => ''),
											'type'	=> 'typography');


						$iva_of_options[] = array(	'name'	=> 'H1',
											'desc'	=> 'Select the Color and Font Properties for H1 Heading.',
											'id'	=> $shortname.'_h1',
											'std'	=> array(
															'color'		=> '',
															'size' 		=> '',
															'lineheight'=> '',
															'style' 	=> '',
															'fontvariant' => ''),
											'type'	=> 'typography');

						$iva_of_options[] = array(	'name'	=> 'H2',
											'desc'	=> 'Select the Color and Font Properties for H2 Heading.',
											'id'	=> $shortname.'_h2',
											'std'	=> array(
															'color'		=> '',
															'size' 		=> '',
															'lineheight'=> '',
															'style'		=> '',
															'fontvariant' => ''),
											'type'	=> 'typography');

						$iva_of_options[] = array(	'name'	=> 'H3',
											'desc'	=> 'Select the Color and Font Properties for H3 Heading.',
											'id'	=> $shortname.'_h3',
											'std'	=> array(
															'color'		=> '',
															'size' 		=> '',
															'lineheight'=> '',
															'style' 	=> '',
															'fontvariant' => ''),
											'type'	=> 'typography');

						$iva_of_options[] = array(	'name'	=> 'H4',
											'desc'	=> 'Select the Color and Font Properties for H4 Heading.',
											'id'	=> $shortname.'_h4',
											'std'	=> array(
															'color'		=> '',
															'size' 		=> '',
															'lineheight'=> '',
															'style' 	=> '',
															'fontvariant' => ''),
											'type'	=> 'typography');

						$iva_of_options[] = array(	'name'	=> 'H5',
											'desc'	=> 'Select the Color and Font Properties for H5 Heading.',
											'id'	=> $shortname.'_h5',
											'std'	=> array(
															'color'		=> '',
															'size'		=> '',
															'lineheight'=> '',
															'style'		=> '',
															'fontvariant' => ''),
											'type'	=> 'typography');

						$iva_of_options[] = array(	'name'	=> 'H6',
											'desc'	=> 'Select the Color and Font Properties for H6 Heading.',
											'id'	=> $shortname.'_h6',
											'std'	=> array(
															'color'		=> '',
															'size'		=> '',
															'lineheight'=> '',
															'style'		=> '',
															'fontvariant' => ''),
											'type'	=> 'typography');

						$iva_of_options[] = array(	'name'	=> 'Sidebar Widget Titles',
											'desc'	=> 'Select the Color and Font Properties for sidebar Widget Titles.',
											'id'	=> $shortname.'_sidebartitle',
											'std'	=> array(
															'color'		=> '',
															'size'		=> '',
															'lineheight'=> '',
															'style'		=> '',
															'fontvariant' => ''),
											'type'	=> 'typography');

						$iva_of_options[] = array(	'name'	=> 'Footer Widget Titles',
											'desc'	=> 'Select the Color and Font Properties for Footer Widget Titles.',
											'id'	=> $shortname.'_footertitle',
											'std'	=> array(
															'color'		=> '',
															'size'		=> '',
															'lineheight'=> '',
															'style'		=> '',
															'fontvariant' => ''),
											'type'	=> 'typography');

		
						$iva_of_options[] = array(	'name'	=> 'Footer Text',
											'desc'	=> 'Select the Color &amp; Font Properties for Footer Section',
											'id'	=> $shortname.'_footertext',
											'std'	=> array(
															'color'		=> '',
															'size'		=> '',
															'lineheight'=> '',
															'style'		=> '',
															'fontvariant' => ''),
											'type'	=> 'typography');

						$iva_of_options[] = array(	'name'	=> 'Copyright Text',
											'desc'	=> 'Select the Color &amp; Font Properties for Copyright Section.',
											'id'	=> $shortname.'_copyrights',
											'std'	=> array(
															'color'		=> '',
															'size'		=> '',
															'lineheight'=> '',
															'style'		=> '',
															'fontvariant' => ''),
											'type'	=> 'typography');
						//---------------------------------------------------------------------------------------------------
						$iva_of_options[] = array( 'name' => 'Custom Font', 'type' => 'subnav');
						//---------------------------------------------------------------------------------------------------

						$iva_of_options[] = array(	'name'	=> 'Custom Font <strong>.woff</strong>',
											'desc'	=> 'Upload Custom Font .woff.',
											'id'	=> $shortname.'_fontwoff',
											'std'	=> '', 
											'type'	=> 'upload');

						$iva_of_options[] = array(	'name'	=> 'Custom Font <strong>.ttf</strong>',
											'desc'	=> 'Upload Custom Font .ttf',
											'id'	=> $shortname.'_fontttf',
											'std'	=> '', 
											'type'	=> 'upload');

						$iva_of_options[] = array(	'name'	=> 'Custom Font <strong>.svg</strong>',
											'desc'	=> 'Upload Custom Font .svg',
											'id'	=> $shortname.'_fontsvg',
											'std'	=> '', 
											'type'	=> 'upload');

						$iva_of_options[] = array(	'name'	=> 'Custom Font <strong>.eot</strong>',
											'desc'	=> 'Upload Custom Font .eot',
											'id'	=> $shortname.'_fonteot',
											'std'	=> '', 
											'type'	=> 'upload');

						$iva_of_options[] = array(	'name'	=> 'Font Name',
											'desc'	=> 'Enter Font Name Select the name as mentioned in fontface css in the downloaded readme file of your custom font',
											'id'	=> $shortname.'_fontname',
											'std'	=> '', 
											'inputsize' => '300',
											'type'	=> 'text');

						$iva_of_options[] = array(	'name'	=> 'Custom Fonts Headings and class Names',
											'desc'	=> 'Enter your own custom elements to which you want to assign this custom font. Ex: h1,h2,h3, .class1,.class2',
											'id'	=> $shortname.'_fontclass',
											'std'	=> '', 
											'inputsize' => '',
											'type'	=> 'textarea');


						//---------------------------------------------------------------------------------------------------
						$iva_of_options[] = array( 'name' => 'Custom CSS', 'type' => 'subnav');
						//---------------------------------------------------------------------------------------------------

						$iva_of_options[] = array( 'name'	=> 'Custom CSS',
											'desc'	=> 'Quickly add some CSS of your own choice to this theme by adding it in this block.',
											'id'	=> $shortname.'_extracss',
											'std'	=> '',
											'type'	=> 'textarea');
		
			// S L I D E R S
			//------------------------------------------------------------------------
			$iva_of_options[] = array( 'name'	=> 'Sliders',
								'icon'	=> ADMIN_URI.'/images/slider-icon.png',
								'type'	=> 'heading');

					$iva_of_options[]=	array(	'name'	=> 'Frontpage Slider',
										'desc'	=> 'Check this if you wish to disable the Slider',
										'id'	=> $shortname.'_slidervisble',
										'std'	=> '',
										'type'	=> 'checkbox');	

										

					$iva_of_options[] = array( 'name'	=> 'Select Slider Type',
										'desc'	=> 'Select which slider you want to use for the Frontpage of the theme.',
										'id'	=> $shortname.'_slider',
										'std'	=> 'flexslider',
										'class' => 'select300',
										'options' => $atp_theme->atp_variable('slider_type'),
										'type'	=> 'select');

					$iva_of_options[] = array( 'name'	=> 'Slider Category',
										'desc'	=> 'Select Slider Categories to hold the slides from.',
										'id'	=> $shortname.'_flexslidercat',
										'class' => 'atpsliders flexslider',
										'std'	=> 'flexslider',
										'options' => $atp_theme->atp_variable('slider'),
										'type'	=> 'multiselect');

					$iva_of_options[] = array( 'name'	=> 'Slides Limits',
										'desc'	=> 'Enter the limit for Slides you want to hold on the Flex Slider',
										'id'	=> $shortname.'_flexslidelimit',
										'std'	=> '',
										'class' => 'atpsliders flexslider',
										'type'	=> 'text',
										'inputsize' => '');

					$iva_of_options[] = array( 'name'	=> 'Slides Speed',
										'desc'	=> 'Select the slide speed you want to set',
										'id'	=> $shortname.'_flexslidespeed',
										'std'	=> '500',
										'class' => 'atpsliders flexslider',
										'type'	=> 'text',
										'inputsize' => ''
										);

					$iva_of_options[] = array( 'name'	=> 'Slider Effect',
										'desc'	=> 'Select your animation type, "fade" or "slide"',
										'id'	=> $shortname.'_flexslideffect',
										'std'	=> 'flexslider',
										'class' => 'atpsliders flexslider select300',
										'options' => array( 
														'fade'	=> 'Fade',
														'slide'	=> 'Slide'
													),
										'type'	=> 'select');

					$iva_of_options[] = array( 'name'	=> 'Direction Nav',
										'desc'	=> 'Navigation for previous/next arrows',
										'id'	=> $shortname.'_flexslidednav',
										'class' => 'atpsliders flexslider select300',
										'std'	=> '',
										'options' => array( 
														'true'	=> 'True',
														'false'	=> 'False'
													),
										'type'	=> 'select');
										
					$iva_of_options[] = array( 'name'	=> 'Static Image',
										'desc'	=> 'Upload the image size 1920 x 750 pixels to display on the homepage instead of slider.',
										'id'	=> $shortname.'_static_image_upload',
										'std'	=> '',
										'class' => 'atpsliders static_image',
										'type'	=> 'upload');

					$iva_of_options[] = array( 'name'	=> 'Custom Slider',
										'desc'	=> 'Use in Your custom slider Plugin shortcodes Example : [revslider id="1"]',
										'id'	=> $shortname.'_customslider',
										'std'	=> '',
										'class' => 'atpsliders customslider',
										'type'	=> 'textarea',
										'inputsize' => '');
										
			// P O S T   O P T I O N S 
			//------------------------------------------------------------------------
			$iva_of_options[] = array( 'name'	=> 'Post Options',
								'icon'	=> ADMIN_URI.'/images/post-icon.png',
								'type'	=> 'heading');

					$iva_of_options[] = array( 'name'	=> 'Blog Page Categories',
										'desc'	=> 'Selected categories will hold the posts to display in blog page template. ( template : template_blog.php)',
										'id'	=> $shortname.'_blogacats',
										'std'	=> '',
										'type'	=> 'multicheck',
										'options'	=> $atp_theme->atp_variable('categories'));

					$iva_of_options[] = array(	'name'	=> 'About Author',
										'desc'	=> 'Check this if you wish to disable the Author Info in post single page',
										'id'	=> $shortname.'_aboutauthor',
										'std'	=> '',
										'type'	=> 'checkbox');	

					$iva_of_options[] = array(	'name'	=> 'Related Posts - W ` P`L` O`C`K`E`R`.`C`O`M`',
										'desc'	=> 'Check this if you wish to disable the related posts in post single page (based on tags).',
										'id'	=> $shortname.'_relatedposts',
										'std'	=> '',
										'type'	=> 'checkbox');	

					$iva_of_options[] = array(	'name'	=> 'Comments',
										'desc'	=> 'Select where you wish to display comments on posts or pages.',
										'id'	=> $shortname.'_commentstemplate',
										'std'	=> 'fullpage',
										'class'	=> 'select300',
										'options'	=> array(
														'posts'	=> 'Posts Only',
														'pages'	=> 'Pages Only', 
														'both'	=> 'Pages/posts',
														'none'	=> 'None'),
										'type'	=> 'select');

					$iva_of_options[] = array(	'name'	=> 'Post Pagination',
										'desc'	=> 'Check this if you wish to disable <strong>Next / Previous</strong> Post Pagination',
										'id'	=> $shortname.'_singlenavigation',
										'std'	=> '',
										'type'	=> 'checkbox');

					$iva_of_options[] = array(	"name"	=> "Single Page Featured Image",
										"desc"	=> 'Check this if you wish to disable Featured Image on Post Single Page',
										"id"	=> $shortname."_blogfeaturedimg",
										"std"	=> "",
										"type"	=> "checkbox");
		
					$iva_of_options[] = array(	"name"	=> "Blog Post Meta",
										"desc"	=> 'Check this if you wish to disable Meta Data in Blog Posts and Single Page',
										"id"	=> $shortname."_postmeta",
										"std"	=> "",
										"type"	=> "checkbox");

															
			// C U S T O M   S I D E B A R 
			//------------------------------------------------------------------------
			$iva_of_options[] = array( 'name'	=> 'Sidebars',
								'icon'	=> ADMIN_URI.'/images/sidebar-icon.png',
								'type'	=> 'heading');

					$iva_of_options[] = array( 'name'	=> 'Custom Sidebars',
										'desc'	=> 'Create the custom sidebars and go to <strong>Appearance > Widgets</strong> to see the newly sidebar you have created. After assigning the widgets in the prefered sidebar you can assign specific sidebar to specific pages/posts in Options below the wordpress content editor of each page/post.',
										'id'	=> $shortname.'_customsidebar',
										'std'	=> '',
										'type'	=> 'customsidebar');
										
					$iva_of_options[] = array( 'name' 	=> 'Sidebars Layout',
										'desc' 			=> 'Select the Layout style you wish to use for the page, 
															Left Sidebar, Right Sidebar or Full Width.',
										'id' 			=> $shortname.'_defaultlayout',
										'std' 			=> 'rightsidebar',
										'type'  		=> 'images',
										'options' 		=> array(
											   'rightsidebar'	=>  FRAMEWORK_URI . 'admin/images/columns/rightsidebar.png', 
											   'leftsidebar' 	=>  FRAMEWORK_URI . 'admin/images/columns/leftsidebar.png',
											   'fullwidth'  	=>  FRAMEWORK_URI . 'admin/images/columns/fullwidth.png')
										);							

			// F O O T E R 
			//------------------------------------------------------------------------
			$iva_of_options[] = array( 'name'	=> 'Footer',
								'icon'	=> ADMIN_URI.'/images/footer-icon.png',
								'type'	=> 'heading');										

					$iva_of_options[] = array(	'name'	=> 'Footer Sidebar',	
										'desc'	=> 'Check this if you wish to disable the Footer Sidebar',
										'id'	=> $shortname.'_footer_sidebar',
										'std'	=> '',
										'type'	=> 'checkbox');
				
					$iva_of_options[] = array( 'name' => 'Footer Columns',
										'desc' => 'Select the Columns Layout Style from the styles shown to display footer sidebar area. After selecting save the options and go to your <strong>Appearance > Widgets</strong> to assign the widgets in each footer column.',
										'id'   => $shortname.'_footerwidgetcount',
										'std'  => '4',
										'type' => 'images',
										'options' => array(
														'1' => ADMIN_URI.'/images/columns/1col.png',
														'2' => ADMIN_URI.'/images/columns/2col.png',
														'3' => ADMIN_URI.'/images/columns/3col.png',
														'4' => ADMIN_URI.'/images/columns/4col.png',
														'5' => ADMIN_URI.'/images/columns/5col.png',
														'6' => ADMIN_URI.'/images/columns/6col.png',
														'half_one_half'		=> ADMIN_URI.'/images/columns/half_one_half.png',
														'half_one_third'	=> ADMIN_URI.'/images/columns/half_one_third.png',
														'one_half_half'		=> ADMIN_URI.'/images/columns/one_half_half.png',
														'one_third_half'	=> ADMIN_URI.'/images/columns/one_third_half.png')
											);
				
					$iva_of_options[] = array(	'name'	=> 'Copyright Left Content',	
										'desc'	=> 'Enter the content that you wish the display on the copyright Left side',
										'id'	=> $shortname.'_leftcopyright',
										'std'	=> 'Copyright Text Change from theme options panel',
										'type'	=> 'textarea');
					$iva_of_options[] = array(	'name'	=> 'Copyright Right Content',	
									'desc'	=> 'Enter the content that you wish the display on the copyright Right side',
									'id'	=> $shortname.'_rightcopyright',
									'std'	=> 'Copyright Text Change from theme options panel',
									'type'	=> 'textarea');
			
			
			// S O C I A B L E S
			//------------------------------------------------------------------------
				$iva_of_options[] = array( 'name'	=> 'Sociables',
								'icon'	=> ADMIN_URI.'/images/link-icon.png',
								'type'	=> 'heading');

				$iva_of_options[] = array(	'name'	=> 'Sociables',	
										'desc'	=> 'Click Add New to add sociables where you can edit/add/delete.<br> If you want to have a different icon please you icon png or gif file in sociables directory located in theme images directory',
										'id'	=> $shortname.'_social_bookmark',
										'std'	=> '',
										'type'	=> 'custom_socialbook_mark');
			//Sticky Bar
			// -----------------------------------------------------------------------
			
				$iva_of_options[] = array( 'name'	=> 'Sticky Bar',
								'icon'	=> ADMIN_URI.'/images/sticky-icon.png',
								'type'	=> 'heading');
			
				$iva_of_options[] = array( 'name'	=> 'Sticky Notice Bar',
									'desc'	=> 'Check this if you wish to hide the sticky bar on top.',
									'id'	=> $shortname.'_stickybar',
									'std'	=> '',
									'type'	=> 'checkbox');
	
				$iva_of_options[] = array( 'name'	=> 'Sticky Content',
									'desc'	=> 'Enter the content which will be displayed in sticky bar',
									'id'	=> $shortname.'_stickycontent',
									'std'	=> '',
									'type'	=> 'textarea');
									
				$iva_of_options[] = array( 'name'	=> 'Sticky Bar Background Color',
									'desc'	=> 'Select the color you want to assign for the Sticky Bar',
									'id'	=> $shortname.'_stickybarcolor',
									'std'	=> '',
									'type'	=> 'color');
			
				$iva_of_options[] = array( 'name'	=> 'Sticky Bar Text Color',
									'desc'	=> 'Select the text color you want to assign for the Sticky Bar',
									'id'	=> $shortname.'_stickybartext',
									'std'	=> '',
									'type'	=> 'color');
			// L A N G U A G E S
			//------------------------------------------------------------------------
			$iva_of_options[] = array( 'name'	=> 'Localization',
								'icon'	=> ADMIN_URI.'/images/lang-icon.png',
								'type'	=> 'heading');

			$iva_of_options[] = array(	'name'	=> 'Read More',	
								'desc'	=> 'Read more text on sliders and other different areas of the theme',
								'id'	=> $shortname.'_readmoretxt',
								'std'	=> '',
								'type'	=> 'text',
								'inputsize'=> '');

			$iva_of_options[] = array( 'name'	=> 'Post Single Page',
								'desc'	=> 'Custom text displays in subheader of Post Single Page',
								'id'	=> $shortname.'_postsinglepage',
								'std'	=> '',
								'type'	=> 'text',
								'inputsize'=> '');

			$iva_of_options[] = array( 'name'	=> '404 Page',
								'desc'	=> 'Custom text which appears on 404 Error page',
								'id'	=> $shortname.'_error404txt',
								'std'	=> '',
								'type'	=> 'text',
								'inputsize'=> '');

		
										
		/**
		 * Gallery options
		 */
		$iva_of_options[] = array( 'name'	=> 'Gallery',
									'icon'	=> ADMIN_URI.'/images/gallery-icon.png',
									'type'	=> 'heading');

		$iva_of_options[] = array( 'name'	=> 'Select Gallery Properties','type' => 'subsection');
		
			
		$iva_of_options[] = array(
					'name'		=> 'Gallery Orderby',
					'desc'		=> 'Select the orderby  which you want to use  Id ,title,date or menu order in gallery page template. (Default: Date)',
					'id'		=> $shortname.'_gallery_orderby',
					'class'		=> 'select300',
					'std'		=> 'date',
					'type'		=> 'select',
					'inputsize'	=> '',
					'options'	=> array( 
											'' 			    => 'Choose Options',
											'ID' 			=> 'ID',
											'title'			=> 'Title',
											'date' 			=> 'Date',
											'menu_order'	=> 'Menu Order'
										),
		);
		$iva_of_options[] = array(
					'name'			=> 'Gallery Order',
					'desc'			=> 'Select the order which you wish to display in gallery page template',
					'id'			=> $shortname.'_gallery_order',
					'class'			=> 'gallery_order',
					'std'			=> 'DESC',
					'type'			=> 'radio',
					'inputsize'		=> '',
					'options'		=> array( 
											'ASC' 			=> 'Ascending',
											'DESC'			=> 'Descending'
										),
		);
		$iva_of_options[] = array(
					'name'			=> 'Comments Enable/Disable',
					'desc'			=> 'Check this if you wish to Enable/Disable ( Default: Disable ).',
					'id'			=> $shortname.'_gallery_comments',
					'class'			=> '',
					'std'			=> 'disable',
					'options'		=> array('enable' => 'Enable','disable' => 'Disable'),
					'type'			=> 'radio',
		);
		$iva_of_options[] = array(
					'name'			=> 'Gallery Pagination',
					'desc'			=> 'Check this if you wish to Enable/Disable ( Default: Disable ) the pagination in gallery template page.',
					'id'			=> $shortname.'_gallery_pagination',
					'class'			=> '',
					'std'			=> '',
					'type'			=> 'checkbox',
		);
		$iva_of_options[] = array(
					'name'			=> 'Gallery Limits',
					'desc'			=> 'Type the limits for gallery you wish to limit on the gallery page. (Example: 5)',
					'id'			=> $shortname.'_gallery_limits',
					'class'			=> '',
					'std'			=> '',
					'inputsize'		=> '',
					'type'			=> 'text',
		);
		$iva_of_options[] = array(
					'name'			=> 'Gallery ',
					'desc'			=> 'The text that you wish to display in subheader area on a gallery single page',
					'id'			=> $shortname.'_gallery_subtxt',
					'class'			=> 'gallery_subtxt',
					'std'			=> '',
					'type'			=> 'text',
					'inputsize'		=> '',
		);
		

		//Sharelink Options
		//--------------------------------------------------------------------------------------------------
		$iva_of_options[] = array( 'name' => 'Sharelinks','icon' => ADMIN_URI.'/images/link-icon.png', 'type' => 'heading' );
		//--------------------------------------------------------------------------------------------------
		$iva_of_options[] = array(
								'name'	=> 'Google+',
								'desc'	=> 'Check this to enable Google+ Icon for Post Sharing',
								'id'	=> $shortname.'_google_enable',
								'std'	=> '',
								'type'	=> 'checkbox',
							);
		$iva_of_options[] = array(
								'name'	=> 'Facebook',
								'desc'	=> 'Check this to enable Facebook Icon for Post Sharing',
								'id'	=> $shortname.'_facebook_enable',
								'std'	=> '',
								'type'	=> 'checkbox',
							);
							
		$iva_of_options[] = array(
								'name'	=> 'LinkedIn',
								'desc'	=> 'Check this to enable LinkedIn Icon for Post Sharing',
								'id'	=> $shortname.'_linkedIn_enable',
								'std'	=> '',
								'type'	=> 'checkbox',
							);
							
		$iva_of_options[] = array(
								'name'	=> 'Digg',
								'desc'	=> 'Check this to enable Digg Icon for Post Sharing',
								'id'	=> $shortname.'_digg_enable',
								'std'	=> '',
								'type'	=> 'checkbox',
							);
							
		$iva_of_options[] = array(
								'name'	=> 'StumbleUpon',
								'desc'	=> 'Check this to enable StumbleUpon Icon for Post Sharing',
								'id'	=> $shortname.'_stumbleupon_enable',
								'std'	=> '',
								'type'	=> 'checkbox',
							);
							
		$iva_of_options[] = array(
								'name'	=> 'Pinterest',
								'desc'	=> 'Check this to enable Pinterest Icon for Post Sharing',
								'id'	=> $shortname.'_pinterest_enable',
								'class'	=> 'pinterest_sharing',
								'std'	=> '',
								'type'	=> 'checkbox',
							);
							
		$iva_of_options[] = array(
								'name'	=> 'Twitter',
								'desc'	=> 'Check this to enable Twitter Icon for Post Sharing',
								'id'	=> $shortname.'_twitter_enable',
								'std'	=> '',
								'type'	=> 'checkbox',
							);
		
		$iva_of_options[] = array(
								'name'	=> 'Tumblr',
								'desc'	=> 'Check this to enable Tumblr Icon for Post Sharing',
								'id'	=> $shortname.'_tumblr_enable',
								'std'	=> '',
								'type'	=> 'checkbox',
							);
		$iva_of_options[] = array(
								'name'	=> 'Email',
								'desc'	=> 'Check this to enable Email Icon for Post Sharing',
								'id'	=> $shortname.'_email_enable',
								'std'	=> '',
								'type'	=> 'checkbox',
							);

		$iva_of_options[] = array(
								'name'	=> 'Reddit',
								'desc'	=> 'Check this to enable reddit Icon for Post Sharing',
								'id'	=> $shortname.'_reddit_enable',
								'std'	=> '',
								'type'	=> 'checkbox',
							);
		

		// M E G A M E N U  S E T T I N G S
		//-----------------------------------------------------------------------------------------------

		$iva_of_options[] = array( 'name'	=> 'Mega Menu','icon'=> ADMIN_URI.'/images/lang-icon.png','type'	=> 'heading');

		$iva_of_options[] = array( 'name'	=> 'Megamenu Settings', 'desc' => 'Mega Menu Settings.', 'type' => 'subsection');

		$iva_of_options[] = array(  'name'	=> 'Enable Megamenu',
									'desc'	=> 'Check this if you wish to enable megamenu and below are some more options for megamenu so do accordingly',
									'id'	=> $shortname.'_mm_visible',
									'std'	=> 'false',
									'type'	=> 'checkbox'
							);	
							
		$iva_of_options[] = array(	'name'	=> 'Number of Columns Per Row',
									'desc'	=> 'Select number of columns per row to be used for the megamenu default set to be 4 columns',
									'id'	=> $shortname.'_mm_rowItems',
									'std'	=> '4',
									'class'	=> 'select300',
									'options'=> array(
													'1'	=> '1',
													'2'	=> '2', 
													'3'	=> '3',
													'4'	=> '4',
													'5'	=> '5',
												),
									'type'	=> 'select'
							);
		
		$iva_of_options[] = array(	'name'	=> 'Mouse Event',
									'desc'	=> 'Select onclick or on hover event for the megamenu default:hover',
									'id'	=> $shortname.'_mm_event',
									'std'	=> 'hover',
									'class'	=> 'select300',
									'options'=>  array(
														'hover'	=> 'Hover',
														'click'	=> 'Click', 
													),
									'type'	=> 'radio'
							);
							
		$iva_of_options[] = array(	'name'	=> 'Animation Effect',
									'desc'	=> 'Select the animation for the megamenu dropdown default:fade',
									'id'	=> $shortname.'_mm_effect',
									'std'	=> 'fade',
									'class'	=> 'select300',
									'options'=> array(
													'fade'	=> 'Fade',
													'slide'	=> 'Slide Down', 
													),
									'type'	=> 'select'
							);
							
		$iva_of_options[] = array(	'name'	=> 'Animation Speed',
									'desc'	=> 'Select the speed of animation default:normal',
									'id'	=> $shortname.'_mm_speed',
									'std'	=> 'normal',
									'class'	=> 'select300',
									'options'	=>  array(
														'0'		=> 'No Animation',
														'fast'	=> 'Fast',
														'normal'=> 'Normal', 
														'slow'	=> 'Slow',
													),
									'type'	=> 'select'
							);

		$iva_of_options[] = array(  'name'	=> 'Set Sub Menu To Full Width',
									'desc'	=> 'Check this if you wish to select the dropdown as stretched to the header inner area',
									'id'	=> $shortname.'_mm_fullwidth',
									'std'	=> 'false',
									'type'	=> 'checkbox'
							);
							
		$iva_of_options[] = array( 'name' => 'Megamenu background properties',
								   'desc' => 'Below are the parent menu items where if you wish to use the background image for the dropdown corners as shown in the image below and in documentation.
								   	Make sure you use the smaller image should not exceed the size 300kb', 
								   'type' => 'subsection');


		$iva_menu_id = get_nav_menu_locations();
				
		if( isset( $iva_menu_id['primary-menu'] ) ) {
	
			$iva_menu_items = wp_get_nav_menu_items( $iva_menu_id['primary-menu'] );
							
			if( isset( $iva_menu_items ) && !empty($iva_menu_items) ){
				foreach ( $iva_menu_items as $iva_item ) {
				
					$iva_itemid 	= $iva_item->ID;
					$iva_itemparent = $iva_item->menu_item_parent;
				
					if ( $iva_item->menu_item_parent === '0' ) {
					
						$iva_of_options[] = array(
							'name' 	=>  $iva_item->title .'-'. __('MM menu option ', 'iva_theme_admin'),
							'id' 	=> 'mm_menu_bg_' . $iva_item->object_id,
							'desc' 	=> '',
							'class' => "mpcth_image_opt",
							'type' 	=> "mmenu_ancestor" 
						);
					}
				}
			}	
		}
		
	
			//Import and Export
			//---------------------------------------------------------------------------------------------------						
			$iva_of_options[] = array( 'name'=> 'Import/Export','icon'	=> ADMIN_URI.'/images/cog-icon.png', 'type' => 'heading');
			//---------------------------------------------------------------------------------------------------
			
			$iva_of_options[] = array( 'name'=> 'Options Backup', 'desc' => 'Import,Export Backup options.', 'type' => 'subsection');

			
			$iva_of_options[] = array(  
								'name'	=> 'Export Backup Options',
								'desc'	=> 'Export Backup Options',
								'id'	=> $shortname.'_export_backup_options',
								'std' 	=> '',
								'class' => 'atp-backup-options',
								'type'	=> 'export_backupoptions'
							); 
							
			
			$iva_of_options[] = array(  
								'name'	=> 'Import Backup Options',
								'desc'	=> 'Import Backup Options',
								'id'	=> $shortname.'_import_backup_options',
								'std'	=> '',
								'class' => 'atp-backup-options',
								'type'	=> 'import_backupoptions'
							); 

			//-----------------------------------------------------------------------------------------------
			$iva_of_options = apply_filters('custompost_themeoptions',$iva_of_options);
			//-----------------------------------------------------------------------------------------------
	
			//-----------------------------------------------------------------------------------------------
			$iva_of_options = apply_filters('customlocalization_themeoptions',$iva_of_options);
			//-----------------------------------------------------------------------------------------------


		return $iva_of_options;	
	}
}
?>