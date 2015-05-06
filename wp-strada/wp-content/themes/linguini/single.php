<?php get_header(); ?>
				
		<header class="page-header">
            <h1><?php the_title(); ?></h1>
        </header><!-- page-header -->

		<div class="content shadow-top left">
            <div class="content-container">

                <div class="page-right left">

                    <div class="rail-content left">
                    
                        <div class="list-posts single-posts">
                            
                            <?php 
                            wp_reset_query();
                            if (have_posts()) { 
                                while (have_posts()) {
                                    the_post();
                            ?>
                            
                                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
										<?php if (has_post_thumbnail() ) { ?>
                                        <div class="post-image image shadow left">
                                            <?php the_post_thumbnail('post-medium'); ?>
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
                                                <?php the_content(); ?>
                                            </div><!-- post-excerpt -->
                                        	
                                            <?php if (has_tag()) { ?>
                                            <footer class="post-foot left">
                                                <div class="left">
                                                    <?php the_tags(); ?>
                                                </div>
                                            </footer><!-- post-foot -->
                                            <?php } ?>

                                        </div><!-- post-content -->
                                    
                                    <br class="clear" />
                                    </article><!-- post -->
                            
                                    <?php wp_link_pages(); ?>
                            
                            <?php 
                                } //while
                            } //if 
                            ?>
                            
                            <?php if (comments_open()) { ?>
                            <div class="comments">
                                <div class="comments-container">
                                    
                                    <?php comments_template(); ?>
                                
                                <br class="clear" />
                                </div><!-- comments-container -->
                            </div><!-- comments -->
                            <?php } ?>
                                
                        <br class="clear" />
                        </div><!-- single-posts -->
                        
                    </div><!-- content-rail -->
                    
                    <div class="rail-right sidebar left">
                    
                        <?php get_sidebar('blog'); ?>
                    
                    </div><!-- rail-right -->
                    
                </div><!-- page-right -->
                    
            <br class="clear" />
            </div><!-- content-container -->
        </div><!-- content -->

<?php get_footer(); ?>
