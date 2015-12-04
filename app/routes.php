<?php
session_start();
App::setLocale(Session::get('locale', 'en'));


Route::get('/test', function(){

	$schedule=LazySalesHelper::convert_time('2015/12/04 12:30',Config::get('timezone.+7'),'GMT');
	return $schedule;
});

//Facebook


Route::get('/login', 'FacebookController@login');

Route::get('/callback', 'FacebookController@callback');

Route::get('/data/{where}', 'FacebookController@getdata');




//Home
Route::get('/', 'HomeController@index');
Route::get('/logout', 'HomeController@logout');
Route::post('/lang','HomeController@setlang');
Route::post('/history', 'HomeController@gethistory');
Route::post('/save','HomeController@save');

//Upload
Route::post('/upload_image','UploadController@upload');
Route::post('/upload_album','UploadController@upload_album');




//Post
Route::post('/post/{type}','PostController@post');


//Create album
Route::post('/create_album','AlbumController@create_album');


