<?php
/**
 * The Header for our theme.
 *
 * @package WordPress
 *
 *
 */
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="content-type" content="text/html;charset=<?php bloginfo( 'charset' ); ?>" />
<?php if ($_fav_ico = get_option('favicon')): ?>
<?php $_fav_ico = wp_get_attachment_image_src($_fav_ico['attachment_id'], array(16, 16), false); ?>
<link rel="shortcut icon" href="<?php echo $_fav_ico[0]; ?>" />
<?php endif; ?>
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', TEMPLATENAME ), max( $paged, $page ) );

	?></title>

	<?php enqueue_color_styles();	?>
	<?php wp_enqueue_style('css_ddsmoothmenu'); ?>
	<?php wp_enqueue_style('css_tipsy'); ?>

<?php
	global $_slider_type;
	$_slider_type = get_option('slider_type');
	if (is_page()) {
		the_post();
		$_slider_type = get_post_meta($post->ID, 'slider_type', true);
	}
 ?>
	<?php slider_enqueue(); ?>

	<?php if (get_option('show_switcher')): ?>
		<?php wp_enqueue_script('js_style_switcher'); ?>
	<?php endif; ?>
	<?php wp_enqueue_script('js_cufon_load'); ?>
	<?php wp_enqueue_script('js_tipsy'); ?>
	<?php wp_enqueue_script('js_scrolTo'); ?>
	<?php wp_enqueue_script('js_ddsmoothmenu'); ?>
	<?php wp_enqueue_script('js_watermarkinput'); ?>
	<?php wp_enqueue_script('js_sliding_effect'); ?>
	<?php wp_enqueue_script('js_autoAlign'); ?>
	<?php wp_enqueue_script('js_color'); ?>
	<?php wp_enqueue_script('jquery-tools-tabs'); ?>
<?php
	if (is_single() || is_tax('galleries')) {
		wp_enqueue_style('css_pretty');
		wp_enqueue_script('js_pretty');
	}
 ?>

