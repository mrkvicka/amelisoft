<?php
/**
 * @package WordPress
 */
global $_theme_side_sidebar;
?>

<?php
	/* The footer widget area is triggered if any of the areas
	 * have widgets. So let's check that first.
	 *
	 * If none of the sidebars have widgets, then let's bail early.
	 */
	global $_theme_side_sidebar;
	if (!isset($_theme_side_sidebar) || !is_active_sidebar($_theme_side_sidebar))
		return;
	// If we get this far, we have widgets. Let do this.
?>

		<!-- Sidebar -->
		<div id="sidebar">
			<?php if ($_theme_side_sidebar == 'disable' || !dynamic_sidebar($_theme_side_sidebar)): ?>
				<div class="widget-container widget_search">
					<h3><?php _e('Search', TEMPLATENAME); ?></h3>
					<?php get_search_form(); ?>
				</div>

				<div class="widget-container widget_archive">
				<h3><?php _e( 'Archives', TEMPLATENAME ); ?></h3>
					<ul>
					<?php wp_get_archives( 'type=monthly' ); ?>
					</ul>
				</div>

				<div class="widget-container widget_meta">
				<h3><?php _e( 'Meta', TEMPLATENAME ); ?></h3>
					<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
					</ul>
				</div>
			<?php endif; ?>
		</div>
		<!-- End Sidebar -->