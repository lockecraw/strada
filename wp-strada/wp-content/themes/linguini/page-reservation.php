<?php
/*
Template Name: Page: Reservation
*/
?>
<?php 

if(isset($_POST['submitted'])) {
	
	if(trim($_POST['reservation_datepicker']) === '') {
		$datepicker_error = __('Please select a date!', 'gp');
		$has_error = true;
	} else {
		$date_field = trim($_POST['reservation_datepicker']);
	}
  
  	if(trim($_POST['reservation_time']) === '') {
		$time_error = __('Please fill the time!', 'gp');
		$has_error = true;
	} else {
		$time_field = trim($_POST['reservation_time']);
	}
	
	if(trim($_POST['reservation_persons']) === '') {
		$persons_error = __('Please fill the number of persons!', 'gp');
		$has_error = true;
	} else {
		$persons_field = trim($_POST['reservation_persons']);
	}
	
	if(trim($_POST['reservation_name']) === '') {
		$name_error = __('Please fill your name!', 'gp');
		$has_error = true;
	} else {
		$name_field = trim($_POST['reservation_name']);
	}
	
	if(trim($_POST['reservation_phone']) === '') {
		$phone_error = __('Please fill your phone number!', 'gp');
		$has_error = true;
	} else {
		$phone_field = trim($_POST['reservation_phone']);
	}

	if(trim($_POST['reservation_email']) === '')  {
		$email_error = __('Please fill your email address!', 'gp');
		$has_error = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['reservation_email']))) {
		$email_error = __('Please fill your valid email address!', 'gp');
		$has_error = true;
	} else {
		$email_field = trim($_POST['reservation_email']);
	}

	if(function_exists('stripslashes')) {
		$message_field = stripslashes(trim($_POST['reservation_message']));
	} else {
		$message_field = trim($_POST['reservation_message']);
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
						
							<tr> 
								<th valign='top' style='text-align:left;width:150px;padding: 7px 0;'>
									$message_title
								</th>
								<td style='padding:7px 0;'> 
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
<?php get_header(); ?>
		
        <header class="page-header">
            <h1><?php the_title(); ?></h1>
        </header><!-- page-header -->
        		
		<div class="content shadow-top left">
            <div class="content-container">
                
                <div class="page-full left">
                	<div class="page-full-container">
    
						<?php
                        if (have_posts()) {
                            while (have_posts()) {
                                the_post();
                        ?>
                                <?php if (!empty($post->post_content)) { ?>
                                <div class="content-page left">
                                    <div class="content-page-container">
                                        <?php the_content(); ?>
                                    </div><!-- content-page-container -->
                                </div><!-- content-page -->
                                <?php } ?>
                        
                                <div class="form-reservation">
                        
                                    <form action="<?php the_permalink(); ?>" id="form-reservation" class="form" method="post">
                                        
                                        <fieldset>
                                            
                                            <div class="form-block first left">
                                                
                                                <header class="form-header">
                                                    <h2><?php _e('Reservation information', 'gp'); ?></h2>
                                                </header><!-- form-header -->
                                                
                                                <div class="input-box left">
                                                    <label for="reservation_datepicker" ><?php _e('Date', 'gp'); ?>:</label> <span class="required-star">*</span><br />
                                                    <input name="reservation_datepicker" id="reservation_datepicker" title="<?php _e('Please select a date!', 'gp'); ?>" class="required<?php if($datepicker_error != '') { ?> error<?php } ?>" type="text" value="<?php if(isset($_POST['reservation_datepicker']))  echo $_POST['reservation_datepicker'];?>" />
                                                    <?php if($datepicker_error != '') { ?>
                                                        <label for="reservation_datepicker" class="error"><?php echo $datepicker_error; ?></label>
                                                    <?php } ?>
                                                </div><!-- input-box -->
                                                
                                                <div class="input-box left">
                                                    <label for="reservation_time"><?php _e('Time', 'gp'); ?>:</label> <span class="required-star">*</span><br />
                                                    <input name="reservation_time" id="reservation_time" title="<?php _e('Please fill the time!', 'gp'); ?>" class="required<?php if($time_error != '') { ?> error<?php } ?>" type="text" value="<?php if(isset($_POST['reservation_time']))  echo $_POST['reservation_time'];?>" />
                                                    <?php if($time_error != '') { ?>
                                                        <label for="reservation_time" class="error"><?php echo $time_error; ?></label>
                                                    <?php } ?>
                                                </div><!-- input-box -->
                                                
                                                <div class="input-box left last">
                                                    <label for="reservation_persons"><?php _e('Number of persons', 'gp'); ?>:</label> <span class="required-star">*</span><br />
                                                    <input name="reservation_persons" id="reservation_persons" title="<?php _e('Please fill the number of persons!', 'gp'); ?>" class="required number<?php if($persons_error != '') { ?> error<?php } ?>" type="text" value="<?php if(isset($_POST['reservation_persons']))  echo $_POST['reservation_persons'];?>" />
                                                    <?php if($persons_error != '') { ?>
                                                        <label for="reservation_persons" class="error"><?php echo $persons_error; ?></label>
                                                    <?php } ?>
                                                </div><!-- input-box -->
                                                
                                            <br class="clear" />   
                                            </div><!-- form-block -->
                                            
                                            <div class="form-block">
                                                
                                                <header class="form-header">
                                                    <h2><?php _e('Personal information', 'gp'); ?></h2>
                                                </header>
                                                
                                                <div class="input-box left">
                                                    <label for="reservation_name"><?php _e('Name', 'gp'); ?>:</label> <span class="required-star">*</span><br />
                                                    <input name="reservation_name" id="reservation_name" title="<?php _e('Please fill your name!', 'gp'); ?>" class="required<?php if($name_error != '') { ?> error<?php } ?>" type="text" value="<?php if(isset($_POST['reservation_name']))  echo $_POST['reservation_name'];?>" />
                                                    <?php if($name_error != '') { ?>
                                                        <label for="reservation_name" class="error"><?php echo $name_error; ?></label>
                                                    <?php } ?>
                                                </div><!-- input-box -->
                                                
                                                <div class="input-box left">
                                                    <label for="reservation_phone"><?php _e('Phone, please enter as ex: 8285554444 ', 'gp'); ?>:</label> <span class="required-star">*</span><br />
                                                    <input name="reservation_phone" id="reservation_phone" title="<?php _e('Please fill your phone number!', 'gp'); ?>" class="required number<?php if($phone_error != '') { ?> error<?php } ?>" type="text" value="<?php if(isset($_POST['reservation_phone']))  echo $_POST['reservation_phone'];?>" />
                                                    <?php if($phone_error != '') { ?>
                                                        <label for="reservation_phone" class="error"><?php echo $phone_error; ?></label>
                                                    <?php } ?>
                                                </div><!-- input-box -->
                                                
                                                <div class="input-box last left">
                                                    <label for="reservation_email"><?php _e('Email', 'gp'); ?>:</label> <span class="required-star">*</span><br />
                                                    <input name="reservation_email" id="reservation_email" title="<?php _e('Please fill your email address!', 'gp'); ?>" class="required email<?php if($email_error != '') { ?> error<?php } ?>" type="text" value="<?php if(isset($_POST['reservation_email']))  echo $_POST['reservation_email'];?>" />
                                                    <?php if($email_error != '') { ?>
                                                        <label for="reservation_email" class="error"><?php echo $email_error; ?></label>
                                                    <?php } ?>
                                                </div><!-- input-box -->
                                            
                                                <div class="input-box-wide left">
                                                    <label for="reservation_message"><?php _e('Message', 'gp'); ?>:</label><br />
                                                    <textarea name="reservation_message" id="reservation_message" cols="110" rows="5" title="<?php _e('Please fill the message!', 'gp'); ?>"><?php if(isset($_POST['reservation_message'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['reservation_message']); } else { echo $_POST['reservation_message']; } } ?></textarea>
                                                </div><!-- input-box-wide -->
                                            
                                            <br class="clear" />   
                                            </div><!-- form-block -->
                                        
                                            <div class="buttons left">
                                                <button type="submit" name="button-submit" class="button-standard left" title="<?php _e('Make a reservation', 'gp'); ?>"><?php _e('Make a reservation', 'gp'); ?></button>
                                                <input type="hidden" name="submitted" id="submitted" value="true" />
                                                <div class="required-star-info">* <?php _e('Required fields', 'gp'); ?></div>
                                                <div class="loading no-display"><img src="<?php echo get_template_directory_uri(); ?>/images/loading.gif" alt="" /><span><?php _e('Sending email ...', 'gp'); ?></span></div>
                                            <br class="clear" />
                                            </div><!-- buttons -->
                                                                        
                                            <div class="validation-success no-display">
                                                <h4><?php _e('Thank you. Email has been sent. Our staff will confirm you the booking by email or SMS.', 'gp'); ?></h4>
                                            </div><!-- validation-success -->
                                            
                                            <?php if(isset($has_sent) && $has_sent == true) { ?>
                                            <div class="validation-success">
                                                <h4><?php _e('Thank you. Email has been sent. Our staff will confirm you the booking by email or SMS.', 'gp'); ?></h4>
                                            </div><!-- validation-success -->
                                            <?php } ?>
                                        
                                        </fieldset>
                                    
                                    <br class="clear" />
                                    </form>
                        
                                </div><!-- form-reservation -->
                                
                        <?php 
                            } //while
                        } //if
                        wp_reset_query();
                        ?>
    					
                    <br class="clear" />
                    </div><!-- page-full-container -->
                </div><!-- page-full -->
                
            <br class="clear" />
            </div><!-- content-container -->
        </div><!-- content -->

<?php get_footer(); ?>