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
Route::group(['middleware' => 'login'], function () {
    Route::get('/', function() {
        return view('user.pages.login');
    });
});

Auth::routes();
Route::group(['prefix' => '/home', 'middleware'=>'user'], function () {
    Route::get('/', [
        'as' => 'user',
        'uses' => 'User\TimelineController@getTimeline',
    ]);
    Route::get('/user/{id}', [
        'as' => 'user-follow',
        'uses' => 'User\TimelineController@getTimelineUser',
    ]);
    Route::post('/follow/{id}', [
        'as' => 'follow',
        'uses' => 'User\TimelineController@postFollow',
    ]);
    Route::post('/unfollow/{id}', [
        'as' => 'unFollow',
        'uses' => 'User\TimelineController@postUnFollow',
    ]);
    Route::resource('list', 'User\BookController', [
    'only' => ['show']
    ]);
    Route::get('detail/{id}', 'User\BookController@getDetail');
    Route::resource('request', 'User\RequestController', [
        'only' => ['index', 'store', 'destroy']
    ]);
    Route::post('markLike', ['as' => 'markLike', 'uses'=> 'User\LikeController@markLike']);
    Route::post('markbook', ['as' => 'markBook', 'uses'=> 'User\MarkController@markBook']);
    Route::post('rateBook', ['as' => 'rateBook', 'uses'=> 'User\RateController@rateBook']);
    Route::post('delComment/{id}', ['as' => 'delComment', 'uses'=> 'User\CommentController@delete']);
    Route::post('editComment/{id}', ['as' => 'editComment', 'uses'=> 'User\CommentController@update']);
    Route::post('delReview/{id}', ['as' => 'delReview', 'uses'=> 'User\ReviewController@delete']);
    Route::post('editReview/{id}', ['as' => 'editReview', 'uses'=> 'User\ReviewController@update']);
    Route::post('likeAction', ['as' => 'likeAction', 'uses'=> 'User\LikeController@likeAction']);
    Route::resource('review', 'User\ReviewController', [
        'only' => ['store']
    ]);
    Route::resource('comment', 'User\CommentController', [
        'only' => ['store']
    ]);
    Route::resource('user', 'User\UsersController', ['only' => ['edit', 'update']]);
    Route::get('/search', 'User\SearchController@search');
});

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
    Route::resource('review', 'ReviewController', ['only' => ['index', 'destroy']]);
    Route::resource('request', 'BookRequestController', ['only' => ['index', 'destroy', 'update']]);
});
Route::get('/logout', 'Auth\LoginController@logout');
Route::post('/login', 'Auth\LoginController@login');
