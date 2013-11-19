<?php $_current_value = get_option($this->name, $args['default']); ?>
<?php foreach($args['options'] as $value => $label): ?>
<label>
	<input type="radio" <?php if ($_current_value == $value): ?>checked="checked" <?php endif; ?>value="<?php $value; ?>" name="<?php echo $this->name; ?>"> <?php echo $label; ?></label><br />
<?php endforeach; ?>
<?php if (!empty($args['desc'])): ?>
<p><?php echo $args['desc']; ?></p>
<?php endif; ?>