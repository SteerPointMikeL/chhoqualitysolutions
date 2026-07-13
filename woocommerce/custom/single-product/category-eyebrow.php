<?php
/**
 * Single product category eyebrow (e.g. "EBOOK") shown above the product title.
 *
 * @package WooCommerce\Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$badge = spm_get_product_category_badge( $product );

?>
<?php if ( $badge ) : ?>

	<p class="product_category_eyebrow pre_title"><?php echo esc_html( $badge ); ?></p>

	<?php
endif;

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
