<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 */
if (is_singular()):
	global $_feature_box_content;
//	if ($_feature_box_content = get_post_meta(get_the_ID(), 'featured_box', true)):
	if (!empty($_feature_box_content)):
?>
	<!-- Begin Footer Sidebar  -->
	<div id="footer_sidebar">
		<div class="footer_sidebar_cont">
			<?php echo do_shortcode($_feature_box_content); ?>
			<div class="clear">
		</div>
	</div>
	<!-- End Footer Sidebar  -->
<?php
	endif;
endif;
?>
	<!-- Begin Footer  -->
	<?php get_sidebar('bottom'); ?>
	<div id="footer_lower">
		<div id="footer_info">
			<div id="copyright"><?php echo get_option('copyright'); ?></div>
			<div id="attr">
				<ul>
					<li><b><?php _e('Stay Connected', TEMPLATENAME) ?></b></li>
					<li><a href="<?php echo get_option('rss_link', '#'); ?>" class="ico_rss" title="<?php _e('RSS Feed', TEMPLATENAME) ?>"><span class="hover"></span></a></li>
					<li><a href="<?php echo get_option('delicious_link', '#'); ?>" class="ico_delicious" title="<?php _e('Delicious', TEMPLATENAME) ?>"><span class="hover"></span></a></li>
					<li><a href="<?php echo get_option('fliсkr_link', '#'); ?>" class="ico_fliсkr" title="<?php _e('Flickr', TEMPLATENAME) ?>"><span class="hover"></span></a></li>
					<li><a href="<?php echo get_option('twitter_link', '#'); ?>" class="ico_twitter" title="<?php _e('Twitter', TEMPLATENAME) ?>"><span class="hover"></span></a></li>
					<li><a href="<?php echo get_option('facebook_link', '#'); ?>" class="ico_facebook" title="<?php _e('Facebook', TEMPLATENAME) ?>"><span class="hover"></span></a></li>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<!-- End Footer  -->
</div>
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();

global $wp_scripts;
if (in_array('js_pretty', $wp_scripts->queue)):
?>

<!-- PrettyPhoto Lightbox Plugin Init -->
<script type="text/javascript">
	jQuery(document).ready(function($){
		$("a[rel^='prettyPhoto']").prettyPhoto({
			animationSpeed: 'normal', /* fast/slow/normal */
			opacity: 0.50, /* Value between 0 and 1 */
			showTitle: false, /* true/false */
			allowresize: true, /* true/false */
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: 'light_rounded', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
		});
	});
</script>
<?php endif; ?>
</body>
</html>