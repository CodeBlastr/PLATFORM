<?php
namespace App\Controller;

use App\Controller\AppController;

class CocktailsController extends AppController
{
	/**
	 * Sets defaults and limits to what can be accessed via the api.
	 *
	 * @var array
	 */
	public $paginate = [
		'page' => 1,
		'limit' => 3,
		'maxLimit' => 10,
		'fields' => [
			'id', 'name', 'description'
		],
		'sortWhitelist' => [
			'id', 'name', 'description'
		]
	];
}