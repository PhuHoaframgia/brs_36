<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('user.pages.login');
});
Auth::routes();
Route::get('/home', 'HomeController@index');
Route::get('/custom-register',[
    'as' => 'register',
    'uses' => 'User\RegisterController@index',
]);
Route::post('/custom-register',[
    'as' => 'register',
    'uses' => 'User\RegisterController@register',
]);
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::resource('category', 'CategoryController');
    Route::resource('user', 'UserController');
    Route::resource('author', 'AuthorController');
});
Route::get('/logout', 'Auth\LoginController@logout');
Route::post('/login', 'Auth\LoginController@login');


Route::get('list/{id}', 'User\BookController@getAllBook');

Route::get('detail/{id}', ['as' => 'Detail', 'uses'=> 'User\BookController@getDetail']);

Route::get('request', 'User\RequestController@getAllRequest');

Route::get('delrequest/{id}', ['as' => 'getDelete', 'uses' => 'User\RequestController@destroy']);

Route::resource('addrequest', 'User\RequestController', [
         'only' => ['store']
     ]);

