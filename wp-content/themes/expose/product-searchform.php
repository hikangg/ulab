<form role="search" method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
	<input type="text" id="s" name="s" placeholder="<?php esc_attr_e('type and hit enter','expose'); ?>" />
	<input type="hidden" name="post_type" value="product" />
</form>