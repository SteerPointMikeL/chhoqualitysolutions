<?php get_header(); ?>

<main id="main" class="has_sidebar">
	<div class="wrap">
		<div id="content">
<?php if ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h1 class="page_title"><?php if ( get_field('alternate_title') ) { the_field('alternate_title'); } else { the_title(); } ?></h1>
				
				<p><?php the_post_thumbnail('medium_large'); ?></p>
				
				<?php /* <p class="postmetadata">
					<em><?php printf( __('By %s', SPM_TEXT_DOMAIN), get_the_author_meta('display_name') ); ?></em> |
					<?php echo get_the_date('F j, Y'); ?> |
					<?php echo get_the_category_list(', '); ?>
				</p> */ ?>
				
				<?php the_content(); ?>
				
				<?php /* <div id="comments-section">
					
					<?php comments_template(); ?>
					
				</div> */ ?>
			</article>
<?php endif; ?>
			
<?php get_template_part('template-parts/pager'); ?>
						
		</div>
		
<?php get_sidebar('blog'); ?>
		
	</div>
</main>

<?php get_footer(); ?>