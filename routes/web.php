<?php

use App\Http\Controllers\LogFileController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [LoginController::class,'login'])->name('login');
Route::post('/login-post', [LoginController::class,'login'])->name('login-post');


Route::get('/', function() {
//    request()->session()->forget('authenticated');
    return view('logfile');
})->middleware('custom_auth')->name('logfile');

Route::post('/log-file-post', [LogFileController::class,'file'])
    ->name('log-file-post')->middleware('custom_auth');
