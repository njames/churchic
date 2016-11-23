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

// update membership type 
Route::get('/individuals', 'IndividualController@index');
Route::post('/individuals/updatetype', ['as' => 'updateType', 'uses' => 'IndividualController@updateType']);

Route::get('/', 'WelcomeController@index');
//Route::get('home', 'HomeController@index');

Route::get('/home', ['middleware' => 'auth', function () {

    return view('home');
}]);

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

// groups routes
Route::get('groups', 'GroupsController@index');
Route::get('groups/{id}', 'GroupsController@show');

Route::get('/dashboard', 'DashboardController@index');

// domain routing
Route::group(['domain' => '{clientId}.churchic.local'], function () {

  Route:get('test', function ($clientId) {
    return 'Hello '.$clientId;
  });

});

Route::get('/config', 'SyncConfigController@index');


Route::get('event', function () { //'EventController@index');

//  return getenv('EVENTBRITE_KEY');

  $eventbrite = new \Sqrc\Eventbrite\Eventbrite( getenv('EVENTBRITE_OAUTH'));

//  dd($eventbrite);
//   $events = $eventbrite->users(array('id'=> 'me') );
//    $events = $eventbrite->users(['id'=> 'me/owned_events', ] );
//    $events = $eventbrite->events(['id'=> '18045071294/attendees/', ] );

    $events = $eventbrite->users(array('id'=> '563152524') );


  dd($events);
});



// admin routes
Route::get('admin', function () {
    return view('admin/admin-home');
});



// photo event routes
Route::resource('PhotoEvents', 'PhotoEventsController'  );
Route::group(['as' => 'PhotoEvents.'], function() {
    Route::post('PhotoEvents/{eventId}/loadExcel', ['as' => 'loadExcel', 'uses' => 'PhotoEventsController@loadExcel'] );
    Route::post('PhotoEvents/{eventId}/loadPhoto', ['as' => 'loadPhoto', 'uses' => 'PhotoEventsController@loadPhoto'] );
    Route::get('PhotoEvents/{eventId}/downloadExcel', ['as' => 'downloadExcel', 'uses' => 'PhotoEventsController@downloadExcel'] );
    Route::get('PhotoEvents/{eventId}/photo/{hashId}', ['as' => 'getPhoto', 'uses' => 'PhotoEventsController@getPhoto'] );

});


// config
Route::get('/pi', function() {
    phpinfo();
});








