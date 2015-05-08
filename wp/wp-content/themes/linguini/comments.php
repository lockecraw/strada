<header class="comments-header">
	<h3><?php comments_number(__('No comments', 'gp'),__('1 comment', 'gp'),__('% comments', 'gp')); ?></h3>
</header>

<?php if (have_comments()) { ?>

    <div class="list-comments">
        <?php wp_list_comments(array('style' => 'div', 'avatar_size' => '40')); ?>
    </div><!-- list-comments -->

<?php } else { ?>

	<?php if (comments_open()) { ?>
		<p class="be-first"><?php _e('You can be the first one to leave a comment.', 'gp'); ?></p>
	<?php } ?>

<?php } ?>

<div class="navigation">
	<div class="left"><?php previous_comments_link() ?></div>
	<div class="right"><?php next_comments_link() ?></div>
</div>

<?php if (comments_open()) { ?>

	<?php comment_form(array('id_submit'=>'comment-submit')); ?>
    
<?php } ?>