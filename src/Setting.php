<?php

namespace WordPressBoilerplatePlugin;

class Setting
{
	public static $instance = null;

	private $menuSlug = FDWPBP_SETTINGS_SLUG . '_settings';

	public static function getInstance()
	{
		self::$instance === null && self::$instance = new self;
		return self::$instance;
	}

	public function __construct()
	{
		$this->instantiateSettings();

		add_action('admin_menu', [$this, 'createAdminMenu']);

		add_filter('plugin_action_links_' . FDWPBP_BASENAME, [$this, 'actionLinks']);
	}

	/**
	 * Calls the `getInstance()` method on settings file in the `src/Settings/` directory.
	 *
	 * @return	void
	 */
	private function instantiateSettings()
	{
		foreach (glob(FDWPBP_DIR . '/src/Settings/*Settings.php') as $file)
		{
			$class = '\\' . __NAMESPACE__ . '\\Settings\\' . basename($file, '.php');

			if (class_exists($class)) $class::getInstance();
		}
	}

	/**
	 * Creates a menu in admin dashboard.
	 *
	 * @return	void
	 *
	 * @hooked	action: `admin_menu` - 10
	 */
	public function createAdminMenu()
	{
		add_menu_page(
			esc_html__('WordPress Boilerplate Plugin', 'wordpress-boilerplate-plugin'),
			esc_html__('Boilerplate Plugin', 'wordpress-boilerplate-plugin'),
			'manage_options',
			$this->menuSlug,
			'',
			'dashicons-wordpress'
		);

		$position = 0;
		foreach (apply_filters('fdwpbp_settings_submenus', []) as $slug => $submenu)
		{
			if (empty($submenu)) continue;

			add_submenu_page(
				!empty($submenu['parent_slug']) ? sanitize_key($submenu['parent_slug']) : $this->menuSlug,
				esc_html($submenu['page_title']),
				esc_html($submenu['menu_title']),
				!empty($submenu['capability']) ? sanitize_key($submenu['capability']) : 'manage_options',
				FDWPBP_SETTINGS_SLUG . '_' . sanitize_key($slug),
				$submenu['callback'],
				!empty($submenu['position']) ? intval($submenu['position']) : $position
			);

			$position++;
		}
	}

	/**
	 * Adds plugin action links to the plugins page.
	 *
	 * @param	array	$links
	 *
	 * @return	array
	 *
	 * @hooked	filter: `plugin_action_links_{FDWPBP_BASENAME}` - 10
	 */
	public function actionLinks($links)
	{
		$links[] = '<a href="' . get_admin_url(null, "admin.php?page={$this->menuSlug}") . '">' . esc_html__('Settings', 'wordpress-boilerplate-plugin') . '</a>';
		return $links;
	}
}
