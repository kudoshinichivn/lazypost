<?php
class PostController extends BaseController {

	public function post($type){
		$fb=LazySalesHelper::fb();
		$fbApp=LazySalesHelper::fbApp();
		$accessToken;
		if(Input::has('access_token'))
			$accessToken=Input::get('access_token');
		else
			$accessToken=$_SESSION['accessToken'];
		$where;
		$data;
		
		if($type!="schedule"){
			if(!empty(Input::get('image')))
			{
				$where='photos';
				$data=array(
						//'url' => 'http://localhost/lazysales/public/temp/'.Input::get('image'),
						'source' => $fb->fileToUpload('../public/temp/'.Session::get('image')),
						'message' => Input::get('message')." ".Input::get('link'),
						);
			}
			

			
			if(!empty(Input::get('link')) && empty(Input::get('image')))
			{
				$where='feed';
				$data=array(
						'link' => Input::get('link') ,
						'message' => Input::get('message'),
						);
			}
			if(!empty(Input::get('message')) && empty(Input::get('link')) && empty(Input::get('image')))
			{
				$where='feed';
				$data=array(
						'message' => Input::get('message'),
						);
			}
		}
		else
		{
			$local_timezone=Config::get('timezone.'.Input::get('timezone'));
			$time=Input::get('schedule');
			$target_timezone="GMT";
			$datetime=LazySalesHelper::convert_time($time,$local_timezone,$target_timezone);
			$timestamp=strtotime($datetime."+0");
			if(!empty(Input::get('image')))
			{
				$where='photos';
				$data=array(
						//'url' => 'http://localhost/lazysales/public/temp/'.Input::get('image'),
						'source' => $fb->fileToUpload('../public/temp/'.Session::get('image')),
						'message' => Input::get('message')." ".Input::get('link'),
						'scheduled_publish_time' => $timestamp,
						'published'=>'false'
						);
			}
			

			
			if(!empty(Input::get('link')) && empty(Input::get('image')))
			{
				$where='feed';
				$data=array(
						'link' => Input::get('link') ,
						'message' => Input::get('message'),
						'scheduled_publish_time' => $timestamp,
						'published'=>'false'
						);
			}
			if(!empty(Input::get('message')) && empty(Input::get('link')) && empty(Input::get('image')))
			{
				$where='feed';
				$data=array(
						'message' => Input::get('message'),
						'scheduled_publish_time' => $timestamp,
						'published'=>'false' 
						);
			}
		}
		
		
		

		try{
				
				$request = new Facebook\FacebookRequest($fbApp, $accessToken, 'POST', '/'.Input::get('node').'/'.$where,$data);
				$response = $fb->getClient()->sendRequest($request);
				
			
			}
			catch(Exception $e){
				echo $e;
				
			}
		
	}

}