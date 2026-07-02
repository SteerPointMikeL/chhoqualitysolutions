<?php

/* $items[] = array(
	'label'   => __( 'Home', SPM_TEXT_DOMAIN ),
	'href'    => esc_url( home_url( '/' ) ),
	'current' => false,
); */

$post_id = get_queried_object_id();
if ( $post_id ) {
	$ancestors = array_reverse( get_post_ancestors( $post_id ) );
	foreach ( $ancestors as $ancestor_id ) {
		$items[] = array(
			'label'   => esc_html( get_the_title( $ancestor_id ) ),
			'href'    => esc_url( get_permalink( $ancestor_id ) ),
			'current' => false,
		);
	}
	$items[] = array(
		'label'   => esc_html( get_the_title( $post_id ) ),
		'href'    => '',
		'current' => true,
	);
}

if ( count( $items ) < 2 ) return;

?>

<div class="hero_breadcrumbs">
	<div class="wrap">
		<nav class="breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumbs', SPM_TEXT_DOMAIN ); ?>">
			<ul>
<?php foreach ( $items as $i => $item ) { ?>
				<li<?php if ( !empty( $item['current'] ) ) { ?> class="current"<?php } ?>>
<?php if ( !empty( $item['href'] ) && !$item['current'] ) { ?>
					<a href="<?php echo esc_url( $item['href'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a>
<?php } else { ?>
					<span aria-current="<?php echo $item['current'] ? 'page' : 'false'; ?>"><?php echo esc_html( $item['label'] ); ?></span>
<?php } ?>
<?php if ( $i !== count( $items ) - 1 ) { ?>
					<span aria-hidden="true">&gt;</span>
<?php } ?>
				</li>
<?php } ?>
			</ul>
		</nav>
	</div>	
</div>
