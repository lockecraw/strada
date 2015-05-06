<?php

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Custom Post Type - Dinner Menu

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Register Post Type
function create_menu_dinner() {
	register_post_type('menu-dinner',
		array (
			'label' => __('Foods - Dinner', 'gp'),
			'singular_label' => __('Dinners', 'gp'),
			'labels' => array(
				'label' => __('Dinners', 'gp'),
				'singular_label' => __('Dinners', 'gp'),
				'all_items' => __('All Dinners', 'gp'),
				'add_new' => __('Add New Dinner', 'gp'),
				'add_new_item' => __('Add New Dinner', 'gp'),
				'edit' => __('Edit Dinner', 'gp'),
				'edit_item' => __('Edit Dinner', 'gp'),
				'new_item' => __('New Dinner', 'gp'),
				'view' => __('View Dinner', 'gp'),
				'view_item' => __('View Dinner', 'gp'),
				'search_items' => __('Search Dinner', 'gp'),
				'not_found' => __('No Dinners', 'gp'),
				'not_found_in_trash' => __('No Dinners Found in Trash', 'gp'),
			),
			'public' => true,
			'show_ui' => true,
			'show_in_nav_menus' => false,
			'capability_type' => 'post',
			'hierarchical' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'dinner/item', 'with_front' => false ),
			'menu_position' => 29,
			'supports' => array('title', 'editor', 'thumbnail', 'comments')
			)
	);
	flush_rewrite_rules();
}
add_action('init', 'create_menu_dinner');
function add_menu_dinner(){
	add_meta_box("menu-dinner-details", __('Dinner Options', 'gp'), "menu-dinner", "normal", "low");
}
add_action('admin_init', 'add_menu_dinner');
// END // Register Post Type

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Register Taxonomy
function create_menu_dinner_taxonomy() {
	register_taxonomy(
		'menu-dinner-categories',
		'menu-dinner',
		array(
			'labels' => array(
				'name' => __('Dinner Categories', 'gp'),
				'singular_name' => __('Dinner Category', 'gp'),
				'search_items' => __('Search Dinner Category', 'gp'),
				'popular_items' => __('Popular Dinner Categories', 'gp'),
				'all_items' => __('All Dinner Categories', 'gp'),
				'parent_item' => __('Parent Dinner Category', 'gp'),
				'parent_item_colon' => __('Parent Dinner Category:', 'gp'),
				'edit_item' => __('Edit Dinner Category', 'gp'),
				'update_item' => __('Update Dinner Category', 'gp'),
				'add_new_item' => __('Add New Dinner Category', 'gp'),
				'not_found' => __('No Dinner Categories', 'gp'),
				'new_item_name' => __('New Dinner Category Name', 'gp')
			),
		'hierarchical' => true,
		'rewrite' => array( 'slug' => 'dinner/category', 'with_front' => false ),
		'label' => __('Dinner Categories', 'gp'),
		'has_archive' => true,
		)
	);
	flush_rewrite_rules();
}
add_action('init', 'create_menu_dinner_taxonomy');
// END // Register Taxonomy

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Meta Boxes

// - - - - - - - - - - - - - - - - - - - - - - -

// Metaboxes Fields
$name_short =  "gp";
$menu_dinner_metabox = array(
	'id' => 'gp_menu_dinner_item_metabox',
	'title' => __('Dinner Options', 'gp'),
	'page' => 'menu-dinner',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(  
			"name" => __('Dinner Options', 'gp'),
			"type" => "heading"
		),
		array(  
			"name" => __('Dinner Price', 'gp'),
			"desc" => __('Fill the price with the currency of the dinner. Format: &euro;25 or &pound;25 or $25.', 'gp'),
			"id" => $name_short."_menu_dinner_price",
			"std" => "",
			"type" => "text"
		),
		array(  
			"name" => __('Dinner Description', 'gp'),
			"desc" => __('Fill the description of the dinner.', 'gp'),
			"id" => $name_short."_menu_dinner_description",
			"std" => "",
			"type" => "textarea"
		),
		array(  
			"name" => __('Meta', 'gp'),
			"type" => "heading"
		),
		array(  
			"name" => __('Meta Keywords', 'gp'),
			"desc" => __('Add meta keywords for this page or post. Separate keywords with commas.', 'gp'),
			"id" => $name_short."_page_keywords",
			"std" => "",
			"type" => "text"
		),
		array(  
			"name" => __('Meta Description', 'gp'),
			"desc" => __('Add a meta description for this page or post.', 'gp'),
			"id" => $name_short."_page_description",
			"std" => "",
			"type" => "textarea"
		),
	)
);
// END // Metaboxes Fields

// - - - - - - - - - - - - - - - - - - - - - - -

