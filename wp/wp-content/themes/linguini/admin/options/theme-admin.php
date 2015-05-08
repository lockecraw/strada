<?php

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Theme Admin
function gp_add_admin() {
 	global $options;

	if ('gp_save'== $_REQUEST['action']) {
	
		foreach ($options as $value) {
			if (isset($_REQUEST[$value['id']])) {  
				update_option($value['id'], stripslashes($_REQUEST[$value['id']]));
			}
		}
		
		if (stristr($_SERVER['REQUEST_URI'],'&saved=true')) {
			$location = $_SERVER['REQUEST_URI'];
		} else {
			$location = $_SERVER['REQUEST_URI'] . "&saved=true";
		}
		
		if (stristr($_SERVER['REQUEST_URI'],'&reset=true')) {
			$location = "themes.php?page=gp_settings&saved=true";
		}
		
		header("Location: $location");
		die;
			
	} else if ('gp_reset' == $_REQUEST['action']) {
		
		foreach ($options as $value) {
			delete_option($value['id']);
			$location = "themes.php?page=gp_settings&reset=true";
		}
		
		header("Location: $location");
		die;
	
	}
	add_theme_page(__('Theme Options', 'gp'), __('Theme Options', 'gp'), 'edit_themes', 'gp_settings', 'gp_theme_admin');
}
add_action('admin_menu', 'gp_add_admin');

function gp_page($page){
	$options =  get_option('gp_template');     
	$name_theme =  get_option('gp_name_theme');      
	$name_short =  get_option('gp_name_short');
}

