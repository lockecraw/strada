<?php get_header(); ?>
		
        <div class="page-header">
			<?php if (is_category()) { ?>
            <h1><?php printf(__('All posts in %s', 'gp'), single_cat_title('',false)); ?></h1>
            <?php } elseif( is_tag() ) { ?>
            <h1><?php printf(__('All posts tagged %s', 'gp'), single_tag_title('',false)); ?></h1>
            <?php } elseif (is_day()) { ?>
            <h1><?php _e('Archive for', 'gp'); ?> <?php the_time(__('F jS, Y', 'gp')); ?></h1>
            <?php } elseif (is_month()) { ?>
            <h1><?php _e('Archive for', 'gp'); ?> <?php the_time(__('F, Y', 'gp')); ?></h1>
            <?php } elseif (is_year()) { ?>
            <h1><?php _e('Archive for', 'gp'); ?> <?php the_time('Y'); ?></h1>
            <?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
            <h1><?php _e('Blog archives', 'gp'); ?></h1>
            <?php } ?>
        </div><!-- page-header -->
        		
		<div class="content shadow-top left">
            <div class="content-container">
                
                <div class="page-right left">
                    
                    <?php if (category_description()) { ?>
                        <div class="content-page left">
                            <div class="content-page-container">
                                <?php echo category_description(); ?>
                            </div><!-- content-page-container -->
                        </div><!-- content-page -->
                    <?php } ?>
                    
                    <div class="rail-content left">
                    	
                        <div class="list-posts left">
                            
							<?php
                            wp_reset_query();
                            if (have_posts()) { 
                                while (have_posts()) { 
                                    the_post();
                            ?>
                                
                                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                                        <?php if (has_post_thumbnail() ) { ?>
                                        <div class="post-image image-overlay image shadow left">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                                            <?php the_post_thumbnail('post-medium'); ?>
                                            <span><span></span></span>
                                            </a>
                                        </div><!-- post-image -->
                                        <?php } ?>
                                        
                                        <div class="post-info left">
                                            <ul>
                                                <li class="post-date post-info-block"><?php the_time('d/m') ?></li>
                                                <?php if (comments_open()) { ?>
                                                <li class="post-comments post-info-block"><a href="<?php comments_link(); ?>"><?php comments_number(__('0', 'gp'),__('1', 'gp'),__('%', 'gp')); ?></a></li>
                                                <?php } ?>
                                            </ul>
                                        </div><!-- post-info -->
                                        
                                        <div class="post-content left">
                                        
                                            <header class="post-header">
                                                <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                                            </header><!-- post-header -->
                                        
                                            <div class="post-excerpt left">
                                                <?php the_excerpt(); ?>
                                            </div><!-- post-excerpt -->
                                        
                                            <footer class="post-foot left">
                                                <?php if (has_tag()) { ?>
                                                <div class="post-tags left">
                                                    <?php the_tags(); ?>
                                                </div>
                                                <?php } ?>
                                                <div class="post-continue right">
                                                    <a href="<?php the_permalink(); ?>" title="<?php _e('Continue reading', 'gp'); ?>: <?php the_title(); ?>"><?php _e('Continue reading', 'gp'); ?> &rsaquo;</a>
                                                </div>
                                            </footer><!-- post-foot -->
                                        
                                        </div><!-- post-content -->
                                    
                                    <br class="clear" />
                                    </article><!-- post -->
                                
                            <?php
                                } //while
                            } //if
                            ?>
                            
                            <div class="pagination">
                                <div class="prev left"><?php next_posts_link(__('&lsaquo; Older entries', 'gp')); ?></div>
                                <div class="next right"><?php previous_posts_link(__('Newer entries &rsaquo;', 'gp')); ?></div>
                            </div><!-- pagination -->
                                
                        <br class="clear" />
                        </div><!-- list-posts -->
                        
                    </div><!-- rail-content -->
                    
                    <div class="rail-right sidebar left">
                        <?php get_sidebar('blog'); ?>
                    </div><!-- rail-right -->
                
                </div><!-- page-right -->

			<br class="clear" />
            </div><!-- content-container -->
        </div><!-- content -->

<?php get_footer(); ?>
