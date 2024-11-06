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
			'page_title' => esc_html__('WordPress Boilerplate Plugin', 'wordpress-boilerplate-plugin'),
			'menu_title' => esc_html__('Boilerplate Plugin', 'wordpress-boilerplate-plugin'),
			'callback'   => [$this, 'displayContent'],
			'position'   => 0,
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
		return apply_filters('fdwpbp_settings_main_tabs', [
			'general' => esc_html__('General Settings', 'wordpress-boilerplate-plugin'),
			'second'  => esc_html__('Second Tab', 'wordpress-boilerplate-plugin'),
		]);
	}

	/**
	 * Returns fields for this submenu.
	 *
	 * @return	array
	 */
	public function getFields()
	{
		return apply_filters('fdwpbp_settings_main_fields', [
			'example_field'        => [
				'id'      => 'example_field',
				'label'   => esc_html__('Example Field', 'wordpress-boilerplate-plugin'),
				'section' => 'general',
				'type'    => 'text',
				'default' => '',
				'args'    => [
					'description' => esc_html__('Example description.', 'wordpress-boilerplate-plugin'),
				],
			],
			'test_field'           => [
				'id'      => 'test_field',
				'label'   => esc_html__('Second Tab Field', 'wordpress-boilerplate-plugin'),
				'section' => 'second',
				'type'    => 'text',
				'default' => '',
				'args'    => [
					'description' => esc_html__('Second tab description.', 'wordpress-boilerplate-plugin'),
				],
			],
			'test_number_field'    => [
				'id'      => 'test_number_field',
				'label'   => esc_html__('Number Field', 'wordpress-boilerplate-plugin'),
				'section' => 'second',
				'type'    => 'number',
				'default' => 0,
				'args'    => [],
			],
			'test_checkbox_field'    => [
				'id'      => 'test_checkbox_field',
				'label'   => esc_html__('Checkbox Field', 'wordpress-boilerplate-plugin'),
				'section' => 'second',
				'type'    => 'checkbox',
				'default' => true,
				'args'    => [],
			],
		]);
	}
}
