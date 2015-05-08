<?php header("HTTP/1.1 404 Not Found"); ?>
<?php header("Status: 404 Not Found"); ?>
<?php get_header(); ?>
		
        <div class="page-header">
            <h1><?php _e('404 Page not found', 'gp'); ?></h1>
        </div><!-- page-header -->
        		
		<div class="content shadow-top left">
            <div class="content-container">
            
                <div class="page-full left">
                    
                    <div class="page-not-found content-page left">
                            
							<?php 
								$blog_title = get_bloginfo('name'); 
								$blog_url = home_url();
							?>
                            <h2><?php _e('Sorry, this page was not found.', 'gp'); ?></h2> <br />
                            <p><?php printf(__('You can try to return to the <a title="%1$s homepage" href="%2$s">%1$s homepage</a> and start fresh.', 'gp'), $blog_title, $blog_url); ?></p>
                    
                    <br class="clear" />
                    </div><!-- page-content -->
                    
                </div><!-- page-full -->
                    
            <br class="clear" />
            </div><!-- content-container -->
        </div><!-- content -->

<?php get_footer(); ?>
