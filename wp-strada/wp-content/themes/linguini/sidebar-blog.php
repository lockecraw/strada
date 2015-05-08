<?php if (is_active_sidebar('widget_sidebar_right_area_top')) { ?>
<div class="widget-area-sidebar widget-area left">
	<?php dynamic_sidebar('widget_sidebar_right_area_top'); ?>
</div>
<?php } ?>

<nav class="navigation-categories block">
	<div class="navigation-categories-container">
		<h3><?php _e('Categories', 'gp'); ?></h3>
        <ul>
		<?php wp_list_categories('orderby=id&title_li=0'); ?>
        </ul>
	</div>
</nav><!-- navigation-categories -->

<nav class="navigation-archives block">
	<div class="navigation- archives-container">
		<h3><?php _e('Archives', 'gp'); ?></h3>
        <ul>
		<?php wp_get_archives('type=monthly&limit=12'); ?>
		</ul>
	</div>
</nav><!-- navigation-archives -->

<?php if (is_active_sidebar('widget_sidebar_right_area_bottom')) { ?>
<div class="widget-area-sidebar widget-area left">
	<?php dynamic_sidebar('widget_sidebar_right_area_bottom'); ?>
</div>
<?php } ?>