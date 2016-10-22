<div id="sidebar">
	<div class="content widget-area">
	<?php 
		$widget = '';
		/**
		 * Check if widget pages are there
		 * then display opted widgets for that page's sidebar
		 * else display default sidebar
		 */
		if ( is_archive() || is_search() ) {

			// If Woocommerce is Isntalled and Active
 			if( class_exists('woocommerce') && is_shop() ){  
				$woocommerce_shop_page_id = get_option ('woocommerce_shop_page_id'); 	
				$widgets = get_post_meta( $woocommerce_shop_page_id, 'custom_widget', true);
				$widget = strtolower( preg_replace('/\s+/', '-',$widgets ) );  
			}

		} else {
			if ( isset($post->ID) ) {
				$widgets = get_post_meta( $post->ID, 'custom_widget', true);
				$widget = strtolower( preg_replace('/\s+/', '-',$widgets ) );
			}
			//loop through the widget pages
		}
		/**
		 * If current page falls under widget pages
		 * then display sidebar widgets accordingly
		 * Otherwise display default widgets
		 */
		
		if ( $widget ) {
			if ( function_exists( 'dynamic_sidebar' ) && dynamic_sidebar( 'sidebar-'.$widget ) ) : endif;
		} else {
			if ( !dynamic_sidebar( 'defaultsidebar' )) : 
		endif;
		}
		?>
	</div>
</div><!--  -->