<?php 

//Prevent WooCommerce 2.0 Theme Support Warning
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

//Register custom styles
if( !is_admin() ){
	add_action('wp_enqueue_scripts', 'atp_woocommerce_register_assets');
}

if( !function_exists('atp_woocommerce_register_assets')){
	function atp_woocommerce_register_assets() {
	
		//wp_enqueue_style( 'atp-wc-ppcss', get_template_directory_uri().'/woocommerce/css/prettyPhoto.css');
		wp_enqueue_script( 'atp-wc-customselect-js', get_template_directory_uri().'/woocommerce/js/jquery.customSelect.js', array('jquery'), 1, true );
		wp_enqueue_script( 'atp-wc-custom-js', get_template_directory_uri().'/woocommerce/js/custom.js', array('jquery'), 1, true );
			wp_enqueue_style( 'iva-wc-css', get_template_directory_uri().'/woocommerce/css/woocommerce.css');
	}
}

require_once('minicartbag.php');

// Remove default ratings
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

// Remove product thumbnail
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

// Remove Page Title
if( !function_exists('override_page_title')){
	function override_page_title() {
		return false;
	}
	add_filter('woocommerce_show_page_title', 'override_page_title');
}

// Define image sizes
global $pagenow;

if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ){ 
	add_action( 'init', 'atp_woocommerce_image_dimensions', 1 );
}

function atp_woocommerce_image_dimensions() {
  	$catalog = array(
		'width' 	=> '350',	// px
		'height'	=> '350',	// px
		'crop'		=> 1 		// true
	);
 
	$single = array(
		'width' 	=> '600',	// px
		'height'	=> '650',	// px
		'crop'		=> 1 		// true
	);
 
	$thumbnail = array(
		'width' 	=> '150',	// px
		'height'	=> '150',	// px
		'crop'		=> 0 		// false
	);
 
	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

// Loop Product Thumbnail function
add_action( 'woocommerce_before_shop_loop_item_title', 'atp_loop_product_thumbnail', 10);
function atp_loop_product_thumbnail(){

	global $product;	

	$id 			 = get_the_ID();	
	$rating_html 	 = $product->get_rating_html();
	$shop_catelog 	 = get_option( 'shop_catalog_image_size') ;
	$product_gallery = get_post_meta( $id, '_product_image_gallery', true );
	
	$out  = '<div class="product_wrapper">';
	if (!empty( $product_gallery)) {

		$product_gallery     =  explode(',',$product_gallery);
		$hover_image_id      =  $product_gallery[0];
		$img_src_hover_array =  wp_get_attachment_image_src($hover_image_id, 'full', true );

		if (!empty( $img_src_hover_array[0] )) {
			$out .= '<div class="hoverimg">';
			$out .= '<a href="'.get_permalink().'">';
			$out .=  atp_resize( $id,'',$shop_catelog ['width'] ,$shop_catelog ['height'], 'hoveroutclass', '');	
			$out .=  atp_resize( $id,$img_src_hover_array[0],$shop_catelog ['width'] ,$shop_catelog ['height'], 'hoverinclass', '');	
			$out .= '</a>';
			$out .= '</div>';
		}
	} else {
		$out .= '<a href="'.get_permalink().'">';		
		$out .=  atp_resize( $id,'',$shop_catelog ['width'] ,$shop_catelog ['height'], '', '');	
		$out .= '</a>';
	}

	$out .= '</div>';
	$out .= atp_loop_product_info();
	
	echo $out;
}

// Remove Add to Cart Button,price
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
// Loop Product Info
function atp_loop_product_info() {
	global $product;
	
	switch ( $product->product_type ) {
		case 'simple':
			$iconclass = 'fa-shopping-cart';
			break;
		case 'variable':
			$iconclass = 'fa-angle-double-down';
			break;
		case 'grouped':
			$iconclass = 'fa-shopping-cart';
			break;
		case 'external':
			$iconclass = 'fa-shopping-cart';
			break;
		default :
			$iconclass = 'fa-shopping-cart';
	}
	
	$rating_html = $product->get_rating_html();

	$out ='<div class="product_shopinfo">';
	$out .='<div class="ps_inner">';
	$out .='<h3><a href="'.get_permalink().'">'. get_the_title().'</a></h3>';
	$class='';
	if( !empty( $rating_html ) ) $out .= $rating_html;
	if($product->is_purchasable()) {
		$class .= 'add_to_cart_button';
	}

	if ( $price_html = $product->get_price_html() ) {  $out .= $price_html; }
	
	$out .= '</div>';
	
	$out .='<div class="product_buttons">';
	$out .= '<a href="'.get_permalink().'" class="button wc-forward">'.__( 'View Details', 'iva_theme_front' ).'</a>';
	$out .= apply_filters( 
			'woocommerce_loop_add_to_cart_link',
			sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">%s</a>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( $product->id ),
				esc_attr( $product->get_sku() ),
				$class,
				esc_attr( $product->product_type ),
				esc_html( $product->add_to_cart_text()). '  <i class="fa '.$iconclass.' fa-fw"></i>'
			),
			$product 
	);
	$out .= '</div>';
	$out .= '</div>';
	return $out;
}

