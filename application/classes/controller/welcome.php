<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Grandma_Base{
	// declare models
	protected $fb_users;
	protected $fb_feeds;
		

	public function before() {
		parent::before();
		
		// load ORMs
		$this->fb_users = ORM::factory("fb_users");
		$this->fb_feeds = ORM::factory("fb_feeds");
	}


	public function action_graph(){
		$view = View::factory('welcome/index');
		
		$login_url = url::site("welcome/graph");
		$view->bind('login_url', $login_url);
		
		// Render the view
		$page = $view->render()	;
		
		$this->response->body($page);
		
	}
	

	public function action_index() {
		$facebook_config = Kohana::$config->load('facebook')->{Kohana::$environment};
		
		
		try{
			// load models 
			
			$batch_data = array(
				array(
					"method"=> "GET",
					"relative_url"=> "me"
				),
				
				/*
				array(
					"method"=> "GET",
					"relative_url"=> "me/feed"
				),*/
			);		

			$results = $this->facebook->api_batch($batch_data);
			
			// save the user data
			$me = $results[0];
			
			if(!$this->fb_users->where('fb_uid', '=', $me['id'])->find_all()) {
				$this->fb_users->fb_uid = $me['id'];
				$this->fb_users->first_name = $me['first_name'];
				$this->fb_users->last_name = $me['last_name'];
				
				$this->fb_users->save();
			}
			
			$view = View::factory('welcome/thankyou');
			
			$graph_url = url::site("welcome/graph");
			$view->bind('login_url', $graph_url);
			
			// Render the view
			$page = $view->render()	;
			
			$this->response->body($page);
			
			
		} catch(Exception $e) {
			//echo "<!-- ";
			echo $e;
			//echo " -->";

			$view = View::factory('welcome/index');
			
			$login_url = $this->facebook->getLoginUrl() . "&scope=" . implode(",", $facebook_config['permissions']);
			$view->bind('login_url', $login_url);
			
			// Render the view
			$page = $view->render()	;
			
			$this->response->body($page);
		}
	}
	


} // End Welcome
