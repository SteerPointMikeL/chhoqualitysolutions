<?php
/**
 * Product category badge shown over the product loop thumbnail.
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

	<span class="product_badge"><?php echo esc_html( $badge ); ?></span>

	<?php
endif;

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
