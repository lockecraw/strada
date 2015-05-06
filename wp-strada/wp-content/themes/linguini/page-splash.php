<?php
/*
Template Name: Page: Splash
*/
?>
<!doctype html>  
<!--[if lt IE 7 ]> <html dir="ltr" lang="en-US" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html dir="ltr" lang="en-US" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html dir="ltr" lang="en-US" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html dir="ltr" lang="en-US" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="no-js" dir="ltr" lang="en-US"> <!--<![endif]-->
<head>
	<style type="text/css">
	@font-face {
		font-family: 'OpenSansRegular';
		src: url('/wp/wp-content/themes/linguini/fonts/open-sans/OpenSans-Regular-webfont.eot');
		src: url('/wp/wp-content/themes/linguini/fonts/open-sans/OpenSans-Regular-webfont.eot?#iefix') format('embedded-opentype'),
			 url('/wp/wp-content/themes/linguini/fonts/open-sans/OpenSans-Regular-webfont.woff') format('woff'),
			 url('/wp/wp-content/themes/linguini/fonts/open-sans/OpenSans-Regular-webfont.ttf') format('truetype'),
			 url('/wp/wp-content/themes/linguini/fonts/open-sans/OpenSans-Regular-webfont.svg#OpenSansRegular') format('svg');
		font-weight: normal;
		font-style: normal;

	}
	body{
		padding: 10px;
		background-color: #666;
		color: #fff;
		text-align: center;
		font-family: "OpenSansRegular", Arial, Helvetica, sans-serif; 
		font-size: 12px;
		font-weight: normal; 
		height: 100%; 
		color: white; 
		-webkit-font-smoothing: antialiased;
	}
	a{
		color: red;
		transition: color .5s;
		-moz-transition: color .5s; /* Firefox 4 */
		-webkit-transition: color .5s; /* Safari and Chrome */
		-o-transition: color .5s; /* Opera */
		font-size: 22px;
		text-shadow: 0px 0px 10px #fff;
	}
	a:hover{
		color: white;
	}
	</style>
</head>
<body>
	<?php
	if (have_posts()) {
		while (have_posts()) {
			the_post();
	?>
			<?php if (!empty($post->post_content)) { ?>
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
</body>
</html>