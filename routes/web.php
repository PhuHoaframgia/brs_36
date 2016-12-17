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
    Route::resource('book', 'BookController');
});
Route::get('/logout', 'Auth\LoginController@logout');
Route::post('/login', 'Auth\LoginController@login');


Route::resource('list', 'User\BookController', [
    'only' => ['show']
]);

Route::get('detail/{id}', 'User\BookController@getDetail');

Route::resource('request', 'User\RequestController', [
    'only' => ['index', 'store', 'destroy']
]);
