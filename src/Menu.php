<?php

namespace WordPressBoilerplatePlugin;

class Menu
{
	public static $instance = null;

	private $menuSlug = FDWPBP_MENUS_SLUG . '_settings';

	public static function getInstance()
	{
		self::$instance === null && self::$instance = new self;
		return self::$instance;
	}

	public function __construct()
	{
		$this->instantiateMenus();

		add_action('admin_menu', [$this, 'createAdminMenu']);

		// Uncomment these if you have custom acf-json files
		// add_filter('acf/settings/save_json', [$this, 'registerEditAcfJsonPath']);
		// add_filter('acf/settings/load_json', [$this, 'registerEditAcfJsonPath']);

		add_filter('plugin_action_links_' . FDWPBP_BASENAME, [$this, 'actionLinks']);
	}

	/**
	 * Calls the `getInstance()` method on all PHP files in the `src/Menus/` directory that their name ends with "Menu".
	 *
	 * @return	void
	 */
	private function instantiateMenus()
	{
		foreach (glob(FDWPBP_DIR . '/src/Menus/*Menu.php') as $file)
		{
			$class = '\\' . __NAMESPACE__ . '\\Menus\\' . basename($file, '.php');

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
		foreach (apply_filters('fdwpbp_menus_submenus', []) as $slug => $submenu)
		{
			if (empty($submenu)) continue;

			add_submenu_page(
				!empty($submenu['parent_slug']) ? sanitize_key($submenu['parent_slug']) : $this->menuSlug,
				esc_html($submenu['page_title']),
				esc_html($submenu['menu_title']),
				!empty($submenu['capability']) ? sanitize_key($submenu['capability']) : 'manage_options',
				FDWPBP_MENUS_SLUG . '_' . sanitize_key($slug),
				$submenu['callback'],
				!empty($submenu['position']) ? intval($submenu['position']) : $position
			);

			$position++;
		}
	}

	/**
	 * Registers new path to save/load ACF JSON files.
	 *
	 * @param	string|array	$paths	The default paths where ACF saves JSON files.
	 *
	 * @return	array					Edited path array.
	 * @source 	https://ImranhSayed.Medium.com/saving-the-acf-json-to-your-plugin-or-theme-file-f3b72b99257b
	 *
	 * @hooked	filter: `acf/settings/save_json` - 10
	 * @hooked	filter: `acf/settings/load_json` - 10
	 */
	public function registerEditAcfJsonPath($paths)
	{
		// Remove original path
		// unset($paths[0]);

		$newPath = FDWPBP()->dir('acf-json');
		if (!is_writable($newPath))
			return $paths;

		if (!file_exists($newPath))
			mkdir($newPath, 0777, true);

		// `$paths` is a string while saving.
		if (!is_array($paths))
			return $newPath;

		$paths[] = $newPath;
		return $paths;
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
