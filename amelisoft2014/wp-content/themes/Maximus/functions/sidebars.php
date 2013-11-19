<?php

function theme_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Default Sidebar Widget Area', TEMPLATENAME),
		'id' => 'default-side-widget-area',
		'description' => __( 'The default sidebar of page widget area', TEMPLATENAME),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

}
add_action('widgets_init', 'theme_widgets_init');

add_option('generated_sidebars', array());

function get_registered_sidebars() {
	global $wp_registered_sidebars;
	foreach ($wp_registered_sidebars as $id => $sidebar) {
		if ( 'wp_inactive_widgets' == $id )
			continue;
		$out[$id] = $sidebar['name'];
	}
	return $out;
}

function theme_add_sidebar($arg) {
	$name = apply_filters('widget_title', $_POST['sidebar_name']);
	$description = format_to_edit($_POST['sidebar_description']);
	if (!empty($name)) {
		$registered_sidebars = get_registered_sidebars();
		if (!in_array($name, $registered_sidebars)) {
			global $wp_registered_sidebars;
			$sidebars = get_option('generated_sidebars');
			$sidebar_id = register_sidebar(array(
				'name' => $name,
				'description' => $description,
				'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			));
			$sidebars[$sidebar_id] = $wp_registered_sidebars[$sidebar_id];
			update_option('generated_sidebars', $sidebars);
			$up = get_option('generated_sidebars');
			add_settings_error('general', 'settings_updated', __('Sidebar successfully added.'), 'updated');
		} else {
			add_settings_error('sidebars', 'name', __('Sidebar already exists, please use a different name.', TEMPLATENAME));
		}
	} else {
		add_settings_error('sidebars', 'name', __('Sidebar name cannot by empty.', TEMPLATENAME));
	}
	set_transient('settings_errors', get_settings_errors(), 30);
	$goback = wp_get_referer();
	wp_redirect($goback);
	exit;
}
add_action('admin_action_add_sidebar', 'theme_add_sidebar');

function theme_remove_sidebar() {
	$id = $_POST['sidebar_id'];
	global $wp_registered_sidebars;
	if (array_key_exists($id, $wp_registered_sidebars)) {
		$sidebars = get_option('generated_sidebars');
		if (array_key_exists($id, $sidebars)) {
			unset($sidebars[$id]);
			unregister_sidebar($id);
			update_option('generated_sidebars', $sidebars);
			add_settings_error('general', 'settings_updated', __('Sidebar successfully removed.'), 'updated');
		} else {
			add_settings_error('sidebars', 'name', __('This sidebar is not possible to remove.', TEMPLATENAME));
		}
	} else {
		add_settings_error('sidebars', 'name', __('This sidebar does not exist.', TEMPLATENAME));
	}
	set_transient('settings_errors', get_settings_errors(), 30);
	$goback = wp_get_referer();
	wp_redirect($goback);
	exit;
}
add_action('admin_action_remove_sidebar', 'theme_remove_sidebar');

function theme_register_sidebars() {
	$sidebars = get_option('generated_sidebars');
	foreach ($sidebars as $sidebar)
		register_sidebar($sidebar);
}
add_action('widgets_init', 'theme_register_sidebars');

function theme_sidebar_manage_form() {
?>
<?php
global $wp_settings_errors;
$wp_settings_errors = get_transient('settings_errors');
settings_errors();
?>
<div id="sidebar-manage">
	<div id="actionbox-liquid" class="widgets-holder-wrap ui-droppable">
		<div class="sidebar-name">
			<div class="sidebar-name-arrow"><br /></div>
			<h3><?php _e('Sidebar managment', TEMPLATENAME) ?></h3>
		</div>
		<div class="widget-holder">
			<div style="width: 71%; float: left;">
				<form action="<?php echo admin_url('admin.php'); ?>" method="post">
					<input type="hidden" name="action" value="add_sidebar" />
					<div style="width: 45%; float: left;">
						<label for="sidebar_name"><?php _e('Enter name for a new sidebar:', TEMPLATENAME) ?></label>
						<input id="sidebar_name" class="widefat" type="text" name="sidebar_name" value="" /><br /><br />
						<input type="submit" class="button-primary" value="<?php _e('Add', TEMPLATENAME); ?>" />
					</div>
					<div style="width:53%; float:right;">
						<label for="sidebar_description"><?php _e('Enter description for a new sidebar:', TEMPLATENAME) ?></label>
						<textarea id="sidebar_description" name="sidebar_description" style="width:auto;" cols="30" rows="2" ></textarea>
					</div>
					<div style="clear:both;"></div>
				</form>
			</div>
			<div style="float:right; width: 28%;">
				<form action="<?php echo admin_url('admin.php'); ?>" method="post">
					<input type="hidden" name="action" value="remove_sidebar" />
					<label for="sidebar_id"><?php _e('Select a sidebar to delete:', TEMPLATENAME) ?></label><br />
					<select id="sidebar_id" type="text" name="sidebar_id">
						<?php foreach (get_option(generated_sidebars) as $_id => $_sidebar): ?>
						<option value="<?php echo $_id; ?>"><?php echo $_sidebar['name']; ?></option>
						<?php endforeach; ?>
					</select><br /><br />
					<input type="submit" class="button-primary" value="<?php _e('Delete', TEMPLATENAME); ?>" />
				</form>
			</div>
		<br class="clear" />
		</div>
	</div>
</div>
<style type="text/css">
	.clos {
		width: 30%;
	}

	#left_col {
		float: left;
	}

	#sidebar-manage input[type=text], #sidebar-manage select{
		width: 95%;
	}

	#sidebar-manage {
		margin-left: 5px;
		margin-right: 5px;
	}

	#actionbox-liquid {
		background-color: transparent;
		border: 0px none;
		margin-bottom: 0px;
	}

	#sidebar-manage .sidebar-name {
		background-color: #AAA;
		background-image: url(images/ed-bg.gif) important;
		border-color: #DFDFDF;
		text-shadow: white 0px 1px 0px;
	}

	#sidebar-manage .sidebar-name-arrow {
		background: transparent url(images/menu-bits.gif) no-repeat scroll 0% -109px;
	}

	#sidebar-manage .widget-holder {
		border-bottom-left-radius: 8px 8px;
		border-bottom-right-radius: 8px 8px;
		border-style: none solid solid;
		border-width: 0px 1px 1px;
		padding: 7px 17px 12px;
		background-color: white;
		border-color: #DDD;
	}
