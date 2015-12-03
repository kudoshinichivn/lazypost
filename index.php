<?php
session_start();
if(isset($_SESSION))
{
	echo '<pre>';
	print_r($_SESSION);
	echo '<pre>';
	$_SESSION=array();

}	
?>