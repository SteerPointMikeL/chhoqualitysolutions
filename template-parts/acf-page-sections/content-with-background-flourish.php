<?php

if ( empty($appearance_modifiers) ) $appearance_modifiers = array();
if ( empty($additional_css_classes) ) $additional_css_classes = '';
if ( empty($column_space_distribution) ) $column_space_distribution = '';
if ( empty($background_type) ) $background_type = 'type_1';
if ( empty($background_position) ) $background_position = 'right';
if ( empty($content) ) $content = '';

?>
<section class="layout_block content_with_background_flourish <?php echo esc_attr( $background_type ); ?> background_position-<?php echo esc_attr( $background_position ); ?> <?php echo esc_attr( implode( ' ', $appearance_modifiers ) ); ?> <?php echo esc_attr( $additional_css_classes ); ?> <?php echo esc_attr( $column_space_distribution ); ?>">
	<div class="wrap"><div class="layer_2">
		<div class="background"></div>
		
		<div class="overlay"></div>
		
		<div class="content_container"><div class="layer_2">
				<?php get_template_part( 'template-parts/section_title', null, array( 'pre_title' => $pre_title, 'title' => $title) ); ?>
				
				<?php echo $content; ?>
				
		</div></div>
	</div></div>
</section>
