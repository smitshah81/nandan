<?php
	/* logo Show case Meta box setup function. */
	$prefix = '';
	$this->meta_box[] = array(
		'id'		=> 'logoshowcase-meta-box',
		'title'		=> '&nbsp;LogoShowcase Options',
		'page'		=> array('logosc_type'),
		'context'	=> 'normal',
		'priority'	=> 'core',
		'fields'	=> array(
		
			array(
				'name'	=> __('Website URL','iva_theme_admin'),
				'desc'	=> 'Type Website url for the logoshowcase',
				'id'	=> 'logo_url',
				'std'	=> '',
				'type'	=> 'text'
			),
			
			array(
				'name'	=> __('Logo URL Target','iva_theme_admin'),
				'desc'	=> 'Choose option when reader clicks on the link. ',
				'id'	=> 'logo_url_target',
				'std'	=> '',
				'type'	=> 'select',
				'options'=> array(
								''			=> 'Choose one...',
								'_blank'	=> 'Open the linked document in a new window or tab',
								'_self'		=> 'Open the linked document in the same frame as it was clicked.',
								'_parent'	=> 'Open the linked document in the parent frameset',
								'_top'		=> 'Open the linked document in the full body of the window',
							),
			),
			
			array(
				'name'	=> __('Logo Title','iva_theme_admin'),
				'desc'	=> 'Check this if you want to disable the title',
				'id'	=> 'disable_title',
				'std'	=> '',
				'type'	=> 'checkbox',
			),			
		)
	);
?>