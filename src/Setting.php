<?php

namespace WordPressBoilerplatePlugin;

class Setting
{
	public static $instance = null;

	private $menuSlug    = FDWPBP_SETTINGS_SLUG . '_settings';
	private $optionsName = FDWPBP_SETTINGS_SLUG . '_options';

	public static function getInstance()
	{
		self::$instance === null && self::$instance = new self;
		return self::$instance;
	}

	public function __construct()
	{
		add_action('admin_menu', [$this, 'createAdminMenu']);
		add_action('admin_init', [$this, 'registerSettings']);

		add_filter('plugin_action_links_' . FDWPBP_BASENAME, [$this, 'actionLinks']);
	}

	/**
	 * Creates a menu in admin dashboard.
	 *
	 * @return	void
	 *
	 * @hooked	action: `admin_menu` - 10
	 */
	public function createAdminMenu()
	{
		add_menu_page(
			esc_html__('WordPress Boilerplate Plugin', FDWPBP_TEXT_DOMAIN),
			esc_html__('Boilerplate Plugin', FDWPBP_TEXT_DOMAIN),
			'manage_options',
			$this->menuSlug,
			[$this, 'displaySettingsContent'],
			'dashicons-wordpress'
		);
	}

	/**
	 * Outputs the content for settings page.
	 *
	 * @return	void
	 */
	public function displaySettingsContent()
	{
		$activeTab = (!empty($_GET['tab']) && array_key_exists($_GET['tab'], $this->getTabs())) ? sanitize_key($_GET['tab']) : 'general';
		$args      = [
			'activeTab' => $activeTab,
			'tabs'      => $this->getTabs(),
		];

		FDWPBP()->view('admin.settings.wrapper', $args);
	}

	/**
	 * Registers plugin settings in the admin menu.
	 *
	 * @return	void
	 *
	 * @hooked	action: `admin_init` - 10
	 */
	public function registerSettings()
	{
		register_setting("{$this->menuSlug}_group", $this->optionsName);

		foreach ($this->getTabs() as $tabSlug => $tabLabel)
			add_settings_section("{$this->menuSlug}_$tabSlug", $tabLabel, null, $this->menuSlug);

		$fields = [
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
		];

		foreach ($fields as $field)
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
	 * Returns tabs for the settings page.
	 *
	 * @return	array
	 */
	public function getTabs()
	{
		$tabs = [
			'general' => esc_html__('General Settings', FDWPBP_TEXT_DOMAIN),
			'second'  => esc_html__('Second Tab', FDWPBP_TEXT_DOMAIN),
		];

		return apply_filters('fdwpbp_settings_tabs', $tabs);
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
	 * Adds plugin action links to the plugins page.
	 *
	 * @param	array	$links
	 *
	 * @return	array
	 *
	 * @hooked	filter: `plugin_action_links_{FDWPBP_BASENAME}` - 10
	 */
	public function actionLinks($links)
	{
		$links[] = '<a href="' . get_admin_url(null, "admin.php?page={$this->menuSlug}") . '">' . esc_html__('Settings', FDWPBP_TEXT_DOMAIN) . '</a>';
		return $links;
	}
}
