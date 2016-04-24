<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', array(
	'uses' => 'UserController@index',
	'as' => 'home',
));

//Route::get('user', array('uses' => 'UserController@user'));
Route::get('user/login', array(
	'uses' => 'UserController@login',
	'as' => 'auth.login',

));

Route::get('user/logout', array(
	'uses' => 'UserController@logout',
	'as' => 'auth.logout',
));

Route::post('user/linkedin_complete', array(
	'before' => 'csrf',
	'as' => 'linkedin_complete_post',
	'uses' => 'UserController@linkedinCompletePost',
));
Route::get('users', array('uses' => 'UserController@users'));

Route::get('timeline', array(
	'uses' => 'TimelineController@getIndex',
	'as' => 'timeline.index',
	'middleware' => ['auth'],
));


/******** SEARCH ********/
Route::get('search', array(
	'uses' => 'SearchController@getResults',
	'as' => 'search.results',
	'middleware' => ['auth'],
));

/******** PROFILE ********/
Route::get('user/{id}', array(
	'uses' => 'ProfileController@getProfile',
	'as' => 'profile.index',
	'middleware' => ['auth'],
));

/******** FOLLOWERS ********/
Route::get('followers', array(
	'uses' => 'FollowerController@getIndex',
	'as' => 'followers.index',
	'middleware' => ['auth'],
));
Route::get('followers/add/{id}', array(
	'uses' => 'FollowerController@follow',
	'as' => 'follower.add',
	'middleware' => ['auth'],
));
Route::get('followers/acknowledge/{id}', array(
	'uses' => 'FollowerController@acknowledge',
	'as' => 'follower.acknowledge',
	'middleware' => ['auth'],
));

/******** STATUSES ********/
Route::post('status', array(
	'uses' => 'PostController@postStatus',
	'as' => 'status.post',
	'middleware' => ['auth'],
));
Route::post('event', array(
	'uses' => 'PostController@postEvent',
	'as' => 'event.post',
	'middleware' => ['auth'],
));
Route::post('publication', array(
	'uses' => 'PostController@postPublication',
	'as' => 'publication.post',
	'middleware' => ['auth'],
));