<?php
if (!class_exists('atpgenerator')) {
	class atpgenerator {

		// P R I M A R Y   M E N U 
		//--------------------------------------------------------
		function atp_primary_menu() {
			if (has_nav_menu( 'primary-menu' ) ) {
				wp_nav_menu(array(
					'container'     => false, 
					'theme_location'=> 'primary-menu',
					'menu_class'    => 'sf-menu',
					'menu_id'       => 'atp_menu', 
					'echo'          => true, 
					'before'        => '', 
					'after'         => '',
					'link_before'   => '', 
					'link_after'    => '', 
					'depth'         => 0,
					'walker'        => new description_walker()
					));
			}
			else {
				echo '<a class="alignright" href="'. home_url('/') .'wp-admin/nav-menus.php">Wordpress Menu is not assigned or created.</a>';
			}
		}

		function atp_mobile_menu() {
			if (has_nav_menu( 'primary-menu' ) ) {
				wp_nav_menu(array(
					'container'     => 'div', 
					'container_class'=> 'iva-mobile-menu',
					'theme_location'=> 'primary-menu',
					'menu_class'	=> 'iva_mmenu',
					'echo'          => true, 
					'before'        => '', 
					'after'         => '',
					'link_before'   => '', 
					'link_after'    => '', 
					'depth'         => 0,
					'walker'        => new mobile_walker()
				));
			}
		}

		// L O G O   G E N E R A T O R
		//--------------------------------------------------------
		function logo()
		{
			$atp_logo = get_option('atp_logo'); 
			if($atp_logo == 'logo'){ ?>
				<a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
					<img src="<?php echo esc_url(get_option('atp_header_logo')); ?>" alt="<?php bloginfo('name'); ?>" />
				</a>
			<?php 
			}else { ?>
				<h1 id="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?>	</a></span></h1>
				<h2 id="site-description"><?php echo bloginfo( 'description' ); ?></h2>
			<?php 
			} 
		}

		
		// S I D E B A R   P O S I T I O N S 
		//--------------------------------------------------------
		function sidebaroption($postid) {
		// Get sidebar class and adds sub class to pagemid block layout
			
			$iva_layout_option = get_option('atp_defaultlayout') ? get_option('atp_defaultlayout') : 'rightsidebar';
			$sidebaroption = get_post_meta($postid, "sidebar_options", TRUE) ? get_post_meta($postid, "sidebar_options", TRUE): $iva_layout_option;

			switch($sidebaroption){
				case  'rightsidebar':
						$sidebaroption="rightsidebar";
						break;
				case  'leftsidebar':
						$sidebaroption="leftsidebar";
						break;
				case  'fullwidth':
						$sidebaroption="fullwidth";
						break;
						
				default:
						$sidebaroption="rightsidebar";
			}
			
			if ( class_exists('woocommerce') ) {
				if( is_product() ){
					$sidebaroption = 'fullwidth';
				} 
			} else {
				if( is_archive() || is_search() ) {
					$sidebaroption = 'rightsidebar';
				}
			}

			if(get_query_var( 'eventDisplay' )){
				if( tribe_get_option( 'tribeEventsTemplate', 'default' ) == "template_events_leftsidebar.php" ){
					$sidebaroption = 'leftsidebar';
					}
			}
			if(get_query_var( 'eventDisplay' )){
				if( tribe_get_option( 'tribeEventsTemplate', 'default' ) == "template_events_rightsidebar.php" ){
					$sidebaroption = 'rightsidebar';
					}
			}
			if ( is_404() 
				|| is_singular('appointment') 
				|| is_tax('pest_category')
				|| is_page_template( 'pest-control/template_appointment.php' )
				|| is_page_template( 'pest-control/template_cancel_appts.php' ) 
				|| is_page_template( 'pest-control/template_confirm_appts.php' ) 
				|| is_page_template( 'pest-control/template_unconfirm_appts.php' )   ) {

				$sidebaroption = 'fullwidth'; 
			}

			return $sidebaroption;
		}
		
		/***
		 * P O S T   L I N K   T Y P E 
		 *--------------------------------------------------------
		 * atp_getPostLinkURL - generates URL based on link type
		 * @param - string link_type - Type of link 
		 * @return - string URL
		 * 
		 */
		function atp_getPostLinkURL($link_type) {
			global $post;
			
			//use switch to generate URL based on link type
			switch($link_type) {
				case 'linkpage':
						return get_page_link(get_post_meta($post->ID, 'linkpage', true));
						break;
				case 'linktocategory':
						return get_category_link(get_post_meta($post->ID, 'linktocategory', true));
						break;
				case 'linktopost':
						return get_permalink(get_post_meta($post->ID, 'linktopost', true));
						break;
				case 'linkmanually':
						return esc_url(get_post_meta($post->ID, 'linkmanually', true));
						break;
				case 'nolink':
						return 'nolink';
						break;
			}
		}
		
		/**
		 * P O S T   A T T A C H M E N T S 
		 *--------------------------------------------------------
		 * getPostAttachments - displays post attachements 
		 * @param - int post_id - Post ID
		 * @param - string size - thumbnail, medium, large or full
		 * @param - string attributes - thumbnail, medium, large or full
		 * @param - int width - width to which image has be revised to
		 * @param - int height - height to which image has be revised to
		 * @return - string Post Attachments
		 */
		 
		function getPostAttachments($postid=0, $size='thumbnail', $attributes='',$width,$height,$postlinkurl) {
			global $post;
				//get the postid
				if ($postid<1) $postid = get_the_ID();
				
				//variables
				$rel = $out = '';
						
				//get the attachments (images)
				$images = get_children(array(
					'post_parent'    => $postid,
					'post_type'      => 'attachment',
					'order'          => 'DESC',
					'numberposts'    => 0,
					'post_mime_type' => 'image'));
					
				//if images exists	, define/determine the relation for lightbox
				if(count($images) >1) {
					$rel = '"group'.$postid.'"';
				}else{
					$rel='""'; 
				}
				$rel = ' rel='.$rel;
				//if images exists, loop through and prepare the output
				if($images) {
				$out .='<div class="flexslider">';
				$out .='<ul class="slides">';
					//loop through
					foreach($images as $image) {
						$full_attachment = wp_get_attachment_image_src($image->ID, 'full');
							if( !empty( $image->ID ) )
						$alt=get_the_title( $image->ID );
						$out .='<li>';
						$out .= atp_resize('',$full_attachment['0'],$width,$height,'',$alt);
						$out .='</li>';
					}//loop ends
					$out .='</ul>';
					$out .='</div><div class="clear"></div>';
				} else { //if images does not exists
					$alt='';
					$post_thumbnail_id = get_post_thumbnail_id($postid);
					$full_attachment = wp_get_attachment_image_src($post_thumbnail_id,'full');
							if( !empty($post_thumbnail_id) )
					$alt=get_the_title($post_thumbnail_id);
						$out.='<figure><a href="'.$postlinkurl.'">';
						$out.=atp_resize('',$full_attachment['0'],$width,$height,'imageborder',$alt);
						$out.='</a></figure>';
				}// if images exists		
			return $out; 
		}
	
		// CUSTOM TWITTER TWEETS
		//--------------------------------------------------------
		function atp_customtwitter( $iva_postid )
		{

			$iva_twitter_username = get_post_meta( $iva_postid,'iva_twitter_username',true );

			if( isset( $iva_twitter_username) && $iva_twitter_username!='' ){
				$twitter_username = $iva_twitter_username;
			}else{
				$twitter_username = get_option('atp_teaser_twitter');
			}

			if ( function_exists( 'twitter_parse_cache_feed' ) ) {
				twitter_parse_cache_feed(array(
					'username'				=> $twitter_username,
					'limit'					=> '1',
					'encode_utf8'			=> '',
					'twitter_cons_key'		=> get_option('atp_consumerkey'),
					'twitter_cons_secret'	=> get_option('atp_consumersecret'),
					'twitter_oauth_token'	=> get_option('atp_accesstoken'),
					'twitter_oauth_secret'	=> get_option('atp_accesstokensecret')
				));
			}
		}
		// S U B H E A D E R 
		//--------------------------------------------------------
		function subheader( $postid ){

			global $wp_query; 
			
			$subdesc = $title   = $subheader_properties = $cssextras = $out = '';
			$sub_option         = get_post_meta($postid, 'subheader_teaser_options', true);
			$page               = get_post($postid);
			$pagetitle_styling  = get_post_meta($postid, "sub_styling", true);
			$subbreadcrumb      = get_post_meta($postid, 'breadcrumb', true);
			$sh_bg_properties 	= get_post_meta( $postid,'subheader_img', true );
			$subheadertextcolor = get_post_meta($postid,'sh_txtcolor',true); 
			$subheaderpadding   = get_post_meta($postid,'sh_padding',true); 
			$sh_textcolor 		= $subheadertextcolor ? 'color:'.$subheadertextcolor.';':'';
			$sh_padding 		= $subheaderpadding 		? 'padding:'.$subheaderpadding.';':'';
			
			// conditional execution of subheader
			if (	
				is_page() || // if is page
				is_page_template() || // if is page template
				(is_single()) ||  // if is single page
				(is_front_page() && $postid != NULL) ||  // if is not empty static frontpage 
				(is_home() && $postid != NULL) // if is not empty static frontpage
				)  
			{
				// subheader background properties
				if( is_array( $sh_bg_properties ) && !empty( $sh_bg_properties['0']['image'] ) ) {
					$subheader_properties = 'background:url('.$sh_bg_properties['0']['image'].') '.$sh_bg_properties['0']['position'].' '.$sh_bg_properties['0']['repeat'].' '.$sh_bg_properties['0']['attachement'].' '.$sh_bg_properties['0']['color'].';';
				} elseif( is_array($sh_bg_properties) && !empty($sh_bg_properties['0']['color']) ) {
					$subheader_properties = 'background-color:'.$sh_bg_properties['0']['color'].';';
				}elseif( !is_array($sh_bg_properties)  && $sh_bg_properties !='' ){	
					$subheader_properties  = 'background:url('.$sh_bg_properties.');';
				}
				$cssextras = ( $subheader_properties != '' || $sh_textcolor != '' || $sh_padding != ''  ) ? ' style="'.$subheader_properties.$sh_textcolor.$sh_padding.'"' : '';
				
				// Subheader Option
				switch($sub_option) {
					case 'customtitle':
							$custom_title = get_post_meta( $postid, 'page_title', true );
							if($custom_title){
								$title = get_post_meta( $postid, 'page_title', true );
							}else{
								$title = $page->post_title;
							} 
							
							$subdesc = stripslashes( do_shortcode( get_post_meta( $postid, 'page_desc', true ) ) );
							break;
					case 'twitter':
							$title = $page->post_title;
							ob_start();							
							$subdesc= atp_generator('atp_customtwitter',$postid);
							$subdesc .= ob_get_clean();	
							break;
					case 'default':
							if(get_option('atp_teaser') == 'twitter') : 
								$title = $page->post_title;
								ob_start();							
								$subdesc= atp_generator('atp_customtwitter',$postid);
								$subdesc .= ob_get_clean();	
							elseif(get_option('atp_teaser') == 'default') :
								$title = $page->post_title;
							elseif(get_option('atp_teaser') == 'disable') :
							else :
								$title = $page->post_title;
							endif;
							break;
					default:
							if(get_option('atp_teaser') == 'twitter') : 
								$title = $page->post_title;
								ob_start();							
								$subdesc= atp_generator('atp_customtwitter',$postid);
								$subdesc .= ob_get_clean();	
							elseif(get_option('atp_teaser') == 'default') :
								$title = $page->post_title;
							elseif(get_option('atp_teaser') == 'disable') :
							else :
								$title = $page->post_title;
							endif;
							break;
				}
			}

			// iF IS  is_single   
			if ( class_exists('woocommerce') ){
				if( is_product() && is_woocommerce() ){
					$title = $page->post_title;
				}
			}elseif ( is_single() ) {
				if($sub_option == 'customtitle'){
					$title = get_post_meta( $postid, 'page_title', true );
					
				}else{
			
					$title = get_option('atp_postsinglepage') ? get_option('atp_postsinglepage') : __('Blog','iva_theme_front');
			
				}
			}
			// 
			if(  is_singular( 'slider' ) || is_singular( 'testimonialtype' ) || is_singular('appointment') || is_singular( 'pest' )){
				if($sub_option == 'customtitle'){
					$title = get_post_meta( $postid, 'page_title', true );	
					
				}else{
					$title = $page->post_title;
				}
			}

	
			// 
			if(is_singular('gallery')){
				if($sub_option == 'customtitle'){
					$title = get_post_meta( $postid, 'page_title', true );	
					
				}else{
					$title = get_option('atp_gallery_subtxt') ? get_option('atp_gallery_subtxt') : __('Gallery','iva_theme_front');
				}
			}
	
			// If is static blog Page
			if (is_home()) {
				if($sub_option == 'customtitle'){
					$title = get_post_meta( $postid, 'page_title', true );	
					
				}else{
					$title = __('Blog','iva_theme_front');
				}
			}

			// If is product page in WooCommerce
			if (is_singular( 'product' )) {
				$title = __('Shop','iva_theme_front');
			}

			// Is archive
			if( is_archive() ) {
				// 
				if ( class_exists('woocommerce') ){
					if( is_shop()){
						$title = __('Shop','iva_theme_front');
					}
				}else{
					$title = __('Archives','iva_theme_front');
				}
				// 
				if ( is_category() ) {
					$taxonomy_archive_query_obj = $wp_query->get_queried_object();
					$ctitle = $taxonomy_archive_query_obj->name; // Taxonomy term name
					$title = '';
					$subdesc = sprintf( __( 'Category Archives: %s', 'iva_theme_front' ), '<span>' . $ctitle . '</span>' ); 
				}
				// 
				
				if(  is_tax('pest_category')){
					$taxonomy_archive_query_obj = $wp_query->get_queried_object();
					$ctitle = $taxonomy_archive_query_obj->name; // Taxonomy term name
					$title = $ctitle; 
				}
	
				// 
				if ( is_day() ) :
						$title = '';
						$subdesc = sprintf( __( 'Archive for date: %s', 'iva_theme_front' ), '<span>' . get_the_date() . '</span>' ); 
					elseif ( is_month() ) : 
						$title = '';
						$subdesc = sprintf( __( 'Archive for month: %s', 'iva_theme_front' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'iva_theme_front' ) ) . '</span>' ); 
					elseif ( is_year() ) : 
						$title = '';
						$subdesc = sprintf( __( 'Archive for year: %s', 'iva_theme_front' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'iva_theme_front' ) ) . '</span>' ); 
					else :
				endif;
			}
		
			// If is tag page
			if (is_tag()) {
				$title = '';
				$subdesc = sprintf( __( 'Tag Archives: %s', 'iva_theme_front' ), '<span>' . single_tag_title( '', false ) . '</span>' );
			}
			// If is Search
			if(is_search()) {
				$title = '';
				$subdesc = __('Search Results : '.stripslashes( strip_tags( get_search_query() ) ) ,'iva_theme_front') ;
			}
			// If is author
			if(is_author()) {
				$title = '';
				$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
				$subdesc = sprintf(__('Author Archives: %s', 'iva_theme_front'),$curauth->display_name);
			}
			/**
			 * Subheader content alignment
			 * gets an default case from theme options panel
			 * gets an alignment for specific page
			 */
			if( $pagetitle_styling == '' ){
				$pagetitle_styling = get_option('atp_sub_styling');
			}
			switch( $pagetitle_styling ){
				case 'left':
							$subtitlealign = 'sleft';
							break;
				case 'right':
							$subtitlealign = 'sright';
							break;
				case 'center':
							$subtitlealign = 'scenter';
							break; 
				default :
							$subtitlealign = 'sleft';
			}
		
			if( get_option( 'atp_teaser' ) != 'disable' ) {
				// If is not disabled from page
				if ( $sub_option != 'disable' ) {
					$out .= '<div id="subheader" class="'.$subtitlealign.'" '.$cssextras.'>';
					$out .= '<div class="subheader-inner">';
					$out .= '<div class="subdesc">';
					if ( $title ) {
						$out .= '<h1 class="page-title">'.$title.'</h1>';
					}
					if( $subdesc) {
						$out .= '<div class="customtext">'.$subdesc.'</div>';
					}
					$out .= '</div>';
					if ( get_option('atp_breadcrumbs') != 'on' ) {
						ob_start();							
						$out .= atp_generator('breadcrumb',$postid);
						$out .= ob_get_clean();		
					}
					$out .= '</div>';
					$out .= '</div>';
				}else{
					// If subheader Option is disabled from page meta
					if ( $subbreadcrumb != 'on' ) {
						$out .= '<div class="inner sub_disabled">';
						ob_start();							
						$out .= atp_generator( 'breadcrumb', $postid );
						$out .= ob_get_clean(); 
						$out .= '</div>';
					}
				}
			// If subheader Option is disabled from options panel
			}else{
				if ( $subbreadcrumb != 'on' and ( get_option( 'atp_breadcrumbs' ) != 'on' ) ) {
					$out .= '<div class="inner sub_disabled">';
					ob_start();
					$out .= atp_generator( 'breadcrumb', $postid );
					$out .= ob_get_clean();
					$out .= '</div>';
				}
			}

			return $out;
		}
	
		
		// B R E A D C R U M B S 
		//--------------------------------------------------------
		function breadcrumb($postid){
			
			$breadcrumb_align = get_option('atp_sub_styling');
			$subbreadcrumb 		= get_post_meta($postid, 'breadcrumb', true);

			if ( function_exists( 'bcn_display' ) ){ 

				if ($subbreadcrumb != 'on' and (get_option('atp_breadcrumbs') != 'on')) {
					echo '<div class="breadcrumb-wrap">';
					echo '<span class="breadcrumbs">';
					bcn_display();
					echo '</span>';
					echo '</div>';
				}

			}
		}
		
		// A B O U T   A U T H O R 
		//--------------------------------------------------------
		function aboutauthor(){?>
			<div id="about-author">
				<div class="author_containter">
					<div class="author-avatar"><?php echo get_avatar(get_the_author_meta('email'), $size = '80', $default=''); ?></div>
					<div class="author-description">
					<h4><?php the_author_meta( 'display_name' ); ?></h4>
					<p><?php the_author_meta('description'); ?></p></div>
				</div>
			</div>
		<?php 
		} 
	
		// R E L A T E D   P O S T S 
		//--------------------------------------------------------
		function relatedposts($postid) {

		//Variables
		global $wpdb,$post;
		$tags = wp_get_post_tags($postid);
		if ($tags) {
			$tag_ids = array();
			foreach($tags as $individual_tag) {
				$tag_ids[] = $individual_tag->term_id;
			}

			$args = array(
				'tag__in'				=> $tag_ids,
				'post__not_in'			=> array($post->ID),
				'showposts'				=> 4, // Number of related posts that will be shown.
				'ignore_sticky_posts'	=>1
			);
			
			$related_post_found = "true";
			$my_query = new wp_query($args);

			if( $my_query->have_posts() ) {
				echo '<div class="related-posts"><div class="fancyheading textleft"><h4><span>'. __("You might also like", "iva_theme_front").'</span></h4></div><ul>';
				while ( $my_query->have_posts() ) {
					$my_query->the_post();
					echo '<li>';
					echo '<a href="'.get_permalink($post->ID).'">'. get_the_title(). '</a> - <span>'.get_the_date().'</span>'; 
					echo '</li>';
				}
				echo '</ul>';
				echo '</div>';
				}
			}
			wp_reset_postdata();
		}
	
	}
	// end class
}	
	/**
	 * Description Walker Class for Custom Menu
	 */
	class description_walker extends Walker_Nav_Menu {
	 function start_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0){
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $object->classes ) ? array() : (array) $object->classes;
		$class=array();
		//$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
		$class_names=apply_filters( 'nav_menu_css_class', array_filter( $classes ));
		foreach($class_names as $key=>$values){
				if($key!='0')
				{
				$class[].=$values;
				}

		}
		$custommneu_class = join( ' ',$class);
		$class_menu = ' class="'. esc_attr( $custommneu_class ) . '"';
		$output .= $indent . '<li id="menu-item-'. $object->ID . '"' . $value . $class_menu.'>';

		$attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
		$attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
		$attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
		$attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';

		$prepend = '';
		$append = '';
		$description  = ! empty( $object->attr_title ) ? '<span class="msubtitle">'.esc_attr( $object->attr_title ).'</span>' : '';

		if($depth != 0){
			 $description = $append = $prepend = "";
		}

		$object_output = $args->before;
		$object_output .= '<a'. $attributes .'>';
		if($classes['0']!=''){
		$object_output .='<i class="iva_menuicon fa '.$classes['0'].' fa-lg"></i>';
		}
		$object_output .= $args->link_before .$prepend.apply_filters( 'the_title', $object->title, $object->ID ).$append;
		$object_output .= $description.$args->link_after;
		$object_output .= '</a>';
		$object_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );
		}
	}

	/**
	 * Description Walker Class for Mobile Menu
	 */
	class mobile_walker extends Walker_Nav_Menu {
	 function start_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0){
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $object->classes ) ? array() : (array) $object->classes;
		$class=array();
		//$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
		$class_names=apply_filters( 'nav_menu_css_class', array_filter( $classes ));
		foreach($class_names as $key=>$values){
				if($key!='0')
				{
				$class[].=$values;
				}

		}
		$custommneu_class = join( ' ',$class);
		$class_menu = ' class="'. esc_attr( $custommneu_class ) . '"';
		$output .= $indent . '<li id="menu-item-'. $object->ID . '"' . $value . $class_menu.'>';

		$attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
		$attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
		$attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
		$attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';

		$prepend = '';
		$append = '';
		$description  = ! empty( $object->attr_title ) ? '<span class="msubtitle">'.esc_attr( $object->attr_title ).'</span>' : '';

		if($depth != 0){
			 $description = $append = $prepend = "";
		}

		$object_output = $args->before;
		$object_output .= '<a'. $attributes .'>';
		if($classes['0']!=''){
		$object_output .='<i class="iva_menuicon fa '.$classes['0'].' fa-lg"></i>';
		}
		$object_output .= $args->link_before .$prepend.apply_filters( 'the_title', $object->title, $object->ID ).$append;
		$object_output .= $description.$args->link_after;
		if ( 'primary-menu' == $args->theme_location ) {
			$submenus = 0 == $depth || 1 == $depth ? get_posts( array( 'post_type' => 'nav_menu_item', 'numberposts' => 1, 'meta_query' => array( array( 'key' => '_menu_item_menu_item_parent', 'value' => $object->ID, 'fields' => 'ids' ) ) ) ) : false;
			$object_output .= ! empty( $submenus ) ? ( 0 == $depth ? '<span class="iva-children-indenter"><i class="fa fa-angle-down"></i></span>' : '<span class="iva-children-indenter"><i class="fa fa-angle-right"></i></span>' ) : '';
        }

		$object_output .= '</a>';
		$object_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );
		}
	}
	// W R I T E   G E N E R A T O R
	//--------------------------------------------------------
	function atp_generator($function){
	//http://php.net/manual/en/function.call-user-func-array.php
	//http://php.net/manual/en/function.func-get-args.php	
		global $_atpgenerator;
		$_atpgenerator = new atpgenerator;
		$args = array_slice( func_get_args(), 1 );
		return call_user_func_array(array( &$_atpgenerator, $function ), $args );
	}
	// C U S T O M   E X C E R P T   L E N G T H
	//--------------------------------------------------------
	function excerpt($num) {
		$link = get_permalink();
		$ending = '...';
		$limit = $num+1;
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).$ending;
		echo $excerpt;
	}
	// C U S T O M   C O M M E N T   T E M P L A T E 
	//--------------------------------------------------------
	
	function atp_custom_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'iva_theme_front' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'iva_theme_front' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-body">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 60 );
					printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'iva_theme_front' ) . '</span>' : ''
					);
					echo '<div class="comment-metadata">';
					printf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'iva_theme_front' ), get_comment_date(), get_comment_time() )
					);
					
					edit_comment_link( __( 'Edit', 'iva_theme_front' ), '<span class="edit-link">', '</span>' );
					echo '</div>';
				?>
			</header><!-- .comment-meta -->
			<div class="comment-content">
				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'iva_theme_front' ); ?></p>
				<?php endif; ?>
				
					<?php comment_text(); ?>

				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'iva_theme_front' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
			</div><!-- .comment-content -->
		</div><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
	} 
?>