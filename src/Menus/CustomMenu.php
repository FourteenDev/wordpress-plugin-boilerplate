<?php

namespace WordPressBoilerplatePlugin\Menus;

class CustomMenu extends Base
{
	public static $instance = null;

	protected $menuSlug = FDWPBP_MENUS_SLUG . '_custom';

	public static function getInstance()
	{
		self::$instance === null && self::$instance = new self;
		return self::$instance;
	}

	/**
	 * Adds the submenu.
	 *
	 * @param	array	$submenus
	 *
	 * @return	array
	 *
	 * @hooked	filter: `fdwpbp_menus_submenus` - 10
	 */
	public function addSubmenu($submenus)
	{
		$submenus['custom'] = [
			'page_title' => esc_html__('Custom Menu', 'wordpress-boilerplate-plugin'),
			'menu_title' => esc_html__('Custom Menu', 'wordpress-boilerplate-plugin'),
			'callback'   => [$this, 'displayContent'],
			'position'   => 2,
		];

		return $submenus;
	}

	/**
	 * Outputs the content for this submenu.
	 *
	 * @return	void
	 */
	public function displayContent()
	{
		FDWPBP()->view('admin.menus.custom-menu', ['test' => 'Test']);
	}
}
