<?php

$logos = get_field('logos', 'options');
if ( empty($logos) ) return false;

wp_enqueue_style( 'owl-carousel' );
wp_enqueue_script( 'owl-carousel' );

if ( empty($appearance_modifiers) ) $appearance_modifiers = array();
if ( empty($additional_css_classes) ) $additional_css_classes = '';

$logo_carousel_id = wp_unique_id('image_carousel-');

?>
<section class="layout_block logo_carousel <?php echo esc_attr( implode( ' ', $appearance_modifiers ) ); ?> <?php echo esc_attr( $additional_css_classes ); ?>">
	<div id="<?php echo $logo_carousel_id; ?>" class="owl-carousel">
<?php foreach ( $logos as $logo ) { ?>
		<?php echo wp_get_attachment_image( $logo, 'medium_large', null, array('class' => 'image') ); ?>
<?php } ?>
	</div>
	
	<script>
	jQuery(document).ready(function($){
		$('#<?php echo $logo_carousel_id; ?>').owlCarousel({
			responsive: {
				0: {items: 3},
				568: {items: 4},
				1024: {items: 5},
			},
			margin: 60,
			stagePadding: 10,
			loop: true,
			autoplay: true,
			autoplayTimeout: 8000,
			autoplaySpeed: 1000,
			responsiveRefreshRate: 50,
			//center: true,
			dots: false,
		});
		
	});
	</script>
</section>
