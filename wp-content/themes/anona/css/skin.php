<?php
function atp_style() {
	$atp_option_var = array(
		'atp_themecolor', 'atp_wrapbg',
		'atp_h1', 'atp_h2', 'atp_h3',
		'atp_h4', 'atp_h5', 'atp_h6',
		'atp_bodyp', 'atp_headerproperties',
		'atp_subheaderproperties','atp_subheader_textcolor',
		'atp_footerbg', 'atp_footertext',
		'atp_copyrights', 'atp_copybgcolor',
		'atp_breadcrumbtext', 'atp_stickybarcolor','atp_stickybartext',
		'atp_sidebartitle', 'atp_footertitle',
		'atp_entrytitle', 'atp_entrytitlelinkhover',
		'atp_bodyproperties',
		'atp_logotitle', 'atp_tagline',
		'atp_footerlinkcolor', 'atp_footerlinkhovercolor',
		'atp_topmenu', 'atp_topmenu_linkhover',
		'atp_topmenu_hoverbg',
		'atp_topmenu_sub_bg', 'atp_topmenu_sub_link',
		'atp_topmenu_sub_linkhover', 'atp_topmenu_sub_hoverbg',
		'atp_topmenu_active_link', 'atp_menu_dropdown_border_color',
		'atp_entrytitle','atp_overlayimages', 'atp_link',
		'atp_linkhover','atp_subheaderlink',
		'atp_subheaderlinkhover','atp_subheader_pt',
		'atp_subheader_pb','atp_logo_ml','atp_logo_mt',
		'atp_extracss','atp_teaser_properties',
		'atp_footerheadingcolor','atp_topbar_bgcolor','atp_mmenu',
		'atp_topbar_text', 'atp_fontwoff', 'atp_sbadge_color','atp_topbar_link',
		'atp_fontttf','atp_fontsvg','atp_hovertype_bg','atp_hovertype_bghover',
		'atp_fonteot','atp_fontname','atp_fontclass','atpbodyfont','atp_headings','atp_mainmenufont', 'atp_slidebgimage', 'atp_sliderproperties',
		'atp_sidebar_link','atp_sidebar_link_hover','atp_countdown_font','iva_weatherbg', 'iva_weather_textcolor'
	);

	foreach( $atp_option_var as $value ){
		$$value = get_option($value);
	}

	// Define Variables
	$bodyImage =  generate_imagecss( $atp_bodyproperties, array( 'background-color' => 'color' ) );
	if ( $atp_overlayimages != '' ) {
		$overlayimages =  generate_css( array( 'background-image' => 'url('.THEME_PATTDIR.$atp_overlayimages.')' ) );
	}
	
	$themeColor = isset( $atp_themecolor ) ? $atp_themecolor : '';
	$stickyBG			= $atp_stickybarcolor ? 'background-color:'.$atp_stickybarcolor.';': '';
	$stickytext			= $atp_stickybartext ? 'color:'.$atp_stickybartext.';': '';
	$topbarBG			= $atp_topbar_bgcolor ? 'background-color:'.$atp_topbar_bgcolor.';': '';
	$topbarText			= $atp_topbar_text ? 'color:'.$atp_topbar_text.';': '';
	$topbar_link = $atp_topbar_link ? 'color:'.$atp_topbar_link.';': '';
	$hovertype_bg 		= $atp_hovertype_bg ? 'background-color:'.$atp_hovertype_bg.';': '';
	$hovertype_bghover	= $atp_hovertype_bghover ? 'background-color:'.$atp_hovertype_bghover.';': '';
	$sbadge_color		= $atp_sbadge_color ? 'background-color:'.$atp_sbadge_color.';': '';
	$wrapbg				= $atp_wrapbg ? 'background-color:'.$atp_wrapbg.';': '';
	$bodyP				= generate_fontcss( $atp_bodyp );
	$link				= $atp_link ? 'color:'.$atp_link.';': '';
	$linkHover			= $atp_linkhover ? 'color:'.$atp_linkhover.';': '';
	$teaserBG			= generate_imagecss( $atp_teaser_properties,array('background-color'=>'color'));

	$headerProperties	= generate_imagecss( $atp_headerproperties,array('background-color'=>'color'));
	$sliderProperties 	= generate_imagecss( $atp_sliderproperties,array('background-color'=>'color'));
	$logoTitle			= generate_fontcss( $atp_logotitle);
	$logo_ML			= $atp_logo_ml ? 'margin-left:'.$atp_logo_ml.'px;': '';
	$logo_MT			= $atp_logo_mt ? 'margin-top:'.$atp_logo_mt.'px;': '';
	$subheaderBG		= generate_imagecss( $atp_subheaderproperties,array('background-color'=>'color'));
	$subheader_PT		= $atp_subheader_pt ? 'padding-top:'.$atp_subheader_pt.'px;': '';
	$subheader_PB		= $atp_subheader_pb ? 'padding-bottom:'.$atp_subheader_pb.'px;': '';
	$subheaderText		= $atp_subheader_textcolor ? 'color:'.$atp_subheader_textcolor.';': '';
	$subheaderLink		= $atp_subheaderlink ? 'color:'.$atp_subheaderlink.';': '';
	$subheaderLinkHover	= $atp_subheaderlinkhover ? 'color:'.$atp_subheaderlinkhover.';': '';
	$breadcrumbText		= $atp_breadcrumbtext ? 'color:'.$atp_breadcrumbtext.';': '';
	$footerBg			= generate_imagecss( $atp_footerbg,array('background-color'=>'color'));
	$footerTitleFont	= generate_fontcss( $atp_footertitle);
	$footerText			= generate_fontcss( $atp_footertext);
	$footerHeadingColor = $atp_footerheadingcolor ? 'color:'.$atp_footerheadingcolor.';': '';
	$footerLink			= $atp_footerlinkcolor ? 'color:'.$atp_footerlinkcolor.';':'';
	$footerLinkHover	= $atp_footerlinkhovercolor ? 'color:'.$atp_footerlinkhovercolor.';':'';
	$copyrightProperties = generate_fontcss( $atp_copyrights);
	$tagLine			= generate_fontcss( $atp_tagline);

	$entryTitleFont			= generate_fontcss( $atp_entrytitle );
	$entryTitleLinkHover	= $atp_entrytitlelinkhover? 'color:'.$atp_entrytitlelinkhover.';': '';
	$sidebarTitleFont		= generate_fontcss( $atp_sidebartitle );


	// Top Menu
	$mmenu = $atp_mmenu ? 'background-color:'.$atp_mmenu.';': '';
	$topmenufont = generate_fontcss($atp_topmenu);
	$topmenu_linkhover	= $atp_topmenu_linkhover?'color:'.$atp_topmenu_linkhover.';': '';
	$topmenu_hoverbg = $atp_topmenu_hoverbg?'background-color:'.$atp_topmenu_hoverbg.';': '';
	$topmenu_sub_bg	= $atp_topmenu_sub_bg? 'background:'.$atp_topmenu_sub_bg.';': '';
	$topmenu_sub_link	= $atp_topmenu_sub_link? 'color:'.$atp_topmenu_sub_link.';': '';
	$topmenu_sub_linkhover	= $atp_topmenu_sub_linkhover? 'color:'.$atp_topmenu_sub_linkhover.';': '';
	$topmenu_sub_hoverbg	= $atp_topmenu_sub_hoverbg? 'background:'.$atp_topmenu_sub_hoverbg.';': '';
	$menu_dropdown_border_color = $atp_menu_dropdown_border_color? 'border-color:'.$atp_menu_dropdown_border_color.';': '';	

	$topmenu_active_link	= $atp_topmenu_active_link? 'color:'.$atp_topmenu_active_link.';': '';
	$sidebar_link		= $atp_sidebar_link? 'color:'.$atp_sidebar_link.' !important;': '';
	$sidebar_link_hover	= $atp_sidebar_link_hover? 'color:'.$atp_sidebar_link_hover.' !important;': '';

	// Headings
	$h1font = generate_fontcss($atp_h1);
	$h2font = generate_fontcss($atp_h2);
	$h3font = generate_fontcss($atp_h3);
	$h4font = generate_fontcss($atp_h4);
	$h5font = generate_fontcss($atp_h5);
	$h6font = generate_fontcss($atp_h6);

	$bodyfont = $atpbodyfont ? ' font-family:'.$atpbodyfont.';': '';
	$headings = $atp_headings ? ' font-family:'.$atp_headings.';': '';
	$mainmenufont = $atp_mainmenufont ? ' font-family:'.$atp_mainmenufont.';':'';
	$countdownfont = $atp_countdown_font ? ' font-family:'.$atp_countdown_font.';':'';
	// weather
	$weatherbg				= generate_imagecss( $iva_weatherbg,array('background-color'=>'color'));
	$weather_textcolor		= $iva_weather_textcolor ? 'color:'.$iva_weather_textcolor.';': '';
?>
<style>

<?php
// Megamenu style starts here
$menu_id = get_nav_menu_locations();
$iva_custom_styles = $padding_right =  $padding_bottom =  $padding_left='';
if( isset( $menu_id['primary-menu'] ) ) {
	$iva_menu_items = wp_get_nav_menu_items( $menu_id['primary-menu']);
	foreach ( $iva_menu_items as $iva_item ) {
		if ( $iva_item->menu_item_parent === '0') {
			$mmenu_stored_val = get_option( 'mm_menu_bg_' . $iva_item->object_id);
			if( $mmenu_stored_val['image'] != '' ) {
				
				if( $mmenu_stored_val['pright'] == ''){
					$padding_right = '0';
				}else{
					$padding_right = $mmenu_stored_val['pright'];
				}
				
				if( $mmenu_stored_val['pbottom'] == ''){
					$padding_bottom = '0';
				}else{
					$padding_bottom = $mmenu_stored_val['pbottom'];
				}
				
				if( $mmenu_stored_val['pleft'] == ''){
					$padding_left = '0';
				}else{
					$padding_left = $mmenu_stored_val['pleft'];
				}

				$iva_custom_styles .= "#iva_megamenu .menu-item-$iva_item->ID > .sub-container > .sub-menu {";

				$iva_custom_styles .= "background-image: url('" . $mmenu_stored_val['image'] . "');";

				$iva_custom_styles .= "background-repeat: no-repeat;";
				$iva_custom_styles .= "background-position: ". $mmenu_stored_val['position'] .";";
				$iva_custom_styles .= "padding: 25px ".$padding_right."px ".$padding_bottom."px ".$padding_left."px !important;";
				$iva_custom_styles .= "}";
			}
		}
	}
	echo $iva_custom_styles;
}// Megamenu style ends here
?>

<?php if ( $themeColor != '' ) { ?>
.iva-progress-bar .bar-color, 
.homepage_teaser, 
table.fancy_table th,
.status-format, 
.comment-edit-link, 
.ei-slider-thumbs li a:hover, 
.ei-slider-thumbs li.ei-slider-element,
a.btn,
#back-top span,
.flickr_badge_image:hover,
.events-carousel .carousel-event-date,
.client-image img:hover,
.imageborder:hover,
.sub_nav li.current_page_item > a,
.sub_nav li.current_page_item > a:hover,
.flex-title h5 span,
.iva-services:hover .cs-title,
.grid figcaption,
.ac_title.active .arrow, 
.toggle-title.active .arrow,
.cs-title::after,
.ac_title .arrow:hover,
.iva-progress-bar .bar-color,
.services_icon3, 
.services_icon4,
#subheader,
.highlight1,
.iva-date-ui.ui-widget-content .ui-state-active { 
	background-color:<?php echo $themeColor;  ?>  !important 
}

a,
#footer a,
#atp_menu > li:hover,
#atp_menu > li.sfHover,
#atp_menu > li.current-menu-item, 
#atp_menu > li.current-menu-ancestor, 
#atp_menu > li.current-page-ancestor,
#atp_menu li.current-cat > a, 
#atp_menu li.current_page_item > a,
#atp_menu li.current-page-ancestor > a,
#atp_menu li li:hover, 
#atp_menu li li.sfHover, 
#atp_menu li li a:focus, 
#atp_menu li li a:hover, 
#atp_menu li li a:active,
.services_icon1,.highlight2,
.tarrow,
.services_icon2a, 
.services_icon2b,
.sf-menu li.current-menu-item > a, 
.sf-menu li.current-menu-ancestor > a, 
.sf-menu li.current-page-ancestor > a { color:<?php echo $themeColor; ?> }

#footer, 
.hortabs .tabs li.current, 
.fancyheading span, 
blockquote.alignright, 
blockquote.alignleft, 
.cs-title,
.fancytitle span {
	border-color:<?php echo $themeColor; ?>
}

blockquote.aligncenter,
.toggle-title.active, 
.ac_title.active,
.ac_wrap .ac_content, 
.ac_wrap .toggle_content,
.ac_wrap .ac_title:hover{
	border-left-color: <?php echo $themeColor; ?>
}

<?php } ?>

<?php if ( $bodyImage != '' || $bodyP != '' ) { ?>
body { <?php echo $bodyImage; ?> }
body { <?php echo $bodyP; echo $bodyfont; ?>}
<?php } ?>
<?php if ( $atp_overlayimages != '' ) { ?>
.bodyoverlay { <?php echo $overlayimages; ?> }
<?php } ?>

.pagemid { <?php echo $wrapbg; ?> }
h1, h2, h3, h4, h5, h6, .flex-title h5 span { <?php echo $headings; ?> }
body { <?php echo $bodyfont; ?> }
.topbar { <?php echo $topbarBG; ?>}
.topbar { <?php echo $topbarText; ?>}
.atp_sub_nav ul li a,
.topbar a { <?php echo $topbar_link; ?>}

.hover_type a  { <?php echo $hovertype_bg; ?>}
.hover_type a.hoverdetails:hover,.hover_type a.hovergallery:hover,.hover_type a.hoverimage:hover { <?php echo $hovertype_bghover; ?>}
.woocommerce span.onsale, .woocommerce-page span.onsale { <?php echo $sbadge_color; ?>}

.header, #fixedheader { <?php echo $headerProperties; ?> }

.sf-menu ul li a { <?php echo $topmenu_sub_bg; ?> }
.sf-menu ul li a { <?php echo $menu_dropdown_border_color; ?> }

.homepage_teaser { <?php echo $teaserBG; ?> }
#subheader { <?php echo $subheaderBG; echo $subheader_PT; echo $subheader_PB; echo $subheaderText; ?> }
#subheader .page-title { <?php echo $subheaderText; ?> }
h1#site-title a{ <?php echo $logoTitle; ?> }
h2#site-description { <?php echo $tagLine;  ?> }
.logo { <?php echo $logo_ML; ?> <?php echo $logo_MT; ?> }
#sticky { <?php echo $stickyBG; ?> }
#sticky { <?php echo $stickytext; ?> }

.sf-menu,
.primarymenu { <?php echo $mmenu; ?> }

.sf-menu > li > a,
.primarymenu > li > a { <?php echo $topmenufont . $mainmenufont; ?> }

#atp_menu li:hover, 
#atp_menu li.sfHover { <?php echo $topmenu_hoverbg; ?> }

#atp_menu li:hover, 
#atp_menu li.sfHover, 
#atp_menu a:focus, 
#atp_menu a:hover, 
#atp_menu a:active { <?php echo $topmenu_linkhover; ?> }
#atp_menu ul li { <?php echo $topmenu_sub_bg; ?> }
#atp_menu ul a { <?php echo $topmenu_sub_link; ?> }

#atp_menu li li:hover, 
#atp_menu li li.sfHover, 
#atp_menu li li a:focus, 
#atp_menu li li a:hover, 
#atp_menu li li a:active {<?php echo $topmenu_sub_linkhover; echo $topmenu_sub_hoverbg; ?> }

#atp_menu li.current-cat > a, 
#atp_menu li.current_page_item > a, 
#atp_menu li.current-page-ancestor > a,
#atp_menu li.current-menu-item > a, 
#atp_menu li.current-menu-ancestor > a, 
#atp_menu li.current-page-ancestor > a  { <?php echo $topmenu_active_link; ?> }

#atp_menu > li:hover,
#atp_menu > li.sfHover,
#atp_menu > li.current-menu-item, 
#atp_menu > li.current-menu-ancestor, 
#atp_menu > li.current-page-ancestor { <?php echo $topmenu_active_link; ?> }

#atp_menu > li.current-menu-item:hover, 
#atp_menu > li.current-menu-ancestor:hover, 
#atp_menu > li.current-page-ancestor:hover { <?php echo $topmenu_active_link; ?> }

h1 { <?php echo $h1font; ?>} h2 { <?php echo $h2font; ?> } h3 { <?php echo $h3font; ?> }h4 { <?php echo $h4font; ?> }h5 { <?php echo $h5font; ?> }h6 { <?php echo $h6font; ?> }

h2.entry-title a { <?php echo $entryTitleFont; ?> }
h2.entry-title a:hover { <?php echo $entryTitleLinkHover; ?> }
.widget-title { <?php echo $sidebarTitleFont; ?> }
#footer .widget-title { <?php echo $footerTitleFont; ?> }

#sidebar a { <?php echo $sidebar_link; ?> }
#sidebar a:hover { <?php echo $sidebar_link_hover; ?> }

a,.entry-title a { <?php echo $link; ?> }
a:hover,.entry-title a:hover { <?php echo $linkHover; ?> }

#subheader a { <?php echo $subheaderLink; ?> }
#subheader a:hover { <?php echo $subheaderLinkHover; ?> }

.iva-date-wrap { <?php echo $weatherbg; ?>  <?php echo $weather_textcolor; ?> }
#footer { <?php echo $footerBg; ?> <?php echo $footerText; ?> }

#footer .widget-title { <?php echo $footerHeadingColor; ?> }
.breadcrumbs { <?php echo $breadcrumbText; ?> }
#footer a { <?php echo $footerLink; ?> }
#footer a:hover { <?php echo $footerLinkHover; ?> }
.countdown-amount,
.countdown-section { <?php echo $countdownfont; ?> }

<?php if($atp_extracss != '') { ?>
<?php echo $atp_extracss; ?>
<?php } ?>

<?php
if ( ( $atp_fontwoff != '')
		&& ( $atp_fontttf != '')
		&& ( $atp_fontsvg != '' )
		&& ( $atp_fonteot != '' ) 
	) {
	$fontclass = $atp_fontclass ? $atp_fontclass : 'h1, h2, h3, h4, h5, h6, #atp_menu a, .splitter ul li a, .pagination'; ?>
	
	@font-face {
		font-family: '<?php echo $atp_fontname; ?>';
		src: url('<?php echo $atp_fontwoff; ?>');
		src: url('<?php echo $atp_fonteot; ?>?#iefix') format('embedded-opentype'),
			url('<?php echo $atp_fontwoff; ?>') format('woff'),
			url('<?php echo $atp_fontttf; ?>') format('truetype'),
			url('<?php echo $atp_fontsvg; ?>#<?php echo $atp_fontname; ?>') format('svg');
		font-weight: normal;
		font-style: normal;
	}
	<?php echo $fontclass; ?> {
		font-family: '<?php echo $atp_fontname; ?>';
	}
	<?php define('CUSTOMFONT',true); ?>
	<?php } ?>
</style>
<?php } ?>
<?php 
add_action( 'wp_head', 'atp_style', 100 );

