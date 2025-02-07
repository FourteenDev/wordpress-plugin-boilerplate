<?php

namespace WordPressBoilerplatePlugin\Controllers;

use WordPressBoilerplatePlugin\Models\ExampleModel;

class ExampleController
{
	private $exampleModel;

	public function __construct()
	{
		$this->exampleModel = new ExampleModel();
	}

	/**
	 * Returns active items. (Example)
	 *
	 * @return	array
	 */
	public function getActiveItems()
	{
		return $this->exampleModel->getActiveItems();
	}
}
