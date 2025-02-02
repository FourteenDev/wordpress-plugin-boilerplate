<?php

namespace WordPressBoilerplatePlugin\Menus;

class SecondMenu extends Base
{
	public static $instance = null;

	protected $menuSlug = FDWPBP_MENUS_SLUG . '_second';

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
		$submenus['second'] = [
			'page_title' => esc_html__('More Boilerplate Settings', 'wordpress-boilerplate-plugin'),
			'menu_title' => esc_html__('Second Menu', 'wordpress-boilerplate-plugin'),
			'callback'   => [$this, 'displayContent'],
			'position'   => 1,
		];

		return $submenus;
	}

	/**
	 * Returns tabs for this submenu.
	 *
	 * @return	array
	 */
	public function getTabs()
	{
		return [
			'general' => esc_html__('General', 'wordpress-boilerplate-plugin'),
			'second'  => esc_html__('Second', 'wordpress-boilerplate-plugin'),
		];
	}

	/**
	 * Returns fields for this submenu.
	 *
	 * @return	array
	 */
	public function getFields()
	{
		return [
			'example_field_second' => [
				'id'      => 'example_field_second',
				'label'   => esc_html__('Example Field', 'wordpress-boilerplate-plugin'),
				'section' => 'general',
				'type'    => 'text',
				'default' => '',
				'args'    => [],
			],
			'test_field_second'    => [
				'id'      => 'test_field_second',
				'label'   => esc_html__('Second Tab Field', 'wordpress-boilerplate-plugin'),
				'section' => 'second',
				'type'    => 'text',
				'default' => '',
				'args'    => [],
			],
		];
	}
}
