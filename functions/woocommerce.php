<?php

// Declare support for core WooCommerce features
add_action( 'after_setup_theme', function() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-lightbox' );
} );


// Change smallscreen breakpoint from 768px to 767px

add_filter( 'woocommerce_style_smallscreen_breakpoint', function() {
	return '767px';
} );


// Remove page title
add_filter( 'woocommerce_show_page_title', '__return_false' );


// Remove breadcrumbs
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );


// Relocate sidebar to inside main wrapper (shop archive template only)
add_action( 'template_redirect', function() {
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	if ( is_shop() ) {
		add_action( 'woocommerce_after_main_content', 'woocommerce_get_sidebar', 5 );
	}
} );


// Add product thumbnail container
function spm_woocommerce_template_loop_product_thumbnail_open() {
	wc_get_template( 'custom/loop/product-thumbnail-open.php' );
}
add_action( 'woocommerce_before_shop_loop_item_title', 'spm_woocommerce_template_loop_product_thumbnail_open', 5 );

function spm_woocommerce_template_loop_product_thumbnail_close() {
	wc_get_template( 'custom/loop/product-thumbnail-close.php' );
}
add_action( 'woocommerce_before_shop_loop_item_title', 'spm_woocommerce_template_loop_product_thumbnail_close', 15 );


// Add "In-Stock" ribbon
function spm_woocommerce_show_product_loop_in_stock_ribbon() {
	wc_get_template( 'custom/loop/in-stock-ribbon.php' );
}
add_action( 'woocommerce_before_shop_loop_item_title', 'spm_woocommerce_show_product_loop_in_stock_ribbon', 5 );


// Add Brand
function spm_woocommerce_template_loop_brand() {
	wc_get_template( 'custom/loop/brand.php' );
}
add_action( 'woocommerce_after_shop_loop_item_title', 'spm_woocommerce_template_loop_brand', 5 );


// Remove cart controls from product archive
//remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );


// Relocate price to after cart controls
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 30 );


// Relocate product meta to immediately after title
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 5 );


// Remove "Clear" link from variable product cart
//add_filter( 'woocommerce_reset_variations_link', '__return_false' );


// Relocate product excerpt from summary div to before tabs
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_single_excerpt', 5 );


// Add after-single-product wrapper
function spm_woocommerce_template_after_single_product_wrapper_open()  {
	wc_get_template( 'custom/single-product/after-single-product-wrapper-open.php' );
}
add_action( 'woocommerce_after_single_product_summary', 'spm_woocommerce_template_after_single_product_wrapper_open', 5 );

function spm_woocommerce_template_after_single_product_wrapper_close() {
	wc_get_template( 'custom/single-product/after-single-product-wrapper-close.php' );
}
add_action( 'woocommerce_after_single_product_summary', 'spm_woocommerce_template_after_single_product_wrapper_close', 15 );


// Add after-product sidebar
function spm_woocommerce_template_after_single_product_sidebar() {
	wc_get_template( 'custom/single-product/after-single-product-sidebar.php' );
}
add_action( 'woocommerce_after_single_product_summary', 'spm_woocommerce_template_after_single_product_sidebar', 10 );


// Remove headings from tab content
add_filter( 'woocommerce_product_description_heading', '__return_false' );
//add_filter( 'woocommerce_product_additional_information_heading', '__return_false' );


// Add Specifications and Documents to tabs
add_filter( 'woocommerce_product_tabs', function( $tabs ) {
	$specs = get_post_meta( get_the_ID(), '_specifications', true );
	if ( empty($specs) ) $specs = get_post_meta( get_the_ID(), 'specifications_html', true );
	
	$docs = get_post_meta( get_the_ID(), '_documents', true );
	if ( empty($docs) ) $docs = get_post_meta( get_the_ID(), 'documents_html', true );
	
	// Rename default description tab to "Overview"
	if ( isset( $tabs['description'] ) ) {
		$tabs['description']['title'] = __( 'Overview', SPM_TEXT_DOMAIN );
	}
	
	// Remove "Additional Information" tab
	unset( $tabs['additional_information'] );
	
	// Add Specifications tab if data exists
	if ( !empty($specs) ) {
		$tabs['specifications'] = array(
			'title'    => __( 'Specifications', SPM_TEXT_DOMAIN ),
			'priority' => 20,
			'callback' => 'spm_specifications_tab_content',
		);
	}
	
	// Add Documents tab if data exists
	if ( !empty($docs) ) {
		$tabs['documents'] = array(
			'title'    => __( 'Documents', SPM_TEXT_DOMAIN ),
			'priority' => 30,
			'callback' => 'spm_documents_tab_content',
		);
	}
	
	return $tabs;
} );


