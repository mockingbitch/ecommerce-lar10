<?php

use App\Constants\RouteConstant;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController as Auth;
use App\Http\Controllers\HomeController as Home;
use App\Http\Controllers\CategoryController as Category;
use App\Http\Controllers\BrandController as Brand;
use App\Http\Controllers\ProductController as Product;
use App\Http\Controllers\DashboardController as Dashboard;

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
        Route::get('logout', 'logout')->name('logout');
    });

    Route::prefix('admin')->group(function () {
        Route::get('/', [Dashboard::class, 'index'])->name(RouteConstant::DASHBOARD['home']);

        // CATEGORY
        Route::prefix('category')->group(function () {
            Route::get('/', [Category::class, 'list'])->name(RouteConstant::DASHBOARD['category_list']);
            Route::get('create', [Category::class, 'viewCreate'])->name(RouteConstant::DASHBOARD['category_create']);
            Route::post('create', [Category::class, 'create']);
            Route::get('update', [Category::class, 'viewupdate'])->name(RouteConstant::DASHBOARD['category_update']);
            Route::post('update', [Category::class, 'update']);
            Route::get('delete', [Category::class, 'delete'])->name(RouteConstant::DASHBOARD['category_delete']);
        });

        //BRAND
        Route::prefix('brand')->group(function () {
            Route::get('/', [Brand::class, 'list'])->name(RouteConstant::DASHBOARD['brand_list']);
            Route::get('create', [Brand::class, 'viewCreate'])->name(RouteConstant::DASHBOARD['brand_create']);
            Route::post('create', [Brand::class, 'create']);
            Route::get('update', [Brand::class, 'viewupdate'])->name(RouteConstant::DASHBOARD['brand_update']);
            Route::post('update', [Brand::class, 'update']);
            Route::get('delete', [Brand::class, 'delete'])->name(RouteConstant::DASHBOARD['brand_delete']);
        });

        //PRODUCT
        Route::prefix('product')->group(function () {
            Route::get('/', [PRODUCT::class, 'list'])->name(RouteConstant::DASHBOARD['product_list']);
            Route::get('create', [PRODUCT::class, 'viewCreate'])->name(RouteConstant::DASHBOARD['product_create']);
            Route::post('create', [PRODUCT::class, 'create']);
            Route::get('update', [PRODUCT::class, 'viewupdate'])->name(RouteConstant::DASHBOARD['product_update']);
            Route::post('update', [PRODUCT::class, 'update']);
            Route::get('delete', [PRODUCT::class, 'delete'])->name(RouteConstant::DASHBOARD['product_delete']);
        });
    });

    Route::controller(Home::class)->group(function () {
        Route::get('/', 'index')->name('home');
    });
});
