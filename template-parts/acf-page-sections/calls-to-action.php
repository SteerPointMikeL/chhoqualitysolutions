<?php

if ( empty($columns) ) return false;

if ( empty($appearance_modifiers) ) $appearance_modifiers = array();
if ( empty($additional_css_classes) ) $additional_css_classes = '';
if ( empty($columns_per_row) ) $columns_per_row = '3';

?>
<section class="layout_block calls_to_action <?php echo esc_attr( implode( ' ', $appearance_modifiers ) ); ?> <?php echo esc_attr( $additional_css_classes ); ?>">
	<div class="wrap">
		<?php get_template_part( 'template-parts/section_title', null, array( 'pre_title' => $pre_title, 'title' => $title) ); ?>
		
<?php if ( !empty($intro_text) ) { ?>
		<div class="intro_text">
			<?php echo $intro_text; ?>	
		</div>
<?php } ?>
		
		<div class="columns columns-<?php echo $columns_per_row; ?> columns-top_level">
<?php foreach ( $columns as $column ) : ?>
			<div class="column">
				<div class="title_container">
<?php if ( !empty( $column['icon_css_class'] ) ) { ?>
					<i class="icon-<?php echo esc_attr( $column['icon_css_class'] ); ?>"></i>
<?php } ?>
					
<?php if ( !empty( $column['title'] ) ) { ?>
					<p class="title"><?php echo $column['title']; ?></p>
<?php } ?>
				</div>
				
				<div class="content">
					
					<?php if ( !empty( $column['content'] ) ) echo $column['content']; ?>
					
				</div>
				
<?php
$href = '';
if ( !empty( $column['button_link_type'] ) ) {
	if ( $column['button_link_type'] === 'page_link' && !empty( $column['button_page_link'] ) ) {
		$href = $column['button_page_link'];
	} else if ( $column['button_link_type'] === 'url' && !empty( $column['button_url'] ) ) {
		$href = $column['button_url'];
	}
}
if ( !empty($href) ) {
?>
				<p class="button_container">
					<a href="<?php echo esc_url( $href ); ?>" class="spm_button"><?php echo !empty( $column['button_text'] ) ? $column['button_text'] : __( 'Learn More', SPM_TEXT_DOMAIN ); ?></a>
				</p>
<?php } ?>
			</div>
<?php endforeach; ?>
		</div>
	</div>
</section>
