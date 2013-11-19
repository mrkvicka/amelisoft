<?php
// image
function img_shortcode($atts, $content, $code) {
	extract(shortcode_atts(array(
		'w' => '',
		'h' => '',
		'zc' => '',
		'q' => '',
		'alt' => '',
		'title' => '',
	), $atts));
	if (empty($content))
		return;
	switch ($code) {
		case 'img_left':
			$class = 'pic alignleft';
			break;
		case 'img_right':
			$class = 'pic alignright';
			break;
		case 'img_center':
			$class = 'pic aligncenter';
			break;
		default:
			$class = 'pic';
			break;
	}
	$out = '<img src="' . get_bloginfo('template_url') . "/timthumb.php?src={$content}";
	if (!empty($w))
		$out .= "&w={$w}";
	if (!empty($h))
		$out .= "&h={$h}";
	if (!empty($zc))
		$out .= "&zc={$zc}";
	if (!empty($q))
		$out .= "&q={$q}";

	$out .= "\" class=\"{$class}\"";
	//if (!empty($alt))
		$out .= " alt=\"{$alt}\"";
	if (!empty($title))
		$out .= " title=\"{$title}\"";
	if (!empty($w))
		$out .= " width=\"{$w}\"";
	if (!empty($h))
		$out .= " height=\"{$h}\"";
	$out .= ' />';
	return $out;
}

add_shortcode('img', 'img_shortcode');
add_shortcode('img_left', 'img_shortcode');
add_shortcode('img_right', 'img_shortcode');
add_shortcode('img_center', 'img_shortcode');
// quote
function quotetext_shortcode($atts, $content, $code) {
	switch ($code) {
		case 'quoteleft':
		case 'quoteright':
			return "<div class='$code'><blockquote><p>$content</p></blockquote></div>";
			break;
		default:
			return "<div><blockquote><p>$content</p></blockquote></div>";
			break;
	}
}
add_shortcode('quotetext', 'quotetext_shortcode');
add_shortcode('quoteleft', 'quotetext_shortcode');
add_shortcode('quoteright', 'quotetext_shortcode');

// Button Shortcode
function button_shortcode($atts, $content, $code) {
	extract(shortcode_atts(array(
		'url' => '#',
		'title' => '',
		'align' => '',
		'target' => '_self',
	), $atts));
	$class = $code;
	$wrap_left = $wrap_right = '';
	$style = 'display:block;';
	switch($align) {
		case 'left':
			$class .= ' alignleft';
		break;
		case 'right':
			$class .= ' alignright';
		break;
		case 'wide':

		break;
		case 'center':
			$wrap_left = '<p style="margin: 0; text-align:center;">';
			$wrap_right = '</p>';
			$style = 'display:inline-block;';
		break;
		default:
			$style = 'display:inline-block;';
		break;
	}
	return "{$wrap_left}<a href=\"{$url}\" target=\"{$target}\" title=\"{$title}\" class=\"{$class}\" style=\"{$style}\">{$content}</a>{$wrap_right}";

}
add_shortcode('btn', 'button_shortcode');
//add_shortcode('bigbtn', 'button_shortcode');

// cufon
function cufon_shortcode($atts, $content, $code) {
	extract(shortcode_atts(array(
		'size' => '22',
		'color' => 'black',
		'top' => '0',
		'right' => '0',
		'bottom' => '0',
		'left' => '0',
	), $atts));
	if (empty($content))
		return;
	switch ($code) {
		case 'cufon_left':
			$class = 'cufon alignleft';
			break;
		case 'cufon_right':
			$class = 'cufon alignright';
			break;
		default:
			$class = 'cufon';
			break;
	}
	return "<div class=\"{$class}\" style=\"font-size:{$size}px; color:{$color}; padding:{$top}px {$right}px {$bottom}px {$left}px;\">{$content}</div>";

}
add_shortcode('cufon', 'cufon_shortcode');

// code
function code_shortcode($atts, $content, $code) {
	$content = htmlentities2($content);
	return "<code>$content</code>";
}
add_shortcode('code_block', 'code_shortcode');

// clearfix
function clear_shortcode($atts, $content, $code) {
	return "<div class=\"clear\"></div>";
}
add_shortcode('clear', 'clear_shortcode');

