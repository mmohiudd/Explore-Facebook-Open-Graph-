<?php defined('SYSPATH') or die('No direct script access.'); 

/**
 * ORM fb_users Model.
 * 
 * Provides access to the employees data as stored in the database 
 * 
 * @category Models
 * @author BNOTIONS
 */

class Model_Stats extends Model_Database {
	
	function __construct() {
		parent::__construct(Kohana::$environment, Kohana::$config->load('database')->{Kohana::$environment});
	}
	
	
	
	public function auths() {
		$query = DB::select(DB::expr("COUNT(*) as `c`"))->from('fb_videos');
		return $query->execute($this->_db)->get('c');
		
		// Get stuff from the database:
		
	}
    
}
