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

Route::get('test/{hash}', 'QuestionController@test');

Route::post('test', 'QuestionController@store');

Route::get('/', function () {
    return view('welcome');
});

Route::get('exampleData', 'UpdateDataController@addExample');

Route::post('mailchimp', 'QuestionController@mailchimp');


