<?php
	// Register Custom Post Type
	if ( ! function_exists( 'iva_cpt_logosc_type' ) ) {
		function iva_cpt_logosc_type() {

			$labels = array(
				'name'                => _x( 'Logos', 'aivah_core' ),
				'singular_name'       => _x( 'Logo', 'aivah_core' ),
				'menu_name'           => __( 'Logo Showcase', 'aivah_core' ),
				'parent_item_colon'   => '',
				'all_items'           => __( 'All Items', 'aivah_core' ),
				'view_item'           => __( 'View Item', 'aivah_core' ),
				'add_new_item'        => __( 'Add New Item', 'aivah_core' ),
				'add_new'             => __( 'Add New', 'aivah_core' ),
				'edit_item'           => __( 'Edit Item', 'aivah_core' ),
				'update_item'         => __( 'Update Item', 'aivah_core' ),
				'search_items'        => __( 'Search Item', 'aivah_core' ),
				'not_found'           => __( 'Not found', 'aivah_core' ),
				'not_found_in_trash'  => __( 'Not found in Trash', 'aivah_core' ),
			);
			$iva_logosc_slug = get_option('iva_logosc_slug') ? get_option('iva_logosc_slug') :'logosc_type';
			$args = array(
				'label'               => __( 'logosc_type', 'aivah_core' ),
				'description'         => __( 'Logos Showcase for Clients & Partners', 'aivah_core' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'thumbnail','page-attributes'),
				'taxonomies'          => array( 'logosc_cat' ),
				'hierarchical'        => false,
				'rewrite'			 => array('slug'=> $iva_logosc_slug, 'with_front' => true ),
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_nav_menus'   => true,
				'show_in_admin_bar'   => true,
				'menu_position'       => null,
				'menu_icon'           => AIVAH_CPT_URI  . 'assets/images/logo-showcase.png',
				'can_export'          => true,
				'has_archive'         => false,
				'exclude_from_search' => true,
				'publicly_queryable'  => true,
				'capability_type'     => 'post',
			);
			register_post_type( 'logosc_type', $args );

		}
		add_action( 'init', 'iva_cpt_logosc_type');
	}

	if ( ! function_exists( 'iva_regtax_logosc' ) ) {
		function iva_regtax_logosc() {
			register_taxonomy("logosc_cat", 'logosc_type', array(
				'hierarchical'	=> true,
				'labels' => array(
					'name' 				=> __( 'Logo Categories', 'aivah_core' ),
					'singular_name' 	=> __( 'Categories', 'aivah_core' ),
					'search_items' 		=>  __( 'Search Categories','aivah_core'),
					'all_items' 		=> __( 'All Categories','aivah_core'),
					'parent_item'		=> __( 'Parent Categories','aivah_core'),
					'parent_item_colon' => __( 'Parent Categories:','aivah_core'),
					'edit_item'			=> __( 'Edit Categories','aivah_core'),
					'update_item' 		=> __( 'Update Categories','aivah_core'),
					'add_new_item' 		=> __( 'Add Category','aivah_core'),
					'new_item_name'		=> __( 'New Categories ','aivah_core'),
					'menu_name'			=> __( 'Logo Categories','aivah_core'),
				),
				'show_ui'	=> true,
				'query_var'	=> true,
				'rewrite'	=> false,
			));
		}
		add_action('init', 'iva_regtax_logosc');
	}
		
	if ( ! function_exists( 'iva_cpt_logosctype_columns' ) ) {
		function iva_cpt_logosctype_columns($columns) {
			$columns = array(
				'cb'				=> '<input type="checkbox" />',
				'title'				=> __('Title','aivah_core'),
				'author'			=> __('Author','aivah_core'),
				'thumbnail'			=> __('Thumbnails','aivah_core'),
				'logosc_cat'		=> __('Categories','aivah_core'),
				'date'				=> __('Date','aivah_core'), 	
			);
			return $columns;
		}
		add_filter('manage_edit-logosc_type_columns', 'iva_cpt_logosctype_columns');
	}
	
	if ( ! function_exists( 'iva_cpt_manage_logosctype_columns' ) ) {
		function iva_cpt_manage_logosctype_columns($name) {
			global $post, $wp_query;
			switch ($name) {
				case 'logosc_cat':
					$terms = get_the_terms($post->ID, 'logosc_cat');
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
				case 'thumbnail':
					echo the_post_thumbnail(array(100,100));		
						break;		
			}
		}	
		add_action('manage_posts_custom_column', 'iva_cpt_manage_logosctype_columns', 10, 2);
	}
?>