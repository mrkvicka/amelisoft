<?php
class ElementUpload extends ElementBase {

	public function __construct($page, $section, $params = array()) {
		if (!empty($params)) {
			if (!isset($params['id'])) {
				$params['id'] = $params['name'];
			}
		}
		parent::__construct($page, $section, $params);
	}

	public function validate($input) {
		$newinput = array();
		if (!empty($_FILES[$this->name]) && $_FILES[$this->name]['error'] != 4) {
			$overrides = array('test_form' => false);
			$upload_file = wp_handle_upload($_FILES[$this->name], $overrides);
			if (isset($file['error'])) {
				if ( function_exists('add_settings_error') ) {
					add_settings_error($this->name.'_group', 'invalid_'.$this->name, $file['error']);
				}
			} else {
				$url = $upload_file['url'];
				$type = $upload_file['type'];
				$file = addslashes( $upload_file['file'] );
				$filename = basename( $file );

				// Construct the object array
				$object = array(
					'post_title' => $filename,
					'post_content' => $url,
					'post_mime_type' => $type,
					'guid' => $url
				);

				// Delete old data
				$option = get_option($this->name);
				if (isset($option['attachment_id'])) {
					wp_delete_attachment($option['attachment_id'], true);
				}
				if (isset($this->args['max_width']) && isset($this->args['max_height'])) {
					if (is_string($this->args['max_width']))
						$this->args['max_width'] = get_option($this->args['max_width']);
					if (is_string($this->args['max_height']))
						$this->args['max_height'] = get_option($this->args['max_height']);

					global $_wp_additional_image_sizes;
					$_wp_additional_image_sizes = array();
					add_image_size('temp', $this->args['max_width'], $this->args['max_height'], true);
				}
				// Save the data
				$id = wp_insert_attachment( $object, $file );
				wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $file ) );
				do_action('wp_create_file_in_uploads', $file, $id); // For replication

				$upload_file['attachment_id'] = $id;
				$newinput = $upload_file;
			}
		} else {
			$newinput = get_option($this->name);
		}
		return $newinput;
	}

	public function render($args) {
		require(dirname(__FILE__) . '/template-upload.php');
	}

}

?>
