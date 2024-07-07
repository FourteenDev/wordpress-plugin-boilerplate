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
			'page_title' => esc_html__('More Boilerplate Settings', FDWPBP_TEXT_DOMAIN),
			'menu_title' => esc_html__('More Settings', FDWPBP_TEXT_DOMAIN),
			'callback'   => [$this, 'displayContent'],
			'position'   => 1,
		];

		return $submenus;
	}

	/**
	 * Returns tabs for this page.
	 *
	 * @return	array
	 */
	public function getTabs()
	{
		return [
			'general' => esc_html__('More General', FDWPBP_TEXT_DOMAIN),
			'second'  => esc_html__('More Second', FDWPBP_TEXT_DOMAIN),
		];
	}

	/**
	 * Returns tabs for this page.
	 *
	 * @return	array
	 */
	public function getFields()
	{
		return [
			'example_field_more' => [
				'id'      => 'example_field_more',
				'label'   => esc_html__('More Example Field', FDWPBP_TEXT_DOMAIN),
				'section' => 'general',
				'type'    => 'text',
				'default' => '',
				'args'    => [],
			],
			'test_field_more'    => [
				'id'      => 'test_field_more',
				'label'   => esc_html__('More Second Tab Field', FDWPBP_TEXT_DOMAIN),
				'section' => 'second',
				'type'    => 'text',
				'default' => '',
				'args'    => [],
			],
		];
	}
}
