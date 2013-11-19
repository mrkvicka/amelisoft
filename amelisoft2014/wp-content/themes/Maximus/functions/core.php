<?php
if (!defined('TEMPLATENAME')) {
	define('TEMPLATENAME', get_option('template'));
}

 /** Tell WordPress to run theme_custom_setup() when the 'after_setup_theme' hook is run. */
add_action('after_setup_theme', 'theme_custom_setup');

if (!function_exists('theme_custom_setup')) {
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 */
	function theme_custom_setup() {

		// This theme styles the visual editor with editor-style.css to match the theme style.
//		add_editor_style();

		// This theme uses post thumbnails
		add_theme_support('post-thumbnails');

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// Make theme available for translation
		// Translations can be filed in the /languages/ directory
		load_theme_textdomain(TEMPLATENAME, TEMPLATEPATH . '/languages');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => __('Primary Navigation', TEMPLATENAME),
			)
		);

	}
}

// styles & scripts
if ( !is_admin() ) {
	function init_styles_and_scripts() {
		theme_color_styles();
		wp_register_style('css_ddsmoothmenu', get_bloginfo('template_directory') . '/stylesheets/ddsmoothmenu.css');
		wp_register_style('css_pretty', get_bloginfo('template_directory') . '/stylesheets/prettyPhoto.css');
		wp_register_style('css_slider_nivo', get_bloginfo('template_directory') . '/stylesheets/nivo-slider.css');
		wp_register_style('css_s3slider', get_bloginfo('template_directory') . '/stylesheets/s3slider.css');
		wp_register_style('css_slider', get_bloginfo('template_directory') . '/stylesheets/slider.css');
		wp_register_style('css_tipsy', get_bloginfo('template_directory') . '/stylesheets/tipsy.css');

		wp_register_script('js_ddsmoothmenu', get_bloginfo('template_directory') . '/js/ddsmoothmenu.js', array('jquery'));
		wp_register_script('js_style_switcher', get_bloginfo('template_directory') . '/js/stylesheetToggle.js', array('jquery'));
		wp_register_script('js_pretty', get_bloginfo('template_directory') . '/js/jquery.prettyPhoto.js', array('jquery'));
		wp_register_script('js_localscrol', get_bloginfo('template_directory') . '/js/jquery.localscroll-min.js', array('jquery'));
		wp_register_script('js_scrolTo', get_bloginfo('template_directory') . '/js/jquery.scrollTo-min.js', array('js_localscrol'));
		wp_register_script('js_tipsy', get_bloginfo('template_directory') . '/js/jquery.tipsy.js', array('jquery'));
		wp_register_script('js_watermarkinput', get_bloginfo('template_directory') . '/js/jquery.watermarkinput.js', array('jquery'));
		wp_register_script('js_sliding_effect', get_bloginfo('template_directory') . '/js/sliding_effect.js', array('jquery'));
		wp_register_script('js_autoAlign', get_bloginfo('template_directory') . '/js/jquery.flexibleColumns.min.js', array('jquery'));
		wp_register_script('js_s3slider', get_bloginfo('template_directory') . '/js/s3Slider.js', array('jquery'));
		wp_register_script('js_slideshow', get_bloginfo('template_directory') . '/js/slideshow.js', array('jquery'));
		wp_register_script('js_slider_nivo', get_bloginfo('template_directory') . '/js/nivoslider/jquery.nivo.slider.js', array('jquery'));
		wp_register_script('js_cufon', get_bloginfo('template_directory') . '/js/cufon/cufon-yui.js', array('jquery'));
		wp_register_script('js_cufon_font', get_bloginfo('template_directory') . '/js/cufon/MgOpen_Modata_400-MgOpen_Modata_700.font.js', array('js_cufon'));
		wp_register_script('js_cufon_load', get_bloginfo('template_directory') . '/js/cufon/cufon-load.js', array('js_cufon_font'));
		wp_register_script('js_color', get_bloginfo('template_directory') . '/js/jquery.color.js', array('jquery'));
		wp_register_script('jquery-tools-tabs', get_bloginfo('template_directory') . '/js/jquery.tools.tabs.min.js', array('jquery'));
	}
	add_action('init', 'init_styles_and_scripts');

} else {
	function init_admin_styles_and_scripts() {
		wp_register_style( 'css_admin_options', get_bloginfo('template_directory') . '/functions/admin_options/stylesheets/admin_options.css');
		wp_register_script( 'jquery-cooke', get_bloginfo('template_directory') . '/functions/admin_options/js/jquery.cookie.js');
		wp_enqueue_style('css_admin_options');
		wp_enqueue_script('jquery-cooke');
		wp_enqueue_script('jquery-ui-tabs');

		remove_meta_box('postcustom', 'post', 'normal');
		remove_meta_box('postcustom', 'page', 'normal');
	}
	add_action('admin_init', 'init_admin_styles_and_scripts');
}

function theme_post_limit($limit) {
		if ( is_admin() ) return $limit;
		$old_limit = $limit;
		if (is_tax('galleries')) {
			$limit = get_option('gallery_post_per_page');
		}
		if ( !$limit )
			$limit = $old_limit;
		elseif ( $limit == '-1' )
			$limit = '18446744073709551615';
		return $limit;
}
add_action( 'option_posts_per_page', 'theme_post_limit');

function theme_addgravatar( $avatar_defaults ) {
	$myavatar = get_bloginfo('template_directory') . '/images/avatar.jpg';
	$avatar_defaults[$myavatar] = 'people';
	return $avatar_defaults;
}
add_filter( 'avatar_defaults', 'theme_addgravatar' );

?>