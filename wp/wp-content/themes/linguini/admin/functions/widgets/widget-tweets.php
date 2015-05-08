<?php

// Widget - Tweets

class widget_tweets extends WP_Widget {
	
	function widget_tweets() {
		$widget_ops = array (
			'classname' => 'widget_tweets',
			'description' => __('Widget that displays latest tweets from the Twitter account.', 'gp')
		);
		$control_ops = array (
			'id_base' => 'widget_tweets'
		);
		$this->WP_Widget (
			'widget_tweets', 
			__('Linguini: Latest tweets', 'gp'),
			$widget_ops, 
			$control_ops
		);
	}
	
	function widget($args, $instance) {
		extract($args);
		$unique_id = uniqid();
		$box_title = apply_filters('widget_title', empty( $instance['box_title'] ) ? __('Latest tweets', 'gp') : $instance['box_title']);
		echo $before_widget;
		echo $before_title . $box_title . $after_title;
		?>
		<?php if (!empty($instance['username'])) { ?>

            <script type="text/javascript">
			//<![CDATA[
                jQuery(document).ready(function(){
                    jQuery("#widget_tweets<?php echo $unique_id ?>").tweet({
                        username: "<?php echo $instance['username'] ?>",
                        avatar_size: 0,
                        count: <?php echo $instance['tweet_number'] ?>,
                        loading_text: '<?php _e('Loading latest tweets ...', 'gp'); ?>'
                    });
                });
			//]]>
            </script>
            <div class="widget-content">
            	<div id="widget_tweets<?php echo $unique_id ?>"></div>
			<br class="clear" />
			</div>
            
			<?php
            	$twitter_username = $instance['username'];
				if (!empty($instance['continue_button']))  {
				?>
					<div class="button-standard button">
						<a href="http://twitter.com/<?php echo $instance['username'] ?>" title="<?php printf(__('Follow %1$s on Twitter', 'gp'), $twitter_username); ?>">
							<?php echo $instance['continue_button_text'] ?> &rsaquo;
						</a>
					</div>
				<?php    
				}
            ?>
		
        <?php } ?>
        
		<?php
		echo $after_widget;
		wp_reset_query();
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['box_title'] = strip_tags($new_instance['box_title']);
		$instance['username'] = $new_instance['username'];
		$instance['tweet_number'] = $new_instance['tweet_number'];
		$instance['continue_button'] = $new_instance['continue_button'];
		$instance['continue_button_text'] = $new_instance['continue_button_text'];
		return $instance;
	}
	
	function form( $instance ) {
		$defaults = array(
			'box_title' => __('Latest tweets', 'gp'),
			'continue_button' => 1,
			'continue_button_text' => __('Follow us on Twitter', 'gp')
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		 
		$box_title = isset($instance['box_title']) ? esc_attr($instance['box_title']) : '';
		$username = isset($instance['username']) ? esc_attr($instance['username']) : '';
		$tweet_number = isset($instance['tweet_number']) ? esc_attr($instance['tweet_number']) : '';
		$continue_button = isset($instance['continue_button']) ? esc_attr($instance['continue_button']) : '';
		$continue_button_text = isset($instance['continue_button_text']) ? esc_attr($instance['continue_button_text']) : '';
		
		?>

            <p>
                <label for="<?php echo $this->get_field_id('box_title'); ?>"><?php _e('Title', 'gp'); ?>:</label>
                <input id="<?php echo $this->get_field_id('box_title'); ?>" name="<?php echo $this->get_field_name('box_title'); ?>" value="<?php echo $box_title; ?>" style="width:100%;" />
            </p>
    
            <p>
                <label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Twitter username', 'gp'); ?>:</label> 
                <input id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo $username; ?>" style="width:100%;" />
            </p>
            
            <p>
                <label for="<?php echo $this->get_field_id('tweet_number'); ?>"><?php _e('Number of tweets', 'gp'); ?>:</label> 
                <input id="<?php echo $this->get_field_id('tweet_number'); ?>" name="<?php echo $this->get_field_name('tweet_number'); ?>" type="text" value="<?php echo $tweet_number; ?>" style="width:100%;" />
            </p>
            
            <p>
                <label for="<?php echo $this->get_field_id('continue_button'); ?>"><?php _e('Show button?', 'gp'); ?></label>
                <input type="checkbox" id="<?php echo $this->get_field_id('continue_button'); ?>" name="<?php echo $this->get_field_name('continue_button'); ?>" <?php if ($continue_button) { ?> checked="checked" <?php } ?> />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('continue_button_text'); ?>"><?php _e('Button text', 'gp'); ?>:</label>
                <input id="<?php echo $this->get_field_id('continue_button_text'); ?>" name="<?php echo $this->get_field_name('continue_button_text'); ?>" value="<?php echo $continue_button_text; ?>" style="width:100%;" />
            </p>
        
    	<?php
	}
}

// END // Widget - Tweets

?>