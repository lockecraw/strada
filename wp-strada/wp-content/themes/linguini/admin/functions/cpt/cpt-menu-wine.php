<?php

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Custom Post Type - Drinks - Wine

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Register Post Type
function create_menu_wine() {
	register_post_type('menu-wine',
		array (
			'label' => __('Drinks - Wine', 'gp'),
			'singular_label' => __('Drinks - Wine', 'gp'),
			'labels' => array(
				'label' => __('Drinks - Wine', 'gp'),
				'singular_label' => __('Drinks - Wine', 'gp'),
				'all_items' => __('All Wines', 'gp'),
				'add_new' => __('Add New Wine', 'gp'),
				'add_new_item' => __('Add New Wine', 'gp'),
				'edit' => __('Edit Wine', 'gp'),
				'edit_item' => __('Edit Wine', 'gp'),
				'new_item' => __('New Wine', 'gp'),
				'view' => __('View Wine', 'gp'),
				'view_item' => __('View Wine', 'gp'),
				'search_items' => __('Search Wine', 'gp'),
				'not_found' => __('No Wines', 'gp'),
				'not_found_in_trash' => __('No Wines Found in Trash', 'gp'),
			),
			'public' => true,
			'show_ui' => true,
			'show_in_nav_menus' => false,
			'capability_type' => 'post',
			'hierarchical' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'wine/item', 'with_front' => false ),
			'menu_position' => 31,
			'supports' => array('title', 'editor', 'thumbnail', 'comments')
			)
	);
	flush_rewrite_rules();
}
add_action('init', 'create_menu_wine');
function add_menu_wine(){
	add_meta_box("menu-wine-details", __('Wine Options', 'gp'), "menu-wine", "normal", "low");
}
add_action('admin_init', 'add_menu_wine');
// END // Register Post Type

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Register Taxonomy
function create_menu_wine_taxonomy() {
	register_taxonomy(
		'menu-wine-categories',
		'menu-wine',
		array(
			'labels' => array(
				'name' => __('Wine Categories', 'gp'),
				'singular_name' => __('Wine Category', 'gp'),
				'search_items' => __('Search Wine Category', 'gp'),
				'popular_items' => __('Popular Wine Categories', 'gp'),
				'all_items' => __('All Wine Categories', 'gp'),
				'parent_item' => __('Parent Wine Category', 'gp'),
				'parent_item_colon' => __('Parent Wine Category:', 'gp'),
				'edit_item' => __('Edit Wine Category', 'gp'),
				'update_item' => __('Update Wine Category', 'gp'),
				'add_new_item' => __('Add New Wine Category', 'gp'),
				'new_item_name' => __('New Wine Category Name', 'gp')
			),
		'hierarchical' => true,
		'rewrite' => array( 'slug' => 'wine/category', 'with_front' => false ),
		'label' => __('Wine Categories', 'gp'),
		'has_archive' => true,
		)
	);
	flush_rewrite_rules();
}
add_action('init', 'create_menu_wine_taxonomy');
// END // Register Taxonomy

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Meta Boxes

// - - - - - - - - - - - - - - - - - - - - - - -

// Metaboxes Fields
$name_short =  "gp";
$menu_wine_metabox = array(
	'id' => 'gp_menu_wine_item_metabox',
	'title' => __('Wine Options', 'gp'),
	'page' => 'menu-wine',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(  
			"name" => __('Wine Options', 'gp'),
			"type" => "heading"
		),
		array(  
			"name" => __('Wine Price', 'gp'),
			"desc" => __('Fill the price with the currency of the wine. Format: &euro;25 or &pound;25 or $25.', 'gp'),
			"id" => $name_short."_menu_wine_price",
			"std" => "",
			"type" => "text"
		),
		array(  
			"name" => __('Wine Description', 'gp'),
			"desc" => __('Fill the description of the wine.', 'gp'),
			"id" => $name_short."_menu_wine_description",
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
function add_menu_wine_metabox(){
	global $post, $menu_wine_metabox;
	add_meta_box($menu_wine_metabox['id'], $menu_wine_metabox['title'], "init_menu_wine_metabox", $menu_wine_metabox['page'], $menu_wine_metabox['context'], $menu_wine_metabox['priority']);

}
add_action("admin_menu", "add_menu_wine_metabox");
// END // Add Metaboxes

// - - - - - - - - - - - - - - - - - - - - - - -

// Init Metabox
function init_menu_wine_metabox(){
	global $post, $menu_wine_metabox;
	
	foreach ($menu_wine_metabox['fields'] as $value) {
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
function save_menu_wine_metabox($post_id) {
    global $post;   
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) { return $post_id; }
	if (isset($_POST['gp_menu_wine_price'])) { update_post_meta($post->ID, 'gp_menu_wine_price', $_POST['gp_menu_wine_price']); }
	if (isset($_POST['gp_menu_wine_description'])) { update_post_meta($post->ID, 'gp_menu_wine_description', $_POST['gp_menu_wine_description']); }
	if (isset($_POST['gp_page_keywords'])) { update_post_meta($post->ID, 'gp_page_keywords', $_POST['gp_page_keywords']); }
	if (isset($_POST['gp_page_description'])) { update_post_meta($post->ID, 'gp_page_description', $_POST['gp_page_description']); }
}
add_action('save_post', 'save_menu_wine_metabox');
// END // Save Metabox

// - - - - - - - - - - - - - - - - - - - - - - -

// END // Meta Boxes

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Custom Columns
function edit_columns_menu_wine($columns){
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => __('Wine Title', 'gp'),
		"category" => __('Category', 'gp'),
		"price" => __('Price', 'gp'),
		"author" => __('Author', 'gp'),
		"date" => __('Date', 'gp'),
	);
	return $columns;
}
add_filter("manage_edit-menu-wine_columns", "edit_columns_menu_wine");
// END // Custom Columns

// Custom Columns Content
function edit_columns_content_menu_wine($column, $post_id) {
global $post;

	switch($column) {
		case 'price':

			$price = get_post_meta($post_id, 'gp_menu_wine_price', true);
			if (empty($price)) {
				echo __('/', 'gp');
			} else {
				printf('%s', $price);
			}

		break;
		case 'category':

			$terms = get_the_terms($post_id, 'menu-wine-categories');

			if (!empty($terms)) {
				$out = array();
				foreach ($terms as $term) {
					$out[] = sprintf('<a href="%s">%s</a>',
						esc_url(add_query_arg(array('post_type' => $post->post_type, 'menu-wine-categories' => $term->slug), 'edit.php')),
						esc_html(sanitize_term_field('name', $term->name, $term->term_id, 'menu-wine-categories', 'display'))
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
add_action('manage_menu-wine_posts_custom_column', 'edit_columns_content_menu_wine', 10, 2);
// END // Custom Columns Content

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// END // Custom Post Type - Drinks - Wine

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

?>