<?php if ( !defined('ABSPATH') ) exit; ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<link rel="profile" href="http://gmpg.org/xfn/11" />

<!--wp_head()-->
<?php wp_head(); ?>
<!--end wp_head()-->

</head>

<body <?php body_class(); ?>>
	
<?php wp_body_open(); ?>

<nav id="responsive_menu">
	<div class="overlay"></div>
	
	<div class="menu_container">
		<div class="top_bar">
			<a href="#" class="close">Close <i class="icon-close-button"></i></a>
		</div>
		
		<ul class="menu">
<?php if ( has_nav_menu('mobile') ) { ?>
			<?php wp_nav_menu( array( 'theme_location' => 'mobile', 'container' => false, 'items_wrap' => '%3$s' ) ); ?>
<?php } else if ( has_nav_menu('header') ) { ?>
			<?php wp_nav_menu( array( 'theme_location' => 'header', 'container' => false, 'items_wrap' => '%3$s' ) ); ?>
<?php } else { ?>
			<?php wp_list_pages( array( 'title_li' => false, 'depth' => 1 ) ); ?>
<?php } ?>
		</ul>
	</div>
</nav>

<div id="cookie_notice" class="hidden">
	<div class="wrap">
		<p>We use cookies and similar technologies to recognize your repeat visits and understand your Service preferences, which enables us to provide you with improved services. To learn more about cookies, including how to disable them, view our Privacy Policy. By clicking “Accept” on this banner, you consent to the use of cookies unless you have disabled them. <a href="/privacy-policy/" target="_blank">Privacy Policy</a></p>
		
		<a href="#" class="spm_button dismiss">Accept</a>
	</div>
</div>

<div class="header_container">
	<div id="announcements" class="hidden">
		<div class="wrap">
			<a href="#" aria-label="<?php _e('Close', SPM_TEXT_DOMAIN); ?>" class="close"><i class="icon-close"></i></a>
			
			<p><a href=""><span>Free Download</span> Get the Quality Culture Assessment <i class="icon-arrow-right"></i></a></p>
		</div>
	</div>
	
	<header id="header">
		<div class="wrap">
			<a id="spm_responsive_menu_button" href="#" role="button" aria-label="<?php _e( 'Menu', SPM_TEXT_DOMAIN ); ?>"><i class="icon-menu"></i></a>
			
			<div class="logo" itemprop="logo"><a itemprop="url" href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></div>
			
			<nav class="nav">
				<?php wp_nav_menu( array( 'theme_location' => 'header', 'container' => false, 'menu_class' => 'menu touchscreen_compatible', 'fallback_cb' => false, 'walker' => new SPM_Walker_Nav_Menu_Wide ) ); ?>
			</nav>
			
			<div class="button_container">
				<a href="/contact-us/" class="spm_button">Book A Free Consultation</a>
<?php
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option('active_plugins') ) ) ) {
	$count = WC()->cart->get_cart_contents_count();
?>
				<a href="<?php echo wc_get_cart_url(); ?>" title="<?php _e('View your shopping cart', SPM_TEXT_DOMAIN); ?>" class="spm_button alternate square_padding">
					<i class="icon-cart"></i> <?php if ( $count > 0 ) { ?><span class="quantity"><?php echo $count; ?></span><?php } ?>
				</a>
<?php } ?>
			</div>
		</div>
	</header>
</div>
