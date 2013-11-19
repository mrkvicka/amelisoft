<?php
require_once(dirname(__FILE__) . '/admin_options/AdminPageFactory.php');

/*-------------------- Appearance Options Subpage --------------------*/
ap_add_sub_page('Appearance', __('Theme Options', TEMPLATENAME), __('Theme Options', TEMPLATENAME), 'administrator', 'custom_theme_options');
ap_page_title(__('Theme Options', TEMPLATENAME));
ap_page_icon('index');

/*-------------------- General Options --------------------*/
ap_add_section('general', __('General Settings', TEMPLATENAME));
ap_add_checkbox(array(
	'name' => 'show_switcher',
	'title' => __('Display Color Switcher?', TEMPLATENAME),
	'default' => true,
	'desc' => __('Check this to display color switcher on the frontend.', TEMPLATENAME),
));
global $_theme_colors;
ap_add_select(array(
	'name' => 'defailt_theme_color',
	'title' => __('Choose website color scheme:', TEMPLATENAME),
	'default' => key($_theme_colors),
	'options' => $_theme_colors,
));
ap_add_input(array(
	'name' => 'logo_width',
	'title' => __('Logo width', TEMPLATENAME),
	'default' => 300,
));
ap_add_input(array(
	'name' => 'logo_height',
	'title' => __('Logo height', TEMPLATENAME),
	'default' => 75,
));
ap_add_upload(array(
	'name' => 'logo',
	'title' => __('Upload Logo:', TEMPLATENAME),
	'max_width' => 'logo_width',
	'max_height' => 'logo_height',
));
ap_add_upload(array(
	'name' => 'favicon',
	'title' => __('Upload Favicon:', TEMPLATENAME),
	'max_width' => 32,
	'max_height' => 32,
	'desc' => __('File type: .ico or .png File dimensions: 16x16, 32x32.', TEMPLATENAME),
));
ap_add_select(array(
	'name' => 'default_side_sidebar',
	'title' => __('Default side sidebar:', TEMPLATENAME),
	'default' => 'none',
	'options_func' => 'get_registered_sidebars',
	'desc' => __('Choose sidebar for side of page.', TEMPLATENAME),
));
ap_add_select(array(
	'name' => 'default_bottom_sidebar',
	'title' => __('Default bottom sidebar:', TEMPLATENAME),
	'default' => 'none',
	'options_func' => 'get_registered_sidebars',
	'desc' => __('Choose sidebar for bottom of page.', TEMPLATENAME),
));
ap_add_select(array(
	'name' => 'page_404',
	'title' => __('Page of error 404:', TEMPLATENAME),
	'default' => '',
	'options' => array('default' => __('Embedded 404 page', TEMPLATENAME)) + get_registered_pages(),
	'desc' => __('Select your 404 page.', TEMPLATENAME),
));
global $_theme_layouts;
ap_add_select(array(
	'name' => 'default_pages_layout',
	'title' => __('Default layout for pages:', TEMPLATENAME),
	'default' => 3,
	'options' => $_theme_layouts,
	'desc' => __('Select default layout for pages.', TEMPLATENAME),
));

ap_add_select(array(
	'name' => 'default_blog_layout',
	'title' => __('Default layout for blog:', TEMPLATENAME),
	'default' => 1,
	'options' => $_theme_layouts,
	'desc' => __('Select default layout for blog.', TEMPLATENAME),
));
ap_add_input(array(
	'name' => 'copyright',
	'title' => __('Footer Copyright Text', TEMPLATENAME),
	'default' => 'Copyright &copy; 2010 '.get_bloginfo('name').' company. All rights reserved.',
	'desc' => __('Type a copyright text.', TEMPLATENAME),
	'class' => 'large-text code',
));

/*-------------------- Sliders Manager --------------------*/
ap_add_section('home', __('Sliders Manager', TEMPLATENAME));

