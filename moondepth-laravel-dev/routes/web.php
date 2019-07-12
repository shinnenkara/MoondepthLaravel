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

Auth::routes();

Route::get('/', 'WelcomeController@index')->name('welcome.index');

Route::get('/board/{board}', 'BoardController@show')->name('board.show');

Route::get('/board/{board}/thread/{thread}', 'ThreadController@show')->name('thread.show');
