<?php
//AUDIO
if ( !function_exists( 'iva_sc_audio' ) ){
	function iva_sc_audio($atts, $content = null)
	{
		extract(shortcode_atts(array(
			'title'         => '',
			'audio_path'    => ''
		), $atts));
		
		return '<div >'.$audio_path.'</div>';
	}
	add_shortcode('audionew', 'iva_sc_audio');
}


// DIVIDER
//--------------------------------------------------------
if ( !function_exists( 'iva_sc_divider' ) ){
	function iva_sc_divider($atts, $content = null)
	{
		extract(shortcode_atts(array(
			'margin' => '',
			'type' => '',
			'style' => '',
			'bordercolor' => ''
		), $atts));
		
		$bordercolor = $bordercolor ? 'border-color:' . $bordercolor . ';' : '';
		//$margin      = $margin ? 'margin-top:'. $margin .'; margin-bottom: '. $margin .';' : '';
		$margin      = $margin ? 'margin:'. $margin .';' : '';
		if (!empty($bordercolor) || !empty($margin)) {
			$extras = ' style="' . $bordercolor . $margin . '"';
		} else {
			$extras = '';
		}
		
		return '<div class="divider ' . $type . ' ' . $style . '" ' . $extras . '></div>';
	}
	add_shortcode('divider', 'iva_sc_divider');
}


// DIVIDER SPACE
//--------------------------------------------------------
if ( !function_exists( 'iva_sc_demo_space' ) ){
	function iva_sc_demo_space($atts, $content = null)
	{
		extract(shortcode_atts(array(
			'height' => '15'
		), $atts));
		
		return '<div class="demo_space" ' . ($height ? ' style="height:' . (int) $height . 'px"' : '') . '></div>';
	}
	add_shortcode('demo_space', 'iva_sc_demo_space');
}


// CUSTOM DIVIDER
//--------------------------------------------------------
if ( !function_exists( 'iva_sc_custom_divider' ) ){
	function iva_sc_custom_divider($atts, $content = null)
	{
		extract(shortcode_atts(array(
			'img' => '',
			'margin' => ''
		), $atts));
		return '<div class="customdivider" ' . ($margin ? ' style="margin:' . (int) $margin . 'px"' : '') . '><img src="' . $img . '" alt=""></div>';
	}
	add_shortcode('custom_divider', 'iva_sc_custom_divider');
}


// DIVIDER WITH SPACE
//--------------------------------------------------------
if ( !function_exists( 'iva_sc_divider_space' ) ){
	function iva_sc_divider_space($atts, $content = null)
	{
		return '<div class="divider_space"></div>';
	}
	add_shortcode('divider_space', 'iva_sc_divider_space');
}


// DIVIDER LINE
//--------------------------------------------------------
if ( !function_exists( 'iva_sc_divider_line' ) ){
	function iva_sc_divider_line($atts, $content = null)
	{
		extract(shortcode_atts(array(
			'bgcolor' => ''
		), $atts));
		$bgcolor = $bgcolor ? 'background-color:' . $bgcolor . ';' : '';
		if (!empty($bgcolor)) {
			$extras = ' style="' . $bgcolor . '"';
		} else {
			$extras = '';
		}
		
		return '<div class="divider_line" ' . $extras . '></div>';
	}
	add_shortcode('divider_line', 'iva_sc_divider_line');
}


// CLEAR
//--------------------------------------------------------
if ( !function_exists( 'iva_sc_clear' ) ){
	function iva_sc_clear($atts, $content = null)
	{
		return '<div class="clear"></div>';
	}
	add_shortcode('clear', 'iva_sc_clear');
}


