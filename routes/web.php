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

Route::resource('questions', 'QuestionController');

// Answers Routes:
Route::post('questions/{question}','AnswersController@store');

Route::get('question/{qid}/answers/{id}/edit','AnswersController@edit');
Route::post('question/{qid}/answers/{id}/edit','AnswersController@update');
Route::get('answers/{id}/delete','AnswersController@destroy');


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
