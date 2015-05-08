<?php get_header(); ?>
				
		<header class="page-header">
            <h1>
				<?php the_title(); ?>
				<?php if (get_post_meta($post->ID, 'gp_menu_wine_price', true)) { ?>
                    <span class="post-price round"><?php echo stripslashes(get_post_meta($post->ID, 'gp_menu_wine_price', true)); ?></span>
                <?php } ?>
            </h1>
        </header><!-- page-header -->

		<div class="content shadow-top left">
            <div class="content-container">

                <div class="page-full left">

                    <div class="single-menucard left">
                        
                        <?php 
						wp_reset_query();
						if (have_posts()) {
							while (have_posts()) { 
								the_post();
                        ?>
                        
                                <article class="post left">
                                
									<?php if (get_post_meta($post->ID, 'gp_menu_wine_description', true)) { ?>
                                    <div class="post-description left"><?php echo stripslashes(get_post_meta($post->ID, 'gp_menu_wine_description', true)); ?></div>
                                    <?php } ?>
                                    
                                    <?php if (has_post_thumbnail()) { ?>
                                    <div class="post-image shadow right">
                                        <?php the_post_thumbnail('menucard-large'); ?>
                                    </div><!-- post-image -->
                                    <?php } ?>
                                    
                                	<div class="post-content left">
										<?php the_content(); ?>
                                    </div><!-- post-content -->
                                
                                <br class="clear" />
                                </article><!-- post -->
                        
                        <?php 
							} //while
						} //if
						?>
						
                        <?php if (comments_open()) { ?>
                            <div class="comments">
                                <div class="comments-container">
                                    <?php comments_template(); ?>
                                </div>
                            <br class="clear" />
                            </div><!-- comments -->
                        <?php } ?>
                        
					<br class="clear" />
                    </div><!-- page-content -->
                </div><!-- page-full -->

			<br class="clear" />
            </div>
        </div><!-- content -->

<?php get_footer(); ?>
