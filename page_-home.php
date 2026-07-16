<?php /* Template Name: Home */ ?>

<?php global $h1_already_used; ?>

<?php get_header(); ?> 

<?php if ( have_rows('hero_home') ) : the_row(); ?>
<section id="hero_home">
<?php if ( !get_sub_field('media_type') || get_sub_field('media_type') == 'image' ) { ?>
	<?php echo wp_get_attachment_image( get_sub_field('image'), 'full', null, array('class' => 'background') ); ?>
<?php } else if ( get_sub_field('media_type') == 'video' && get_sub_field('video') ) { ?>
	<div class="video_container">
		<video muted autoplay loop playsinline webkit-playsinline>
			<source src="<?php echo get_sub_field('video'); ?>" type="video/mp4" />
		</video>
	</div>
<?php } ?>
	
	<div class="overlay"></div>
	
	<div class="wrap"><div class="layer_2">
<?php
if ( get_sub_field('title') ) {
	$h1_already_used = true;
?>
		<h1 class="title"><?php the_sub_field('title'); ?></h1>
<?php } ?>
		
		<div class="content">
			
			<?php the_sub_field('content'); ?>
			
<?php
if ( have_rows('buttons') ) :
	$alternate = '';
?>
			<div class="button_container">
<?php while ( have_rows('buttons') ) : the_row(); ?>
				<a href="<?php echo esc_url( get_sub_field('url') ); ?>" class="spm_button<?php echo $alternate; ?>"><?php the_sub_field('button_text'); ?></a>
				
				<?php
$href = '';
if ( !empty( get_sub_field('link_type') ) ) {
	if ( get_sub_field('link_type') === 'page_link' && get_sub_field('page_link') ) {
		$href = get_sub_field('page_link');
	} else if ( get_sub_field('link_type') === 'url' && get_sub_field('url') ) {
		$href = get_sub_field('url');
	}
}

if ( !empty($href) ) {
?>
					<a href="<?php echo esc_url( $href ); ?>" class="spm_button<?php echo $alternate; ?>"><?php echo get_sub_field('button_text') ? get_sub_field('button_text') : __( 'Learn More', SP_TEXT_DOMAIN ); ?></a></p>
<?php } ?>
<?php
	$alternate = !$alternate ? ' alternate' : '';
endwhile;
?>
			</div>
<?php endif; ?>
		</div>
<?php endif; ?>
	</div></div>
</section>

<?php spm_load_acf_page_sections( get_field('page_sections') ); ?>

<?php get_footer(); ?>