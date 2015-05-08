<?php

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Custom Post Type - Photos and Photogalleries

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Register Post Type
function create_photos() {
	register_post_type('photos',
		array (
			'label' => __('Photogalleries', 'gp'),
			'singular_label' => __('Photogalleries', 'gp'),
			'labels' => array(
				'label' => __('Photogalleries', 'gp'),
				'singular_label' => __('Photogalleries', 'gp'),
				'all_items' => __('All Photos', 'gp'),
				'add_new' => __('Add New Photo', 'gp'),
				'add_new_item' => __('Add New Photo', 'gp'),
				'edit' => __('Edit Photo', 'gp'),
				'edit_item' => __('Edit Photos', 'gp'),
				'new_item' => __('New Photos', 'gp'),
				'view' => __('View Photos', 'gp'),
				'view_item' => __('View Photos', 'gp'),
				'search_items' => __('Search Photos', 'gp'),
				'not_found' => __('No Photos', 'gp'),
				'not_found_in_trash' => __('No Photos Found in Trash', 'gp'),
			),
			'public' => true,
			'show_ui' => true,
			'show_in_nav_menus' => false,
			'capability_type' => 'post',
			'hierarchical' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'photos/item', 'with_front' => false ),
			'menu_position' => 32,
			'supports' => array('title', 'thumbnail', 'comments')
			)
	);
	flush_rewrite_rules();
}
add_action('init', 'create_photos');
function add_photos(){
	add_meta_box("photos-details", __('Photos Options', 'gp'), "photos", "normal", "low");
}
add_action('admin_init', 'add_photos');
// END // Register Post Type

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Register Taxonomy
function create_photos_taxonomy() {
	register_taxonomy(
		'photo-galleries',
		'photos',
		array(
			'labels' => array(
				'name' => __('Photogalleries', 'gp'),
				'singular_name' => __('Photogallery', 'gp'),
				'search_items' => __('Search Photogallery', 'gp'),
				'popular_items' => __('Popular Photogalleries', 'gp'),
				'all_items' => __('All Photogalleries', 'gp'),
				'parent_item' => __('Parent Photogalleries', 'gp'),
				'parent_item_colon' => __('Parent Photogallery:', 'gp'),
				'edit_item' => __('Edit Photogallery', 'gp'),
				'update_item' => __('Update Photogallery', 'gp'),
				'add_new_item' => __('Add New Photogallery', 'gp'),
				'new_item_name' => __('New Photogallery Name', 'gp')
			),
		'hierarchical' => true,
		'rewrite' => array( 'slug' => 'photos/gallery', 'with_front' => false ),
		'label' => __('Gallery', 'gp'),
		'has_archive' => true,
		)
	);
	flush_rewrite_rules();
}
add_action('init', 'create_photos_taxonomy');
// END // Register Taxonomy

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Custom Columns
function edit_columns_photos($columns){
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => __('Photo Title', 'gp'),
		"category" => __('Category', 'gp'),
		"author" => __('Author', 'gp'),
		"date" => __('Date', 'gp'),
	);
	return $columns;
}
add_filter("manage_edit-photos_columns", "edit_columns_photos");
// END // Custom Columns

// Custom Columns Content
function edit_columns_content_photos($column, $post_id) {
global $post;

	switch($column) {
		case 'category':

			$terms = get_the_terms($post_id, 'photo-galleries');

			if (!empty($terms)) {
				$out = array();
				foreach ($terms as $term) {
					$out[] = sprintf('<a href="%s">%s</a>',
						esc_url(add_query_arg(array('post_type' => $post->post_type, 'photo-galleries' => $term->slug), 'edit.php')),
						esc_html(sanitize_term_field('name', $term->name, $term->term_id, 'photo-galleries', 'display'))
					);
				}
				echo join(', ', $out);
			} else {
				_e('No Category', 'gp');
			}
			
		break;
		default:
		break;
	}
}
add_action('manage_photos_posts_custom_column', 'edit_columns_content_photos', 10, 2);
// END // Custom Columns Content

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// END // Custom Post Type - Photos and Photogalleries

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

?>