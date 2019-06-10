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
    return redirect('/stories');
});
Route::get('/home', function () {
    return redirect('/stories');
});

Auth::routes();

Route::match(['put','patch'],'/follow/{id}','UserController@follow')->name('follow');
Route::get('/followers/{id}','UserController@followers')->name('followers');
Route::resource('/users','UserController');
Route::resource('/stories','StoryController');
Route::get('/keywords/top','KeywordController@top');
Route::resource('/keywords','KeywordController');
Route::get('/sentences/create/{sentence_id}','SentenceController@create')->name('sentences.create.special');
Route::resource('/sentences','SentenceController')->except('create');
Route::resource('/comments','CommentController')->except('create','index','destroy');
Route::resource('/rating','RateablesController');
