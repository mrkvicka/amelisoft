<?php settings_errors(); ?>
<div class="wrap" id="theme_options">
	<?php screen_icon($this->page_icon); ?>
	<h2><?php echo (isset($this->page_title)) ? $this->page_title : get_admin_page_title(); ?></h2>
	<form action="options.php" <?php if ($this->use_upload): ?>enctype="multipart/form-data"<?php endif; ?> method="post">
		<?php settings_fields($this->slug.'_group'); ?>
		<?php do_settings_sections($this->slug); ?>
		<p class="submit">
			<input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
		</p>
	</form>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		var items = [];
		var form = $('#theme_options form');
		$('<div/>').html(form.html()).attr('id', 'tabs').appendTo(form.html(''));
		$('#tabs').find('h3').each(function(index) {
			items[items.length] = '<li><a href="#tab-'+index+'">'+$(this).html()+'</a></li>';
			$(this).addClass('hidden').next('table')
			.attr('id', 'tab-'+index);
		});
		$('#tabs').prepend('<ul>' + items.join('') + '</ul>');
		$("#tabs").tabs({
				cookie: {expires: 1}
		});
		$('.form-table').find('tr:first').find('th, td').css('border-top', 'none');
	});
</script>