/*global $_theme_sliders;
ap_add_select(array(
	'name' => 'slider_type',
	'title' => __('Choose a Slider Type:', TEMPLATENAME),
	'default' => 'js_slider_feature_carousel',
	'options' => array('disable' => __('Disable', TEMPLATENAME)) + $_theme_sliders,
	'desc' => __('Slider to be Displayed in Header.', TEMPLATENAME),
));*/
ap_add_select(array(
	'name' => 'slider_post_cat',
	'title' => __('Slider category:', TEMPLATENAME),
	'default' => '',
	'options' => get_registered_categories(),
	'desc' => __('Select a category for slider.', TEMPLATENAME),
));
ap_add_select(array(
	'name' => 'slider_post_order',
	'title' => __('Order By:', TEMPLATENAME),
	'default' => 'rand',
	'options' => array(
		'none' => __('No order', TEMPLATENAME),
		'rand' => __('Randomly', TEMPLATENAME),
		'autor' => __('Author', TEMPLATENAME),
		'date' => __('Date', TEMPLATENAME),
		'title' => __('Title Name', TEMPLATENAME),
		'modified' => __('Modified', TEMPLATENAME),
		'parent' => __('Parent', TEMPLATENAME),
		'ID' => __('ID', TEMPLATENAME),
		'comment_count' => __('Comments', TEMPLATENAME),
		'by_tag' => __('Tag', TEMPLATENAME),
	),
	'desc' => __('Choose an option to order Slides.', TEMPLATENAME),
));
ap_add_select(array(
	'name' => 'slider_sort_order',
	'title' => __('Sort Type:', TEMPLATENAME),
	'default' => 'ASC',
	'options' => array(
		'ASC' => __('Ascendent', TEMPLATENAME),
		'DESC' => __('Descendent', TEMPLATENAME),
	),
));
ap_add_input(array(
	'name' => 'slider_tag',
	'title' => __('Slider Tag:', TEMPLATENAME),
	'default' => '',
	'desc' => __('All items tagged with this value will appear on the slider.', TEMPLATENAME),
));
ap_add_input(array(
	'name' => 'slider_count_items',
	'title' => __('Number of Slides:', TEMPLATENAME),
	'default' => '6',
	'desc' => __('Number of slides to be displayed.', TEMPLATENAME),
	'class' => 'large-text code',
));
ap_add_checkbox(array(
	'name' => 'slider_excerpt',
	'title' => __('Display post description?', TEMPLATENAME),
	'default' => true,
	'desc' => __('Check this to display a post description on the slider images.', TEMPLATENAME),
));

