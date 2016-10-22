<?php
	// Carousel List - Blog
	//--------------------------------------------------------
if ( !function_exists( 'iva_sc_carousel_list' ) ){
	
	function iva_sc_carousel_list ($atts, $content = null) {
		extract(shortcode_atts(array(
			'cat'		=> '',
			'limit'		=> '',
			'title'		=> '',
			'items'		=> '4',
			'speed'		=> '3000',
		), $atts));

		global $iva_readmoretxt,$post;
		
		$jcarousel_id = rand(10,99);
		
		$iva_blog_args = array( 
			'post_type' => 'post',
			'showposts' => $limit,
			'tax_query' => array(
				'relation' => 'OR',
			),
			'orderby' => 'id',
	    	'order'	  => 'DESC'
		);
		
		if( $cat !=''){
		   $post_cat = explode(',',$cat);
		   $tax_cat =  array(
							'taxonomy' => 'category',
							'field' => 'slug',
							'terms' => $post_cat 
						);
		   array_push( $iva_blog_args['tax_query'],$tax_cat );
  		}
		$jcarousel_id = rand(10,99);

		$iva_blog_query = new wP_Query( $iva_blog_args );
		
		$width = '540';
		$height = '300';
		
		//Enqueue Owl Carousel 
		wp_enqueue_style('iva-sc-owl-style');
		wp_enqueue_style('iva-sc-owl-theme');
		
		$out ='<script>
		jQuery(document).ready(function($) {
			$("#blogcarousel-'.$jcarousel_id.'").owlCarousel({
				autoPlay: '.$speed.',
				items : '.$items.',
				itemsDesktop : [1199,4],
				itemsDesktopSmall : [979,2],
				itemsTablet : [768,2],
				itemsMobile : [479,1]
			});
		});		
		</script>'; 
	
		$out .='<div class="container">';
		$out .='<div id="blogcarousel-'.$jcarousel_id.'" class="owl-carousel">';

		if ( $iva_blog_query->have_posts() ) : while ( $iva_blog_query->have_posts() ) : $iva_blog_query->the_post();

			$blogtitle = get_the_title();
			$post_date = get_the_time('M  j   Y', get_the_id());
			$imagesrc  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, '' );

			// post title
			$out .= '<div class="blogpost-item blogpost-list">';
			if( has_post_thumbnail($post->ID)){ 
				$out .= '<div class="view hoverimg">';
				$out .= iva_sc_resize( $post->ID,'',$width,$height,'','' );
				$out .= '<div class="hover_type">';
				$out .= '<a class="hovergallery" href="' .get_permalink( $post->ID ). '" title="' . $blogtitle . '"><i class="fa fa-picture-o fa-2x"></i></a>';
				$out .= '</div>';
				$out .= '</div>';
			}
			$out .= '<div class="blogpost-desc">';
			$out .= '<h5 class="blogpost-title"><a href="'.get_permalink($post->ID). '" >'.$blogtitle.'</a></h5>';
			//$out .= '<span class="label-text">'.get_the_term_list( $post->ID , 'category', '', ', ', '' ).'</span>';
			$out .= '</div>'; 
			$out .= '</div>'; 
			endwhile;
		endif;
		$out .='</div>';
		$out .='</div>';
		wp_enqueue_script('iva-sc-owl-carousel');
		wp_reset_postdata();			
		return $out;
	}
	add_shortcode('blog_carousel','iva_sc_carousel_list');
}	
?>