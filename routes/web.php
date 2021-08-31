<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::get('cluster/json', 'ClusternameController@json');

Auth::routes();

//Route::get('/dasboard', 'DasboardController@index')->name('dasboard');

Route::get('/clustername', 'ClusternameController@index')->name('clustername')->middleware('auth');
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/sms/{id}', 'SmsController@index');
Route::get('/sms', 'SmsController@index');
Route::get('/sms', 'SmsController@download')->name('download')->middleware('auth');


Route::POST('/sms-send', 'SmsController@post_sms')->name('post_sms')->middleware('auth');
Route::POST('/send-message', 'SmsController@send')->name('send')->middleware('auth');
Route::POST('/send-user', 'SmsController@send_user')->name('send_user')->middleware('auth');
Route::GET('/send-feedback', 'SmsController@send_feedback')->name('send_feedback')->middleware('auth');
Route::GET('/send-all-user', 'SmsController@send_all')->name('send_all')->middleware('auth');

//Route::GET('api/ens', 'SmsController@apiEns')->name('api.ens');

Route::get('/reciver', 'ReciverController@index')->name('reciver')->middleware('auth');
Route::get('/feedback', 'ReciverController@feedback')->name('feedback')->middleware('auth');
Route::get('/user-edit/{id}', 'HomeController@show')->name('user.show')->middleware('auth');
Route::put('/user-edit/{id}', 'HomeController@edit')->name('user.edit')->middleware('auth');
Route::delete('/user-delete/{id}', 'HomeController@delete')->name('user.delete')->middleware('auth');

Route::get('/auth/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('/auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');

//reciver date
Route::get('/reciver-date', 'ReciverDateController@index')->name('reciver_date')->middleware('auth');
Route::get('/reciver-date/{date}', 'ReciverDateController@show')->name('reciver_date_show')->middleware('auth');

//feedback date
Route::get('/feedback-date', 'FeedbackDateController@index')->name('feedback_date')->middleware('auth');         
Route::get('/feedback-date/{date}', 'FeedbackDateController@show')->name('feedback_date_show')->middleware('auth');

// Route::get('/feedback-date', 'FeedbackController@index')->middleware('auth');
// Route::get('/feedback-date/{date}', 'FeedbackController@search')->name('feedback_date_show')->middleware('auth');