/*-------------------- Nivo Slider --------------------*/
ap_add_section('nivo_slider', __('Nivo Slider', TEMPLATENAME));
ap_add_select(array(
	'name' => 'nivo_slider_effect',
	'title' => __('Sliding Effect:', TEMPLATENAME),
	'default' => 'random',
	'options' => array(
		'sliceDown' => __('Down', TEMPLATENAME),
		'sliceDownLeft' => __('DownLeft', TEMPLATENAME),
		'sliceUp' => __('Up', TEMPLATENAME),
		'sliceUpLeft' => __('UpLeft', TEMPLATENAME),
		'sliceUpDown' => __('UpDown', TEMPLATENAME),
		'sliceUpDownLeft' => __('UpDownLeft', TEMPLATENAME),
		'fold' => __('Fold', TEMPLATENAME),
		'fade' => __('Fade', TEMPLATENAME),
		'random' => __('Random', TEMPLATENAME),
	),
	'desc' => __('Choose an effect of changing slides.', TEMPLATENAME),
));
ap_add_input(array(
	'name' => 'nivo_slider_slices',
	'title' => __('Number of slices:', TEMPLATENAME),
	'default' => '25',
	'class' => 'small-text',
));
ap_add_input(array(
	'name' => 'nivo_slider_speed',
	'title' => __('Animation Speed:', TEMPLATENAME),
	'default' => '600',
	'desc' => __('Type an amount of time slide transition lasts (in milliseconds).', TEMPLATENAME),
	'class' => 'small-text',
));
ap_add_input(array(
	'name' => 'nivo_slider_pause',
	'title' => __('Pause Time:', TEMPLATENAME),
	'default' => '3000',
	'desc' => __('Type an amount of time slide transition lasts (in milliseconds).', TEMPLATENAME),
	'class' => 'small-text',
));
ap_add_checkbox(array(
	'name' => 'nivo_slider_direction_nav',
	'title' => __('Direction Navigation:', TEMPLATENAME),
	'default' => true,
	'desc' => __('Check this to display "Prev" & "Next" buttons.', TEMPLATENAME),
));
ap_add_checkbox(array(
	'name' => 'nivo_slider_direction_nav_hide',
	'title' => __('Show/Hide Direction Navigation when mouse over:', TEMPLATENAME),
	'default' => false,
	'desc' => __('Check this to show "Prev" & "Next" buttons when mouse is over slides.', TEMPLATENAME),
));
ap_add_checkbox(array(
	'name' => 'nivo_slider_control_nav',
	'title' => __('Control Navigation:', TEMPLATENAME),
	'default' => true,
	'desc' => __('Check this to display control navigation (rounded bullets).', TEMPLATENAME),
));
ap_add_checkbox(array(
	'name' => 'nivo_slider_pause_on_hover',
	'title' => __('Pause On Hover:', TEMPLATENAME),
	'default' => true,
	'desc' => __('Determines if slideshow will pause while mouse is hovering over slideshow.', TEMPLATENAME),
));
/*-------------------- S3 Slider --------------------*/
ap_add_section('s3_slider', __('S3 Slider', TEMPLATENAME));
ap_add_select(array(
	'name' => 's3_slider_title',
	'title' => __('Title position:', TEMPLATENAME),
	'default' => 'left-right',
	'options' => array(
		'left' => __('Left', TEMPLATENAME),
		'right' => __('Right', TEMPLATENAME),
		'left-right' => __('Left & Right', TEMPLATENAME),
	),
	'desc' => __('Choose a title position.', TEMPLATENAME),
));
ap_add_input(array(
	'name' => 's3_slider_time_out',
	'title' => __('Time out:', TEMPLATENAME),
	'default' => '3000',
	'class' => 'small-text',
	'desc' => __('Set the speed animation', TEMPLATENAME)
));
/*-------------------- SEO Options --------------------*/
ap_add_section('google', __('Google Analytics', TEMPLATENAME));
ap_add_checkbox(array(
	'name' => 'ga_use',
	'title' => __('Use Google Analytics Code', TEMPLATENAME),
	'default' => false,
	'desc' => __('Check this if you want to enable Google Analytics Code', TEMPLATENAME),
));
ap_add_textarea(array(
	'name' => 'ga_code',
	'title' => __('Google Analytics Code:', TEMPLATENAME),
	'defailt' => '',
	'desc' => __('Enter your full Google Analytics code (or any other site tracking code) here. It will be inserted before the closing body tag.', TEMPLATENAME),
	'class' => 'large-text code',
));
/*-------------------- Gallery Options --------------------*/
ap_add_section('other', __('Gallery', TEMPLATENAME));
ap_add_checkbox(array(
	'name' => 'gallery_switcher',
	'title' => __('Show gallery switcher', TEMPLATENAME),
	'default' => true,
	'desc' => __('Check this if you want to show gallery template switcher', TEMPLATENAME),
));
ap_add_select(array(
	'name' => 'gallery_type',
	'title' => __('Select a view type:', TEMPLATENAME),
	'default' => '',
	'options' => array(
		'thumb_view' => __('Grid view', TEMPLATENAME),
		'' => __('List view', TEMPLATENAME),
	),
	'desc' => __('Choose a gallery view type. (only works when galery switcher is disabled)', TEMPLATENAME),
));

ap_add_input(array(
	'name' => 'gallery_post_per_page',
	'title' => __('Posts per page of gallery:', TEMPLATENAME),
	'default' => 12,
//	'options' => get_registered_categories(),
));

/*-------------------- Social Options --------------------*/
ap_add_section('social', __('Social', TEMPLATENAME));
ap_add_input(array(
	'name' => 'rss_link',
	'title' => __('Type a link to RSS:', TEMPLATENAME),
	'default' => '#',
	'class' => 'large-text',
));

ap_add_input(array(
	'name' => 'delicious_link',
	'title' => __('Type a link to Delicious:', TEMPLATENAME),
	'default' => '#',
	'class' => 'large-text',
));

ap_add_input(array(
	'name' => 'fliсkr_link',
	'title' => __('Type a link to Flickr:', TEMPLATENAME),
	'default' => '#',
	'class' => 'large-text',
));

ap_add_input(array(
	'name' => 'twitter_link',
	'title' => __('Type a link to Twitter:', TEMPLATENAME),
	'default' => '#',
	'class' => 'large-text',
));

ap_add_input(array(
	'name' => 'facebook_link',
	'title' => __('Type a link to Facebook:', TEMPLATENAME),
	'default' => '#',
	'class' => 'large-text',
));

function get_registered_pages() {
	$pages = get_pages();
	$out = array();
	foreach ($pages as $page)
		$out[$page->ID] = $page->post_title;
	return $out;
}

function get_registered_categories() {
	$cats = get_terms('category');
	$out = array();
	foreach ($cats as $cat)
		$out[$cat->term_id] = $cat->name;
	return $out;
}

?>