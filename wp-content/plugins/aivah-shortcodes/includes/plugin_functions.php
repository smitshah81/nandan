<?php
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 *
 */

if ( ! function_exists( 'iva_sc_post_metadata' ) ) {
	/**
	 * Print HTML with meta information for the current post-date/time and author.
	 */
	function iva_sc_post_metadata() {

		if ( is_sticky() && is_home() && ! is_paged() ) {
			echo '<span class="iva-pm-featured featured-post">' . __( 'Sticky', 'aivah_shortcodes' ) . '</span>';
		}
		// Set up and print post meta information.
		echo '<span class="iva-pm-byauthor"><a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'. get_the_author().'</a></span>';
		if(get_the_category_list() ){
			echo '<span class="iva-pm-postin">'. get_the_category_list( ', ', '', '') .'</span>';
		}
		echo '<span class="iva-pm-postin">'. get_the_date() .'</span>';
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ){
			echo '<span class="iva-pm-comments">';
			comments_popup_link( __( '0 Comment', 'aivah_shortcodes' ), __( '1 Comment', 'aivah_shortcodes' ), __( '% Comments', 'aivah_shortcodes' ) );
			echo '</span>';
		}
		echo '<span class="meta-likes">'.iva_love('iva_like') .'</span>';
	}
}

if ( ! function_exists( 'iva_sc_pagination' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since hopes 1.0
 */
function iva_sc_pagination() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Previous', 'aivah_shortcodes' ),
		'next_text' => __( 'Next &rarr;', 'aivah_shortcodes' ),
	) );

	if ( $links ) {

		$out ='<nav class="navigation paging-navigation" role="navigation">';
		$out .='<div class="pagination loop-pagination">';
		$out .=$links;
		$out .='</div>';
		$out .='</nav>';
	}
	return $out; 
}
endif;