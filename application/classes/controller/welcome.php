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
			*/

			
		} catch(Exception $e) {
			
			$access_token = $this->facebook->getAccessToken();
			
			echo $access_token . "<Br><Br>";
			
			echo $access_token . "<Br><Br>";
			
			//$access_token = $this->facebook->getCode();
			//echo $access_token . "<Br><Br>";
			
			$sigend_request = $this->facebook->getSignedRequest();
			
			echo "<pre>"; print_r($sigend_request); echo "</pre>";
			
			//echo "<pre>"; print_r($_REQUEST); echo "</pre>";
			/*
			$view = View::factory('welcome/index');
			
			
			$login_url = $this->facebook->getLoginUrl();
			$view->bind('login_url', $login_url);
			
			echo $this->facebook->get_login_url() . "<br><br>";
			
			echo "<pre>"; print_r($view); echo "</pre>";
			
			// Render the view
			$page = $view->render()	;
			
			$this->response->body($page);
			*/
		}
		
		//echo "<pre>"; print_r($signed_request); echo "</pre>";
		
	}
	


} // End Welcome
