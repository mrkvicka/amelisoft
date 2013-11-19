<?php
/**
 * Header Template
 *
 * Here we setup all logic and XHTML that is required for the header section of all screens.
 *
 */
global $woo_options;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>Amelisoft | softwarové a grafické studio</title>
<?php woo_meta(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>" media="screen" />
<link rel="stylesheet" type="text/css" href="../wp-content/themes/amelisoft/styles/bootstrap.min.css" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<link rel="stylesheet" type="text/css" href="../wp-content/themes/amelisoft/styles/css/style.css" />
<link rel="stylesheet" type="text/css" href="../wp-content/themes/amelisoft/styles/css/jquery.jscrollpane.css" media="all" />
<link rel="stylesheet" type="text/css" href="../wp-content/themes/amelisoft/styles/jquery.slider.css">
<!--
<link rel="stylesheet" type="text/css" href="../wp-content/themes/amelisoft/styles/custom.css" />
<link rel="stylesheet" type="text/css" href="../wp-content/themes/amelisoft/styles/jquery.jscrollpane.css" />
-->
<link rel="stylesheet" type="text/css" href="../wp-content/themes/amelisoft/styles/style.css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript" src="../wp-content/themes/amelisoft/styles/js/jquery.easing.1.3.js"></script>
<!-- the jScrollPane script -->
<script type="text/javascript" src="../wp-content/themes/amelisoft/styles/js/jquery.mousewheel.js"></script>

<script type="text/javascript" src="../wp-content/themes/amelisoft/styles/js/jquery.contentcarousel.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript" src="../wp-content/themes/amelisoft/js/jquery.slider.min.js"></script>
<script type="text/javascript" src="../wp-content/themes/amelisoft/js/jquery.sticky.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("a").each(function(index) {
		if ($(this).attr("href").substring(0,1) == "#") {
	    	$(this).click(function (e) {
			    var $href = $(this).attr("href");
			    $("html, body").stop().animate({
					scrollTop: $($href).offset().top
					}, 500,"easeInOutExpo");
			    e.preventDefault();
			});
		}
	});
});
</script>

<!--developer script-->
<!--developer script-->



<?php wp_head(); ?>
<?php woo_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php woo_top(); ?>

<div id="wrapper">

	<?php if ( function_exists( 'has_nav_menu' ) && has_nav_menu( 'top-menu' ) ) { ?>

	<div id="top">
		<div class="col-full">
			<?php wp_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'top-nav', 'menu_class' => 'nav fl', 'theme_location' => 'top-menu' ) ); ?>
		</div>
	</div><!-- /#top -->

    <?php } ?>
	