<?php

foreach ($data as $key=>$value) 
{
	if($where=="group")
		echo "
			<tr><td><label>
			<input type='checkbox' name='".$value['id']."' value='".$value['id']."' id='".$value['id']."'/> &nbsp 
			<a style='color:#000;font-size:12px;' target='_blank' href='https://facebook.com/".$value['id']."'>
			<img width='30px' heigh='30px' class='uk-border-circle' src='http://localhost/lazysales/public/images/group_icon.png'/>".$value['name']."
			</a> </label></td></tr>";
	else
		echo "
			<tr><td><label><input type='checkbox' name='".$value['access_token']."' value='".$value['id']."' id='".$value['id']."'/> &nbsp 
			<a target='_blank'style='color:#000; font-size:12px;' href='https://facebook.com/".$value['id']."' alt='".$value['name']."'><img width='30px' heigh='30px' class='uk-border-circle' src='https://graph.facebook.com/".$value["id"]."/picture?width=100&height=100'/>".$value['name']."
			</a> </label></td></tr>";
}
