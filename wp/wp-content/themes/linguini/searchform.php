<div class="form-search">
    <form method="get" id="searchform" class="form" action="<?php echo home_url(); ?>/">
        <fieldset>
            <input type="text" class="input" value="<?php _e('Search ...', 'gp'); ?>" name="s" id="s" />
        </fieldset>
    </form>
</div>
<script type="text/javascript">
	jQuery('input[name=s]').focus(function(){ if (jQuery(this).val() == '<?php _e('Search ...', 'gp'); ?>') jQuery(this).val(''); });
	jQuery('input[name=s]').blur(function(){ if (jQuery(this).val() == '') jQuery(this).val('<?php _e('Search ...', 'gp'); ?>'); });
</script>