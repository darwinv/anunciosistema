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

Route::get('/',[
	'uses'  =>  'siteController@home',
	'as'   =>  'siteHome',
]);

//Route::group(["prefix"=>"admin","middleware"=>'auth'],function(){
Route::group(["prefix"=>"admin"],function(){	
	
	Route::get("/",[
		'uses'   =>  'siteController@panel',
		'as'    =>  'panelSite',
	]);

	Route::get("/configuration",[
		'uses'   =>  'siteController@configuration',
		'as'    =>  'configurationSite',
	]);

	/***Inicio Resources***/
	Route::resource("users","usersController");

	Route::resource("categories","categoriesController");

	Route::resource("publications","publicationsController");
	/***Final Resources***/

});

Route::resource("users","usersController");
//Route::resource("publications","publicationsController");
Route::get('publications/create',[
				'uses'        => 'publicationsController@create',
				'as'          => 'publications.create',
				'middleware'  => 'auth'
]);

Route::post('publications/create',[
				'uses'        => 'publicationsController@store',
				'as'          => 'publications.create.post',
				'middleware'  => 'auth'
]);
Route::get('publications/view/{id}',[
				'uses'   => 'publicationsController@show',
				'as'     => 'publications.show'
]);
Route::get('admin/auth/login',[
				'uses'   => 'Auth\AuthController@getLogin',
				'as'     => 'admin.auth.get.login'
]);

Route::post('admin/auth/login',[
				'uses'   => 'Auth\AuthController@postLogin',
				'as'     => 'admin.auth.post.login'
]);

Route::post('auth/login',[
				'uses'   => 'Auth\AuthController@postLogin',
				'as'     => 'auth.post.login'
]);

Route::get('admin/auth/logout',[
				'uses'   => 'Auth\AuthController@getLogout',
				'as'     => 'admin.auth.get.logout'
]);

Route::get('auth/logout',[
				'uses'   => 'usersController@getLogout',
				'as'     => 'auth.get.logout'
]);

Route::get('auth/register',[
				'uses'   => 'Auth\AuthController@getRegister',
				'as'     => 'auth.get.register'
]);

Route::post('auth/register',[
				'uses'   => 'usersController@postRegister',
				'as'     => 'auth.post.register'
]);

Route::get('publications/listado/{category?}/{word?}',[
				'uses' => 'PublicationsController@listado',
				'as'   => 'publications.listado'
]);