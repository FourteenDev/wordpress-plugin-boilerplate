<?php

namespace WordPressBoilerplatePlugin\Menus;

abstract class Base
{
	protected $optionsName = FDWPBP_MENUS_SLUG . '_options';

	/**
	 * **(REQUIRED)** Slug for this submenu. Recommended format: `FDWPBP_MENUS_SLUG . '_{NAME}'`.
	 *
	 * @var	string
	 */
	protected $menuSlug = '';

	public function __construct()
	{
		if (empty($this->menuSlug))
			throw new \LogicException(get_class($this) . ' must initialize $menuSlug property!');

		add_filter('fdwpbp_menus_submenus', [$this, 'addSubmenu']);
		add_action('admin_init', [$this, 'registerSettings']);

		/* global $pagenow;
		if (is_admin() && $pagenow == 'admin.php' && !empty($_GET['page']) && $_GET['page'] == $this->menuSlug)
		{
			
		} */
	}

	/**
	 * Adds the submenu.
	 *
	 * @param	array	$submenus	Format: `
	 * [
	 *		'slug' => [
	 *			'parent_slug' => 'parent_slug' (Optional),
	 *			'page_title'  => 'Page Title',
	 *			'menu_title'  => 'Menu Title',
	 *			'capability'  => 'manage_options' (Optional),
	 *			'callback'    => {CallbackFunction},
	 *			'position'    => 10 (Optional),
	 *		],
	 *		...
	 * ]`.
	 *
	 * @return	array
	 *
	 * @hooked	filter: `fdwpbp_menus_submenus` - 10
	 */
	abstract function addSubmenu($submenus);

	/**
	 * Registers settings for this submenu.
	 *
	 * @return	void
	 *
	 * @hooked	action: `admin_init` - 10
	 */
	public function registerSettings()
	{
		register_setting("{$this->menuSlug}_group", $this->optionsName, [$this, 'validateSettings']);

		foreach ($this->getTabs() as $tabSlug => $tabLabel)
			add_settings_section("{$this->menuSlug}_$tabSlug", $tabLabel, null, $this->menuSlug);

		foreach ($this->getFields() as $field)
		{
			$callback = !empty($field['callback']) ? $field['callback'] : [$this, $field['type'] . 'FieldCallback'];
			$args     = !empty($field['args']) && is_array($field['args']) ? $field['args'] : [];

			add_settings_field(
				$field['id'],
				$field['label'],
				$callback,
				$this->menuSlug,
				"{$this->menuSlug}_" . $field['section'],
				array_merge([
					'id'      => $field['id'],
					'default' => $field['default'],
					'type'    => $field['type'],
				], $args)
			);
		}
	}

	/**
	 * Validates registered settings.
	 *
	 * @param	array	$input
	 *
	 * @return	array
	 */
	public function validateSettings($input)
	{
		$options = get_option($this->optionsName, []);
		if (!is_array($options)) $options = [];

		$input = apply_filters('fdwpbp_before_validate_settings', $input, $options);

		if (is_array($input))
		{
			// Allow values modification via filters
			foreach ($input as $key => $value)
				$input[$key] = apply_filters("fdwpbp_validate_input_$key", $value, $key, $input, $options);

			// Update only the needed options
			foreach ($input as $key => $value)
				if (!empty($key))
					$options[$key] = $value;
		}

		do_action('fdwpbp_validate_settings', $input, $options);

		return $options;
	}

	/**
	 * Returns tabs for this submenu.
	 *
	 * @return	array	Format: `['tab_slug' => 'Tab Name', 'tab_slug' => 'Tab Name', ...]`.
	 */
	protected function getTabs()
	{
		return [];
	}

	/**
	 * Returns fields for this submenu.
	 *
	 * @return	array	Format: `[
	 * 		'test_field' => [
	 *			'id'       => 'test_field',
	 *			'label'    => 'Label',
	 *			'section'  => '{tab_slug}',
	 *			'type'     => 'text',
	 *			'default'  => '',
	 *			// 'callback' => [$this, 'customCallback'], // This is optional. A default callback will be called if you've provided the 'type'.
	 *			'args'     => [
	 *				 // You can add built-in WP arguments here:
	 *				'description' => 'Description',
	 *				'class'       => 'row-class',
	 *				'label_for'   => 'field-id',
	 *				...
	 *			],
	 *		],
	 *		...
	 * ]`.
	 */
	protected function getFields()
	{
		return [];
	}

	/**
	 * Outputs an input field.
	 *
	 * @param	array	$args
	 *
	 * @return	string
	 */
	public function inputFieldCallback($args)
	{
		$id = !empty($args['id']) ? $args['id'] : '';
		if (empty($id)) return;

		FDWPBP()->view('admin.settings.fields.input', $this->getSettingsValue($id, $args));
	}

	/**
	 * Outputs a text input field.
	 *
	 * @param	array	$args
	 *
	 * @return	string
	 */
	public function textFieldCallback($args)
	{
		$this->inputFieldCallback($args);
	}

	/**
	 * Outputs a number input field.
	 *
	 * @param	array	$args
	 *
	 * @return	string
	 */
	public function numberFieldCallback($args)
	{
		$this->inputFieldCallback($args);
	}

	/**
	 * Outputs a checkbox input field.
	 *
	 * @param	array	$args
	 *
	 * @return	string
	 */
	public function checkboxFieldCallback($args)
	{
		// Add a hidden input before checkouts to prevent them from unsetting from the options when unchecked
		$this->inputFieldCallback(array_merge($args, ['type' => 'hidden', 'value' => '0']));

		$this->inputFieldCallback($args);
	}

	/**
	 * Returns field's value.
	 *
	 * @param	string	$key
	 * @param	array	$args
	 *
	 * @return	string
	 */
	private function getSettingsValue($key, $args)
	{
		$default = !empty($args['default']) ? $args['default'] : '';

		$value = isset($args['value']) ? $args['value'] : FDWPBP()->option($key);
		if ($value === null) $value = $default;

		return [
			'id'          => "{$this->optionsName}_$key",
			'name'        => "{$this->optionsName}[$key]",
			'description' => !empty($args['description']) && $args['type'] !== 'hidden' ? trim($args['description']) : '',
			'value'       => esc_attr($value),
			'type'        => esc_attr($args['type']),
		];
	}

	/**
	 * Outputs the content for settings page.
	 *
	 * @return	void
	 */
	public function displayContent()
	{
		$tabs       = $this->getTabs();
		$defaultTab = !empty($tabs) ? sanitize_key(array_key_first($tabs)) : 'general';
		$activeTab  = (!empty($_GET['tab']) && array_key_exists($_GET['tab'], $tabs)) ? sanitize_key($_GET['tab']) : $defaultTab;
		$args       = [
			'title'     => __('Settings', 'wordpress-boilerplate-plugin'),
			'menuSlug'  => $this->menuSlug,
			'tabs'      => $this->getTabs(),
			'activeTab' => $activeTab,
		];

		FDWPBP()->view('admin.settings.wrapper', $args);
	}
}
