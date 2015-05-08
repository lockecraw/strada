<?php

// Widget - About Box

class widget_about_box extends WP_Widget {

	function widget_about_box() {
		$widget_ops = array (
			'classname' => 'widget_about_box',
			'description' => __('Widget that displays information about you.', 'gp')
		);
		$control_ops = array (
			'width' => 500,
			'heigth' => 500,
			'id_base' => 'widget_about_box'
		);
		$this->WP_Widget (
			'widget_about_box',
			__('Linguini: About box', 'gp'),
			$widget_ops,
			$control_ops
		);
	}
	
	function widget($args, $instance) {
		extract($args);
		$box_title = apply_filters('widget_title', $instance['box_title'] );
		$box_content = '<div class="widget-content left">' . do_shortcode($instance['box_content']) . '<br class="clear" /></div>';
		echo $before_widget;
		if ($box_title)
			echo $before_title . $box_title . $after_title;
		if ($box_content)
			printf(__('%1$s', 'widget_about_box'), $box_content );
        if (!empty($instance['continue_button'])) {
		?>
		<div class="button-standard button">
        	<a href="<?php echo $instance['continue_button_link'] ?>" title="<?php echo $instance['continue_button_text'] ?>"><?php echo $instance['continue_button_text'] ?> &rsaquo;</a>
		</div>
        <?php    
		}
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['box_title'] = $new_instance['box_title'];
		$instance['box_content'] = $new_instance['box_content'];
		$instance['continue_button'] = $new_instance['continue_button'];
		$instance['continue_button_text'] = $new_instance['continue_button_text'];
		$instance['continue_button_link'] = $new_instance['continue_button_link'];
		return $instance;
	}
	
	function form($instance) {
		$defaults = array(
			'box_title' => __('About us', 'gp'),
			'continue_button_text' => __('More about us', 'gp'),
			'continue_button_link' => '/'
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		 
		$box_title = isset($instance['box_title']) ? esc_attr($instance['box_title']) : '';
		$box_content = isset($instance['box_content']) ? esc_attr($instance['box_content']) : '';
		$continue_button = isset($instance['continue_button']) ? esc_attr($instance['continue_button']) : '';
		$continue_button_text = isset($instance['continue_button_text']) ? esc_attr($instance['continue_button_text']) : '';
		$continue_button_link = isset($instance['continue_button_link']) ? esc_attr($instance['continue_button_link']) : '';
		
		?>

            <p>
                <label for="<?php echo $this->get_field_id('box_title'); ?>"><?php _e('Title', 'gp'); ?>:</label>
                <input id="<?php echo $this->get_field_id('box_title'); ?>" name="<?php echo $this->get_field_name('box_title'); ?>" value="<?php echo $box_title; ?>" style="width:100%;" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('box_content'); ?>"><?php _e('Content', 'gp'); ?>:</label>
                <textarea id="<?php echo $this->get_field_id('box_content'); ?>" name="<?php echo $this->get_field_name('box_content'); ?>" style="width:100%;height:150px;"><?php echo $box_content; ?></textarea>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('continue_button'); ?>"><?php _e('Show button?', 'gp'); ?></label>
                <input type="checkbox" id="<?php echo $this->get_field_id('continue_button'); ?>" name="<?php echo $this->get_field_name('continue_button'); ?>" <?php if ($continue_button) { ?> checked="checked" <?php } ?> />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('continue_button_text'); ?>"><?php _e('Button text', 'gp'); ?>:</label>
                <input id="<?php echo $this->get_field_id('continue_button_text'); ?>" name="<?php echo $this->get_field_name('continue_button_text'); ?>" value="<?php echo $continue_button_text; ?>" style="width:100%;" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('continue_button_link'); ?>"><?php _e('Button URL', 'gp'); ?>:</label>
                <input id="<?php echo $this->get_field_id('continue_button_link'); ?>" name="<?php echo $this->get_field_name('continue_button_link'); ?>" value="<?php echo $continue_button_link; ?>" style="width:100%;" />
            </p>
	
    	<?php
	}
}

// END // Widget - About Box

?>