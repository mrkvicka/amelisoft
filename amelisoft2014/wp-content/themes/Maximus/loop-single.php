<?php rewind_posts(); the_post(); ?>
<div class="post">
	<div class="posted"><?php _e('Posted by', TEMPLATENAME) ?> <span class="author"><?php printf('<a href="%1$s" title="%2$s">%3$s</a>', get_author_posts_url(get_the_author_meta('ID')), sprintf(esc_attr__('View all posts by %s', TEMPLATENAME), get_the_author()), get_the_author()); ?></span> <?php _e('in', TEMPLATENAME); ?> <?php if (count(get_the_category())): ?><?php echo get_the_category_list(', '); ?><?php endif; ?> <?php _e('on', TEMPLATENAME) ?> <?php printf( '<a href="%1$s" title="%2$s">%3$s</a>', get_permalink(), esc_attr(get_the_time()), get_the_date()); ?>  |   <a href="<?php echo get_comments_link() ?>" title="<?php comments_number(); ?>"><?php comments_number(); ?> &raquo;</a></div>
	<?php
		$video_link = get_post_meta(get_the_ID(), 'video_link', true);
		$image_id = get_post_thumbnail_id();
		$full_thumbnail = wp_get_attachment_image_src($image_id, 'full');
	?>
	<p>
	<a href="<?php if (!empty($video_link)) echo $video_link; else echo $full_thumbnail[0]; ?>" rel="prettyPhoto">
		<?php the_post_thumbnail('post', array('class' => 'pic', 'title' => false)); ?>
	</a>
	</p>
	<?php the_content(); ?>
</div>
<?php comments_template(); ?>
