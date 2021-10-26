<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RulesController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
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

require __DIR__.'/auth.php';
require __DIR__.'/webauthn.php';

Route::get('/', [WelcomeController::class, 'index'])
    ->name('welcome.index');

Route::get('/about', [AboutController::class, 'index'])
    ->name('about.index');
Route::get('/help', [HelpController::class, 'index'])
    ->name('help.index');
Route::get('/rules', [RulesController::class, 'index'])
    ->name('rules.index');

Route::get('/search', [SearchController::class, 'back'])
    ->name('search.back');
Route::post('/search', [SearchController::class, 'index'])
    ->name('search.index');

Route::get('/board/{board}', [BoardController::class, 'show'])
    ->name('board.show');
Route::post('/board/{board}', [BoardController::class, 'store'])
    ->name('board.store');

Route::get('/board/{board}/thread/{thread}', [ThreadController::class, 'show'])
    ->name('thread.show');
Route::post('/board/{board}/thread/{thread}', [ThreadController::class, 'store'])
    ->name('thread.store');

Route::post('/board/{board}/thread/{thread}/event/new-message', [ThreadController::class, 'newMessageEvent'])
    ->name('thread.event.new-message');

Route::post('/board/{board}/thread/{thread}/message/all', [MessageController::class, 'all'])
    ->name('message.all');
Route::post('/board/{board}/thread/{thread}/message/{message}/get', [MessageController::class, 'get'])
    ->name('message.get');

Route::get('/user/{username}', [UserController::class, 'show'])
    ->middleware('auth')
    ->name('user.show');
