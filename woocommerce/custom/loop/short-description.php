<?php
/**
 * Short product description (excerpt) shown on the product loop card.
 *
 * @package WooCommerce\Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$short_description = $product->get_short_description();

?>
<?php if ( $short_description ) : ?>

	<div class="product_short_description"><?php echo wp_kses_post( wpautop( $short_description ) ); ?></div>

	<?php
endif;

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
