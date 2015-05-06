<?php get_header(); ?>
<?php $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); ?>
				
		<header class="page-header">
            <h1><?php echo $term->name; ?></h1>
        </header><!-- page-header -->

		<div class="content shadow-top left">
            <div class="content-container">
    
				<div class="page-full left">
                	<div class="page-full-container">

						<?php if (!empty($term->description)) { ?>
                            <div class="content-page aligncenter left">
                                <div class="content-page-container">
                                    <?php echo esc_html($term->description); ?>
                                </div><!-- content-page-container -->
                            </div><!-- content-page -->
                        <?php } ?>
                    
                        <div class="list-photos list-photos-category left">
                            <div class="list-photos-container left">
                                
                                <?php
                                    $custom_post_type = 'photos';
                                    $taxonomy = 'photo-galleries';
                                    $term_slug = $term->slug;
                                    $gp_loop = new WP_Query(array('post_type' => $custom_post_type, 'taxonomy' => $taxonomy, 'term' => $term_slug, 'orderby' => 'date', 'order' => 'ASC', 'posts_per_page' => 9999)); 
                                    $custom = get_post_custom($post->ID);
                                    $terms = get_the_terms(get_the_ID(), $taxonomy);
                                    
                                    $itemcount = 1;

                                    while ($gp_loop->have_posts()) { 
                                        $gp_loop->the_post(); 
                                ?>
                                
                                        <article id="post-<?php the_ID(); ?>" class="post<?php echo $itemcount; ?><?php if($itemcount % 4 === 0) { ?> last<?php } ?><?php if($itemcount % 2 === 0) { ?> last2<?php } ?> post left">
                                                            
                                            <?php if (has_post_thumbnail()) { ?>
                                            <div class="post-image image-overlay image shadow left">
                                                <?php 
                                                    $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'photos-large');
                                                ?>
                                                <a href="<?php echo $large_image_url[0] ?>" data-rel="prettyPhoto[photos]" title="<?php the_title_attribute('echo=0') ?>">
                                                    <?php the_post_thumbnail('photos-medium'); ?>
                                                    <span><span></span></span>
                                                </a>
                                            </div><!-- post-image -->
                                            <?php } else { ?>
                                            <div class="post-image-replacement shadow left">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/replacement/image-replacement-medium.png" alt="<?php _e('Image not available', 'gp'); ?>" />
                                            </div><!-- post-image-replacement -->
                                            <?php } ?>
                                            
                                            <header class="post-header left">
                                                <h3><?php the_title(); ?></h3>
                                            </header><!-- post-header -->
                                            
                                        </article><!-- post -->  
                                    
                                        <?php if($itemcount % 2 === 0) { ?><br class="clear clearer-2" /><?php } ?>
										<?php if($itemcount % 4 === 0) { ?><br class="clear clearer-4" /><?php } ?>
                                                                      
                                <?php 
                                        $itemcount++; 
                                    } //while 
                                ?>
        
                            </div><!-- list-photos-container -->
                            
                        <br class="clear" />    
                        </div><!-- list-photos -->

                    </div><!-- page-full-container -->
                </div><!-- page-full -->
                
			<br class="clear" />
            </div><!-- content-container -->
        </div><!-- content -->

<?php get_footer(); ?>
