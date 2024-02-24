<?php

namespace WordPressBoilerplatePlugin;

class Asset
{
	public static $instance = null;

	public static function getInstance()
	{
		self::$instance === null && self::$instance = new self;
		return self::$instance;
	}

	public function __construct()
	{
		add_action('admin_enqueue_scripts', [$this, 'enqueueAdminScripts']);
		add_action('wp_enqueue_scripts', [$this, 'enqueuePublicScripts']);
	}

	/**
	 * Enqueues admin styles and scripts.
	 *
	 * @return	void
	 */
	public function enqueueAdminScripts()
	{
		wp_enqueue_style('fdwpbp_admin', FDWPBP()->url('assets/admin/css/admin.css'), [], FDWPBP_VERSION);
	}

	/**
	 * Enqueues public styles and scripts.
	 *
	 * @return	void
	 */
	public function enqueuePublicScripts()
	{
		wp_enqueue_style('fdwpbp_public', FDWPBP()->url('assets/public/css/public.css'), [], FDWPBP_VERSION);
	}
}
