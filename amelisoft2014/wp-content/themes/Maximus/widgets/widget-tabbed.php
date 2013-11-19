<?php
/*
 * Widget class.
 */
class TabbedWidget extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */

	function TabbedWidget() {

		/* Widget settings */
		$widget_ops = array( 'classname' => 'widget_tabbed', 'description' => __('A tabbed widget that display popular posts, recent posts, comments and tags.', 'framework') );

		/* Widget control settings */
//		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'widget_tabbed' );

		/* Create the widget */
		$this->WP_Widget( 'widget_tabbed', __('Custom Tabbed Widget +', 'framework'), $widget_ops, $control_ops );
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */

	function recent_excerpt_length() {
		return 7;
	}

	function widget( $args, $instance ) {
		global $wpdb;
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$tab1 = $instance['tab1'];
		$tab2 = $instance['tab2'];
		$tab3 = $instance['tab3'];


		/* Before widget (defined by themes). */
		echo $before_widget;

		//Randomize tab order in a new array
		$tab = array();

		/* Display a containing div */
		echo '<div class="tabs_container">';
			echo '<ul class="tabs">';
				echo '<li><a href="#"><span>'.$tab1.'</span></a></li>';
				echo '<li><a href="#"><span>'.$tab2.'</span></a></li>';
				echo '<li><a href="#"><span>'.$tab3.'</span></a></li>';
			echo '</ul>';

			echo '<div class="panes">';

			// Popular posts tab
			echo '<div class="pane">';
				echo '<ul>';

					$popPosts = new WP_Query();
					$popPosts->query('showposts=4&orderby=comment_count');
					while ($popPosts->have_posts()) : $popPosts->the_post(); ?>

						<li>
							<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
							<a href="<?php the_permalink();?>"><?php the_post_thumbnail('thumbnail', array('title' => false, 'class' => 'pic alignleft')); ?></a>
							<?php } ?>
							<b><a href="<?php the_permalink(); ?>"><?php the_title();?></a></b>
							<span class="date"><?php the_time( get_option('date_format') ); ?></span>
							<span class="comment-count"><?php comments_popup_link(__('No comments', 'framework'), __('1 Comment', 'framework'), __('% Comments', 'framework')); ?></span>
						</li>

					<?php endwhile;
					wp_reset_query();


				echo '</ul>';
			echo '</div><!-- #tabs-1 -->';

			//Recent posts tabs
			echo '<div class="pane">';
				echo '<ul>';

						$recentPosts = new WP_Query();
						$recentPosts->query('showposts=4');
						add_filter('excerpt_length', array(&$this, 'recent_excerpt_length'));
						while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
							<li>
								<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
								<a href="<?php the_permalink();?>"><?php the_post_thumbnail('thumbnail', array('title' => false, 'class' => 'pic alignleft')); ?></a>
								<?php } ?>
								<b><a href="<?php the_permalink(); ?>"><?php the_title();?></a></b>
								<div class="short"><?php the_excerpt(); ?></div>
								<span class="date"><?php the_time( get_option('date_format') ); ?></span>
							</li>
						<?php endwhile;
						remove_filter('excerpt_length', array(&$this, 'recent_excerpt_length'));

				echo '</ul>';
			echo '</div><!-- #tabs-2 -->';

			//Recent comments tabs
			echo '<div class="pane">';

				$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved, comment_type, comment_author_url, SUBSTRING(comment_content,1,70) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT 4";
				$comments = $wpdb->get_results($sql);
				echo '<ul>';
					foreach ($comments as $comment) { ?>

					<li>

						 <a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="<?php echo strip_tags($comment->comment_author); ?> <?php _e('on ', 'framework'); ?><?php echo $comment->post_title; ?>"><?php echo get_avatar( $comment, '55' ); ?></a>

						<div class="short"><a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="<?php echo strip_tags($comment->comment_author); ?> <?php _e('on ', 'framework'); ?><?php echo $comment->post_title; ?>"><strong><?php echo strip_tags($comment->comment_author); ?>:</strong> <?php echo strip_tags($comment->com_excerpt); ?>...</a></div>

					</li>
					<?php }

				echo '</ul>';
			echo '</div><!-- #tabs-3 -->';


		echo '</div><!-- .tabs-inner -->';

		echo '</div><!-- #tabs -->';

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/* ---------------------------- */
	/* ------- Update Widget -------- */
	/* ---------------------------- */

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* No need to strip tags */
		$instance['tab1'] = $new_instance['tab1'];
		$instance['tab2'] = $new_instance['tab2'];
		$instance['tab3'] = $new_instance['tab3'];

		return $instance;
	}

	/* ---------------------------- */
	/* ------- Widget Settings ------- */
	/* ---------------------------- */

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */

	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
		'tab1' => 'Popular',
		'tab2' => 'Recent',
		'tab3' => 'Comments',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<!-- tab 1 title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'tab1' ); ?>"><?php _e('Tab 1 Title:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'tab1' ); ?>" name="<?php echo $this->get_field_name( 'tab1' ); ?>" value="<?php echo $instance['tab1']; ?>" />
		</p>
		
		<!-- tab 2 title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'link1' ); ?>"><?php _e('Tab 2 Title:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'tab2' ); ?>" name="<?php echo $this->get_field_name( 'tab2' ); ?>" value="<?php echo $instance['tab2']; ?>" />
		</p>
		
		<!-- tab 3 title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'tab2' ); ?>"><?php _e('Tab 3 Title:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'tab3' ); ?>" name="<?php echo $this->get_field_name( 'tab3' ); ?>" value="<?php echo $instance['tab3']; ?>" />
		</p>
		
	<?php
	}
}

/*
 * Register widget.
 */
function TabbedWidgetInit() {
	register_widget('TabbedWidget');
}
add_action('widgets_init', 'TabbedWidgetInit');

?>