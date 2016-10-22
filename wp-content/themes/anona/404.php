<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php if(get_option('atp_custom_favicon')) { ?>
	<link rel="shortcut icon" href="<?php echo get_option('atp_custom_favicon'); ?>" type="image/x-icon" /> 
<?php } ?>

<?php
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	wp_head();
?>
</head>

<body <?php body_class(); ?>>

<!-- 404 Page -->	
<div class="wrap404">				
	<div class="error_404">
		<i calss="fa fa-traffic-cone"></i>
		<h2><?php _e( '404', 'theme_front' ); ?></h2>
		<h5><?php _e( 'SORRY - PAGE NOT FOUND!', 'iva_theme_front' ); ?></h5>
		<p><?php _e( 'The page you are looking for was moved, removed, or does not exist.', 'iva_theme_front' ); ?></p>
 				<h6><a class="btn green small" href="<?php echo site_url(); ?>"><?php _e( 'Go To HomePage', 'iva_theme_front' ); ?></a></h6>
	</div>
</div>
</body>
</html>