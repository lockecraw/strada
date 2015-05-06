<?php

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Register Widgets
// - - - - - - - - - - - - - - - - - - - - - - -

function register_widgets() {
	register_widget('widget_about_box');
	register_widget('widget_tweets');
	register_widget('widget_contact');
	register_widget('widget_opening_hours');
	register_widget('widget_testimonial');
	register_widget('widget_reservation');
}
add_action( 'widgets_init', 'register_widgets' );

// - - - - - - - - - - - - - - - - - - - - - - -
// END // Register Widgets

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Unregister Widgets
// - - - - - - - - - - - - - - - - - - - - - - -

function unregister_wp_widgets(){
  unregister_widget('WP_Widget_Calendar');
  unregister_widget('WP_Widget_Recent_Comments');
  unregister_widget('WP_Widget_Pages');
  unregister_widget('WP_Widget_Links');
  unregister_widget('WP_Widget_Custom_Menu');
}
add_action('widgets_init', 'unregister_wp_widgets', 1);

// - - - - - - - - - - - - - - - - - - - - - - -
// END // Unregister Widgets

?>
