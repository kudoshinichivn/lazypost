<?php

if(!empty($list_images_success))
{
	echo "<script type='text/javascript'> var list_images=".json_encode($list_images_success).";</script>";
	foreach ($list_images_success as $key=>$name) 
	{
		echo "
		<div class='uk-form-row'><div class='uk-grid'>
		<div class='uk-width-1-3'>
		<img style='border: 1px soild #000;' width='200' heigh='150' class='uk-border-rounded' src='../public/temp/".$name."'/>
		</div>
		<div class='uk-width-2-3'>
		<textarea style='width:100%' type='text' id='".$name."' name='".$name."' placeholder='".Lang::get('lazysales.image_decrip')."'></textarea>
		</div></div></div>
		<br>
		";
	}
}

if(!empty($list_images_fail))
foreach ($list_images_fail as $key=>$name) 
{
	echo "
	<div class='uk-form-row'><div class='uk-grid'>
	<div class='uk-width-1-3'>
	<img style='border: 1px soild #000;' width='200' heigh='150' class='uk-border-rounded' src='../public/images/alert.png'/>
	</div>
	<div class='uk-width-2-3'>
	 ".Lang::get('lazysales.could_not_uploaded_image')."<b>".$name."</b><br>
	 ".Lang::get('lazysales.reason').": ".Lang::get('lazysales.file_is_not_image')." 
	</div></div></div><br>";

}
if(!empty($list_images_fail2))
foreach ($list_images_fail2 as $key=>$name) 
{
	echo "
	<div class='uk-form-row'><div class='uk-grid'>
	<div class='uk-width-1-3'>
	<img style='border: 1px soild #000;' width='200' heigh='150' class='uk-border-rounded' src='../public/images/alert.png'/>
	</div>
	<div class='uk-width-2-3'>
	 ".Lang::get('lazysales.could_not_uploaded_image')."<b>".$name."</b><br>
	 ".Lang::get('lazysales.reason').": ".Lang::get('lazysales.file_too_heavy')." 
	</div></div></div><br>";

}