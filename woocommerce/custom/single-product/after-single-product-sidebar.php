		<aside id="sidebar">
<?php if ( is_active_sidebar( 'single-product' ) ) : ?>

			<?php dynamic_sidebar( 'single-product' ); ?>

<?php else : ?>

			<?php get_template_part( 'template-parts/quality-made-simple-cta' ); ?>

<?php endif; ?>
		</aside>
