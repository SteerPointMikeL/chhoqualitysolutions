(function($) {
	
	/** Touchscreen compatibility for dropdown menus */
	if ( 'ontouchstart' in window || navigator.maxTouchPoints > 0 || navigator.msMaxTouchPoints > 0 ) {
		$('.touchscreen_compatible > li > a').on('click', function() {
			var allLis = $('.touchscreen_compatible > li');
			var currentLi = $(this).parent();
			
			// Follow the link if it is already selected or has no child menu
			if ( currentLi.hasClass('touchscreen_selected') || !currentLi.children('ul').length ) {
				return;
			} else {
				allLis.removeClass('touchscreen_selected');
				currentLi.addClass('touchscreen_selected');
			}
			
			return false;
		});
	}
	
	
	/** Mobile device menu */
	$body = $('body');
	$responsiveMenu = $('#responsive_menu');
	
	$('#spm_responsive_menu_button').click(function(event) {
		event.preventDefault();
		
		$body.toggleClass('menu_revealed');
	});
	
	$('.close, .overlay', $responsiveMenu).click(function(event) {
		event.preventDefault();
		
		$body.removeClass('menu_revealed');
	});
	
	$('.menu > .menu-item-has-children > a', $responsiveMenu).click(function(event) {
		var $li = $(this).parent();
		
		if ( $li.hasClass('extended') ) { // sub-menu already revealed, follow link normally
			if ( !$(this).attr('href') || $(this).attr('href') == '#' ) { // no link, retract menu instead
				event.preventDefault();
				
				$li.removeClass('extended');
			}
			
			return;
		}
		
		event.preventDefault();
		
		$li.addClass('extended').siblings().removeClass('extended');
	});
	
	
	/** Cookie Notice */
	var $cookieNotice = $('#cookie_notice');
	
	if ( Cookies.get('cookieNoticeDismissed') != 'true' )
		$cookieNotice.removeClass('hidden');

	$('.dismiss', $cookieNotice).click(function(event) {
		event.preventDefault();
		
		Cookies.set('cookieNoticeDismissed', 'true');
		$cookieNotice.addClass('hidden');
	});
	
	
	/** Announcements bar */
	var $announcements = $('#announcements');
	
	if ( Cookies.get('announcementsDismissed') != 'true' )
		$announcements.removeClass('hidden');

	$('.close', $announcements).click(function(event) {
		event.preventDefault();
		
		Cookies.set('announcementsDismissed', 'true', {expires: 1});
		$announcements.addClass('hidden');
	});
	
	
	/** jQuery Modal */
	$.modal.defaults.fadeDelay = null;
	$.modal.defaults.fadeDuration = 150;
	
	
	/** Initialize WOW.js */
	new WOW({
		mobile: false
	}).init();
	
})(jQuery);