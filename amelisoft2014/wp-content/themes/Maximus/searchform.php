<form method="get" action="<?php echo home_url( '/' ); ?>" >
	<div id="search_area">
		<input type="text" name="s" class="search" id="search" value="<?php echo get_search_query(); ?>" />
		<input type="submit" value="<?php echo esc_attr__('Search'); ?>" title="<?php echo esc_attr__('Search'); ?>" />
	</div>
</form>


