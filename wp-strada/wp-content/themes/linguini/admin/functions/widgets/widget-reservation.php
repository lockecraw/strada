<?php

// Widget - Reservation

class widget_reservation extends WP_Widget {

	function widget_reservation() {
		$widget_ops = array (
			'classname' => 'widget_reservation',
			'description' => __('Widget that displays reservation form.', 'gp')
		);
		$control_ops = array (
			'width' => 500,
			'heigth' => 500,
			'id_base' => 'widget_reservation'
		);
		$this->WP_Widget (
			'widget_reservation',
			__('Linguini: Quick reservation', 'gp'),
			$widget_ops,
			$control_ops
		);
	}
	
	function widget($args, $instance) {
		extract($args);
		$box_title = apply_filters('widget_title', $instance['box_title'] );
		$box_content = '<p>' . do_shortcode($instance['box_content']) . '</p>';
		echo $before_widget;
		if ( $box_title )
			echo $before_title . $box_title . $after_title;
		if ( $box_content )
			printf( __('%1$s', 'widget_reservation'), $box_content );
    
	?>
    
    <?php
    
	if(isset($_POST['submitted'])) {
	
		if(trim($_POST['reservation_quick_datepicker']) === '' || trim($_POST['reservation_quick_datepicker']) == __('Date', 'gp')) {
			$datepicker_error = __('Please select a date!', 'gp');
			$has_error = true;
		} else {
			$date_field = trim($_POST['reservation_quick_datepicker']);
		}
		
		if(trim($_POST['reservation_quick_time']) === '' || trim($_POST['reservation_quick_time']) == __('Time', 'gp')) {
			$time_error = __('Please fill the time!', 'gp');
			$has_error = true;
		} else {
			$time_field = trim($_POST['reservation_quick_time']);
		}
		
		if(trim($_POST['reservation_quick_persons']) === '' || trim($_POST['reservation_quick_persons']) == __('Number of persons', 'gp')) {
			$persons_error = __('Please fill the number of persons!', 'gp');
			$has_error = true;
		} else {
			$persons_field = trim($_POST['reservation_quick_persons']);
		}
		
		if(trim($_POST['reservation_quick_name']) === '' || trim($_POST['reservation_quick_name']) == __('Name', 'gp')) {
			$name_error = __('Please fill your name!', 'gp');
			$has_error = true;
		} else {
			$name_field = trim($_POST['reservation_quick_name']);
		}
		
		if(trim($_POST['reservation_quick_phone']) === '' || trim($_POST['reservation_quick_phone']) == __('Phone', 'gp')) {
			$phone_error = __('Please fill your phone number!', 'gp');
			$has_error = true;
		} else {
			$phone_field = trim($_POST['reservation_quick_phone']);
		}
	
		if(trim($_POST['reservation_quick_email']) === '')  {
			$email_error = __('Please fill your email address!', 'gp');
			$has_error = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['reservation_quick_email']))) {
			$email_error = __('Please fill your valid email address!', 'gp');
			$has_error = true;
		} else {
			$email_field = trim($_POST['reservation_quick_email']);
		}
	
