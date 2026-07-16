<?php

extract($args);

if ( have_rows('hero_two_column', $post_id) )  the_row();
?>
<section id="hero_two_column"<?php if ( get_sub_field('additional_css_classes') ) { ?> class="<?php echo esc_attr( get_sub_field('additional_css_classes') ); ?>"<?php } ?>>
	<div class="wrap">
		<div class="columns columns-2 columns-top_level <?php /* echo !empty( get_sub_field('media_position') ) ? esc_attr( get_sub_field('media_position') ) : 'left'; */ ?>">
			<div class="column column-1 column-image">
				<div class="title_container responsive">
					<h1 class="page_title"><?php echo $hero_title; ?></h1>
				</div>
				
<?php $image = is_single() && !get_sub_field('image') ? get_post_thumbnail_id() : get_sub_field('image'); ?>
				<?php echo wp_get_attachment_image( $image, 'medium_large', null, array('class' => 'image', 'loading' => false, 'alt' => '', 'title' => '') ); ?>
				
			</div>
			
			<div class="column column-2 column-content">
				<div class="title_container">
<?php if ( get_sub_field('pre_title') ) { ?>
					<p class="pre_title"><?php the_sub_field('pre_title'); ?></p>
<?php } ?>
					
					<h1 class="page_title"><?php echo $hero_title; ?></h1>
				</div>
				
<?php if ( get_sub_field('content') ) { ?>
				<div class="content">
					<?php the_sub_field( 'content'); ?>
				</div>
<?php } ?>
				
<?php if ( have_rows('buttons') ) : ?>
				<p class="button_container">
<?php
while ( have_rows('buttons') ) : the_row();
	$alternate = !empty($alternate) ? '' : ' alternate';
	
	if ( get_sub_field('link_type') == 'page_link' && get_sub_field('page_link') ) {
		$href = get_sub_field('page_link');
	} else if ( get_sub_field('link_type') == 'url' && get_sub_field('url') ) {
		$href = get_sub_field('url');
	}
	
	if ( !empty($href) ) {
?>
					<a href="<?php echo esc_url( $href ); ?>" class="spm_button<?php echo $alternate; ?>"<?php if ( get_sub_field('link_target') ) { ?> target="<?php echo esc_attr( get_sub_field('link_target')[0] ); ?>"<?php } ?>><?php echo get_sub_field('text') ? get_sub_field('text') : __( 'Learn More', SP_TEXT_DOMAIN ); ?></a>
<?php
	}
endwhile;
?>
				</p>
<?php endif; ?>
			</div>
		</div>
	</div>
</section>
