<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$brands = get_the_terms( $product->ID, 'product_brand' );

?>
<?php if ( $brands ) : ?>

	<p class="brand"><?php echo implode( ', ', wp_list_pluck( $brands, 'name' ) ); ?></p>

	<?php
endif;

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
