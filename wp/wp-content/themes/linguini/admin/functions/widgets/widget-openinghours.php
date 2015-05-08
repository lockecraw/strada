<?php

// Widget - Opening Hours Box

class widget_opening_hours extends WP_Widget {

	function widget_opening_hours() {
		$widget_ops = array (
			'classname' => 'widget_opening_hours',
			'description' => __('Widget that displays opening hours.', 'gp')
		);
		$control_ops = array (
			'width' => 500,
			'heigth' => 500,
			'id_base' => 'widget_opening_hours'
		);
		$this->WP_Widget (
			'widget_opening_hours',
			__('Linguini: Opening hours', 'gp'),
			$widget_ops,
			$control_ops
		);
	}
	
	function widget($args, $instance) {
		extract($args);
		$box_title = apply_filters('widget_title', $instance['box_title'] );
		echo $before_widget;
		if ($box_title)
			echo $before_title . $box_title . $after_title;
		if (!empty($instance['monday'])) { ?>
			<div class="day left"><strong class="left"><?php _e('Monday', 'gp'); ?></strong> <span class="right"><?php echo $instance['monday'] ?></span></div>
        <?php }
		if (!empty($instance['tuesday'])) { ?>
			<div class="day left"><strong class="left"><?php _e('Tuesday', 'gp'); ?></strong> <span class="right"><?php echo $instance['tuesday'] ?></span></div>
        <?php }
		if (!empty($instance['wednesday'])) { ?>
			<div class="day left"><strong class="left"><?php _e('Wednesday', 'gp'); ?></strong> <span class="right"><?php echo $instance['wednesday'] ?></span></div>
        <?php }
		if (!empty($instance['thursday'])) { ?>
			<div class="day left"><strong class="left"><?php _e('Thursday', 'gp'); ?></strong> <span class="right"><?php echo $instance['thursday'] ?></span></div>
        <?php }
		if (!empty($instance['friday'])) { ?>
			<div class="day left"><strong class="left"><?php _e('Friday', 'gp'); ?></strong> <span class="right"><?php echo $instance['friday'] ?></span></div>
        <?php }
		if (!empty($instance['saturday'])) { ?>
			<div class="day left"><strong class="left"><?php _e('Saturday', 'gp'); ?></strong> <span class="right"><?php echo $instance['saturday'] ?></span></div>
        <?php }
		if (!empty($instance['sunday'])) { ?>
			<div class="day last left"><strong class="left"><?php _e('Sunday', 'gp'); ?></strong> <span class="right"><?php echo $instance['sunday'] ?></span></div>
        <?php }
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['box_title'] = $new_instance['box_title'];
		$instance['monday'] = $new_instance['monday'];
		$instance['tuesday'] = $new_instance['tuesday'];
		$instance['wednesday'] = $new_instance['wednesday'];
		$instance['thursday'] = $new_instance['thursday'];
		$instance['friday'] = $new_instance['friday'];
		$instance['saturday'] = $new_instance['saturday'];
		$instance['sunday'] = $new_instance['sunday'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array(
			'box_title' => __('Opening hours', 'gp'),
			'monday' => '12:00 - 24:00',
			'tuesday' => '12:00 - 24:00',
			'wednesday' => '12:00 - 24:00',
			'thursday' => '12:00 - 24:00',
			'friday' => '12:00 - 24:00',
			'saturday' => '12:00 - 24:00',
			'sunday' => '12:00 - 24:00',
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		 
		$box_title = isset($instance['box_title']) ? esc_attr($instance['box_title']) : '';
		$monday = isset($instance['monday']) ? esc_attr($instance['monday']) : '';
		$tuesday = isset($instance['tuesday']) ? esc_attr($instance['tuesday']) : '';
		$wednesday = isset($instance['wednesday']) ? esc_attr($instance['wednesday']) : '';
		$thursday = isset($instance['thursday']) ? esc_attr($instance['thursday']) : '';
		$friday = isset($instance['friday']) ? esc_attr($instance['friday']) : '';
		$saturday = isset($instance['saturday']) ? esc_attr($instance['saturday']) : '';
		$sunday = isset($instance['sunday']) ? esc_attr($instance['sunday']) : '';
		
		?>

            <p>
                <label for="<?php echo $this->get_field_id('box_title'); ?>"><?php _e('Title', 'gp'); ?>:</label>
                <input id="<?php echo $this->get_field_id('box_title'); ?>" name="<?php echo $this->get_field_name('box_title'); ?>" value="<?php echo $box_title; ?>" style="width:100%;" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('monday'); ?>"><?php _e('Monday\'s time', 'gp'); ?>:</label>
                <input id="<?php echo $this->get_field_id('monday'); ?>" name="<?php echo $this->get_field_name('monday'); ?>" value="<?php echo $monday; ?>" style="width:100%;" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('tuesday'); ?>"><?php _e('Tuesday\'s time', 'gp'); ?>:</label>
                <input id="<?php echo $this->get_field_id('tuesday'); ?>" name="<?php echo $this->get_field_name('tuesday'); ?>" value="<?php echo $tuesday; ?>" style="width:100%;" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('wednesday'); ?>"><?php _e('Wednesday\'s time', 'gp'); ?>:</label>
                <input id="<?php echo $this->get_field_id('wednesday'); ?>" name="<?php echo $this->get_field_name('wednesday'); ?>" value="<?php echo $wednesday; ?>" style="width:100%;" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('thursday'); ?>"><?php _e('Thursday\'s time', 'gp'); ?>:</label>
                <input id="<?php echo $this->get_field_id('thursday'); ?>" name="<?php echo $this->get_field_name('thursday'); ?>" value="<?php echo $thursday; ?>" style="width:100%;" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('friday'); ?>"><?php _e('Friday\'s time', 'gp'); ?>:</label>
                <input id="<?php echo $this->get_field_id('friday'); ?>" name="<?php echo $this->get_field_name('friday'); ?>" value="<?php echo $friday; ?>" style="width:100%;" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('saturday'); ?>"><?php _e('Saturday\'s time', 'gp'); ?>:</label>
                <input id="<?php echo $this->get_field_id('saturday'); ?>" name="<?php echo $this->get_field_name('saturday'); ?>" value="<?php echo $saturday; ?>" style="width:100%;" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('sunday'); ?>"><?php _e('Sunday\'s time', 'gp'); ?>:</label>
                <input id="<?php echo $this->get_field_id('sunday'); ?>" name="<?php echo $this->get_field_name('sunday'); ?>" value="<?php echo $sunday; ?>" style="width:100%;" />
            </p>
	
    	<?php
	}
}

// END // Widget - Opening Hours Box

?>