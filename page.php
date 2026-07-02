<?php get_header(); ?>

<?php get_template_part('template-parts/hero'); ?>

<main id="main">
	<div class="wrap">
		<div id="content">
<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<?php the_content(); ?>
				
			</article>
<?php endwhile; ?>
		</div>
	</div>
</main>

<?php spm_load_acf_page_sections( get_field('modules') ); ?>

<?php get_footer(); ?>