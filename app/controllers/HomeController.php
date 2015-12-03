<?php

class HomeController extends BaseController {

	public static function save(){
		date_default_timezone_set('GMT');
		$datetime=date("Y-m-d H:i:s");
		$type="";
		$image="NULL";
		$schedule="0000-00-00 00:00:00";

		if(Input::has('schedule'))
		{
			$local_timezone=Config::get('timezone.'.Input::get('timezone'));
			$time=Input::has('schedule');
			$target_timezone="GMT";
			$schedule=LazySalesHelper::convert_time($time,$local_timezone,$target_timezone);
		}

		if(!empty(Input::get('image')))
		{
			$type = "image";
			$image=Session::get('image');
		}

			
		if(empty(Input::get('image'))&&!empty(Input::get('link')))
			$type = "link";
		if(empty(Input::get('image')) && empty(Input::get('link')) &&!empty(Input::get('message')))
			$type = "message";
		
		if(!empty(Input::get('album')))
		{
			$type = "album";
			
		}

		$result=DB::table('posts')->insert(array(
												'pid'=>'NULL',
												'uid' => $_SESSION["uid"],
												'datetime'=>$datetime,
												'type'=>$type,
												'node'=>json_encode(Input::get('node_list')),
												'image'=>$image,
												'link'=>Input::get('link'),
												'message'=>Input::get('message'),
												'schedule'=>$schedule
												)
									);
		echo $result;
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
			return View::make('LazySales.index');
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
		{	
			$local_timezone="GMT";	
			$target_timezone=Config::get('timezone.'.Input::get('timezone'));

			foreach($post as $row)
			{	
				
				
				 $time=$row->datetime;
				
				 $datetime=LazySalesHelper::convert_time($time,$local_timezone,$target_timezone);

				 $schedule_time=$row->schedule;

			
				echo "<div style='font-size:12px;'><ul style='list-style:none;'>";
				if($schedule_time!="0000-00-00 00:00:00")
				{
					
					$schedule=LazySalesHelper::convert_time($schedule_time,$local_timezone,$target_timezone);
					
					if($row->type=="image")
						echo "<li><i class='uk-icon-clock-o'></i> ".$datetime."<br><i class='uk-icon-share-square-o'></i>".Lang::get('lazysales.you_scheduled_a_image')." ".$schedule."</li>";
				
					if($row->type=="message")
						echo "<li><i class='uk-icon-clock-o'></i> ".$datetime."<br><i class='uk-icon-share-square-o'></i>".Lang::get('lazysales.you_scheduled_a_message')." ".$schedule."</li>";
					
					if($row->type=="link")
						echo "<li><i class='uk-icon-clock-o'></i> ".$datetime."<br><i class='uk-icon-share-square-o'></i>".Lang::get('lazysales.you_scheduled_a_link')." ".$schedule."</li>";
					
					
				}
				else
				{
					if($row->type=="image")
					echo "<li><i class='uk-icon-clock-o'></i> ".$datetime."<br><i class='uk-icon-share-square-o'></i>".Lang::get('lazysales.you_published_a_image')."</li>";
				
					if($row->type=="message")
						echo "<li><i class='uk-icon-clock-o'></i> ".$datetime."<br><i class='uk-icon-share-square-o'></i>".Lang::get('lazysales.you_published_a_message')."</li>";
					
					if($row->type=="link")
						echo "<li><i class='uk-icon-clock-o'></i> ".$datetime."<br><i class='uk-icon-share-square-o'></i>".Lang::get('lazysales.you_published_a_link')."</li>";
					
					if($row->type=="album")
						echo "<li><i class='uk-icon-clock-o'></i> ".$datetime."<br><i class='uk-icon-share-square-o'></i>".Lang::get('lazysales.you_published_a_album')."</li>";
				}

				
				echo "</ul></div>";

				
				
				
				
			}
				
		}
		else
			echo "<h3 class='tittle'>".Lang::get('lazysales.history_empty')."</h3>";
		
					
	}

	
	

}
