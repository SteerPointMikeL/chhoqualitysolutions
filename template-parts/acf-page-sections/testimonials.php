<?php

$testimonials = get_field('testimonials', 'options');
if ( empty($testimonials) ) return false;

if ( empty($appearance_modifiers) ) $appearance_modifiers = array();
if ( empty($additional_css_classes) ) $additional_css_classes = '';

?>
<div class="layout_block testimonials <?php echo esc_attr( implode( ' ', $appearance_modifiers ) ); ?> <?php echo esc_attr( $additional_css_classes ); ?>">
	<div class="wrap">
		<?php get_template_part( 'template-parts/section_title', null, array( 'pre_title' => $pre_title, 'title' => $title) ); ?>
		
<?php if ( !empty($intro_text) ) { ?>
		<div class="intro_text">
			<?php echo $intro_text; ?>	
		</div>
<?php } ?>
		
		<div class="columns columns-3 columns-top_level">
<?php foreach ( $testimonials as $testimonial ) { ?>
				<div class="column">
					<blockquote>
						<p class="star_rating">
							<i class="icon-star"></i>
							<i class="icon-star"></i>
							<i class="icon-star"></i>
							<i class="icon-star"></i>
							<i class="icon-star"></i>
						</p>
						
						<?php echo $testimonial['content']; ?>
						
						<footer class="signed">
							<?php echo wp_get_attachment_image( $testimonial['image'], 'thumb', null, array('class' => 'image') ); ?>
							
							<div class="content">
<?php if ( !empty( $testimonial['name'] ) ) { ?>
								<p class="name"><?php echo $testimonial['name']; ?></p>
<?php } ?>
								
<?php if ( !empty( $testimonial['company'] ) ) { ?>
								<p class="company"><?php if ( !empty($testimonial['title'] ) ) { echo $testimonial['title']; ?>, <?php } ?><?php echo $testimonial['company']; ?></p>
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
