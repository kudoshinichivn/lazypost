<?php
session_start();
App::setLocale(Session::get('locale', 'en'));
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


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
Route::post('/create_album','AlbumController@create_album');