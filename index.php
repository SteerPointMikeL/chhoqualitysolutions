<?php get_header(); ?>

<?php get_template_part('template-parts/hero'); ?>

<main id="main">
	<div class="wrap">
		<div id="content">
<?php if ( is_category() ) { ?>
			<h2 class="page_title"><?php single_cat_title(); ?></h2>
<?php } ?>
			
<?php if ( have_posts() ) : ?>
			<div class="columns columns-3 columns-post_archive">
<?php while ( have_posts() ) : the_post(); ?>
				<div class="column">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="image_container">
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium_large', array('class' => 'image') ); ?></a>
						</div>
						
						<p class="title"><?php the_title(); ?></p>
						
						<p><?php echo spm_get_the_excerpt_force_trim(); ?></p>
						
						<a href="<?php the_permalink(); ?>" class="spm_button alternate">Read More</a>
						
						<a href="<?php the_permalink(); ?>" class="full_coverage_link"><?php the_title(); ?></a>
					</article>
				</div>
<?php endwhile; ?>
			</div>
<?php endif; ?>
			
<?php get_template_part('template-parts/pager'); ?>
			
		</div>
	</div>
</main>

<?php get_template_part('template-parts/newsletter_sign_up'); ?>

<?php get_footer(); ?>