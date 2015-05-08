<?php

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Shortcodes

// - - - - - - - - - - - - - - - - - - - - - - -

// Buttons
function button_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'size' => 'small',
		'color' => '#006ebe',
		'align' => 'left',
		'link' => '',
	), $atts ) );
	$content = do_shortcode($content);
	return '<div class="button '.esc_attr($align).' '.esc_attr($size).'"><a href="'.esc_attr($link).'" title="'.$content.'" style="background-color:'.esc_attr($color).'; border-color:'.esc_attr($color).';">'.$content.'</a></div>';
}
add_shortcode( 'button', 'button_shortcode' );
// END // Buttons

// - - - - - - - - - - - - - - - - - - - - - - -

// Columns

// | ------------- |
function full_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'align' => 'left',
	), $atts ) );
	$content = do_shortcode($content);
	return '<div class="full column align'.esc_attr($align).'">'.$content.'</div>';
}
add_shortcode( 'full', 'full_shortcode' );

// | ----- | _____ |
function one_half_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'align' => 'left',
	), $atts ) );
	$content = do_shortcode($content);
	return '<div class="one-half column align'.esc_attr($align).'">'.$content.'</div>';
}
add_shortcode( 'one_half', 'one_half_shortcode' );

// | _____ | ----- |
function one_half_last_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'align' => 'left',
	), $atts ) );
	$content = do_shortcode($content);
	return '<div class="one-half last column align'.esc_attr($align).'">'.$content.'</div><br class="clear" />';
}
add_shortcode( 'one_half_last', 'one_half_last_shortcode' );

// | --- | | ______ |
function one_third_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'align' => 'left',
	), $atts ) );
	$content = do_shortcode($content);
	return '<div class="one-third column align'.esc_attr($align).'">'.$content.'</div>';
}
add_shortcode( 'one_third', 'one_third_shortcode' );

// | ___ | | ------ |
function two_third_last_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'align' => 'left',
	), $atts ) );
	$content = do_shortcode($content);
	return '<div class="two-third column last align'.esc_attr($align).'">'.$content.'</div><br class="clear" />';
}
add_shortcode( 'two_third_last', 'two_third_last_shortcode' );

// | ______ | | --- |
function one_third_last_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'align' => 'left',
	), $atts ) );
	$content = do_shortcode($content);
	return '<div class="one-third column last align'.esc_attr($align).'">'.$content.'</div><br class="clear" />';
}
add_shortcode( 'one_third_last', 'one_third_last_shortcode' );

// | ------ | | ___ |
function two_third_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'align' => 'left',
	), $atts ) );
	$content = do_shortcode($content);
	return '<div class="two-third column align'.esc_attr($align).'">'.$content.'</div>';
}
add_shortcode( 'two_third', 'two_third_shortcode' );
// END // Columns

// - - - - - - - - - - - - - - - - - - - - - - -

// List
function list_shortcode( $atts, $content = null ) {
	$content = do_shortcode($content);
	return '<ul class="list">'.$content.'</ul>';
}
add_shortcode( 'list', 'list_shortcode' );

function list_item_shortcode( $atts, $content = null ) {
	$content = do_shortcode($content);
	return '<li>'.$content.'</li>';
}
add_shortcode( 'list_item', 'list_item_shortcode' );
// END // List

// - - - - - - - - - - - - - - - - - - - - - - -

// Paragraph
function paragraph_shortcode( $atts, $content = null ) {
	$content = do_shortcode($content);
	return '<p>'.$content.'</p>';
}
add_shortcode( 'p', 'paragraph_shortcode' );
// END // Paragraph

// - - - - - - - - - - - - - - - - - - - - - - -

// Paragraph - Featured
function featured_paragraph_shortcode( $atts, $content = null ) {
	$content = do_shortcode($content);
	return '<p class="featured">'.$content.'</p>';
}
add_shortcode( 'featured_paragraph', 'featured_paragraph_shortcode' );
// END // Paragraph - Featured

// - - - - - - - - - - - - - - - - - - - - - - -

// Blockquote
function blockquote_shortcode( $atts, $content = null ) {
	$content = do_shortcode($content);
	return '<blockquote>'.$content.'</blockquote>';
}
add_shortcode( 'blockquote', 'blockquote_shortcode' );
// END // Blockquote

