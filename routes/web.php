<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\GameUserController;
use App\Http\Controllers\UserController;

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

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/games/{id}',[GameController::class,'details'])->name('game.details');
Route::get('/games',[GameController::class,'index'])->name('game.index');
Route::get('/publisher/{id}',[PublisherController::class,'details'])->name('publisher.details');
Route::get('/genre/{id}',[GenreController::class,'games'])->name('genre.games');
Route::get('/platform/{id}',[PlatformController::class,'games'])->name('platform.games');
Route::post('submit-game-user',[GameUserController::class,'create']);
Route::get('get-game-user',[GameUserController::class,'store']);
Route::post('register',[UserController::class,'register'])->name('user.register');
Route::get('logout',[UserController::class,'logout'])->name('user.logout');
Route::post('login',[UserController::class,'login'])->name('user.login');
