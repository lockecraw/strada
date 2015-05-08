<?php
/*
Template Name: Page: Photogalleries
*/
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
                                    </div>
                                </div>
                                <?php } ?>
                        
                        <?php 
                            } 
                        } wp_reset_query();
                        ?>

                        <div class="list-photos left">
                            <div class="list-photos-container left">
                    
                                <?php
                                    $custom_post_type = 'photos';
                                    $taxonomy = 'photo-galleries';
                                    $taxonomy_terms = get_terms( $taxonomy, 'orderby=date&order=DESC&parent=0' );
                                    
                                    if ($taxonomy_terms) {
                                        foreach ($taxonomy_terms  as $taxonomy_term) {
                                        $args = array(
                                            'post_type' => $custom_post_type,
                                            "$taxonomy" => $taxonomy_term->slug,
                                            'post_status' => 'publish',
                                            'orderby' => 'date',
                                            'order' => 'ASC',
                                            'posts_per_page' => 4
                                        );
                                        $gp_query = null;
                                        $gp_query = new WP_Query($args);
                                        
                                        $itemcount = 1;
                                
                                        if( $gp_query->have_posts() ) { ?>
                                    
                                            <div class="list-photos-block left">
                                                
                                                <header class="list-photos-block-header left">
                                                    <h2>
                                                        <a href="<?php echo get_term_link($taxonomy_term, $taxonomy_term->taxonomy); ?>"><?php echo $taxonomy_term->name; ?></a>
                                                    </h2>
                                                    
                                                    <?php if (!empty($taxonomy_term->description)) { ?>
                                                    <p><?php echo $taxonomy_term->description; ?></p>
                                                    <?php } ?>
                                                </header><!-- list-photos-block-header -->
                                                
                                                <?php 
                                                while ($gp_query->have_posts()) { 
                                                    $gp_query->the_post(); 
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
                                                    
                                                    <?php if($itemcount % 1 === 0) { ?><br class="clear clearer-1" /><?php } ?>
													<?php if($itemcount % 2 === 0) { ?><br class="clear clearer-2" /><?php } ?>
													<?php if($itemcount % 4 === 0) { ?><br class="clear clearer-4" /><?php } ?>
                                    
                                                <?php 
                                                    $itemcount++; 
                                                    } //while 
                                                ?>
                                                
                                                <footer class="list-photos-block-footer left">
                                                    <a href="<?php echo get_term_link($taxonomy_term, $taxonomy_term->taxonomy); ?>"><?php _e('View entire', 'gp'); ?> <?php echo $taxonomy_term->name; ?> &rsaquo;</a>
                                                </footer><!-- list-photos-block-footer -->
                                                
                                            <br class="clear" />
                                            </div><!-- list-photos-block -->
                        
                                        <?php } wp_reset_query(); ?>
                                    
                                    <?php
                                        } //foreach
                                    } //if
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
