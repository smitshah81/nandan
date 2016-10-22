<?php
/* Header Mega Menu Style */
?>
<?php if (get_option('atp_topbar') != "on") { ?>
<div class="topbar">
	<div class="inner">
		<div class="one_half ">
			<?php echo do_shortcode( get_option( 'atp_top_lefttext' ) ); ?>
		</div><!-- /one_half -->
		<div class="one_half last">
		<?php echo do_shortcode(get_option('atp_top_righttext','[sociable]')); ?>		
		</div><!-- /one_half last -->
	</div><!-- /inner -->
</div><!-- /topbar -->
<?php } ?>
<header class="header-style1">
	<div class="header">
		<div class="header-area">
			<div class="logo">
				<?php atp_generator( 'logo' ); ?>
			</div><!-- /logo -->
			<div class="primarymenu menuwrap">
				<?php
				// Enable mega menu
				get_template_part( 'framework/includes/mega','menu' ); 
				?>
				<?php if (has_nav_menu( 'primary-menu' ) ) {  ?> <a href="#" class="iva-mobile-dropdown"></a> <?php } ?>
			</div>
		</div>
	<?php
	// Mobile menu
	atp_generator( 'atp_mobile_menu' );
	?>
	</div>
</header><!-- #header -->