<?php 

/*
GPanel by Grand Pixels
Version: 2.3
Author: Pavel Richter of Grand Pixels
Author URI: http://grandpixels.com
License: GNU General Public License version 3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Scripts
function gp_backend_scripts() {

	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');

	wp_register_script('gp_upload', get_template_directory_uri() .'/admin/js/upload.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('gp_upload');

	wp_register_script('gp_picker', get_template_directory_uri() .'/admin/js/picker.js', 'jquery');
	wp_enqueue_script('gp_picker');

	wp_register_script('gp_cookie', get_template_directory_uri() .'/admin/js/cookie.js', array('jquery'));
	wp_enqueue_script('gp_cookie');

	wp_register_script('gp_custom', get_template_directory_uri() .'/admin/js/custom.js', array('jquery'));
	wp_enqueue_script('gp_custom');

}
add_action('admin_print_scripts', 'gp_backend_scripts');
// END // Scripts

// Styles
function gp_backend_styles() {

	wp_enqueue_style('thickbox');
	wp_enqueue_style('gp_style', get_template_directory_uri() .'/admin/css/style.css');
	wp_enqueue_style('gp_metabox_style', get_template_directory_uri() .'/admin/css/metabox.css');
	
}
add_action('admin_print_styles', 'gp_backend_styles');
// END // Styles

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Load Custom Post Types
// - - - - - - - - - - - - - - - - - - - - - - -

// Slides
include("functions/cpt/cpt-slides.php");
// END // Slides

// - - - - - - - - - - - - - - - - - - - - - - -

// Callout Blocks
include("functions/cpt/cpt-callouts.php");
// END // Callout Blocks

// - - - - - - - - - - - - - - - - - - - - - - -


// Foods - Lunch
include("functions/cpt/cpt-menu-lunch.php");
// END // Foods - Lunch

// - - - - - - - - - - - - - - - - - - - - - - -

// Foods - Bunch
include("functions/cpt/cpt-menu-brunch.php");
// END // Foods - Bunch

// - - - - - - - - - - - - - - - - - - - - - - -

// Foods - Dinner
include("functions/cpt/cpt-menu-dinner.php");
// END // Foods - Dinner

// - - - - - - - - - - - - - - - - - - - - - - -

// Foods - Sunday
include("functions/cpt/cpt-menu-sunday.php");
// END // Foods - Sunday

// - - - - - - - - - - - - - - - - - - - - - - -

// Foods - Catering
include("functions/cpt/cpt-menu-catering.php");
// END // Foods - Sunday

// - - - - - - - - - - - - - - - - - - - - - - -

// Foods - Childerns
include("functions/cpt/cpt-menu-childrens.php");
// END // Childerns

// - - - - - - - - - - - - - - - - - - - - - - -

// Drinks - Wine
include("functions/cpt/cpt-menu-wine.php");
// END // Drinks - Wine

// - - - - - - - - - - - - - - - - - - - - - - -

// Foods - Dessert
include("functions/cpt/cpt-menu-dessert.php");
// END // Foods - Dessert

// - - - - - - - - - - - - - - - - - - - - - - -


// Photogalleries
include("functions/cpt/cpt-photos.php");
// END // Photogalleries

// - - - - - - - - - - - - - - - - - - - - - - -

// Pages
include("functions/cpt/cpt-pages.php");
// END // Pages

// - - - - - - - - - - - - - - - - - - - - - - -

// Posts
include("functions/cpt/cpt-posts.php");
// END // Posts

// - - - - - - - - - - - - - - - - - - - - - - -
// END // Load Custom Post Types

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Load Theme Options
include("options/theme-options.php");
// END // Load Theme Options

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Load Theme Admin
include("options/theme-admin.php");
// END // Load Theme Admin

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Load Shortcodes
// - - - - - - - - - - - - - - - - - - - - - - -

// Load Theme Shortcode Buttons
include("options/theme-shortcodes.php");
// END // Load Theme Shortcode Buttons

// - - - - - - - - - - - - - - - - - - - - - - -

// Load Theme Shortcodes
include("functions/shortcodes/shortcodes.php");
// END // Load Theme Shortcodes

// - - - - - - - - - - - - - - - - - - - - - - -
// END // Load Shortcodes

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Load Theme Widgets
include("options/theme-widgets.php");
// END // Load Theme Widgets

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Load Widgets
// - - - - - - - - - - - - - - - - - - - - - - -

// Widget: About Box
include("functions/widgets/widget-aboutbox.php");
// END // Widget: About Box

// - - - - - - - - - - - - - - - - - - - - - - -

// Widget: Contact
include("functions/widgets/widget-contact.php");
// END // Widget: Contact

// - - - - - - - - - - - - - - - - - - - - - - -

// Widget: Opening Hours
include("functions/widgets/widget-openinghours.php");
// END // Widget: Opening Hours

// - - - - - - - - - - - - - - - - - - - - - - -

// Widget: Reservation
include("functions/widgets/widget-reservation.php");
// END // Widget: Reservation

// - - - - - - - - - - - - - - - - - - - - - - -

// Widget: Testimonial
include("functions/widgets/widget-testimonial.php");
// END // Widget: Testimonial

// - - - - - - - - - - - - - - - - - - - - - - -

// Widget: Tweets
include("functions/widgets/widget-tweets.php");
// END // Widget: Tweets

// - - - - - - - - - - - - - - - - - - - - - - -
// END // Load Widgets

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// END // GPanel

?>