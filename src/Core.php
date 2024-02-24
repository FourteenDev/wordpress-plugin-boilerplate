<?php

namespace WordPressBoilerplatePlugin;

class Core
{
	public static $instance = null;

	private $options;

	public static function getInstance()
	{
		self::$instance === null && self::$instance = new self;
		return self::$instance;
	}

	public function __construct()
	{
		Model::getInstance();
		Asset::getInstance();

		if (is_admin())
			Setting::getInstance();
	}

	/**
	 * Returns plugin's URL path, without any slashes in the end (e.g. `https://Site.com/wp-content/plugins/my-plugin`).
	 *
	 * @param	string	$path	Path to append to the end of the URL, without any slashes in the beginning (e.g. `path/to/my-file.php`).
	 *
	 * @return	string
	 */
	public function url($path = '')
	{
		return untrailingslashit(FDWPBP_URL . $path);
	}

	/**
	 * Returns plugin's dir path, without any slashes in the end (e.g. `/var/www/html/wp-content/plugins/my-plugin`).
	 *
	 * @param	string	$path	Path to append to the end of the dir, without any slashes in the beginning (e.g. `path/to/my-file.php`).
	 *
	 * @return	string
	 */
	public function dir($path = '')
	{
		return untrailingslashit(FDWPBP_DIR . $path);
	}

	/**
	 * Returns `Model` class.
	 *
	 * @return	Model
	 */
	public function model()
	{
		return Model::getInstance();
	}

	/**
	 * Returns a view from `views/` folder.
	 *
	 * @param	string		$filePath		File path without `.php` extension, where path parts are separated with dots (e.g. `path.to.file`).
	 * @param	array		$passedArray	Input data to pass to the file. The array will be extracted into multiple variables (e.g. `['var1' => 'Foo', 'var2' => 'Bar']`).
	 * @param	bool		$echo			Echo/print the view or just return the view (to save in a variable).
	 *
	 * @return	mixed
	 */
	public function view($filePath, $passedArray = [], $echo = true)
	{
		if (!$echo) return View::getInstance()->display($filePath, $passedArray);

		echo View::getInstance()->display($filePath, $passedArray);
	}

	/**
	 * Returns a plugin option.
	 *
	 * @param	string		$optionName
	 *
	 * @return	mixed|null
	 */
	public function option($optionName)
	{
		if (empty($this->options))
			$this->options = get_option(FDWPBP_SETTINGS_SLUG . '_options');

		return (isset($this->options[$optionName]) && !empty($this->options[$optionName])) ? $this->options[$optionName] : null;
	}
}