// Add Metaboxes
function add_menu_dinner_metabox(){
	global $post, $menu_dinner_metabox;
	add_meta_box($menu_dinner_metabox['id'], $menu_dinner_metabox['title'], "init_menu_dinner_metabox", $menu_dinner_metabox['page'], $menu_dinner_metabox['context'], $menu_dinner_metabox['priority']);

}
add_action("admin_menu", "add_menu_dinner_metabox");
// END // Add Metaboxes

// - - - - - - - - - - - - - - - - - - - - - - -

// Init Metabox
function init_menu_dinner_metabox(){
	global $post, $menu_dinner_metabox;
	
	foreach ($menu_dinner_metabox['fields'] as $value) {
		$metabox = get_post_meta($post->ID, $value['id'], true);
		switch ($value['type']) {
			
			// Heading
			case 'heading':	
			?>

			<h2 class="metabox-heading"><?php echo $value['name']; ?></h2>
            
			<?php
			break;
			
			// Text
			case 'text':
			?>

			<div class="metabox" style="display:block;width:100%;padding:10px;">
            	<div class="text" style="float:left;width:20%;">
                    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                    <p class="description"><?php echo $value['desc']; ?></p>
                </div>
                <div style="float:left;width:75%;">
					<input id="<?php echo $value['id']; ?>" class="<?php echo $value['id']; ?>" type="text" size="120" name="<?php echo $value['id']; ?>" value="<?php if ( stripslashes(get_post_meta($post->ID, $value['id'] , true)) != "") { echo stripslashes(get_post_meta($post->ID, $value['id'] , true)); } else { echo $value['std']; } ?>" />
				</div>
                <br class="clear" />
			</div>
      
      		<?php
			break;
			
			// Textarea
			case 'textarea':
			?>

			<div class="metabox" style="display:block;width:100%;padding:10px;">
            	<div class="text" style="float:left;width:20%;">
                    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                    <p class="description"><?php echo $value['desc']; ?></p>
                </div>
                <div style="float:left;width:75%;">
					<textarea id="<?php echo $value['id']; ?>" class="<?php echo $value['id']; ?>" type="text" size="120" name="<?php echo $value['id']; ?>"><?php if ( stripslashes(htmlspecialchars(get_post_meta($post->ID, $value['id'] , true))) != "") { echo stripslashes(htmlspecialchars(get_post_meta($post->ID, $value['id'] , true))); } else { echo $value['std']; } ?></textarea>
				</div>
                <br class="clear" />
			</div>
            
      		<?php
			break;
		
		}
	}
}
// END // Init Metabox

// - - - - - - - - - - - - - - - - - - - - - - -

// Save Metabox
function save_menu_dinner_metabox($post_id) {
    global $post;   
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return $post_id; }
	if (isset($_POST['gp_menu_dinner_price'])) { update_post_meta($post->ID, 'gp_menu_dinner_price', $_POST['gp_menu_dinner_price']); }
	if (isset($_POST['gp_menu_dinner_description']) ) { update_post_meta($post->ID, 'gp_menu_dinner_description', $_POST['gp_menu_dinner_description']); }
	if (isset($_POST['gp_page_keywords'])) { update_post_meta($post->ID, 'gp_page_keywords', $_POST['gp_page_keywords']); }
	if (isset($_POST['gp_page_description'])) { update_post_meta($post->ID, 'gp_page_description', $_POST['gp_page_description']); }
}
add_action('save_post', 'save_menu_dinner_metabox');
// END // Save Metabox

// - - - - - - - - - - - - - - - - - - - - - - -

// END // Meta Boxes

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Custom Columns
function edit_columns_menu_dinner($columns){
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => __('Dinner Title', 'gp'),
		"category" => __('Category', 'gp'),
		"price" => __('Price', 'gp'),
		"author" => __('Author', 'gp'),
		"date" => __('Date', 'gp'),
	);
	return $columns;
}
add_filter("manage_edit-menu-dinner_columns", "edit_columns_menu_dinner");
// END // Custom Columns

// Custom Columns Content
function edit_columns_content_menu_dinner($column, $post_id) {
global $post;

	switch($column) {
		case 'price':

			$price = get_post_meta($post_id, 'gp_menu_dinner_price', true);
			if (empty($price)) {
				echo __('/', 'gp');
			} else {
				printf('%s', $price);
			}

		break;
		case 'category':

			$terms = get_the_terms($post_id, 'menu-dinner-categories');

			if (!empty($terms)) {
				$out = array();
				foreach ($terms as $term) {
					$out[] = sprintf('<a href="%s">%s</a>',
						esc_url(add_query_arg(array('post_type' => $post->post_type, 'menu-dinner-categories' => $term->slug), 'edit.php')),
						esc_html(sanitize_term_field('name', $term->name, $term->term_id, 'menu-dinner-categories', 'display'))
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
add_action('manage_menu-dinner_posts_custom_column', 'edit_columns_content_menu_dinner', 10, 2);
// END // Custom Columns Content

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// END // Custom Post Type - Dinner Menu

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

?>