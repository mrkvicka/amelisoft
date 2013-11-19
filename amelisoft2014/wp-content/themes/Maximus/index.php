<?php
/**
 * The main template file.
 *
 * @package WordPress
 */
	get_header();

	if (is_404() && get_option('page_404') == 'default') {
		get_template_part('part', 'def_404');
		return;
	}
	rewind_posts();
	if ( have_posts() ): the_post();

	global $_theme_layout;

	switch ($_theme_layout) {
		case '1':
			$_content_class = ' class="sbr"';
		break;
		case '2':
			$_content_class = ' class="sbl"';
		break;
		default:
			$_content_class = '';
		break;
	}
?>
	<!-- Begin Content -->
	<div id="content"<?php echo $_content_class; ?>>
<?php if ($_theme_layout == 2): ?>
		<?php get_sidebar('side'); ?>
<?php endif; ?>
		<?php if ($_theme_layout != 3): ?>
		<div class="content">
		<?php endif; ?>
		<?php get_template_part('loop'); ?>
		<?php if ($_theme_layout != 3): ?>
		</div>
		<?php endif; ?>
<?php if ($_theme_layout == 1): ?>
		<?php get_sidebar('side'); ?>
<?php endif; ?>
		<div class="clear"></div>
	</div>
	<!-- End Content -->
<?php else: ?>
	<!-- Begin Content -->
	<div id="content">
		<div class="content">
<?php get_template_part('part', 'no_result'); ?>
		</div>
	</div>
	<!-- End Content -->
<?php
	endif;
	get_footer();
 ?>
