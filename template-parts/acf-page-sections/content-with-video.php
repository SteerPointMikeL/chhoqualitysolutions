<?php

if ( empty($appearance_modifiers) ) $appearance_modifiers = array();
if ( empty($additional_css_classes) ) $additional_css_classes = '';
if ( empty($column_space_distribution) ) $column_space_distribution = '';
if ( empty($media_position) ) $media_position = 'left';
if ( empty($video_type) ) $video_type = 'file';
if ( empty($content) ) $content = '';

?>
<section class="layout_block content_editor content_with_image content_with_video <?php echo esc_attr( implode( ' ', $appearance_modifiers ) ); ?> <?php echo esc_attr( $additional_css_classes ); ?> <?php echo esc_attr( $column_space_distribution ); ?>">
	<div class="wrap">
		<div class="columns columns-2 content_with_image_columns <?php echo esc_attr( $media_position ); ?>">
			<div class="column column-1 column-image">
<?php if ( !empty($title) ) { ?>
				<p class="section_title responsive"><?php echo $title; ?></p>
<?php } ?>
				
<?php if ( $video_type == 'file' && !empty($video_file) ) { ?>
				<div class="video_container">
					<video autoplay loop playsinline muted>
						<source src="<?php echo esc_url( $video_file ); ?>" />
					</video>
				</div>
<?php
} else if ( $video_type == 'embed_code' && !empty($video_embed_code) ) { 
	if ( str_contains( $video_embed_code, 'lite-vimeo' ) ) {
		wp_enqueue_script('lite-vimeo');
?>
				<div class="video_container_lite_vimeo">
					<?php echo $video_embed_code; ?>
				</div>
<?php
	} else {
		if ( str_contains( $video_embed_code, 'lite-youtube' ) ) {
			wp_enqueue_style('lite-youtube-embed');
			wp_enqueue_script('lite-youtube-embed');
		}
?>
				<div class="video_container">
					<?php echo $video_embed_code; ?>
				</div>
<?php
	}
} else { ?>
				<img src="<?php echo get_template_directory_uri(); ?>/images/layout_block-content_with_video-placeholder.webp" alt="" />
<?php } ?>
			</div>
			
			<div class="column column-2 column-description">	
				<?php get_template_part( 'template-parts/section_title', null, array( 'pre_title' => $pre_title, 'title' => $title) ); ?>
				
				<div class="content_container">
					<?php echo $content; ?>
				</div>
			</div>
		</div>
	</div>
</section>
