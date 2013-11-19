<?php $option = get_option($this->name); ?>
<?php if ($option): ?>
	<?php echo wp_get_attachment_image($option['attachment_id'], array(300, 91), false); ?><br />
<?php endif; ?>
<input type="file" name="<?php echo $this->name; ?>" id="<?php echo $args['id']; ?>" class="<?php echo $args['class']; ?>" size="<?php echo $args['size']; ?>" />
<?php if (!empty($args['desc'])) : ?>
	<span class="description"><?php echo $args['desc']; ?></span>
<?php endif; ?>

