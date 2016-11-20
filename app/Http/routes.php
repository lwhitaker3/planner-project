<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// Route::get('/', function () {
//     return view('welcome');
// });
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

Route::group(['middleware' => ['web'],
              'prefix' => 'systematize'], function () {

  Route::get('/', function () {
    return view('welcome');
  })->middleware('guest');

  Route::get('/planner', 'TaskController@index');
  Route::post('/planner', 'TaskController@store');
  Route::delete('/planner/task/{task}', 'TaskController@destroy');
  Route::post('/planner/task/{task}', 'TaskController@edit');

  Route::get('/tasks', 'TaskController@index2');
  Route::post('/task', 'TaskController@store2');
  Route::delete('/task/{task}', 'TaskController@destroy2');
  Route::post('/task/{task}', 'TaskController@editComplete');
  Route::post('/taskedit/{task}', 'TaskController@editTask');

  Route::get('/notes', 'NoteController@index');
  Route::post('/note', 'NoteController@store');
  Route::delete('/note/{note}', 'NoteController@destroy');
  Route::post('/note/{note}', 'NoteController@edit');

  Route::get('/categories', 'MainController@index');
  Route::post('/category', 'MainController@store');
  Route::delete('/category/{category}', 'MainController@destroy');
  Route::post('/category/{category}', 'MainController@edit');

  Route::get('/reminders', 'ReminderController@index');
  // Route::get('/task/{task}/reminders', 'ReminderController@index');
  Route::post('/reminder', 'ReminderController@store');
  Route::delete('/reminder/{reminder}', 'ReminderController@destroy');
  Route::post('/reminder/{reminder}', 'ReminderController@edit');

  Route::get('/daily_note', 'DailyController@index');
  Route::post('/daily_note', 'DailyController@store');

  Route::auth();
});
