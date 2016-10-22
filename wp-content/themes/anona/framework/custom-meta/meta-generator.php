<?php
	// CUSTOM META BOXES
	//--------------------------------------------------------
if (!class_exists('customfields')) {
	class customfields {

		function __construct($meta_box)	{		
			$this->_meta_box = $meta_box;		
			add_action('admin_menu',array(&$this,'metabox'));
			//add_action('save_post', array(&$this,'savemeta'),1,2);
			add_action( 'save_post',array(&$this,'savemeta'), 10, 2 );
			
		}

		// Add meta box
		function metabox() {
			 foreach($this->_meta_box['page'] as $page) {
				add_meta_box($this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'show_metabox'), $page, $this->_meta_box['context'], $this->_meta_box['priority']);
			}
		}
		
		// Callback function to show fields in meta box
		function show_metabox() {

			global $page_layout, $post,$meta_box;
			// Defines custom sidebar widget based on custom option
			$iva_sidebarwidget = get_option('atp_customsidebar');

			// Use nonce for verification
			echo '<input type="hidden" name="page_page_layout_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

			// M E T A B O X   W R A P 
			//--------------------------------------------------------
			echo '<div class="atp_meta_options">';

			 foreach ($this->_meta_box['fields'] as $field) { 
				
				// get current post meta data
				$meta = get_post_meta($post->ID, $field['id'], true);
		
				if($meta == ""){
					$meta =$field['std']; //Default Meta Array Value if empty
				}

				if(!isset($field['class'])) { 
					$field['class']=''; 
				}
				if(!isset($field['desc'])) { 
					$field['desc']=''; 
				}
				
				// M E T A B O X   O P T I O N S
				//--------------------------------------------------------
				echo'<div class="atp_options_box '.$field['class'].'">',
					'<div class="atp_label"><label>', $field['name'], '</label></div>',
					'<div class="atp_inputs">';
				switch ($field['type']) {
					case 'text':
								echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" />';
								break;
					case 'color':
							?>
	
							<?php echo '<div class="meta_page_selectwrap"><input class="color"  name="'. $field['id'] .'" id="'. $field['id'] .'" type="text" value="', $meta ? $meta : $field['std'], '"  />';?>
							<div id="<?php echo $field['id']; ?>_color" class="wpcolorSelector"><div></div></div></div>
							<?php
							break;			
					case 'textarea':
							echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4">', $meta ? $meta : $field['std'], '</textarea>';
							break;
					case 'select':
							echo '<div class="select_wrapper ', $field['class'], '"><select class="select" name="', $field['id'], '" id="', $field['id'], '">';
							foreach ($field['options'] as $key => $value) {
								echo '<option value="'.$key.'"', $meta == $key ? ' selected="selected"' : '', '>', $value, '</option>';
							}
							echo '</select></div>';
							break;
					case 'multiselect': 
							echo '<div class="select_wrapper2">';
							 $count = count($field['options']);
							 if ( $count > 0 ){
							echo '<select multiple="multiple"  name="', $field['id'], '[]" id="', $field['id'], '[]">';
							
							foreach ($field['options'] as $key => $value) { 
								echo '<option value="'.$key.'"',  (is_array($meta) && in_array($key, $meta)) ? ' selected="selected"' : '', '>', $value, '</option>';
							}
							echo '</select>';
							}else { echo '<strong>'.__('No Posts IN Categories','iva_theme_admin').'</strong>';}
							echo '</div>';
							break;
					case 'customselect':
							echo '<div class="select_wrapper ', $field['class'], '"><select class="select" name="', $field['id'], '" id="', $field['id'], '">';
							echo '<option value="">'.__('Select','iva_theme_admin').'</option>';
							if($iva_sidebarwidget!=""){
								foreach ($field['options'] as $key => $value) {
									echo '<option value="'.$value.'"', $meta == $value ? ' selected="selected"' : '', '>', $value, '</option>';
								}
							}
							echo '</select></div>';
							break;
					case 'newmeta':
							$output= '<div id="custom_widget_sidebar"><table id="custom_widget_table" cellpadding="0" cellspacing="0">';
							$output.='<tbody>';
							if($meta !=""){
								foreach($meta as $custom_meta) {
									$output .= '<tr><td><input type="text" name="'.$field['id'].'[]" value="'. $custom_meta.'"  size="30" style="width:97%" /></td><td><a class="button button-secondary" href="javascript:void(0);return false;" onClick="jQuery(this).parent().parent().remove();">'.__('Delete','iva_theme_admin').'</a></td></tr>';
								}
							}				
							$output .= '</tbody></table><button type="button" class="button button-primary button-large" name="add_custom_widget" value="Add Meta" onClick="addWidgetRow()">'.__('Add Meta','iva_theme_admin').'</button></div>';
							?>
							<script type="text/javascript" language="javascript">
							function addWidgetRow(){
								jQuery('#custom_widget_table').append('<tr><td><input type="text" name="<?php echo $field['id'];?>[]" value="" size="30" style="width:97%" /></td><td><a class="button button-secondary" href="javascript:void(0);return false;" onClick="jQuery(this).parent().parent().remove();"><?php _e('Delete','iva_theme_admin');?></a></td></tr>');
							}
							</script>
							<?php
							echo $output;
							break;
					case 'radio':
							 $link_page = $link_cat = $link_post = $link_manually = '';
							foreach ($field['options'] as $key => $value) {
								echo '<label class="rlabel"><input onclick="sys_custom_url_meta()" type="radio" name="', $field['id'], '" value="', $key, '"', $meta == $key ? ' checked="checked"' : '', ' />', $value,'</label>';
							}
							global $post;
							
							$custom = get_post_custom($post->ID);
							
							if(isset($custom['link_page'])){
								$link_page = $custom["link_page"][0]; }
							if(isset($custom['link_cat'])){
								$link_cat = $custom["link_cat"][0]; }
							if(isset($custom['link_post'])){ 
								$link_post = $custom["link_post"][0]; }
							if(isset($custom['link_manually'])){ 
								$link_manually = stripslashes($custom["link_manually"][0]);  }
								
							echo'<div id="customurl" >';
							echo'<div id="sys_link" class="postlinkurl linkpage select_wrapper">';
							echo '<select name="link_page" class="select">';
							echo '<option value="">'.__('Select Page','iva_theme_admin').'</option>';
							foreach($this->get_custom_options('page') as $key => $option) {
								echo '<option value="' . $key . '"';
								if ($key == $link_page) {
									echo ' selected="selected"';
								}
								echo '>' . $option . '</option>';
							}
							echo '</select>';	
							echo '</div>';
					
							echo'<div id="sys_category" class="postlinkurl linktocategory">';
							echo '<select name="link_cat">';
							echo '<option value="">'.__('Select Category','iva_theme_admin').'</option>';
							foreach($this->get_custom_options('cat') as $key => $option) {
								echo '<option value="' . $key . '"';
								if ( $key == $link_cat) {
									echo ' selected="selected"';
								}
								echo '>' . $option . '</option>';
							}
							echo '</select>';	
							echo '</div>';
					
							echo'<div id="sys_post" class="postlinkurl linktopost">';
							echo '<select name="link_post">';
							echo '<option value="">'.__('Select Post','iva_theme_admin').'</option>';
							foreach($this->get_custom_options('post') as $key => $option) {
								echo '<option value="' . $key . '"';
								if ($key == $link_post) {
									echo ' selected="selected"';
								}
								echo '>' . $option . '</option>';
							}
							echo '</select>';	
							echo '</div>';
					
							echo'<div id="sys_manually" class="postlinkurl linkmanually">';
							if(isset($link_manually)){
							echo'<input type="text" name="link_manually"  value="'.$link_manually.'"  size="50%" />';
							}else{ 
								echo'<input type="text" name="link_manually"  value=""  size="50%" />';
							}
							echo '</div></div>';
							break;
					case 'upload':
							echo'<input name="'.$field['id'].'" id="'.$field['id'].'"  type="hidden" class="custom_upload_image" value="'.stripslashes(get_post_meta($post->ID, $field['id'], true)).'" />';
							echo'<input name="'.$field['id'].'" id="'.$field['id'].'" class="custom_upload_image_button button button-primary button-large clearfix" type="button" value="Choose Image" />';
							echo'<div id="atp_imagepreview-'.$field['id'].'" class="iva-screenshot">';
							if(get_post_meta($post->ID, $field['id'], true)) {
								$iva_img = get_post_meta($post->ID, $field['id'], true);
								$image_attributes = wp_get_attachment_image_src(iva_get_attachment_id_from_src($iva_img));
								if($image_attributes[0] !=''){
									 echo '<img src="'.esc_url( $image_attributes[0] ).'"  class="custom_preview_image" alt="" />';
											 echo '<a href="#" class="cimage_remove button button-primary">x</a>'; 
								}else{
									 echo '<img src="'.esc_url( $iva_img ).'"  class="custom_preview_image" alt="" />';
											 echo '<a href="#" class="cimage_remove button button-primary">x</a>'; 
								}
							}
							echo '</div>';
							break;
					case 'date':
							echo'<script type="text/javascript">
								jQuery(document).ready(function() {
									"use strict";
									jQuery("#'.$field['id'].'").datepicker({ dateFormat: "d-M-yy" });
								});
							</script>';
							echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30"/>';
							break;
					case 'dateformat':
						global $default_date,$atp_defaultdate;
						echo '<script type="text/javascript">
						jQuery(document).ready(function() {
							"use strict";
							jQuery("#'.$field['id'].'").datepicker({ dateFormat: "'.$atp_defaultdate.'" });
							jQuery("#ui-datepicker-div").addClass("iva-date-ui");
						});
						</script>';
				
						if( $meta !='' ){
							if( is_numeric( $meta )){
								$meta = date_i18n( $default_date, $meta );
							}else{
								$meta			 = $meta;
								$atp_defaultdate = 'd-MM-yy';
							}
						}
					echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="', $field['inputsize'], '" />';
					break;
					case 'layout':
						$i = 0;
						$select_value = $meta;
						foreach ($field['options'] as $key => $value) {
								$i++;
							$checked = '';
							$selected = '';
							if($select_value != '') {
								if ( $select_value == $key) { $checked = ' checked'; $selected = 'atp-radio-option-selected'; } 
								} else {
									if ($meta == $key) { $checked = ' checked'; $selected = 'atp-radio-option-selected'; }
										elseif ($i == 1  && !isset($select_value)) { $checked = ' checked'; $selected = 'atp-radio-option-selected'; }
										elseif ($i == 1  && $meta == '') { $checked = ' checked'; $selected = 'atp-radio-option-selected'; }
									else { $checked =  'checked'; }
								}
							echo '<div class="layout"><input value="'.$key.'"  class="checkbox atp-radio-img-radio" type="radio" id="'. $field['id'].$i.'" name="'. $field['id'].'"'.$checked.' />';
							echo '<img src="'.esc_url( $value ).'" alt="" class="atp-radio-option '. $selected .'" onClick="document.getElementById(\''. $field['id'].$i.'\').checked = true;" /><span class="label">'.$key.'</span></div>';
							}
							break;

					case 'checkbox':
							$meta !=''? 'on':'off';
							echo '<input  type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta == 'on' ? ' checked="checked"' : '', ' />
							<label for="',$field['id'],'">',$field['desc'],'</label>';
							break;
							
					case 'background':
							
							$bg_color = '';
							if(is_array($meta)){
							
							if ( !empty( $meta ) ){
								$bg_image 		= $meta['0']['image'];
								$bg_color		= $meta['0']['color'];
								$bg_repeat 		= $meta['0']['repeat'];
								$bg_position 	= $meta['0']['position'];
								$bg_attachement = $meta['0']['attachement'];
							}
							}else {
								$bg_image 		= $meta;
							}
							// Position Properties Array
							$positionarray = array(
								'left top'		=> 'Left Top',
								'left center'	=> 'Left Center',
								'left bottom'	=> 'Left Bottom',
								'right top' 	=> 'Right Top',
								'right center' 	=> 'Right Center',
								'right bottom'	=> 'Right Bottom',
								'center top'	=> 'Center Top',
								'center center'	=> 'Center Center',
								'center bottom'	=> 'Center Bottom'
							);
							// Repeat Properties Array
							$repeatarray = array( 'repeat' => 'Repeat', 'no-repeat' => 'No-Repeat','repeat-x' => 'Repeat-X','repeat-y' => 'Repeat-Y');
							// Attachment Properties Array
							$attacharray = array( 'scroll' => 'Scroll', 'fixed' => 'Fixed' );

							echo '<div class="section section-background">';
							
							//Upload Field
							echo '<div class="atp-background-upload clearfix">';
							echo '<input type="text"  name="'.$field['id'].'_image" id="'.$field['id'].'_image" class="custom_upload_image" value="'.$bg_image.'" />';
							echo '<input type="button" name="'.$field['id'].'_image" class="custom_upload_image_button button button-primary button-large" value="'.__( 'Choose Image', 'iva_theme_admin' ).'" />';
							echo '<div class="clear"></div>';
							echo '<div id="atp_imagepreview-'.$field['id'].'_image" class="iva-screenshot">';
							if ( $bg_image != '' ) {
								$image_attributes = wp_get_attachment_image_src(iva_get_attachment_id_from_src($bg_image));
								if($image_attributes[0] !=''){
								echo '<img src="'.esc_url( $image_attributes[0] ).'"  class="custom_preview_image" alt="" />';
								echo '<a href="#" class="cimage_remove button button-primary">x</a>'; 
								}else{
								echo '<img src="'.esc_url( $bg_image ).'"  class="custom_preview_image" alt="" />';
								echo '<a href="#" class="cimage_remove button button-primary">x</a>'; 
								
								}
							}
							echo '</div></div>';
							
							//Color Input
							echo '<div class="atp-background-color">';
							echo '<input class="color"  name="'. $field['id'].'_color" id="'. $field['id'].'_color" type="text" value="'.$bg_color.'">';
							echo '<div id="'.$field['id'].'_color" class="wpcolorSelector"><div></div></div>';
							echo '</div>';
							
							// Background Repeat Options Input
							echo '<div class="atp-background-repeat">';
							echo '<div class="select_wrapper">';
							echo '<select class="select" name="'. $field['id'].'_repeat" id="'. $field['id'].'_repeat">';
							foreach ( $repeatarray as $key => $value ) {
								$selected = ($key == $bg_repeat) ? ' selected="selected"' : '';
								echo'<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
							}
							echo '</select>';
							echo '</div></div>';
							
							//Background Position Options Input
							echo '<div class="atp-background-position"><div class="select_wrapper">';
							echo '<select class="select" name="'. $field['id'].'_position" id="'. $field['id'].'_position">';
							foreach ( $positionarray as $key => $value ) {
								$selected = ($key == $bg_position) ? ' selected="selected"' : '';
								echo'<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
							}
							echo '</select>';
							echo '</div></div>';
							
							//Background Attachement Options Input
							echo '<div class="atp-background-attachment"><div class="select_wrapper">';
							echo '<select class="select" name="'. $field['id'].'_attachement" id="'. $field['id'].'_attachement">';
							foreach ( $attacharray as $key => $value ) {
								$selected = ($key == $bg_attachement) ? ' selected="selected"' : '';
								echo'<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
							}
							echo '</select>';
							echo '</div></div>';
							
							echo '</div>';
							break;		

					case 'multicheckbox':
                            foreach ( $field['options'] as $key => $value) {
                                echo '<div><input  type="checkbox"  ' ,(isset($meta[$key]) == $key) ? ' checked="checked"' : '','  name="',$field['id'],'[',$key,']','"    value="',$key,'" id="',$value,'"  /> ';
                                echo '<label for="',$value,'">',$value,'</label></div>';
                            }
                            break;		
					
                    case 'default_editor':
							$editor_settings = array(
                                'wpautop' 		=> true,
                                'media_buttons' => true,
                                'editor_class'	=> '',
                                'textarea_rows' => 5,
                                'tabindex' 		=> 4,
                                'teeny' 		=> true
                            );
							$meta_box_value = $meta ? $meta : $field['std'];
							wp_editor( $meta_box_value, $field['id'],$editor_settings );
							break;	
							
					// Timings		
					case 'add_timings':
					       $iva_meta_options = array( 'meta'=> $meta,'field_id' => $field['id'] );
					       echo apply_filters('add_timings',$iva_meta_options);
					       break;
					case 'add_custom_meta':
					       $iva_meta_options = array( 'meta'=> $meta,'field_id' => $field['id'] );
					       echo apply_filters('add_custom_meta',$iva_meta_options);
					       break;
						   
					// GoogleMap	
			       case 'googlemap':					
							$iva_meta_options = array( 'meta' => $meta,'field_id' 	=> $field['id'] );
							echo apply_filters('add_googlemap',$iva_meta_options);
							break;		
				}
				if($field['type'] != 'checkbox') {
					echo '<p class="desc">',$field['desc'],'</p>';
				}
				echo '</div><div class="clear"></div>';
				echo '</div>';
			}
			echo '</div>';
		}
		// E N D  - SHOW METABOX


		// S A V E   M E T A   D A T A 
		//--------------------------------------------------------
		function savemeta($post_id,$post) {
		
			/* Verify the nonce before proceeding. */
			if ( !isset( $_POST['page_page_layout_nonce'] ) || !wp_verify_nonce( $_POST['page_page_layout_nonce'], basename( __FILE__ ) ) )
				return $post_id;

			/* Get the post type object. */
			$post_type = get_post_type_object( $post->post_type );

			/* Check if the current user has permission to edit the post. */
			if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
				return $post_id;
				
			// Is the user allowed to edit the post or page?
			foreach ($this->_meta_box['fields'] as $field) {
				$field_type = $field['type'] ;
				if(  $field_type === 'background' )
				{
					if( isset( $field['id']) && $field['id'] != ''){
						$bg_props = array();
						$bg_props[] = array(
							'image' 		=> isset( $_POST[$field['id'] . '_image']) ? $_POST[$field['id'] . '_image']:'',
							'color' 		=> isset( $_POST[$field['id'] . '_color']) ? $_POST[$field['id'] . '_color']:'',
							'repeat'		=> isset( $_POST[$field['id'] . '_repeat']) ? $_POST[$field['id'] . '_repeat']:'',
							'position'		=> isset( $_POST[$field['id'] . '_position']) ? $_POST[$field['id'] . '_position']:'',
							'attachement'	=> isset( $_POST[$field['id'] . '_attachement']) ? $_POST[$field['id'] . '_attachement']:'',
						);
					
						if ( get_post_meta( $post_id, $field['id'],true ) == '' )
						{
							add_post_meta( $post_id, $field['id'], $bg_props, true);
						}
						elseif ( $bg_props != get_post_meta( $post_id, $field['id'], true ) ) 
						{
							update_post_meta( $post_id, $field['id'], $bg_props );
						}
					}
				}elseif(  $field_type === 'googlemap' ) {
					if( isset( $field['id']) && $field['id'] != ''){
						$gmap_props = array();
						$gmap_props[] = array(
							'address' 		=> isset( $_POST[$field['id'] . '_address']) ? $_POST[$field['id'] . '_address']:'',
							'lat' 			=> isset( $_POST[$field['id'] . '_lat']) ? $_POST[$field['id'] . '_lat']:'',
							'lng' 			=> isset( $_POST[$field['id'] . '_lng']) ? $_POST[$field['id'] . '_lng']:'',	
							'streetno' 		=> isset( $_POST[$field['id'] . '_streetno']) ? $_POST[$field['id'] . '_streetno']:'',
							'route' 		=> isset( $_POST[$field['id'] . '_route']) ? $_POST[$field['id'] . '_route']:'',
							'city' 			=> isset( $_POST[$field['id'] . '_city']) ? $_POST[$field['id'] . '_city']:'',
							'state' 		=> isset( $_POST[$field['id'] . '_state']) ? $_POST[$field['id'] . '_state']:'',
							'zip_code' 		=> isset( $_POST[$field['id'] . '_zipcode']) ? $_POST[$field['id'] . '_zipcode']:'',
							'country' 		=> isset( $_POST[$field['id'] . '_country']) ? $_POST[$field['id'] . '_country']:'',	
						);

						if ( get_post_meta( $post_id, $field['id'],true ) == '' )
						{
							add_post_meta( $post_id, $field['id'], $gmap_props, true);
						}
						elseif ( $gmap_props != get_post_meta( $post_id, $field['id'], true ) ) 
						{
							update_post_meta( $post_id, $field['id'], $gmap_props );
						}
					}
				}else{
					$old = get_post_meta( $post_id, $field['id'], true );
					$new = isset( $_POST[$field['id']] )? $_POST[$field['id']]:'';
					if ($field['type'] == 'eventdate') {
						$new = strtotime($new);
					}
					if ($field['type'] == 'dateformat') {
							$new = strtotime($new);
					}
					if ( $new && $new != $old ) {
						update_post_meta( $post_id, $field['id'], $new );
					} elseif ( '' == $new && $old ) {
						delete_post_meta($post_id, $field['id'], $old);
					}
				}
			}
		}
		
		//
		// function get_custom_options - fetch pages/posts/cats
		//--------------------------------------------------------
		function get_custom_options($type) {
			switch ($type) {
				case 'page':
						$entries = get_pages('title_li=&orderby=name');
						foreach ($entries as $key => $entry) {
							$iva_objects[$entry->ID] = $entry->post_title;
						}
						break;
				case 'cat':
						$entries = get_categories('title_li=&orderby=name&hide_empty=0');
						foreach ($entries as $key => $entry) {
							$iva_objects[$entry->term_id] = $entry->name;
						}
						break;
				case 'post':
						$entries = get_posts('orderby=title&numberposts=-1&order=ASC');
						foreach ($entries as $key => $entry) {
							$iva_objects[$entry->ID] = $entry->post_title;
						}
						break;
				default:
						$iva_objects = false;
			}
			return $iva_objects;
		}
	}
}	
foreach($this->meta_box as $meta_box){
  $customfields = new customfields($meta_box);
 }