<?php

$testimonials = get_field('testimonials', 'options');
if ( empty($testimonials) ) return false;

wp_enqueue_script( 'jquery-cycle2' );

if ( empty($appearance_modifiers) ) $appearance_modifiers = array();
if ( empty($additional_css_classes) ) $additional_css_classes = '';

$testimonials_id = wp_unique_id( 'testimonials-' );

?>
<div class="layout_block testimonials <?php echo esc_attr( implode( ' ', $appearance_modifiers ) ); ?> <?php echo esc_attr( $additional_css_classes ); ?>">
	<div class="wrap">
		<?php get_template_part( 'template-parts/section_title', null, array( 'pre_title' => $pre_title, 'title' => $title) ); ?>
		
		<div id="<?php echo $testimonials_id; ?>" class="slideshow_container">
			<div class="cycle-nav">
				<a href="#" class="cycle-prev"><i class="icon-arrow-left"></i></a>
				<a href="#" class="cycle-next"><i class="icon-arrow-right"></i></a>
			</div>
			
			<div class="cycle-slideshow"
				data-cycle-timeout="10000"
				data-cycle-slides="> .slide"
				data-cycle-prev="#<?php echo $testimonials_id; ?> > .cycle-nav > .cycle-prev"
				data-cycle-next="#<?php echo $testimonials_id; ?> > .cycle-nav > .cycle-next"
				data-cycle-auto-height="container"
				data-cycle-speed="600" 
				data-cycle-fx="scrollHorz"
			>
<?php foreach ( $testimonials as $testimonial ) { ?>
				<div class="slide">
					<blockquote>
						
						<?php echo $testimonial['content']; ?>
						
						<footer class="signed">
							<div class="content">
<?php if ( !empty( $testimonial['name'] ) ) { ?>
								<p class="name"><?php echo $testimonial['name']; ?><?php if ( !empty($testimonial['title'] ) ) { ?>, <?php echo $testimonial['title']; } ?></p>
<?php } ?>
								
<?php if ( !empty( $testimonial['company'] ) ) { ?>
								<p class="company"><?php echo $testimonial['company']; ?></p>
<?php } ?>
							</div>
						</footer>
					</blockquote>
				</div>
<?php } ?>
			</div>
		</div>
	</div>
</div>
