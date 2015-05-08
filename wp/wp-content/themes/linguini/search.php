<?php get_header(); ?>
				
		<header class="page-header">
            <h1><?php _e('Search results for:', 'gp'); ?> <?php the_search_query(); ?></h1>
        </header><!-- page-header -->

		<div class="content shadow-top left">
            <div class="content-container">

                <div class="page-right left">

                    <div class="rail-content left">
                    
                        <div class="list-posts list-posts-search left">
                                
							<?php 
                            if (have_posts()) { 
                                while (have_posts()) {
                                    the_post();
                            ?>
                            
                                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                        
                                        <div class="post-content left">
                                        
                                            <header class="post-header">
                                                <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                                            </header><!-- post-header -->
                                            
                                            <?php if (!empty($post->post_excerpt)) { ?>
                                            <div class="post-excerpt left">
												<?php the_excerpt(); ?>
                                            </div><!-- post-excerpt -->
                                            <?php } ?>
                                        
                                        </div><!-- post-content -->
                                    
                                    <br class="clear" />
                                    </article><!-- post -->

                                <?php } //while ?>
                            
                            <?php } else { ?>
                            
                                <div class="content-page left">
                                    <div class="content-page-container">
                                        <h2><?php _e('Sorry, but unfortunately nothing was found!', 'gp'); ?></h2>
                                    </div>
                                </div>
                            
                            <?php } //if ?>
                            
                            <div class="pagination">
                                <div class="prev left"><?php next_posts_link(__('&lsaquo; Older entries', 'gp')); ?></div>
                                <div class="next right"><?php previous_posts_link(__('Newer entries &rsaquo;', 'gp')); ?></div>
                            </div>
                                      
                        <br class="clear" />
                        </div><!-- list-posts -->
                    </div><!-- rail-content -->
                    
                    <div class="rail-right sidebar left">
                        <?php get_sidebar('right'); ?>
                    </div><!-- rail-right -->
                    
                </div><!-- page-right -->
                    
            <br class="clear" />
            </div><!-- content-container -->
        </div><!-- content -->

<?php get_footer(); ?>