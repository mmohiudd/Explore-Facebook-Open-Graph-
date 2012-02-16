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
	
	
	public function total_auths() {
		$query = DB::select(DB::expr("COUNT(*) as `c`"))->from('fb_users');
		return $query->execute($this->_db)->get('c');
	}
	
	
	public function total_netflix_users() {
		$query = DB::select(DB::expr("COUNT( DISTINCT fb_uid )  as `c`"))->from('fb_videos')->where("name", "=", "netflix");
		return $query->execute($this->_db)->get('c');
	}
    

	public function last_movies_watched() {
		$query = DB::select(DB::expr("*"))->from('fb_videos');
		
		$results = $query->execute($this->_db);
		
		$return = array();
		
		foreach($results as $result){
			if(!array_key_exists($result['fb_uid'], $return)){
				$return[$result['fb_uid']] = $result;
			}
		}
		
		return $return;
	}
	
	
	public function most_popular_video() {
		$query = DB::select(DB::expr("COUNT(DISTINCT fb_uid) AS c, id, fb_id, fb_uid, name"))->from('fb_videos')->group_by('fb_uid')->order_by('c', "DESC");
		
		$results = $query->execute($this->_db);
		
		$return = array();
		
		foreach($results as $result){
			echo "<pre>"; print_r($result); echo "</pre>";
		}
		
		return $return;
	}

}
