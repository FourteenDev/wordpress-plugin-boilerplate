<?php

namespace WordPressBoilerplatePlugin;

class Model
{
	public static $instance = null;

	/** @var	\wpdb */
	private $wpdb;

	/** @var	string */
	private $charsetCollate;

	public static function getInstance()
	{
		self::$instance === null && self::$instance = new self;
		return self::$instance;
	}

	public function __construct()
	{
		global $wpdb;

		$this->wpdb           = $wpdb;
		$this->charsetCollate = $wpdb->get_charset_collate();

		// Example database related method:
		// add_action('plugins_loaded', [$this, 'initializeTables']);
	}

	/**
	 * Creates all the necessary tables if they haven't been created yet.
	 *
	 * @return	void
	 *
	 * @hooked	action: `plugins_loaded` - 10
	 */
	public function initializeTables()
	{
		if (trim(get_option(FDWPBP_OPTIONS_KEY_DB_VERSION, '')) === trim(FDWPBP_VERSION)) return;

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		// Example query:
		/* dbDelta("CREATE TABLE `{$this->wpdb->prefix}some_table` (
			...
		) {$this->charsetCollate};"); */

		// or maybe: 
		/* $this->wpdb->query(
			"CREATE TABLE IF NOT EXISTS `{$this->wpdb->prefix}some_table` (
				...
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;"
		); */

		update_option(FDWPBP_OPTIONS_KEY_DB_VERSION, trim(FDWPBP_VERSION));
	}
}
