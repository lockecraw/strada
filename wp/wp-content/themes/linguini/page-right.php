<?php
/*
Template Name: Page: Right Sidebar
*/
?>
<?php get_header(); ?>
		
        <header class="page-header">
            <h1><?php the_title(); ?></h1>
        </header><!-- page-header -->
        		
		<div class="content shadow-top left">
            <div class="content-container">
				            
                <div class="page-right left">

                    <div class="rail-content left">
                        <div class="rail-content-container">
    
                            <?php
							if (have_posts()) {
								while (have_posts()) {
									the_post();
							?>
									<?php if(!empty($post->post_content)) { ?>
									<div class="content-page left">
										<div class="content-page-container">
											<?php the_content(); ?>
										</div><!-- content-page-container -->
									</div><!-- content-page -->
									<?php } ?>
							
							<?php 
								} 
							} wp_reset_query();
							?>
                            
						<br class="clear" />
                        </div><!-- rail-content-container -->
                    </div><!-- rail-content -->
                    
                    <div class="rail-right sidebar left">
                    
                        <?php get_sidebar('right'); ?>
                        
					<br class="clear" />
                    </div><!-- rail-right -->
                    
                </div><!-- page-right -->
                
			<br class="clear" />
            </div><!-- content-container -->
        </div><!-- content -->

<?php get_footer(); ?>
