<?php

	// G A L L E R I A 
	//--------------------------------------------------------
if ( !function_exists( 'iva_sc_galleria' ) ){
	function iva_sc_galleria($atts, $content = null) {
		extract(shortcode_atts(array(
			'id'		=> '1',
			'width'		=> '600',
			'height'	=>'450',
			'autoplay'	=> '4000',
			'transition'=> 'fade',
		), $atts));
		
		wp_print_scripts('iva-jgalleria');
		wp_print_scripts('iva-jgclassic');
		
		iva_sc_gal_scripts( $height,$autoplay,$width,$id );
		
		global $post;
		$pid = $post->ID;
		
		$out =  '<div class="galleria">';
		$id = intval($id);
		$attachments = get_children("post_parent=$post->ID&post_type=attachment&post_mime_type=image&order=ASC");	
	
		$out .=  '<div id="galleria'.$id.'" style="width:' .$width. '; height:' .$height. ';">';
		foreach ( $attachments as $id => $attachment ) {

			$img_title = $attachment->post_title;
			$img_desc = $attachment->post_excerpt;
			// Attachment page ID
			$att_page = get_attachment_link($id);
			// Returns array
			$full_attachment=wp_get_attachment_image_src($attachment->ID, 'full');
			$thumbnail = wp_get_attachment_image_src($id,'thumbnail');
			$out .= '<a href="'.$full_attachment['0'].'" >';	
			$out.= iva_sc_resize('',$thumbnail[0],'100','50','',$img_title);
			$out.='</a>';
		}
		$out .=  '</div>';
		$out .=  '</div>';
		
		return $out;
	}
	add_shortcode('galleria','iva_sc_galleria');
}
	

	// G A L L E R I A   S C R I P T 
	//--------------------------------------------------------
if ( !function_exists( 'iva_sc_gal_scripts' ) ){
	function iva_sc_gal_scripts($height,$autoplay,$width,$id) {
		echo '<script type="text/javascript">
		
		jQuery(document).ready(function($) {
			$("#galleria'.$id.'").galleria({
				transition: "fade",
				autoplay:'.$autoplay.',
				height:'.(int)$height.',
				image_crop: true,
				responsive: true
			});
		});	
		</script>';
	}
}
	
	// G A L L E R I A   E X T E R N A L
	//--------------------------------------------------------
if ( !function_exists( 'iva_sc_urlgalleria' ) ){
	function iva_sc_urlgalleria($atts, $content = null) {
		extract(shortcode_atts(array(
			'id'		=> '21',
			'width'		=> '600',
			'height'	=> '450',
			'autoplay'	=> '4000',
			'transition'=> 'fade',
		), $atts));
		
		wp_print_scripts('iva-jgalleria');
		wp_print_scripts('iva-jgclassic');
		$id = rand(1,100);
		iva_urlgal_scripts($height,$autoplay,$width,$id);
		
		global $post;
		$out =  '<div class="galleria">';
		if(preg_match_all('!http://.+\.(?:jpe?g|png|gif)!Ui',$content,$matches)){
			$out .=  '<div id="galleria'.$id.'" style="width:' .$width. '; height:' .$height. ';">';
			foreach ($matches[0] as $images) {
				$out .= '<a href="'.$images.'" >';	
				$out .= iva_sc_resize('',$images,'100','50','','');
				$out.='</a>';
			}
			$out .=  '</div>';
		}
		$out .=  '</div>';		
		return $out;
	}
	add_shortcode('galleriaurl','iva_sc_urlgalleria');
}
	
	
	// G A L L E R I A   E X T E R N A L   S C R I P T 
	//--------------------------------------------------------
if ( !function_exists( 'iva_sc_galleria' ) ){
	function iva_urlgal_scripts($height,$autoplay,$width,$id) {
		echo '<script type="text/javascript">
		jQuery(document).ready(function($) {
			$("#galleria'.$id.'").galleria({
				transition: "fade",
				autoplay:'.$autoplay.',
				height:'.(int)$height.',
				image_crop: true,
				responsive: true
			});
		});	
		</script>';
	}
}

	// M I N I   G A L L E R Y
	//--------------------------------------------------------
if ( !function_exists( 'iva_sc_images_mini_gallery' ) ){
	 function iva_sc_images_mini_gallery( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'alt'		=> '',
			'images'	=> '',
			'class'		=> '',
			'width'		=>'',
			'height'	=>'',
		), $atts));

		if(preg_match_all('!http://.+\.(?:jpe?g|png|gif)!Ui',$content,$matches)){
			$out='<ul class="sys_mini_gallery">';
			foreach ($matches[0] as $images) {
				$out .= '<li><div style="height:'.$height.';"><a data-rel="prettyPhoto[mixed]" href="' .$images. '" >';
				//$out .= iva_sc_resize('',$images,$width,$height,$class,'');
					$out .= '<figure><img src="'.$images.'" width="'.$width.'" height="'.$height.'"></figure>';
				$out .='</a></div>';
				$out .='</li>';
			}
			$out .= '</ul><div class="clear"></div>';
		}
		return $out;
	}
	add_shortcode('minigallery', 'iva_sc_images_mini_gallery');
}
	
?>