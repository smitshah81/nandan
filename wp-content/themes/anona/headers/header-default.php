<?php
/* Header Style1 */
?>
<?php if (get_option('atp_topbar') != "on" && is_active_sidebar( 'topbarleft') || is_active_sidebar( 'topbarright')) { ?>
<div class="topbar">
	<div class="inner">
		
		<div class="one_half ">
			<?php  if ( is_active_sidebar( 'topbarleft' ) ) : dynamic_sidebar('topbarleft');  endif; ?>
		</div>
		<div class="one_half last">		
			<?php  if ( is_active_sidebar( 'topbarright' ) ) : dynamic_sidebar('topbarright');  endif; ?>
		</div>
	</div><!-- /inner -->
</div><!-- /topbar -->
<?php } ?>
<header class="header-style1 default-header">
	<div class="header">
		<div class="header-area">
			<div class="logo">
				<?php atp_generator( 'logo' ); ?>
			</div><!-- /logo -->
			<div class="primarymenu menuwrap">
				<?php
				// Enable mega menu
				$iva_menu_type = get_option('atp_mm_visible'); 
				if( $iva_menu_type === 'on'){
					get_template_part( 'framework/includes/mega','menu' ); 
				}else{
					// Primary menu
					atp_generator( 'atp_primary_menu' ); 
				}
				?>
				<?php if (has_nav_menu( 'primary-menu' ) ) {  ?> <a href="#" class="iva-mobile-dropdown"></a> <?php } ?>
			</div>			
			<!-- Header Widget Area -->
			<?php  if ( is_active_sidebar( 'heaer_widget_area' ) ) : dynamic_sidebar('heaer_widget_area');  endif; ?>	
		</div>
	<?php
	// Mobile menu
	atp_generator( 'atp_mobile_menu' );
	?>
	</div>
</header><!-- #header -->