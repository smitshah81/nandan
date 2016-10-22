<?php

//Adds extra options to shortcode meta
add_filter('iva_shorcode_meta', 'iva_shorcode');

//Additional Shortcode meta options
function iva_shorcode( $atp_shortcodes ){
		/**
		 * Appointment Callout
		 */
		 global $atp_theme , $iva_anim;
		
		$atp_shortcodes['Appointmentcallout']  = array(
			'name'		=> __('Appointment CallOut','iva_theme_admin'),
			'value'		=> 'appt_callout',
			'options'	=> array(
				array(
					'name'	=> __('CallOut Title','iva_theme_admin'),
					'desc'	=> 'Type the CallOut title',
					'id'	=> 'title',
					'std'	=> '',
					'type'	=> 'text',
				),
				array(
					'name'	=> __('Short Summary','iva_theme_admin'),
					'desc'	=> 'Type the short summary',
					'id'	=> 'shortinfo',
					'std'	=> '',
					'type'	=> 'text',
				),
				array(
					'name'	=> __('CallOut Button Text','iva_theme_admin'),
					'desc'	=> 'Type the CallOut button text',
					'id'	=> 'btntext',
					'std'	=> '',
					'type'	=> 'text',
				),
				array(
					'name'	=> __('Background Color','iva_theme_admin'),
					'desc'	=> __('Select the background color for the appointment teaser','iva_theme_admin'),
					'id'	=> 'bgcolor',
					'std'	=> '',
					'type'	=> 'color',
				),	
				array(
					'name'	=> __('Text Color','iva_theme_admin'),
					'desc'	=> __('Select the color for the appointment teaser','iva_theme_admin'),
					'id'	=> 'textcolor',
					'std'	=> '',
					'type'	=> 'color',
				),	
				array(
					'name'	=> __('Button Color','iva_theme_admin'),
					'desc'	=> __('Select the color for the appointment button','iva_theme_admin'),
					'id'	=> 'btncolor',
					'std'	=> '',
					'type'	=> 'select',
					'options' => array(
										''		=> 'Choose one...',
										'gray'		=> 'Gray',
										'brown'		=> 'Brown',
										'cyan'		=> 'Cyan',
										'orange'	=> 'Orange',
										'red'		=> 'Red',
										'magenta'	=> 'Magenta',
										'yellow'	=> 'Yellow',
										'blue'		=> 'Blue',
										'pink'		=> 'Pink',
										'green'		=> 'Green',
										'black'		=> 'Black',
									),
				),
			),
		);

		// pest cateogires
		$iva_pest_terms =  $iva_pest_terms_by_slug = array();
		$iva_pest_cats = get_terms('pest_category', 'orderby=name&hide_empty=1');
		 if ( ! empty( $iva_pest_cats ) && ! is_wp_error( $iva_pest_cats ) ){
			foreach ( $iva_pest_cats as $iva_pest_category ) {
				$iva_pest_terms[$iva_pest_category->term_id] = $iva_pest_category->name;
			}
		}

		// pest cateogires by slug
		$iva_pest_categories = get_terms('pest_category', 'orderby=name&hide_empty=1');
		 if ( ! empty( $iva_pest_categories ) && ! is_wp_error( $iva_pest_categories ) ){
			foreach ( $iva_pest_categories as $iva_pest_category ) {
				$iva_pest_terms_by_slug[$iva_pest_category->slug] = $iva_pest_category->name;
			}
		}	
		
		// P E S T  S E R V I C E S
		//--------------------------------------------------------
		$atp_shortcodes['pests'] = array(
			'name'		=> __('Pests','iva_theme_admin'),
			'value'		=> 'pests',
			'options'	=> array(
			
				array(
						'name' 	=> __('Column Select', 'iva_theme_admin'),
						'desc' 	=> 'Select the Grid Columns',
						'id' 	=> 'gridcolumns',
						'std' 	=> '',
						'class' => 'select300',
						'type' 	=> 'select',
						'options' => array(
								'3'		=> '3 Columns',
								'4'		=> '4 COlumns',
								'5'		=> '5 COlumns',
								'6'		=> '6 Columns'
						)
					),	
				
				array(
						'name'	=> __('Categories (optional)','iva_theme_admin'),
						'id'	=> 'cats',
						'std'	=> '',
						'desc'	=> __('Multiple Categories ','iva_theme_admin'),
						'options'=>	$iva_pest_terms_by_slug,
						'type'	=> 'multiselect',
					),
				array(
					'name'	=> __('Order BY','iva_theme_admin'),
					'id'	=> 'orderby',
					'desc'	=> __('Select which Oreder By you want to use for the Menus order.','iva_theme_admin'),
					'std'	=> '',
					'type'	=> 'select',
					'options'	=> array(	
									'ID' 			=> 'ID',
									'title'			=> 'Title',
									'date' 			=> 'Date',
									'menu_order'	=> 'Menu Order'
								),	
				),
				array(
					'name'	=> __('Order','iva_theme_admin'),
					'id'	=> 'order',
					'desc'	=> __('Select which Oreder By you want to use for the Menus order.','iva_theme_admin'),
					'std'	=> '',
					'type'	=> 'select',
					'options'=> array(	
									'ASC'	=>'ASC',
									'DESC' => 'DESC'
								),	
				),
				array(
					'name'	=> __('Title','iva_theme_admin'),
					'id'	=> 'title',
					'desc'	=> __('Check this if you wish to display title of Item.','iva_theme_admin'),
					'std'	=> true,
					'type'	=> 'checkbox'
				),
				
				array(
					'name'	=> __('Pagination','iva_theme_admin'),
					'id'	=> 'pagination',
					'desc'	=> __('Check this if you wish to display pagination.','iva_theme_admin'),
					'std'	=> '',
					'type'	=> 'checkbox'
				),
				array(
					'name'	=> __('limit','iva_theme_admin'),
					'id'	=> 'limit',
					'desc'	=> __('Enter limit for items dispplay.','iva_theme_admin'),
					'std'	=> '4',
					'type'	=> 'text'
				),
			)
		);

		$atp_shortcodes['pest_categories']  = array(
			'name'		=> __('Pest Categories','iva_theme_admin'),
			'value'		=> 'pestcategory',
			'options'	=> array(
				array(
					'name' 	=> __('Column Select', 'iva_theme_admin'),
					'desc' 	=> 'Select the Grid Columns',
					'id' 	=> 'gridcolumns',
					'std' 	=> '',
					'class' => 'select300',
					'type' 	=> 'select',
					'options' => array(
							'3'		=> '3 Columns',
							'4'		=> '4 COlumns',
							'5'		=> '5 COlumns',
							'6'		=> '6 Columns'
					)
				),	
				
				array(
						'name'	=> __('Categories (optional)','iva_theme_admin'),
						'id'	=> 'cats',
						'std'	=> '',
						'desc'	=> __('Multiple Categories ','iva_theme_admin'),
						'options'=>	$iva_pest_terms,
						'type'	=> 'multiselect',
					),
				array(
					'name'	=> __('Order BY','iva_theme_admin'),
					'id'	=> 'orderby',
					'desc'	=> __('Select which Oreder By you want to use for the Menus order.','iva_theme_admin'),
					'std'	=> '',
					'type'	=> 'select',
					'options'	=> array(	
									'none'		=>'None',
									'id' 		=> 'ID',
									'count' 	=> 'Count',
									'name'		=> 'Name',
									'slug'		=> 'Slug',
									'term_group' => 'Term Group',
									'display_order' => 'Display Order'
								),	
				),
				array(
					'name'	=> __('Order','iva_theme_admin'),
					'id'	=> 'order',
					'desc'	=> __('Select which Oreder By you want to use for the Menus order.','iva_theme_admin'),
					'std'	=> '',
					'type'	=> 'select',
					'options'=> array(	
									'ASC'	=>'ASC',
									'DESC' => 'DESC'
								),	
				),
				array(
					'name'	=> __('Title','iva_theme_admin'),
					'id'	=> 'title',
					'desc'	=> __('Check this if you wish to display title of Item.','iva_theme_admin'),
					'std'	=> true,
					'type'	=> 'checkbox'
				),

				array(
					'name'	=> __('limit','iva_theme_admin'),
					'id'	=> 'limit',
					'desc'	=> __('Enter limit for items dispplay.','iva_theme_admin'),
					'std'	=> '4',
					'type'	=> 'text'
				),
				
			),
		);
		
				// P E S T  S E R V I C E S
	//--------------------------------------------------------
	$atp_shortcodes['pest'] = array(
		'name'		=> __('Pest','iva_theme_admin'),
		'value'		=> 'pest',
		'options'	=> array(
			array(
				'name'	=> __('Upload Image','iva_theme_admin'),
				'desc'	=> 'Image / Icon to represent the services box',
				'id'	=> 'image',
				'std'	=> '',
				'type'	=> 'upload',
			),	
			array(
				'name'	=> __('Title','iva_theme_admin'),
				'desc'	=> 'Type the title you wish to display for the pest',
				'id'	=> 'title',
				'std'	=> '',
				'type'	=> 'text',
			),
			array(
				'name'	=> __('Link','iva_theme_admin'),
				'desc'	=> 'Type the title you wish to display for the pest',
				'id'	=> 'link',
				'std'	=> '',
				'type'	=> 'text',
			),
	
			array(
				'name'    => __('Animations', 'iva_theme_admin'),
				'desc'    => 'Select an animation effect for the element.',
				'info'    => '(Optional)',
				'id'      => 'animation',
				'std'     => '',
				'type'    => 'select',
				'options' => $iva_anim
			),					
		)
	);
	// E N D  - PEST
	
	
	
		// T E S T I M O N I A L S
	//--------------------------------------------------------
	$atp_shortcodes['Testimonials'] = array(
		'name'		=> __('Testimonials','iva_theme_admin'),
		'value'		=> 'testimonials',
		'options'	=> array(
				array(
					'name' 	=> __('Testimonials Select', 'iva_theme_admin'),
					'desc' 	=> 'Select the Testimonials Type',
					'id' 	=> 'tm_select',
					'std' 	=> '',
					'type' 	=> 'select',
					'options' => array(
						'list'		=> 'List',
						'fade_tm'	=> 'Fade',
						'carousel'	=> 'Carousel',
						'grid'		=> 'Grid',
					)
				),
				array(
					'name'		=> __('Category','iva_theme_admin'),
					'desc'		=> 'Hold Control/Command key to select multiple categories',
					'info'		=> '(optional)',
					'id'		=> 'category',
					'class'		=> 'showtestimonials fade_tm carousel list grid',
					'std'		=> '',
					'options'	=> $atp_theme->atp_variable('testimonial'),
					'type'		=> 'multiselect',
				),
				array(
					'name'	=> __('Fade Speed','iva_theme_admin'),
					'desc'	=> 'Fade speed',
					'class'	=> 'showtestimonials fade_tm',
					'id'	=> 'speed',
					'std'	=> '3000',
					'type'	=> 'text',
				),
				array(
					'name'	=> __('Testimonial  Limit','iva_theme_admin'),
					'desc'	=> 'Number of testimonials to display',
					'class'	=> 'showtestimonials fade_tm carousel list grid',
					'id'	=> 'limit',
					'std'	=> '',
					'type'	=> 'text',
				),
				array(
					'name' 	=> __('Column Select', 'iva_theme_admin'),
					'desc' 	=> 'Select the Grid Columns',
					'id' 	=> 'gridcolumns',
					'std' 	=> '',
					'class' => 'showtestimonials grid',
					'type' 	=> 'select',
					'options' => array(
						'2columns'		=> '2 Columns',
						'3columns'		=> '3 COlumns',
					)
				),	
				array(
					'name'	=> __('Testimonial Items Limit','iva_theme_admin'),
					'desc'	=> 'Number of testimonial items to display',
					'class'	=> 'showtestimonials carousel',
					'id'	=> 'itemslimit',
					'std'	=> '',
					'type'	=> 'text',
				),
				array(
					'name'	=> __('Pagination','iva_theme_admin'),
					'desc'	=> 'Check this if you wish to disable the pagination.',
					'id'	=> 'pagination',
					'class'	=> 'showtestimonials list',
					'std'	=> '',
					'type'	=> 'checkbox',
				),
		),
	);
	

	// E N D   - T E S T I M O N I A L S
	
		$atp_additional_meta = array_merge( $atp_shortcodes, $atp_shortcodes );
		
		return $atp_additional_meta;
}
?>