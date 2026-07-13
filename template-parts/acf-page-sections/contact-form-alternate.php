<?php

if ( empty($appearance_modifiers) ) $appearance_modifiers = array();
if ( empty($additional_css_classes) ) $additional_css_classes = '';

if ( empty($show_title) ) {
	$show_title = 'false';
} else if ( is_array($show_title) ) {
	$show_title = $show_title[0];
}

if ( empty($show_description) ) {
	$show_description = 'false';
} else if ( is_array($show_description) ) {
	$show_description = $show_description[0];
}

?>
<section class="layout_block contact_form_alternate <?php echo esc_attr( implode( ' ', $appearance_modifiers ) ); ?> <?php echo esc_attr( $additional_css_classes ); ?>">
	<div class="wrap">
		<div class="columns columns-2 columns-top_level">
			<div class="column column-content">
				<?php get_template_part( 'template-parts/section_title', null, array( 'pre_title' => $pre_title, 'title' => $title) ); ?>
				
<?php if ( !empty($intro_text) ) { ?>
				<div class="intro_text">
					<?php echo $intro_text; ?>
				</div>
<?php } ?>
				
<?php if ( !empty($contact_information) && is_array($contact_information) && count($contact_information) ) { ?>
				<ul class="contact_information">
<?php foreach ( $contact_information as $item ) { ?>
					<li>
<?php if ( !empty( $item['icon_css_class'] ) ) { ?>
						<i class="icon-<?php echo esc_attr( $item['icon_css_class'] ); ?>"></i>
<?php } ?>
						
						<div class="layer_2">
<?php if ( !empty( $item['title'] ) ) { ?>
							<p class="title"><?php echo $item['title']; ?></p>
<?php } ?>
							
							<?php if ( !empty( $item['content'] ) ) echo $item['content']; ?>
						</div>
					</li>
<?php } ?>
				</ul>
<?php } ?>
			</div>
			
			<div class="column column-form">
				<div class="form_container"><div class="layer_2">
					<p class="title">Contact CH House of Quality Solutions & Consulting</p>
					
<?php if ( !empty($gravityforms_form_id) ) { ?>
					<?php echo do_shortcode('[gravityforms id="' . $gravityforms_form_id . '" title="' . $show_title . '" description="' . $show_description . '" ajax=true]'); ?>
<?php } ?>
				</div></div>
			</div>
		</div>
	</div>
</section>
