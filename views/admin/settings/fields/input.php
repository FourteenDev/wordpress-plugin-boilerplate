<input type="<?php echo esc_attr($type); ?>" id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>" value="<?php echo $type === 'number' ? intval($value) : esc_attr($value); ?>" />
<?php if (!empty($description)) : ?>
	<p><?php echo $description; ?></p>
<?php endif; ?>