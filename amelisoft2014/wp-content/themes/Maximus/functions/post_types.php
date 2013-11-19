<?php

function enable_page_excerpts() {
	add_post_type_support('page', 'excerpt');
}
add_action('init', 'enable_page_excerpts');

function theme_auto_excerpt_more( $more ) {
	return ' &hellip;';
}
add_filter( 'excerpt_more', 'theme_auto_excerpt_more' );

function add_featured_meta_box(){
	add_meta_box('_descr', __('Page description', TEMPLATENAME), 'page_desc_options', 'page', 'normal', 'high');
	add_meta_box('_slider', __('Select a slider', TEMPLATENAME), 'page_slider_options', 'page', 'normal', 'high');
	add_meta_box('_featured_box', __('Featured Box', TEMPLATENAME), 'featured_options', 'post', 'normal', 'high');
	add_meta_box('_featured_box', __('Featured Box', TEMPLATENAME), 'featured_options', 'page', 'normal', 'high');
	add_meta_box('_link_box', __('Video File', TEMPLATENAME), 'post_video_options', 'post', 'normal', 'high');
}
add_action('admin_init', 'add_featured_meta_box');

function post_video_options(){
	global $post;
	$video_link = get_post_meta($post->ID, 'video_link', true);
?>
<p>
	<label for="video_link"><?php _e('Video:', TEMPLATENAME); ?></label>
	<input id="video_link" class="custom_field" name="video_link" type="text" value="<?php echo $video_link; ?>" />
	<br class="clear" />
</p>
<style type="text/css">
	.custom_field {
		width: 60%;
	}
	label[for="video_link"] {
		width: 7%;
		display: block;
		float: left;
	}
</style>
<?php
}

function page_slider_options(){
	global $post;
	global $_theme_sliders;
	$custom = get_post_custom($post->ID);
	$slider_type = (empty($custom['slider_type'][0]) ? '' : $custom['slider_type'][0]);

	echo '<label class="screen-reader-text" for="slider_type">' . __('Select a slider:', TEMPLATENAME) . ' </label><select name="slider_type" id="slider_type">';
	foreach($_theme_sliders as $key => $val) {
		echo "<option value=\"{$key}\"".selected($key, $slider_type).">{$val}</option>";
	}
	echo '</select>';
}

function page_desc_options(){
	global $post;
	$custom = get_post_custom($post->ID);
	$page_description = (empty($custom['page_description'][0]) ? '' : $custom['page_description'][0]);
	echo '<label class="screen-reader-text" for="page_description">' . __('Page description:', TEMPLATENAME) . ' </label><textarea rows="2" cols="40" name="page_description" tabindex="6" id="page_description" style="width: 99%;">' . $page_description . '</textarea>';
}

function featured_options(){
	global $post;
?>
<p><textarea class="large-text code" name='featured_box' id='featured_box' rows="7"><?php echo get_post_meta($post->ID, 'featured_box', true); ?></textarea></p>
<?php
}

// Add custom fields for posts
function custom_add_save($postID){
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $postID;
	} else {
		// called after a post or page is saved and not on autosave
		if($parent_id = wp_is_post_revision($postID)){
			$postID = $parent_id;
		}

		$fields = array('side_bar', 'bottom_bar', 'layout', 'featured_box', 'page_description', 'slider_type', 'video_link');

		foreach($fields as $field_name) {
			if (isset($_POST[$field_name]))
				if (!empty($_POST[$field_name])){
					update_custom_meta($postID, $_POST[$field_name], $field_name);
				} else {
					update_custom_meta($postID, '', $field_name);
				}
		}
	}

}
add_action('save_post', 'custom_add_save');

function update_custom_meta($postID, $new_value, $field_name) {
	// To create new meta
	if(!get_post_meta($postID, $field_name)){
		add_post_meta($postID, $field_name, $new_value);
	} else {
		// or to update existing meta
		update_post_meta($postID, $field_name, $new_value);
	}
}

function custom_post_types() {
	register_taxonomy(
		'galleries',
		'post',
		array(
			'hierarchical' => true,
			'label' => __('Galleries'),
			'singular_label' => __('Gallery'),
			'query_var' => true,
			'rewrite' => true,
		)
	);

}
add_action('init', 'custom_post_types');

?>
