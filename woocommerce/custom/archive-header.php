<?php
/**
 * Product archive header: teal eyebrow + serif heading, centered above the grid.
 *
 * The heading text is driven by the Shop page title (editable in wp-admin), so
 * content editors control it exactly like every other page on the site.
 *
 * @package WooCommerce\Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$eyebrow = apply_filters( 'spm_shop_archive_eyebrow', __( 'Products', SPM_TEXT_DOMAIN ) );
$heading = apply_filters( 'spm_shop_archive_heading', woocommerce_page_title( false ) );

?>
<header class="shop_archive_header">
<?php if ( $eyebrow ) : ?>
	<p class="pre_title"><?php echo esc_html( $eyebrow ); ?></p>
<?php endif; ?>

<?php if ( $heading ) : ?>
	<h1 class="page_title"><?php echo wp_kses_post( $heading ); ?></h1>
<?php endif; ?>
</header>
