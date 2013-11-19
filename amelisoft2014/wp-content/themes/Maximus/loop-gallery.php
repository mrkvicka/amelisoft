<?php
/**
 * @package WordPress
 */
?>

		<?php if (get_option('gallery_switcher')): ?>
		<div class="switcher">
			<a href="#" class="switch_thumb"><?php _e('Switch Thumb', TEMPLATENAME); ?></a>
		</div>
		<?php endif; ?>
		<ul class="display <?php if (!get_option('gallery_switcher')) echo get_option('gallery_type'); ?>">
<?php //set_query_var('posts_per_page', 12); rewind_posts();  var_dump(get_query_var('posts_per_page')); ?>
<?php while ( have_posts() ) : the_post(); ?>
			<li>
<?php
	$video_link = get_post_meta(get_the_ID(), 'video_link', true);
	$image_id = get_post_thumbnail_id();
	$full_thumbnail = wp_get_attachment_image_src($image_id, 'full');
?>
				<div class="gall_det">
					<a href="<?php if (!empty($video_link)) echo $video_link; else echo $full_thumbnail[0]; ?>" rel="prettyPhoto[gallery2]" class="gall">
						<?php the_post_thumbnail('medium', array('class' => 'a', 'title' => false)); ?>
						<img src="<?php echo get_bloginfo('template_url').'/images/fade_thumb.png'; ?>" width="279" height="138" alt="" class="b" />
					</a>
					<h3><?php the_title(); ?></h3>
					<?php the_excerpt(); ?>
					<a href="<?php the_permalink(); ?>" title="<?php _e('Read More', TEMPLATENAME); ?>" class="more_link"><?php _e('Read More', TEMPLATENAME); ?> &raquo;</a>
				</div>
			</li>
<?php endwhile; // End the loop. Whew. ?>
		</ul>
		<div class="clear"></div>
<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ($wp_query->max_num_pages > 1 && function_exists('wp_pagenavi')) : ?>
	<?php echo wp_pagenavi(); ?>
<?php endif; ?>
