<?php

if ( empty($columns) ) return false;

if ( empty($appearance_modifiers) ) $appearance_modifiers = array();
if ( empty($additional_css_classes) ) $additional_css_classes = '';
if ( empty($columns_per_row) ) $columns_per_row = '2';

?>
<section class="layout_block multi_column_with_staff_card <?php echo esc_attr( implode( ' ', $appearance_modifiers ) ); ?> <?php echo esc_attr( $additional_css_classes ); ?>">
	<div class="wrap">
		<?php get_template_part( 'template-parts/section_title', null, array( 'pre_title' => $pre_title, 'title' => $title) ); ?>
		
<?php if ( !empty($intro_text) ) { ?>
		<div class="intro_text">
			<?php echo $intro_text; ?>	
		</div>
<?php } ?>
		
		<div class="columns columns-<?php echo $columns_per_row; ?> columns-top_level">
<?php $i = 1; foreach ( $columns as $column ) : ?>
			<div class="column">
<?php if ( !empty($display_numbers) ) { ?>
				<p class="number"><?php printf( '%02d', $i ); ?></p>
<?php } ?>
				
<?php if ( !empty( $column['title'] ) ) { ?>
				<p class="title"><?php echo $column['title']; ?></p>
<?php } ?>
				
<?php if ( !empty( $column['content'] ) ) { ?>
				<div class="content">
					
					<?php echo $column['content']; ?>
					
				</div>
<?php } ?>
			</div>
<?php $i++; endforeach; ?>
		</div>
		
<?php if ( !empty($staff_card) ) { ?>
		<div class="staff_card">
<?php if ( !empty( $staff_card['image'] ) ) { ?>
			<div class="image_container">
				<?php echo wp_get_attachment_image( $staff_card['image'], 'medium_large', null, array('class' => 'image') ); ?>
			</div>
<?php } ?>
			
			<div class="content">
<?php if ( !empty( $staff_card['title'] ) ) { ?>
				<p class="title"><?php echo $staff_card['title']; ?></p>
<?php } ?>
				
<?php if ( !empty( $staff_card['secondary_title'] ) ) { ?>
				<p class="secondary_title"><?php echo $staff_card['secondary_title']; ?></p>
<?php } ?>
				
<?php if ( !empty( $staff_card['content'] ) ) echo $staff_card['content']; ?>
				
<?php
if ( !empty( $staff_card['buttons'] ) ) {
	$alternate = '';
?>
				<p class="button_container">
<?php
foreach ( $staff_card['buttons'] as $button ) {
	$href = '';
	if ( !empty( $button['link_type'] ) ) {
		if ( $button['link_type'] === 'page_link' && !empty( $button['page_link'] ) ) {
			$href = $button['page_link'];
		} else if ( $button['link_type'] === 'url' && !empty( $button['url'] ) ) {
			$href = $button['url'];
		}
	}

	if ( !empty($href) ) {
?>
					<a href="<?php echo esc_url( $href ); ?>" class="spm_button<?php echo $alternate; ?>"><?php echo !empty( $button['button_text'] ) ? $button['button_text'] : __( 'Learn More', SP_TEXT_DOMAIN ); ?></a>
<?php
	}
	
	$alternate = !$alternate ? ' alternate' : '';
}
?>
				</p>
<?php } ?>
			</div>
		</div>
<?php } ?>
	</div>
</section>