// layouts
function layout_shortcode($atts, $content, $code) {
	$content = do_shortcode($content);
	switch(strtolower($code)) {
		case 'onefourth':
			$class = 'one_fourth';
			break;
		case 'twofourth':
			$class = 'two_fourth';
			break;
		case 'threefourth':
			$class = 'three_fourth';
			break;
		case 'onethird':
			$class = 'one_third';
			break;
		case 'twothird':
			$class = 'two_third';
			break;
		case 'onehalf':
			$class = 'one_half';
			break;
		default:
			return $content = "<p>{$content}</p>";
	}
	$out = '';
	if (isset($atts[0]) && $atts[0] == 'last') {
		$class .= '_last';
		$out .= '<div class="clear"></div>';
	}
	return "<div class=\"{$class}\">{$content}</div>".$out;
}
add_shortcode('FullWidth', 'layout_shortcode');
add_shortcode('OneFourth', 'layout_shortcode');
add_shortcode('TwoFourth', 'layout_shortcode');
add_shortcode('ThreeFourth', 'layout_shortcode');
add_shortcode('OneThird', 'layout_shortcode');
add_shortcode('TwoThird', 'layout_shortcode');
add_shortcode('OneHalf', 'layout_shortcode');

function testimonial_shortcode($atts, $content, $code) {
	extract(shortcode_atts(array(
		'autor' => '',
	), $atts));
	$out = "<div class=\"bubble_box\">$content</div><div class=\"bubble_corner\"></div>";
	if (!empty($autor)) {
		$out .= "<span class=\"testi_author\"><strong>{$autor}</strong></span>";
	}
	return $out;
}
add_shortcode('testimonial', 'testimonial_shortcode');

function info_boxes_shortcode($atts, $content, $code) {
	return "<div class=\"{$code}\">{$content}</div>";
}
add_shortcode('succsess_box', 'info_boxes_shortcode');
add_shortcode('warning_box', 'info_boxes_shortcode');
add_shortcode('error_box', 'info_boxes_shortcode');
add_shortcode('info_box', 'info_boxes_shortcode');
add_shortcode('bubble_box', 'bubble_box_shortcode');

function columns_shortcode($atts, $content, $code) {
	global $short_code_row;
	$short_code_row++;
	$indent = 25;
	if (isset($atts[0])) {
		$indent = $atts[0];
	}
	$content = do_shortcode($content);
	return "<div class=\"auto-row-{$short_code_row}\"" . (isset($atts[1]) ? "style=\"padding-bottom:{$atts[1]}px;\"" : '') . ">
	{$content}
	<div class=\"clear\"></div>
</div>
<script type=\"text/javascript\">
	jQuery('.auto-row-{$short_code_row}').autoColumn({$indent}, 'div.auto-column');
	jQuery('.auto-row-{$short_code_row}').autoHeight('div.auto-column');
</script>
<style type=\"text/css\">
	div[class|=\"auto-column\"] {
		float:left;
	}
</style>";
}
add_shortcode('columns', 'columns_shortcode');

function column_shortcode($atts, $content, $code) {
	$place = 1;
	if (isset($atts[0]))
		$place = $atts[0];
	$content = do_shortcode($content);
	return "<div data-place=\"{$place}\" class=\"auto-column\">{$content}</div>";
}
add_shortcode('column', 'column_shortcode');

function icons_shortcode($atts, $content, $code) {
	extract(shortcode_atts(array(
		'src' => '',
		'align' => ''
	), $atts));
	if (empty($src) && isset($atts[0])) {
		$src = get_bloginfo('template_url').'/images/icons/' . strtolower($atts[0]) . '.png';
	}
	if (empty($align) && isset($atts[1])) {
		$align = " class=\"align{$atts[1]}\"";
	}
	if (!empty($src))
		return "<img src=\"{$src}\"{$align} />";
}
add_shortcode('icon', 'icons_shortcode');

//function service_shortcode($atts, $content, $code) {
//	extract(shortcode_atts(array(
//		'icon' => '',
//		'title' => ''
//	), $atts));
//		return "<div class=\"box_management\"><h4>{$title}</h4>{$content}</div>";
//}
//add_shortcode('service_box', 'service_shortcode');

function top_shortcode($atts, $content, $code) {
	return "<div class=\"gototop\"><a href=\"#top\">top</a></div>";
}
add_shortcode('top', 'top_shortcode');

