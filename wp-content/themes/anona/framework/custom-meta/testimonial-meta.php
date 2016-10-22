<?php

/**
 * testimonials meta box
 */

 $prefix = '';
 $this->meta_box[] = array(
		'id'		=> 'Testimonial-meta-box',
		'title'		=> 'Testimonial Options',
		'page'		=> array('testimonialtype'),
		'context'	=> 'normal',
		'priority'	=> 'core',
		'fields'	=> array(
		
					/**
					 * client picture
					 */
					array(
						'name'	=> __('Client Picture','iva_theme_admin'),
						'desc'	=> __('Select the Image type/mode you wish to use either Gravatar or Custom Image.','iva_theme_admin'),
						'id'	=> $prefix . 'testimonial_image_option',
						'std'	=> 'gravatar',
						'type'	=> 'select',
						'class' =>'select300',
						'options'=> array(
										"gravatar"	=> "Gravatar Logo",
										"customimage"	=>'Upload Picture')
					),
				
					/**
					 * upload photo
					 */
					array(
						'name'	=> __('Upload Photo','iva_theme_admin'),
						'desc'	=> __('Upload Image from media library or from your desktop.','iva_theme_admin'),
						'id'	=> 'testimonial_photo',
						'class'	=> 'testimonialoption customimage',
						'std'	=> '',
						'type'	=> 'upload',
					),
					/**
					 * email id
					 */
					array(
						'name'	=> __('Email ID','iva_theme_admin'),
						'desc'	=> __('If you are using gravtar logo enter the email id here,email id will not be displayed on the frontend.','iva_theme_admin'),
						'id'	=> 'testimonial_email',
						'std'	=> '',
						'title'	=> 'Name',
						'type'	=> 'text',
					),
					/**
					 * company name
					 */
					array(
						'name'	=> __('Company Name','iva_theme_admin'),
						'desc'	=> __('Enter company Name/individual.','iva_theme_admin'),
						'id'	=> 'company_name',
						'std'	=> '',
						'title'	=> 'Company Name',
						'type'	=> 'text',
					),
					/**
					 * website url
					 */
					array(
						'name'	=> __('Website URL','iva_theme_admin'),
						'desc'	=> __('Type the URL you wish to display. excluding any protocols (ex:http://) .','iva_theme_admin'),
						'id'	=> 'website_url',
						'std'	=> '',
						'title'	=> 'Website URL',
						'type'	=> 'text',
					),
					/**
					 * website name
					 */
					array(
						'name'	=> __('Website Name','iva_theme_admin'),
						'desc'	=> __('Enter the website name you wish to display for the website url if left empty complete website url will be displayed.','iva_theme_admin'),
						'id'	=> 'website_name',
						'std'	=> '',
						'title'	=> 'Website Name',
						'type'	=> 'text',
					),
				)
			);
		?>