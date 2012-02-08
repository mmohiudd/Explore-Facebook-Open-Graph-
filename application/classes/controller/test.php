<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Test extends Controller_Grandma_Base {

	public function action_index()
	{
		$this->response->body('hello, test!');
	}

} // End Welcome
