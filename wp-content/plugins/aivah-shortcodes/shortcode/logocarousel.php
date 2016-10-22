<?php
/**
 * Shortcode Name: Logo Carousel
 * Description: A shortcode used for displaying logo images.
 * Version: 1.0
 * Author: Aivah Themes
 * Author URI: http://www.aivahthemes.com
 * Credits : http://www.owlgraphic.com/owlcarousel/
 */
 if( !function_exists('iva_sc_logosshowcase')){
	function iva_sc_logosshowcase ($atts, $content = null) {
		extract(shortcode_atts(array(
			'categories'	=> '',
			'limit'	=> '-1',
			'title'	=> '',
			'items' => '3',
			'speed' => '3000',
		), $atts));
		
		global $post;
		
		$iva_logo_args = array( 
			'post_type' => 'logosc_type',
			'showposts' => $limit,
			'tax_query' => array(
				'relation' => 'OR',
			),
			'orderby' => 'id',
	    	'order'	  => 'DESC'
		);
		
		if( $categories !=''){
		   $logo_cat = explode(',',$categories);
		   $tax_cat =  array(
							'taxonomy' => 'logosc_cat',
							'field' => 'slug',
							'terms' => $logo_cat 
						);
		   array_push( $iva_logo_args['tax_query'],$tax_cat );
  		}
		$jcarousel_id = rand(10,99);

		$iva_logo_query = new wP_Query( $iva_logo_args );
		
		$out ='';
		
		$out .='<script>
		jQuery(document).ready(function($) {
			$("#owl-'.$jcarousel_id.'").owlCarousel({
				autoPlay: '.$speed.',
				pagination : false,
				items : '.$items.',
				itemsDesktop : [1199,4],
				itemsDesktopSmall : [1024,4],
				itemsTablet : [768,2],
				itemsMobile : [479,2]
			});
		});
		
	</script>';
	
		wp_enqueue_style('iva-sc-owl-style');
		wp_enqueue_style('iva-sc-owl-theme');
		
		$out .='<div class="clientcarousel">';
		$out .= '<div id="owl-'.$jcarousel_id.'" class="owl-carousel">';
		if ( $iva_logo_query->have_posts() ) : while ( $iva_logo_query->have_posts() ) : $iva_logo_query->the_post();
				$image 				= iva_sc_resize( $post->ID, '', '150', '124', '', '' );
				$url 				= get_post_meta( $post->ID, 'logo_url', true );
				$url_target 		= get_post_meta( $post->ID, 'logo_url_target', true ) ? get_post_meta( $post->ID, 'logo_url_target', true )  :'_new';
				$disable_title 		= get_post_meta( $post->ID, 'disable_title', true );
				$logo_title = '';
				
				$logotitle = get_the_title();
				
				if( $title === 'true' && $disable_title !='on' && $logotitle !=''){
					if( $url ){
						$logo_title  = '<span class="cl-title"><a href="' .esc_url( $url ). '" target="'.$url_target.'">'.$logotitle.'</a></span>';
					}else{
						$logo_title  = '<span class="cl-title">'.$logotitle.'</span>';
					}
				}
				if($image !=''){
					if($url){
						$out .= '<div class="clientthumb"><figure><a href="' .esc_url( $url ). '" target="'.$url_target.'">'.$image.'</a></figure>'.$logo_title.'</div>';
					}else{
						$out .= '<div class="clientthumb"><figure>'.$image.'</figure>'.$logo_title.'</div>';
					}
				}

			endwhile;
		endif;
		$out .='</div>';
		$out .='</div>';
		wp_enqueue_script('iva-sc-owl-carousel');
		wp_reset_postdata();
		return $out;
	} //EOF iva_sc_logosshowcase
	add_shortcode('logos_showcase','iva_sc_logosshowcase');
 }
?>