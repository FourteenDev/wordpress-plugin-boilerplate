<?php

namespace WordPressBoilerplatePlugin\Menus;

class CustomMenu extends Base
{
	protected string $menuSlug = FDWPBP_MENUS_SLUG . '_custom';

	/**
	 * Adds the submenu.
	 *
	 * @param	array	$submenus
	 *
	 * @return	array
	 *
	 * @hooked	filter: `fdwpbp_menus_submenus` - 10
	 */
	public function addSubmenu(array $submenus): array
	{
		$submenus['custom'] = [
			'page_title' => esc_html__('Custom Menu', 'wordpress-boilerplate-plugin'),
			'menu_title' => esc_html__('Custom Menu', 'wordpress-boilerplate-plugin'),
			'callback'   => [$this, 'displayContent'],
			'position'   => 3,
		];

		return $submenus;
	}

	/**
	 * Outputs the content for this submenu.
	 *
	 * @return	void
	 */
	public function displayContent(): void
	{
		FDWPBP()->view('admin.menus.custom-menu', ['test' => 'Test']);
	}
}
