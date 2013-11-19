<?php
class ElementTextarea extends ElementBase {

	public function __construct($page, $section, $params = array()) {
		if (!empty($params)) {
			if (!isset($params['id'])) {
				$params['id'] = $params['name'];
			}
			if (!isset($params['rows'])) {
				$params['rows'] = 5;
			}
			if (!isset($params['cols'])) {
				$params['cols'] = 30;
			}
		}
		parent::__construct($page, $section, $params);
	}

	public function render($args) {
		require(dirname(__FILE__) . '/template-textarea.php');
	}

}

?>
