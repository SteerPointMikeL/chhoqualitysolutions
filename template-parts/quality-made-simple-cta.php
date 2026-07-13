<?php
/**
 * "Quality Made Simple" consultation CTA card.
 *
 * Reusable across the site (currently used as the single-product sidebar card).
 * Pass overrides via the $args array when loading with get_template_part().
 *
 * @package chhoqualitysolutions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$defaults = array(
	'title'          => __( 'Quality Made Simple', SPM_TEXT_DOMAIN ),
	'content'        => __( 'Not sure where your QMS stands? Start with a free 30-minute consultation. No pressure, just a clear next step.', SPM_TEXT_DOMAIN ),
	'consult_text'   => __( 'Book Free Consult', SPM_TEXT_DOMAIN ),
	'consult_url'    => '/contact-us/',
	'assessment_text' => __( 'Get the Free Assessment', SPM_TEXT_DOMAIN ),
	'assessment_url' => '/contact-us/',
	'phone'          => '219-224-5300',
);

$args = wp_parse_args( isset( $args ) ? (array) $args : array(), $defaults );

?>
<div class="quality_made_simple_cta">
<?php if ( ! empty( $args['title'] ) ) : ?>
	<p class="title"><?php echo esc_html( $args['title'] ); ?></p>
<?php endif; ?>

<?php if ( ! empty( $args['content'] ) ) : ?>
	<p class="content"><?php echo esc_html( $args['content'] ); ?></p>
<?php endif; ?>

	<p class="button_container">
<?php if ( ! empty( $args['consult_text'] ) ) : ?>
		<a href="<?php echo esc_url( $args['consult_url'] ); ?>" class="spm_button"><?php echo esc_html( $args['consult_text'] ); ?></a>
<?php endif; ?>

<?php if ( ! empty( $args['assessment_text'] ) ) : ?>
		<a href="<?php echo esc_url( $args['assessment_url'] ); ?>" class="spm_button green_button"><?php echo esc_html( $args['assessment_text'] ); ?></a>
<?php endif; ?>
	</p>

<?php if ( ! empty( $args['phone'] ) ) : ?>
	<p class="phone"><a href="<?php echo esc_attr( 'tel:+1-' . preg_replace( '/[^0-9]/', '-', $args['phone'] ) ); ?>"><i class="icon-phone"></i> <?php echo esc_html( $args['phone'] ); ?></a></p>
<?php endif; ?>
</div>
