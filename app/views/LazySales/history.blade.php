<div style='font-size:12px;'><ul style='list-style:none;'>
<?php



foreach($post as $row)
{	
	

	 $datetime=LazySalesHelper::convert_time($row->datetime,'GMT',$target_timezone);

	
	if($row->schedule!="0000-00-00 00:00:00")
	{
		
		$schedule=LazySalesHelper::convert_time($row->schedule,'GMT',$target_timezone);
		?>
			<li><i class='uk-icon-clock-o'></i> {{$datetime}}<br>
				<i class='uk-icon-share-square-o'></i>{{Lang::get('lazysales.you_scheduled_a')." ".Lang::get('lazysales.'.$row->type)." ".Lang::get('lazysales.at')." ".$schedule}}
			</li>
		<?php
		
		
		
	}
	else
	{
		?>
			<li><i class='uk-icon-clock-o'></i> {{$datetime}}<br>
				<i class='uk-icon-share-square-o'></i>{{Lang::get('lazysales.you_published_a')." ".Lang::get('lazysales.'.$row->type)}}
			</li>
		<?php
	}

	
}

?>
</ul></div>