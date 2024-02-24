<div class="wrap btbp-wrap">
	<h1><?php esc_html_e('Settings', FDWPBP_TEXT_DOMAIN); ?></h1>

	<form method="post" action="options.php">
		<?php
		settings_fields(FDWPBP_SETTINGS_SLUG . '_settings_group');

		do_settings_sections(FDWPBP_SETTINGS_SLUG . '_settings');

		submit_button();
		?>
	</form>
</div>