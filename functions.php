<?php

define('SPM_TEXT_DOMAIN', 'chhoqualitysolutions');

require_once( get_template_directory() . '/functions/filters.php' );
require_once( get_template_directory() . '/functions/shortcodes.php' );
require_once( get_template_directory() . '/functions/tags.php' );
require_once( get_template_directory() . '/functions/class-wp-nav-menu-widget-with-icons.php' );
require_once( get_template_directory() . '/functions/walker_nav_menu_wide.php' );
require_once( get_template_directory() . '/functions/walker_nav_menu_with_icons.php' );

if (
	in_array( 'advanced-custom-fields/acf.php', apply_filters( 'active_plugins', get_option('active_plugins') ) ) ||
	in_array( 'advanced-custom-fields-pro/acf.php', apply_filters( 'active_plugins', get_option('active_plugins') ) )
) {
	require_once( get_template_directory() . '/functions/acf.php' );
}

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option('active_plugins') ) ) ) {
	require_once( get_template_directory() . '/functions/woocommerce.php' );
	require_once( get_template_directory() . '/functions/class-wc-shortcode-products_carousel.php' );
	require_once( get_template_directory() . '/functions/class-wc-shortcode-products_with_sidebar.php' );
}


function spm_after_setup_theme() {
	
	// Make theme available for translation
	load_theme_textdomain( SPM_TEXT_DOMAIN, get_template_directory() . '/languages' );
	
	// Featured Images
	add_theme_support( 'post-thumbnails', array('post') );
	add_image_size( 'spm_medium_less_large', 500, 500 );
	
	// HTML5 markup
	add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'widgets', 'navigation-widgets') );
	
	// Document title
	add_theme_support( 'title-tag' );
	
	// Menus
	register_nav_menus( array(
		'header' => __( 'Header', SPM_TEXT_DOMAIN ),
		'footer' => __( 'Footer', SPM_TEXT_DOMAIN ),
		'mobile' => __( 'Mobile', SPM_TEXT_DOMAIN ),
	) );
	
	// Remove global styles and duotone support from frontend
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
	remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
	
}
add_action('after_setup_theme', 'spm_after_setup_theme');


/* function spm_init() {
	
	// This is where custom post types and taxonomies would be defined if any existed
	
}
add_action('init', 'spm_init'); */


function spm_widgets_init() {
	
	// Names of sidebars to create
	$sidebars = array(
		array('name' => __( 'Sidebar', SPM_TEXT_DOMAIN ),              'id' => 'sidebar' ),
		array('name' => __( 'Blog', SPM_TEXT_DOMAIN ),                 'id' => 'blog' ),
		array('name' => __( 'Shop', SPM_TEXT_DOMAIN ),                 'id' => 'shop' ),
	);
	
	foreach ($sidebars as $sidebar) {
		register_sidebar( array(
			'name'          => $sidebar['name'],
			'id'            => $sidebar['id'],
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>',
		) );
	}
	
}
add_action('widgets_init', 'spm_widgets_init');


function spm_enqueue_scripts() {
	$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
	
	wp_register_style( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel' . $suffix . '.css' );
	wp_register_style( 'glightbox', get_template_directory_uri().'/js/glightbox' . $suffix . '.css' );
	wp_register_style( 'lite-youtube-embed', get_template_directory_uri().'/js/lite-yt-embed.css' );
	
	wp_enqueue_style( 'googleapis-fonts', 'https://fonts.googleapis.com/css2?family=Mona+Sans:ital,wght@0,200..900;1,200..900&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap' );
	wp_enqueue_style( 'icomoon', get_template_directory_uri() . '/icons/style.css' );
	wp_enqueue_style( 'jquery-modal', get_template_directory_uri().'/js/jquery.modal' . $suffix . '.css' );
	wp_enqueue_style( SPM_TEXT_DOMAIN.'-styles', get_stylesheet_uri() );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
	
	wp_register_script( 'jquery-cycle2', get_template_directory_uri() . '/js/jquery.cycle2' . $suffix . '.js', null, '2.1.6', true );
	wp_register_script( 'jquery-cycle2-swipe', get_template_directory_uri() . '/js/jquery.cycle2.swipe' . $suffix . '.js', array('jquery-cycle2'), '20121120', true );
	wp_register_script( 'js-cookie', get_template_directory_uri().'/js/js.cookie' . $suffix . '.js', array('jquery'), '3.0.5', true );
	wp_register_script( 'jquery-modal', get_template_directory_uri() . '/js/jquery.modal' . $suffix . '.js', array('jquery'), '0.9.2', true );
	wp_register_script( 'wow', get_template_directory_uri() . '/js/wow' . $suffix . '.js', null, '1.1.2', true );
	wp_register_script( 'owl-carousel', get_template_directory_uri().'/js/owl.carousel' . $suffix . '.js', array('jquery'), '2.3.4', true );
	wp_register_script( 'glightbox', get_template_directory_uri().'/js/glightbox' . $suffix . '.js', null, '1.1.2', true );
	wp_register_script( 'lite-youtube-embed', get_template_directory_uri() . '/js/lite-yt-embed.js', null, '0.3.3', true );
	wp_register_script( 'lite-vimeo', get_template_directory_uri().'/js/lite-vimeo' . $suffix . '.js', null, '0.1.1', true );
	
	wp_enqueue_script( SPM_TEXT_DOMAIN.'-script', get_template_directory_uri().'/js/functions.js', array('jquery', 'js-cookie', 'jquery-modal', 'wow'), null, true );
}
add_action('wp_enqueue_scripts', 'spm_enqueue_scripts');