<?php
	// Testimonials 
	//--------------------------------------------------------
if(!function_exists('iva_sc_tesimonials')){
	function iva_sc_tesimonials ($atts, $content = null) {
		extract(shortcode_atts(array(
			'style'		=> '',
			'cat'		=> '',
			'limit'		=> '-1',
			'speed'		=> '',
			'itemslimit'=> '2',
			'gridcolumns' => '2columns',
			'pagination'=> 'true',
		), $atts));
		
		global $post,$paged;
		
		$rand = rand(10,100);
		$testimonial_gravatar_image = $out = $before = $after = $out='';
		
		if ( get_query_var('paged') ) { 
			$paged = get_query_var('paged'); 
		} elseif ( get_query_var('page') ) { 
			$paged = get_query_var('page');
		}else {
			$paged = 1;
		}

		$query = array(
			'post_type'	=> 'testimonialtype', 
			'showposts'	=> $limit, 
			'tax_query' => array(
						 'relation' => 'OR',
						),
 
			'paged'		=> $paged
		);
		
		if( $cat !='' ){
				$cats= explode(',',$cat);
					$tax_cat =	array(
						'taxonomy' 		=> 'testimonial_cat',
						'field' 		=> 'slug',
						'terms' 		=> $cats,	
					);
			array_push( $query['tax_query'],$tax_cat );
		}
		// Query executes here; 
		$testomonials_query = new WP_Query( $query );	
		// Style 'carousel'
		if( $style === 'carousel' ){
			$jcarousel_id = rand(10,99);
			
			//Enqueue Owl Carousel 
			wp_enqueue_style('iva-sc-owl-style');
			wp_enqueue_style('iva-sc-owl-theme');
			
			$out .='<script>
			jQuery(document).ready(function($) {
				$("#owl-'.$jcarousel_id.'").owlCarousel({
					autoPlay: 300000, //Set AutoPlay to 3 seconds
					items : '.$itemslimit.',
					itemsDesktop : [1199,1],
					itemsDesktopSmall : [1024,1],
					itemsTablet : [768,1],
					itemsMobile : [479,1]
	 
				});
			});
			</script>';
				
			$out .= '<div id="owl-'.$jcarousel_id.'" class="owl-carousel">';	
		}
		// Style 'fade'
		if( $style === 'fade_tm' ){
			echo'<script type="text/javascript">
			jQuery(document).ready(function() {
				"use strict";
				MySlider('.$speed.',"testimonial'.$rand.'");
			});
			</script>';
			$out .= '<div id="testimonial'.$rand.'" class="testimonial_list"><ul class="testimonials">';
		}
		$count= $columns = '';
		
		if( $style === 'grid' ){	
			$count = 0; $columns=2;
		}
		
		if ( $testomonials_query->have_posts() ) :
	
		if( $style === 'list' ){	
			$out .= '<div class="testimonials-list">';
		}
		
		if( $style === 'grid' ){	
			$out .= '<div class="testimonial-grid-wrap">';
		}
		
	
		while (  $testomonials_query->have_posts() ) :  $testomonials_query->the_post();
				$tm_last_class = '';
				$company_name				= get_post_meta( get_the_ID(), 'company_name', true);
				$website_name				= get_post_meta( get_the_ID(), 'website_name', true );
				$website_url				= get_post_meta( get_the_ID(), 'website_url', true );
				$testimonial_image_option	= get_post_meta( get_the_ID(), 'testimonial_image_option',true );
				$testimonial_content		= get_the_content( get_the_ID() );
				
				switch( $testimonial_image_option ){
					case 'gravatar':
									$testimonial_email=get_post_meta( get_the_ID(),'testimonial_email',true );
									$testimonial_gravatar_image=get_avatar( $testimonial_email, 80 );
									break;
					case 'customimage':
									$testimonial_image=get_post_meta( get_the_ID(),'testimonial_photo',true );
									$testimonial_gravatar_image = iva_sc_resize('', $testimonial_image,'80', '80', 'imageborder', '');
									break;
				}
				
				// Style 'carousel'
				if( $style === 'carousel' ){
					$out .= '<div class="testimonial-carousel">';
					$out .= '<span class="tc-details">';
					if( $testimonial_gravatar_image != '' ){
						$out .= '<span class="tc-client-image">'.$testimonial_gravatar_image.'</span>';
					}
					$out .= '</span>';
					$out .= '<div class="tc-content"><p>'.$testimonial_content.'</p>';
					if( $website_url != '' ){
						$before = ', <a href="'.esc_url($website_url).'" target="_blank">';
						$after = '</a>';
					}
					$clientname = ' - '. get_the_title().', '. $company_name;
					if( $website_name != '' ){
						$out .= '<div class="tc-client-meta"><div class="client-name">'.$clientname.$before.$website_name.$after.'</div></div>';
					}

					$out .= '</div></div>';
				}
				// Style 'fade'
				if( $style === 'fade_tm' ){
					$out .= '<li>';
					$out .= '<div class="testimonial-box">';
					$out .= '<div class="tc-details">';
					if( $testimonial_gravatar_image != '' ){
						$out .= '<div class="tc-client-image">'.$testimonial_gravatar_image.'</div>';
					}
					$out .= '</div>';
					$out .= '<div class="tc-content"><p>'.$testimonial_content.'</p>';
					if( $website_url != '' ){
						$before = ', <a href="'.esc_url($website_url).'" target="_blank">';
						$after = '</a>';
					}
					$clientname = '<strong>'.get_the_title().'</strong>'. $company_name;
					if( $website_name != '' ){
						$out .= '<div class="tc-client-meta"><div class="client-name">'.$clientname.$before.$website_name.$after.'</div></div>';
					}
					$out .= '</div></div>';
					$out .='</li>';  
				}
				// Style 'list'
				if( $style==='list' ){
					$out .= '<div class="testimonial-box">';
					$out .= '<div class="tc-details">';
					if( $testimonial_gravatar_image != '' ){
						$out .= '<div class="tc-client-image">'.$testimonial_gravatar_image.'</div>';
					}
					$out .= '</div>';
					$out .= '<div class="tc-content"><p>'.$testimonial_content.'</p>';
					if( $website_url != '' ){
						$before = ', <a href="'.esc_url($website_url).'" target="_blank">';
						$after = '</a>';
					}
					$clientname = '<strong>'.get_the_title().'</strong>'. $company_name;
					if( $website_name != '' ){
						$out .= '<div class="tc-client-meta"><div class="client-name">'.$clientname.$before.$website_name.$after.'</div></div>';
					}
					$out .= '</div>'; 
					$out .= '</div>'; 
				}
				
				// Style 'grid'
				if( $style==='grid' ){
				
					$count++;
					if($gridcolumns == '2columns'){
						$iva_grid_columns = 'iva_one_half';
						if( $count == 1 ){
							$out .= '<div class="testimonial-row">';
						}
						if( $count == 2 ){
							$tm_last_class = 'iva-last-testimonial';
						}
					}else{
						$iva_grid_columns = 'iva_one_third';
						if( $count == 1 ){
							$out .= '<div class="testimonial-row">';
						}
					
						if( $count == 3 ){
							$tm_last_class = 'iva-last-testimonial';
						}
					}
					$out .= '<div class="'.$iva_grid_columns.' iva-testimonial '.$tm_last_class.'">';
					
					// Testimonial content
					$out .= '<div class="testimonial-box">';
					$out .= '<div class="tc-details">';
					if( $testimonial_gravatar_image != '' ){
						$out .= '<div class="tc-client-image">'.$testimonial_gravatar_image.'</div>';
					}
					$out .= '</div>';
					$out .= '<div class="tc-content"><p>'.$testimonial_content.'</p>';
					if( $website_url != '' ){
						$before = ', <a href="'.esc_url($website_url).'" target="_blank">';
						$after = '</a>';
					}
					$clientname = '<strong>'.get_the_title().'</strong>'. $company_name;
					if( $website_name != '' ){
						$out .= '<div class="tc-client-meta"><div class="client-name">'.$clientname.$before.$website_name.$after.'</div></div>';
					}
					$out .= '</div>'; 
					$out .= '</div>'; 
					// Testimonial content ends here
					
					$out .= '</div>';
				
					if($gridcolumns == '2columns'){
						if( $count == 2 ){
							$out .= '</div>'; //.iva_one_half 
							$count = 0;
						}
					}else{
						if( $count == 3 ){
							$out .= '</div>'; //.iva_one_third
							$count = 0;
						}

					}
				}
				
		endwhile;
		// Style 'list'
		if( $style==='list' ){
			$out .= '</div>'; 
			if( $pagination == "true") {
				if( function_exists('iva_pagination') ) {
					$out .= iva_pagination(); 
				}
			}
		}	
		
		endif;
		// Style 'fade'
		if( $style === 'fade_tm' ){
			$out .= '</ul></div>';
		}
		// Style 'carousel'
		if( $style ==='carousel' ){
			$out .= '</div>'; 
			wp_enqueue_script('iva-sc-owl-carousel');
		}
		// Style 'grid'
		if( $style === 'grid' ){
			$out .= '</div>';
		}
		wp_reset_query();
		return $out;
	}
	//End Testimonials List Function
	add_shortcode('testimonials','iva_sc_tesimonials');
}
?>