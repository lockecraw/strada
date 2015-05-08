<?php

// Widget - Testimonial

class widget_testimonial extends WP_Widget {

	function widget_testimonial() {
		$widget_ops = array (
			'classname' => 'widget_testimonial',
			'description' => __('Widget that displays testimonial.', 'gp')
		);
		$control_ops = array (
			'width' => 500,
			'heigth' => 500,
			'id_base' => 'widget_testimonial'
		);
		$this->WP_Widget (
			'widget_testimonial',
			__('Linguini: Testimonial', 'gp'),
			$widget_ops,
			$control_ops
		);
	}
	
	function widget($args, $instance) {
		extract($args);
		$testimonial = '<div class="testimonial"><div class="testimonial-content">'.do_shortcode($instance['testimonial']).'</div></div>';
		$author = '<div class="testimonial-author">'.stripslashes($instance['author']).'</div>';
		echo $before_widget;
		if ( $testimonial )
			printf( __('%1$s', 'widget_testimonial'), $testimonial );
		if ( $author )
			printf( __('%1$s', 'widget_testimonial'), $author );
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['testimonial'] = $new_instance['testimonial'];
		$instance['author'] = $new_instance['author'];
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args((array) $instance);
		 
		$testimonial = isset($instance['testimonial']) ? esc_attr($instance['testimonial']) : '';
		$author = isset($instance['author']) ? esc_attr($instance['author']) : '';
		
		?>

            <p>
                <label for="<?php echo $this->get_field_id('testimonial'); ?>"><?php _e('Testimonial', 'gp'); ?>:</label>
                <textarea id="<?php echo $this->get_field_id('testimonial'); ?>" name="<?php echo $this->get_field_name('testimonial'); ?>" style="width:100%;height:150px;"><?php echo $testimonial; ?></textarea>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('author'); ?>"><?php _e('Author', 'gp'); ?>:</label>
                <textarea id="<?php echo $this->get_field_id('author'); ?>" name="<?php echo $this->get_field_name('author'); ?>" style="width:100%;height:50px;"><?php echo $author; ?></textarea>
            </p>

	    <?php
	}
}

// END // Widget - Testimonial

?>