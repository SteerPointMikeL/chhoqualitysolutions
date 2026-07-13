<?php
/**
 * "one time" label appended after the price (one-time-purchase eBook products).
 *
 * @package WooCommerce\Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! is_a( $product, WC_Product::class ) || '' === $product->get_price() ) {
	return;
}

?>
<span class="price_suffix"><?php echo esc_html( apply_filters( 'spm_price_suffix_label', __( 'one time', SPM_TEXT_DOMAIN ), $product ) ); ?></span>
