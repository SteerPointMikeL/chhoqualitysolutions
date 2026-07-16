<?php get_header(); ?>

<?php //get_template_part('template-parts/hero'); ?>

<div id="main">
	<div class="wrap">
		<div id="content">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h2 class="page_title"><span><?php _e('404 - Page Not Found', SP_TEXT_DOMAIN); ?></span></h2>
				
				<p><?php _e('There was no page found at this URL.', SP_TEXT_DOMAIN); ?></p>
			</article>
		</div>
	</div>
</div>

<?php get_footer(); ?>