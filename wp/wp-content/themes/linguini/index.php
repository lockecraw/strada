<?php get_header(); ?>
		
        <header class="page-header">
            <h1><?php _e('Connect', 'gp'); ?></h1>
        </header><!-- page-header -->
        		
		<div class="content shadow-top left">
            <div class="content-container">
                
                <div class="page-right left">
                    
                    <div class="rail-content left">
                    
                        <div class="list-posts left">

							<?php
                            $gp_query= null;
                            $gp_query = new WP_Query();
                            $gp_query->query('posts_per_page=10'.'&paged='.$paged);
                                while ($gp_query->have_posts()) { 
                                    $gp_query->the_post();
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
                                                <li class="post-date post-info-block"><?php the_time('m/d') ?></li>
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
                            ?>

                            <div class="pagination">
                                <div class="prev left"><?php next_posts_link(__('&lsaquo; Older entries', 'gp')); ?></div>
                                <div class="next right"><?php previous_posts_link(__('Newer entries &rsaquo;', 'gp')); ?></div>
                            </div><!-- pagination -->
                            
                            <?php $gp_query = NULL; ?>
                                
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