function heading_shortcode($atts, $content, $code) {
	return "<div class=\"title\"><h2>{$content}</h2></div>";
}
add_shortcode('heading', 'heading_shortcode');

function dropcap_shortcode($atts, $content, $code) {
	$content = do_shortcode($content);
	return "<p class=\"dropcap\">{$content}</p>";
}
add_shortcode('dropcap', 'dropcap_shortcode');

function divider_shortcode($atts, $content, $code) {
	return "<div class=\"line\"></div>";
}
add_shortcode('divider', 'divider_shortcode');

function block_shortcode($atts, $content, $code) {
	extract(shortcode_atts(array(
		'bg' => '',
		'border' => '',
		'textcolor' => '',
	), $atts));
	if (empty($bg) && isset($atts[0])){
		$bg = $atts[0];
	}
	if (empty($border) && isset($atts[1])){
		$border = $atts[1];
	}
	if (empty($textcolor) && isset($atts[2])){
		$textcolor = $atts[2];
	}
	$style = '';
	if (!empty($bg))
		$style .= 'background:'.$bg.'; ';
	if (!empty($border))
		$style .= 'border-color:'.$border.'; ';
	if (!empty($textcolor))
		$style .= 'color:'.$textcolor.'; ';
	if (!empty($style))
		$style = " style=\"{$style}\"";
	return "<div class=\"clear\"></div></div><div class=\"box\"{$style}>";
}
add_shortcode('block', 'block_shortcode');

function toggle_shortcode($atts, $content, $code) {
	$content = do_shortcode($content);
	$out = '<div class="dcs-toggle-flat" style="margin-left:0px;margin-bottom:15px;"><div class="toggle-flat-icon-open"></div><span class="toggle-flat-triger" style="font-weight: normal; color: rgb(255, 163, 25); background-color: rgb(10, 10, 10); ">'.__('Get the Code', TEMPLATENAME).'</span><div class="toggle-flat-content" style="padding-right: 10px; padding-left: 10px; display: none; padding-top: 15px; padding-bottom: 15px; ">';
	$out .= $content;
	$out .= '</div></div>';
	return $out;
}
add_shortcode('toggle', 'toggle_shortcode');

function list_shortcode($atts, $content, $code) {
	$class = 'ordered';
	$list = 'ol';
	if (isset($atts[0])) {
		switch ($atts[0]) {
			case 'unordered':
				$list = 'ul';
				$class = $atts[0];
			break;
		}
	}
	$items = explode("\r\n", $content);
	$out = '';
	if (!empty($items)) {
		$out = '<div>';
		$out .= "<{$list} class=\"{$class}\">";
		foreach ($items as $item) {
			if (empty($item))
				continue;
			$out .= "<li><span>{$item}</span></li>";
		}
		$out .= "</{$list}>";
		$out .= '</div>';
	}
	return $out;
}
add_shortcode('list', 'list_shortcode');

function grafit_box_shortcode($atts, $content, $code) {
	$content = do_shortcode($content);
	return "<div class=\"g_box\">{$content}</div>";
}
add_shortcode('grafit_box', 'grafit_box_shortcode');

// Tabs Shortcode
function tabs_shortcode($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'style' => false
	), $atts));
	
	if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} else {
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
		}
		$output = '<ul class="'.$code.'">';
		
		for($i = 0; $i < count($matches[0]); $i++) {
			$output .= '<li><a href="#">' . $matches[3][$i]['title'] . '</a></li>';
		}
		$output .= '</ul>';
		$output .= '<div class="panes">';
		for($i = 0; $i < count($matches[0]); $i++) {
			$output .= '<div class="pane">' . do_shortcode(trim($matches[5][$i])) . '</div>';
		}
		$output .= '</div>';
		
		return '<div class="'.$code.'_container">' . $output . '</div>';
	}
}
add_shortcode('tabs', 'tabs_shortcode');

function my_formatter($content) {
		 $new_content = '';
		 $pattern_full = '{(\[raw\].*?\[/raw\])}is';
		 $pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
		 $pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

		 foreach ($pieces as $piece) {
					if (preg_match($pattern_contents, $piece, $matches)) {
							  $new_content .= $matches[1];
					} else {
							  $new_content .= wptexturize(wpautop($piece));
					}
		 }

		 return $new_content;
}
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');
add_filter('the_content', 'my_formatter', 99);

add_filter('widget_text', 'do_shortcode');

?>