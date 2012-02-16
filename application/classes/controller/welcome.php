<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Grandma_Base{
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
	}


	public function action_graph(){
		$this->stats = new Model_Stats();
		$results = $this->stats->auths();
		
		echo "<pre>"; print_r($results); echo "</pre>";
		$view = View::factory('welcome/graph');
		
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
				
				
				array(
					"method"=> "GET",
					"relative_url"=> "me/feed/?limit=100"
				),
			);		

			$results = $this->facebook->api_batch($batch_data);
			
			// save the user data
			$me = $results[0];
			
			if($this->fb_users->where('fb_uid', '=', $me['id'])->find()) {
				$this->fb_users->fb_uid = $me['id'];
				$this->fb_users->first_name = $me['first_name'];
				$this->fb_users->last_name = $me['last_name'];
				
				$this->fb_users->save();
			}
			
			// save the feed data
			$feeds = $results[1]['data'];
			
			foreach($feeds as $feed) {
				$this->fb_feeds = ORM::factory("fb_feeds");
				if($this->fb_feeds->where('id', '=', $feed['id'])->find()) { 
					$this->fb_feeds->id = $feed['id'];
					$this->fb_feeds->fb_uid = $me['id'];
					$this->fb_feeds->from = !empty($feed['from']) ? json_encode($feed['from']) : '';
					$this->fb_feeds->story = !empty($feed['story']) ? $feed['story']  : '';
					$this->fb_feeds->story_tags = !empty($feed['story_tags']) ? json_encode($feed['story_tags'])  : '';
					$this->fb_feeds->type = !empty($feed['type']) ? $feed['type']  : '';
					$this->fb_feeds->created_time = $feed['created_time'];
					$this->fb_feeds->updated_time = $feed['updated_time'];
					$this->fb_feeds->comments = !empty($feed['comments']) ? json_encode($feed['comments']) : '';
					
					$this->fb_feeds->save();
					
					// check and set videos here
					if($feed['type']=='video') { // if feed type is video
						
						
						
						if(!empty($feed['story_tags'])) {
							
							
							
							foreach($feed['story_tags'] as $story_tag){
								if(is_array($story_tag)){ // if an array
									foreach($story_tag as $video){
										$this->fb_videos = ORM::factory("fb_videos");

										$this->fb_videos->fb_id = $video['id'];
										$this->fb_videos->fb_uid = $me['id'];
										$this->fb_videos->name = $video['name'];
										
										$this->fb_videos->save();
										
										unset($this->fb_videos); // release object
									}
								}							
							}
						}
					}
					
				}
				unset($this->fb_feeds);
			}
			
			
			$view = View::factory('welcome/thankyou');
			
			$graph_url = url::site("welcome/graph");
			$view->bind('graph_url', $graph_url);
			
			// Render the view
			$page = $view->render()	;
			
			$this->response->body($page);
			
			
		} catch(Exception $e) {
//			//echo "<!-- ";
			//echo $e;
//			//echo " -->";

			$view = View::factory('welcome/index');
			
			$login_url = $this->facebook->getLoginUrl() . "&scope=" . implode(",", $facebook_config['permissions']);
			$view->bind('login_url', $login_url);
			
			// Render the view
			$page = $view->render()	;
			
			$this->response->body($page);
		}
	}
	
	function after(){
		unset($this->fb_users);
		unset($this->fb_feeds);
	}

} // End Welcome
