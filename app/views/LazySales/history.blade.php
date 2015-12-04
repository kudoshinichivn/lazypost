<?php
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