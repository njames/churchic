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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('debug', function(){

  $a = [1,2,3,4,5];

  array_pop($a);

  return 'hello xDebug';


});


// domain routing
Route::group(['domain'=>'{clientId}.churchic.local'], function()
{

  Route:get('test', function($clientId){
    return 'Hello ' .$clientId;
  });

});



Route::get('/dashboard', 'DashboardController@index');


Route::get('/config', 'SyncConfigController@index');