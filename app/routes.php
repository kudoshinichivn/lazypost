<?php
session_start();
App::setLocale(Session::get('locale', 'en'));


Route::get('/test', function(){

	// if(Session::has('image'))
	// 	Session::forget('image');
	
	// Session::put('image', Input::get('value'));
	return Session::get('image');
});

//Facebook


Route::get('/login', 'FacebookController@login');

Route::get('/callback', 'FacebookController@callback');

Route::get('/data/{where}', 'FacebookController@getdata');

// Route::get('/group',function(){
// 	$where='group';
// 	FacebookController::getdata($where);
// });




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
Route::post('/create_album',function(){
	$input=Input::all();
		echo "<pre>";
		print_r($input);
		echo "<pre>";
});


