<?php 

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Theme Options
$name_short =  "gp";

$options = array (

array( "type" => "start-tab" ),
array( "type" => "open" ),

array(
	"name" => __('Responsive Theme', 'gp'),
	"type" => "heading"
),
array(  
	"name" => __('Want to use the responsive theme features?', 'gp'),
	"desc" => __('If you want to use the responsive theme features (displaying for mobile devices), select Yes.', 'gp'),
	"id" => $name_short."_responsive",
	"options" => array('Yes', 'No'),
	"std" => "",
	"type" => "select"
),
array(
	"name" => "Header",
	"type" => "heading"
),
array(  
	"name" => __('Logo Image Upload', 'gp'),
	"desc" => __('Upload a logo image or specify absolute path to your logo image (Upload an image and then click "Insert into Post".) <strong>Maximum width: 300px. Maximum height: 190px.</strong>', 'gp'),
	"id" => $name_short."_logo_image",
	"std" => "",
	"type" => "upload"
),
array(  
	"name" => __('Colors', 'gp'),
	"type" => "heading"
),
array(  
	"name" => __('Primary Color', 'gp'),
	"desc" => __('Select primary color of the theme. Default: #d2552d', 'gp'),
	"id" => $name_short."_primary_color",
	"std" => "#d2552d",
	"type" => "picker"
),
array(  
	"name" => __('Background', 'gp'),
	"type" => "heading"
),
array(  
	"name" => __('Background Color', 'gp'),
	"desc" => __('Select background color. Default: #2d1912', 'gp'),
	"id" => $name_short."_bg_color",
	"std" => "#2d1912",
	"type" => "picker"
),
array(
	"name" => __('Default Meta', 'gp'),
	"type" => "heading"
),
array(  
	"name" => __('Default Meta Keywords', 'gp'),
	"desc" => __('Add default meta keywords. Separate keywords with commas.', 'gp'),
	"id" => $name_short."_meta_keywords",
	"std" => "",
	"type" => "textarea"
),
array(  
	"name" => __('Default Meta Description', 'gp'),
	"desc" => __('Add default meta description.', 'gp'),
	"id" => $name_short."_meta_description",
	"std" => "",
	"type" => "textarea"
),
array(
	"name" => __('Custom CSS', 'gp'),
	"type" => "heading"
),
array(  
	"name" => __('Custom CSS', 'gp'),
	"desc" => __('Here you can specify a custom CSS section of code. This code will be given priority over other CSS styles.', 'gp'),
	"id" => $name_short."_custom_css",
	"std" => "",
	"type" => "textarea"
),

array( "type" => "close" ),
array( "type" => "end-tab" ),

array( "type" => "start-tab" ),
array( "type" => "open" ),

array(
	"name" => __('Slideshow Settings', 'gp'),
	"type" => "heading"
),
array(  
	"name" => __('Slideshow Effect', 'gp'),
	"desc" => __('Choose a effect for changing slides.', 'gp'),
	"id" => $name_short."_slideshow_effect",
	"options" => array('fade', 'slideTop', 'slideRight', 'slideBottom', 'slideLeft', 'carouselRight', 'carouselLeft', 'none'),
	"std" => "",
	"type" => "select"
),
array(  
	"name" => __('Slideshow Pause time', 'gp'),
	"desc" => __('Fill how long will be slide visible (in miliseconds). Default is 8000.', 'gp'),
	"id" => $name_short."_slideshow_time_pause",
	"std" => "8000",
	"type" => "text"
),
array(  
	"name" => __('Time of Transition', 'gp'),
	"desc" => __('Fill how fast will be slide changed (in miliseconds). Default is 800.', 'gp'),
	"id" => $name_short."_slideshow_time_transition",
	"std" => "800",
	"type" => "text"
),

array( "type" => "close" ),
array( "type" => "end-tab" ),

array( "type" => "start-tab" ),
array( "type" => "open" ),

array(
	"name" => __('Food Menu (Foods)', 'gp'),
	"type" => "heading"
),
array(   
	"name" => __('Display Food Item Title as Link?', 'gp'),
	"id" => $name_short."_menu_food_link",
	"desc" => __('Please select if you want to display item title as link to detail page.', 'gp'),
	"options" => array('Yes', 'No'),
	"std" => "Yes",
	"type" => "select"
),
array(   
	"name" => __('Display Food Item Image as Link to Large Image?', 'gp'),
	"desc" => __('Please select if you want to display item image as link to large image (lightbox).', 'gp'),
	"id" => $name_short."_menu_food_link_image",
	"options" => array('Yes', 'No'),
	"std" => "Yes",
	"type" => "select"
),
array(
	"name" => __('Lunch Menu (Foods - Lunch)', 'gp'),
	"type" => "heading"
),
array(   
	"name" => __('Display Lunch Item Title as Link?', 'gp'),
	"id" => $name_short."_menu_lunch_link",
	"desc" => __('Please select if you want to display item title as link to detail page.', 'gp'),
	"options" => array('Yes', 'No'),
	"std" => "Yes",
	"type" => "select"
),
array(   
	"name" => __('Display Lunch Item Image as Link to Large Image?', 'gp'),
	"desc" => __('Please select if you want to display item image as link to large image (lightbox).', 'gp'),
	"id" => $name_short."_menu_lunch_link_image",
	"options" => array('Yes', 'No'),
	"std" => "Yes",
	"type" => "select"
),
array(
	"name" => __('Dinner Menu (Foods - Dinner)', 'gp'),
	"type" => "heading"
),
array(   
	"name" => __('Display Dinner Item Title as Link?', 'gp'),
	"id" => $name_short."_menu_dinner_link",
	"desc" => __('Please select if you want to display item title as link to detail page.', 'gp'),
	"options" => array('Yes', 'No'),
	"std" => "Yes",
	"type" => "select"
),
array(   
	"name" => __('Display Dinner Item Image as Link to Large Image?', 'gp'),
	"desc" => __('Please select if you want to display item image as link to large image (lightbox).', 'gp'),
	"id" => $name_short."_menu_dinner_link_image",
	"options" => array('Yes', 'No'),
	"std" => "Yes",
	"type" => "select"
),
array(
	"name" => __('Drink Menu (Drinks)', 'gp'),
	"type" => "heading"
),
array(   
	"name" => __('Show Drink Item Title as Link?', 'gp'),
	"desc" => __('Please select if you want to show item title as link to detail page.', 'gp'),
	"id" => $name_short."_menu_drink_link",
	"options" => array('Yes', 'No'),
	"std" => "Yes",
	"type" => "select"
),
array(   
	"name" => __('Show Drink Item Image as Link to Large Image?', 'gp'),
	"desc" => __('Please select if you want to show item image as link to large image (lightbox).', 'gp'),
	"id" => $name_short."_menu_drink_link_image",
	"options" => array('Yes', 'No'),
	"std" => "Yes",
	"type" => "select"
),
array(
	"name" => __('Wine Menu (Drinks - Wines)', 'gp'),
	"type" => "heading"
),
array(   
	"name" => __('Show Wine Item Title as Link?', 'gp'),
	"desc" => __('Please select if you want to show item title as link to detail page.', 'gp'),
	"id" => $name_short."_menu_wine_link",
	"options" => array('Yes', 'No'),
	"std" => "Yes",
	"type" => "select"
),
array(   
	"name" => __('Show Wine Item Image as Link to Large Image?', 'gp'),
	"desc" => __('Please select if you want to show item image as link to large image (lightbox).', 'gp'),
	"id" => $name_short."_menu_wine_link_image",
	"options" => array('Yes', 'No'),
	"std" => "Yes",
	"type" => "select"
),

array( "type" => "close" ),
array( "type" => "end-tab" ),

array( "type" => "start-tab" ),
array( "type" => "open" ),

array(
	"name" => __('Social Profiles', 'gp'),
	"type" => "heading"
),
array(   
	"name" => __('Twitter Account', 'gp'),
	"desc" => __('Fill a full path to your Twitter account. If you leave the field blank icon will be hidden.', 'gp'),
	"id" => $name_short."_twitter",
	"std" => "",
	"type" => "text"
),
array( 
	"name" => __('Facebook Account', 'gp'),
	"desc" => __('Fill a full path to your Facebook account. If you leave the field blank icon will be hidden.', 'gp'),
	"id" => $name_short."_facebook",
	"std" => "",
	"type" => "text"
),   
array( 
	"name" => __('Linked In Account', 'gp'),
	"desc" => __('Fill a full path to your Linked In account. If you leave the field blank icon will be hidden.', 'gp'),
	"id" => $name_short."_linkedin",
	"std" => "",
	"type" => "text"
),
array( 
	"name" => __('Google+ Account', 'gp'),
	"desc" => __('Fill a full path to your Google+ account. If you leave the field blank icon will be hidden.', 'gp'),
	"id" => $name_short."_googleplus",
	"std" => "",
	"type" => "text"
),
array( 
	"name" => __('Flickr Account', 'gp'),
	"desc" => __('Fill a full path to your Flickr account. If you leave the field blank icon will be hidden.', 'gp'),
	"id" => $name_short."_flickr",
	"std" => "",
	"type" => "text"
),
array( 
	"name" => __('Vimeo Account', 'gp'),
	"desc" => __('Fill a full path to your Vimeo account. If you leave the field blank icon will be hidden.', 'gp'),
	"id" => $name_short."_vimeo",
	"std" => "",
	"type" => "text"
),
array(   
	"name" => __('Show RSS Icon in the Topbar?', 'gp'),
	"desc" => __('Please select if you want to show RSS icon in the topbar.', 'gp'),
	"id" => $name_short."_rss_topbar",
	"options" => array('Yes', 'No'),
	"std" => "Yes",
	"type" => "select"
),
array(   
	"name" => __('Show RSS Icon in the Footer?', 'gp'),
	"desc" => __('Please select if you want to show RSS icon in the footer.', 'gp'),
	"id" => $name_short."_rss_footer",
	"options" => array('Yes', 'No'),
	"std" => "Yes",
	"type" => "select"
),

array( "type" => "close" ),
array( "type" => "end-tab" ),

array( "type" => "start-tab" ),
array( "type" => "open" ),

array(
	"name" => __('Contact Form', 'gp'),
	"type" => "heading"
),
array( 
	"name" => __('Email for the Receiving Contact Emails', 'gp'),
	"desc" => __('Fill your email address in this format: john@doe.com', 'gp'),
	"id" => $name_short."_form_contact_email",
	"std" => "",
	"type" => "text"
),
array( 
	"name" => __('Subject of the Received Email', 'gp'),
	"desc" => __('Fill the subject of the email. Something as: Name of the site - Contact form.', 'gp'),
	"id" => $name_short."_form_contact_subject",
	"std" => "",
	"type" => "text"
),
array(
	"name" => __('Reservations Form', 'gp'),
	"type" => "heading"
),
array( 
	"name" => __('Email for the Receiving Reservation Emails', 'gp'),
	"desc" => __('Fill your email address in this format: john@doe.com', 'gp'),
	"id" => $name_short."_form_reservations_email",
	"std" => "",
	"type" => "text"
),
array( 
	"name" => __('Subject of the Received Email', 'gp'),
	"desc" => __('Fill the subject of the email. Something as: Name of the site - Reservation', 'gp'),
	"id" => $name_short."_form_reservations_subject",
	"std" => "",
	"type" => "text"
),

array( "type" => "close" ),
array( "type" => "end-tab" ),

array( "type" => "start-tab" ),
array( "type" => "open" ),

array(
	"name" => __('Tracking Code', 'gp'),
	"type" => "heading"
),
array(  
	"name" => __('Tracking Code', 'gp'),
	"desc" => __('Add your tracking code from website analytics service.', 'gp'),
	"id" => $name_short."_googleanalytics",
	"std" => "",
	"type" => "bigtextarea"
),

array( "type" => "close" ),
array( "type" => "end-tab" )

);
// END // Theme Options

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

?>