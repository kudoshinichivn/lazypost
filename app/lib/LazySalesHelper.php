<?php

class LazySalesHelper{

	public static function convert_time($time,$local_timezone,$target_timezone)
		{
			date_default_timezone_set($local_timezone);
			$datetime = new DateTime($time);
			$timezone = new DateTimeZone($target_timezone);
			return $datetime->setTimeZone($timezone)->format('Y-m-d H:i');
		}
	public static function fb(){
		$fb=new Facebook\Facebook([
								'app_id' => Config::get('facebook.app_id'),
								'app_secret' => Config::get('facebook.app_secret'),
								'default_graph_version' => 'v2.4',]);
		return $fb;
	}

	public static function fbApp(){
		$fbApp = new Facebook\FacebookApp(Config::get('facebook.app_id'), Config::get('facebook.app_secret'));
		return $fbApp;
	}
}