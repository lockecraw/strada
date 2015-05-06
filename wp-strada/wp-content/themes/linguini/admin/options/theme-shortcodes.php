<?php

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Admin Shortcode Buttons
add_action('init', 'add_button'); 
function add_button() {
	add_filter('mce_external_plugins', 'add_plugin');
	add_filter('mce_buttons', 'register_button');
}
function register_button($buttons) {
	array_push($buttons, "featured_paragraph");
	array_push($buttons, "divider");
	array_push($buttons, "divider_dotted");
	array_push($buttons, "button_small");
	array_push($buttons, "button_medium");
	array_push($buttons, "button_large");
	array_push($buttons, "blockquote");
	array_push($buttons, "code");
	array_push($buttons, "image");
	array_push($buttons, "lightbox_image");
	array_push($buttons, "alert_white");
	array_push($buttons, "alert_yellow");
	array_push($buttons, "alert_green");
	array_push($buttons, "alert_red");
	array_push($buttons, "alert_blue");
	array_push($buttons, "alert_custom");
	return $buttons;
}
function add_plugin($plugin_array) {
	$plugin_url = get_template_directory_uri().'/admin/js/custom-short-codes.js';
	$plugin_array['featured_paragraph'] = $plugin_url;
	$plugin_array['divider'] = $plugin_url;
	$plugin_array['divider_dotted'] = $plugin_url;
	$plugin_array['button_small'] = $plugin_url;
	$plugin_array['button_medium'] = $plugin_url;
	$plugin_array['button_large'] = $plugin_url;
	$plugin_array['blockquote'] = $plugin_url;
	$plugin_array['code'] = $plugin_url;
	$plugin_array['image'] = $plugin_url;
	$plugin_array['lightbox_image'] = $plugin_url;
	$plugin_array['alert_white'] = $plugin_url;
	$plugin_array['alert_yellow'] = $plugin_url;
	$plugin_array['alert_green'] = $plugin_url;
	$plugin_array['alert_red'] = $plugin_url;
	$plugin_array['alert_blue'] = $plugin_url;
	$plugin_array['alert_custom'] = $plugin_url;
	return $plugin_array;
}
// END // Admin Shortcode Buttons

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

?>