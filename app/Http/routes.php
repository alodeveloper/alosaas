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

Route::bind('accounts', function($subdomain) {
  return App\Account::where('subdomain', $subdomain)->first();
});

Route::group(['middleware' => 'web'], function () {

    Route::get('/', function () {
        return view('welcome');
    });
    Route::auth();
    Route::group(['middleware' => 'auth'], function() {
      //Route::get('/home', 'HomeController@index');
      Route::get('/account/change', 'AccountController@change');
      Route::get('/account/register', 'AccountController@create');
      Route::post('/account/register', 'AccountController@store');

      Route::group(['prefix' => 'accounts/{accounts}'], function () {
      //Route::group(['domain' => '{accounts}.alotracker.dev'], function() {
        Route::get('/', 'AccountController@dashboard');
        Route::resource('user', 'UserController');
      });
    });
});

Event::listen("illuminate.query", function($query, $bindings, $time, $name) {
      if (App::environment() == "development" || App::environment() == "local")
      {
          \Log::info("query executing ".$query . "\n");
          \Log::info("data binding with above query ".json_encode($bindings) . "\n");
      }
  });
