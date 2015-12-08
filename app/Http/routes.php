<?php

// main page for signup / marketing etc
Route::get('/', 'WelcomeController@index');

//
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

// App resource routes
Route::resource('Dashboard', 'DashboardController');
Route::resource('Groups', 'GroupsController');
Route::resource('Config', 'SyncConfigController'); // @todo replace with Integrations

// photo event routes
Route::resource('PhotoEvents', 'PhotoEventsController'  );
Route::group(['as' => 'PhotoEvents.'], function() {
    Route::post('PhotoEvents/{eventId}/loadExcel', ['as' => 'loadExcel', 'uses' => 'PhotoEventsController@loadExcel'] );
    Route::post('PhotoEvents/{eventId}/loadPhoto', ['as' => 'loadPhoto', 'uses' => 'PhotoEventsController@loadPhoto'] );
    Route::get('PhotoEvents/{eventId}/downloadExcel', ['as' => 'downloadExcel', 'uses' => 'PhotoEventsController@downloadExcel'] );
    Route::get('PhotoEvents/{eventId}/photo/{hashId}', ['as' => 'getPhoto', 'uses' => 'PhotoEventsController@getPhoto'] );
});

// admin routes @todo turn into resource
Route::get('Admin', function () {
    return view('admin/admin-home');
});


// testing routes -------------------------------------------- //
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

// testing
Route::get('/pi', function() {
    phpinfo();
});