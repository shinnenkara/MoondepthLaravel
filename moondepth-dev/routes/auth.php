<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/login', 'Auth\LoginController@index')->name('auth.login.index');
Route::get('/register', 'Auth\RegisterController@index')->name('auth.register.index');
