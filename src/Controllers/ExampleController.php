<?php

namespace WordPressBoilerplatePlugin\Controllers;

use WordPressBoilerplatePlugin\Models\ExampleModel;

class ExampleController
{
	private $exampleModel;

	public function __construct(ExampleModel $exampleModel)
	{
		$this->exampleModel = $exampleModel;
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
