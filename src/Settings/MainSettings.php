<?php

namespace WordPressBoilerplatePlugin\Settings;

class MainSettings extends Base
{
	public static $instance = null;

	protected $menuSlug = FDWPBP_SETTINGS_SLUG . '_settings';

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
		$submenus['settings'] = [
			'page_title' => esc_html__('WordPress Boilerplate Plugin', FDWPBP_TEXT_DOMAIN),
			'menu_title' => esc_html__('Boilerplate Plugin', FDWPBP_TEXT_DOMAIN),
			'callback'   => [$this, 'displayContent'],
			'position'   => 0,
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
		return apply_filters('fdwpbp_settings_main_tabs', [
			'general' => esc_html__('General Settings', FDWPBP_TEXT_DOMAIN),
			'second'  => esc_html__('Second Tab', FDWPBP_TEXT_DOMAIN),
		]);
	}

	/**
	 * Returns tabs for this page.
	 *
	 * @return	array
	 */
	public function getFields()
	{
		return apply_filters('fdwpbp_settings_main_fields', [
			'example_field' => [
				'id'      => 'example_field',
				'label'   => esc_html__('Example Field', FDWPBP_TEXT_DOMAIN),
				'section' => 'general',
				'type'    => 'text',
				'default' => '',
				'args'    => [
					'description' => esc_html__('Example description.', FDWPBP_TEXT_DOMAIN),
				],
			],
			'test_field'    => [
				'id'      => 'test_field',
				'label'   => esc_html__('Second Tab Field', FDWPBP_TEXT_DOMAIN),
				'section' => 'second',
				'type'    => 'text',
				'default' => '',
				'args'    => [
					'description' => esc_html__('Second tab description.', FDWPBP_TEXT_DOMAIN),
				],
			],
		]);
	}
}
