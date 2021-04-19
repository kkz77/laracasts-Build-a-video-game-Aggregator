<?php

use App\Http\Controllers\GamesController;
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
Route::get('/', [GamesController::class,'index'])->name('game.index');
Route::get('/game/{slug}',[GamesController::class,'show'])->name('game.show');

// Route::get('/', function () {
//     return view('index');
// });

// Route::get('/show', function () {
//     return view('show');
// });
