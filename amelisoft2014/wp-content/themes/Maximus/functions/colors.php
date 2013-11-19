<?php
global $_theme_colors;
$_theme_colors = array(
	'orange' => __('Orange', TEMPLATENAME),
	'lime' => __('lime', TEMPLATENAME),
	'black' => __('black', TEMPLATENAME),
	'blue' => __('blue', TEMPLATENAME),
	'green' => __('green', TEMPLATENAME),
	'magenta' => __('magenta', TEMPLATENAME),
	'silver' => __('silver', TEMPLATENAME),
	'purple' => __('purple', TEMPLATENAME),
	'skyblue' => __('skyblue', TEMPLATENAME),
	'golden' => __('golden', TEMPLATENAME),
	'pink' => __('pink', TEMPLATENAME),
	'emerald' => __('emerald', TEMPLATENAME),
	'violet' => __('violet', TEMPLATENAME),
	'deepblue' => __('deepblue', TEMPLATENAME),
	'darkred' => __('darkred', TEMPLATENAME),
	'lightbrown' => __('lightbrown', TEMPLATENAME),
	'darkgreen' => __('darkgreen', TEMPLATENAME),
	'red' => __('red', TEMPLATENAME),
	'brown' => __('brown', TEMPLATENAME),
	'yellow' => __('yellow', TEMPLATENAME),
	'darkviolet' => __('darkviolet', TEMPLATENAME),
	'metallicblue' => __('metallicblue', TEMPLATENAME),
	'lightbeige' => __('lightbeige', TEMPLATENAME),
	'bordo' => __('bordo', TEMPLATENAME),
	'ocean' => __('ocean', TEMPLATENAME),
);

function theme_color_styles() {
	wp_register_style('css_main', get_bloginfo('template_directory') . '/stylesheets/style.css');
	global $_theme_colors;
	foreach ($_theme_colors as $color => $name) {
		wp_register_style("css_{$color}", get_bloginfo('template_directory') . "/stylesheets/style-{$color}.css", array('css_main'), false, 'screen');
	}
	global $wp_styles;
	$default = get_option('defailt_theme_color');
	$preset = (get_option('show_switcher') && isset($_COOKIE['style'])) ? $_COOKIE['style'] : false;
	$style_to_set = ($preset) ? $preset : $default;
	foreach ($_theme_colors as $color => $name) {
		if ($color != $style_to_set) {
			$wp_styles->registered["css_{$color}"]->add_data('alt', true);
		}
		$wp_styles->registered["css_{$color}"]->add_data('title', $color);
	}
}

function theme_color_switcher($action) {
	if (!get_option('show_switcher'))
		return;
	switch ($action) {
		case 'init':
 ?>
	<!-- Stylesheet switcher built on jQuery -->
	<script type="text/javascript">
		jQuery(function($) {
			var offset = $("#colors").offset();
			var topPadding = 50;
			jQuery(window).scroll(function() {
				if (jQuery(window).scrollTop() > offset.top) {
					jQuery("#colors").stop().animate({
						marginTop: $(window).scrollTop() - offset.top + topPadding
					});
				} else {
					jQuery("#colors").stop().animate({
						marginTop: 0
					});
				};
			});
		});
		jQuery(function($)
			{
				// Call stylesheet init so that all stylesheet changing functions
				// will work.
				$.stylesheetInit();

				// When one of the styleswitch links is clicked then switch the stylesheet to
				// the one matching the value of that links rel attribute.
				$('#colors a').bind(
					'click',
					function(e)
					{
						$.stylesheetSwitch(this.getAttribute('rel'));
						return false;
					}
				);
			}
		);
	</script>
 <?php
		break;
		case 'render':
			global $_theme_colors;
			echo '<div id="colors"><ul>';
			$url = home_url('/');
			foreach ($_theme_colors as $color => $name) {
				echo "<li><a href='{$url}?style={$color}' rel='{$color}' class='{$color} styleswitch' title='{$name}'>{$name}</a></li>";
			}
			echo '</ul></div>';
		break;
	}
}

function enqueue_color_styles() {
	global $_theme_colors;
	$default = get_option('defailt_theme_color');
	$preset = (get_option('show_switcher') && isset($_COOKIE['style'])) ? $_COOKIE['style'] : false;
	$style_to_set = ($preset) ? $preset : $default;
	wp_enqueue_style("css_{$style_to_set}");
	foreach ($_theme_colors as $color => $name) {
		if ($color != $style_to_set) {
			wp_enqueue_style("css_{$color}");
		}
	}
}


?>
