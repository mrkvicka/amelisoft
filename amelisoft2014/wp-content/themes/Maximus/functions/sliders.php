<?php
// theme sliders
global $_theme_sliders;
$_theme_sliders = array(
	'none' => __('None', TEMPLATENAME),
	's3slider' => __('s3', TEMPLATENAME),
	'slideshow' => __('slideshow', TEMPLATENAME),
	'nivo1' => __('nivo1', TEMPLATENAME),
	'nivo2' => __('nivo2', TEMPLATENAME),
	'nivo3' => __('nivo3', TEMPLATENAME),
	'nivo4' => __('nivo4', TEMPLATENAME),
);

function get_option_str($option) {
	$option = get_option($option);
	return ($option) ? 'true' :'false';
}

function slider_enqueue() {
	global $_theme_sliders;
	global $_slider_type;
	if (is_page() || is_front_page()) {
		switch ($_slider_type) {
			case 's3slider':
				wp_enqueue_style('css_s3slider');
				wp_enqueue_script('js_s3slider');
			break;
			case 'slideshow':
				wp_enqueue_style('css_slider');
				wp_enqueue_script('js_slideshow');
			break;
			case 'nivo1':
			case 'nivo2':
			case 'nivo3':
			case 'nivo4':
				wp_enqueue_style('css_slider_nivo');
				wp_enqueue_script('js_slider_nivo');
			break;
		}
	}
}

function slider_init() {
if (is_page() || is_front_page()):
	global $_slider_type;

echo '<script type="text/javascript">';
switch($_slider_type):
	case 's3slider':
?>
		jQuery(document).ready(function($) {
			$('#s3slider').s3Slider({
				timeOut: <?php echo get_option('s3_slider_time_out'); ?>
			});
		});
<?php
		break;
	case 'nivo1':
	case 'nivo2':
	case 'nivo3':
	case 'nivo4':
 ?>
		jQuery(window).load(function() {
			jQuery('#slider').nivoSlider({
				effect:          '<?php echo get_option('nivo_slider_effect'); ?>', //Specify sets like: 'fold,fade,sliceDown'
				slices:          <?php echo get_option('nivo_slider_slices'); ?>,
				animSpeed:       <?php echo get_option('nivo_slider_speed'); ?>,
				pauseTime:       <?php echo get_option('nivo_slider_pause'); ?>,
				directionNav:    <?php echo get_option_str('nivo_slider_direction_nav'); ?>, //Next and Prev
				directionNavHide:<?php echo get_option_str('nivo_slider_direction_nav_hide'); ?>,
				controlNav:      <?php echo get_option_str('nivo_slider_control_nav'); ?>, //1,2,3...
				pauseOnHover:    <?php echo get_option_str('nivo_slider_pause_on_hover'); ?>
			});
			jQuery('div.nivo-controlNav').css('margin-left', function(index, val){
				return -jQuery(this).find('a').length*26/2+5;
			});
		});
<?php
		break;
endswitch;
echo '</script>';
endif;
}

function theme_slider_render() {
	global $_slider_type;
	if (is_page() || is_front_page()):
		$post_cat = get_option('slider_post_cat');
		$post_order = get_option('slider_post_order');
		$sort_order = get_option('slider_sort_order');
		$tag = get_option('slider_tag');
		$args = array(
			'numberposts' => get_option('slider_count_items'),
			'posts_per_page' => get_option('slider_count_items'),
			'meta_key' => '_thumbnail_id',
		);
		if (!empty($post_cat))
			$args['cat'] = $post_cat;
		if ($post_order == 'by_tag'):
			$args['tag'] = $tag;
		else:
			$args['orderby'] = $post_order;
			$args['order'] = $sort_order;
		endif;
		$loop = new WP_Query($args);
		if ($loop->have_posts()):
?>
	<!-- Start Slider -->
	<div class="header">
	<?php
	switch($_slider_type):
		case 's3slider':
	?>
	<div id="s3slider">
		<ul id="s3sliderContent">
			<?php $title = get_option('s3_slider_title'); ?>
			<?php $i = 0; while ($loop->have_posts()) : $loop->the_post(); ?>
			<?php
				if ($title == 'left-right') {
					($i % 2 == 0) ? $class = 'right' : $class = 'left';
				} else
					$class = $title;
				$i++;
			?>
			<li class="s3sliderImage">
				<?php the_post_thumbnail('home', array('title' => false)); ?>
				<span class="<?php echo 's3slider'.$class; ?>">
					<b class="title"><?php the_title(); ?></b>
					<b class="paragraph"><?php echo get_the_excerpt(); ?></b>
					<label class="row"><a href="<?php the_permalink(); ?>" title="<?php _e('read more', TEMPLATENAME) ?>" class="more"><?php _e('read more', TEMPLATENAME) ?></a></label>
				</span>
			</li>
			<?php endwhile; ?>
			<li class="clear s3sliderImage"></li>
		</ul>
	</div>
	<?php
			break;
		case 'slideshow':
	 ?>
	<div id="tmpSlideshow">
		<?php $i=0; while ($loop->have_posts()) : $loop->the_post(); $i++; ?>
		<div id="tmpSlide-<?php echo $i; ?>" class="tmpSlide">
			<?php the_post_thumbnail('home2', array('title' => (get_option('slider_excerpt')) ? esc_attr(get_the_excerpt()) : '')); ?>
			<div class="tmpSlideCopy">
				<h2><?php the_title(); ?></h2>
				<?php the_excerpt(); ?>
				<span class="row"><a href="<?php the_permalink(); ?>" class="more"><?php _e('read more', TEMPLATENAME) ?></a></span>
			</div>
		</div>
		<?php endwhile; ?>
		<div id="tmpSlideshowControls">
			<?php for($y=1;$y<=$i;$y++): ?>
				<div class="tmpSlideshowControl" id="tmpSlideshowControl-<?php echo $y; ?>"><?php echo $y; ?></div>
			<?php endfor; ?>
		</div>
	</div>
	<?php
			break;
		case 'nivo1':
		case 'nivo2':
		case 'nivo3':
		case 'nivo4':
		$_thumb_names = array('nivo1' => 'home3', 'nivo2' => 'large', 'nivo3' => 'home5', 'nivo4' => 'home');
		$_thumb_name = $_thumb_names[$_slider_type];
	 ?>
	<?php if ($_slider_type == 'nivo4') echo '<div class="sliderwrap">'; ?>
	<div id="slider">
		<?php while ($loop->have_posts()) : $loop->the_post(); ?>
		<?php the_post_thumbnail($_thumb_name, array('title' => (get_option('slider_excerpt')) ? esc_attr(get_the_excerpt()) : '')); ?>
		<?php endwhile; ?>
	</div>
	<?php if ($_slider_type == 'nivo4') echo '</div>'; ?>
	<?php
			break;
	endswitch;
	 ?>
	 </div>
	<!-- End Slider -->
	<?php
endif;
endif;
}
?>
