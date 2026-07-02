</div>

<script>
jQuery(document).ready(function($){
	$('.products-carousel').owlCarousel({
		responsive: {
			0: {items: 2},
			768: {items: 3},
			1024: {items: 4},
		},
		margin: 20,
		stagePadding: 10,
		autoplay: true,
		autoplayTimeout: 8000,
		autoplaySpeed: 1000,
		responsiveRefreshRate: 50,
		dotsEach: 1,
		nav: true,
		navText: ['<i class="icon-arrow-left">', '<i class="icon-arrow-right"></i>'],
	});
	
});
</script>
