<?php

class FacebookController extends BaseController {

	
	
	
	public function login(){
		
		$fb=LazySalesHelper::fb();
		$helper = $fb->getRedirectLoginHelper();
		$login_url = $helper->getLoginUrl(Config::get('facebook.redirect_url').'/callback', Config::get('permissions'));
		return View::make('LazySales.start',array('login_url' =>$login_url));
	}
								
	public function callback(){
		$fb=LazySalesHelper::fb();
		$helper = $fb->getRedirectLoginHelper();
		$accessToken = $helper->getAccessToken();
		if(!empty($accessToken))
		{
			$_SESSION['accessToken']=$accessToken;
			$fbApp=LazySalesHelper::fbApp();
			try 
			{
				$request = new Facebook\FacebookRequest($fbApp, $accessToken, 'GET', '/me?fields=id,name,email,gender,link,locale,timezone,verified,age_range');
				$response = $fb->getClient()->sendRequest($request);
				$user_info = $response->getGraphNode();
				
				$user_json=array();
				$user_json[]=$user_info->getProperty('age_range')->getProperty('min')."-".$user_info->getProperty('age_range')->getProperty('max');
				$user_json[]=$user_info->getProperty('gender');
				$user_json[]=$user_info->getProperty('link');
				$user_json[]=$user_info->getProperty('locale');
				$user_json[]=$user_info->getProperty('timezone');
				$user_json[]=$user_info->getProperty('verified');
				
				$uid=$user_info->getProperty('id');
				$_SESSION['uid']=$uid;
				$name=$user_info->getProperty('name');
				
				$email=$user_info->getProperty('email');
				if(empty($email))
					$email="unknown";
				$detail=json_encode($user_json);
				
				//echo "UID: ".$uid."<br>Name: ".$name."<br>Email: ".$email."<br>Detail: ".$detail;
				$checkUser = DB::table('user_profile')->get();
				if(empty($checkUser))
					DB::table('user_profile')->insert(array(
												'uid' => $uid,
												'name' => $name,
												'email'=>$email,
												'detail'=>$detail)
									);
				
				echo 	"<script type='text/javascript'>
						window.close();
						window.opener.location.href='".Config::get('facebook.redirect_url')."';
							
						</script>
						";
				
			} 
			catch(Exception $e) 
			{
			  echo $e;
			}
			
		}
		else
		{
			echo "<script type='text/javascript'>
					this.close();
					
				</script>";
		}
		
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
					
					
					foreach ($data as $key=>$value) 
					{
						if($where=="group")
							echo "
								<tr><td><label>
								<input type='checkbox' name='".$value['id']."' value='".$value['id']."' id='".$value['id']."'/> &nbsp 
								<a style='color:#000;' target='_blank' href='https://facebook.com/".$value['id']."'>
								<img width='30px' heigh='30px' class='uk-border-circle' src='http://localhost/lazysales/public/images/group_icon.png'/>".$value['name']."
								</a> </label></td></tr>";
						else
							echo "
								<tr><td><label><input type='checkbox' name='".$value['access_token']."' value='".$value['id']."' id='".$value['id']."'/> &nbsp 
								<a target='_blank'style='color:#000;' href='https://facebook.com/".$value['id']."' alt='".$value['name']."'><img width='30px' heigh='30px' class='uk-border-circle' src='https://graph.facebook.com/".$value["id"]."/picture?width=100&height=100'/>".$value['name']."
								</a> </label></td></tr>";
					}

				}
				else
				{

					if($where=="group")
						echo Lang::get('lazysales.cant_load_the_groups_list');
					else
						echo Lang::get('lazysales.cant_load_the_pages_list');

				}
			}
				else
					return "Access Denied";
		}
			else
					return "Access Denied";
	}
	
	
	
	
}
