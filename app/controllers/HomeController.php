<?php

class HomeController extends BaseController {

	public static function save(){



		date_default_timezone_set('GMT');
		$datetime=date("Y-m-d H:i:s");
		$type="";
		$image="";
		$schedule="0000-00-00 00:00:00";
		if(Input::has('schedule'))
		{
			$local_timezone=Config::get('timezone.'.Input::get('timezone'));
			$time=Input::get('schedule');
			$target_timezone="GMT";
			$schedule=LazySalesHelper::convert_time($time,$local_timezone,$target_timezone);
		}
		if(Input::has('album'))
		{
			$type = "album";
			$image= json_encode(Input::get('image'));
			
		}
		else
		{
			if(!empty(Input::get('image')))
			{
				$type = "image";
				$image=Session::get('image');
			}

				
			if(empty(Input::get('image'))&&!empty(Input::get('link')))
				$type = "link";
			if(empty(Input::get('image')) && empty(Input::get('link')) &&!empty(Input::get('message')))
				$type = "message";
		
		}
		
		

		$post= new Post;
		$post->pid='NULL';
		$post->uid=$_SESSION['uid'];
		$post->datetime=$datetime;
		$post->type=$type;
		$post->node=json_encode(Input::get('node_list'));
		$post->image=$image;
		$post->link=Input::get('link');
		$post->message=Input::get('message');
		$post->schedule=$schedule;
		$post->save();
		
	}

	public function logout(){
		$_SESSION=array();
		session_destroy();
		return Redirect::to('login');
	}

	public function index()
	{
		
		if (isset($_SESSION['accessToken']))
		{
			return View::make('LazySales.success');
		}
		else
			return Redirect::to('login');
		
		
	}
	public function setlang(){
		if (Request::ajax())
		{
			
			if (Input::has('lang'))
			{
				if (Session::has('locale'))
				{
					Session::flush();
					Session::put('locale', Input::get('lang'));
				}
				else
				{
					Session::put('locale', Input::get('lang'));
				}

			}
		}
		
	
	}

	public function gethistory()
	{
		App::setLocale(Session::get('locale', 'en'));
		$fb=LazySalesHelper::fb();
		$fbApp=LazySalesHelper::fbApp();

		$post = DB::table('posts')
                    ->where('uid', '=',$_SESSION['uid'] )
                    ->get();

		if(!empty($post))
		
			return View::make('LazySales.history',array('post' =>$post));
				
	
		else
			return Lang::get('lazysales.history_empty');
		
					
	}

	
	

}