// A L I G N M E N T
//--------------------------------------------------------
if ( !function_exists( 'iva_sc_align' ) ){
	function iva_sc_align($atts, $content = null, $code)
	{
		extract(shortcode_atts(array(
			'position' => ''
		), $atts));
		return '<div class="' . $position . '">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('align', 'iva_sc_align');
}


// G O O G L E   F O N T
//--------------------------------------------------------
if ( !function_exists( 'iva_sc_googlefont' ) ){
	function iva_sc_googlefont($atts, $content = null, $code)
	{
		extract(shortcode_atts(array(
			'font'   => 'RaleWay',
			'size'   => '32px',
			'margin' => '0px',
			'weight' => '',
			'extend' => '',
			'fontstyle'=>'',
			'color'  => ''
		), $atts));
		$google = preg_replace("/ /", "+", $font);
		$protocol = (is_ssl()) ? 'https://' : 'http://';
		
		if ( $fontstyle == 'true' ) {
			$font_style = 'italic';
		}else{
			$font_style = 'normal';
		}
		if($color){
			$color = "color :$color";
		}else{
			$color = '';
		}	
		if( !$weight &&  $extend ){
			return '<link href="'.$protocol.'fonts.googleapis.com/css?family=' . $google . ':400'. '&subset='.$extend.'" rel="stylesheet" type="text/css">
					<div class="google-font" style="font-family:\'' . $font . '\', serif !important; font-size:' . (int)$size . 'px !important;font-weight:' . $weight.' !important; margin:' . $margin . '  !important; font-style:'.$font_style.' !important; '.$color.'">' . do_shortcode($content) . '</div>';

		}else if( !$extend && $weight ){
			return '<link href="'.$protocol.'fonts.googleapis.com/css?family=' . $google . ':'.$weight.'" rel="stylesheet" type="text/css">
					<div class="google-font" style="font-family:\'' . $font . '\', serif !important; font-size:' . (int)$size . 'px !important;font-weight:' . $weight.' !important; margin:' . $margin . '  !important; font-style:'.$font_style.' !important; '.$color.'">' . do_shortcode($content) . '</div>';
		
		}else if( $extend && $weight ){
			return '<link href="'.$protocol.'fonts.googleapis.com/css?family=' . $google . ':'.$weight.'&subset='.$extend.'" rel="stylesheet" type="text/css">
					<div class="google-font" style="font-family:\'' . $font . '\', serif !important; font-size:' . (int)$size . 'px !important;font-weight:' . $weight.' !important; margin:' . $margin . '  !important; font-style:'.$font_style.' !important; '.$color.'">' . do_shortcode($content) . '</div>';
		
		}else{
			return '<link href="'.$protocol.'fonts.googleapis.com/css?family=' . $google . ':400" rel="stylesheet" type="text/css">
				<div class="google-font" style="font-family:\'' . $font . '\', serif !important; font-size:' . (int)$size . 'px !important; margin:' . $margin . ' !important; font-style:'.$font_style.' !important; '.$color.'">' . do_shortcode($content) . '</div>';

		}
	}
	add_shortcode('googlefont', 'iva_sc_googlefont');
}


// HIGHLIGHT
//--------------------------------------------------------
if ( !function_exists( 'iva_sc_highlight' ) ){
	function iva_sc_highlight($atts, $content = null, $code)
	{
		extract(shortcode_atts(array(
			'type' => '',
			'bgcolor' => '',
			'text_color' => ''
		), $atts));
		
		$bgcolor   = $bgcolor ? 'background-color:' . $bgcolor . ';' : '';
		$textcolor = $text_color ? 'color:' . $text_color . ';' : '';
		
		if($type =='highlight1'){
			$highlight = 'highlight1';
		}else{
			$highlight = 'highlight2';
		}
		
		if (!empty($textcolor) || !empty($bgcolor)) {
			$extras = ' style="' . $bgcolor . $textcolor . '"';
		} else {
			$extras = '';
		}
		return '<span class="'.$highlight.'" ' . $extras . '>' . do_shortcode($content) . '</span>';
	}
	add_shortcode('highlight', 'iva_sc_highlight');
}


// F A N C Y   H E A D I N G 
//--------------------------------------------------------
if ( !function_exists( 'iva_sc_fancy_heading' ) ){
	function iva_sc_fancy_heading($atts, $content = null, $code)
	{
		extract(shortcode_atts(array(
			'textcolor' 	=> '',
			'heading' 		=> '',
			'align' 		=> 'left',
			'text'			=> '',
			'description'	=> '',
			'heading_style'	=> '',
			'border_style'	=> '',
			'border_width'	=> '',
			'border_color'	=> '',
			'margin_bottom' => ''
		), $atts));
		
		$textcolor = $textcolor ? 'color:' . $textcolor . ';' : '';
		$description = $description ? $description :'';

		$headingstyle = '';

		if($heading_style == 'border_heading'){
			$headingstyle = ' bordered';
		}

		if($heading_style == 'border_heading'){
			if($border_style || $border_color ){
				$border = 'border: 1px '.$border_style.'  '.$border_color.';'; 
			}
			if($border_width){
				$border_width = 'border-width:'.$border_width.';'; 
			}
			$extras = ' style="' . $textcolor .$border.$border_width.'"';
		}else{
			if ( !empty($textcolor) ) {
				$extras = ' style="' . $textcolor . '"';
			} else {
				$extras = '';
			}
		}
		$before = $after = $out = $xlclass= '';

		if ($heading == 'xlarge') {
			$heading = 'h1';
			$xlclass = 'xlarge';
		}

		if ($heading == 'large') {
			$heading = 'h1';
			$xlclass = 'large';
		}

		if ($heading != '') {
			$before = '<' . $heading . ' class="fancy-title '.$xlclass.'">';
			$after  = '</' . $heading . '>';
		}

		
		$out .= '<div class="fancyheading ' . $align . $headingstyle .'" '. ($margin_bottom != '' ? ' style="margin-bottom:' . (int) $margin_bottom . 'px"' : '') .'>';
		$out .= $before . '<span ' . $extras . '>'.$text.'<small>' . do_shortcode($content) . '</small></span>' . $after;
		$out .= '</div>';
		
		return $out;
	}
	add_shortcode('fancyheading', 'iva_sc_fancy_heading');
}


// D R O P C A P
//--------------------------------------------------------
if ( !function_exists( 'iva_sc_dropcap' ) ){
	function iva_sc_dropcap($atts, $content = null, $code)
	{
		extract(shortcode_atts(array(
			'color'         => '',
			'letter'        => '',
			'type'          => '',
			'text'          => '',
			'text_color'    => '',
			'bgcolor'       => ''
		), $atts));
			
		if($type =='dropcap1'){
			$drop_class = "dc-square";
			$drop_style = ($bgcolor) ? 'style="background-color:'.$bgcolor.';color:'.$text_color.'"':''; 
			
		}elseif($type =='dropcap2'){
			$drop_class = "dc-circle";
			$drop_style = ($bgcolor) ? 'style="background-color:'.$bgcolor.';color:'.$text_color.'"':'';  
			
		}elseif($type == 'dropcap3'){
			$drop_class = "dc-text";
			$drop_style = ($text_color) ? 'style="color:'.$text_color.'"':'';
		}
		
		if($type == 'dropcap3'){    
			return '<span  class="dropcap '.$drop_class.'" '.$drop_style.'>' . do_shortcode($letter) . '</span>';
		}else{
			return '<span  class="dropcap '.$drop_class.'" '.$drop_style.'>' . do_shortcode($letter) . '</span>';
		}
		
	}
	add_shortcode('dropcap', 'iva_sc_dropcap');
}



// B L O C K Q U O T E
//--------------------------------------------------------
if ( !function_exists( 'iva_sc_blockquote' ) ){
	function iva_sc_blockquote($atts, $content = null, $code)
	{
		extract(shortcode_atts(array(
			'align' 	=> '',
			'cite' 		=> '',
			'citelink' 	=> '',
			'width' 	=> '',
			'animation' => '',
			'bg_color'  => '',
			'txt_color' => '',
			
		), $atts));
		
		// Animation Effects
		//--------------------------------------------------------  
		$out = '';
		$animation = $animation ? ' data-id="' . $animation . '"' : '';
		$bgcolor 	= $bg_color ? 'background-color: '. $bg_color .'; ' : '';
		$text_color = $txt_color ? 'color: '. $txt_color .';':'';
		$width = $width ? ' width: ' . $width . ';' : '';
		$styling 	= ( $bgcolor || $text_color || $width !='' ) ? ' style="'. $bgcolor.$text_color.$width.'"' : '' ;
		
		$out .= '<blockquote '.$animation.' '.$styling.' class="iva_anim '.( $align ? ' align'.$align:'' ).'">';
		$out .= '<p >' . do_shortcode($content) . '</p>'; 
		
		if( $cite && $citelink){
			$out .= '<cite><a href="'.esc_url($citelink).'">- '.$cite.'</a></cite>';
		}
		elseif( !$cite && $citelink){
			$out .= '<cite><a href="'.esc_url($citelink).'">'.esc_url($citelink).'</a></cite>';
		}
		elseif( $cite && !$citelink){
			$out .= $cite;
		}
		$out .= '</blockquote>';
		return $out;
	}
	add_shortcode('blockquote', 'iva_sc_blockquote');
}


// L I S T   I C O N S
//--------------------------------------------------------
if ( !function_exists( 'iva_sc_list' ) ){
	function iva_sc_list($atts, $content = null, $code)
	{
		extract(shortcode_atts(array(
			'icon'  	=> '',
			'color' 	=> '',
			'bgcolor'   => '',
			'liststyle' => 'default',
		), $atts));
		
		if ($icon) {
			$icon = $icon;
			$color = $color ? 'color:' . $color . ';' : '';
			$bgcolor = $bgcolor ? 'background-color:' . $bgcolor . ';' : '';
			$liststyle = $liststyle ?  $liststyle : '';
		}
		if($liststyle =='default'){
			$iconstring = str_replace('<ul>', '<ul class="iva-checklist iva-liststyle1">', do_shortcode($content));
			$out = str_replace('<li>', '<li class="iva-li-item-content"><span class="icon-wrapper "><i class="fa fa-fw '.$icon.'"  style="' . $color . '"></i></span>', do_shortcode($iconstring));
		}else{
			$iconstring = str_replace('<ul>', '<ul class="iva-checklist iva-liststyle2">', do_shortcode($content));
			$out = str_replace('<li>', '<li class="iva-li-item-content"><span class="icon-wrapper "><i class="fa fa-fw '.$icon.' list_circle"  style="' . $color .$bgcolor. '"></i></span>', do_shortcode($iconstring));
		}
		return $out;
	}
	add_shortcode('list', 'iva_sc_list');
}



// I C O N S 
//--------------------------------------------------------
if ( !function_exists( 'iva_sc_awesomefont' ) ){
	function iva_sc_awesomefont($atts, $content = null, $code)
	{
		extract(shortcode_atts(array(
			'style' => false,
			'color' => '',
			'size' => ''
		), $atts));
		
		$color = $color ? 'color:' . $color . ';' : '';
		$size  = $size ? 'font-size:' . $size . ';' : '';
		
		$out = '';
		$out .= '<i  style="' . $color . ' ' . $size . '" class="fa ' . $style . '"></i>';
		return $out;
		
	}
	add_shortcode('icons', 'iva_sc_awesomefont');
}



// F A N C Y   A M P E R S A N D
//--------------------------------------------------------
if ( !function_exists( 'iva_sc_fancy_ampersand' ) ){
	function iva_sc_fancy_ampersand($atts, $content = null, $code)
	{
		extract(shortcode_atts(array(
			'color' => '',
			'size' 	=> ''
		), $atts));
		
		$color = $color ? 'color:' . $color . ';' : '';
		$size  = $size ? 'font-size:' . (int) $size . 'px;' : '';
		
		return '<span class="fancy_ampersand" style="' . $color . ' ' . $size . '">&amp;</span>';
	}
	add_shortcode('fancy_ampersand', 'iva_sc_fancy_ampersand');
}


// S E C T I O N  F U L L W I D T H
//--------------------------------------------------------
if ( !function_exists( 'iva_sc_section' ) ){
	function iva_sc_section($atts, $content = null, $code) {
		extract(shortcode_atts(array(
				'bgcolor'    => '',
				'image'      => '',
				'textcolor'  => '',
				'padding'    => '',
				'parallax'   => '',
				'video'      => '',
				'opacity'    => '',
				'pattern'    => '',
				'position'   => '',
				'repeat'     => '',
				'border_width' => '',
				'border_color' => '',
				'attachment' => '',
			), $atts));
		
			$videoclass = $str = $out = '';
			
			if( $video ){
				$videoclass ='iva-page-section';
				$attr = array(
							'src'      =>  $video,
							'poster'   =>  $image,
							'loop'     => 'true',
							'autoplay' => 'true',
							'preload'  => 'auto',
						);
			}
		
			$textcolor 	= $textcolor ? 'color:'.$textcolor.';':'';
			$padding 	= $padding ? 'padding:'.$padding.';' : '' ;
			$opacity 	= $opacity ? 'opacity:'.$opacity.';':'';
			$bgcolor 	= $bgcolor ? 'background-color:'.$bgcolor.';':'';
			$border_top_width = $border_width ? 'border-top-width:'.(int)$border_width.'px;':'';
			$border_bottom_width = $border_width ? 'border-bottom-width:'.(int)$border_width.'px;':'';
			$border_color = $border_color ? 'border-color:'.$border_color.';':'';
			$parallaxid = rand(1,99);
		
			if( $parallax == "true" ){
				$extraclass= "parallaxsection";
			}else{
				$extraclass='';
			}
		
			if( $image ){
				$str .='background-image:url('.$image.');';
				if( $repeat ){
					$str .='background-repeat:'.$repeat.';';
				}
				if( $position ){
					$str .='background-position:'.str_replace('_', ' ', $position).';';
				}
				if( $attachment ){
					$str .='background-attachment:'.$attachment.';';
				}		
			}
			
			$section_pattern  = IVA_SC_IMG_URI.'/images/patterns/'.$pattern;
			$pattern = $pattern ? 'background-image:url( '. $section_pattern.');':'';
			
			if( !empty( $bgcolor ) || !empty( $image ) || !empty( $textcolor ) || !empty( $padding )  ){
				$inner_extras = ' style="'.$bgcolor.$str.$padding.$textcolor.$border_top_width.$border_bottom_width.$border_color.'"   ';
			}else{
				$inner_extras = '';
			}
			if( $pattern || !empty( $opacity ) ){
				$pattern = ' style="'.$pattern.$opacity.'"';
			}
			
			$out .= '<div id="section'.$parallaxid.'"  class="section_row clearfix section_bg '.$extraclass.'  '.$videoclass.' " '.$inner_extras.'>';
			$out .= '<div class="iva-section-patterns" '.$pattern.'></div>';
		
			if( $video ){
				$out .= '<div  class="iva-video-color-mask"></div>';
				$out .= '<div class="iva-video-preload"></div>';    
				$out .= '<div class="iva-section-video">'. wp_video_shortcode( $attr).'</div>';
			}
			$out .= '<div class="section_inner">'.do_shortcode( $content ).'</div></div>';
			return $out;
	}
	add_shortcode('section', 'iva_sc_section');
}


//C O U N T E R
//--------------------------------------------------------
if ( !function_exists( 'iva_sc_counter' ) ){
	function iva_sc_counter($atts, $content = null, $code)
	{
		extract(shortcode_atts(array(
			'icon_style'		=> false,
			'icon_color'		=> '',
			'number_color'		=> '',
			'counter_title'		=> '',
			'datato'			=> '',
			'data_speed'		=> ''
		), $atts));
		
		$iconcolor = $icon_color ? 'color:' . $icon_color . ';' : '';
		$numbercolor = ($number_color !='') ? ' style="color:'.$number_color.';"':'';
		$out = '';
		
		$out .='<div class="milestone_wrap">';	
		$out .='<div class="milestone_icon">';
		if($icon_style){
			$out .='<i style="'.$iconcolor.'" class="fa '.$icon_style.'"></i>';
		}
		$out .='</div>';	
		
		$out .='<div class="milestone_content">';
		$out .='<div class="timer count-number" id="count-number" data-to="'.$datato.'" data-speed="'.$data_speed.'" '.$numbercolor.'></div>';
		
		$out .='<div class="milestone-text">'.$counter_title.'</div>';
		$out .='</div>';
		$out .='</div>';
		return $out;
	}
	add_shortcode('counter', 'iva_sc_counter');
}



// C O U N T D O W N 
//--------------------------------------------------------
if ( !function_exists( 'iva_sc_countdown' ) ){
	function iva_sc_countdown( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'title'     => '',
			'year'      => '',
			'month'     => '',
			'day'       => '',
			'hour'      => '',
			'minute'    => '',
			'bgcolor'	=> '',
			'textcolor' => '',	
			'class'  	=> ''
		), $atts));
		
		$out ='';
		$second = '00';
		if( $title != '' ){
			$out .= $title;
		}
		$extraclass = ($class !='') ? ' class="'.$class.'"':'';
		$random_num  = rand(1, 9999); 
		$out .='<script type="text/javascript">
		jQuery(function($) {
			var enddate = new Date('.$year.' , '.$month.'-1 , '.$day.','.$hour.','.$minute.',0);
			$("#iva-countdown-'.$random_num.'").countdown({
				until: enddate, 
				format: "dHMS",
				padZeroes: true,
				labels:["Years","Months","Weeks","Days","Hours","Minutes","Seconds"],	
				labels1:["Year","Month","Week","Day","Hour","Minute","Second"]
			});
		});
		</script>';
		$out .='<div id="iva-countdown-'.$random_num.'" '.$extraclass.'></div>';
		return $out;  
	}
	add_shortcode('countdown', 'iva_sc_countdown');
}


