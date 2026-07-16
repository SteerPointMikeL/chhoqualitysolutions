<?php get_header(); ?>

<main id="main">
	<div class="wrap clearfix">
		<div id="content">
			<h2 class="page_title"><?php printf( __('Search: &quot;%s&quot;', SP_TEXT_DOMAIN), get_search_query() ); ?></h2>
			
<?php if ( have_posts() ) : ?>
<?php while (have_posts()) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				
				<p class="postmetadata"><em><?php printf( __('By %s', SP_TEXT_DOMAIN), get_the_author_meta('display_name') ); ?></em> | <?php echo get_the_category_list(', '); ?></p>
				
				<?php the_excerpt(); ?>
				
			</article>
<?php endwhile; ?>
<?php else : ?>
			<article>
				<h3 class="title"><?php _e('No Results'); ?></h3>
				
				<?php _e('Nothing found for these search terms.', SP_TEXT_DOMAIN); ?>
			</article>
<?php endif; ?>
			
<?php get_template_part('template-part-pager'); ?>
			
		</div>
		
<?php get_sidebar(); ?>
		
	</div>
</main>

<?php get_footer(); ?>