<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>

	

	<?php slider_init(); ?>
	
	<script type="text/javascript">
		ddsmoothmenu.init({
			mainmenuid: "menu", //menu DIV id
			orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
			classname: 'ddsmoothmenu', //class added to menu's outer DIV
			//customtheme: ["#1c5a80", "#18374a"],
			contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
		})
		jQuery(function() {
			var slide = false;
			var height = jQuery('#footer_content').height();
			jQuery('#footer_button').click(function() {
				var docHeight = jQuery(document).height();
				var windowHeight = jQuery(window).height();
				var scrollPos = docHeight - windowHeight + height;
				jQuery('#footer_content').animate({ height: "toggle"}, 1000);
				if(slide == false) {
					if(jQuery.browser.opera) {
						jQuery('html').animate({scrollTop: scrollPos+'px'}, 1000);
					} else {
						jQuery('html, body').animate({scrollTop: scrollPos+'px'}, 1000);
					}
					slide = true;
					jQuery('#footer_content').autoAlign('.widget-container', 50);
				} else {
					slide = false;
				}
			});
		});
		jQuery(function() {
			jQuery('#attr a').tipsy(
			{
				gravity: 's', // nw | n | ne | w | e | sw | s | se
				fade: true
			});
		});
		jQuery(function(){
			jQuery("#search").Watermark("Search");
		});
		jQuery(function(){
			jQuery.localScroll();
		});
		jQuery(function() {
			jQuery('.display img.a').hide();//hide all the images on the page
		});

		var i = 0;//initialize
		var int=0;//Internet Explorer Fix
		jQuery(window).bind("load", function() {//The load event will only fire if the entire page or document is fully loaded
			var int = setInterval("doThis(i)",500);//500 is the fade in speed in milliseconds
		});
		function doThis() {
			var imgs = jQuery('.display img.a').length;//count the number of images on the page
			if (i >= imgs) {// Loop the images
				clearInterval(int);//When it reaches the last image the loop ends
			}
			jQuery('.display img.a:hidden').eq(0).fadeIn(500);//fades in the hidden images one by one
			i++;//add 1 to the count
		}

		jQuery(document).ready(function() {
			// find the div.fade elements and hook the hover event
			jQuery('#attr a').hover(function() {
				// on hovering over find the element we want to fade *up*
				var fade = jQuery('> .hover', this);

				// if the element is currently being animated (to fadeOut)...
				if (fade.is(':animated')) {
					// ...stop the current animation, and fade it to 1 from current position
					fade.stop().fadeTo(300, 1);
				} else {
					fade.fadeIn(300);
				}
			}, function () {
				var fade = jQuery('> .hover', this);
				if (fade.is(':animated')) {
					fade.stop().fadeTo(300, 0);
				} else {
					fade.fadeOut(300);
				}
			});

			// get rid of the text
			jQuery('#attr a > .hover').empty();

			

			jQuery("a.switch_thumb").toggle(function(){
				jQuery(this).addClass("swap");
				jQuery("ul.display").fadeOut("fast", function() {
					jQuery(this).fadeIn("fast").addClass("thumb_view");
				});
			}, function () {
				jQuery(this).removeClass("swap");
				jQuery("ul.display").fadeOut("fast", function() {
					jQuery(this).fadeIn("fast").removeClass("thumb_view");
				});
			});
			jQuery(".display img.b").fadeTo("slow", 0); // This sets the opacity of the thumbs to fade down to 0% when the page loads
			jQuery(".display img.b").hover(function(){
				jQuery(this).fadeTo("slow", 0.5); // This should set the opacity to 50% on hover
			},function(){
				jQuery(this).fadeTo("slow", 0); // This should set the opacity back to 0% on mouseout
			});
			jQuery(".pic, .pic_left, .pic_right, .flickr img").css({
					backgroundColor: "#fff",
					borderColor: "#D5D5D5"
				});
			jQuery(".pic, .pic_left, .pic_right, .flickr img").hover(function() {
				jQuery(this).stop().animate({
					backgroundColor: "#666",
					borderColor: "#333"
					}, 300);
				},function() {
				jQuery(this).stop().animate({
					backgroundColor: "#fff",
					borderColor: "#D5D5D5"
					}, 500);
			});
			jQuery(".tabs_container").each(function(){
				jQuery("ul.tabs",this).tabs("div.panes > div", {tabs:'li',effect: 'fade'});
			});
			jQuery('.widget_recent_projects ul').cycle({
				fx: 'scrollLeft',
				timeout: 5000,
				delay: -1000
			});
		});
	</script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			 jQuery('.toggle-flat-triger').click(function() {
				  var state = jQuery(this).parent().find('.toggle-flat-content').css('display');
				  var parent = jQuery(this).parent();
				  if(state == 'none') {
						jQuery(parent).find('.toggle-flat-icon-open').removeClass('toggle-flat-icon-open').addClass('toggle-flat-icon-close');
						jQuery(parent).find('.toggle-flat-triger').css('background-color', '#181818');
				  } else {
						jQuery(parent).find('.toggle-flat-icon-close').removeClass('toggle-flat-icon-close').addClass('toggle-flat-icon-open');
						jQuery(parent).find('.toggle-flat-triger').css('background-color', '#0A0A0A');
				  }
				  jQuery(parent).find('.toggle-flat-content').slideToggle(200);
			 });
		});
	</script>
	<?php if (get_option('ga_use')) echo get_option('ga_code'); ?>
</head>
<body<?php if ((is_page() || is_front_page()) && in_array($_slider_type, array('nivo1', 'nivo2', 'nivo3'))) echo ' id="main"'; ?>>

<div id="<?php if (is_page() || is_front_page()) {switch ($_slider_type) {case 'nivo1': echo 'macbook'; break; case 'nivo2': echo 'ipad'; break; case 'nivo3': echo 'iphone'; break; default: echo 'wide';}} else {echo 'wide';} ?>" class="container">
	<div id="top">
		<div class="wrap">
			<!-- Site Logo -->
			<a href="<?php echo home_url('/'); ?>" class="logo">
			<?php $logo = get_option('logo'); ?>
			<?php if (!empty($logo)): ?>
				<?php echo wp_get_attachment_image($logo['attachment_id'], array(get_option('logo_width'), get_option('logo_height')+1), false, array('title' => false)); ?>
			<?php else: ?>
				<img src="<?php echo get_bloginfo('template_url').'/images/logo.png'; ?>" width="300" height="75" alt="" />
			<?php endif; ?>
			</a>
			<div id="menu">
			<?php wp_nav_menu(
				array(
					'container' => false,
					'menu_class' => 'ddsmoothmenu',
					'theme_location' => 'primary',
				)
			); ?>
			</div>
			<div class="clear"></div>
		</div>
		<?php get_template_part('part', 'title'); ?>
	</div>
<?php global $_show404; if (!$_show404 && (is_page() || is_front_page()) && $_slider_type != 'none'): ?>
	<?php theme_slider_render(); ?>
<?php else: ?>
	<!-- Begin Breadcrumbs -->
	<?php if (function_exists('theme_breadcrumbs')) theme_breadcrumbs(); ?>
	<!-- End Breadcrumbs -->
<?php endif; ?>
