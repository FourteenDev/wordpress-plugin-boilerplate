<div class="wrap fdwpbp-wrap">
	<div class="fdwpbp-wrap__main">
		<h1><?php echo esc_html($title); ?></h1>

		<div class="fdwpbp-tab-group">
			<ul class="fdwpbp-tab">
				<?php
				foreach ($tabs as $tabSlug => $tabLabel)
				{
					$tabSlug = sanitize_key($tabSlug);
					$tabUrl  = add_query_arg([
						'settings-updated' => false,
						'tab'              => $tabSlug,
					]);

					echo '<li class="tab-' . $tabSlug . '"><a href="' . esc_url($tabUrl) . '" title="' . esc_attr($tabLabel) . '" class="' . ($activeTab == $tabSlug ? 'active' : '') . '">';
						echo $tabLabel;
					echo '</a></li>';
				} ?>
			</ul>
			<div class="fdwpbp-tab-content <?php echo sanitize_key($activeTab); ?>-settings-tab">
				<form method="post" action="options.php">
					<table class="form-table">
						<?php
						settings_fields("{$menuSlug}_group");
						do_settings_fields($menuSlug, "{$menuSlug}_$activeTab"); ?>
					</table>

					<?php submit_button(); ?>
				</form>
			</div>
		</div>
	</div>
</div>