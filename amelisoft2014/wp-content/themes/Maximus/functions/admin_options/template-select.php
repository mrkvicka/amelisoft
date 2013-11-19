<?php $_current_value = get_option($this->name, $args['default']); ?>
<select id="<?php echo $args['id']; ?>" class="<?php echo $args['class']; ?>" name="<?php echo $this->name; ?>">
	<?php
		$options = $args['options'];
		if (empty($options) && isset($args['options_func']) && !empty($args['options_func'])) {
			$options = call_user_func($args['options_func']);
		}
	?>
	<?php foreach($options as $value => $label): ?>
	<option <?php if ($_current_value == $value): ?>selected="selected" <?php endif; ?>value="<?php echo $value; ?>"><?php echo $label; ?></option>
	<?php endforeach; ?>
</select>
<?php if (!empty($args['desc'])) : ?>
	<span class="description"><?php echo $args['desc']; ?></span>
<?php endif; ?>

