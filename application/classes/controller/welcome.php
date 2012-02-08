<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Grandma_Base{
	
	public function thankyou(){
		$signed_request = $this->facebook->getSignedRequest();
		echo "<pre>"; print_r($signed_request); echo "</pre>";
		$user = $this->facebook->me();
		
		
		$batch_data = array(
		    array(
			"method"=> "GET",
			"relative_url"=> "me/friends"
		    ),
		    array(
			"method"=> "GET",
			"relative_url"=> "me/feed"
		    ),
		    array(
			"method"=> "GET",
			"relative_url"=> "me/photos"
		    ),    
		    array(
			"method"=> "GET",
			"relative_url"=> "me/videos"
		    ),
		);		
		$results = $this->facebook->api_batch($batch_data);
		
		echo "<pre>"; print_r($results); echo "</pre>";
		echo "<pre>"; print_r($user); echo "</pre>";
	}
	
	public function action_index() {
		
		
		try{
			$fb_user = $this->facebook->me();
			
			echo "<pre>"; print_r($fb_user); echo "</pre>";
		} catch(Exception $e) {
			echo $e;
			
		}
		
		//echo "<pre>"; print_r($signed_request); echo "</pre>";
		
		/*
		$fb_users = ORM::factory('fb_users');
	
		$fb_users->fb_uid = rand(0,100000);
		$fb_users->first_name = '';
		$fb_users->last_name = '';
		$fb_users->gender = '';
		$fb_users->birth_date = '';
		$fb_users->email = '';
		$fb_users->lang = '';
		$fb_users->auth_token = '';
		$fb_users->save();

		/*
		$view = View::factory('welcome/index');
	 
	    // Render the view
	    //$page = $view->render();
	 
	    // Or just type cast it to a string
	    $page = (string) $view;
	 
	    $this->response->body($page);
		*/
	}
	


} // End Welcome
