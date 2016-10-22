<?php
	/*
	 * Add new taxonomy, NOT hierarchical (like tags)
	 * taxonomy = gallery_type
	 * object type = gallery (Name of the object type for the taxonomy object)
	 */
	if ( ! function_exists( 'iva_cpt_gallery_type' ) ) {
		function iva_cpt_gallery_type() {
		
			$labels = array(
				'name'				=> __('Gallery','aivah_core'),
				'singular_name'		=> __('ALL Gallery','aivah_core'),
				'add_new'			=> __('Add New Gallery', 'aivah_core'),
				'add_new_item'		=> __('Add New Gallery','aivah_core'),
				'edit_item'			=> __('Edit Gallery','aivah_core'),
				'new_item'			=> __('New Item','aivah_core'),
				'view_item'			=> __('View Gallery Item','aivah_core'),
				'search_items'		=> __('Search Gallery Item','aivah_core'),
				'not_found'			=> __('Nothing found','aivah_core'),
				'not_found_in_trash'=> __('Nothing found in Trash','aivah_core'),
				'parent_item_colon'	=> '',
				'all_items' 		=> __( 'All Galleries','aivah_core'),
			);
			$iva_gallery_slug = get_option('iva_gallery_slug') ? get_option('iva_gallery_slug') :'gallery';

			$args = array(
				'labels'				=> $labels,
				'public'				=> true,
				'exclude_from_search'	=> false,
				'show_ui'				=> true,
				'capability_type'		=> 'post',
				'hierarchical'			=> false,
				'rewrite'				=> array('slug'=> $iva_gallery_slug, 'with_front' => true ),
				'query_var'				=> false,
				'menu_position'			=> null,
				'menu_icon'				=> AIVAH_CPT_URI  . 'assets/images/gallery-icon.png',   
				'supports'				=> array('title','thumbnail', 'page-attributes','editor','comments'),
				'taxonomies' 			=> array('gallery_type')
			); 
			register_post_type( 'gallery' , $args );
		}
		add_action('init', 'iva_cpt_gallery_type');
	}
	if ( ! function_exists( 'iva_create_gallery_taxonomies' ) ) {
		function iva_create_gallery_taxonomies() {
			register_taxonomy( "gallery_type", 'gallery', array(
				'hierarchical'		=> true,
				'labels' => array(
					'name' 				=> __( 'Gallery Categories', 'aivah_core' ),
					'singular_name' 	=> __( 'Gallery Categories', 'aivah_core' ),
					'search_items' 		=> __( 'Search Gallery','aivah_core'),
					'parent_item' 		=> __( 'Parent Gallery' ,'aivah_core'),
					'parent_item_colon' => __( 'Parent Gallery:' ,'aivah_core'),
					'edit_item' 		=> __( 'Edit Gallery','aivah_core'),
					'update_item' 		=> __( 'Update Gallery Category','aivah_core'),
					'add_new_item' 		=> __( 'Add Gallery Category','aivah_core'),
					'new_item_name' 	=> __( 'New Gallery ','aivah_core'),
					'gallery_name' 	    => __( 'Gallery Categories' ,'aivah_core'),
				),
				'show_ui'			=> true,
				'query_var'			=> true,
				'rewrite'			=> false,
				'sort' 				=> true,
				'args' 				=> array( 'orderby' => 'menu_order' ),
				'has_archive' => true,

			));
		}
		add_action('init', 'iva_create_gallery_taxonomies');
	}

	global $columns;
	if ( ! function_exists( 'iva_cpt_gallery_columns' ) ) {
		function iva_cpt_gallery_columns( $columns ) {
			$columns = array(
				'cb'      		 => '<input type="checkbox" />',
				'title'      	 => __('Title','aivah_core'),
				'venue'          => __('Venue','aivah_core'),
				'gallery_type'   => __('Categories','aivah_core'),
				'gallery_id'	 => __('ID\'s','aivah_core'),
				'thumbnail'  	 => __('Thumbnails','aivah_core'),
			);
			return $columns;
		}
		add_filter('manage_edit-gallery_columns', 'iva_cpt_gallery_columns');
	}

	if ( ! function_exists( 'iva_cpt_manage_gallery_columns' ) ) {
		function iva_cpt_manage_gallery_columns( $name ) {
			global $wpdb, $wp_query,$post,$default_date;
			switch ( $name ) {
				case 'venue':
						echo get_post_meta( get_the_ID(),'gallery_venue',TRUE );
						break;
				case 'gallery_type':
					$terms = get_the_terms($post->ID, 'gallery_type');
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
				case 'gallery_id':
						echo get_the_ID();
						break;
			}
		} 
		add_action('manage_posts_custom_column', 'iva_cpt_manage_gallery_columns', 10, 2);
	}
?>