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
	 * @param	string	$hookSuffix		Current admin page.
	 *
	 * @return	void
	 *
	 * @hooked	action: `admin_enqueue_scripts` - 10
	 */
	public function enqueueAdminScripts($hookSuffix)
	{
		wp_enqueue_style('fdwpbp_admin', FDWPBP()->url('assets/admin/css/admin.css'), [], FDWPBP_VERSION);

		wp_enqueue_script('fdwpbp_admin', FDWPBP()->url('assets/admin/js/admin.js'), [], FDWPBP_VERSION, true);
	}

	/**
	 * Enqueues public styles and scripts.
	 *
	 * @return	void
	 *
	 * @hooked	action: `wp_enqueue_scripts` - 10
	 */
	public function enqueuePublicScripts()
	{
		wp_enqueue_style('fdwpbp_public', FDWPBP()->url('assets/public/css/public.css'), [], FDWPBP_VERSION);

		wp_enqueue_script('fdwpbp_public', FDWPBP()->url('assets/public/js/public.js'), [], FDWPBP_VERSION, true);
	}
}
