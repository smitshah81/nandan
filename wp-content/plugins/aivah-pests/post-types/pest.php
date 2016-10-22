<?php
/**
 * Register a Pest post type.	
 *  
 */
	if ( ! function_exists( 'iva_cpt_pest' ) ) {
		function iva_cpt_pest() {
			$labels = array(
				'name'               => _x( 'Pest', 'post type general name', 'aivah_core') ,
				'singular_name'      => _x( 'Pest', 'post type singular name', 'aivah_core') ,
				'menu_name'          => _x( 'Pest', 'admin menu', 'aivah_core' ),
				'name_admin_bar'     => _x( 'Pest', 'add new on admin bar', 'aivah_core' ),
				'add_new'            => _x( 'Add New', 'Pest', 'aivah_core' ),
				'add_new_item'       => __( 'Add New Pest', 'aivah_core' ),
				'new_item'           => __( 'New Pest', 'aivah_core' ),
				'edit_item'          => __( 'Edit Pest', 'aivah_core' ),
				'view_item'          => __( 'View Pest', 'aivah_core' ),
				'all_items'          => __( 'All Pests', 'aivah_core' ),
				'search_items'       => __( 'Search Pests', 'aivah_core' ),
				'parent_item_colon'  => __( 'Parent Pests:', 'aivah_core' ),
				'not_found'          => __( 'No Pests found.', 'aivah_core' ),
				'not_found_in_trash' => __( 'No Pests found in Trash.', 'aivah_core' )
			);
			
			$pestslug = get_option( 'atp_pestslug') ? get_option( 'atp_pestslug'):'pest';

			$args = array(
			'labels'             	=> $labels,
			'description'        	=> '',
			'public'             	=> true,			
			'query_var'          	=> true,
			'can_export'          	=> true,			
			'rewrite'				=> array('slug'=> $pestslug, 'with_front' => true ),		
			'map_meta_cap'       	=> true,	
			'hierarchical'       	=> true,			
			'taxonomies'            => array( 'pest_category' ),			
			'menu_position'      	=> 10,
			'menu_icon'          	=>  AIVAH_CPT_URI  . 'assets/images/pest.png',
			'supports'			 	=> array('title','page-attributes', 'editor','excerpt','thumbnail','comments')
			);
			register_post_type( 'pest', $args );
		}
		add_action( 'init', 'iva_cpt_pest' );
	}

	//  registering pest_category taxonomy
	if ( ! function_exists( 'iva_regtax_pest' ) ) {
		function iva_regtax_pest() {
		    register_taxonomy( 'pest_category', 'pest', array(
				'hierarchical'		=> true,
				'labels' 			=> array(
										'name' 				=> __( 'pest category', 'aivah_core' ),
										'singular_name' 	=> __( 'pest category', 'aivah_core' ),
										'search_items' 		=> __( 'Search pest categories','aivah_core'),
										'all_items' 		=> __( 'All pest categories','aivah_core'),
										'parent_item' 		=> __( 'Parent pest category','aivah_core'),
										'parent_item_colon' => __( 'Parent pest category:','aivah_core'),
										'edit_item' 		=> __( 'Edit pest category','aivah_core'),
										'update_item' 		=> __( 'Update pest category','aivah_core'),
										'add_new_item' 		=> __( 'Add pest category ','aivah_core'),
										'new_item_name' 	=> __( 'New pest category','aivah_core'),
										'menu_name' 		=> __( 'Pest Category','aivah_core'),
								      ),
				'show_ui'			=> true,
				'query_var'			=> true,
				'rewrite'			=> false,
			));
		}	
		add_action('init', 'iva_regtax_pest');
	}

	//
	if ( ! function_exists( 'iva_admin_enqueue_menu_scripts' ) ) {
		function iva_admin_enqueue_menu_scripts() {
			if(function_exists( 'wp_enqueue_media' )){
				wp_enqueue_media();
			}
		}
		add_action( 'admin_enqueue_scripts', 'iva_admin_enqueue_menu_scripts' );
	}
	
	
	if ( ! function_exists( 'iva_pest_category_updated_messages' ) ) {
		function iva_pest_category_updated_messages( $messages ) {
			  global $post, $post_ID;
			  $messages['pest'] = array(
				0 => '', // Unused. Messages start at index 1.
				1 => sprintf( __('Pest Item Updated. <a href="%s">View Item</a>'), esc_url( get_permalink($post_ID) ) ),
				2 => __('Custom Field Updated.','iva_backend'),
				3 => __('Custom Field Deleted.','iva_backend'),
				4 => __('Pest Item Updated.','iva_backend'),
				/* translators: %s: date and time of the revision */
				5 => isset($_GET['revision']) ? sprintf( __('Pest Item restored to revision from %s','iva_backend'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
				6 => sprintf( __('Pest Item published. <a href="%s">View Pest Item</a>'), esc_url( get_permalink($post_ID) ) ),
				7 => __('Pest Item saved.','iva_backend'),
				8 => sprintf( __('Pest Item submitted. <a target="_blank" href="%s">Preview Pest Item</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
				9 => sprintf( __('Pest Item draft updated. <a target="_blank" href="%s">Preview Pest Item</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
			  );

			return $messages;
		}
		//add filter to ensure the  Pest Item, is displayed when user updates a Pest Item
		add_filter('post_updated_messages', 'iva_pest_category_updated_messages');
	}


	if ( ! function_exists( 'iva_cpt_edit_pest_columns' ) ) {
		function iva_cpt_edit_pest_columns($columns) {
			$columns['pest_category'] = __('Pest Categories','aivah_core');
			$columns['thumbnail'] =  __('Post Image','aivah_core');
			return $columns;
		}
		add_action('manage_edit-pest_columns', 'iva_cpt_edit_pest_columns');
	}

	if ( ! function_exists( 'iva_cpt_pest_columns' ) ) {
		function iva_cpt_pest_columns($name) {
			global $wpdb, $wp_query,$post;

			switch ($name) {
			 case 'pest_category':
					   $terms = get_the_terms($post->ID, 'pest_category');
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
				add_action('manage_pest_posts_custom_column', 'iva_cpt_pest_columns', 10, 2);
		}

	if ( ! function_exists( 'aivah_extra_pest_category_fields' ) ) {
	
		//add extra fields to custom taxonomy edit form callback function
		function aivah_extra_pest_category_fields($tag) {
		  
		  //check for existing taxonomy meta for term ID
			
			echo '<div class="form-field">';
			echo '<label for="tag-slug">'.__('Pest Category Image URL','aivah_core').'</label>';
			echo '<input name="term_meta[img]" id="term_meta_img"  type="hidden" class="iva_cpt_upload_image" />';
			echo '<input name="term_meta[img]" id="term_meta_img"  class="iva_cpt_upload_image_button button button-primary button-large clearfix" type="button" value="Choose Image" />';
			echo '<div id="iva_cpt_imagepreview-term_meta_img" class="iva-cpt-screenshot">';
			echo '</div><br /><div class="clearfix"></div>';
			echo '<p>'.__('Image for Pest Category, use full url including http:// - It will be displayed on menu types page.','aivah_core').'</p>';
			echo '</div>';//.form-field
			
			echo '<div class="clearfix"></div>';

			echo '<div class="form-field">';
			echo '<label for="tag-slug">'.__('Display Order','aivah_core').'</label>';
			echo '<input type="text" name="term_meta[display_order]" id="term_meta[display_order]" value=""><br />';
			echo '<p>'.__('The order in which this menu is displayed','layerswp').'</p>';
			echo '</div>';
		}
		// this adds the fields
		add_action('pest_category_add_form_fields','aivah_extra_pest_category_fields',10,2);
	}


	if ( ! function_exists( 'aivah_edit_pest_category_fields' ) ) {
	
		//add extra fields to custom taxonomy edit form callback function
		function aivah_edit_pest_category_fields( $tag ) {
		
		   //check for existing taxonomy meta for term ID	    
			$t_id 				= $tag->term_id;
			$term_meta  		= get_option( "taxonomy_$t_id");
			$iva_display_order  = isset( $term_meta['display_order'] ) ? $term_meta['display_order'] : '';
			
			echo '<tr class="form-field">';
			echo '<th scope="row" valign="top"><label for="cat_Image_url">'.__('Pest category Image URL','iva_theme_admin').'</label></th>';
			echo '<td>';
			echo '<input name="term_meta[img]" id="term_meta_img"  type="text" class="iva_cpt_upload_image" value="'. $term_meta['img'] .'" />';
			echo '<input name="term_meta[img]" id="term_meta_img"  class="iva_cpt_upload_image_button button button-primary button-large clearfix" type="button" value="Choose Image" />';
			echo '<div id="iva_cpt_imagepreview-term_meta_img" class="iva-cpt-screenshot">';
			
			if( $term_meta['img'] ) {
				$image_attributes = wp_get_attachment_image_src(iva_cpt_get_attachment_id_from_src($term_meta['img']));
				if( $image_attributes[0] !='' ){
					echo '<img src="'.$image_attributes[0].'"  class="custom_preview_image" alt="" />';
					echo '<a href="#" class="iva_cpt_image_remove button button-primary">x</a>'; 
				}else{
					echo '<img src="'.$term_meta['img'].'"  class="custom_preview_image" alt="" />';
					echo '<a href="#" class="iva_cpt_image_remove button button-primary">x</a>'; 
				}
			}
			echo '</div><br /><div class="clearfix"></div>';					
			echo '<span class="description">'.__('Image for Menutype, use full url including http:// - It will be displayed on menu types page.','aivah_core').'</span>';
			echo '</td>';
			echo '</tr>';
			echo '<tr class="form-field">';
			echo '<th scope="row" valign="top"><label for="Display Order">'.__('Display Order','aivah_core').'</label></th>';
			echo '<td>';
			echo '<input type="text" name="term_meta[display_order]" id="term_meta[display_order]" size="3" style="width:60%;" value="'.$iva_display_order.'"><br/>';
			echo '<span class="description">'.__('The order in which this menu is displayed','aivah_core').'</span>';
			echo '</td>';
			echo '</tr>';
		}
		add_action('pest_category_edit_form_fields', 'aivah_edit_pest_category_fields', 10, 2);
	}
   if ( ! function_exists( 'aivah_save_extra_taxonomy_fields' ) ) {
		// save extra taxonomy fields callback function
		function aivah_save_extra_taxonomy_fields( $term_id ) {
			if ( isset( $_POST['term_meta'] ) ) {
				$t_id = $term_id;
				$term_meta = get_option( "taxonomy_$t_id");
				$cat_keys = array_keys($_POST['term_meta']);
					foreach ($cat_keys as $key){
					if (isset($_POST['term_meta'][$key])){
						$term_meta[$key] = $_POST['term_meta'][$key];
					}
				}
			update_option( "taxonomy_$t_id", $term_meta );
			}
		}

		// this saves the fields
		add_action('edited_pest_category', 'aivah_save_extra_taxonomy_fields', 10, 2);
		add_action('created_pest_category','aivah_save_extra_taxonomy_fields', 10, 2);
	}	
?>