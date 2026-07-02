<?php /* Template Name: Has Sidebar */ ?>

<?php get_header(); ?>

<?php get_template_part('template-parts/hero'); ?>

<main id="main" class="has_sidebar">
	<div class="wrap">
		<div id="content">
<?php while (have_posts()) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<?php the_content(); ?>
				
			</article>
<?php endwhile; ?>
		</div>
		
<?php get_sidebar(); ?>
		
	</div>
</main>

<?php spm_load_acf_page_sections( get_field('page_sections') ); ?>

<?php get_footer(); ?>