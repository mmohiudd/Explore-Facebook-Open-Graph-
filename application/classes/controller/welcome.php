<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Grandma_Base{
	
	public function thankyou(){
	}
	
	public function action_index() {
		$facebook_config = Kohana::$config->load('facebook')->{Kohana::$environment};
		
		try{
			// load model 
			
			$fb_users = ORM::factory("fb_users");
			$fb_feeds = ORM::factory("fb_feeds");
			
			$batch_data = array(
				array(
					"method"=> "GET",
					"relative_url"=> "me"
				),
				
				
				array(
					"method"=> "GET",
					"relative_url"=> "me/feed"
				),
			);		

			$results = $this->facebook->api_batch($batch_data);
			
			// save the user data
			$me = $results[0];
			
			$fb_users->fb_uid = $me['id'];
			$fb_users->first_name = $me['first_name'];
			$fb_users->last_name = $me['last_name'];
			
			$fb_users->save();
			
		} catch(Exception $e) {

			$view = View::factory('welcome/index');
			
			$login_url = $this->facebook->getLoginUrl() . "&scope=" . implode(",", $facebook_config['permissions']);
			$view->bind('login_url', $login_url);
			
			// Render the view
			$page = $view->render()	;
			
			$this->response->body($page);
		}
	}
	


} // End Welcome
