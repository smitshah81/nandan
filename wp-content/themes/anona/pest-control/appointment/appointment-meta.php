<?php
	// APPOINTMENT METABOX
	$prefix = 'iva_';
	$default_date = get_option('atp_date_format') ? get_option('atp_date_format') :'Y/m/d';
	$this->meta_box[]= array(
		'id'		=> 'appt-meta-box',
		'title'		=> 'Appointment Form',
		'page'		=> array('appointment'),
		'context'	=> 'normal',
		'priority'	=> 'high',
		'fields'	=> array(
			array(
				'name'	=> __('Last Name:','iva_theme_admin'),					
				'id'	=> $prefix.'appt_lname',
				'class' => '',
				'std'	=> '',
				'type'	=> 'text'
			),
			array(
				'name'	=> __('Email:','iva_theme_admin'),					
				'id'	=> $prefix.'appt_email',
				'class' => '',
				'std'	=> '',
				'type'	=> 'text'
			),
			array(
				'name'	=> __('Phone:','iva_theme_admin'),					
				'id'	=> $prefix.'appt_phone',
				'class' => '',
				'std'	=> '',
				'type'	=> 'text'
			),
			array(
				'name'	=> __('Address','iva_theme_admin'),					
				'id'	=> $prefix.'appt_address',
				'class' => '',
				'std'	=> '',
				'type'	=> 'textarea',
			),
        	array(
				'name'	=> __('Date','iva_theme_admin'),					
				'id'	=> $prefix.'appt_date',
				'class' => '',
				'std'	=>  date($default_date),
				'type'	=> 'dateformat',		
				'inputsize'	=>'',
			),
			array(
				'name'	=> __('Time','iva_theme_admin'),					
				'id'	=> $prefix.'appt_time',
				'class' => '',
				'std'	=> '',
				'type'	=> 'add_timings',
			),
			array(
				'name'	=> __('Notes','iva_theme_admin'),					
				'id'	=> $prefix.'appt_notes',
				'class' => '',
				'std'	=> '',
				'type'	=> 'textarea',
								
			),
			array(
				'name'	=> __('Reservation Status','iva_theme_admin'),
				'desc'	=> '',
				'id'	=> $prefix.'appt_status',
				'type'	=> 'select',
				'class'	=> 'select300',
				'std'	=> 'confirmed',
				'options'=> array(
					'unconfirmed'  => 'UnConfirmed',
					'confirmed'    => 'Confirmed',
					'cancelled'    => 'Cancelled'
				),
			),
		),
	);
?>