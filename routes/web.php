<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController as Auth;
use App\Http\Controllers\HomeController as Home;

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


Route::group(['middleware' => 'locale'], function() {
    Route::get('change-language/{language}', [Home::class, 'changeLanguage'])->name('user.change-language');

    Route::controller(Auth::class)->group(function () {
        Route::get('login', 'viewLogin')->name('login');
        Route::post('login', 'login');
        Route::get('register', 'viewRegister')->name('register');
        Route::post('register', 'register');
    });
});
