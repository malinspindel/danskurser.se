<form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
	<input type="search" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" class="search-input">
	<button type="submit" class="search-submit btn"><?php _e('Search', 'vektor'); ?></button>
</form>