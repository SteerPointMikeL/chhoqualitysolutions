<?php
/**
 * Single product category name (e.g. "EBook") shown before the product title.
 *
 * @package WooCommerce\Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$terms = get_the_terms( $product->get_id(), 'product_cat' );

?>
<?php if ( !empty($terms) && !is_wp_error($terms) )  : ?>

	<p class="pre_title"><?php echo esc_html( apply_filters( 'spm_product_category_badge', $terms[0]->name, $product, $terms[0] ) ); ?></p>

	<?php
endif;

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