// - - - - - - - - - - - - - - - - - - - - - - -

// Code
function code_shortcode( $atts, $content = null ) {
	$content = do_shortcode($content);
	return '<pre>'.$content.'</pre>';
}
add_shortcode( 'code', 'code_shortcode' );
// END // Code

// - - - - - - - - - - - - - - - - - - - - - - -

// Callout Box
function callout_box_shortcode( $atts, $content = null ) {
	$content = do_shortcode($content);
	return '<div class="callout-box">'.$content.'</div>';
}
add_shortcode( 'callout_box', 'callout_box_shortcode' );
// END // Callout Box

// - - - - - - - - - - - - - - - - - - - - - - -

// Dividers
function divider_shortcode( $atts ) {
	return '<div class="divider"></div>';
}
add_shortcode( 'divider', 'divider_shortcode' );

function divider_dotted_shortcode( $atts ) {
	return '<div class="divider-dotted"></div>';
}
add_shortcode( 'divider_dotted', 'divider_dotted_shortcode' );
// END // Dividers

// - - - - - - - - - - - - - - - - - - - - - - -

// Images
function image_shortcode( $atts ) {
	extract( shortcode_atts( array(
		'src' => '',
		'align' => 'left',
		'alt' => 'Image',
	), $atts ) );
	return '<img class="image '.esc_attr($align).'" src="'.esc_attr($src).'" alt="'.esc_attr($alt).'" />';
}
add_shortcode( 'image', 'image_shortcode' );
// END // Images

// - - - - - - - - - - - - - - - - - - - - - - -

// Lightbox Images
function lightbox_image_shortcode( $atts ) {
	extract( shortcode_atts( array(
		'src' => '',
		'bigimage' => '',
		'align' => 'left',
		'alt' => 'Image',
	), $atts ) );
	return '<a href="'.esc_attr($bigimage).'" rel="prettyPhoto"><img class="image '.esc_attr($align).'" src="'.esc_attr($src).'" alt="'.esc_attr($alt).'" /></a>';
}
add_shortcode( 'lightbox_image', 'lightbox_image_shortcode' );
// END // Lightbox Images

// - - - - - - - - - - - - - - - - - - - - - - -

// Alerts
// Alert - White
function alert_white_shortcode( $atts, $content = null ) {
	$content = do_shortcode($content);
	return '<div class="alert-box white round">'.$content.'</div>';
}
add_shortcode( 'alert_white', 'alert_white_shortcode' );
// END // Alert - White

// Alert - Yellow
function alert_yellow_shortcode( $atts, $content = null ) {
	$content = do_shortcode($content);
	return '<div class="alert-box yellow round">'.$content.'</div>';
}
add_shortcode( 'alert_yellow', 'alert_yellow_shortcode' );
// END // Alert - Yellow

// Alert - Green
function alert_green_shortcode( $atts, $content = null ) {
	$content = do_shortcode($content);
	return '<div class="alert-box green round">'.$content.'</div>';
}
add_shortcode( 'alert_green', 'alert_green_shortcode' );
// END // Alert - Green

// Alert - Red
function alert_red_shortcode( $atts, $content = null ) {
	$content = do_shortcode($content);
	return '<div class="alert-box red round">'.$content.'</div>';
}
add_shortcode( 'alert_red', 'alert_red_shortcode' );
// END // Alert - Red

// Alert - Blue
function alert_blue_shortcode( $atts, $content = null ) {
	$content = do_shortcode($content);
	return '<div class="alert-box blue round">'.$content.'</div>';
}
add_shortcode( 'alert_blue', 'alert_blue_shortcode' );
// END // Alert - Blue

// Alert - Custom
function alert_custom_shortcode( $atts, $content = null ) {
	$content = do_shortcode($content);
	return '<div class="alert-box custom round">'.$content.'</div>';
}
add_shortcode( 'alert_custom', 'alert_custom_shortcode' );
// END // Alert - Custom
// END // Alerts

// - - - - - - - - - - - - - - - - - - - - - - -

// END // Shortcodes

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

?>