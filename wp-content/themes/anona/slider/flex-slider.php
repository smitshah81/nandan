<?php
$fs_slidelimit = get_option('atp_flexslidelimit') ? get_option('atp_flexslidelimit') : '3';
$fs_slidespeed = get_option('atp_flexslidespeed') ? get_option('atp_flexslidespeed') : '3000';
$fs_slideffect = get_option('atp_flexslideffect') ? get_option('atp_flexslideffect') : 'fade';
$fs_slidednav = get_option('atp_flexslidednav') ? get_option('atp_flexslidednav') : 'true';

$pageslider = get_post_meta($post->ID,'page_slider', true);

if($pageslider != "" ) {
	$slider_cat = get_post_meta($post->ID,'flexslidercat', true);
}else{
	$slider_cat = get_option('atp_flexslidercat');
}
?>
<section id="featured_slider" class="clearfix">
<?php
echo '<script type="text/javascript">
jQuery(document).ready(function($) {
	"use strict";
	jQuery(".flexslider").flexslider({
		animation: "'.$fs_slideffect.'",
		controlsContainer: ".flex-container",
		slideshow: true,
		slideshowSpeed: '.$fs_slidespeed.',
		animationDuration: 400,
		directionNav: '.$fs_slidednav.',
		controlNav: false,
		mousewheel: false,
		smoothHeight :false,
		start: function(slider) {
			jQuery(".total-slides").text(slider.count);
		},
		after: function(slider) {
			jQuery(".current-slide").text(slider.currentSlide);
		}
	});
});	
</script>';
?>
	<div class="slider_wrapper">
		<div class="flexslider">
			<ul class="slides">
				<?php
				$query = array(
					'post_type'			=> 'slider', 
					'posts_per_page'	=> $fs_slidelimit, 
					'tax_query' => array(
						'relation' => 'OR',
					),
					'orderby'			=> 'menu_order',
					'order'				=> 'ASC'
				);
				
				if( $slider_cat !=''){
					$tax_cat =	array(
						'taxonomy' 		=> 'slider_cat',
						'field' 		=> 'slug',
						'terms' 		=> $slider_cat
					);
					array_push( $query['tax_query'],$tax_cat );
				}
				$iva_slider = new WP_Query( $query );	
				while ($iva_slider->have_posts()) :$iva_slider->the_post();
				$terms = get_the_terms(get_the_ID(), 'slider_cat');
				$terms_slug = array();
				if (is_array($terms)) {
					foreach($terms as $term) {
						$terms_slug[] = $term->slug;
					}
				}
				$width = '';
				$height = '550';
				if( get_option('atp_layoutoption') == 'stretched'){ $width='1920'; } else { $width='1200';}

				$postlinktype_options 	=  get_post_meta(get_the_ID(), "postlinktype_options", true);
				$flex_sliderdescription	=  get_post_meta(get_the_ID(), "slider_desc", true);
				$postlinkurl 			=  atp_generator('atp_getPostLinkURL',$postlinktype_options);
				$slidercaption 			=  get_post_meta(get_the_ID(), "slider_caption", true);
				
				echo '<li>';
				if ( $postlinkurl != 'nolink' ) {
					echo '<a href="'.esc_url( $postlinkurl ).'"  >'. atp_resize( get_the_ID(), '', $width,'550','','' ) .'</a>';
				} else {
					echo atp_resize( get_the_ID(),'',$width, $height,'' ,'' );
				}
				?>	
				
				<?php if( $slidercaption != 'on' ){ ?>
				<div class="flex-caption fadeInDown">
					<?php if ( $flex_sliderdescription != '' ) { ?>
					<div class="flex-title">
					<h5><span><?php the_title();?></span></h5>
					<h6><span><?php echo do_shortcode($flex_sliderdescription); ?></span></h6>
					</div><!-- .flex-title -->
				
					<?php } ?>
				</div><!-- .flex-caption -->
				<?php } ?>
				<?php
				echo '</li>';
				endwhile;
				wp_reset_postdata(); ?> 
			</ul>
		</div><!-- .flexslider -->
	</div><!-- .flexslider_wrap -->
</section><!-- #featured_slider -->