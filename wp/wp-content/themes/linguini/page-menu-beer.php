<?php
/*
Template Name: Page: Drinks - Wines
*/
?>
<?php get_header(); ?>
				
		<header class="page-header">
            <h1><?php the_title(); ?></h1>
        </header><!-- page-header -->

		<div class="content shadow-top left">
            <div class="content-container">

                <div class="page-left left">
                    <div class="page-left-container">
                    
                    	<div class="rail-left sidebar left">
							
                            <nav class="navigation-menucard">
                                <ul>
                                    <?php
                                    $taxonomy = 'menu-wine-categories';
                                    $taxonomy_terms = get_terms($taxonomy, 'orderby=ID&order=ASC&parent=0');
                                    
                                    if ($taxonomy_terms) {
                                        foreach ($taxonomy_terms as $taxonomy_term) {
                                        $args = array(
                                            "$taxonomy" => $taxonomy_term->slug,
                                            'post_status' => 'publish',
                                            'orderby' => 'date',
                                            'order' => 'ASC',
                                            'posts_per_page' => 9999
                                        );
                                        $gp_query = null;
                                        $gp_query = new WP_Query($args);
                                
                                            if ($gp_query->have_posts()) { ?>
    
                                                <li><a href="#<?php echo $taxonomy_term->slug; ?>" class="scroll" title="<?php echo $taxonomy_term->name; ?>"><?php echo $taxonomy_term->name; ?></a></li>
    
                                            <?php } wp_reset_query(); ?>
                                    
                                    <?php 
                                        } //foreach
                                    } //if
                                    ?>
                                    <li class="back-to-top"><a href="#top" class="scroll" title="<?php _e('Back to top', 'gp'); ?>"><?php _e('Back to top', 'gp'); ?></a></li>
                                </ul>
                            </nav><!-- navigation-menucard -->

                        <br class="clear" />
                        </div><!-- rail-left -->
                        
                        <div class="rail-content left">
                        	<div class="rail-content-container">
                        
                        	<?php
							if (have_posts()) {
								while (have_posts()) {
									the_post();
							?>
									<?php if (!empty($post->post_content)) { ?>
									<div class="content-page left">
										<div class="content-page-container">
											<?php the_content(); ?>
										</div>
									</div>
									<?php } ?>
							
							<?php 
								} 
							} wp_reset_query();
							?>
                        
                        		<div class="list-menucard list-menucard-drink left">
                                    
									<?php
                                    $custom_post_type = 'menu-wine';
                                    $taxonomy = 'menu-wine-categories';
                                    $taxonomy_terms = get_terms($taxonomy, 'orderby=ID&order=ASC&parent=0');
                                    
                                    if ($taxonomy_terms) {
                                        foreach ($taxonomy_terms as $taxonomy_term) {
                                        $args = array(
                                            'post_type' => $custom_post_type,
                                            "$taxonomy" => $taxonomy_term->slug,
                                            'post_status' => 'publish',
                                            'orderby' => 'id',
                                            'order' => 'ASC',
                                            'posts_per_page' => 9999
                                        );
                                        $gp_query = null;
                                        $gp_query = new WP_Query($args);
                                
                                        if ($gp_query->have_posts()) { ?>

                                            <div id="<?php echo $taxonomy_term->slug; ?>" class="list-menucard-block left">
                    
                                                <header class="list-menucard-block-header">
                                                    <h2><?php echo $taxonomy_term->name; ?></h2>
                                                    <?php if (!empty($taxonomy_term->description)) { ?>
                                                        <p><?php echo $taxonomy_term->description; ?></p>
                                                    <?php } ?>
                                                </header><!-- list-menucard-block-header -->
                                                
                                                <?php 
                                                    while ($gp_query->have_posts()) { 
                                                        $gp_query->the_post(); 
                                                ?>
                    
                                                        <article id="post-<?php the_ID(); ?>" class="post left <?php if(has_post_thumbnail()) { ?>with-image<?php } ?>">
                                                        
                                                            <?php if (has_post_thumbnail()) { ?>
                                                            <div class="post-image image-overlay image shadow left">
                                                                <?php 
                                                                    $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'menucard-large');
                                                                ?>
                                                                <?php if (get_option('gp_menu_wine_link_image') != 'No') { ?>
                                                                    <a href="<?php echo $large_image_url[0] ?>" data-rel="prettyPhoto[menucard]" title="<?php the_title_attribute('echo=0') ?>">
                                                                        <?php the_post_thumbnail('menucard-small'); ?>
                                                                        <span><span></span></span>
                                                                    </a>
                                                                <?php } else { ?>
                                                                    <?php the_post_thumbnail('menucard-small'); ?>
                                                                <?php } ?>
                                                            </div><!-- post-image -->
                                                            <?php } ?>
                                                        
                                                            <div class="post-content right">
                                                            
                                                                <header class="post-header">
                                                                    <h3 class="left">
                                                                        <?php if (get_post_meta($post->ID, 'gp_menu_wine_price', true)) { ?>
                                                                            <span class="post-price right"><?php echo stripslashes(get_post_meta($post->ID, 'gp_menu_wine_price', true)); ?></span>
                                                                        <?php } ?>
                                                                        <?php if (get_option('gp_menu_wine_link') != 'No') { ?>
                                                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                                        <?php } else { ?>
                                                                            <?php the_title(); ?>
                                                                        <?php } ?>
                                                                    </h3>
                                                                </header><!-- post-header -->
                                                                
                                                                <?php if (get_post_meta($post->ID, 'gp_menu_wine_description', true)) { ?>
                                                                <p class="post-description left">
                                                                    <?php echo stripslashes(get_post_meta($post->ID, 'gp_menu_wine_description', true)); ?>
                                                                </p><!-- post-description -->
                                                                <?php } ?>
                                                            
                                                            </div><!-- post-content -->
                                                            
                                                        <br class="clear" />
                                                        </article><!-- post -->
                                    
                                                <?php } //while ?>
                                            
                                            <br class="clear" />
                                            </div><!-- list-menucard-block -->
        
                                        <?php } wp_reset_query(); ?>
                                    
                                    <?php 
                                        } //foreach
                                    } //if
                                    ?>
                            
                                <br class="clear" />
                                </div><!-- list-menucard -->
                                
                                <div class="end"></div>
                                
                            <br class="clear" />
                        	</div><!-- rail-content-container -->
                        </div><!-- rail-content -->
                        
                    </div><!-- page-left-container -->
                </div><!-- page-left -->

			<br class="clear" /> 
            </div><!-- content-container -->
        </div><!-- content -->

<?php get_footer(); ?>
