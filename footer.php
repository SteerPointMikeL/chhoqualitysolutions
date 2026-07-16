<?php

wp_enqueue_style( 'jquery-modal' );
wp_enqueue_script( 'jquery-modal' );

?>

<div id="newsletter">
	<div class="wrap">
		<div class="columns columns-2 columns-top_level">
			<div class="column column-content">
				<p class="section_title">Stay Connected with Our Team</p>
				
				<p>Join our email list for practical business advice, industry trends, and proven strategies that help organizations improve performance and achieve sustainable growth.</p>
			</div>
			
			<div class="column column-form">
				<div class="dummy_form">
					<input type="email" placeholder="Your Email Address" />
					
					<input type="submit" value="Subscribe" />
					
					<a href="#newsletter_sign_up" class="full_coverage_link" rel="modal:open">Open Form</a>
					
					<div id="newsletter_sign_up" class="modal">
						
						<div class="_form_11"></div>
						<script src="https://chhoqualitysolutions.activehosted.com/f/embed.php?id=11" charset="utf-8"></script>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<footer id="footer">
	<div class="wrap">
		<div class="columns columns-3 columns-top_level">
			<div class="column column-1"><div class="layer_2">
				<p style="margin-bottom: 25px;"><img src="<?php echo get_template_directory_uri(); ?>/images/footer-logo.webp" alt="" width="339" height="182" /></p>
				
				<p class="address">5164 E 81st Ave, #222 &bull; Merrillville, IN, 46410</p>
			</div></div>
			
			<div class="column column-2"><div class="layer_2">
				<?php wp_nav_menu( array( 'theme_location' => 'footer', 'depth' => 1, 'container' => false, 'menu_class' => 'menu touchscreen_compatible', 'fallback_cb' => null) ); ?>
			</div></div>
			
			<div class="column column-3"><div class="layer_2">
				<p class="button_container">
					<a href="/contact-us/" class="spm_button">Book A Free Consultation</a>
					<a href="tel:+1-219-224-5300" class="spm_button alternate">219-224-5300</a>
				</p>
				
				<ul class="social_media">
					<li><a href="https://www.facebook.com/CHHouseOfQuality" title="Facebook" target="_blank" ><i class="icon-facebook"></i></a></li>
					<li><a href="https://www.youtube.com/@CHHouseofQuality" title="YouTube" target="_blank" ><i class="icon-youtube"></i></a></li>
					<li><a href="https://www.instagram.com/ch_house_of_quality_solutions/" title="Instagram" target="_blank" ><i class="icon-instagram"></i></a></li>
					<li><a href="https://www.linkedin.com/company/ch-house-of-quality-solutions-consulting/about/?viewAsMember=true" title="LinkedIn" target="_blank" ><i class="icon-linkedin"></i></a></li>
					<li><a href="https://twitter.com/CHHouseofQ30577" title="X (Twitter)" target="_blank" ><i class="icon-x"></i></a></li>
					<li><a href="https://www.tiktok.com/@ch_house_of_quality?lang=en" title="TikTok" target="_blank" ><i class="icon-tiktok"></i></a></li>
				</ul>
			</div></div>
		</div>
	</div>
</footer>

<?php /* <div id="sub_footer">
	<div class="wrap">		
		<p class="copyright">
			<?php printf( __('&copy; Copyright %s %s. All Rights Reserved.', SP_TEXT_DOMAIN), date( 'Y', current_time('timestamp') ), get_bloginfo('name') ); ?>
			Website Design by <a href="https://www.steerpoint.com<?php /* ?utm_source=clients&utm_medium=referral&utm_campaign=<?php echo SP_TEXT_DOMAIN; */ /* ?>" target="_blank">SteerPoint</a>
		</p>
	</div>
</div> */ ?>

<nav id="mobile_footer">
	<ul>
		<li><a href="tel:1-3178423226"><i class="icon-phone"></i> Call</a></li>
		<li><a href="/contact-us/" class="alternate"><i class="icon-envelope"></i> Contact Us</a></li>
	</ul>
</nav>

<!-- wp_footer() -->
<?php wp_footer(); ?>
<!-- end wp_footer() -->

<?php //get_template_part('template-parts/structured_data'); ?>
	
</body>
</html>

<!-- <?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds. -->