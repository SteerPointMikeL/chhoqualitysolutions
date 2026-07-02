<?php

// Enqueue specific scripts as type="module" instead
function script_loader_tag_type_module_attribute($tag, $handle, $src) {
	if ( $handle === 'lite-vimeo' ) {
		$tag = sprintf( "<script type='module' src='%s' id='%s-js'></script>\n", $src, esc_attr( $handle ) );
	}
	
	return $tag;
}
add_filter('script_loader_tag', 'script_loader_tag_type_module_attribute' , 10, 3);


/* function spm_excerpt_length() {
	return 55;
}
add_filter( 'excerpt_length', 'spm_excerpt_length' ); */


function spm_excerpt_length_shorter() {
	return 20;
}


// Enable lazy loading by default for certain programatically loaded images (needed for non-Gutenberg templates in WordPress 6.3 or later)
function spm_get_image_optimization_attributes_enable_lazy_loading_for_templates( $loading_attrs, $tag_name, $attr, $context ) {
	if ( in_array( $context, array('the_post_thumbnail', 'wp_get_attachment_image') ) && ( !array_key_exists( 'loading', $attr ) || $attr['loading'] === null ) ) {
		$loading_attrs['loading'] = 'lazy';
	}
	
	return $loading_attrs;
}
add_filter( 'wp_get_loading_optimization_attributes', 'spm_get_image_optimization_attributes_enable_lazy_loading_for_templates', 10, 4 );


// Exclude pages from search results
function spm_register_post_type_args_exclude_pages( $args, $post_type ) {
	if ( $post_type == 'page' ) $args['exclude_from_search'] = true;
	
	return $args;
}
add_filter( 'register_post_type_args', 'spm_register_post_type_args_exclude_pages', 10, 2 );


function spm_excerpt_more() {
	return '...';
}
add_filter( 'excerpt_more', 'spm_excerpt_more' );


// Disable WordPress gallery inline CSS
add_filter( 'use_default_gallery_style', '__return_false' );


// Scroll page to Gravity Forms confirmation text after submitting form
add_filter( 'gform_confirmation_anchor', '__return_true' );