// P R I C E G R O U P
//--------------------------------------------------------

if( !function_exists('iva_sc_price_group')){
	function iva_sc_price_group( $atts, $content ){
		extract(shortcode_atts(array(
		), $atts));
		
		wp_reset_postdata();
		
		$GLOBALS['price_count'] = 0;
		$count = 0;
		
		$columnid = $class = $output = $featured = '';
		do_shortcode( $content );
		
		if( is_array( $GLOBALS['price'] ) ){
			foreach( $GLOBALS['price'] as $price ){

				if($price['featured'] == "true") {
					$featured = 'featured';
				}else{ 
					$featured = "";
				}

				$output .='<div class="column '.$featured.$columnid.'">';
				$bgcolor = $price['headingbgcolor'];
				$color   = $price['headingcolor'];
				$textcolor = $price['textcolor'];
				$bgcolor = $bgcolor ? 'background-color:'.$bgcolor.';':'';
				$color   = $color ? 'color:'.$color.'; ' : '';
				$extras  = ( $color!=''||$bgcolor!='' ) ?' style="'.$color.$bgcolor.'"':'';

				$textcolor = $textcolor ? 'color:'.$textcolor.';':'';
				$info_extras = ( $textcolor != '') ? ' style="'.$textcolor.'"' : '';

				$output .= '<div class="price-head" '.$extras.'>';
				$output .= '<h2 class="title">'.$price['title'].'</h2>';
				$output .= '<h4 class="price-font">'.do_shortcode( $price['price'] ).'</h4>';
				$output .= '</div>';
				$output .= '<div class="price-content" '.$info_extras.'>'.do_shortcode($price['content']).'</div>';
				$output .= '</div>';
				$count++;
			}
			if( $count == "3" ) { $class="col3"; }
			
			$html  = '<div class="pricetable '.$class.' iva_anim"><div class="pricing-inner">';
			$html .= $output;
			$html .= '</div>';
		}

		$html .= '</div>';
		unset( $GLOBALS['price'], $GLOBALS['price_count'] );

		return $html;
	}
}
// P R I C E 
//--------------------------------------------------------
if( !function_exists('iva_sc_price')){
	function iva_sc_price( $atts, $content ){
		extract(shortcode_atts(array(
			'title'				=> '',
			'featured'			=> '',
			'price'				=> '',
			'headingbgcolor'	=> '',
			'headingcolor'		=> '',
			'textcolor'			=> ''
		), $atts));

		$x = $GLOBALS['price_count'];
		$GLOBALS['price'][$x] = array(
			'title'				=> $title,
			'featured'			=> $featured,
			'price'				=> do_shortcode($price),
			'headingbgcolor'	=> $headingbgcolor,
			'headingcolor'		=> $headingcolor,
			'textcolor'			=> $textcolor,
			'content'			=>  $content
		);
		$GLOBALS['price_count']++;
	}
	add_shortcode( 'pricingcolumns', 'iva_sc_price_group' );
	add_shortcode( 'col', 'iva_sc_price' );
}
?>