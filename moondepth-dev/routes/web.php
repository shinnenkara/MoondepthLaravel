<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', 'WelcomeController@index')->name('welcome.index');

Route::get('/about', 'AboutController@index')->name('about.index');
Route::get('/help', 'HelpController@index')->name('help.index');
Route::get('/rules', 'RulesController@index')->name('rules.index');

Route::get('/search', 'SearchController@back')->name('search.back');
Route::post('/search', 'SearchController@index')->name('search.index');

Route::get('/board/{board}', 'BoardController@show')->name('board.show');
Route::post('/board/{board}', 'BoardController@store')->name('board.store');

Route::get('/board/{board}/thread/{thread}', 'ThreadController@show')->name('thread.show');
Route::post('/board/{board}/thread/{thread}', 'ThreadController@store')->name('thread.store');

Route::post('/board/{board}/thread/{thread}/message/all', 'MessageController@all')->name('message.all');
Route::post('/board/{board}/thread/{thread}/message/{message}/get', 'MessageController@get')->name('message.get');

Route::post('/board/{board}/thread/{thread}/event/new-message', 'ThreadController@newMessageEvent')->name('thread.event.new-message');