// Specifications tab content
function spm_specifications_tab_content() {
	$specs = get_post_meta( get_the_ID(), '_specifications', true);
	if ( empty($specs) ) $specs = get_post_meta( get_the_ID(), 'specifications_html', true );
	
	if ( !empty($specs) ) {
		echo wp_kses_post( $specs );
	}
}

// Documents tab content
function spm_documents_tab_content() {
	$docs = get_post_meta( get_the_ID(), '_documents', true );
	if ( empty($docs) ) $docs = get_post_meta( get_the_ID(), 'documents_html', true );
	
	echo $docs;
	
}


// Products carousel shortcode
function spm_woocommerce_shortcode_product_carousel( $atts ) {
	$atts = (array) $atts;
	$type = 'products';

	// Allow list product based on specific cases.
	if ( isset( $atts['on_sale'] ) && wc_string_to_bool( $atts['on_sale'] ) ) {
		$type = 'sale_products';
	} elseif ( isset( $atts['best_selling'] ) && wc_string_to_bool( $atts['best_selling'] ) ) {
		$type = 'best_selling_products';
	} elseif ( isset( $atts['top_rated'] ) && wc_string_to_bool( $atts['top_rated'] ) ) {
		$type = 'top_rated_products';
	}

	$shortcode = new WC_Shortcode_Products_Carousel( $atts, $type );

	return $shortcode->get_content();
}
add_shortcode('products_carousel', 'spm_woocommerce_shortcode_product_carousel');

if ( ! function_exists( 'woocommerce_product_carousel_loop_start' ) ) {

	/**
	 * Output the start of a product loop. By default this is a UL.
	 *
	 * @param bool $echo Should echo?.
	 * @return string
	 */
	function woocommerce_product_carousel_loop_start( $echo = true ) {
		ob_start();
		$GLOBALS['woocommerce_loop']['loop'] = 0;
		wc_get_template( 'custom/loop/loop-carousel-start.php' );
		if ( $echo ) {
			echo ob_get_clean(); // WPCS: XSS ok.
		} else {
			return ob_get_clean();
		}
	}
}

if ( ! function_exists( 'woocommerce_product_carousel_loop_end' ) ) {

	/**
	 * Output the end of a product loop. By default this is a UL.
	 *
	 * @param bool $echo Should echo?.
	 * @return string
	 */
	function woocommerce_product_carousel_loop_end( $echo = true ) {
		ob_start();

		wc_get_template( 'custom/loop/loop-carousel-end.php' );

		if ( $echo ) {
			echo ob_get_clean(); // WPCS: XSS ok.
		} else {
			return ob_get_clean();
		}
	}
}


// Products with sidebar shortcode
function spm_woocommerce_shortcode_products_with_sidebar( $atts ) {
	$atts = (array) $atts;
	$type = 'products';

	// Allow list product based on specific cases.
	if ( isset( $atts['on_sale'] ) && wc_string_to_bool( $atts['on_sale'] ) ) {
		$type = 'sale_products';
	} elseif ( isset( $atts['best_selling'] ) && wc_string_to_bool( $atts['best_selling'] ) ) {
		$type = 'best_selling_products';
	} elseif ( isset( $atts['top_rated'] ) && wc_string_to_bool( $atts['top_rated'] ) ) {
		$type = 'top_rated_products';
	}

	$shortcode = new WC_Shortcode_Products_With_Sidebar( $atts, $type );

	return $shortcode->get_content();
}
add_shortcode('products_with_sidebar', 'spm_woocommerce_shortcode_products_with_sidebar');