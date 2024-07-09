<?php

namespace WordPressBoilerplatePlugin\Settings;

abstract class Base
{
	protected $optionsName = FDWPBP_SETTINGS_SLUG . '_options';

	/**
	 * **(REQUIRED)** Slug for this submenu. Recommended format: `FDWPBP_SETTINGS_SLUG . '_{NAME}'`.
	 *
	 * @var	string
	 */
	protected $menuSlug = '';

	public function __construct()
	{
		if (empty($this->menuSlug))
			throw new \LogicException(get_class($this) . ' must initialize $menuSlug property!');

		add_filter('fdwpbp_settings_submenus', [$this, 'addSubmenu']);
		add_action('admin_init', [$this, 'registerSettings']);

		/* global $pagenow;
        if (is_admin() && $pagenow == 'admin.php' && isset($_REQUEST['page']) && $_REQUEST['page'] == $this->menuSlug)
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
	 * @hooked	filter: `fdwpbp_settings_submenus` - 10
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

			add_settings_field(
				$field['id'],
				$field['label'],
				$callback,
				$this->menuSlug,
				"{$this->menuSlug}_" . $field['section'],
				['id' => $field['id'], 'default' => $field['default']] + $field['args']
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
		$options = get_option($this->optionsName);

		// Update only the neede options
		foreach ($input as $key => $value)
			$options[$key] = $value;

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
	 *			'id'      => 'test_field',
	 *			'label'   => 'Label',
	 *			'section' => '{tab_slug}',
	 *			'type'    => 'text',
	 *			'default' => '',
	 *			'args'    => [
	 *				'description' => 'Description',
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
	 * Outputs a text input field.
	 *
	 * @param	array	$args
	 *
	 * @return	string
	 */
	public function textFieldCallback($args)
	{
		$id = !empty($args['id']) ? $args['id'] : '';
		if (empty($id)) return;

		FDWPBP()->view('admin.settings.fields.text', $this->getSettingsValue($id, $args));
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

		$value = FDWPBP()->option($key);
		if (empty($value)) $value = $default;

		return [
			'id'          => "{$this->optionsName}_$key",
			'name'        => "{$this->optionsName}[$key]",
			'description' => !empty($args['description']) ? trim($args['description']) : '',
			'value'       => $value,
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
			'title'     => __('Settings', FDWPBP_TEXT_DOMAIN),
			'menuSlug'  => $this->menuSlug,
			'tabs'      => $this->getTabs(),
			'activeTab' => $activeTab,
		];

		FDWPBP()->view('admin.settings.wrapper', $args);
	}
}
