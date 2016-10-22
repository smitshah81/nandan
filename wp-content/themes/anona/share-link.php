<?php
// if this post has a featured image
		if(has_post_thumbnail($post->ID))
		{
			// get the featured image
			$urlPostThumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
			$urlPostThumb = $urlPostThumb[0];
		}else{
		$urlPostThumb='';
		}

$out = '';
// Google+
if(get_option('atp_google_enable')=='on'){
		$out .= '<li><a target="_blank" href="http://plus.google.com/share?url='.esc_url( get_permalink($post->ID) ).'&amp;title='.get_the_title().'&amp;annotation='.get_the_title().'" class="symbol" title="googleplus"></a><span class="ttip">Google+</span></li>';
}
// Facebook
if(get_option('atp_facebook_enable')=='on'){
	$out .= '<li><a href="http://www.facebook.com/sharer.php?u='.esc_url( get_permalink($post->ID) ) .'&amp;title='.get_the_title() .'" class="symbol" title="facebook" target="_blank"></a><span class="ttip">Facebook</span></li>';
}
// Twitter
if(get_option('atp_twitter_enable')=='on'){
	$out .= '<li><a href="http://twitter.com/share?url='.esc_url( get_permalink($post->ID) ) .'&amp;text='.get_the_title() .'" class="symbol" title="twitterbird" target="_blank"></a><span class="ttip">Twitter</span></li>';
}
// Reddit
if(get_option('atp_reddit_enable')=='on'){
	$out .= '<li><a href="http://reddit.com/submit?url='.esc_url( get_permalink($post->ID) ) .'&amp;title='.get_the_title() .'" class="symbol" title="reddit" target="_blank"></a><span class="ttip">Reddit</span></li>';
}
// Linkdedin
if(get_option('atp_linkedIn_enable')=='on'){
	$out .= '<li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.esc_url( get_permalink($post->ID) ).'&amp;title='.get_the_title() .'" class="symbol" title="linkedin" target="_blank"></a><span class="ttip">LinkedIn</span></li>';
}
// Tumblr
if(get_option('atp_tumblr_enable')=='on'){
	$out .= '<li><a href="http://www.tumblr.com/share/link?url='. urlencode(get_permalink($post->ID)).'&amp;name='. urlencode($post->post_title).'&amp;description='. urlencode(get_the_excerpt()).'" class="symbol" title="tumblr" target="_blank"></a><span class="ttip">Tumblr</span></li>';
}
// Pinterest
if(get_option('atp_pinterest_enable')=='on'){
	if( $urlPostThumb !='') {
	
	$out .= '<li><a href="http://pinterest.com/pin/create/button/?url='.  esc_url( get_permalink($post->ID) ).'&media='.esc_url( $urlPostThumb ).'&description='. get_the_title() .'" class="symbol" title="pinterest" target="_blank"></a><span class="ttip">Pinterest</span></li>';
	
	}else{

	$out .= '<li><a href="http://pinterest.com/pin/create/button/?url='.esc_url ( get_permalink($post->ID) ).'&description='. get_the_title() .'" class="symbol" title="pinterest" target="_blank"></a><span class="ttip">Pinterest</span></li>';
	
	}
}
// StumbleUpon
if(get_option('atp_stumbleupon_enable')=='on'){
	$out .= '<li><a href="http://www.stumbleupon.com/submit?url='.esc_url( get_permalink($post->ID) ).'&amp;title='. get_the_title() .'" class="symbol" title="stumbleupon" target="_blank"></a><span class="ttip">StumbleUpon</span></li>';
}
// Email
if(get_option('atp_email_enable')=='on'){
	$out .= '<li class="email"><a href="mailto:?subject='. get_the_title() .'&amp;body='. esc_url( get_permalink() ) .'" class="symbol" title="email" target="_blank"></a><span class="ttip">Email</span></li>';
}
if( !empty( $out ) ) {
	$output ='<div class="sharing-box">';
	$output .= '<h4>'. __('Share This Post!','iva_theme_front') .'</h4>';
	$output .= '<ul class="sharing-box-ico">';
	$output .= $out;
	$output .= '</ul>';
	$output .= '</div>';
	echo $output;
}
?>