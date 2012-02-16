<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Stats extends Controller_Grandma_Base{
	// declare models
	protected $fb_users;
	protected $fb_feeds;
	protected $fb_videos;
	protected $stats;
	
	public function before() {
		ini_set('precision', 20); // set float precision to handle double
		parent::before();
		
		// load ORMs
		$this->fb_users = ORM::factory("fb_users");
		$this->fb_feeds = ORM::factory("fb_feeds");
		
		// load models
		$this->stats = new Model_Stats();
	}


	public function action_index() {
		$total_auths = $this->stats->total_auths();
		$total_netflix_users = $this->stats->total_netflix_users();
		$last_movies_watched = $this->stats->last_movies_watched();
		$most_popular_video = $this->stats->most_popular_video();
		
		$view = View::factory('stats');
		$view->bind('total_auths', $total_auths);
		$view->bind('total_netflix_users', $total_netflix_users);
		$view->bind('last_movies_watched', $last_movies_watched);
		
		// Render the view
		$page = $view->render()	;
		
		$this->response->body($page);
		
	}
	
	function after(){
		unset($this->fb_users);
		unset($this->fb_feeds);
		unset($this->fb_videos);
		unset($this->stats);
	}

} // End Welcome
