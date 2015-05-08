<?php

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Custom Post Type - Drink Menu

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Register Post Type
function create_menu_drink() {
	register_post_type('menu-drink',
		array (
			'label' => __('Drinks', 'gp'),
			'singular_label' => __('Drinks', 'gp'),
			'labels' => array(
				'label' => __('Drinks', 'gp'),
				'singular_label' => __('Drinks', 'gp'),
				'all_items' => __('All Drinks', 'gp'),
				'add_new' => __('Add New Drink', 'gp'),
				'add_new_item' => __('Add New Drink', 'gp'),
				'edit' => __('Edit Drink', 'gp'),
				'edit_item' => __('Edit Drink', 'gp'),
				'new_item' => __('New Drink', 'gp'),
				'view' => __('View Drink', 'gp'),
				'view_item' => __('View Drink', 'gp'),
				'search_items' => __('Search Drink', 'gp'),
				'not_found' => __('No Drinks', 'gp'),
				'not_found_in_trash' => __('No Drinks Found in Trash', 'gp'),
			),
			'public' => true,
			'show_ui' => true,
			'show_in_nav_menus' => false,
			'capability_type' => 'post',
			'hierarchical' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'drink/item', 'with_front' => false ),
			'menu_position' => 30,
			'supports' => array('title', 'editor', 'thumbnail', 'comments')
			)
	);
	flush_rewrite_rules();
}
add_action('init', 'create_menu_drink');
function add_menu_drink(){
	add_meta_box("menu-drink-details", __('Drink Options', 'gp'), "menu-drink", "normal", "low");
}
add_action('admin_init', 'add_menu_drink');
// END // Register Post Type

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Register Taxonomy
function create_menu_drink_taxonomy() {
	register_taxonomy(
		'menu-drink-categories',
		'menu-drink',
		array(
			'labels' => array(
				'name' => __('Drink Categories', 'gp'),
				'singular_name' => __('Drink Category', 'gp'),
				'search_items' => __('Search Drink Category', 'gp'),
				'popular_items' => __('Popular Drink Categories', 'gp'),
				'all_items' => __('All Drink Categories', 'gp'),
				'parent_item' => __('Parent Drink Category', 'gp'),
				'parent_item_colon' => __('Parent Drink Category:', 'gp'),
				'edit_item' => __('Edit Drink Category', 'gp'),
				'update_item' => __('Update Drink Category', 'gp'),
				'add_new_item' => __('Add New Drink Category', 'gp'),
				'new_item_name' => __('New Drink Category Name', 'gp')
			),
		'hierarchical' => true,
		'rewrite' => array( 'slug' => 'drink/category', 'with_front' => false ),
		'label' => __('Drink Categories', 'gp'),
		'has_archive' => true,
		)
	);
	flush_rewrite_rules();
}
add_action('init', 'create_menu_drink_taxonomy');
// END // Register Taxonomy

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Meta Boxes

// - - - - - - - - - - - - - - - - - - - - - - -

// Metaboxes Fields
$name_short =  "gp";
$menu_drink_metabox = array(
	'id' => 'gp_menu_drink_item_metabox',
	'title' => __('Drink Options', 'gp'),
	'page' => 'menu-drink',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(  
			"name" => __('Drink Options', 'gp'),
			"type" => "heading"
		),
		array(  
			"name" => __('Drink Price', 'gp'),
			"desc" => __('Fill the price with the currency of the drink menu item. Format: &euro;25 or &pound;25 or $25.', 'gp'),
			"id" => $name_short."_menu_drink_price",
			"std" => "",
			"type" => "text"
		),
		array(  
			"name" => __('Drink Description', 'gp'),
			"desc" => __('Fill the description of the drink menu item.', 'gp'),
			"id" => $name_short."_menu_drink_description",
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
function add_menu_drink_metabox(){
	global $post, $menu_drink_metabox;
	add_meta_box($menu_drink_metabox['id'], $menu_drink_metabox['title'], "init_menu_drink_metabox", $menu_drink_metabox['page'], $menu_drink_metabox['context'], $menu_drink_metabox['priority']);

}
add_action("admin_menu", "add_menu_drink_metabox");
// END // Add Metaboxes

// - - - - - - - - - - - - - - - - - - - - - - -

// Init Metabox
function init_menu_drink_metabox(){
	global $post, $menu_drink_metabox;
	
	foreach ($menu_drink_metabox['fields'] as $value) {
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
			
			// Text
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
function save_menu_drink_metabox($post_id) {
    global $post;   
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) { return $post_id; }
	if (isset($_POST['gp_menu_drink_price'])) { update_post_meta($post->ID, 'gp_menu_drink_price', $_POST['gp_menu_drink_price']); }
	if (isset($_POST['gp_menu_drink_description'])) { update_post_meta($post->ID, 'gp_menu_drink_description', $_POST['gp_menu_drink_description']); }
	if (isset($_POST['gp_page_keywords'])) { update_post_meta($post->ID, 'gp_page_keywords', $_POST['gp_page_keywords']); }
	if (isset($_POST['gp_page_description'])) { update_post_meta($post->ID, 'gp_page_description', $_POST['gp_page_description']); }
}
add_action('save_post', 'save_menu_drink_metabox');
// END // Save Metabox

// - - - - - - - - - - - - - - - - - - - - - - -

// END // Meta Boxes

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Custom Columns
function edit_columns_menu_drink($columns){
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => __('Drink Title', 'gp'),
		"category" => __('Category', 'gp'),
		"price" => __('Price', 'gp'),
		"author" => __('Author', 'gp'),
		"date" => __('Date', 'gp'),
	);
	return $columns;
}
add_filter("manage_edit-menu-drink_columns", "edit_columns_menu_drink");
// END // Custom Columns

// Custom Columns Content
function edit_columns_content_menu_drink($column, $post_id) {
global $post;

	switch($column) {
		case 'price':

			$price = get_post_meta($post_id, 'gp_menu_drink_price', true);
			if (empty($price)) {
				echo __('/', 'gp');
			} else {
				printf('%s', $price);
			}

		break;
		case 'category':

			$terms = get_the_terms($post_id, 'menu-drink-categories');

			if (!empty($terms)) {
				$out = array();
				foreach ($terms as $term) {
					$out[] = sprintf('<a href="%s">%s</a>',
						esc_url(add_query_arg(array('post_type' => $post->post_type, 'menu-drink-categories' => $term->slug), 'edit.php')),
						esc_html(sanitize_term_field('name', $term->name, $term->term_id, 'menu-drink-categories', 'display'))
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
add_action('manage_menu-drink_posts_custom_column', 'edit_columns_content_menu_drink', 10, 2);
// END // Custom Columns Content

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// END // Custom Post Type - Drink Menu

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

?>