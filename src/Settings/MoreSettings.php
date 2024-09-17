<?php

namespace WordPressBoilerplatePlugin\Settings;

class MoreSettings extends Base
{
	public static $instance = null;

	protected $menuSlug = FDWPBP_SETTINGS_SLUG . '_more';

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
	 * @hooked	filter: `fdwpbp_settings_submenus` - 10
	 */
	public function addSubmenu($submenus)
	{
		$submenus['more'] = [
			'page_title' => esc_html__('More Boilerplate Settings', 'wordpress-boilerplate-plugin'),
			'menu_title' => esc_html__('More Settings', 'wordpress-boilerplate-plugin'),
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
			'general' => esc_html__('More General', 'wordpress-boilerplate-plugin'),
			'second'  => esc_html__('More Second', 'wordpress-boilerplate-plugin'),
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
			'example_field_more' => [
				'id'      => 'example_field_more',
				'label'   => esc_html__('More Example Field', 'wordpress-boilerplate-plugin'),
				'section' => 'general',
				'type'    => 'text',
				'default' => '',
				'args'    => [],
			],
			'test_field_more'    => [
				'id'      => 'test_field_more',
				'label'   => esc_html__('More Second Tab Field', 'wordpress-boilerplate-plugin'),
				'section' => 'second',
				'type'    => 'text',
				'default' => '',
				'args'    => [],
			],
		];
	}
}
