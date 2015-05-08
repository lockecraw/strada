<?php

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Custom Post Type - Callout Blocks

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Register Post Type
function create_callouts() {
	register_post_type('callouts',
		array (
			'label' => __('Callout Blocks', 'gp'),
			'singular_label' => __('Callout Blocks', 'gp'),
			'labels' => array(
				'label' => __('Callout Blocks', 'gp'),
				'singular_label' => __('Callout Blocks', 'gp'),
				'all_items' => __('All Callout Blocks', 'gp'),
				'add_new' => __('Add New Callout Block', 'gp'),
				'add_new_item' => __('Add New Callout Block', 'gp'),
				'edit' => __('Edit Callout Block', 'gp'),
				'edit_item' => __('Edit Callout Block', 'gp'),
				'new_item' => __('New Callout Block', 'gp'),
				'view' => __('View Callout Block', 'gp'),
				'view_item' => __('View Callout Block', 'gp'),
				'search_items' => __('Search Callout Block', 'gp'),
				'not_found' => __('No Callout Block Found', 'gp'),
				'not_found_in_trash' => __('No Callout Block Found in Trash', 'gp'),
			),
			'public' => true,
			'publicly_queryable' => false,
			'show_ui' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => true,
			'query_var' => true,
			'exclude_from_search' => true,
			'menu_position' => 26,
			'supports' => array('title', 'editor', 'thumbnail')
			)
	);
}
add_action('init', 'create_callouts');
// END // Register Post Type

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Meta Boxes

// - - - - - - - - - - - - - - - - - - - - - - -

// Metabox Fields
$name_short =  "gp";
$callouts_metabox = array(
	'id' => 'gp_callouts_metabox',
	'title' => __('Callout Block Options', 'gp'),
	'page' => 'callouts',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(  
			"name" => __('The URL', 'gp'),
			"desc" => __('Insert the URL you wish to link to.', 'gp'),
			"id" => $name_short."_callout_link",
			"std" => "",
			"type" => "text"
		),
		array(  
			"name" => __('Button Text', 'gp'),
			"desc" => __('Insert text of the button.', 'gp'),
			"id" => $name_short."_callout_button",
			"std" => "",
			"type" => "text"
		)
	)
);
// END // Metabox Fields

// - - - - - - - - - - - - - - - - - - - - - - -

// Add Metabox
function add_callouts_metabox(){
	global $post, $callouts_metabox;
	add_meta_box($callouts_metabox['id'], $callouts_metabox['title'], "init_callouts_metabox", $callouts_metabox['page'], $callouts_metabox['context'], $callouts_metabox['priority']);
}
add_action("admin_menu", "add_callouts_metabox");
// END // Add Metabox

// - - - - - - - - - - - - - - - - - - - - - - -

// Init Metabox
function init_callouts_metabox(){
	global $post, $callouts_metabox;
	
	foreach ($callouts_metabox['fields'] as $value) {
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
function save_callouts_metabox($post_id) {
    global $post;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return $post_id; }
	if (isset($_POST['gp_callout_link'])) { update_post_meta($post->ID, 'gp_callout_link', $_POST['gp_callout_link']);}
	if (isset($_POST['gp_callout_button'])) { update_post_meta($post->ID, 'gp_callout_button', $_POST['gp_callout_button']);}
}
add_action('save_post', 'save_callouts_metabox');
// END // Save Metabox

// - - - - - - - - - - - - - - - - - - - - - - -

// END // Meta Boxes

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Custom Columns
function edit_columns_callouts($columns){
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => __('Callout Block Title', 'gp'),
		"author" => __('Author', 'gp'),
		"date" => __('Date', 'gp'),
	);
	return $columns;
}
add_filter("manage_edit-callouts_columns", "edit_columns_callouts");
// END // Custom Columns

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// END // Custom Post Type - Callout Blocks

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

?>