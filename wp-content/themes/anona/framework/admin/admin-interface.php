<?php
/** 
 * function ivafw_optionsframework_add_admin - Load static framework options pages
 * Credits to Devin too for using some coding from his framework https://github.com/devinsays
 */ 

	function ivafw_optionsframework_add_admin() {	
	
		global $iva_of_options, $iva_icon;	   
		/**
		 * Save Options Settings
		 */
		if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'optionsframework' ) {
			if (isset($_REQUEST['atp_save']) && 'reset' == $_REQUEST['atp_save']) {
				atp_reset_options($iva_of_options, 'optionsframework');
				header("Location: admin.php?page=optionsframework&reset=true");
				die;
			}
		}
			
		/**
		 * Add a top level menu page in the 'objects' section
		 *
		 * @param string 'THEMENAME' The text to be displayed in the title tags of the page when the menu is selected
		 * @param string 'THEMENAME' The text to be used for the menu
		 * @param string 'edit_theme_options' The capability required for this menu to be displayed to the user.
		 * @param string 'optionsframework' The slug name to refer to this menu by $iva_sociable(should be unique for this menu)
		 * @param callback 'optionsframework_options_page' The function to be called to output the content for this page.
		 * @param string '$iva_icon' The url to the icon to be used for this menu
		 *
		 * @return string The resulting page's hook_suffix
		 */
		if(function_exists('add_object_page')) {
			$iva_icon = THEME_URI . '/framework/admin/images/aivah-icon.png'; // Icon for theme admin menu
			add_object_page(THEMENAME,THEMENAME, 'edit_theme_options','optionsframework', 'ivafw_optionsframework_options_page', $iva_icon);		
		}

	
		/** 
		 * Hooks a function on to a specific action.
		 * Runs in the HTML header so a admin framework can add JavaScript scripts to all admin pages.
		 */
		add_action("admin_print_scripts", 'atp_load_only');

	} 

	/** 
	 * Hooks for adding admin menu
	 */
	add_action('admin_menu', 'ivafw_optionsframework_add_admin');

	/** 
	 * Function atp_reset_options - 
	 * updates the atp_template_option_values option value in wp_options table
	 */
	
	function atp_reset_options($iva_of_options, $page = 'optionsframework') {
		$output = unserialize(base64_decode(get_option('atp_default_template_option_values')));
		update_option_values($iva_of_options,$output);
		update_option('atp_template_option_values',$output);
	}

	/**
	 * function ivafw_optionsframework_options_page -  Builds the Options Page
	 */
	
	function ivafw_optionsframework_options_page(){
	    global $iva_of_options;
		
		$user_id = get_current_user_id();
		$current_user = wp_get_current_user();
		$avatar = get_avatar( $user_id, 50 );
		$howdy  = sprintf( __('Howdy, %1$s','iva_theme_admin'), $current_user->display_name );
		?>
		<div id="atp_container">
			<div class="atpinterface">
				<div class="page_load">Loading Theme Options...</div>

				<form action="" enctype="multipart/form-data" id="atpform" method='post'>
					<div id="atp-popup-save" class="atp-save-popup"><div class="atp-save-save">Options Updated<br><img src="http://www.themelock.com/ete.jpg"> </div></div>
					<div id="atp-popup-reset" class="atp-save-popup"><div class="atp-save-reset">Options Reset</div></div>
					
					<!-- #atp_header -->
					<div id="atp_header" class="clearfix">
						<div class="leftpane">
							<div class="headinfo">
								<div class="atp_avatar"><?php echo $avatar; ?></div>
								<h4><?php echo $howdy; ?> </h4>
								<h5><span>Theme Options Panel</span></h5>
							</div>
						</div>
						<div class="rightpane">
							<div class="headlogo">
								<h1><?php echo THEMENAME ?></h1>
							</div>
							<div class="panelinfo">
								<div class="themename">Version <span class="details orange"><?php echo THEMEVERSION; ?></span></div>
							</div>
						</div>
					</div>
					<!-- #atp_header -->
		<?php
		
					// Get all the options based on menu/page selection
					switch($_GET['page'])  {
							case 'optionsframework' : 			
										$return = optionsframework_machine($iva_of_options);
										break;
					}
					// Rev up the Options Machine
					//$return = optionsframework_machine($iva_of_options);
		?>

					<div id="main">

						<div id="atp-nav">
							<ul>
								<?php echo $return[1] ?>
							</ul>
						</div>
						
						<div id="content">
							<div class="options-content">
								<?php echo $return[0]; /* Settings */ ?>
							</div>
						</div>
						
						<div class="clear"></div>
				
					</div>
		
					<div class="savebar">
						<div class="savelink">
						<img style="display:none" src="<?php echo admin_url(); ?>images/spinner.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="saving..." />
						<input type="submit" value="Save All Changes" class="green-button button button-primary button-hero right" />
						</div>
					</form>
					<form action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" method="post" style="display:inline" id="atpform-reset">
						<span class="submit-footer-reset">
							<input name="reset" type="submit" value="Reset Options" class="red-button button button-secondary" onclick="return confirm('Click OK to reset. Any settings will be lost!');" />
							<input type="hidden" name="atp_save" value="reset" />
						</span>
					</form>
					</div>
					<?php  if (!empty($update_message)) echo $update_message; ?>
					<div class="clear"></div>
			</div>
	<!-- end atpinterface-->
	</div>
	<!-- end atp_container-->
	<?php 
	} 


	/**
	 * Load required javascripts for Options Page - of_load_only
	 */

	function atp_load_only() {

		add_action('admin_head', 'atp_admin_head');

		wp_register_script('jquery-ajaxhandler', FRAMEWORK_URI.'admin/js/ajaxhandler.js', array( 'jquery' ));
		wp_register_script('of-medialibrary-uploader', FRAMEWORK_URI .'admin/js/of-medialibrary-uploader.js', array( 'jquery', 'thickbox' ) );
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ajaxhandler');
		wp_enqueue_script('of-medialibrary-uploader');
		wp_enqueue_script('media-upload' );
		wp_enqueue_script('underscore' );
		wp_enqueue_media();
	}

	/**
	 * function atp_admin_head - loads script in admin header
	 */
	function atp_admin_head() {
		//variables
		global $wpdb,$iva_of_options,$iva_sociable;

		/** 
		 * get all info/data necessary into variables
		 * START neccessary variables for sociables
		 */
		
		$iva_sociable = array(
			'adn'        => 'ADN',
			'android'    => 'Android',
			'behance'    => 'Behance',
			'delicious'  => 'Delicious',
			'deviantart' => 'DeviantArt',
			'digg'       => 'Digg',
			'dribbble'   => 'Dribbble',
			'facebook'   => 'Facebook',
			'flickr'	 => 'Flickr',
			'google-plus'=> 'Google Plus',
			'instagram'  => 'Instagram',
			'lastfm'     => 'Lastfm',
			'linkedin'   => 'LinkedIn',
			'pinterest-p'=> 'Pinterest',
			'reddit'     => 'Reddit',
			'skype'      => 'Skype',
			'soundcloud' => 'SoundCloud',
			'stumbleupon'=> 'Stumbleupon',
			'twitter'    => 'Twitter',
			'vimeo-square' => 'Vimeo',
			'whatsapp'   => 'Whatsapp',
			'yahoo'      => 'Yahoo',
			'yelp'       => 'Yelp',
			'youtube'    =>'Youtube',
			'vk'         => 'VK',
			'paypal'	 => 'Paypal',
			'dropbox'    => 'Dropbox',
			'envelope'	 => 'Email'
		); 
	
		// E N D - necessary variables for sociables		
		
		/**
		 * START neccessary variables for colorpicker
		 * loop through options findout for colorpickers
		 */
		$color_pickers_arr = array();
		foreach($iva_of_options as $option){ 
			switch($option['type']) {
				case 'typography':
				case 'border':
				case 'background':
								$temp_color = get_option($option['id']);
								$color_pickers_arr[] = array('option_id' => $option['id'] . '_color', 'color' => $temp_color['color']);
								break;
				case 'color':
								$color_pickers_arr[] = array('option_id' => $option['id'], 'color' => get_option($option['id']));								
								break;
			}
		}

		// E N D - necessary variables for colorpicker
		?>
			<script type="text/javascript" language="javascript">
		/** START code for handling social items **/
		jQuery(document).ready(function(){ 
			// handle DELETE action 
			jQuery('.sys_social_item_delete').click(function() {
				jQuery(this).closest('tr').remove();
			});
			
			jQuery('.button-primary').click(function() {
				var sys_social_data = '';

				jQuery('#sys_socialbookmark tr').each(function() {
					social1 = jQuery(this).find('.sys_social_title').val();
					social2 = jQuery(this).find('.sys_social_file_icon').val();
					social3 = jQuery(this).find('.sys_social_account_url').val();
				
					if (social1 !== undefined) {
						social1 = social1.replace(/#;/g, '').replace(/#\|/g, '');
						social2 = social2.replace(/#;/g, '').replace(/#\|/g, '');
						social3 = social3.replace(/#;/g, '').replace(/#\|/g, '');
					
						sys_social_data =  sys_social_data + social1 + '#|' + social2 + '#|' + social3 + '#;';
					}
				});
		
				sys_social_data = sys_social_data.substr(0, sys_social_data.length - 2);
				if(sys_social_data != ''){
					document.getElementById('atp_social_bookmark').value = sys_social_data;
				}
			});
	
			// handle ADD action 
			jQuery('#sys_add_social_item').click(function() { 
				jQuery('#sys_socialbookmark tr:last').after('' +
				'<tr>' +
				'<td width="50"><select class="sys_social_file_icon" name="sys_social_file_icon" ><?php 
					foreach ( $iva_sociable as $key => $values) { 
					echo "<option value=".$key.">$values</option>"; } ?></select></td>' +
					'<td width="70"><input type="text"  class="sys_social_account_url"/></td>' +
					'<td width="50"><input type="text"  class="sys_social_title" /></td>' +
					'<td align="center" width="70"><a href="#" class="sys_social_item_delete button-primary red-button">Delete</a></td>' +
					'</tr>'
					);
				jQuery('.sys_social_item_delete').click(function() {
					jQuery(this).closest('tr').remove();
					return false;
				});
			});
		}); // E N D - Sociables
		</script>
		<?php

		// A J A X   U P L O A D
		?>
		<script type="text/javascript">
			var querystring_reset = '<?php echo isset($_REQUEST['reset'])?$_REQUEST['reset']:'';?>';
			var admin_ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
			var querystring_page = '<?php echo isset($_REQUEST['page'])?$_REQUEST['page']:'';?>';
		</script>
	<?php 
	} // E N D - atp_admin_head
	
	/** 
	 * Ajax Save Action - of_ajax_callback 
	 */
	
	add_action('wp_ajax_atp_ajax_post_action', 'atp_ajax_callback');

	function atp_ajax_callback() {
		
		global $wpdb,$iva_of_options; // this is how you get access to the database
		
		$save_type = $_POST['type'];

		// Save type =  U P L A O D 
		if($save_type == 'upload'){
			$clickedID = $_POST['data']; // Acts as the name
			$filename = $_FILES[$clickedID];
			$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']); 
		
			$override['test_form'] = false;
			$override['action'] = 'wp_handle_upload';    
			$uploaded_file = wp_handle_upload($filename,$override);
		
			$upload_tracking[] = $clickedID;
			update_option( $clickedID , $uploaded_file['url'] );
		
			if(!empty($uploaded_file['error'])) {
				echo 'Upload Error: ' . $uploaded_file['error']; 
			}else{ 
				echo $uploaded_file['url']; 
			} // Response
			exit;
		}

		// Save type =  O P T I O N S / F R A M E W O R K
		elseif ($save_type == 'options' OR $save_type == 'framework') {
			$data = $_POST['data'];
			$import_process_initiated = false; //to identify whether saving/updating the settings, this becomes true when action performed through advance options
			
			parse_str( $data,$output );
		
			update_option_values( $iva_of_options,$output );
			
			if( $output['atp_template_option_values'] !='' ) {
				$importoutput = unserialize( base64_decode( $output['atp_template_option_values'] ) );
				if( $importoutput ){
					update_option('atp_template_option_values',$importoutput);
					if( count( $importoutput ) > 1 ) {
						update_option_values($iva_of_options,$importoutput);
					}
				}
			}
			$output['atp_template_option_values']=''; //remove the content of atp_template_option_values
			update_option('atp_template_option_values',$output);//updates the atp_template_option_values option value
			die();
		}
	}
	
	/**
	 * ARRAY TYPES
	 * U P D A T E   O P T I O N S   V A L U E S 
	 */
	function update_option_values($iva_of_options,$output) {
		//loop through the template options
		foreach($iva_of_options as $option_array){

			$new_value = '';
			
			if(isset($option_array['id'])) { // Non - Headings...

				$type = $option_array['type'];		
				$id = $option_array['id'];
				if ( is_array($type)){
					foreach($type as $array){
						// T E X T 
						//---------------------------------
						if($array['type'] == 'text'){
							$std = $array['std'];
							$new_value = $output[$id];
							if($new_value == ''){ $new_value = $std; }
							$new_value =  stripslashes($new_value);
						}
						
						// S O C I A B L E S
						//---------------------------------
						if($type == 'custom_socialbook_mark'){
							$std = $array['std'];
							$new_value = $output[$id];
							if($new_value == ''){ $new_value = $std; }
							$new_value =  stripslashes($new_value);
						}
					}
				}
				// S E L E C T
				//---------------------------------
				elseif($type == 'select'){
					$new_value = isset($output[$option_array['id']])?$output[$option_array['id']]:'';
				}
				// M U L T I   S E L E C T
				//---------------------------------
				elseif($type == 'multiselect'){
					$new_value = isset($output[$option_array['id']])?$output[$option_array['id']]:'';
				}

				// C H E C K B O X
				//---------------------------------
				elseif($type == 'checkbox'){
					$new_value = isset($output[$option_array['id']])?$output[$option_array['id']]:'';
					$new_value !=''? 'on':'off';						
				}
				// M U L T I   C H E C K B O X
				//---------------------------------
				elseif($type == 'multicheck'){ 
					$new_value = array();	
					$new_value = isset($output[$option_array['id']])?$output[$option_array['id']]:'';
				}

				// Close Hours
				//---------------------------------
				elseif($type == 'closehours'){
					$weekday_array = array();
					$iva_weekdays 	 = array('sunday','monday','tuesday','wednesday','thursday','friday','saturday');
					foreach( $iva_weekdays as $key => $day ){
						$weekday_array[$key] = $output[$option_array['id'] .'_'.$key.'_closed'];
						$new_value = $weekday_array;
					}
				}

				// B U S I N E S S   H O U R S 
				//---------------------------------
				elseif($type == 'businesshours'){
					$businesshours_array = array();	
					$businesshours_array['opening'] = $output[$option_array['id'] . '_opening'];
					$businesshours_array['closing'] = $output[$option_array['id'] . '_closing'];
					$businesshours_array['close'] = stripslashes(isset($output[$option_array['id'] . '_close']) ? 'on' : 'off');
					$new_value = $businesshours_array;	
				}
				// T Y P O G R A P H Y 
				//---------------------------------
				elseif($type == 'typography'){
					$typography_array = array();	
					$typography_array['size'] = $output[$option_array['id'] . '_size'];
					$typography_array['lineheight'] = $output[$option_array['id'] . '_lineheight'];
					$typography_array['style'] = $output[$option_array['id'] . '_style'];
					$typography_array['color'] = $output[$option_array['id'] . '_color'];
					$typography_array['fontvariant'] = $output[$option_array['id'] . '_fontvariant'];
					$new_value = $typography_array;							
				}
				// Font Family
				//---------------------------------
				elseif($type == 'atpfontfamily'){
					$new_value = isset($output[$option_array['id']])?$output[$option_array['id']]:'';
				}
				// B A C K G R O U N D 
				//---------------------------------
				elseif($type == 'background'){
					$background_array = array();	
					$background_array['image'] = $output[$option_array['id'] . '_image'];
					$background_array['color'] = $output[$option_array['id'] . '_color'];
					$background_array['style'] = $output[$option_array['id'] . '_style'];
					$background_array['position'] = $output[$option_array['id'] . '_position'];
					$background_array['attachment'] = $output[$option_array['id'] . '_attachment'];
					$new_value = $background_array;
				}
				// T E A S E R S E L E C T 
				//---------------------------------
				elseif($type == 'teaserselect'){
					$teaserselect_array = array();	
					$teaserselect_array['options'] = $output[$option_array['id'] . '_options'];
					$teaserselect_array['custom'] = stripslashes($output[$option_array['id'] . '_custom']);
					$teaserselect_array['twitter'] = $output[$option_array['id'] . '_twitter'];
					$new_value = $teaserselect_array;	
				}
				// C U S T O M   S I D E B A R
				//---------------------------------
				elseif($type == 'customsidebar'){ 
					if(isset($output[$option_array['id']])) {
						$new_value = array();	
						$new_value = $output[$option_array['id']];
						}
				}
				// S L I D E R   S E L E C T
				//---------------------------------
				elseif($type == 'sliderselect'){
					$sliderselect_array = array();	
					$sliderselect_array['slider'] = $output[$option_array['id'] . '_slider'];	
					$new_value = $sliderselect_array;
				}
				// B O R D E R 
				//---------------------------------
				elseif($type == 'border'){
					$border_array = array();	
					$border_array['width'] = $output[$option_array['id'] . '_width'];
					$border_array['style'] = $output[$option_array['id'] . '_style'];
					$border_array['color'] = $output[$option_array['id'] . '_color'];
					$new_value = $border_array;
				}
				
				// M E G A  M E N U
				//---------------------------------
				elseif($type == 'mmenu_ancestor'){
					$mmenu_ancestor_array = array();
					$mmenu_ancestor_array['image'] 		= $output[ $option_array['id'] . '_image'];
					$mmenu_ancestor_array['pleft'] 		= $output[ $option_array['id'] . '_pleft'];
					$mmenu_ancestor_array['pbottom'] 	= $output[ $option_array['id'] . '_pbottom'];
					$mmenu_ancestor_array['pright'] 	= $output[ $option_array['id'] . '_pright'];
					$mmenu_ancestor_array['position'] 	= $output[$option_array['id'] . '_position'];
		
					$new_value = $mmenu_ancestor_array;
				}

				// Not Upload
				//---------------------------------
				else{
					//$new_value = $output[$id];
					$new_value = isset($output[$id])?$output[$id] : '';
				}
				
				//stripslashes before saving value into the database
				if($type != 'upload'){
					if(!is_array($new_value))
					$new_value = stripslashes($new_value);
				}
				
				//update option values
				update_option($id,$new_value);
			}
			
		}
	}

	/** 
	 * Generates The Options Within the Panel - 
	 * O P T I O N S F R A M E W O R K   M A C H I N E
	 */
	function optionsframework_machine($iva_of_options) {
		$counter = 0;

		$menu = $output = '';
		$menuitems=array();
		$s_headings=array();
		foreach($iva_of_options as $key => $value)
			{
				if($value['type']=='heading' || $value['type']=='subnav')
				{
					$s_headings[] = $value;
				}
			}
		$heading_key = 0;
		foreach($s_headings as $key => $value)
				{
					$head = 'atp-option-' . preg_replace( '/[^a-zA-Z0-9\s]/', '', strtolower( trim( str_replace( ' ', '', $value['name'] ) ) ) );
					$value['head'] = $head;
					if ( $value['type'] == 'heading' ) {
					$menuitems[$head] = $value;
					$heading_key = $head;
					}
					
					if ( $value['type'] == 'subnav' ) {
				$menuitems[$heading_key]['children'][] = $value;
			}
				}

		foreach ($iva_of_options as $value) {
			$counter++;
			$val = '';
			
		
			// H E A D I N G
			//---------------------------------
			if ( $value['type'] != "heading" &&  $value['type'] != "subnav" ) {
				$class = ''; if(isset( $value['class'] )) { $class = $value['class']; }
				$output .= '<div  class="section section-'.$value['type'].' '. $class .'">'."\n";
				
			}
			if(!isset($value['desc'])){ $explain_value = ''; } else{ $explain_value = $value['desc']; }
			$select_value = '';                                   
			
			switch ( $value['type'] ) {

				// S U B S E C T I O N
				//---------------------------------
				case 'subsection':
						$default = $value['name'];
						$output .= '<div class="sub-section"><h1 class="sub-title">'.$default.'</h1>'. $explain_value .'</div>';
						break;
			
				// T E X T 
				//---------------------------------
				case 'text':
						$val = $value['std'];
						$std = get_option($value['id']);
						if ( $std != "") { $val = $std; }
						$inputsize = isset($value['inputsize']) ? $value['inputsize'] : '10';
						$output .= '<h3>'. $value['name'] .'</h3>'."\n";
						$output .= '<div class="controls" >'."\n";
						$output .= '<input class="atp-input" name="'. $value['id'] .'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $val .'" style="width:'. $inputsize.'px" />';
						$output .='</div>';
						$output .='<div class="explain">'. $explain_value .'</div>';
						break;

		
				// S E L E C T 
				//---------------------------------
				case 'select':
						$class = ''; if(isset( $value['class'] )) { $class = $value['class']; }
						$value_options = isset( $value['options'] )? $value['options'] :'';

						$output .= '<h3>'. $value['name'] .'</h3>'."\n";
						$output .= '<div class="controls" >'."\n";
						$output .= '<div class="select_wrapper '.$class.'">';
						$output .= '<select class="of-input select " name="'.$value['id'].'" id="'. $value['id'] .'">';
						if(!empty($value_options)){
							foreach ( $value_options as $key => $option ) {
								$output .= '<option value="'.$key.'" ' . selected(get_option($value['id']),$key, false) . ' />'.$option.'</option>';
							} 
						}
						$output .= '</select>';
						$output.='</div></div>';
						$output .='<div class="explain">'. $explain_value .'</div>';
						break;
				// M U L T I S E L E C T 
				//---------------------------------
				case 'multiselect':
						$output .= '<h3>'. $value['name'] .'</h3>'."\n";
						$output .= '<div class="controls" >'."\n";
						$output .= '<div>';
						$output .= '<select class="of-input  "  multiple="multiple"   name="'.$value['id'].'[]" id="'. $value['id'] .'[]">';
						foreach ($value['options'] as $key => $option) {
							$selected = ""; 
							if (get_option( $value['id'])) {
								if (@in_array($key, get_option($value['id'] ))) $selected = "selected=\"selected\"";
							} else {
								//Empty Value if Unchecked
							}
							$output .= '<option value="'.$key.'"  '.$selected.' />'.$option.'</option>';
						} 
						$output .= '</select>';
						$output.='</div></div>';
						$output .='<div class="explain">'. $explain_value .'</div>';
						break;


				// BUSINESS HOURS
				//---------------------------------

				case "businesshours":
						$output .= '<h3>'. $value['name'] .'</h3>'."\n";
						$default = $value['std'];
						$businesshours_stored = get_option($value['id']);
		
						$interval = get_option('iva_timeinterval') ? get_option('iva_timeinterval'):'15';

						// Opening
						//$val = $default['opening'];
						if ( $businesshours_stored['opening'] != "") { $val = $businesshours_stored['opening']; }
						$output .= '<div class="otime"><div class="select_wrapper"><select class="select" name="'. $value['id'].'_opening" id="'. $value['id'].'_opening">';
						$output .= '<option value="">Opening-Time</option>'; 
						for ($i = 0; $i < 24; $i++){ 
							$h = $i;
					
							if ( $h < 10) { $h = '0' . $h; }
							for($m=0; $m<=45; $m+=$interval) {
								if($m == 0) $m .='0';
								$hours = $h.':'.$m;						
								if($val === $hours){
									$active = 'selected="selected"'; 
								} else { 
									$active = ''; 
								}
								$output .= '<option value="'. $h .':'.$m.'" ' . $active . '>'. $h .':'.$m.'</option>'; 
							}
						}
						$output .= '</select></div></div>';
						
						// Closing
						//$val = $default['closing'];
						if ( $businesshours_stored['closing'] != "") { $val = $businesshours_stored['closing']; }
						$output .= '<div class="ctime"><div class="select_wrapper"><select class="select" name="'. $value['id'].'_closing" id="'. $value['id'].'_closing">';
						$output .= '<option value="">Closing-Time</option>'; 
						for ($i = 0; $i < 24; $i++){ 
							$h = $i;
							if ( $h < 10) { $h = '0' . $h; }
							for($m=0;$m<=45;$m+=$interval) {
								if($m == 0) $m .='0';
								$hours = $h.':'.$m;
								if($val === $hours){
									$active = 'selected="selected"'; 
								} else { 
									$active = ''; 
								}
								$output .= '<option value="'. $h .':'.$m.'" ' . $active . '>'. $h .':'.$m.'</option>'; 
							}
						}
						$output .= '</select></div></div>';
						
						// Closed
						//$val = $default['close'];
						if ( $businesshours_stored['close'] != "") { $val = $businesshours_stored['close']; }
						$checked='';
						if(!empty($val)) {
							if($val == 'on') {
								$checked = 'checked="checked"';
							}else{
								$checked = '';
							}
						}
						$output .= '<div class="cclosed"><input '. $checked .' type="checkbox" class="checkbox atp-input " value="on" name="'. $value['id'].'_close" id="'. $value['id'].'_close"> <label for="'. $value['id'].'_close">Check this if you wish the display this day as closed. </label></div>';
						break;
					
				// CLOSED HOURS
				//---------------------------------

				case 'closehours':
					
						$interval 			= get_option('iva_timeinterval') ? get_option('iva_timeinterval'):'15';
						$iva_time_interval  = '+'.$interval.'minutes';
						$optionid 			= get_option( $value['id'] );
						$iva_weekdays 	 	= array(
													'sunday',
													'monday',
													'tuesday',
													'wednesday',
													'thursday',
													'friday',
													'saturday'
											 );
						
						foreach( $iva_weekdays as $key => $day ){
						
							$iva_hrs = get_option( 'iva_'.$day );
						
						
							$iva_stored_val = $optionid[$key];

							
							$open_hrs   =  strtotime( $iva_hrs['opening'] );
							$close_hrs  =  strtotime( $iva_hrs['closing']);
							$closed_hrs =  $iva_hrs['close'];
							
					
							if( $closed_hrs == 'off' ){
								$output .= '<h3>'. ucfirst ( $day ) .'</h3>';
								$output .= '<div class="hours">';
								$output .= '<select class=" of-input  "  multiple="multiple"  name="'. $value['id'].'_'.$key.'_closed[]" id="'. $value['id'].'_'.$key.'_closed[]">';
								while( $open_hrs < $close_hrs ){
								
									$iva_time_hrs = date( 'H:i',$open_hrs );
									$selected = ''; 
									if ( get_option( $value['id'] ) ) {
										if( @in_array( $iva_time_hrs , $iva_stored_val  ) ) $selected = "selected=\"selected\"";
									} else {
										
									}
									
									$output .= '<option value="'.$iva_time_hrs.'" '.$selected.'>'.$iva_time_hrs.'</option>'; 
									$open_hrs = strtotime( $iva_time_interval, $open_hrs );
								}
								$output .= '</select></div>';
							}
						}
						break;
				



						// S O C I A B L E S
						//---------------------------------
					case 'custom_socialbook_mark':
						global $socialimages_select,$iva_sociable;
						$output .= '<h3>'. $value['name'] .'</h3>'."\n";
						$output .= '<div class="controls" >'."\n";
						$output .= '<div id="sys_social_book">';
						$output .= '<h2>Social Websites</h2>';	
						$output .= '<table id="sys_socialbookmark" class="fancy_table">';
						$output .= '<tr>';
						$output .= '<th width="100">Website</th>';
						$output .= '<th width="100">URL</th>';
						$output .= '<th width="100">Tool Tip</th>';
						$output .= '<th align="center" width="70">Delete</th>';
						$output .= '</tr>';
						if (get_option('atp_social_bookmark') != '') {
							$sys_social_items = explode('#;', get_option('atp_social_bookmark'));
							for($i=0;$i<count($sys_social_items);$i++) {
								$sys_social_item = explode('#|', $sys_social_items[$i]);
								$output .= '<tr>';
								$output .= '<td>';
								//$iva_sociable = '';
								$output .= '<select id="sys_social_file_icon" class="sys_social_file_icon" name="sys_social_file_icon"  width="300">';
								foreach ( $iva_sociable as $key => $values) {
									$selected = $sys_social_item[1] == $key ? ' selected="selected"' : '';
									$output .= '<option '.$selected.' value="'.$key.'" >'.$values.'</option>';
									$selected ="";
								}
								$output .= '</select>';	
								$output .= '</td>';
								$output .= '<td><input type="text" class="sys_social_account_url" value="'.$sys_social_item[2].'" /></td>';
								$output .= '<td><input type="text" class="sys_social_title" value="'.$sys_social_item[0].'" /></td>';
								$output .= '<td><a href="#" class="sys_social_item_delete button button-primary red-button">Delete</a></td>';
								$output .= '</tr>';
							}
						}
						$output .= '</table>';
						$output .= '<p>';
						$output .= '<button name="sys_add_social_book" id="sys_add_social_item" type="button" value="Add New Row" class="button button-primary red-button" /><span>Add New</span></button>';
						$output .= '<input type="hidden" id="atp_social_bookmark" name="atp_social_bookmark"/>';	
						$output .= '</p>';
						$output .= '</div></div>';
						break;
				// S I D E B A R 
				//---------------------------------
				case 'customsidebar':
						$output .= '<h3>'. $value['name'] .'</h3>'."\n";
						$output .= '<div class="controls" >'."\n";
						$val = $value['std'];
						$std = get_option($value['id']);
						$custom_sidebar_arr=@get_option($value['id']);
						// print_r($custom_sidebar_arr);
						if ( $std != "") { $val = $std; }
						$output.= '<div id="custom_widget_sidebar"><table id="custom_widget_table" cellpadding="0" cellspacing="0">';
						$output.='<tbody>';
						
						if($custom_sidebar_arr !=""){
							foreach($custom_sidebar_arr as $custom_sidebar_code) {
								$output.='<tr><td><input type="text" name="'.$value['id'].'[]" value="'. $custom_sidebar_code.'"  size="30" style="width:97%" /></td><td><a class="button button-secondary" href="javascript:void(0)" onClick="jQuery(this).parent().parent().remove();">Delete</a></td></tr>';
							}
						}				
						$output.='</tbody></table><button type="button" class="button button-primary button-large" name="add_custom_widget" value="Add Sidebar" onClick="addWidgetRow()">Add Sidebar</button></div>';
						?>
						<script type="text/javascript" language="javascript">
							function addWidgetRow(){
								jQuery('#custom_widget_table').append('<tr><td><input type="text" name="<?php echo $value['id'];?>[]" value="" size="30" style="width:97%" /></td><td><a class="button button-secondary" href="javascript:void(0)" onClick="jQuery(this).parent().parent().remove();">Delete</a></td></tr>');
							}
						</script>
						<?php
						$output .= '</div>';
						$output .= '<div class="explain">'. $explain_value .'</div>';
						break;	
		
				// T E X T A R E A
				//---------------------------------
				case 'textarea':
						$cols = '8';
						$ta_value = '';
						$output .= '<h3>'. $value['name'] .'</h3>'."\n";
						$output .= '<div class="explain">'. $explain_value .'</div>';
						$output .= '<div class="controls" >'."\n";
						if(isset($value['std'])) {
							$ta_value = $value['std']; 
							if(isset($value['options'])){
								$ta_options = $value['options'];
								if(isset($ta_options['cols'])){
									$cols = $ta_options['cols'];
								} else { 
									$cols = '8'; 
								}
							}
						}
						$std = get_option($value['id']);
						if( $std != "") { $ta_value = stripslashes($std); }
						$output .= '<textarea class="atp-input" name="'. $value['id'] .'" id="'. $value['id'] .'" cols="'. $cols .'" rows="8">'.esc_textarea($ta_value).'</textarea>';
						$output .='</div>';
						break;
					
				// E X P O R T
				//---------------------------------
				case 'export':
						$cols = '8';
						$ta_value = '';
						$std = get_option($value['id']);
						if( $std != "") { $ta_value = stripslashes( $std ); }
						$output .= '<h3>'. $value['name'] .'</h3>'."\n";
						$output .= '<div class="controls" >'."\n";
						//$output .= serialize((get_option('atp_template_option_values')));
						$output .= '<textarea class="atp-input" cols="'. $cols .'" rows="8">'.base64_encode(serialize((get_option('atp_template_option_values')))).'</textarea>';
						$output .= '</div>';
						$output .= '<div class="explain">'. $explain_value .'</div>';
						break;
				
				// I M P O R T
				//---------------------------------
				case 'import':
						$cols = '8';
						$ta_value = '';
						$output .= '<h3>'. $value['name'] .'</h3>'."\n";
						$output .= '<div class="controls" >'."\n";
						$output .= '<textarea class="atp-input" name="'. $value['id'] .'" id="'. $value['id'] .'" cols="'. $cols .'" rows="8"></textarea>';
						$output .= '</div>';
						$output .= '<div class="explain">'. $explain_value .'</div>';
						break;
				
				// R A D I O 
				//---------------------------------
				case "radio":
						$select_value = get_option( $value['id']);
						$output .= '<h3>'. $value['name'] .'</h3>'."\n";
						foreach ($value['options'] as $key => $option) { 
							$checked = '';
							if($select_value != '') {
								if ( $select_value == $key) { $checked = ' checked'; } 
							} else {
								if ($value['std'] == $key) { $checked = ' checked'; }
							}
							$output .= '<div class="controls" >'."\n";
							$output .= '<input class="atp-input atp-radio" type="radio" name="'. $value['id'] .'" value="'. $key .'" '. $checked .' />' . $option .'<br />';
							$output .= '</div>';
							
						}
						$output .='<div class="explain">'. $explain_value .'</div>';
						break;
			
				// CHECKBOX
				//---------------------------------
				case "checkbox": 
						$std = $value['std'];  
						$saved_std = get_option($value['id']);
						$checked = '';
						
						if(!empty($saved_std)) {
							if($saved_std == 'on') {
								$checked = 'checked="checked"';
							}else{
								$checked = '';
							}
						}
						elseif( $std == 'on') {
							$checked = 'checked="checked"';
						}else {
							$checked = '';
						}

						$output .= '<h3>'. $value['name'] .'</h3>'."\n";
						$output .= '<div class="controls" >'."\n";
						$output .= '<input type="checkbox" class="checkbox" value="on" id="'. $value['id'] .'" name="'.  $value['id'] .'" '. $checked .' />';
						$output .= '</div>';
						$output .= '<div class="explain"><label for="'. $value['id'] .'">'. $explain_value .'</label></div>';
						break;
			
				// M U L T I   C H E C K B O X
				//---------------------------------
				case "multicheck":
						$std =  $value['std'];
						$output .= '<h3>'. $value['name'] .'</h3>'."\n";
						$output .= '<div class="controls" >'."\n";
						foreach ($value['options'] as $key => $option) {
							$checked = ""; 
							if (get_option( $value['id'])) {
								if (@in_array($key, get_option($value['id'] ))) $checked = "checked=\"checked\"";
							} else {
								//Empty Value if Unchecked
							}
							$output .= '<input type="checkbox" class="checkbox" name="'. $value['id'] .'[]" id="'. $key .'" value="'.$key.'" '. $checked .' /> <label for="'. $key .'">'. $option .'</label><br>';
						}
						$output .= '</div>';
						$output .= '<div class="explain">'. $explain_value .'</div>';
						break;
		
				// U P L O A D 
				//---------------------------------
				case "upload":
						$output .= '<h3>'. $value['name'] .'</h3>'."\n";
						$output .= '<div class="controls" >'."\n";
						$output .= optionsframework_medialibrary_uploader( $value['id'], $val, null );
						$output .= '</div>';
						$output .= '<div class="explain">'. $explain_value .'</div>';
						break;
			
				// C O L O R 
				//---------------------------------
				case "color":
						$val = $value['std'];
						$stored  = get_option( $value['id'] );
						if ( $stored != "") { $val = $stored; }
						$output .= '<h3>'. $value['name'] .'</h3>'."\n";
						$output .= '<div class="controls" >'."\n";
						$output .= '<input class="color" name="'. $value['id'] .'" id="'. $value['id'] .'" type="text" value="'. $val .'" />';
						$output .= '<div class="wpcolorSelector"><div  id="' . $value['id'] . '_picker" ></div></div>';
						$output .= '</div>';
						$output .= '<div class="explain">'. $explain_value .'</div>';
						break;

				// T Y P O G R A P H Y
				//---------------------------------
				case "typography":
						$default = $value['std'];
						$typography_stored = get_option($value['id']);
						$output .= '<h3 class="heading">'. $value['name'] .'</h3>'."\n";
						$output .= '<div class="controls" >'."\n";
	
						// C O L O R  
						if(isset($default['color'])){
							$val = $default['color'];
						}
						if ( $typography_stored['color'] != "") {
							$val = $typography_stored['color'];
						}
						$output .= '<div class="typocolor"><input class="atp-color atp-typography color" name="'. $value['id'] .'_color" id="'. $value['id'] .'_color" type="text" value="'. $val .'" />';
						$output .= '<div class="wpcolorSelector"><div id="' . $value['id'] . '_color_picker"></div></div></div>';

						// F O N T   S I Z E 
						$val = $default['size'];
						if ( $typography_stored['size'] != "") { $val = $typography_stored['size']; }
						$output .= '<div class="atp-typo-size"><div class="select_wrapper"><select class="select" name="'. $value['id'].'_size" id="'. $value['id'].'_size">';
						$output .= '<option value="">Font Size</option>';
						for ($i = 9; $i < 71; $i++){ 
							if($val == $i){
								$active = 'selected="selected"'; 
							} else { 
								$active = ''; 
							}
							$output .= '<option value="'. $i .'px" ' . $active . '>'. $i .'px</option>'; 
						}
						$output .= '</select></div></div>';
						
						// L I N E   H E I G H T 
						$val = $default['lineheight'];
						if ( $typography_stored['lineheight'] != "") { $val = $typography_stored['lineheight']; }
						$output .= '<div class="atp-typo-lineheight"><div class="select_wrapper"><select class="select" name="'. $value['id'].'_lineheight" id="'. $value['id'].'_lineheight">';
						$output .= '<option value="">Line Height</option>';
						for ($i = 9; $i < 71; $i++){
							if($val == $i){
								$active = 'selected="selected"'; 
							} else {
								$active = ''; 
							}
							$output .= '<option value="'. $i .'px" ' . $active . '>'. $i .'px</option>'; 
						}
						$output .= '</select></div></div>';
						
						// F O N T   S T Y L E 
						$val = $default['style'];
						if ( $typography_stored['style'] != "") { $val = $typography_stored['style']; }
							$normal = ''; $italic = '';
						if($val == 'normal')	{ $normal = 'selected="selected"'; }
						if($val == 'italic')	{ $italic = 'selected="selected"'; }
			
				
						$output .= '<div class="atp-typo-style"><div class="select_wrapper"><select class="select" name="'. $value['id'].'_style" id="'. $value['id'].'_style">';
						$output .= '<option value="">Font-Style</option>';
						$output .= '<option value="normal" '. $normal .'>Normal</option>';
						$output .= '<option value="italic" '. $italic .'>Italic</option>';
						$output .= '</select></div></div>';
						
						// F O N T   V A R I A N T
						if(isset($default['fontvariant'])){
						$val = $default['fontvariant'];
						}
						if ( $typography_stored['fontvariant'] != "") { $val = $typography_stored['fontvariant']; }
							$array_weight=array(
								'normal'=>'Normal',
								'bold'=>'Bold',
								'lighter'=> 'Lighter',
								'100'=>'100',
								'200'=>'200',
								'300'=>'300',
								'400'=>'400',
								'500'=>'500',
								'600'=>'600',
								'700'=>'700',
								'800'=>'800',
								'900'=>'900');
				
						$output .= '<div class="atp-typo-fontvariant"><div class="select_wrapper"><select class="select" name="'. $value['id'].'_fontvariant" id="'. $value['id'].'_fontvariant">';
						$output .= '<option value="">Font-Variant</option>';
							foreach($array_weight as $key =>$values)
							{  	$fontselected='';
									if($val == $key)	{ $fontselected= 'selected="selected"'; }
								$output .= '<option value="'.$key.'" '.$fontselected.'>'.$values.'</option>';
							}
						$output .= '</select>';
						$output .= '</div></div>';
						$output .= '</div>'; // section-typography end.
						$output .= '<div class="explain">'. $explain_value .'</div>';
						break;
				// F O N T  F A M I L Y S E L E C T
				case 'atpfontfamily':
						global $iva_fontface;
						$output .= '<h3>'. $value['name'] .'</h3>'."\n";
						$output .= '<div class="controls" >'."\n";
						$output .= '<div class="select_wrapper '.$value['class'].'">';
						$output .= '<select class="of-input select  google_font_select" name="'.$value['id'].'" id="'. $value['id'] .'">';
						foreach ($value['options'] as $select_key => $option) {
							$output .= '<option value="'.$select_key.'" ' . selected(get_option($value['id']),$key, false) . ' />'.$option.'</option>';
						} 
						$google_fonts = atp_google_webfonts();
						$output .= '<optgroup label="Google Web Fonts">';
						foreach ( $google_fonts as $key => $googlefont ) {
							$name = $googlefont['name'];
							$output .= '<option value="'.$name.'" ' . selected(get_option($value['id']),$name, false) . ' />'.$name.'</option>';
						}
						$output .= '</optgroup>';
						$output .= '</select></div>';
						
						if(isset($value['preview']['text'])){
							$g_text = $value['preview']['text'];
							
						} else {
							$g_text = '0123456789 ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmnopqrstuvwxyz';
							
						}
						if(isset($value['preview']['size'])) {
							$g_size = 'style="font-size: '. $value['preview']['size'] .';"';
							
						} else { 
							$g_size = '';
						}
						$hide = "hide";
						if (get_option($value['id']) != "")
							$hide = "";
						$output .= '<p  class="'.$value['id'].'_ggf_previewer google_font_preview '.$hide.'" '. $g_size .'>'. $g_text .'</p>';
						$output.='</div>';
						$output .= '<div class="explain">'. $explain_value .'</div>';
						break;
	
				// B A C K G R O U N D
				//---------------------------------
				case "background":
						$output .= '<h3>'. $value['name'] .'</h3>'."\n";
						$output .= '<div class="controls" >'."\n";
						$default = $value['std'];
						$background_stored = get_option( $value['id'] );
		
						// U P L O A D   I M A G E 
						$val = $default['image'];
						$imgid=$value['id'].'_image';	
						if ( $background_stored['image'] != "") { $val = $background_stored['image']; }	
						$output .= '<div class="atp-background-upload clearfix">';
						$output .= optionsframework_medialibrary_uploader($imgid,$val,null);	
						$output .= '</div>';	

						// C O L O R 
						$val = $default['color'];
						if ( $background_stored['color'] != "") { $val = $background_stored['color']; }			
						$output .= '<div class="atp-background-color">';
						$output .= '<input class="color" name="'. $value['id'] .'_color" id="'. $value['id'] .'_color" type="text" value="'. $val .'" />';
						$output .= '<div class="wpcolorSelector"><div  id="' . $value['id'] . '_color_picker" ></div></div>';
						$output .= '</div>';
						
						// R E P E A T 
						$val = $default['style'];
						if ( $background_stored['style'] != "") { $val = $background_stored['style']; }
						$repeat = ''; $norepeat = ''; $repeatx = ''; $repeaty = '';
						if($val == 'repeat')	{ $repeat = 'selected="selected"'; }
						if($val == 'no-repeat')	{ $norepeat = 'selected="selected"'; }
						if($val == 'repeat-x')	{ $repeatx = 'selected="selected"'; }
						if($val == 'repeat-y')	{ $repeaty = 'selected="selected"'; }
						$output .= '<div class="atp-background-repeat">';
						$output .= '<div class="select_wrapper">';
						$output .= '<select class="atp-background select" name="'. $value['id'].'_style" id="'. $value['id'].'_style">';
						$output .= '<option value="repeat" '. $repeat .'>Repeat</option>';
						$output .= '<option value="no-repeat" '. $norepeat .'>No-Repeat</option>';
						$output .= '<option value="repeat-x" '. $repeatx .'>Repeat-X</option>';
						$output .= '<option value="repeat-y" '. $repeaty .'>Repeat-Y</option>';
						$output .= '</select>';
						$output .= '</div></div>';
						
						// P O S I T I O N 
						$val = $default['position'];
						if ( $background_stored['position'] != "") { $val = $background_stored['position']; }
							$lefttop = ''; $leftcenter = ''; $leftbottom = ''; $righttop = ''; $rightcenter = ''; $rightbottom = ''; $centertop = ''; $centercenter = ''; $centerbottom = ''; 
						if($val == 'left top')		{ $lefttop = 'selected="selected"'; }
						if($val == 'left center')	{ $leftcenter = 'selected="selected"'; }
						if($val == 'left bottom')	{ $leftbottom = 'selected="selected"'; }
						if($val == 'right top')		{ $righttop = 'selected="selected"'; }
						if($val == 'right center')	{ $rightcenter = 'selected="selected"'; }
						if($val == 'right bottom')	{ $rightbottom = 'selected="selected"'; }
						if($val == 'center top')	{ $centertop = 'selected="selected"'; }
						if($val == 'center center')	{ $centercenter = 'selected="selected"'; }
						if($val == 'center bottom')	{ $centerbottom = 'selected="selected"'; }
						$output .= '<div class="atp-background-position">';
						$output .= '<div class="select_wrapper">';
						$output .= '<select class="atp-background select" name="'. $value['id'].'_position" id="'. $value['id'].'_style">';
						$output .= '<option value="left top" '. $lefttop .'>Left Top</option>';
						$output .= '<option value="left center" '. $leftcenter .'>Left Center</option>';
						$output .= '<option value="left bottom" '. $leftbottom .'>Left Bottom</option>';
						$output .= '<option value="right top" '. $righttop .'>Right Top</option>';
						$output .= '<option value="right center" '. $rightcenter .'>Right Center</option>';
						$output .= '<option value="right bottom" '. $rightbottom .'>Right Bottom</option>';
						$output .= '<option value="center top" '. $centertop .'>Center Top</option>';
						$output .= '<option value="center center" '. $centercenter .'>Center Center</option>';
						$output .= '<option value="center bottom" '. $centerbottom .'>Center Bottom</option>';
						$output .= '</select>';
						$output .='</div></div>';
						
						// A T T A C H M E N T
						$val = $default['attachment'];
						if ( $background_stored['attachment'] != "") {
							$val = $background_stored['attachment'];
						}
						$fixed = $scroll = '';
						if($val == 'fixed')  { $fixed = 'selected="selected"'; }
						if($val == 'scroll') { $scroll = 'selected="selected"'; }
						$output .= '<div class="atp-background-attachment">';
						$output .= '<div class="select_wrapper">';
						$output .= '<select class="atp-background select" name="'. $value['id'].'_attachment" id="'. $value['id'].'_style">';
						$output .= '<option value="fixed" '. $fixed .'>Fixed</option>';
						$output .= '<option value="scroll" '. $scroll .'>Scroll</option>';
						$output .= '</select>';
						$output .= '</div></div>';
						$output .= '</div>'; //controls part end
						$output .= '<div class="explain">'. $explain_value .'</div>';
						break;

				// I M A G E S 
				//---------------------------------
				case "images":
						$i = 0;
						$output .= '<h3>'. $value['name'] .'</h3>'."\n";
						$output .= '<div class="controls" >'."\n";
						$select_value = get_option( $value['id']);
						foreach ( $value['options'] as $key => $option ) {
							$i++;
							$checked = $selected ='';

							if($select_value != '') {
								if ( $select_value == $key) { $checked = ' checked'; $selected = 'atp-radio-option-selected'; } 
							} else {
								if ($value['std'] == $key) { $checked = ' checked'; $selected = 'atp-radio-option-selected'; }
									elseif ($i == 1  && !isset($select_value)) { $checked = ' checked'; $selected = 'atp-radio-option-selected'; }
									elseif ($i == 1  && $value['std'] == '') { $checked = ' checked'; $selected = 'atp-radio-option-selected'; }
								else { $checked = ''; }
							}
							$output .= '<span>';
							$output .= '<input type="radio" id="atp-radio-img-' . $value['id'] . $i . '" class="checkbox atp-radio-img-radio" value="'.$key.'" name="'. $value['id'].'" '.$checked.' />';
							$output .= '<div class="atp-radio-img-label">'. $key .'</div>';
							$output .= '<img src="'.esc_url( $option ).'" alt="" class="atp-radio-option '. $selected .'" onClick="document.getElementById(\'atp-radio-img-'. $value['id'] . $i.'\').checked = true;" />';
							$output .= '</span>';
						}
						$output .= '</div>';
						$output .= '<div class="explain">'. $explain_value .'</div>';
						break;
				// H E A D I N G 
				//---------------------------------
				case "heading":
						if($counter >= 2){
							$output .= '</div>'."\n";
						}
						$jquery_click_hook = str_replace( ' ', '', strtolower( $value['name'] ));
						$jquery_click_hook = "atp-option-" . trim(preg_replace('/ +/', '', preg_replace('/[^A-Za-z0-9 ]/', '', urldecode(html_entity_decode(strip_tags($jquery_click_hook))))));
						$output .= '<div class="group" id="'. $jquery_click_hook  .'">'."\n";
						break;
				//S U B  N A V I G A T I O N
				//---------------------------------
				case "subnav":
						if($counter >= 2){
							$output .= '</div>'."\n";
						}
						$jquery_click_hook = str_replace( ' ', '', strtolower( $value['name'] ));
						$jquery_click_hook = "atp-option-" . trim(preg_replace('/ +/', '', preg_replace('/[^A-Za-z0-9 ]/', '', urldecode(html_entity_decode(strip_tags($jquery_click_hook))))));
						$output .= '<div class="group" id="'. $jquery_click_hook  .'">'."\n";
						break;
				
				case 'export_backupoptions':
						$output .= '<form class="export_form" method="post" enctype="multipart/form-data">';
						$output .= '<h3>'. $value['name'] .'</h3>'."\n";
						$output .= '<div class="controls" >'."\n";
						$output .= '<div class="iva_export_ob_msg"></div>';
						
						// Export Backup options
						$output .= '<span class="iva_style_wrap"><a href="#" class="export-data-btn button-primary button-large" data_url= '.admin_url("admin.php?page=optionsframework").'>'.__('Export Options','iva_theme_admin').'</a></span>';
						$output .= '<div class="clearfix"></div>';
						
						$ob_path = FRAMEWORK_DIR.'/admin/options_backup/'; 
						$latest_ctime = 0;
						$entry = $latest_ob_filename = '';    
				
						$dir_instance = dir( $ob_path );
						while ( false !== ( $entry = $dir_instance->read() ) ) {
							$ob_filepath = "{$ob_path}/{$entry}";
							
							// could do also other checks than just checking whether the entry is a file
							if ( is_file( $ob_filepath ) && filectime( $ob_filepath ) > $latest_ctime ) {
								$latest_ctime = filectime( $ob_filepath );
								$latest_ob_filename = $entry;
							}
						}
						
						$theme_options_txt_files1  = array();
						if( is_dir( FRAMEWORK_DIR.'/admin/options_backup/' ) ) {
							if( $theme_options_backup_dir = opendir( FRAMEWORK_DIR . '/admin/options_backup/' ) ) {
								while( ( $theme_options_txt_file = readdir( $theme_options_backup_dir ) ) !== false) {
									if( stristr( $theme_options_txt_file, '.txt') !== false ) {
										$theme_options_txt_files1[ $theme_options_txt_file] = $theme_options_txt_file;
									}
								}
							}
						}
						
						
						if( !empty( $theme_options_txt_files1 ) ){
					
							$ob_file_info = pathinfo( $latest_ob_filename ); 
							$ob_file_name = $ob_file_info['filename'];
							
							$output .='<div class="export_wrap">';
							$output .='<div class="export_ob_wrap"><div class="export_ob_title">'.$ob_file_name.'</div></div>';
							$output .='<div class="export_ob_btn"><span><a class="ob_download button green-button" data_download="'.$latest_ob_filename.'">'.__('download','iva_theme_admin').'</a></span></div>';
							$output .= '</div>';//.export_wrap
						}
						
						$output .= '<div class="clearfix"></div>';
						
						$output .= '</div>';//.controls
						$output .= '<div class="explain">'. $explain_value .'</div>';
						$output .= '<script>
						jQuery(document).ready(function () {
							jQuery(".ob_download").click(function(){
								var ob_download_file = jQuery(this).attr("data_download");
								jQuery.post(
									atp_panel.SiteUrl+"/framework/admin/ob_import_export.php",
									{ 
									download_file:ob_download_file,
									},
									function(response) {
										window.location	= atp_panel.SiteUrl+"/framework/admin/ob_import_export.php?download_file="+ob_download_file+"";
									}
								);
							});
							jQuery(".export-data-btn").click(function(){
								
								var iva_admin_url = jQuery(this).attr("data_url");
								jQuery.ajax({ 
									type: "POST",
									url:ajaxurl,
									data: { action: "iva_export_ob" },
									success: function( response ){ 
										jQuery(".iva_export_ob_msg").html("Export Options Backup Successfully Please wait a few seconds untill reload the page");
										jQuery(".iva_export_ob_msg").css( "display", "block" );
										window.location = iva_admin_url;
										window.location.reload(true);
									}
								});
							});
						});
						</script>';
						break;
			
				case 'import_backupoptions':
						$output .= '<form class="export_form" method="post" enctype="multipart/form-data">';
						$output .= '<h3>'. $value['name'] .'</h3>'."\n";
						$output .= '<div class="controls" >'."\n";
						$output .= '<div class="iva_import_ob_msg"></div>';

								
						$output .= '<div class="clearfix"></div>';
					
						$theme_options_txt_files  = array();
						if( is_dir( FRAMEWORK_DIR.'/admin/options_backup/' ) ) {
							if( $theme_options_backup_dir = opendir( FRAMEWORK_DIR . '/admin/options_backup/' ) ) {
								while( ( $theme_options_txt_file = readdir( $theme_options_backup_dir ) ) !== false) {
									if( stristr( $theme_options_txt_file, '.txt') !== false ) {
										$theme_options_txt_files[ $theme_options_txt_file] = $theme_options_txt_file;
									}
								}
							}
						}
						ksort($theme_options_txt_files);
						
						if( !empty( $theme_options_txt_files ) ){ 
							$i=1;
							foreach( $theme_options_txt_files as $ob_txt_name => $ob_txt_value ){
								$ob_file_info = pathinfo( $ob_txt_value ); 
								$ob_file_name = $ob_file_info['filename'];
								
								$output .='<div class="export_wrap">';
								$output .='<div class="export_ob_wrap"><div class="export_ob_title">'.$i.'. '.$ob_file_name.'</div></div>';
								$output .='<div class="export_ob_btn">';
								$output .='	<span><a class="ob_import button green-button" data_url= '.admin_url("admin.php?page=optionsframework").' data_import="'.$ob_txt_name.'">'.__('Import','iva_theme_admin').'</a></span>';
								$output .='	<span><a class="ob_delete button red-button" data_url= '.admin_url("admin.php?page=optionsframework").' data_delete="'.$ob_txt_name.'" >'.__('Delete','iva_theme_admin').'</a></span>';
								$output .= '</div>';//.export_ob_btn
								$output .= '</div>';//.export_wrap
								$i++;
							}
						}
						$output .= '<div class="clearfix"></div>';

						$iva_ob_txtarea_cols = '8';
						$output .= '<div class="import-options-bkp">';
						$output .= '<p>Input your sample options data exported in a text file to restore. Copy the content from the text file then place in below textarea and hit <strong>Import File</strong> button</p>';
						$output .= '<textarea class="atp-input import_ob_input" id="import_ob_input" cols="'. $iva_ob_txtarea_cols .'" rows="8" data_url= '.admin_url("admin.php?page=optionsframework").'></textarea>';
						$output .='	<span><a class="import_options_btn button green-button button-hero" data_url= '.admin_url("admin.php?page=optionsframework").'>'.__('Import File','iva_theme_admin').'</a></span>';
						$output .= '</div>';
			
						$output .= '</div>';//.controls
						$output .= '<div class="explain">'. $explain_value .'</div>';
						
						$output .= '<script>
						jQuery(document).ready(function () {
							jQuery(".import_options_btn").click(function(){
								 var import_ob_input_value = jQuery(".import_ob_input").val();
								 var iva_admin_url = jQuery(this).attr("data_url");
								 
								 if( import_ob_input_value == "" ){
									alert("Enter content from a txt file.");
									return false;
								 }
								 if( import_ob_input_value ){
									jQuery.ajax({ 
										type: "POST",
										url:ajaxurl,
										data: { 
											action: "iva_import_ob_from_file" ,
											"import_ob_file": import_ob_input_value,
											},
										success: function( response ){ 
											
											jQuery(".iva_import_ob_msg").html("Imported Successfully Please wait a few seconds untill reload the page");
											jQuery(".iva_import_ob_msg").css( "display", "block" );
											
											window.location = iva_admin_url;
											window.location.reload(true);
										}
									});
								}	 
							}); 
						
							jQuery(".ob_delete").click(function(){
								var ob_delete_file = jQuery(this).attr("data_delete");
								var iva_admin_url = jQuery(this).attr("data_url");
								if( confirm("Are you sure you want to delete file permanently?") ){
									jQuery(this).parent().parent().parent().remove();
									jQuery.ajax({ 
										type: "POST",
										url:ajaxurl,
										data: { 
											action: "iva_delete_ob" ,
											"delete_file": ob_delete_file,
											},
										success: function( response ){ 
											
											jQuery(".iva_import_ob_msg").html("Deleted successfully Please wait a few seconds untill reload the page");
											jQuery(".iva_import_ob_msg").css( "display", "block" );
											
											window.location = iva_admin_url;
											window.location.reload(true);
										}
									});
								}	
							});
							jQuery(".ob_import").click(function(){
								var iva_admin_url = jQuery(this).attr("data_url");
								var iva_ob_import = jQuery(this).attr("data_import");
								
								jQuery.ajax({ 
									type: "POST",
									url:ajaxurl,
									data: { 
										action: "iva_import_ob" ,
										"ob_import":iva_ob_import,
									},
									success: function( response ){ 
										jQuery(".iva_import_ob_msg").html("Imported Successfully Please wait a few seconds untill reloading the page");
										jQuery(".iva_import_ob_msg").css( "display", "block" );
										// setInterval(function(){
											// jQuery(".iva_import_ob_msg").css( "display", "none" );
										// },2000);
										window.location = iva_admin_url;
										window.location.reload(true);
									}
								});
							});
						});
						</script>';
						break;
				
					case 'importsampledata':
						$output .= '<div class="one-click"></div>';
						$output .= '<form class="import_form" method="post" enctype="multipart/form-data">';
						$output .= '<div class="iva_import_content">';
						$output .= '<h1>'. $value['name'] .'</h1>';
						$output .= $explain_value;
						// Success message
						$output .= '<span class="iva_import_result"></span>';
						// Button
						$output .= '<div class="iva_import_button"><a href="#" class="import-data-btn button button-primary green-button button-hero">Import Sample Content</a></div>';
						$output .= '<div class="iva_import_alerts">';
						// Loader
						$output .= '<span class="iva_loading iva_import_loading"></span>';
						// Waiting message
						$output .= '<div class="iva_import_wait"><strong>Import Started.</strong><br/>Please wait a few seconds and dont reload the page. You will be notified as soon as the import has finished! :)</div>';
						$output .= '</div>';
						$output .= '</div>';
						$output .= '<script>
						jQuery(document).ready(function () {
							jQuery(".import-data-btn").click(function(){
								activate = confirm("Importing the sample data will overwrite your current pages and content. Please make sure you take a backup of content and proceed with importing.");
								if(activate == false) return false; 
								jQuery.ajax({ 
									type: "POST",
									url:ajaxurl,
									data: { action: "iva_importer" },
									beforeSend: function()
									{
										//Show loader
										jQuery(".iva_loading").css({ opacity:0, display:"block"}).animate({opacity:1});
										jQuery(".iva_import_wait").show();
									},
									success: function(response)
									{	
										jQuery(".iva_import_result").css({ display:"inline-block"});
										
										if(response.match("No xml file exists in data folder")){
											jQuery(".iva_import_result").html("No xml file exists in data folder");
										}
										else if(response.match("An Error Occurred During Import")){
											jQuery(".iva_import_result").html("An Error Occurred During Import");
										}else if(response.match("All done")){
											jQuery(".iva_import_result").html("Content Imported Successfully");
										}else if(response.match("already exists")){
											jQuery(".iva_import_result").html("Content Imported Successfully");
										}
										setInterval(function(){
											jQuery(".iva_import_result").css( "display", "none" );
										},3000);
									},
									complete: function( response )
									{	
										jQuery(".iva_import_wait").hide();
										jQuery(".iva_loading").css({ display:"none"});   
									}
								});
							});
						});
						</script>';
						break;
				// Mega menu case	
				case 'mmenu_ancestor':
						$output .= '<h3>'. $value['name'] .'</h3>'."\n";
						$output .= '<div class="controls" >'."\n";
						
						$mm_img_val = $mm_position ='';						
						$mm_pright = $mm_pbottom = $mm_pleft ='0';						
						
						$mm_img_id = $value['id'].'_image';
						
						$mmenu_stored = get_option( $value['id'] );
						if( $mmenu_stored != ''){
							$mm_img_val		=	$mmenu_stored['image'];	 
							$mm_pright 		=	$mmenu_stored['pright'];
							$mm_pbottom 	=	$mmenu_stored['pbottom'];
							$mm_pleft		=	$mmenu_stored['pleft'];
							$mm_position 	=	$mmenu_stored['position'];
						}
						
						$output .= '<div class="mm_upload atp-background-upload clearfix">';
						$output .= optionsframework_medialibrary_uploader( $mm_img_id,$mm_img_val,null );
						$output .= '</div>';
						
						$position_lb = $position_rb = $position_cb = ''; 
						
						// Adds selected attribute for the option value
						if ( $mm_position == 'left bottom')     { $position_lb = ' selected="selected"' ; }
						if ( $mm_position == 'right bottom')    { $position_rb = ' selected="selected"' ; }
						if ( $mm_position == 'center bottom')   { $position_cb = ' selected="selected"' ; }
						$output .= '<div class="mm_desc">Background position</div>';
						$output .= '<div class="select_wrapper select200">';
						$output .= '<select class="atp-background select" name="'. $value['id'].'_position" id="'. $value['id'].'_position">';
						$output .= '<option value="left bottom" '. $position_lb .'>Left Bottom</option>';
						$output .= '<option value="right bottom" '. $position_rb .'>Right Bottom</option>';
						$output .= '<option value="center bottom" '. $position_cb .'>Center Bottom</option>';
						$output .= '</select>';
						$output .= '</div>';//select_wrapper
						
						$output .= '<div class="clear"></div>';
						
						$output .= '<div class="mm_wrap">';
						$output .= '<div class="mm_desc">Padding</div>';
						$output .= '<input class="input40 input_disable" name="'. $value['id'] .'_ptop" id="'. $value['id'] .'_ptop" type="text" readonly="readonly" value="25"/>';
						$output .= '<input class="input40" name="'. $value['id'] .'_pright" id="'. $value['id'] .'_pright" type="text"  value="'. $mm_pright .'" />';
						$output .= '<input class="input40" name="'. $value['id'] .'_pbottom" id="'. $value['id'] .'_pbottom" type="text" value="'. $mm_pbottom .'" />';
						$output .= '<input class="input40" name="'. $value['id'] .'_pleft" id="'. $value['id'] .'_pleft" type="text" value="'. $mm_pleft .'" />';
						$output .= '<div class="mm_desc"><span>Top</span><span>Right</span><span>Bottom</span><span>Left</span></div>';
						$output .= '</div>';//mm_wrap
						$output .= '</div>'; //controls part end
						$output .= '<div class="explain">'. $explain_value .'</div>';
						break;
			}
			//------------------------------------
			//	E N D   S W I T C H   C A S E 
			//------------------------------------
		
			// Option Value Type
			// if TYPE is an array, formatted into smaller inputs... ie smaller values
			if ( is_array($value['type'])) {
				foreach($value['type'] as $array){
					$id = $array['id']; 
					$std = $array['std'];
					$saved_std = get_option($id);
					if($saved_std != $std){
						$std = $saved_std;
					} 
					$meta = $array['meta'];
					if($array['type'] == 'text') { // Only text at this point
						$output .= '<input class="input-text-small atp-input" name="'. $id .'" id="'. $id .'" type="text" value="'. $std .'" />';  
						$output .= '<span class="meta-two">'.$meta.'</span>';
					}
				}
			}
			
			// Option Value not equals to Headings and checkbox
			if ( $value['type'] != "heading" && $value['type'] != "subnav" ) {
				if ( $value['type'] != "checkbox" ){ 
					$output .= '';
				}
				$output .= '</div>'."\n";
			}
		} // E N D - for each
		
		if ( count( $menuitems ) > 0 ) {
		
			$menu = '';

			foreach ( $menuitems as $key => $value ) {
				if ( isset( $v['icon'] ) && ( $v['icon'] != '' ) ) {
					//$class = $v['icon'];
				}
				
				if ( isset( $value['children'] ) && ( count( $value['children'] ) > 0 ) ) {
					$class = 'parent';
					$hasdropdown = 'class="dropmenu"';
				}else{  
					$class="parent no-child"; 
					$hasdropdown = '';
				}
				
				$menu .= '<li '.$hasdropdown.'>' . "\n" . ''; 
				
				$menu .= '<a class="' . $class . '" title="' . $value['name'] . '" href="#' . $value['head'] . '"><img src="' .esc_url( $value['icon'] ). '" height="16" alt=""/> ' . $value['name'] . '</a>' . "\n";
				if ( isset( $value['children'] ) && ( count( $value['children'] ) > 0 ) ) {
					$menu .= '<ul class="sub-menu">' . "\n";
						foreach ( $value['children'] as $i => $j ) {
							$menu .= '<li>' . "\n" . '<a  title="' . $j['name'] . '" href="#' . $j['head'] . '">' . $j['name'] . '</a></li>' . "\n";
						}
					$menu .= '</ul>' . "\n";
				}
				$menu .= '</li>' . "\n";

			}
		}
	
		$output .= '</div>';
		return array( $output, $menu, $menuitems );
	}
	// E N D   -   O P T I O N S   F R A M E W O R K   M A C H I N E 
	//--------------------------------------------------------------
	
	/**
	 * Media Uploader Using the WordPress Media Library.
	 *
	 * Parameters:
	 * - string $_id - A token to identify this field (the name).
	 * - string $_value - The value of the field, if present.
	 * - string $_mode - The display mode of the field.
	 * - string $_desc - An optional description of the field.
	 * - int $_postid - An optional post id (used in the meta boxes).
	 *
	 * Dependencies:
	 * - optionsframework_mlu_get_silentpost()
	 */
	if ( ! function_exists( 'optionsframework_medialibrary_uploader' ) ) {
		function optionsframework_medialibrary_uploader($_id, $_value, $_mode = 'full', $_desc = '', $_postid = 0, $_name = '') {
			
			/* earlier code
			$optionsframework_settings = get_option($_id);
			//print_r($optionsframework_settings);
			
			// Gets the unique option id
			$option_name = $optionsframework_settings['id'];
			*/

			/* new code*/
			$option_name = get_option($_id);
			/* end new code */
			$output = $id = $class = $int = $name = '';
			$value = get_option($_id);
			$id = strip_tags( strtolower( $_id ) );
			// Change for each field, using a "silent" post. If no post is present, one will be created.
			$int ='';
			// If a value is passed and we don't have a stored value, use the value that's passed through.
			if ( $_value != '' && $value == '' ) {
				$value = $_value;
			}
			if ($_name != '') {
				$name = $option_name.'['.$id.']['.$_name.']';
			}
			else {
				$name = $option_name.'['.$id.']';
			}
		
			if ( $value ) { $class = ' has-file'; }
			$output .= '<input id="' . $id . '" class="upload' . $class . '" type="text" name="'.$id.'" value="' . $value . '" />' . "\n";
			$output .= '<input id="upload_' . $id . '" class="upload_button button-primary button-large" type="button" value="' . __( 'Upload', 'iva_theme_admin' ) . '" rel="' . $int . '" />' . "\n";
			
			if ( $_desc != '' ) {
				$output .= '<span class="of_metabox_desc">' . $_desc . '</span>' . "\n";
			}	
		
			$output .= '<div class="clear"></div><div class="iva-screenshot" id="' . $id . '_image">' . "\n";
			
			if ( $value != '' ) { 
				$remove = '<a href="javascript:(void);" class="custom_clear_image_button button button-primary">x</a>';
				$image = preg_match( '/(^.*\.jpg|jpeg|png|gif*)/i', $value );
				
				if ( $image ) {
						$image_attributes = wp_get_attachment_image_src(iva_get_attachment_id_from_src($value));
					if($image_attributes[0] !=''){
						$output .= '<img src="' . esc_url( $image_attributes[0] ) . '" alt="" />'.$remove.'';
					}else{
						$output .= '<img src="' . esc_url ( $value ) . '" alt="" />'.$remove.'';
					}
				} else {
					$parts = explode( "/", $value );
					for( $i = 0; $i < sizeof( $parts ); ++$i ) {
						$title = $parts[$i];
					}

					// No output preview if it's not an image.			
					$output .= '';
			
					// Standard generic output if it's not an image.	
					$title = __( 'View File', 'iva_theme_admin' );
					$output .= '<div class="no_image"><span class="file_link"></span>' . $remove . '</div>';
				}	
			}
			$output .= '</div>' . "\n";
			return $output;
		}	
	}
?>