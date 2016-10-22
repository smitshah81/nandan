<?php
	/*
	 * Add new taxonomy, NOT hierarchical (like tags)
	 * taxonomy = slider
	 * object type = slide (Name of the object type for the taxonomy object)
	 */
	if ( ! function_exists( 'iva_cpt_slider' ) ) {
		function iva_cpt_slider() {
			$labels = array(
				'name'				=> __('Slider', 'aivah_core'),  
				'singular_name'		=> __('Slide', 'aivah_core'),  
				'add_new'			=> __('Add New','aivah_core'),  
				'add_new_item'		=> __('Add New Slide','aivah_core'),  
				'edit_item'			=> __('Edit Slide','aivah_core'),  
				'new_item'			=> __('New Slide','aivah_core'),  
				'view_item'			=> __('View Slide','aivah_core'),  
				'search_items'		=> __('Search Slide','aivah_core'),  
				'not_found'			=> __('No Slider found','aivah_core'),  
				'not_found_in_trash'=> __('No Slider found in Trash','aivah_core'),  
				'parent_item_colon'	=> '' ,
				'all_items' =>  __( 'All Sliders' ,'aivah_core')
			);  		
			$sliderslug = get_option( 'atp_sliderslug') ? get_option( 'atp_sliderslug'):'slider';		
			$args = array(
				'labels'			=> $labels,
				'public'			=> true,
				'exclude_from_search'=> false,
				'show_ui'			=> true,
				'capability_type'	=> 'post',
				'hierarchical'		=> false,
				'rewrite'			=> array('slug'=> $sliderslug, 'with_front' => true ),
				'query_var'			=> false,
				'menu_position'		=> null,
				'menu_icon'			=> AIVAH_CPT_URI  . 'assets/images/slider-icon.png',  		
				'supports'			=> array('title', 'thumbnail', 'page-attributes')
			);  
	
			register_post_type('slider',$args);  
		}
		add_action('init', 'iva_cpt_slider');
	}
	if ( ! function_exists( 'iva_regtax_slider' ) ) {
	function iva_regtax_slider() {
			register_taxonomy("slider_cat", 'slider', array(
				'hierarchical'		=> true,
				'labels' => array(
								'name' => __( 'Slider Categories', 'aivah_core' ),
								'singular_name' => __( 'Slide', 'aivah_core' ),
								'search_items' =>  __( 'Search Slider','aivah_core'),
								'all_items' => __( 'All Slider','aivah_core'),
								'parent_item' => __( 'Parent Slider','aivah_core'),
								'parent_item_colon' => __( 'Parent Slider:','aivah_core'),
								'edit_item' => __( 'Edit Slider','aivah_core'),
								'update_item' => __( 'Update Sliders','aivah_core'),
								'add_new_item' => __( 'Add Slider Category','aivah_core'),
								'new_item_name' => __( 'New Slider ','aivah_core'),
								'menu_name' => __( 'Slider Categories','aivah_core'),
							),
				'show_ui'			=> true,
				'query_var'			=> true,
				'rewrite'			=> false,
			));
		}
		add_action('init', 'iva_regtax_slider');
	}

	if ( ! function_exists( 'iva_cpt_slider_columns' ) ) {	
		function iva_cpt_slider_columns($columns) {
				$columns = array(
				'cb'       => '<input type="checkbox" />',
				'title'       => __('Title','aivah_core'),
				'author'       => __('Author','aivah_core'),
				'thumbnails'       => __('Thumbnails','aivah_core'),
				'slider_cat'       => __('Categories','aivah_core'),
				'date'       => __('Date','aivah_core'),
				
				);
			return $columns;
		}
		add_filter('manage_edit-slider_columns', 'iva_cpt_slider_columns');
	}

	if ( ! function_exists( 'iva_cpt_manage_slider_columns' ) ) {		
		function iva_cpt_manage_slider_columns($name) {
			global $wpdb, $wp_query,$post;
			switch ($name) {
				case 'slider_cat':
							$terms = get_the_terms($post->ID, 'slider_cat');
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
				case 'thumbnails':
						echo the_post_thumbnail(array(100,100));
								break;
			}
		}
		add_action('manage_posts_custom_column', 'iva_cpt_manage_slider_columns', 10, 2);
	}
?>