<?php

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Custom Post Type - Sunday Menu

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Register Post Type
function create_menu_sunday() {
	register_post_type('menu-sunday',
		array (
			'label' => __('Foods - Sunday', 'gp'),
			'singular_label' => __('Sundays', 'gp'),
			'labels' => array(
				'label' => __('Sundays', 'gp'),
				'singular_label' => __('Sundays', 'gp'),
				'all_items' => __('All Sundays', 'gp'),
				'add_new' => __('Add New Sunday', 'gp'),
				'add_new_item' => __('Add New Sunday', 'gp'),
				'edit' => __('Edit Sunday', 'gp'),
				'edit_item' => __('Edit Sunday', 'gp'),
				'new_item' => __('New Sunday', 'gp'),
				'view' => __('View Sunday', 'gp'),
				'view_item' => __('View Sunday', 'gp'),
				'search_items' => __('Search Sunday', 'gp'),
				'not_found' => __('No Sundays', 'gp'),
				'not_found_in_trash' => __('No Sundays Found in Trash', 'gp'),
			),
			'public' => true,
			'show_ui' => true,
			'show_in_nav_menus' => false,
			'capability_type' => 'post',
			'hierarchical' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'sunday/item', 'with_front' => false ),
			'menu_position' => 29,
			'supports' => array('title', 'editor', 'thumbnail', 'comments')
			)
	);
	flush_rewrite_rules();
}
add_action('init', 'create_menu_sunday');
function add_menu_sunday(){
	add_meta_box("menu-sunday-details", __('Sunday Options', 'gp'), "menu-sunday", "normal", "low");
}
add_action('admin_init', 'add_menu_sunday');
// END // Register Post Type

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Register Taxonomy
function create_menu_sunday_taxonomy() {
	register_taxonomy(
		'menu-sunday-categories',
		'menu-sunday',
		array(
			'labels' => array(
				'name' => __('Sunday Categories', 'gp'),
				'singular_name' => __('Sunday Category', 'gp'),
				'search_items' => __('Search Sunday Category', 'gp'),
				'popular_items' => __('Popular Sunday Categories', 'gp'),
				'all_items' => __('All Sunday Categories', 'gp'),
				'parent_item' => __('Parent Sunday Category', 'gp'),
				'parent_item_colon' => __('Parent Sunday Category:', 'gp'),
				'edit_item' => __('Edit Sunday Category', 'gp'),
				'update_item' => __('Update Sunday Category', 'gp'),
				'add_new_item' => __('Add New Sunday Category', 'gp'),
				'not_found' => __('No Sunday Categories', 'gp'),
				'new_item_name' => __('New Sunday Category Name', 'gp')
			),
		'hierarchical' => true,
		'rewrite' => array( 'slug' => 'sunday/category', 'with_front' => false ),
		'label' => __('Sunday Categories', 'gp'),
		'has_archive' => true,
		)
	);
	flush_rewrite_rules();
}
add_action('init', 'create_menu_sunday_taxonomy');
// END // Register Taxonomy

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Meta Boxes

// - - - - - - - - - - - - - - - - - - - - - - -

// Metaboxes Fields
$name_short =  "gp";
$menu_sunday_metabox = array(
	'id' => 'gp_menu_sunday_item_metabox',
	'title' => __('Sunday Options', 'gp'),
	'page' => 'menu-sunday',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(  
			"name" => __('Sunday Options', 'gp'),
			"type" => "heading"
		),
		array(  
			"name" => __('Sunday Price', 'gp'),
			"desc" => __('Fill the price with the currency of the sunday. Format: &euro;25 or &pound;25 or $25.', 'gp'),
			"id" => $name_short."_menu_sunday_price",
			"std" => "",
			"type" => "text"
		),
		array(  
			"name" => __('Sunday Description', 'gp'),
			"desc" => __('Fill the description of the sunday.', 'gp'),
			"id" => $name_short."_menu_sunday_description",
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
function add_menu_sunday_metabox(){
	global $post, $menu_sunday_metabox;
	add_meta_box($menu_sunday_metabox['id'], $menu_sunday_metabox['title'], "init_menu_sunday_metabox", $menu_sunday_metabox['page'], $menu_sunday_metabox['context'], $menu_sunday_metabox['priority']);

}
add_action("admin_menu", "add_menu_sunday_metabox");
// END // Add Metaboxes

// - - - - - - - - - - - - - - - - - - - - - - -

// Init Metabox
function init_menu_sunday_metabox(){
	global $post, $menu_sunday_metabox;
	
	foreach ($menu_sunday_metabox['fields'] as $value) {
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
function save_menu_sunday_metabox($post_id) {
    global $post;   
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return $post_id; }
	if (isset($_POST['gp_menu_sunday_price'])) { update_post_meta($post->ID, 'gp_menu_sunday_price', $_POST['gp_menu_sunday_price']); }
	if (isset($_POST['gp_menu_sunday_description']) ) { update_post_meta($post->ID, 'gp_menu_sunday_description', $_POST['gp_menu_sunday_description']); }
	if (isset($_POST['gp_page_keywords'])) { update_post_meta($post->ID, 'gp_page_keywords', $_POST['gp_page_keywords']); }
	if (isset($_POST['gp_page_description'])) { update_post_meta($post->ID, 'gp_page_description', $_POST['gp_page_description']); }
}
add_action('save_post', 'save_menu_sunday_metabox');
// END // Save Metabox

// - - - - - - - - - - - - - - - - - - - - - - -

// END // Meta Boxes

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Custom Columns
function edit_columns_menu_sunday($columns){
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => __('Sunday Title', 'gp'),
		"category" => __('Category', 'gp'),
		"price" => __('Price', 'gp'),
		"author" => __('Author', 'gp'),
		"date" => __('Date', 'gp'),
	);
	return $columns;
}
add_filter("manage_edit-menu-sunday_columns", "edit_columns_menu_sunday");
// END // Custom Columns

// Custom Columns Content
function edit_columns_content_menu_sunday($column, $post_id) {
global $post;

	switch($column) {
		case 'price':

			$price = get_post_meta($post_id, 'gp_menu_sunday_price', true);
			if (empty($price)) {
				echo __('/', 'gp');
			} else {
				printf('%s', $price);
			}

		break;
		case 'category':

			$terms = get_the_terms($post_id, 'menu-sunday-categories');

			if (!empty($terms)) {
				$out = array();
				foreach ($terms as $term) {
					$out[] = sprintf('<a href="%s">%s</a>',
						esc_url(add_query_arg(array('post_type' => $post->post_type, 'menu-sunday-categories' => $term->slug), 'edit.php')),
						esc_html(sanitize_term_field('name', $term->name, $term->term_id, 'menu-sunday-categories', 'display'))
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
add_action('manage_menu-sunday_posts_custom_column', 'edit_columns_content_menu_sunday', 10, 2);
// END // Custom Columns Content

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// END // Custom Post Type - Sunday Menu

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

?>