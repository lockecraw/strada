
    <br class="clear" />
    </div><!-- canvas -->
    
    <div class="widget-area-footer left">
        <div class="widget-area-footer-container">
            
		<?php if (is_active_sidebar('widget_area_footer_left')) { ?>
            <div class="widget-area-footer-left widget-area left">
                <?php dynamic_sidebar('widget_area_footer_left'); ?>
            </div>
        <?php } ?>
        
        <?php if (is_active_sidebar('widget_area_footer_center')) { ?>
            <div class="widget-area-footer-center widget-area left">
                <?php dynamic_sidebar('widget_area_footer_center'); ?>
            </div>
        <?php } ?>
        
        <?php if (is_active_sidebar('widget_area_footer_right')) { ?>
            <div class="widget-area-footer-right widget-area left">
                <?php dynamic_sidebar('widget_area_footer_right'); ?>
            </div>
        <?php } ?>
        
        <?php if ( is_active_sidebar( 'widget_area_footer_left') || is_active_sidebar( 'widget_area_footer_center' ) || is_active_sidebar( 'widget_area_footer_right' )) { ?>
        <br class="clear" />
        <?php } ?>
        </div>
    </div><!-- footer-areas -->
    
    <footer class="footer left">
        <div class="footer-container">
                    
            <div class="copyright left">
				<?php _e('Copyright', 'gp'); ?> &copy; <?php echo the_date('Y'); ?> <a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name'); ?>"><?php echo get_bloginfo('name'); ?></a>. <?php _e('All rights reserved.', 'gp'); ?>
            </div>
            
            <div class="socials right">
                <ul class="right">
                    <?php if (get_option('gp_twitter') != '') { ?>
                    <li class="twitter left"><a href="<?php echo get_option('gp_twitter'); ?>" title="<?php _e('Twitter', 'gp'); ?>"></a></li>
                    <?php } ?>
                    <?php if (get_option('gp_facebook') != '') { ?>
                    <li class="facebook left"><a href="<?php echo get_option('gp_facebook'); ?>" title="<?php _e('Facebook', 'gp'); ?>"></a></li>
                    <?php } ?>
                    <?php if (get_option('gp_linkedin') != '') { ?>
                    <li class="linkedin left"><a href="<?php echo get_option('gp_linkedin'); ?>" title="<?php _e('LinkedIn', 'gp'); ?>"></a></li>
                    <?php } ?>
                    <?php if (get_option('gp_googleplus') != '') { ?>
                    <li class="googleplus left"><a href="<?php echo get_option('gp_googleplus'); ?>" title="<?php _e('Google+', 'gp'); ?>"></a></li>
                    <?php } ?>
                    <?php if (get_option('gp_flickr') != '') { ?>
                    <li class="flickr left"><a href="<?php echo get_option('gp_flickr'); ?>" title="<?php _e('Flickr', 'gp'); ?>"></a></li>
                    <?php } ?>
                    <?php if (get_option('gp_vimeo') != '') { ?>
                    <li class="vimeo left"><a href="<?php echo get_option('gp_vimeo'); ?>" title="<?php _e('Vimeo', 'gp'); ?>"></a></li>
                    <?php } ?>
                    <li class="rss left"><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('RSS', 'gp'); ?>"></a></li>
                </ul>
            </div>
            
            <br class="clear" />
        </div>
    </footer><!-- footer -->

	<?php if (get_option('gp_googleanalytics') != ''){ echo stripslashes(get_option('gp_googleanalytics')); } ?>
    <?php wp_footer(); ?>

</body>
</html>