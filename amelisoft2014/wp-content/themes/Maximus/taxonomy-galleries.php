<?php
/**
 * The main template file.
 *
 * @package WordPress
 */
	get_header();

	if (is_404()) {
		$_page404 = get_option('page_404');
		if (!empty($_page404) && $_page404 != 'default') {
			query_posts(array('page_id' => $_page404));
		} else {
			get_template_part('part', 'def_404');
			return;
		}
	}
	rewind_posts();
	if ( have_posts() ): the_post();

?>
	<!-- Begin Content -->
	<div id="content">
		<?php rewind_posts(); get_template_part('loop', 'gallery'); ?>
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