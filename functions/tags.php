<?php

/* function spm_the_excerpt_shorter() {
	add_filter( 'excerpt_length', 'spm_excerpt_length_shorter' );
	the_excerpt();
	remove_filter( 'excerpt_length', 'spm_excerpt_length_shorter' );
} */


function spm_get_the_excerpt_force_trim( $id = null ) {
	//$excerpt_length = (int) _x( '55', 'excerpt_length' );
	$excerpt_length = (int) _x( '15', 'excerpt_length' );
	$excerpt_length = apply_filters( 'excerpt_length', $excerpt_length );
	$excerpt_more = apply_filters( 'excerpt_more', ' ' . '[&hellip;]' );
	
	$text = wp_trim_words( get_the_excerpt( $id ), $excerpt_length, $excerpt_more );
	
	return $text;
}


function spm_pagination($before = '', $after = '') {
	global $wp_query;
	
	if ( is_single() ) return;
	
	$total_pages =& $wp_query->max_num_pages;
	
	$current_page = (int) get_query_var('paged');
	if ( empty($current_page) || $current_page == 0 ) {
		$current_page = 1;
	}
	
	$start_page = max( $current_page - 5, 1 ); // Up to 5 pages back, but not beyond page 1
	$end_page = min( $current_page + 5, $total_pages ); // Up to 5 pages ahead, but not beyond the last page in the query
	
	//$displayed_range =& $end_page - $start_page;
	
	if ($total_pages <= 1) { return; }
	
	echo $before."\n";
?>
<ul>
<?php
	// first page link
	/* if ( $start_page >= 2 && $displayed_range < $total_pages ) {
?>
	<li><a href="<?php echo get_pagenum_link(); ?>"><i class="icon-arrow-left"></i> <?php _e('First', SPM_TEXT_DOMAIN); ?></a></li>
<?php
	} */
	
	// previous page link
	if ( $current_page >= 2 ) {
?>
	<li aria-label="<?php _e( 'Previous', SPM_TEXT_DOMAIN ); ?>"><?php previous_posts_link( '<i class="icon-double-arrow-left"></i>' ); ?></li>
<?php
	}
	
	// Numbered links loop
	for ( $i = $start_page; $i <= $end_page; $i++ ) {
		if ( $i == $current_page ) {
?>
	<li><span><?php echo $i; ?></span></li>
<?php
		} else {
?>
	<li><a href="<?php echo get_pagenum_link($i); ?>"><?php echo $i; ?></a></li>
<?php
		}
	}
	
	// next page link
	if ( $current_page < $total_pages ) {
?>
	<li aria-label="<?php _e( 'Next', SPM_TEXT_DOMAIN ); ?>"><?php next_posts_link( '<i class="icon-double-arrow-right"></i>' ); ?></li>
<?php
	}

	// last page link
	/* if ($end_page < $total_pages) {
?>
	<li><a href="<?php echo get_pagenum_link( $total_pages ); ?>"><?php _e( 'Last', SPM_TEXT_DOMAIN ); ?> <i class="icon-arrow-right"></i></a></li>
<?php
	} */
?>
</ul>

<?php //printf( __( 'Page %1$d of %2$d', SPM_TEXT_DOMAIN ), $current_page, $total_pages ); ?>
<?php
	echo $after."\n";
}