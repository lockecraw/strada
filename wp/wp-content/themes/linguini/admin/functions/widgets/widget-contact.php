<?php

// Widget - contact

class widget_contact extends WP_Widget {

	function widget_contact() {
		$widget_ops = array (
			'classname' => 'widget_contact',
			'description' => __('Widget that displays contact form.', 'gp')
		);
		$control_ops = array (
			'width' => 500,
			'heigth' => 500,
			'id_base' => 'widget_contact'
		);
		$this->WP_Widget (
			'widget_contact',
			__('Linguini: Contact form', 'gp'),
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
			printf( __('%1$s', 'widget_contact'), $box_content );
    
	?>
    
    <?php
    
	if(isset($_POST['submitted'])) {
		
		if(trim($_POST['contact_quick_name']) === '' || trim($_POST['contact_quick_name']) == __('Name', 'gp')) {
			$name_error = __('Please fill your name!', 'gp');
			$has_error = true;
		} else {
			$name_field = trim($_POST['contact_quick_name']);
		}
		
		$phone_field = trim($_POST['contact_quick_phone']);
	
		if(trim($_POST['contact_quick_email']) === '')  {
			$email_error = __('Please fill your email address!', 'gp');
			$has_error = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['contact_quick_email']))) {
			$email_error = __('Please fill your valid email address!', 'gp');
			$has_error = true;
		} else {
			$email_field = trim($_POST['contact_quick_email']);
		}
		
		if(trim($_POST['contact_quick_message']) === '' || trim($_POST['contact_quick_message']) == __('Message', 'gp')) {
			$message_error = __('Please fill your message!', 'gp');
			$has_error = true;
		} else {
			$message_field = trim($_POST['contact_quick_message']);
		}
	
		if(!isset($has_error)) {
			
			$name_title = __('Name:', 'gp');
			$phone_title = __('Phone:', 'gp');
			$email_title = __('Email:', 'gp');
			$message_title = __('Message:', 'gp');
		
			$to = get_option('gp_form_contacts_email');
			if (!isset($to) || ($to == '') ){
				$to = get_option('admin_email');
			}
			$subject = get_option('gp_form_contacts_subject');
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
								
								<tr> 
									<th style='text-align:left;width:150px;padding:7px 0;border-bottom:1px solid #f5f5fa;'>
										$message_title
									</th>
									<td style='padding:7px 0;border-bottom:1px solid #f5f5fa;'> 
										$message_field
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
						jQuery('#form-contact-quick .loading').removeClass('no-display');
					},
					success: function() {
						jQuery('#form-contact-quick .loading').addClass('no-display');
						jQuery('#form-contact-quick .validation-success-quick').fadeIn(500).delay(5000).fadeOut(500);
					},
					resetForm: true
				};
				jQuery("#form-contact-quick").validate({
					onkeyup: false,
					onblur: false,
					onclick: false,
					ignoreTitle: true,
					rules: {
						contact_quick_name: 'contact_quick_name',
						contact_quick_email: 'contact_quick_email',
						contact_quick_message: 'contact_quick_message'
					},
					messages: {
						contact_quick_name: '<?php _e('Please fill your name!', 'gp'); ?>',
						contact_quick_email: '<?php _e('Please fill your email address!', 'gp'); ?>',
						contact_quick_phone: '<?php _e('Please fill the message!', 'gp'); ?>'
					},
					submitHandler: function(form) {
						jQuery(form).ajaxSubmit(options);
					}
				});
				jQuery.validator.addMethod('contact_quick_name', function(value) { return value != '<?php _e('Name', 'gp'); ?>'; });
				jQuery.validator.addMethod('contact_quick_email', function(value) { return value != '<?php _e('Email', 'gp'); ?>'; });
				jQuery.validator.addMethod('contact_quick_message', function(value) { return value != '<?php _e('Message', 'gp'); ?>'; });
			});
		//]]>
		</script>

		<div class="form-contact-quick">
			
			<form action="" id="form-contact-quick" class="form form-widget" method="post">
				
				<fieldset>
					
					<div class="form-block left">
                        
                        <div class="input-box-quick left">
                            <input name="contact_quick_name" id="contact_quick_name" title="<?php _e('Please fill your name!', 'gp'); ?>" class="required<?php if($name_error != '') { ?> error<?php } ?>" type="text" value="<?php if (isset($_POST['contact_quick_name'])) { ?><?php echo $_POST['contact_quick_name']; ?><?php } else { ?><?php _e('Name', 'gp'); ?><?php } ?>" />
                        </div>
                        
                        <div class="input-box-quick left">
                            <input name="contact_quick_phone" id="contact_quick_phone" title="<?php _e('Please fill your phone number!', 'gp'); ?>" type="text" value="<?php _e('Phone', 'gp'); ?>" />
                        </div>
                        
                        <div class="input-box-quick left">
                            <input name="contact_quick_email" id="contact_quick_email" title="<?php _e('Please fill your email address!', 'gp'); ?>" class="required email<?php if($email_error != '') { ?> error<?php } ?>" type="text" value="<?php if (isset($_POST['contact_quick_email'])) { ?><?php echo $_POST['contact_quick_email']; ?><?php } else { ?><?php _e('Email', 'gp'); ?><?php } ?>" />
                        </div>
                        
                        <div class="input-box-quick left">
                            <textarea name="contact_quick_message" id="contact_quick_message" class="required<?php if($message_error != '') { ?> error<?php } ?>" cols="110" rows="5" title="<?php _e('Please fill the message!', 'gp'); ?>"><?php if (isset($_POST['contact_quick_message'])) { ?><?php echo $_POST['contact_quick_message']; ?><?php } else { ?><?php _e('Message', 'gp'); ?><?php } ?></textarea>
                        </div><!-- input-box-wide -->
                        
                    </div>

                    <div class="buttons left">
                        <button type="submit" name="button-submit" class="button-standard left" title="<?php _e('Send email', 'gp'); ?>"><?php _e('Send email', 'gp'); ?></button>
                        <input type="hidden" name="submitted" id="submitted" value="true" />
                        <div class="loading no-display"><img src="<?php echo get_template_directory_uri(); ?>/images/loading.gif" alt="" /></div>
                    <br class="clear" />
                    </div>
                    
                    <div class="validation-success-quick validation-success no-display">
                        <h4><?php _e('Thank you. Email has been sent. We will contact you as soon as possible.', 'gp'); ?></h4>
                    </div>
                    
                    <?php if(isset($has_sent) && $has_sent == true) { ?>
                        <div class="validation-success-quick validation-success">
                            <h4><?php _e('Thank you. Email has been sent. We will contact you as soon as possible.', 'gp'); ?></h4>
                        </div>
                    <?php } ?>
                
                </fieldset>
                
			<br class="clear" />	
			</form>
			
			</div><!-- form-contact-quick -->

	<script type="text/javascript">
		// Name
		jQuery('input[name=contact_quick_name]').focus(function(){ if (jQuery(this).val() == '<?php _e('Name', 'gp'); ?>') jQuery(this).val(''); });
		jQuery('input[name=contact_quick_name]').blur(function(){ if (jQuery(this).val() == '') jQuery(this).val('<?php _e('Name', 'gp'); ?>'); });
		// Phone
		jQuery('input[name=contact_quick_phone]').focus(function(){ if (jQuery(this).val() == '<?php _e('Phone', 'gp'); ?>') jQuery(this).val(''); });
		jQuery('input[name=contact_quick_phone]').blur(function(){ if (jQuery(this).val() == '') jQuery(this).val('<?php _e('Phone', 'gp'); ?>'); });
		// Email
		jQuery('input[name=contact_quick_email]').focus(function(){ if (jQuery(this).val() == '<?php _e('Email', 'gp'); ?>') jQuery(this).val(''); });
		jQuery('input[name=contact_quick_email]').blur(function(){ if (jQuery(this).val() == '') jQuery(this).val('<?php _e('Email', 'gp'); ?>'); });
		// Message
		jQuery('textarea[name=contact_quick_message]').focus(function(){ if (jQuery(this).val() == '<?php _e('Message', 'gp'); ?>') jQuery(this).val(''); });
		jQuery('textarea[name=contact_quick_message]').blur(function(){ if (jQuery(this).val() == '') jQuery(this).val('<?php _e('Message', 'gp'); ?>'); });
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
			'box_title' => __('Quick contact', 'gp')
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

// END // Widget - contact

?>