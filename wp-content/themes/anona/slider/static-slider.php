<?php // Static Slider; ?>
<div id="featured_slider">
	<div class="slider_wrapper">
		<div class="staticslider">
		<?php
		$pageslider = get_post_meta($post->ID,'page_slider', true);
		$width = '';
		if( get_option( 'atp_layoutoption' ) == 'boxed'){ $width = '1100';  }

		if( $pageslider != '' ) {
			$src = get_post_meta($post->ID, 'staticimage', true);
			$link = esc_url( get_post_meta($post->ID, 'cimage_link', true));
		}else{
			$src = get_option( 'atp_static_image_upload' ); 
			$link = esc_url( get_option( 'atp_static_link' ) );
		}
		
		if( $link != '' ) {
			echo '<a href="'.$link.'"><figure>'.atp_resize( '', $src, $width, '500', '', '' ).'</figure></a>'; 
		}else {
			echo '<figure>'.atp_resize( '', $src, $width, '500', '', '' ).'</figure>'; 
		}
		?>
		</div>
	</div>
</div>
<?php 
if(is_front_page()) {
	atp_generator('teaser_option');
}?>