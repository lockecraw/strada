<!doctype html>  
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Grand Pixels, www.grandpixels.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php if (get_post_meta($post->ID, 'gp_page_keywords', true)) { ?>
    <meta name="keywords" content="<?php echo get_post_meta($post->ID, 'gp_page_keywords', true); ?>" />
    <?php } else { ?>
    <meta name="keywords" content="<?php echo get_option('gp_meta_keywords'); ?>" />
    <?php } ?>
    
    <?php if (get_post_meta($post->ID, 'gp_page_description', true)) { ?>
    <meta name="description" content="<?php echo get_post_meta($post->ID, 'gp_page_description', true); ?>" />
    <?php } else { ?>
    <meta name="description" content="<?php echo get_option('gp_meta_description'); ?>" />
    <?php } ?>
    
    <link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
    <link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <title><?php wp_title('&rsaquo;', true, 'right'); ?><?php bloginfo('name'); ?> &lsaquo; <?php bloginfo('description'); ?></title>
    <?php wp_head(); ?>
    
</head>

<?php flush(); ?>

<body <?php body_class(); ?>>

    <header id="top" class="header <?php if (is_front_page()) { ?>shadow-big-bottom<?php } else { ?>shadow-bottom<?php } ?> left">
        <div class="header-container left">
            
            <div class="topbar">
                
                <?php if (get_bloginfo('description') != '') { ?>
                <div class="tagline left">
                    <?php echo get_bloginfo('description'); ?>
                </div><!-- tagline -->
                <?php } ?>
                
               <div class="socials right">
									<?php if (is_active_sidebar('widget_header_right_area')) { ?>
            			<div class="widget_header_right_area">
               		 <?php dynamic_sidebar('widget_header_right_area'); ?>
           			 </div>
        					<?php } ?>

                </div><!-- socials -->                
            </div><!-- topbar -->
            
            <div class="logo">
                <?php if (get_option('gp_logo_image') != "") { ?>
                    <div class="logo-image left">
						<?php if (is_front_page()) { ?>
                        	<h1>
                            	<a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name'); ?>">
                                	<img src="<?php echo get_option('gp_logo_image'); ?>" alt="<?php echo get_bloginfo('name'); ?>" />
                                </a>
							</h1>
						<?php } else { ?>
                        	<a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name'); ?>">
                            	<img src="<?php echo get_option('gp_logo_image'); ?>" alt="<?php echo get_bloginfo('name'); ?>" />
							</a>
						<?php } ?>
					</div><!-- logo-image -->
                <?php } else { ?>
                    <div class="logo-default left">
						<?php if (is_front_page()) { ?>
                        	<h1>
                            	<a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name'); ?>">
                                	<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php echo get_bloginfo('name'); ?>" />
								</a>
							</h1>
						<?php } else { ?>
                        	<a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name'); ?>">
                            	<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php echo get_bloginfo('name'); ?>" />
							</a>
						<?php } ?>
					</div><!-- logo-default -->
                <?php } ?>
            </div><!-- logo -->
            
            <nav class="navigation left">
                <div class="navigation-container">
				
                	<?php wp_nav_menu( array( 'theme_location' => 'primary_navigation', 'depth' => 3 ) ); ?>
                
                <br class="clear" />
                </div><!-- navigation-container -->
            </nav><!-- navigation -->
            
            <nav class="navigation-mobile left">
                <div class="navigation-mobile-container">
					<ul>
                		<li class="select"><a href="#" onClick="return false;"><?php _e('Select a page', 'gp'); ?></a>
							<?php wp_nav_menu( array( 'theme_location' => 'primary_navigation', 'depth' => 2 ) ); ?>
						</li>
                	</ul>
                <br class="clear" />
                </div><!-- navigation-container -->
            </nav><!-- navigation -->
                
        <br class="clear" />
        </div><!-- header-container -->
    </header><!-- header -->
    
    <div class="canvas">