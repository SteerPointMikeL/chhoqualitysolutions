<?php
$page_template_sidebar_mappings = array(
	'page_-about.php' => 'about',
);
?>
		
		<aside id="sidebar">
<?php if ( get_page_template_slug() && array_key_exists( get_page_template_slug(), $page_template_sidebar_mappings ) ) { ?>
			<?php dynamic_sidebar( $page_template_sidebar_mappings[ get_page_template_slug() ] ); ?>
<?php } else { ?>
			<?php dynamic_sidebar('sidebar'); ?>
<?php } ?>
		</aside>
