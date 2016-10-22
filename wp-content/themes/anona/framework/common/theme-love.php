<?php
class IvaLove {
	
	function __construct()   
	{
		// Enqueues the scripts.	
        add_action('wp_enqueue_scripts', array(&$this, 'enqueue_scripts'));

        //Handle the request
        add_action('wp_ajax_iva-love', array(&$this, 'ajax'));

        //Executes for users that are not logged in. 
		add_action('wp_ajax_nopriv_iva-love', array(&$this, 'ajax'));
	}

	/**
	 * function enqueue_scripts()
	 *
	 * enqueues the scripts.
	 * @uses wp_enqueue_script()
	 */
	
	function enqueue_scripts() 
	{
		
		wp_enqueue_script( 'iva-love', get_template_directory_uri() . '/js/theme-love.js', 'jquery', '1.0', TRUE );

		// In javascript, object properties are accessed as ajax_object.ajax_url
		wp_localize_script( 'iva-love', 'ivaLove', array(
			'ajaxurl' => admin_url('admin-ajax.php')
		));
	}
	/**
	 *
	 * Handle request then generate response using WP_Ajax_Response
	 *
	 */
	function ajax($post_id) 
	{
		
		// Update
		if( isset($_POST['loves_id']) ) {
			$post_id = str_replace('iva-love-', '', $_POST['loves_id']);
			echo $this->love_post($post_id, 'update');
		} 
		
		// Get
		else {
			$post_id = str_replace('iva-love-', '', $_POST['loves_id']);
			echo $this->love_post($post_id, 'get');
		}
		
		exit;
	}
	
	
	function love_post($post_id, $action = 'get') 
	{
		if ( !is_numeric( $post_id ) ) return;
	
		switch($action) {
		
			case 'get':
				$love_count = get_post_meta($post_id, '_iva_love', true);
				if( !$love_count ){
					$love_count = 0;
					add_post_meta($post_id, '_iva_love', $love_count, true);
				}
				
				return '<span class="iva-love-count">'. $love_count .'</span>';
				break;
				
			case 'update':
				$love_count = get_post_meta($post_id, '_iva_love', true);
				if( isset($_COOKIE['iva_love_'. $post_id]) ) return $love_count;
				
				$love_count++;
				update_post_meta($post_id, '_iva_love', $love_count);
				setcookie('iva_love_'. $post_id, $post_id, time()*20, '/');
				
				return '<span class="iva-love-count">'. $love_count .'</span>';
				break;
		
		}
	}


	function add_love() 
	{
		global $post;

		$output = $this->love_post($post->ID);
  
  		$class = 'iva-love';
  		$title = __('Like this','iva_theme_front');
		if( isset($_COOKIE['iva_love_'. $post->ID]) ){
			$class = 'iva-love loved';
			$title = __('You already like this!','iva_theme_front');
		}
		
		return '<a href="#" class="'. $class .'" id="iva-love-'. $post->ID .'" title="'. $title .'">'. $output .' '. __('Likes', 'iva_theme_front').'</a>';
	}
	
}


global $iva_love;
$iva_love = new IvaLove();

// get the ball rollin' 
function iva_love($iva_like = '') 
{
	
	global $iva_love;
	if($iva_like == 'iva_like') {
		return $iva_love->add_love(); 
	} else {
		echo $iva_love->add_love(); 
	}
}
?>