//for font css attributes
function generate_fontcss($arr_var) {
	$size			= $arr_var['size'] 			? 'font-size:'.$arr_var['size'].';': '';
	$color			= $arr_var['color'] 		? 'color:'.$arr_var['color'].';': '';
	$lineheight		= $arr_var['lineheight']	? 'line-height:'.$arr_var['lineheight'].';': '';
	$style			= $arr_var['style'] 		? 'font-style:'.$arr_var['style'].';': '';
	$variant		= $arr_var['fontvariant'] 	? 'font-weight:'.$arr_var['fontvariant'].';': '';
	
	return "{$size} {$color} {$lineheight} {$style} {$variant}";
}

//for background image css attributes
function generate_imagecss($arr,$include_others) {

	$str='';
	if($arr['image'] != '') {
	
		$str .='background-image:url('.$arr['image'].');
		background-repeat:'.$arr['style'].';
		background-position:'.$arr['position'].';
		background-attachment:'.$arr['attachment'].';';
	}
	
	if(is_array($include_others)) {
		foreach($include_others as $key => $val) {
			if($arr[$val] != '')
				$str .= $key.':'.$arr[$val].';';
		}
	}
	return $str;
}

//forkey value css pairs
function  generate_css($arr) {
	$str = '';
	if(is_array($arr)) {
		foreach($arr as $key => $val) {
			$str .= $key.':'.$val.';';
		}
	}
	return $str;
}
?>