<?php

extract($args);

if ( have_rows( 'hero_standard', $post_id ) ) the_row();
?>
<section id="hero" class="<?php echo esc_attr( get_sub_field('additional_css_classes') ); ?>">
<?php if ( get_sub_field('background_image') ) { ?>
	<?php echo wp_get_attachment_image( get_sub_field('background_image'), 'full', null, array('class' => 'background', 'loading' => false, 'alt' => '', 'title' => '') ); ?>
<?php } else { ?>
	<img src="<?php echo get_template_directory_uri(); ?>/images/hero-default.jpg" alt="" class="background" />
<?php } ?>
	
	<div class="overlay"></div>
	
	<div class="wrap">
<?php if ( !get_sub_field('hide_title') ) { ?>
		<h1 class="page_title"><?php echo $hero_title; ?></h1>
<?php } ?>
			
<?php if ( get_sub_field('content') ) { ?>
		<div class="content">
			<?php the_sub_field('content'); ?>
		</div>
<?php } ?>
	</div>
</section>
