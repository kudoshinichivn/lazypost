<?php

class FacebookController extends BaseController {

	
	
	
	public function login(){
		
		$fb=LazySalesHelper::fb();
		$helper = $fb->getRedirectLoginHelper();
		$login_url = $helper->getLoginUrl(Config::get('facebook.redirect_url').'/callback', Config::get('permissions'));
		return View::make('LazySales.login',array('login_url' =>$login_url));
	}
								
	public function callback(){
		$fb=LazySalesHelper::fb();
		$helper = $fb->getRedirectLoginHelper();
		$accessToken = $helper->getAccessToken();
		if(!empty($accessToken))
		{
			$_SESSION['accessToken']=$accessToken;
			$fbApp=LazySalesHelper::fbApp();
		
			$request = new Facebook\FacebookRequest($fbApp, $accessToken, 'GET', '/me?fields=id,name,email,gender,link,locale,timezone,verified,age_range');
			$response = $fb->getClient()->sendRequest($request);
			$user_info = $response->getGraphNode();
			
			$uid=$user_info->getProperty('id');
			$name=$user_info->getProperty('name');
			$email=$user_info->getProperty('email');
			$user_json=array();
			$user_json[]=$user_info->getProperty('age_range')->getProperty('min')."-".$user_info->getProperty('age_range')->getProperty('max');
			$user_json[]=$user_info->getProperty('gender');
			$user_json[]=$user_info->getProperty('link');
			$user_json[]=$user_info->getProperty('locale');
			$user_json[]=$user_info->getProperty('timezone');
			$user_json[]=$user_info->getProperty('verified');

			$detail=json_encode($user_json);
			$_SESSION['uid']=$uid;
			if(empty($email))
				$email="unknown";
		
			$checkUser = User::where('uid','=',$uid)->get();
			if($checkUser=="[]")
			{
				$user = new User;
				$user->uid=$uid;
				$user->name=$name;
				$user->email=$email;
				$user->detail=$detail;
				$user->save();
				
			}
			
				
			
			
		}
		return View::make('LazySales.callback',array('url' =>Config::get('facebook.redirect_url')));
		
	}
	
	
	


	public static function getdata($where)
	{	
		
		if(Request::ajax())
		{
			if(isset($_SESSION["accessToken"]))
			{	
				$fb=LazySalesHelper::fb();
				$fbApp=LazySalesHelper::fbApp();

				$fields="/me/groups?fields=id,name&limit=500";
				if($where=="page")
					$fields="/me/accounts?fields=id,name,access_token&limit=500";

				try 
				{
					$request = new Facebook\FacebookRequest($fbApp, $_SESSION["accessToken"], 'GET', $fields);
					$response = $fb->getClient()->sendRequest($request);
				} 
				catch(Exception $e) 
				{
				  echo $e;
				}

				$data=$response->getGraphEdge()->asArray();
				
				if(!empty($data))
				{
					
					return View::make('LazySales.data',array('data' =>$data,'where'=>$where));
					

				}
				else
				{

					if($where=="group")
						return Lang::get('lazysales.cant_load_the_groups_list');
					else
						return Lang::get('lazysales.cant_load_the_pages_list');

				}
			}
				else
					return "Access Denied";
		}
			else
					return "Access Denied";
	}
	
	
	
	
}