function gp_theme_admin() {
    global $name_theme, $name_short, $options;
	if (isset($_REQUEST['reset'])) echo '<div id="gp_message" class="updated fade"><p>' . __('Theme options reset!', 'gp') . '</p></div>';
	if (isset($_REQUEST['saved'])) echo '<div id="gp_message" class="updated fade"><p>' . __('Theme options saved!', 'gp') . '</p></div>';
?>

<div class="gp-theme-admin wrap">

    <form action="" method="post">
        
        <div id="gp-tabs">
        
            <div class="gp-title">
            
                <div class="gp-title-container">
                    <h2><?php echo _e('Theme', 'gp'); ?><span><?php echo _e('Options', 'gp'); ?></span></h2>
                </div><!-- gp-title-container -->
            
                <div class="gp-tabs">
                    <div class="gp-tabs-container">
                        <div class="gp-tabs-insider">
                        
                            <ul>
                                <li class="first">
                                	<a href="#tab1"><?php echo _e('General', 'gp'); ?></a>
								</li>
                                <li>
                                	<a href="#tab2"><?php echo _e('Slideshow', 'gp'); ?></a>
								</li>
                                <li>
                                	<a href="#tab3"><?php echo _e('Menu Cards', 'gp'); ?></a>
								</li>
                                <li>
                                	<a href="#tab4"><?php echo _e('Socials', 'gp'); ?></a>
								</li>
                                <li>
                                	<a href="#tab5"><?php echo _e('Forms', 'gp'); ?></a>
								</li>
                                <li>
                                	<a href="#tab6"><?php echo _e('Tracking', 'gp'); ?></a>
								</li>
                            </ul>
                            
                        </div><!-- gp-tabs-insider -->
                    </div><!-- gp-tabs-container -->
                </div><!-- gp-tabs -->
            
            </div><!-- gp-title -->
            
            <div class="gp-content">
                <div class="gp-content-container">
                    <div class="gp-content-insider">
                    
					<?php
                        $tab = 1;
						
                        foreach ($options as $value) { 
                        	switch ($value['type']) {
                        
								// START Tab
								case "start-tab": 
                    ?>
                    
                    			<div id="tab<?php echo $tab;?>">
        
                    			<?php
									// END Tab 
									$tab++;
									break;
									case "end-tab":
                    			?>
                    
                    			</div><!-- tab -->
                    
								<?php 
                                    // Open
                                    break;
                                    case "open":
                                ?>
                
                                <div class="gp-tab-content">
                
                                    <?php
                                        // Heading
                                        break;
                                        case "heading":
                                    ?>
                
                                    <div class="gp-h3-title">
                                        <h3>
                                            <?php echo $value['name']; ?>
                                        </h3>
                                    <br class="clear" />
                                    </div><!-- gp-h3-title -->
    
                                    <?php
                                        // Note
                                        break;
                                        case 'note':
                                    ?>
                
                                    <label>
                                        <?php echo $value['name']; ?>
                                    </label>
                                    
                                    <p class="description">
                                        <?php echo $value['desc']; ?>
                                    </p>
                
                                    <?php
                                        // Input
                                        break; 
                                        case 'text': 
                                    ?>
                
                                    <div class="input-box">
                                    
                                        <label for="<?php echo $value['id']; ?>">
                                            <?php echo $value['name']; ?>
                                        </label>
                                        
                                        <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if (get_option( $value['id']) != "") { echo stripslashes(htmlspecialchars(get_option($value['id']))); } else { echo $value['std']; } ?>" />
                                        
                                        <p class="description">
                                            <?php echo $value['desc']; ?>
                                        </p>
                                        
                                    <br class="clear" />    
                                    </div><!-- input-box -->
                
                                    <?php
                                        // Upload
                                        break; 
                                        case 'upload': 
                                    ?>
                
                                    <div class="input-box upload">
                                    
                                        <label for="<?php echo $value['id']; ?>">
                                            <?php echo $value['name']; ?>
                                        </label>
                                        
                                        <input id="<?php echo $value['id']; ?>" class="upload_image" type="text" size="36" name="<?php echo $value['id']; ?>" value="<?php if (get_option( $value['id']) != "") { echo stripslashes(htmlspecialchars(get_option($value['id']))); } else { echo $value['std']; } ?>" />
                                        <input class="upload_image_button" id="<?php echo $value['id']; ?>_button" type="button" value="Upload" />
                                        
                                        <p class="description">
                                            <?php echo $value['desc']; ?>
                                        </p>
                                        
                                    <br class="clear" />    
                                    </div><!-- input-box -->
                
                                    <?php
                                        // Picker
                                        break; 
                                        case 'picker': 
                                    ?>
                
                                    <div class="input-box color-picker">
                                    
                                        <label for="<?php echo $value['id']; ?>">
                                            <?php echo $value['name']; ?>
                                        </label>
                                        
                                        <input id="<?php echo $value['id']; ?>" class="picker" type="text" name="<?php echo $value['id']; ?>" value="<?php if (get_option( $value['id']) != "") { echo stripslashes(htmlspecialchars(get_option($value['id']))); } else { echo $value['std']; } ?>" />
                                        
                                        <p class="description">
                                            <?php echo $value['desc']; ?>
                                        </p>
                                        
                                    <br class="clear" />    
                                    </div><!-- input-box -->
                
                                    <?php
                                        // Picker Transparency Picker
                                        break; 
                                        case 'picker_transparency_picker': 
                                    ?>
                
                                    <div class="input-box picker-transparency color-picker">
                                    
                                        <label for="<?php echo $value['id']; ?>">
                                            <?php echo $value['name']; ?>
                                        </label>
                                        
                                        <div class="picker-container">
                                            <input id="<?php echo $value['id']; ?>" class="picker" type="text" name="<?php echo $value['id']; ?>" value="<?php if (get_option( $value['id']) != "") { echo stripslashes(htmlspecialchars(get_option($value['id']))); } else { echo $value['std']; } ?>" />
                                        </div>
                
                                        <?php
                                            // Picker Transparency Checkbox
                                            break; 
                                            case 'picker_transparency_checkbox': 
                                        ?>
                
                                        <div class="check-box-container">
                                            <?php
                                            $std = $value['std'];  
                                            $saved = get_option($value['id']);
                                            $checked = '';
                                            
                                            if(!empty($saved)) {
                                                if($saved == 'true') {
                                                    $checked = 'checked="checked"';
                                                } else {
                                                    $checked = '';
                                                }
                                            } else if($std == 'true') {
                                                $checked = 'checked="checked"';
                                            } else {
                                                $checked = '';
                                            }
                                            ?>
                                            <input type="checkbox" class="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                                            
                                            <label for="<?php echo $value['id']; ?>">
                                                <?php echo $value['name']; ?>
                                            </label>
                                            
                                        </div><!-- check-box-container -->
                                        
                                        <p class="description">
                                            <?php echo $value['desc']; ?>
                                        </p>
                                        
                                    <br class="clear" />        
                                    </div><!-- input-box -->
                                
                                    <?php
                                        // Textarea
                                        break; 
                                        case 'textarea': 
                                    ?>
                                                
                                    <div class="input-box">
                                    
                                        <label for="<?php echo $value['id']; ?>">
                                            <?php echo $value['name']; ?>
                                        </label>
                                        
                                        <textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>"><?php if (get_option( $value['id']) != "") { echo do_shortcode(stripslashes(htmlspecialchars(get_option( $value['id'])))); } else { echo $value['std']; } ?></textarea>
                                        
                                        <p class="description">
                                            <?php echo $value['desc']; ?>
                                        </p>
                                        
                                    <br class="clear" />    
                                    </div><!-- input-box -->
                
                                    <?php
                                        // Big Textarea
                                        break; 
                                        case 'bigtextarea': 
                                    ?>
                                    
                                    <div class="input-box big-textarea">
                                    
                                        <label for="<?php echo $value['id']; ?>">
                                            <?php echo $value['name']; ?>
                                        </label>
                                        
                                        <textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>"><?php if (get_option( $value['id']) != "") { echo stripslashes(htmlspecialchars(get_option( $value['id']))); } else { echo $value['std']; } ?></textarea>
                                        
                                        <p class="description">
                                            <?php echo $value['desc']; ?>
                                        </p>
                                        
                                    <br class="clear" />    
                                    </div><!-- input-box -->
                
                                    <?php
                                        // Select
                                        break; 
                                        case 'select': 
                                    ?>
                                    
                                    <div class="input-box">
                                    
                                        <label for="<?php echo $value['id']; ?>">
                                            <?php echo $value['name']; ?>
                                        </label>
                                        
                                        <div class="select-box">
                                            <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
                                                <?php foreach ($value['options'] as $option) { ?>
                                                    <option<?php if ( get_option( $value['id'] ) == $option) {
                                                        echo ' selected="selected"'; 
                                                    } elseif ($option == $value['std']) { 
                                                        echo ' selected="selected"'; 
                                                    } ?>>
                                                    <?php echo $option; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        
                                        <p class="description">
                                            <?php echo $value['desc']; ?>
                                        </p>
                                        
                                    <br class="clear" />    
                                    </div><!-- input-box -->
                
                                    <?php
                                        // Checkbox
                                        break; 
                                        case "checkbox": 
                                    ?>
                
                                    <div class="input-box">
                                    
                                        <label for="<?php echo $value['id']; ?>">
                                            <?php echo $value['name']; ?>
                                        </label>
                                        
                                        <?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                                        <input type="checkbox" class="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                                        
                                        <p class="description">
                                            <?php echo $value['desc']; ?>
                                        </p>
                                        
                                    <br class="clear" />    
                                    </div><!-- input-box -->
                
                                <?php
                                    // Close
                                    break;
                                    case "close":
                                ?>
                                
                				<br class="clear" />
                                </div><!-- gp-tab-content -->
                    
                                <div class="gp-save">
                                    <div class="gp-save-container">
                                        <input name="gp_save" type="submit" class="button-primary" value="<?php echo _e('Save options', 'gp'); ?>" />
                                        <input type="hidden" name="action" value="gp_save" />
                                    </div><!-- gp-save-container -->
                                </div><!-- gp-save -->
                    
					<?php 
                        	break;
                        	} //switch
                    	} //foreach
                    ?>
                    
                    </div><!-- gp-content-insider -->    
                </div><!-- gp-content-container -->
            </div><!-- gp-content -->
        </div><!-- gp-tabs -->
    
    </form>
    
    <form action="" method="post">
    	
        <div class="gp-reset">
            <div class="gp-reset-container">
                <input name="gp_reset" type="submit" class="button-secondary" onclick="return confirm('<?php echo _e('Are you sure you want to reset the theme options to the default?', 'gp'); ?>')" value="<?php echo _e('Reset options', 'gp'); ?>" />
                <input type="hidden"name="action" value="gp_reset" />
            </div><!-- gp-reset-container -->
        </div><!-- gp-reset -->
       
    </form>
    
</div><!-- gp-theme-admin -->

<?php

}

// END // Theme Admin

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

?>