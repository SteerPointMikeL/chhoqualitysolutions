<?php

function spm_load_acf_page_sections($modules) {
	if ( empty($modules) ) return false;
	
	$layouts = array(
		'content_editor' => array(
			'file' => 'content',
			'fields' => array(
				'appearance_modifiers',
				'additional_css_classes',
				'pre_title',
				'title',
				'content',
			),
		),
		'content_with_image' => array(	
			'file' => 'content-with-image',
			'fields' => array(
				'appearance_modifiers',
				'additional_css_classes',
				'column_space_distribution',
				'pre_title',
				'title',
				'image_position',
				'image',
				'content',
			),
		),
		'content_with_background_flourish' => array(	
			'file' => 'content-with-background-flourish',
			'fields' => array(
				'appearance_modifiers',
				'additional_css_classes',
				'column_space_distribution',
				'pre_title',
				'title',
				'background_position',
				'background_type',
				'content',
			),
		),
		'multi_column' => array(
			'file' => 'multi-column',
			'fields' => array(
				'appearance_modifiers',
				'additional_css_classes',
				'image_lightbox_support',
				'pre_title',
				'title',
				'intro_text',
				'columns_per_row',
				'columns',
			),
		),
		'multi_column_with_staff_card' => array(
			'file' => 'multi-column-with-staff-card',
			'fields' => array(
				'appearance_modifiers',
				'additional_css_classes',
				'image_lightbox_support',
				'pre_title',
				'title',
				'intro_text',
				'columns_per_row',
				'display_numbers',
				'columns',
				'staff_card',
			),
		),
		'video_carousel' => array(
			'file' => 'video-carousel',
			'fields' => array(
				'appearance_modifiers',
				'additional_css_classes',
				'image_lightbox_support',
				'pre_title',
				'title',
				'carousel_items',
			),
		),
		'calls_to_action' => array(
			'file' => 'calls-to-action',
			'fields' => array(
				'appearance_modifiers',
				'additional_css_classes',
				'pre_title',
				'title',
				'intro_text',
				'columns_per_row',
				'columns',
			),
		),
		'testimonials' => array(
			'file' => 'testimonials',
			'fields' => array(
				'appearance_modifiers',
				'additional_css_classes',
				'pre_title',
				'title',
				'intro_text',
			),
		),
		'logo_carousel' => array(
			'file' => 'logo-carousel',
			'fields' => array(
				'appearance_modifiers',
				'additional_css_classes',
			),
		),
		'faqs' => array(
			'file' => 'faqs',
			'fields' => array(
				'appearance_modifiers',
				'additional_css_classes',
				'pre_title',
				'title',
				'faqs',
			),
		),
		'contact_form' => array(
			'file' => 'contact-form',
			'fields' => array(
				'appearance_modifiers',
				'additional_css_classes',
				'pre_title',
				'title',
				'intro_text',
				'contact_information',
				'gravityforms_form_id',
				'show_title',
				'show_description',
			),
		),
		'contact_form_alternate' => array(
			'file' => 'contact-form-alternate',
			'fields' => array(
				'appearance_modifiers',
				'additional_css_classes',
				'pre_title',
				'title',
				'intro_text',
				'contact_information',
				'gravityforms_form_id',
				'show_title',
				'show_description',
			),
		),
	);
	
	foreach ( $modules as $module ) {
		$args = array();
		
		if ( !array_key_exists( $module['acf_fc_layout'], $layouts ) ) continue;
		
		foreach ( $module as $field_name => $field_value ) {
			if ( !in_array($field_name, $layouts[$module['acf_fc_layout']]['fields'] ) ) continue;
			
			$args[$field_name] = $module[$field_name];
		}
		
		spm_render_acf_page_section( $layouts[$module['acf_fc_layout']]['file'], $args );
	}
}


function spm_render_acf_page_section( $file, $args = array() ) {
	// prepare variables for use in template
	extract($args);
	
	// find and load template
	$template_location = 'template-parts/acf-page-sections/' . $file . '.php';
	if ( locate_template($template_location) ) {
		require( get_template_directory() . '/' . $template_location );
	} else if ( WP_DEBUG ) {
		error_log('Layout module not found.');
	}
}


// Enable Abilities API
add_filter( 'acf/settings/enable_acf_ai', '__return_true' );


// Process shortcodes inside ACF fields
function spm_acf_format_value( $value ) {
	return do_shortcode( $value );
}
add_filter( 'acf/format_value/type=text', 'spm_acf_format_value', 9999 );
add_filter( 'acf/format_value/type=textarea', 'spm_acf_format_value', 9999 );


// Populate ACF FAQs Category dropdown fields with categories from FAQs Options page
/* add_filter('acf/load_field/name=faqs_category', function( $field ) {
	// clear them out
	$field['choices'] = array();
	
	$faqs_categories = get_field('faqs_categories', 'option');
	
	if ( empty($faqs_categories) ) return $field;
	
	foreach ( $faqs_categories as $faqs_category ) {
		if ( empty($faqs_category['name'] ) ) continue;
		
		$field['choices'][$faqs_category['name']] = $faqs_category['name'];
	}
	
	return $field;
} ); */


// Populate ACF contact form dropdown fields with Gravity Forms forms
add_filter('acf/load_field/name=gravityforms_form_id', function($field) {
	// clear them out
	$field['choices'] = array();
	
	// bail
	if ( !is_plugin_active('gravityforms/gravityforms.php') || !class_exists('GFAPI') ) {  
		return $field;
	}
	
	$forms = GFAPI::get_forms();
	
	// probably redundant
	if ( empty($forms) ) {
		return $field;
	}
	
	foreach ( $forms as $form ) {
		$choices[$form['id']] = $form['title'];
	}
	
	ksort($choices);
	
	foreach ( $choices as $key => $choice ) {
		$field['choices'][$key] = $choice;
	}
	
	return $field;
} );