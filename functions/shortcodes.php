<?php

// Add shortcode support to text widgets
add_filter('widget_text', 'do_shortcode');


function spm_shortcode_list_child_pages() {
	global $post;
	
	return wp_list_pages( array('child_of' => $post->ID, 'title_li' => false) );
}
add_shortcode('list-child-pages', 'spm_shortcode_list_child_pages');


function spm_shortcode_testimonials_carousel($atts) {
	ob_start();
	
	$atts = shortcode_atts( array(
		'title'         => null,
		'intro_text'    => null,
		'visible_items' => 3,
		'nav'           => 'false',
	), $atts, 'testimonials_carousel' );
	
	if ( !empty( $atts['intro_text'] ) ) $atts['intro_text'] = apply_filters( 'the_content', $atts['intro_text'] );
	
	get_template_part( 'layout-modules/testimonials-carousel', null, array(
		'title'         => $atts['title'],
		'intro_text'    => $atts['intro_text'],
		'visible_items' => $atts['visible_items'],
		'nav'           => $atts['nav'],
	) );
	
	return ob_get_clean();
}
add_shortcode('testimonials_carousel', 'spm_shortcode_testimonials_carousel');