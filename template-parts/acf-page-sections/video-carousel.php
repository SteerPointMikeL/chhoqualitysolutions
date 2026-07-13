<?php

if ( empty($carousel_items) ) return false;

if ( empty($appearance_modifiers) ) $appearance_modifiers = array();
if ( empty($additional_css_classes) ) $additional_css_classes = '';

wp_enqueue_style( 'owl-carousel' );
wp_enqueue_script( 'owl-carousel' );

if ( empty($classes) ) {
	$classes = '';
}

$video_carousel_id = wp_unique_id('video_carousel-');

?>
<div class="layout_block video_carousel <?php echo esc_attr( implode( ' ', $appearance_modifiers ) ); ?> <?php echo esc_attr( $additional_css_classes ); ?>">
	<div class="wrap">
<?php get_template_part( 'template-parts/section_title', null, array( 'pre_title' => $pre_title, 'title' => $title) ); ?>
		
<?php if ( !empty($intro_text) ) { ?>
		<div class="intro_text">
			<?php echo $intro_text; ?>
		</div>
<?php } ?>
		
		<div id="<?php echo $video_carousel_id; ?>" class="owl-carousel">			
<?php foreach ( $carousel_items as $item ) : ?>
			<div class="carousel_item">
<?php
if ( !empty( $item['video_embed_code'] ) ) {
	if ( str_contains( get_sub_field('video_embed_code'), 'lite-youtube' ) ) {
		wp_enqueue_style('lite-youtube-embed');
		wp_enqueue_script('lite-youtube-embed');
	}
?>
				<div class="video_container">
					<?php echo $item['video_embed_code']; ?>
				</div>
<?php } ?>
			</div>
<?php endforeach; ?>
		</div>
	</div>
	
	<script>
	jQuery(document).ready(function($){
		
		$('#<?php echo $video_carousel_id; ?>').owlCarousel({
			responsive: {
				0: {items: 1},
				640: {items: 2},
				960: {items: 3},
			},
			margin: 12,
			responsiveRefreshRate: 50,
			navSpeed: 500,
			navText: ['<i class="icon-chevron-left"></i>', '<i class="icon-chevron-right"></i>'],
			rewind: true,
			dots: false,
			nav: true,
		});
		
	});
	</script>
</div>