// Products Single Page Customization
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_before_single_product_summary', 'atpwoocommerce_show_product_images', 20 );

function atpwoocommerce_show_product_images(){

	global $post, $woocommerce, $product;

	echo '<div class="images">';
	if ( has_post_thumbnail() ) {

		$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
		$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
		$shop_single 		= get_option( 'shop_single_image_size') ;
		$image 				= atp_resize( $post->ID,'',$shop_single['width'],$shop_single['height'],'',$image_title);
		$attachment_count   	= count( $product->get_gallery_attachment_ids() );

		if ( $attachment_count > 0 ) {
			$gallery = '[product-gallery]';
		} else {
			$gallery = '';
		}

	   echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s"  data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_title, $image ), $post->ID );

	} else {
	   echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="" />', woocommerce_placeholder_img_src() ), $post->ID );
	}
	do_action( 'woocommerce_product_thumbnails' ); 
	echo '</div>';	 
}

//Remove Product Thumnails
remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

//Customization Product Thumnails
add_action( 'woocommerce_product_thumbnails', 'atp_product_thumbnails', 20 );

function atp_product_thumbnails(){
	$shop_thumbnail = get_option( 'shop_thumbnail_image_size') ;

	global $post, $product, $woocommerce;
	$attachment_ids = $product->get_gallery_attachment_ids();

	if ( $attachment_ids ) {

		echo '<div class="thumbnails">';
		$loop = 0;
		$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
		foreach ( $attachment_ids as $attachment_id ) {
			$classes = array( 'zoom' );
			if ( $loop == 0 || $loop % $columns == 0 )
				$classes[] = 'first';
			if ( ( $loop + 1 ) % $columns == 0 )
				$classes[] = 'last';

			$image_link = wp_get_attachment_url( $attachment_id );

			if ( ! $image_link )
				continue;
			$image 		 = atp_resize('', $image_link,$shop_thumbnail['width'],$shop_thumbnail['height'],'');
			$image_class = esc_attr( implode( ' ', $classes ) );
			$image_title = esc_attr( get_the_title( $attachment_id ) );

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s" data-rel="prettyPhoto[product-gallery]">%s</a>', $image_link, $image_class, $image_title, $image ), $attachment_id, $post->ID, $image_class );

			$loop++;
		}
		echo '</div>';
	}	
}
	
// Woocommerce Shop Navigation 
function atp_shopnav($echo = true){
	if ( class_exists('woocommerce') ) {
	
		global $woocommerce;
		
		$myaccount_page_id 	= get_option( 'woocommerce_myaccount_page_id' );
		if ( $myaccount_page_id ) {
			$myaccount_page_url = get_permalink( $myaccount_page_id );
			$logout_url 		= wp_logout_url( get_permalink( $myaccount_page_id ) );
			if ( get_option( 'woocommerce_force_ssl_checkout' ) == 'yes' ){
				$logout_url = str_replace( 'http:', 'https:', $logout_url );
			}
		}
		
		$output = '';
		$cart_url		= $woocommerce->cart->get_cart_url();
		$checkout_url 	= $woocommerce->cart->get_checkout_url();
		$shop_page_url 	= get_permalink( woocommerce_get_page_id( 'shop' ) );
		
		$output .= '<div class="atp_sub_nav"><ul>';
		if( is_user_logged_in() ){ 
			$output .= '<li><i class="fa fa-user fa-fw"></i> <a href="'.$myaccount_page_url.'">Myaccount</a></li>';
			$output .= '<li><i class="fa fa-suitcase fa-fw"></i> <a href="'.$shop_page_url.'">Shop</a></li>';
			$output .= '<li><i class="fa fa-shopping-cart fa-fw"></i> <a href="'.$cart_url.'">Cart</a></li>';
			$output .= '<li><i class="fa fa-credit-card fa-fw"></i> <a href="'.$checkout_url.'">Checkout</a></li>';
			$output .= '<li><i class="fa fa-sign-out fa-fw"></i> <a href="'.$logout_url.'">Logout</a></li>';
		}else{ 
			$output .= '<li><a href="'.$myaccount_page_url.'">Login / Register</a></li>';
		} 
		$output .= '</ul></div>';
	}
	if ( $echo ){
		echo $output;
	}else{ 
		return $output;
	}
}

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;	
	
	ob_start();	?>
	<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'iva_theme_front'); ?>">
	<div class="icnWrap">
		<span class="cartIcon"></span>
		<span class="cartnumbers"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'iva_theme_front'), $woocommerce->cart->cart_contents_count);?></span>
	</div>
	</a>
	<?php	
	$fragments['a.cart-contents'] = ob_get_clean();	
	return $fragments;	
}

function iva_minicart(){ 
global $woocommerce;
?>

<div class="minicart-wrap">

	<ul class="mini-cart">
	<?php
	if ( is_cart() ) {
		$class = "current-menu-item";
	} else {
		$class = "";
	}
	
	?>
	<li>
		<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart', 'iva_theme_front' ); ?>">
	<div class="icnWrap">
		<span class="cartIcon"></span>
		<span class="cartnumbers"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'iva_theme_front'), $woocommerce->cart->cart_contents_count);?></span>
	</div>
		</a>
	</li>
		<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
	</ul>

</div>
<?php
}
?>