		if(!isset($has_error)) {
			
			$date_title = __('Date and time:', 'gp');
			$persons_title = __('Number of persons:', 'gp');
			$name_title = __('Name:', 'gp');
			$phone_title = __('Phone:', 'gp');
			$email_title = __('Email:', 'gp');
			$message_title = __('Message:', 'gp');
		
			$to = get_option('gp_form_reservations_email');
			if (!isset($to) || ($to == '') ){
				$to = get_option('admin_email');
			}
			$subject = get_option('gp_form_reservations_subject');
			$body = "
	
			<html>
			<body style='font-family:Arial, Verdana, Tahoma, sans-serif;margin:0;padding:0;font-size:12px;color:#50505a;'>
			
				<table width='100%' border='0' cellpadding='0' cellspacing='0' bgcolor='#f5f5fa'>
		
					<tr>
						<td style='background:#f5f5fa;' align='center'>
							
							<table width='600' border='0' cellspacing='0' cellpadding='0' bgcolor='#ffffff' style='padding:15px 30px 30px 30px; margin:30px 0;'>
					
								<tr>
									<th colspan='2' style='text-align: left;'><h1 style='font-size:22px;padding-bottom:10px;'>$subject</h1></th>
								</tr>
								
								<tr> 
									<th style='text-align:left;width:150px;padding:7px 0;border-bottom:1px solid #f5f5fa;'>
										$date_title
									</th>
									<td style='padding:7px 0;border-bottom:1px solid #f5f5fa;'> 
										$date_field, $time_field
									</td>
								</tr>
								
								<tr> 
									<th style='text-align:left;width:150px;padding:7px 0;border-bottom:1px solid #f5f5fa;'>
										$persons_title
									</th>
									<td style='padding:7px 0;border-bottom:1px solid #f5f5fa;'> 
										$persons_field
									</td>
								</tr>
								
								<tr> 
									<th style='text-align:left;width:150px;padding:7px 0;border-bottom:1px solid #f5f5fa;'>
										$name_title
									</th>
									<td style='padding:7px 0;border-bottom:1px solid #f5f5fa;'> 
										$name_field
									</td>
								</tr>
								
								<tr> 
									<th style='text-align:left;width:150px;padding:7px 0;border-bottom:1px solid #f5f5fa;'>
										$phone_title
									</th>
									<td style='padding:7px 0;border-bottom:1px solid #f5f5fa;'> 
										$phone_field
									</td>
								</tr>
								
								<tr> 
									<th style='text-align:left;width:150px;padding:7px 0;border-bottom:1px solid #f5f5fa;'>
										$email_title
									</th>
									<td style='padding:7px 0;border-bottom:1px solid #f5f5fa;'> 
										$email_field
									</td>
								</tr>
								
							</table>
							
						</td>
					</tr>
				
				</table>
			
			</body>
			</html>
			
			";
			
			$headers = array('From: ' . $name_field . ' <' . $email_field . '>', 'Content-Type: text/html', 'Reply-To:' . $email_field);
			$h = implode("\r\n",$headers) . "\r\n";
	
			wp_mail($to, $subject, $body, $h);
			$has_sent = true;
		}
	}
	
	?>
    
		<script type="text/javascript">
        //<![CDATA[
			jQuery(document).ready(function() {
				var options = {
					beforeSubmit: function(){
						jQuery('#form-reservation-quick .loading').removeClass('no-display');
					},
					success: function() {
						jQuery('#form-reservation-quick .loading').addClass('no-display');
						jQuery('#form-reservation-quick .validation-success-quick').fadeIn(500).delay(5000).fadeOut(500);
					},
					resetForm: true
				};
				jQuery("#form-reservation-quick").validate({
					onkeyup: false,
					onblur: false,
					onclick: false,
					ignoreTitle: true,
					rules: {
						reservation_quick_datepicker: 'reservation_quick_datepicker',
						reservation_quick_time: 'reservation_quick_time',
						reservation_quick_persons: 'reservation_quick_persons',
						reservation_quick_name: 'reservation_quick_name',
						reservation_quick_phone: 'reservation_quick_phone',
						reservation_quick_email: 'reservation_quick_email'
					},
					messages: {
						reservation_quick_datepicker: '<?php _e('Please select a date!', 'gp'); ?>',
						reservation_quick_time: '<?php _e('Please fill the time!', 'gp'); ?>',
						reservation_quick_persons: '<?php _e('Please fill the number of persons!', 'gp'); ?>',
						reservation_quick_name: '<?php _e('Please fill your name!', 'gp'); ?>',
						reservation_quick_phone: '<?php _e('Please fill your phone number!', 'gp'); ?>',
						reservation_quick_email: '<?php _e('Please fill your email address!', 'gp'); ?>'
					},
					submitHandler: function(form) {
						jQuery(form).ajaxSubmit(options);
					}
				});
				jQuery.validator.addMethod("reservation_quick_datepicker", function(value) { return value != '<?php _e('Date', 'gp'); ?>'; });
				jQuery.validator.addMethod("reservation_quick_time", function(value) { return value != '<?php _e('Time', 'gp'); ?>'; });
				jQuery.validator.addMethod('reservation_quick_persons', function(value) { return value != '<?php _e('Number of persons', 'gp'); ?>'; });
				jQuery.validator.addMethod('reservation_quick_name', function(value) { return value != '<?php _e('Name', 'gp'); ?>'; });
				jQuery.validator.addMethod('reservation_quick_phone', function(value) { return value != '<?php _e('Phone', 'gp'); ?>'; });
				jQuery.validator.addMethod('reservation_quick_email', function(value) { return value != '<?php _e('Email', 'gp'); ?>'; });
			});
			jQuery(function() {
				jQuery("#reservation_quick_datepicker").datepicker({ 
					firstDay: 1,
					dayNames: ['<?php _e('Sunday', 'gp'); ?>', '<?php _e('Monday', 'gp'); ?>', '<?php _e('Tuesday', 'gp'); ?>', '<?php _e('Wednesday', 'gp'); ?>', '<?php _e('Thursday', 'gp'); ?>', '<?php _e('Friday', 'gp'); ?>', '<?php _e('Saturday', 'gp'); ?>'],
					dayNamesMin: ['<?php _e('Su', 'gp'); ?>', '<?php _e('Mo', 'gp'); ?>', '<?php _e('Tu', 'gp'); ?>', '<?php _e('We', 'gp'); ?>', '<?php _e('Th', 'gp'); ?>', '<?php _e('Fr', 'gp'); ?>', '<?php _e('Sa', 'gp'); ?>'],
					monthNames: ['<?php _e('January', 'gp'); ?>', '<?php _e('February', 'gp'); ?>', '<?php _e('March', 'gp'); ?>', '<?php _e('April', 'gp'); ?>', '<?php _e('May', 'gp'); ?>', '<?php _e('June', 'gp'); ?>', '<?php _e('July', 'gp'); ?>', '<?php _e('August', 'gp'); ?>', '<?php _e('September', 'gp'); ?>', '<?php _e('October', 'gp'); ?>', '<?php _e('November', 'gp'); ?>', '<?php _e('December', 'gp'); ?>'],
					nextText: '<?php _e('Next', 'gp'); ?>',
					prevText: '<?php _e('Prev', 'gp'); ?>'
				});
			});
		//]]>
		</script>

		<div class="form-reservation-quick">
			
			<form action="" id="form-reservation-quick" class="form form-widget" method="post">
				
				<fieldset>

					<div class="form-block left">
						
						<h4><?php _e('Reservation information', 'gp'); ?></h4>
						
						<div class="input-box-quick left">
							<input name="reservation_quick_datepicker" id="reservation_quick_datepicker" title="<?php _e('Please select a date!', 'gp'); ?>" class="required<?php if($datepicker_error != '') { ?> error<?php } ?>" type="text" value="<?php if (isset($_POST['reservation_quick_datepicker'])) { ?><?php echo $_POST['reservation_quick_datepicker']; ?><?php } else { ?><?php _e('Date', 'gp'); ?><?php } ?>" />
						</div>
						
                        <div class="input-box-quick left">
							<input name="reservation_quick_time" id="reservation_quick_time" title="<?php _e('Please fill the time!', 'gp'); ?>" class="required<?php if($time_error != '') { ?> error<?php } ?>" type="text" value="<?php if (isset($_POST['reservation_quick_time'])) { ?><?php echo $_POST['reservation_quick_time']; ?><?php } else { ?><?php _e('Time', 'gp'); ?><?php } ?>" />
						</div>
          						
						<div class="input-box-quick last left">
							<input name="reservation_quick_persons" id="reservation_quick_persons" title="<?php _e('Please fill the number of persons!', 'gp'); ?>" class="required number<?php if($persons_error != '') { ?> error<?php } ?>" type="text" value="<?php if (isset($_POST['reservation_quick_persons'])) { ?><?php echo $_POST['reservation_quick_persons']; ?><?php } else { ?><?php _e('Number of persons', 'gp'); ?><?php } ?>" />
						</div>
                                  
					</div>
					
					<div class="form-block left">
          					
                        <h4><?php _e('Personal information', 'gp'); ?></h4>
                        
                        <div class="input-box-quick left">
                            <input name="reservation_quick_name" id="reservation_quick_name" title="<?php _e('Please fill your name!', 'gp'); ?>" class="required<?php if($name_error != '') { ?> error<?php } ?>" type="text" value="<?php if (isset($_POST['reservation_quick_name'])) { ?><?php echo $_POST['reservation_quick_name']; ?><?php } else { ?><?php _e('Name', 'gp'); ?><?php } ?>" />
                        </div>
                        
                        <div class="input-box-quick left">
                            <input name="reservation_quick_phone" id="reservation_quick_phone" title="<?php _e('Please fill your phone number!', 'gp'); ?>" class="required number<?php if($phone_error != '') { ?> error<?php } ?>" type="text" value="<?php if (isset($_POST['reservation_quick_phone'])) { ?><?php echo $_POST['reservation_quick_phone']; ?><?php } else { ?><?php _e('Phone', 'gp'); ?><?php } ?>" />
                        </div>
                        
                        <div class="input-box-quick last left">
                            <input name="reservation_quick_email" id="reservation_quick_email" title="<?php _e('Please fill your email address!', 'gp'); ?>" class="required email<?php if($email_error != '') { ?> error<?php } ?>" type="text" value="<?php if (isset($_POST['reservation_quick_email'])) { ?><?php echo $_POST['reservation_quick_email']; ?><?php } else { ?><?php _e('Email', 'gp'); ?><?php } ?>" />
                        </div>
                        
                    </div>

                    <div class="buttons left">
                        <button type="submit" name="button-submit" class="button-standard left" title="<?php _e('Make a reservation', 'gp'); ?>"><?php _e('Make a reservation', 'gp'); ?></button>
                        <input type="hidden" name="submitted" id="submitted" value="true" />
                        <div class="loading no-display"><img src="<?php echo get_template_directory_uri(); ?>/images/loading.gif" alt="" /></div>
                    <br class="clear" />
                    </div>
                    
                    <div class="validation-success-quick validation-success no-display">
                        <h4>
                            <?php _e('Thank you. Email has been sent. Our staff will confirm you the booking by email or SMS.', 'gp'); ?>
                        </h4>
                    </div>
                    
                    <?php if(isset($has_sent) && $has_sent == true) { ?>
                        <div class="validation-success-quick validation-success">
                            <h4>
                                <?php _e('Thank you. Email has been sent. Our staff will confirm you the booking by email or SMS.', 'gp'); ?>
                            </h4>
                        </div>
                    <?php } ?>
                
                </fieldset>
                
			<br class="clear" />	
			</form>
			
			</div><!-- form-reservation-quick -->

	<script type="text/javascript">
		// Date
		jQuery('input[name=reservation_quick_datepicker]').focus(function(){ if (jQuery(this).val() == '<?php _e('Date', 'gp'); ?>') jQuery(this).val(''); });
		jQuery('input[name=reservation_quick_datepicker]').blur(function(){ if (jQuery(this).val() == '') jQuery(this).val('<?php _e('Date', 'gp'); ?>'); });
		// Time
		jQuery('input[name=reservation_quick_time]').focus(function(){ if (jQuery(this).val() == '<?php _e('Time', 'gp'); ?>') jQuery(this).val(''); });
		jQuery('input[name=reservation_quick_time]').blur(function(){ if (jQuery(this).val() == '') jQuery(this).val('<?php _e('Time', 'gp'); ?>'); });
		// Number of Persons
		jQuery('input[name=reservation_quick_persons]').focus(function(){ if (jQuery(this).val() == '<?php _e('Number of persons', 'gp'); ?>') jQuery(this).val(''); });
		jQuery('input[name=reservation_quick_persons]').blur(function(){ if (jQuery(this).val() == '') jQuery(this).val('<?php _e('Number of persons', 'gp'); ?>'); });
		// Name
		jQuery('input[name=reservation_quick_name]').focus(function(){ if (jQuery(this).val() == '<?php _e('Name', 'gp'); ?>') jQuery(this).val(''); });
		jQuery('input[name=reservation_quick_name]').blur(function(){ if (jQuery(this).val() == '') jQuery(this).val('<?php _e('Name', 'gp'); ?>'); });
		// Phone
		jQuery('input[name=reservation_quick_phone]').focus(function(){ if (jQuery(this).val() == '<?php _e('Phone', 'gp'); ?>') jQuery(this).val(''); });
		jQuery('input[name=reservation_quick_phone]').blur(function(){ if (jQuery(this).val() == '') jQuery(this).val('<?php _e('Phone', 'gp'); ?>'); });
		// Email
		jQuery('input[name=reservation_quick_email]').focus(function(){ if (jQuery(this).val() == '<?php _e('Email', 'gp'); ?>') jQuery(this).val(''); });
		jQuery('input[name=reservation_quick_email]').blur(function(){ if (jQuery(this).val() == '') jQuery(this).val('<?php _e('Email', 'gp'); ?>'); });
	</script>
    
    <?php
		
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['box_title'] = $new_instance['box_title'];
		$instance['box_content'] = $new_instance['box_content'];
		$instance['email'] = $new_instance['email'];
		$instance['subject'] = $new_instance['subject'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array(
			'box_title' => __('Quick reservation', 'gp')
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		 
		$box_title = isset($instance['box_title']) ? esc_attr($instance['box_title']) : '';
		$box_content = isset($instance['box_content']) ? esc_attr($instance['box_content']) : '';
		
		?>

            <p>
                <label for="<?php echo $this->get_field_id('box_title'); ?>"><?php _e('Title', 'gp'); ?>:</label>
                <input id="<?php echo $this->get_field_id('box_title'); ?>" name="<?php echo $this->get_field_name('box_title'); ?>" value="<?php echo $box_title; ?>" style="width:100%;" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('box_content'); ?>"><?php _e('Content', 'gp'); ?>:</label>
                <textarea id="<?php echo $this->get_field_id('box_content'); ?>" name="<?php echo $this->get_field_name('box_content'); ?>" style="width:100%;height:150px;"><?php echo $box_content; ?></textarea>
            </p>
	
    	<?php
	}
}

// END // Widget - Reservation

?>