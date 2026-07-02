<?php

if ( empty($columns) ) return false;

if ( empty($appearance_modifiers) ) $appearance_modifiers = array();
if ( empty($additional_css_classes) ) $additional_css_classes = '';
if ( empty($columns_per_row) ) $columns_per_row = '2';

$image_lightbox_support = !empty($image_lightbox_support) && is_array($image_lightbox_support) && in_array('1', $image_lightbox_support);

if ( $image_lightbox_support ) {
	wp_enqueue_style( 'glightbox' );
	wp_enqueue_script( 'glightbox' );
}

$multi_column_id = wp_unique_id('multi_column-');

?>
<section id="<?php echo $multi_column_id; ?>" class="layout_block multi_column <?php echo esc_attr( implode( ' ', $appearance_modifiers ) ); ?> <?php echo esc_attr( $additional_css_classes ); ?>">
	<div class="wrap">
		<?php get_template_part( 'template-parts/section_title', null, array( 'pre_title' => $pre_title, 'title' => $title) ); ?>
		
<?php if ( !empty($intro_text) ) { ?>
		<div class="intro_text">
			<?php echo $intro_text; ?>	
		</div>
<?php } ?>
		
		<div class="columns columns-<?php echo $columns_per_row; ?> columns-top_level">
<?php foreach ( $columns as $column ) : ?>
			<div class="column"><div class="layer_2">
<?php if ( !empty( $column['title'] ) ) { ?>
				<p class="title"><?php echo $column['title']; ?></p>
<?php } ?>
						
<?php
if ( !empty( $column['image'] ) ) {
	$image_src = wp_get_attachment_image_src( $column['image'], 'full' );
	
	if ( is_array($image_src) && count($image_src) ) {
?>
				<div class="image_container">
<?php if ( $image_lightbox_support ) { ?>
					<a href="<?php echo $image_src[0]; ?>" class="glightbox"><?php echo wp_get_attachment_image( $column['image'], 'medium', null, array('class' => 'image') ); ?></a>
<?php } else { ?>
					<?php echo wp_get_attachment_image( $column['image'], 'medium', null, array('class' => 'image') ); ?>
				
<?php } ?>
				</div>
<?php
	}
}
?>
				
<?php if ( !empty( $column['content'] ) ) { ?>
				<div class="content">
					
					<?php echo $column['content']; ?>
					
				</div>
<?php } ?>
				
<?php
$href = '';
if ( !empty( $column['link_type'] ) ) {
	if ( $column['link_type'] === 'page_link' && !empty( $column['page_link'] ) ) {
		$href = $column['page_link'];
	} else if ( $column['link_type'] === 'url' && !empty( $column['url'] ) ) {
		$href = $column['url'];
	}
}

if ( !empty($href) ) {
?>
					<p class="button_container"><a href="<?php echo esc_url( $href ); ?>" class="spm_button"><?php echo !empty( $column['button_text'] ) ? $column['button_text'] : __( 'Learn More', SPM_TEXT_DOMAIN ); ?></a></p>
					
<?php if ( in_array( 'grey_columns', $appearance_modifiers) || str_contains('grey_columns', $additional_css_classes) ) { ?>
					<a href="<?php echo esc_url( $href ); ?>" class="full_coverage_link"><?php echo !empty( $column['title'] ) ? strip_tags( preg_replace('/<br *\/? *>+/i', ' ', $column['title'] ) ) : '&nbsp;'; ?></a>
<?php
	}
}
?>
			</div></div>
<?php endforeach; ?>
		</div>
	</div>
	
<?php if ( $image_lightbox_support ) { ?>
	<script>
	jQuery(document).ready(function($){
		
		var imageCarouselLightbox = GLightbox({
			selector: '#<?php echo $multi_column_id; ?> .glightbox',
		});
		
	});
	</script>
<?php } ?>
</section>
