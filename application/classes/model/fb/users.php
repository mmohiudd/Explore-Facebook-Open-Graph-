<?php defined('SYSPATH') or die('No direct script access.'); 

/**
 * ORM fb_users Model.
 * 
 * Provides access to the employees data as stored in the database 
 * 
 * @category Models
 * @author BNOTIONS
 */

class Model_Fb_Users extends ORM {
	protected $_table_name = 'fb_users';
	/*
	protected $_belongs_to = array(
		'user' => array(
			'model_type' => 'user',
			'foreign_key' => 'user_id',
		),
	);
	
	
	
	public function __get($field)
	{
		switch($field)
		{
			case 'user.name':
				return $this->user->first_name . ' ' . $this->user->last_name;
			break;
			default:
				return parent::__get($field);
			break;
		}
	}
	*/
}
