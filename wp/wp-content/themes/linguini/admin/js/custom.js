jQuery(document).ready(function(){
  jQuery( "#gp-tabs" ).tabs({
		cookie: { expires: 1 },
		fx: { opacity: 'toggle', duration: 200 }
	});
	jQuery(".picker").miniColors({
		change: function(hex, rgb) {
				jQuery("#console").prepend('HEX: ' + hex + ' (RGB: ' + rgb.r + ', ' + rgb.g + ', ' + rgb.b + ')');
		}
	});
});
jQuery(document).ready( function() {
	jQuery('#gp_message').delay(2000).fadeOut(500);
});