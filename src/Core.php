<?php

namespace WordPressBoilerplatePlugin;

class Core
{
	public static $instance = null;

	public static function getInstance()
	{
		self::$instance === null && self::$instance = new self;
		return self::$instance;
	}

	public function __construct() {}

	public function url($path = null)
	{
		return untrailingslashit(FDWPBP_URL . $path);
	}

	public function dir($path = null)
	{
		return untrailingslashit(FDWPBP_DIR . $path);
	}
}
