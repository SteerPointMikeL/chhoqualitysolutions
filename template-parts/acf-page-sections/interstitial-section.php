<?php

if ( empty($appearance_modifiers) ) $appearance_modifiers = array();
if ( empty($additional_css_classes) ) $additional_css_classes = '';
if ( empty($content) ) $content = '';

?>
<section class="layout_block interstitial_section <?php echo esc_attr( implode( ' ', $appearance_modifiers ) ); ?> <?php echo esc_attr( $additional_css_classes ); ?>">
<?php if ( !empty($background_image) ) { ?>
	<?php echo wp_get_attachment_image( $background_image, 'full', null, array('class' => 'background') ); ?>
	
	<div class="overlay"></div>
<?php } ?>
	
	<div class="wrap">
		<?php get_template_part( 'template-parts/section_title', null, array( 'pre_title' => $pre_title, 'title' => $title) ); ?>
		
		<div class="content">
			<?php echo $content; ?>
		</div>
		
<?php if ( !empty($buttons) && is_array($buttons) && count($buttons) ) { ?>
		<p class="button_container">
<?php
foreach ( $buttons as $button ) {
	$alternate = !empty($alternate) ? '' : ' alternate';
	
	if ( $button['link_type'] == 'page_link' && !empty( $button['page_link'] ) ) {
		$href = $button['page_link'];
	} else if ( $button['link_type'] == 'url' && !empty( $button['url'] ) ) {
		$href = $button['url'];
	}
	
	if ( !empty($href) ) {
?>
			<a href="<?php echo esc_url( $href ); ?>" class="spm_button<?php echo $alternate; ?>"<?php if ( !empty( $button['link_target'] ) ) { ?> target="<?php echo esc_attr( $button['link_target'][0] ); ?>"<?php } ?>><?php echo !empty( $button['text'] ) ? $button['text'] : __( 'Learn More', SPM_TEXT_DOMAIN ); ?></a>
<?php
	}
};
?>
		</p>
<?php } ?>
	</div>
</section>
