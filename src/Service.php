<?php

namespace WordPressBoilerplatePlugin;

use WordPressBoilerplatePlugin\Services\Posts\Post;
use WordPressBoilerplatePlugin\Services\Integrations\Elementor;
use WordPressBoilerplatePlugin\Services\Integrations\RankMath;

class Service
{
	public static $instance = null;

	public static function getInstance()
	{
		self::$instance === null && self::$instance = new self;
		return self::$instance;
	}

	public function __construct()
	{
		// Posts
		// new Post();

		// Integrations
		// new Elementor();
		// new RankMath();
	}
}
