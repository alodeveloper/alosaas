<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => 'web'], function () {

  Route::auth();
    Route::get('/home', 'HomeController@index');
});

Event::listen("illuminate.query", function($query, $bindings, $time, $name) {
      if (App::environment() == "development" || App::environment() == "local")
      {
          \Log::info("query executing ".$query . "\n");
          \Log::info("data binding with above query ".json_encode($bindings) . "\n");
      }
  });
