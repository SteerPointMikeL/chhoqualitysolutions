<?php
/**
 * Products shortcode
 *
 * @package  WooCommerce\Shortcodes
 * @version  3.2.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Products shortcode class.
 */
class WC_Shortcode_Products_With_Sidebar extends WC_Shortcode_Products {

	function __construct( $attributes = array(), $type = 'products' ) {
		parent::__construct( $attributes, $type);
	}

	/**
	 * Loop over found products.
	 *
	 * @since  3.2.0
	 * @return string
	 */
	protected function product_loop() {
		$columns  = absint( $this->attributes['columns'] );
		$classes  = $this->get_wrapper_classes( $columns );
		$products = $this->get_query_results();

		ob_start();

		if ( $products && $products->ids ) {
			// Prime caches to reduce future queries.
			if ( is_callable( '_prime_post_caches' ) ) {
				_prime_post_caches( $products->ids );
			}

			// Setup the loop.
			wc_setup_loop(
				array(
					'columns'      => $columns,
					'name'         => $this->type,
					'is_shortcode' => true,
					'is_search'    => false,
					'is_paginated' => wc_string_to_bool( $this->attributes['paginate'] ),
					'total'        => $products->total,
					'total_pages'  => $products->total_pages,
					'per_page'     => $products->per_page,
					'current_page' => $products->current_page,
				)
			);

			$original_post = $GLOBALS['post'];

			do_action( "woocommerce_shortcode_before_{$this->type}_loop", $this->attributes );
			
			?>
			<div class="columns columns-2 columns-top_level">
				<div class="column column-content">
			<?php

			if ( wc_string_to_bool( $this->attributes['paginate'] ) ) {
				/**
				 * Fire the standard shop hooks when paginating so we can display result counts etc.
				 * If the pagination is not enabled, this hook will not be fired.
				 *
				 * @since 3.3.1
				 */
				do_action( 'woocommerce_before_shop_loop' );
			}

			woocommerce_product_loop_start();

			if ( wc_get_loop_prop( 'total' ) ) {
				foreach ( $products->ids as $product_id ) {
					$GLOBALS['post'] = get_post( $product_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
					setup_postdata( $GLOBALS['post'] );

					// Set custom product visibility when querying hidden products.
					add_action( 'woocommerce_product_is_visible', array( $this, 'set_product_as_visible' ) );

					// Render product template.
					wc_get_template_part( 'content', 'product' );

					// Restore product visibility.
					remove_action( 'woocommerce_product_is_visible', array( $this, 'set_product_as_visible' ) );
				}
			}

			$GLOBALS['post'] = $original_post; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			woocommerce_product_loop_end();

			if ( wc_string_to_bool( $this->attributes['paginate'] ) ) {
				/**
				 * Fire the standard shop hooks when paginating so we can display the pagination.
				 * If the pagination is not enabled, this hook will not be fired.
				 *
				 * @since 3.3.1
				 */
				do_action( 'woocommerce_after_shop_loop' );
			}

			do_action( "woocommerce_shortcode_after_{$this->type}_loop", $this->attributes );
			
			?>
				</div>
				
				<div class="column column-sidebar">
					<aside id="sidebar">
						
						<?php dynamic_sidebar('shop'); ?>
						
					</aside>
				</div>
			</div>
			<?php

			wp_reset_postdata();
			wc_reset_loop();
		} else {
			do_action( "woocommerce_shortcode_{$this->type}_loop_no_results", $this->attributes );
		}

		return '<div class="' . esc_attr( implode( ' ', $classes ) ) . '">' . ob_get_clean() . '</div>';
	}

}
