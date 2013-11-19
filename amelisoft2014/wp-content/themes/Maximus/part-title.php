<?php
global $_slider_type;
global $_feature_box_content;
global $_show404;
if (is_404()) {
}


if (is_page())
	$_feature_box_content = get_post_meta(get_the_ID(), 'featured_box', true);
if (!(is_page() || is_front_page()) || $_slider_type == 'none') {
	$_title = $_description = '';
	$_show404 = false;
	if (is_404()) {
		$_show404 = true;
		$_page404 = get_option('page_404');
		if (!empty($_page404) && $_page404 != 'default') {
			query_posts(array('page_id' => $_page404));
			rewind_posts();
			the_post();
			$_title = the_title(null, null, false);
		} else {
			$_title = __('Error 404 - Page Not Found', TEMPLATENAME).'&nbsp;<img src="'.get_bloginfo('template_url').'/images/smile.png" width="52" height="43" alt="" />';
		}
	} elseif ((is_page() || is_front_page()) && $_slider_type == 'none') {
		$_title = the_title(null, null, false);
		$_description = '<p>' . get_post_meta(get_the_ID(), 'page_description', true) . '</p>';
	} elseif (is_single() || is_page()) {
		$_title = the_title(null, null, false);
		if (is_page())
			$_description = '<p>' . get_post_meta(get_the_ID(), 'page_description', true) . '</p>';
	} elseif (is_category()) {
		$_title = single_cat_title(null, false);
		$_description = category_description();
	} elseif (is_tax('galleries')) {
		$_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$_title = $_term->name;;
		$_description = category_description();
	} elseif (is_search()) {
		$_title = sprintf(__('Search result for: <span>%s</span>', TEMPLATENAME), esc_attr(apply_filters('the_search_query', get_search_query(false))));
	} elseif (is_author()) {
		$_title = sprintf(__( 'Posts by: <span>%s</span>', TEMPLATENAME ), get_the_author());
	} elseif (is_archive()) {
		if (is_day())
			$_title = sprintf(__('Daily Archives: <span>%s</span>', TEMPLATENAME), get_the_date());
		elseif (is_month())
			$_title = sprintf(__('Monthly Archives: <span>%s</span>', TEMPLATENAME), get_the_date('F Y'));
		elseif (is_year())
			$_title = sprintf(__('Yearly Archives: <span>%s</span>', TEMPLATENAME), get_the_date('Y'));
		else
			$_title = __('All Archives', TEMPLATENAME);
	}
?>
		<div id="simple_header">
			<div class="gradient">
				<div class="header">
					<h1><?php echo $_title; ?></h1>
					<?php if (!empty($_description) && $_description != '<p></p>') echo $_description; ?>
				</div>
			</div>
		</div>
<?php
}

global $_theme_layout;
global $_theme_side_sidebar;
global $_theme_bottom_sidebar;
$_theme_layout = $_theme_side_sidebar = $_theme_bottom_sidebar = '';
if (is_singular()) {
	$_theme_layout = get_post_meta(get_the_ID(), 'layout', true);
	$_theme_side_sidebar = get_post_meta(get_the_ID(), 'side_bar', true);
	$_theme_bottom_sidebar = get_post_meta(get_the_ID(), 'bottom_bar', true);
}
if (empty($_theme_layout)) {
	if (is_page())
		$_theme_layout = get_option('default_pages_layout', 3);
	else
		$_theme_layout = get_option('default_blog_layout', 1);
}
if (empty($_theme_side_sidebar))
	$_theme_side_sidebar = get_option('default_side_sidebar', '');
if (empty($_theme_bottom_sidebar))
	$_theme_bottom_sidebar = get_option('default_bottom_sidebar', '');

?>
