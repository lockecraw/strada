<?php

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Custom Post Type - Slides

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Register Post Type
function create_slides() {
	register_post_type('slides',
		array (
			'label' => __('Slides', 'gp'),
			'singular_label' => __('Slides', 'gp'),
			'labels' => array(
				'label' => __('Slides', 'gp'),
				'singular_label' => __('Slides', 'gp'),
				'all_items' => __('All Slides', 'gp'),
				'add_new' => __('Add New Slide', 'gp'),
				'add_new_item' => __('Add New Slide', 'gp'),
				'edit' => __('Edit Slide', 'gp'),
				'edit_item' => __('Edit Slide', 'gp'),
				'new_item' => __('New Slide', 'gp'),
				'view' => __('View Slide', 'gp'),
				'view_item' => __('View Slide', 'gp'),
				'search_items' => __('Search Slide', 'gp'),
				'not_found' => __('No Slides Found', 'gp'),
				'not_found_in_trash' => __('No Slides Found in Trash', 'gp'),
			),
			'public' => true,
			'publicly_queryable' => false,
			'show_ui' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => true,
			'query_var' => true,
			'exclude_from_search' => true,
			'menu_position' => 25,
			'supports' => array('title', 'thumbnail')
			)
	);
}
add_action('init', 'create_slides');
// END // Register Post Type

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Meta Boxes

// - - - - - - - - - - - - - - - - - - - - - - -

// Metabox Fields
$name_short =  "gp";
$slides_metabox = array(
	'id' => 'gp_slides_metabox',
	'title' => __('Slide Options', 'gp'),
	'page' => 'slides',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(  
			"name" => __('Caption', 'gp'),
			"desc" => __('Add caption of the slide.', 'gp'),
			"id" => $name_short."_slide_caption",
			"std" => "",
			"type" => "textarea"
		)
	)
);
// END // Metabox Fields

// - - - - - - - - - - - - - - - - - - - - - - -

// Add Metabox
function add_slides_metabox(){
	global $post, $slides_metabox;
	add_meta_box($slides_metabox['id'], $slides_metabox['title'], "init_slides_metabox", $slides_metabox['page'], $slides_metabox['context'], $slides_metabox['priority']);
}
add_action("admin_menu", "add_slides_metabox");
// END // Add Metabox

// - - - - - - - - - - - - - - - - - - - - - - -

// Init Metabox
function init_slides_metabox(){
	global $post, $slides_metabox;
	
	foreach ($slides_metabox['fields'] as $value) {
		$metabox = get_post_meta($post->ID, $value['id'], true);
		switch ($value['type']) {
		
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
function save_slides_metabox($post_id) {
    global $post;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return $post_id; }
	if (isset($_POST['gp_slide_link'])) { update_post_meta($post->ID, 'gp_slide_link', $_POST['gp_slide_link']);}
	if (isset($_POST['gp_slide_caption'])) { update_post_meta($post->ID, 'gp_slide_caption', $_POST['gp_slide_caption']);}
}
add_action('save_post', 'save_slides_metabox');
// END // Save Metabox

// - - - - - - - - - - - - - - - - - - - - - - -

// END // Meta Boxes

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Custom Columns
function edit_columns_slides($columns){
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => __('Slide Title', 'gp'),
		"caption" => __('Caption', 'gp'),
		"author" => __('Author', 'gp'),
		"date" => __('Date', 'gp'),
	);
	return $columns;
}
add_filter("manage_edit-slides_columns", "edit_columns_slides");
// END // Custom Columns

// Custom Columns Content
function edit_columns_content_slides($column, $post_id) {
global $post;

	switch($column) {
		case 'caption':

			$caption = get_post_meta($post_id, 'gp_slide_caption', true);
			if (empty($caption)) {
				echo __('/', 'gp');
			} else {
				printf('%s', $caption);
			}

		break;
		default:
		break;
	}
}
add_action('manage_slides_posts_custom_column', 'edit_columns_content_slides', 10, 2);
// END // Custom Columns Content

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// END // Custom Post Type - Slides

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

?>