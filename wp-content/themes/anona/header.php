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
<?php
	if(
		is_tag() ||
		is_search() ||
		is_404() ||
		is_home()
	){
		$frontpageid = '';
	} else{
		if ( class_exists('woocommerce') ) {
			if(is_shop()){
				$frontpageid = get_option ('woocommerce_shop_page_id');
			}elseif( is_cart(get_option('woocommerce_cart_page_id')) ){
				$frontpageid = get_option ('woocommerce_cart_page_id');
			}else{
				$frontpageid = $post->ID;
			}
		}else{
				$frontpageid = $post->ID;
			}
		}
?>
	<?php if ( get_post_meta( $frontpageid, 'page_bg_image', true ) ) { ?>
		<img id="pagebg" style="background-image:url(<?php echo get_post_meta( $frontpageid, 'page_bg_image', true ); ?>)" />
	<?php } ?>

	<div id="<?php echo (get_option( 'atp_layoutoption' )) ? get_option( 'atp_layoutoption' ) : 'stretched'; ?>" class="<?php echo atp_generator(
'sidebaroption', $frontpageid ); ?>">
	<div class="bodyoverlay"></div>
	<?php if( get_option( 'atp_stickybar' ) != "on" &&  get_option( 'atp_stickycontent' ) != '' ) { ?>
		<div id="trigger" class="tarrow"><i class="fa fa-arrow-circle-o-down fa-lg"></i></div>
		<div id="sticky"><?php echo  stripslashes( get_option( 'atp_stickycontent' ) ); ?></div>
	<?php } ?>

	<div id="wrapper">
		<?php
		// Switch Headers
		$headerstyle = get_option('atp_headerstyle','default');

		switch( $headerstyle ) {
			case 'headerstyle1':
				get_template_part('headers/header','style1');
				break;
			case 'headerstyle2':
				get_template_part('headers/header','style2');
				break;
			case 'headerstyle3':
				get_template_part('headers/header','style3');
				break;
			case 'fixedheader':
				get_template_part('headers/header','fixed');
				break;
			default:
				get_template_part('headers/header','default');
		}


		$pageslider = get_post_meta( $frontpageid, 'page_slider', true );

		if( is_front_page() || $pageslider != "" ) {

			// Get Slider based on the option selected in theme options panel
			if( get_option( 'atp_slidervisble') != "on" ) {
				if( $pageslider == "" ) {
					$chooseslider = get_option( 'atp_slider' );
				} else {
					$chooseslider = $pageslider;
				}
				switch ( $chooseslider ):
					case 'toggleslider':
										get_template_part( 'slider/toggle', 'slider' );
										break;
					case 'static_image':
										get_template_part( 'slider/static', 'slider' );
										break;
					case 'flexslider':
										get_template_part( 'slider/flex', 'slider' );
										break;
					case 'customslider':
										get_template_part( 'slider/custom', 'slider' );
										break;
				endswitch;
			}

		}
		else
		{
			if(get_query_var( 'eventDisplay' )){

			}else{
				if( ! is_404()  ) {
					echo atp_generator( 'subheader', $frontpageid );
				}
			}
		}
		?>
<div id="main" class="<?php echo atp_generator( 'sidebaroption', $frontpageid ); ?>">