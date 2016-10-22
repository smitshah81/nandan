<?php
	//Testimonial type
	//--------------------------------------------------------
	if ( ! function_exists( 'iva_cpt_testimonial' ) ) {
		function iva_cpt_testimonial() {
			$labels = array(
				'name'				=> __('Testimonials','aivah_core'),
				'singular_name'		=> __('Testimonial','aivah_core'),
				'add_new'			=> __('Add New', 'aivah_core'),
				'add_new_item'		=> __('Add Testimonial','aivah_core'),
				'edit_item'			=> __('Edit Testimonial','aivah_core'),
				'new_item'			=> __('New Item','aivah_core'),
				'view_item'			=> __('View Testimonial Item','aivah_core'),
				'search_items'		=> __('Search Testimonial Item','aivah_core'),
				'not_found'			=> __('Nothing found','aivah_core'),
				'not_found_in_trash'=> __('Nothing found in Trash','aivah_core'),
				'parent_item_colon'	=> '',
				'all_items' =>  __( 'All Testimonials' ,'aivah_core')
			);
			
			$testimonialslug = get_option( 'atp_testimonialslug') ? get_option( 'atp_testimonialslug'):'testimonialtype';
			
			$args = array(
				'labels'			=> $labels,
				'public'			=> true,
				'exclude_from_search'=> false,
				'show_ui'			=> true,
				'capability_type'	=> 'post',
				'hierarchical'		=> false,
				'rewrite'			=> array('slug'=> $testimonialslug, 'with_front' => true ),
				'query_var'			=> false,	
				'menu_icon'			=> AIVAH_CPT_URI  . 'assets/images/testimonial-icon.png',  		  		
				'supports'			=> array('page-attributes','editor','title','thumbnail')
			); 
			register_post_type( 'testimonialtype' , $args );
		}
		add_action('init', 'iva_cpt_testimonial');
	}
	if ( ! function_exists( 'iva_regtax_testimonial' ) ) {
		function iva_regtax_testimonial() {
			register_taxonomy("testimonial_cat", 'testimonialtype', array(
					'hierarchical'		=> true,
					'labels' => array(
									'name' => __( 'Testimonial Categories', 'aivah_core' ),
									'singular_name' => __( 'Testimonials', 'aivah_core' ),
									'search_items' =>  __( 'Search Testimonials','aivah_core'),
									'all_items' => __( 'All Testimonials','aivah_core'),
									'parent_item' => __( 'Parent Testimonials','aivah_core'),
									'parent_item_colon' => __( 'Parent Testimonials:','aivah_core'),
									'edit_item' => __( 'Edit Testimonials','aivah_core'),
									'update_item' => __( 'Update Testimonials','aivah_core'),
									'add_new_item' => __( 'Add Testimonial Category','aivah_core'),
									'new_item_name' => __( 'New Testimonials ','aivah_core'),
									'menu_name' => __( 'Testimonial Categories','aivah_core'),
								),
				'show_ui'			=> true,
				'query_var'			=> true,
				'rewrite'			=> false,
			));
		}
		add_action('init', 'iva_regtax_testimonial');
	}
	if ( ! function_exists( 'iva_cpt_testimonial_columns' ) ) {
		function iva_cpt_testimonial_columns($columns) {
			$columns = array(
				'cb'       => '<input type="checkbox" />',
				'title'       => __('Title','aivah_core'),
				'author'       => __('Author','aivah_core'),
				'testimonialcat'       => __('Categories','aivah_core'),
				'testimonial_email'       => __('Email','aivah_core'),
				'date'       => __('Date','aivah_core'),
				
			  );
			return $columns;
		}
			add_filter('manage_edit-testimonialtype_columns', 'iva_cpt_testimonial_columns');
	}


	if ( ! function_exists( 'iva_cpt_manage_testimonial_columns' ) ) {
		function iva_cpt_manage_testimonial_columns($name) {
			global $post, $wp_query;
			switch ($name) {
				case 'testimonialcat':
						$terms = get_the_terms($post->ID, 'testimonial_cat');
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

				case 'testimonial_email':
						echo get_post_meta(get_the_ID(),'testimonial_email',TRUE);
						break;
			}
		}
		add_action('manage_posts_custom_column', 'iva_cpt_manage_testimonial_columns', 10, 2);
	}	
?>