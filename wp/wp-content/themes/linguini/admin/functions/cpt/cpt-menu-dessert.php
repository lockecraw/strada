<?php

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Custom Post Type - Dessert Menu

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Register Post Type
function create_menu_dessert() {
	register_post_type('menu-dessert',
		array (
			'label' => __('Desserts', 'gp'),
			'singular_label' => __('Desserts', 'gp'),
			'labels' => array(
				'label' => __('Desserts', 'gp'),
				'singular_label' => __('Desserts', 'gp'),
				'all_items' => __('All Desserts', 'gp'),
				'add_new' => __('Add New Dessert', 'gp'),
				'add_new_item' => __('Add New Dessert', 'gp'),
				'edit' => __('Edit Dessert', 'gp'),
				'edit_item' => __('Edit Dessert', 'gp'),
				'new_item' => __('New Dessert', 'gp'),
				'view' => __('View Dessert', 'gp'),
				'view_item' => __('View Dessert', 'gp'),
				'search_items' => __('Search Dessert', 'gp'),
				'not_found' => __('No Desserts', 'gp'),
				'not_found_in_trash' => __('No Desserts Found in Trash', 'gp'),
			),
			'public' => true,
			'show_ui' => true,
			'show_in_nav_menus' => false,
			'capability_type' => 'post',
			'hierarchical' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'dessert/item', 'with_front' => false ),
			'menu_position' => 29,
			'supports' => array('title', 'editor', 'thumbnail', 'comments')
			)
	);
	flush_rewrite_rules();
}
add_action('init', 'create_menu_dessert');
function add_menu_dessert(){
	add_meta_box("menu-dessert-details", __('Dessert Options', 'gp'), "menu-dessert", "normal", "low");
}
add_action('admin_init', 'add_menu_dessert');
// END // Register Post Type

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Register Taxonomy
function create_menu_dessert_taxonomy() {
	register_taxonomy(
		'menu-dessert-categories',
		'menu-dessert',
		array(
			'labels' => array(
				'name' => __('Dessert Categories', 'gp'),
				'singular_name' => __('Dessert Category', 'gp'),
				'search_items' => __('Search Dessert Category', 'gp'),
				'popular_items' => __('Popular Dessert Categories', 'gp'),
				'all_items' => __('All Dessert Categories', 'gp'),
				'parent_item' => __('Parent Dessert Category', 'gp'),
				'parent_item_colon' => __('Parent Dessert Category:', 'gp'),
				'edit_item' => __('Edit Dessert Category', 'gp'),
				'update_item' => __('Update Dessert Category', 'gp'),
				'add_new_item' => __('Add New Dessert Category', 'gp'),
				'not_found' => __('No Dessert Categories', 'gp'),
				'new_item_name' => __('New Dessert Category Name', 'gp')
			),
		'hierarchical' => true,
		'rewrite' => array( 'slug' => 'dessert/category', 'with_front' => false ),
		'label' => __('Dessert Categories', 'gp'),
		'has_archive' => true,
		)
	);
	flush_rewrite_rules();
}
add_action('init', 'create_menu_dessert_taxonomy');
// END // Register Taxonomy

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Meta Boxes

// - - - - - - - - - - - - - - - - - - - - - - -

// Metaboxes Fields
$name_short =  "gp";
$menu_dessert_metabox = array(
	'id' => 'gp_menu_dessert_item_metabox',
	'title' => __('Dessert Options', 'gp'),
	'page' => 'menu-dessert',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(  
			"name" => __('Dessert Options', 'gp'),
			"type" => "heading"
		),
		array(  
			"name" => __('Dessert Price', 'gp'),
			"desc" => __('Fill the price with the currency of the dessert. Format: &euro;25 or &pound;25 or $25.', 'gp'),
			"id" => $name_short."_menu_dessert_price",
			"std" => "",
			"type" => "text"
		),
		array(  
			"name" => __('Dessert Description', 'gp'),
			"desc" => __('Fill the description of the dessert.', 'gp'),
			"id" => $name_short."_menu_dessert_description",
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
function add_menu_dessert_metabox(){
	global $post, $menu_dessert_metabox;
	add_meta_box($menu_dessert_metabox['id'], $menu_dessert_metabox['title'], "init_menu_dessert_metabox", $menu_dessert_metabox['page'], $menu_dessert_metabox['context'], $menu_dessert_metabox['priority']);

}
add_action("admin_menu", "add_menu_dessert_metabox");
// END // Add Metaboxes

// - - - - - - - - - - - - - - - - - - - - - - -

// Init Metabox
function init_menu_dessert_metabox(){
	global $post, $menu_dessert_metabox;
	
	foreach ($menu_dessert_metabox['fields'] as $value) {
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
function save_menu_dessert_metabox($post_id) {
    global $post;   
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return $post_id; }
	if (isset($_POST['gp_menu_dessert_price'])) { update_post_meta($post->ID, 'gp_menu_dessert_price', $_POST['gp_menu_dessert_price']); }
	if (isset($_POST['gp_menu_dessert_description']) ) { update_post_meta($post->ID, 'gp_menu_dessert_description', $_POST['gp_menu_dessert_description']); }
	if (isset($_POST['gp_page_keywords'])) { update_post_meta($post->ID, 'gp_page_keywords', $_POST['gp_page_keywords']); }
	if (isset($_POST['gp_page_description'])) { update_post_meta($post->ID, 'gp_page_description', $_POST['gp_page_description']); }
}
add_action('save_post', 'save_menu_dessert_metabox');
// END // Save Metabox

// - - - - - - - - - - - - - - - - - - - - - - -

// END // Meta Boxes

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Custom Columns
function edit_columns_menu_dessert($columns){
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => __('Dessert Title', 'gp'),
		"category" => __('Category', 'gp'),
		"price" => __('Price', 'gp'),
		"author" => __('Author', 'gp'),
		"date" => __('Date', 'gp'),
	);
	return $columns;
}
add_filter("manage_edit-menu-dessert_columns", "edit_columns_menu_dessert");
// END // Custom Columns

// Custom Columns Content
function edit_columns_content_menu_dessert($column, $post_id) {
global $post;

	switch($column) {
		case 'price':

			$price = get_post_meta($post_id, 'gp_menu_dessert_price', true);
			if (empty($price)) {
				echo __('/', 'gp');
			} else {
				printf('%s', $price);
			}

		break;
		case 'category':

			$terms = get_the_terms($post_id, 'menu-dessert-categories');

			if (!empty($terms)) {
				$out = array();
				foreach ($terms as $term) {
					$out[] = sprintf('<a href="%s">%s</a>',
						esc_url(add_query_arg(array('post_type' => $post->post_type, 'menu-dessert-categories' => $term->slug), 'edit.php')),
						esc_html(sanitize_term_field('name', $term->name, $term->term_id, 'menu-dessert-categories', 'display'))
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
add_action('manage_menu-dessert_posts_custom_column', 'edit_columns_content_menu_dessert', 10, 2);
// END // Custom Columns Content

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// END // Custom Post Type - Dessert Menu

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

?>