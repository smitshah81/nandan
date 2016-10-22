<?php
/**
 * The template for displaying posts in the Image post format
 *
 * @package WordPress
 */

global $more, $iva_readmoretxt;
if ( !is_single() ) {
	$more = 0; 
}
?>
<?php
$postclass ='';
if ( is_single() ){
	$postclass = 'singlepost';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($postclass); ?>><?php 
	global $iva_readmoretxt;
	?>
	<header class="entry-header">
		<?php if (get_option('atp_postmeta') != "on" ){ ?>
		<div class="entry-meta">
			<?php iva_post_metadata(); ?>
		</div><!-- .entry-meta -->
		<?php } ?>
		<?php
		if ( is_single() ){
			the_title( '<h2 class="entry-title">', '</h2>' );
		}else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
		?>

	</header><!-- .entry-header -->

	<?php 
	if ( is_single() ){
		if( has_post_thumbnail() && get_option( 'atp_blogfeaturedimg' ) !='on' )  {  ?> 
			<div class="postimg">
				<?php echo '<figure>'.atp_resize( $post->ID, '', '870', '350', '', '' ).'</figure>'; ?>
			</div><?php
		}
	
	 }else{
		if( has_post_thumbnail() ){  ?>
			<div class="postimg">
				<?php echo '<figure>'.atp_resize( $post->ID, '', '870', '350', '', '' ).'</figure>'; ?>
			</div><?php
		}
	} ?>

	<div class="entry-content">
	<?php 
	if ( has_excerpt() && !is_single() ) {
		the_excerpt();
		echo '<a class="more-link" href="'.esc_url( get_permalink() ) .'">'. __("<span>Continue reading</span>","iva_theme_front") .'</a>';
	}else{
		the_content( __( '<span>Continue reading</span>', 'iva_theme_front' ) );
		
		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'iva_theme_front' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
		));
	} ?>
	<?php if ( is_single() ) { the_tags(); } ?>
	</div><!-- .entry-content -->
</article><!-- /post-<?php the_ID();?> -->