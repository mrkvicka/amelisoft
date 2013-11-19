<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 */
?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php
rewind_posts(); if ( ! have_posts() ) : ?>
	<?php get_template_part('part', 'no_results'); ?>
<?php endif; ?>

<?php
	if (is_page()) :
		the_post();
		the_content();
	elseif (is_single()):
		get_template_part('loop', 'single');
	else:
?>
	<?php while ( have_posts() ) : the_post(); ?>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<div class="posted"><?php _e('Posted by', TEMPLATENAME) ?> <span class="author"><?php printf('<a href="%1$s" title="%2$s">%3$s</a>', get_author_posts_url(get_the_author_meta('ID')), sprintf(esc_attr__('View all posts by %s', TEMPLATENAME), get_the_author()), get_the_author()); ?></span> <?php _e('in', TEMPLATENAME); ?> <?php if (count(get_the_category())): ?><?php echo get_the_category_list(', '); ?><?php endif; ?> <?php _e('on', TEMPLATENAME) ?> <?php printf( '<a href="%1$s" title="%2$s">%3$s</a>', get_permalink(), esc_attr(get_the_time()), get_the_date()); ?>  |   <a href="<?php echo get_comments_link() ?>" title="<?php comments_number(); ?>"><?php comments_number(); ?> &raquo;</a></div>
			<p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('post', array('class' => 'pic', 'title' => false)); ?></a></p>
			<?php the_excerpt(); ?>
			<a href="<?php the_permalink(); ?>" title="<?php _e('Continue Reading', TEMPLATENAME) ?>"><?php _e('Continue Reading &raquo;', TEMPLATENAME) ?></a>
			<div class="line"></div>
	<?php endwhile; // End the loop. Whew. ?>
			<?php /* Display navigation to next/previous pages when applicable */ ?>
			<?php if ($wp_query->max_num_pages > 1 && function_exists('wp_pagenavi')) : ?>
				<?php echo wp_pagenavi(); ?>
			<?php endif; ?>
<?php endif; ?>
