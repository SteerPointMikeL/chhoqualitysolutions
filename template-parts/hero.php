<?php

global $h1_already_used;

$post_id = is_home() || is_archive() ? get_option('page_for_posts') : get_the_ID(); // use ID of page assigned to posts instead when appropriate

if ( get_field('hide_hero', $post_id) ) return;

if ( !empty( get_field('hero_type', $post_id) ) ) {
	$hero_type = get_field('hero_type', $post_id);
} else if ( is_home() || is_single() ) {
	$hero_type = 'two_column';
} else {
	$hero_type = 'standard';
}

if ( is_post_type_archive() || is_tax() || ( is_singular() && !is_singular( array('page', 'post') ) ) ) {
	$obj = get_post_type_object( get_post_type() );
	$hero_title = $obj->labels->name;
	if ( is_tax() ) $hero_title .= '&mdash' . single_term_title( null, false );
} else if ( is_category() ) {
	$hero_title = single_cat_title( null, false );
} else if ( is_search() ) {
	$hero_title = __( 'Search Results', SPM_TEXT_DOMAIN );
} else if ( is_404() ) {
	$hero_title = __('Page Not Found', SPM_TEXT_DOMAIN );
} else if ( is_singular('post') && get_field('alternate_title') ) { 
	$hero_title = get_field('alternate_title');
} else {
	$hero_title = get_field('alternate_title', $post_id) ? get_field('alternate_title', $post_id) : get_the_title($post_id);
}

$hero_type_template_mappings = array(
	'standard'   => 'template-parts/hero-standard',
	'plain'      => 'template-parts/hero-plain',
	'two_column' => 'template-parts/hero-two_column',
);

if ( array_key_exists($hero_type, $hero_type_template_mappings) ) {
	$h1_already_used = true;
	
	get_template_part( $hero_type_template_mappings[ $hero_type ], null, array('post_id' => $post_id, 'hero_title' => $hero_title) );
}