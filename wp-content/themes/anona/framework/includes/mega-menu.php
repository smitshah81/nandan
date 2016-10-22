<?php 
// Enqueue mega menu script
wp_enqueue_script('iva-megamenu-script');


$iva_menu_id = get_nav_menu_locations();

// Displays a navigation menu created in the Appearance → Menus panel.
if($iva_menu_id){
	echo '<div class="dcjq-mega-menu" id="iva_megamenu">';
	wp_nav_menu( array( 'fallback_cb' => '', 'menu' =>$iva_menu_id['primary-menu'] , 'container' => false ) );
	echo '</div>';
}
// Mega menu settings from theme option panel
$iva_mg_rowItems 	= get_option('atp_mm_rowItems')? get_option('atp_mm_rowItems'):'4';
$iva_mg_speed		= get_option('atp_mm_speed') ? get_option('atp_mm_speed'):'slow';
$iva_mg_effect		= get_option('atp_mm_effect') ? get_option('atp_mm_effect'):'fade';
$iva_mg_event		= get_option('atp_mm_event') ? get_option('atp_mm_event') :'hover';
$iva_mg_fullWidth	= ( get_option('atp_mm_fullwidth')=='on') ? 'fullWidth: true' :'fullWidth: false';
// Mega menu default settings
echo '<script>
	jQuery(document).ready(function () {
		"use strict";
		jQuery("#iva_megamenu .menu").dcMegaMenu({
			rowItems: "'.$iva_mg_rowItems.'",
			speed	: "'.$iva_mg_speed.'",
			effect	: "'.$iva_mg_effect.'",
			event	: "'.$iva_mg_event.'",
			'.$iva_mg_fullWidth.'
		});
	});
</script>';
?>