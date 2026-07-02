<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
<?php //if ( $product->is_in_stock() ) : ?>

	<span class="ribbon in_stock"><span class="layer_2"><?php echo esc_html( __( 'In-Stock', SPM_TEXT_DOMAIN ) ); ?></span></span>

	<?php
//endif;

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
