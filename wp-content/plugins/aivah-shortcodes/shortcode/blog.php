<?php
// B L O G 
//--------------------------------------------------------
if ( !function_exists( 'iva_sc_blog' ) ){
	function iva_sc_blog ($atts, $content = null) {
		extract(shortcode_atts(array(
			'cat'		=> '',
			'limit'		=> '-1',
			'pagination'=> 'true',
			'postmeta'  =>'true'
		), $atts));

		global $iva_readmoretxt, $post, $paged;

		$out = '';

		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		}elseif ( get_query_var('page') ) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;  
		}
		
		$args = array(
			'category_name'		=> $cat,
			'paged' 			=> $paged,
			'posts_per_page' 	=> $limit
		);

		query_posts( $args );
		
		if ( have_posts() ) : 
			
			while (have_posts()) : the_post();
			$out .= '<article id="post-'. get_the_ID() .'" class="'.join( ' ', get_post_class( 'post', get_the_ID() ) ).'">';
			$post_format = get_post_format();
			if(($post_format == 'image') ||($post_format == '')){
				if( has_post_thumbnail()){
					$out .= '<div class="postimg"><figure>'.get_the_post_thumbnail( $post->ID, 'full', '' ).'</figure></div>'; 
				}
			}
			$out .= '<header class="entry-header">';
			$out .= '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">'. get_the_title() .'</a></h2>';
			$out .= '<div class="entry-meta">';
			if ( 'true' == $postmeta ) {
					ob_start();
					$out .= iva_post_metadata();
					$out .= ob_get_contents();
					ob_end_clean();
			}
			$out .= '</div>';
			$out .= '</header>';

			$out .= '<div class="entry-content">';
			if($post_format == ''){
				if ( has_excerpt() ) {
				
					$out .= get_the_excerpt();
					$out .= '<a class="more-link" href="'. get_permalink() .'">'. __("<span>Continue reading</span>","aivah_shortcodes") .'</a>';
					}else{
						$out .= do_shortcode(get_the_content());
						$out .= wp_link_pages( array(
							'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'aivah_shortcodes' ) . '</span>',
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
						));
					}

			}elseif($post_format == 'status'){
				$status = get_post_meta($post->ID, 'status', TRUE);
				if($status !='') {
					$out.= '<div class="status-content">';
					$out.=  '<p>'.$status.'</p>';
					$out.= '</div>';
				} 
			}elseif($post_format == 'quote') {
				$quote = get_post_meta($post->ID, 'postformatmetabox-quote', TRUE);
				$out.=  '<p class="quote">'.$quote.'</p>';
			}else{
				$out .= do_shortcode(get_the_content());
				$out .= wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'aivah_shortcodes' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				));
			}
			$out .= '</div>';
			$out .= '</article><!-- /post-'. get_the_ID() .' -->';

			endwhile;
			if( function_exists('iva_sc_pagination') ) {
				if( $pagination == "true") {
					ob_start();
					$out .= iva_sc_pagination(); 
					$out .= ob_get_contents();
					ob_end_clean();
				}
			}
		endif;

		wp_reset_query();

		return $out;
		
	} 
	//EOF iva_sc_blog
	add_shortcode('blog','iva_sc_blog');
}
?>