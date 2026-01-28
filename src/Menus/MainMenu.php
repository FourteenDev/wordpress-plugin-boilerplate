<?php

namespace WordPressBoilerplatePlugin\Menus;

class MainMenu extends Base
{
	protected $menuSlug = FDWPBP_MENUS_SLUG . '_settings';

	public function __construct()
	{
		parent::__construct();

		// Uncomment if you want to change select options programmatically
		// add_filter('fdwpbp_menus_main_fields', [$this, 'populateSelectValues']);
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
		$submenus['settings'] = [
			'page_title' => esc_html__('WordPress Boilerplate Plugin', 'wordpress-boilerplate-plugin'),
			'menu_title' => esc_html__('Boilerplate Plugin', 'wordpress-boilerplate-plugin'),
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
		return apply_filters('fdwpbp_menus_main_tabs', [
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
		return apply_filters('fdwpbp_menus_main_fields', [
			'example_field'       => [
				'id'      => 'example_field',
				'label'   => esc_html__('Example Field', 'wordpress-boilerplate-plugin'),
				'section' => 'general',
				'type'    => 'text',
				'default' => '',
				'args'    => [
					'description' => esc_html__('Example description.', 'wordpress-boilerplate-plugin'),
				],
			],
			'test_field'          => [
				'id'      => 'test_field',
				'label'   => esc_html__('Second Tab Field', 'wordpress-boilerplate-plugin'),
				'section' => 'second',
				'type'    => 'text',
				'default' => '',
				'args'    => [
					'description' => esc_html__('Second tab description.', 'wordpress-boilerplate-plugin'),
				],
			],
			'test_number_field'   => [
				'id'      => 'test_number_field',
				'label'   => esc_html__('Number Field', 'wordpress-boilerplate-plugin'),
				'section' => 'second',
				'type'    => 'number',
				'default' => 0,
				'args'    => [],
			],
			'test_checkbox_field' => [
				'id'      => 'test_checkbox_field',
				'label'   => esc_html__('Checkbox Field', 'wordpress-boilerplate-plugin'),
				'section' => 'second',
				'type'    => 'checkbox',
				'default' => true,
				'args'    => [],
			],
			'test_textarea_field' => [
				'id'      => 'test_textarea_field',
				'label'   => esc_html__('Textarea Field', 'wordpress-boilerplate-plugin'),
				'section' => 'second',
				'type'    => 'textarea',
				'default' => '',
				'args'    => [
					'placeholder' => esc_html__('Placeholder', 'wordpress-boilerplate-plugin'),
				],
			],
			'test_select_field' => [
				'id'      => 'test_select_field',
				'label'   => esc_html__('Select Field', 'wordpress-boilerplate-plugin'),
				'section' => 'second',
				'type'    => 'select',
				'default' => '',
				'args'    => [
					'options'  => [
						// Either keep the options empty here and populate them using the `fdwpbp_menus_main_fields` filter like below
						// '' => '',

						// Or add options manually yourself
						'key1' => esc_html__('Value 01', 'wordpress-boilerplate-plugin'),
						'key2' => esc_html__('Value 02', 'wordpress-boilerplate-plugin'),
					],
					// 'multiple' => true,
				],
			],
		]);
	}

	/**
	 * Adds some example values to the select field.
	 *
	 * @param	array	$fields
	 *
	 * @return	array
	 *
	 * @hooked	filter: `fdwpbp_menus_main_fields` - 10
	 */
	public function populateSelectValues($fields)
	{
		if (empty($fields['test_select_field'])) return $fields;

		$fields['test_select_field']['args']['options'] = [];
		foreach ([1, 2, 3, 4, 5] as $number)
			$fields['test_select_field']['args']['options']["key$number"] = "Value 0$number";

		return $fields;
	}
}
