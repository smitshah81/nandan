<?php
	/*
	 * Add new taxonomy, NOT hierarchical (like tags)
	 * posttype = Appointment
	 * object type = slide (Name of the object type for the Appointment object)
	 */
	if ( ! function_exists( 'iva_cpt_appointment' ) ) {
		function iva_cpt_appointment() {
			$labels = array(
				'name'				=> __('Appointment', 'aivah_core'),  
				'singular_name'		=> __('Appointment', 'aivah_core'),  
				'add_new'			=> __('Add New','aivah_core'),  
				'add_new_item'		=> __('Add New Appointment','aivah_core'),  
				'edit_item'			=> __('Edit Appointment','aivah_core'),  
				'new_item'			=> __('New Appointment','aivah_core'),  
				'view_item'			=> __('View Appointment','aivah_core'),  
				'search_items'		=> __('Search Appointment','aivah_core'),  
				'not_found'			=> __('No Appointment found','aivah_core'),  
				'not_found_in_trash'=> __('No Appointment found in Trash','aivah_core'),  
				'parent_item_colon'	=> '' ,
				'all_items' 		=>  __( 'All Appointments' ,'aivah_core')
			);  
			
			$iva_appt_slug = get_option('iva_apt_slug') ? get_option('iva_apt_slug') :'appointment';
			
			$args = array(
				'labels'			 => $labels,
				'public'			 => true,
				'exclude_from_search'=> false,
				'show_ui'			 => true,
				'capability_type'	 => 'post',
				'hierarchical'		 => false,
				'rewrite'			 => array('slug'=> $iva_appt_slug, 'with_front' => true ),
				'query_var'			 => false,
				'menu_position'		 => null,
				'menu_icon'			 => AIVAH_CPT_URI  . 'assets/images/reservation.png',  		
				'supports'			 => array('title','page-attributes','editor','thumbnail'),
				'taxonomies'		 => array('iva_appointment_cat','iva_appointment_service')
			);  
		
			register_post_type('appointment',$args);  
		}
		add_action('init', 'iva_cpt_appointment');
	}

	if ( ! function_exists( 'iva_regtax_appointment' ) ) {
		function iva_regtax_appointment(){
			register_taxonomy("iva_appointment_cat", 'appointment', array(
					'hierarchical'	=> true,
					'labels' 		=> array(
						'name' 				=> __( 'Categories', 'aivah_core' ),
						'singular_name' 	=> __( 'Category', 'aivah_core' ),
						'search_items'		=> __( 'Search Categories','aivah_core'),
						'all_items' 		=> __( 'All Categories','aivah_core'),
						'parent_item' 		=> __( 'Parent Category','aivah_core'),
						'parent_item_colon' => __( 'Parent Category:','aivah_core'),
						'edit_item' 		=> __( 'Edit Category','aivah_core'),
						'update_item' 		=> __( 'Update Categories','aivah_core'),
						'add_new_item' 		=> __( 'Add Category','aivah_core'),
						'new_item_name' 	=> __( 'New Category ','aivah_core'),
						'menu_name' 		=> __( 'Categories','aivah_core'),
					),
					'show_ui'		=> true,
					'query_var'		=> true,
					'rewrite'		=> false,
			));
		}
		add_action('init', 'iva_regtax_appointment');
	}

	if ( ! function_exists( 'iva_regtax_service' ) ) {
	function iva_regtax_service(){
		register_taxonomy("iva_appointment_service", 'appointment', array(
				'hierarchical'	=> true,
				'labels' 		=> array(
					'name' 				=> __( 'Services', 'aivah_core' ),
					'singular_name' 	=> __( 'Service', 'aivah_core' ),
					'search_items'		=> __( 'Search Service','aivah_core'),
					'all_items' 		=> __( 'All Service','aivah_core'),
					'parent_item' 		=> __( 'Parent Service','aivah_core'),
					'parent_item_colon' => __( 'Parent Service:','aivah_core'),
					'edit_item' 		=> __( 'Edit Service','aivah_core'),
					'update_item' 		=> __( 'Update Services','aivah_core'),
					'add_new_item' 		=> __( 'Add Service','aivah_core'),
					'new_item_name' 	=> __( 'New Service ','aivah_core'),
					'menu_name' 		=> __( 'Services','aivah_core'),
				),
				'show_ui'		=> true,
				'query_var'		=> true,
				'rewrite'		=> false,
		));
	}
	add_action('init', 'iva_regtax_service');
	}
	if ( ! function_exists( 'iva_cpt_edit_appointment_columns' ) ) {
		function iva_cpt_edit_appointment_columns($columns) {
			$columns['appoint_cat'] 	= __( 'Category', 'aivah_core' );
			$columns['appt_date'] 	= __( 'Date', 'aivah_core' );
			$columns['appt_time'] 	= __( 'Time', 'aivah_core' );
			$columns['appt_status'] = __( 'Status', 'aivah_core' );
		
			return $columns;
		}		
		add_filter('manage_edit-appointment_columns', 'iva_cpt_edit_appointment_columns');
	}

	if ( ! function_exists( 'iva_cpt_custom_appointment_columns' ) ) {
		function iva_cpt_custom_appointment_columns($name) {
			global $wpdb, $wp_query,$post;
			switch ($name) {
				case 'appoint_cat':
							$terms = get_the_terms($post->ID, 'iva_appointment_cat');
							$post_terms = array();
							//If the terms array contains items... (dupe of core)
							if ( !empty($terms) ) {
								//Loop through terms
								foreach ( $terms as $term ){
									//Add tax name & link to an array
									$post_terms[] = esc_html(sanitize_term_field('name', $term->name, $term->term_id, '', 'edit'));
								}
								//Spit out the array as CSV
								echo implode( ', ', $post_terms );
							} else {
								//Text to show if no terms attached for post & tax
								echo '<em>No terms</em>';
							}
							break;

				case 'appt_date':
						$iva_default_date = get_option('atp_date_format') ? get_option('atp_date_format') :'Y/m/d';
						if( $iva_default_date ){
							echo date( $iva_default_date, get_post_meta( get_the_ID(), 'iva_appt_date', true) );
						}
						break;
				case 'appt_time':
						$iva_appt_time	= get_post_meta( get_the_ID(),'iva_appt_time',true );
						if( $iva_appt_time ){
							echo  date('g:i a',strtotime($iva_appt_time));
						}
						break;	
			
				case 'appt_status':
						$status=get_post_meta(get_the_ID(),'iva_appt_status',TRUE);
						switch($status){
							case 'unconfirmed':
								$unConfirmed = get_option('iva_apt_unconfirm') ? get_option('iva_apt_unconfirm') : 'UnConfirmed';
								echo '<p class="unconfirmed">'.$unConfirmed.'</p>';
								break;
							case 'confirmed':
								$confirmed = get_option('iva_apt_confirm') ? get_option('iva_apt_confirm') : 'Confirmed';
								echo '<p class="confirmed">'.$confirmed.'</p>';
								break;
							case 'cancelled':
								$cancellation = get_option('iva_apt_cancel') ? get_option('iva_apt_cancel') : 'Cancelled';
								echo '<p class="cancelled">'.$cancellation.'</p>';
								break;
						}

				case 'thumbnail':
							echo the_post_thumbnail(array(150,150));
								break;
			}
		}
		add_action('manage_posts_custom_column', 'iva_cpt_custom_appointment_columns', 10, 2);
	}
?>