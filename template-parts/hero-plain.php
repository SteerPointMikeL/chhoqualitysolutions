<?php

extract($args);

if ( have_rows( 'hero_plain', $post_id ) ) the_row();
?>
<section id="hero_plain" class="<?php echo esc_attr( get_sub_field('additional_css_classes') ); ?>">
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
