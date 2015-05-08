// Hovers
jQuery(document).ready(function() {
	jQuery('.image-overlay a').hover(function() { jQuery(this).find('span').stop(false,true).fadeIn(400); },
    function() { jQuery(this).find('span').stop(false,true).fadeOut(200); });
});
// Pretty Photo
jQuery(document).ready(function(){ jQuery("a[data-rel^='prettyPhoto']").prettyPhoto(); });
jQuery(document).ready(function(){ jQuery("a[rel^='prettyPhoto']").prettyPhoto(); });

// Scroll
jQuery(document).ready(function() {
	jQuery(".scroll").click(function(event){		
		event.preventDefault();
		jQuery('html,body').animate({scrollTop: jQuery(this.hash).offset().top}, 400);
	});
});

// Fixed Navigation
jQuery(document).ready(function() {
	jQuery('.navigation-menucard').stickySidebar({ 
		speed: 400,
		padding: 0,
		constrain: true
	});
});

// Dropdown Navigation
jQuery(document).ready(function() {
								
	jQuery('.select').click(function() {
		var submenu = jQuery('nav.navigation-mobile .menu');
		if (submenu.is(":visible")) {
			submenu.fadeOut(300);
		} else {
			submenu.fadeIn(300);
		}
	});
	var submenu_active = false;
	 
	jQuery('nav.navigation-mobile .menu').mouseenter(function() {
		submenu_active = true;
	});
	 
	jQuery('nav.navigation-mobile .menu').mouseleave(function() {
		submenu_active = true;
		setTimeout(function() { if (submenu_active === false) jQuery('nav.navigation-mobile .menu').fadeOut(); }, 400);
	});
	
});