</style>
<script>
	jQuery(window).load(function() {
		jQuery("#sidebar-manage").children(".widgets-holder-wrap").children(".sidebar-name").click(function () {
			jQuery(this).siblings(".widget-holder").parent().toggleClass("closed")
		});
		jQuery('#sidebar-manage .sidebar-name').css('background-image', jQuery('#widgets-left .sidebar-name').css('background-image'));
		jQuery('#sidebar-manage .sidebar-name-arrow').css('background-image', jQuery('#widgets-left .sidebar-name-arrow').css('background-image'));
		jQuery('#sidebar-manage').prependTo(jQuery('#widgets-left')).css('margin', 0);
	});
</script>
<?php
}
add_filter('widgets_admin_page', 'theme_sidebar_manage_form');

function add_page_meta_box(){
	add_meta_box('posts_view_opt', __('Layout options', TEMPLATENAME), 'post_custom_options', 'post', 'normal', 'high');
	add_meta_box('page_view_opt', __('Layout options', TEMPLATENAME), 'post_custom_options', 'page', 'normal', 'high');
}
add_action('admin_init', 'add_page_meta_box');

global $_theme_layouts;
$_theme_layouts = array(
	1 => __('With right sidebar', TEMPLATENAME),
	2 => __('With left sidebar', TEMPLATENAME),
	3 => __('Full width', TEMPLATENAME),
);

function post_custom_options(){
	global $post;
	global $_theme_layouts;
	$sidebars = get_registered_sidebars();
	$set_layout = get_post_meta($post->ID, 'layout', true);
	$set_side_bar = get_post_meta($post->ID, 'side_bar', true);
	$set_bottom_bar = get_post_meta($post->ID, 'bottom_bar', true);
?>
<table width="100%" class="layout_options">
	<tr>
		<td width="33%">
			<p>
				<label for="layout"><?php _e('Select layout:', TEMPLATENAME); ?></label>
				<select name="layout">
					<option value=""<?php selected($set_layout, ''); ?>><?php _e('Default', TEMPLATENAME); ?></option>
					<?php foreach ($_theme_layouts as $layout => $name): ?>
					<option value="<?php echo $layout; ?>"<?php selected($set_layout, $layout); ?>><?php echo $name; ?></option>
					<?php endforeach; ?>
				</select>
			</p>
		</td>
		<td width="33%">
			<p>
				<label for="side_bar"><?php _e('Select side bar:', TEMPLATENAME); ?></label>
				<select name="side_bar">
					<option value=""<?php selected($set_side_bar, ''); ?>><?php _e('Default', TEMPLATENAME); ?></option>
					<option value="disable"<?php selected($set_side_bar, 'disable'); ?>><?php _e('Disable sidebar', TEMPLATENAME); ?></option>
					<?php foreach($sidebars as $sidebar_id => $sidebar_name): ?>
					<option value="<?php echo $sidebar_id; ?>"<?php selected($set_side_bar, $sidebar_id); ?>><?php echo $sidebar_name; ?></option>
					<?php endforeach; ?>
				</select>
			</p>
		</td>
		<td width="33%">
			<p>
				<label for="bottom_bar"><?php _e('Select bottom bar:', TEMPLATENAME); ?></label>
				<select name="bottom_bar">
					<option value=""<?php selected($set_bottom_bar, ''); ?>><?php _e('Default', TEMPLATENAME); ?></option>
					<option value="disable"<?php selected($set_bottom_bar, 'disable'); ?>><?php _e('Disable sidebar', TEMPLATENAME); ?></option>
					<?php foreach($sidebars as $sidebar_id => $sidebar_name): ?>
					<option value="<?php echo $sidebar_id; ?>"<?php selected($set_bottom_bar, $sidebar_id); ?>><?php echo $sidebar_name; ?></option>
					<?php endforeach; ?>
				</select>
			</p>
		</td>
	</tr>
</table>
<style type="text/css">
.layout_options td label {display:block;}
</style>
<?php
}

include(TEMPLATEPATH . '/widgets/widget-recent.php');
include(TEMPLATEPATH . '/widgets/widget-recent-proj.php');
include(TEMPLATEPATH . '/widgets/widget-tabbed.php');
include(TEMPLATEPATH . '/widgets/widget-flickr.php');

?>