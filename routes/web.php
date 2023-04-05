<?php

use App\Constants\RouteConstant;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController as Auth;
use App\Http\Controllers\HomeController as Home;
use App\Http\Controllers\CategoryController as Category;
use App\Http\Controllers\BrandController as Brand;
use App\Http\Controllers\ProductModelController as ProductModel;
use App\Http\Controllers\StorageController as Storage;
use App\Http\Controllers\DashboardController as Dashboard;
use App\Http\Controllers\CartController as Cart;

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
    Route::get('change-language/{language}', [Home::class, 'changeLanguage'])->name('change_language');

    Route::controller(Auth::class)->group(function () {
        Route::get('login', 'viewLogin')->name('login');
        Route::post('login', 'login');
        Route::get('register', 'viewRegister')->name('register');
        Route::post('register', 'register');
        Route::get('logout', 'logout')->name('logout');
    });

    Route::group(['middleware' => ['check.login', 'check.role']], function () {
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
            // Route::prefix('product')->group(function () {
            //     Route::get('/', [Product::class, 'list'])->name(RouteConstant::DASHBOARD['product_list']);
            //     Route::get('create', [Product::class, 'viewCreate'])->name(RouteConstant::DASHBOARD['product_create']);
            //     Route::post('create', [Product::class, 'create']);
            //     Route::get('update', [Product::class, 'viewupdate'])->name(RouteConstant::DASHBOARD['product_update']);
            //     Route::post('update', [Product::class, 'update']);
            //     Route::get('delete', [Product::class, 'delete'])->name(RouteConstant::DASHBOARD['product_delete']);
            // });

             //PRODUCT MODEL
            Route::prefix('product-model')->group(function () {
                Route::get('/', [ProductModel::class, 'list'])->name(RouteConstant::DASHBOARD['product_model_list']);
                Route::get('create', [ProductModel::class, 'viewCreate'])->name(RouteConstant::DASHBOARD['product_model_create']);
                Route::post('create', [ProductModel::class, 'create']);
                Route::get('update', [ProductModel::class, 'viewupdate'])->name(RouteConstant::DASHBOARD['product_model_update']);
                Route::post('update', [ProductModel::class, 'update']);
                Route::get('delete', [ProductModel::class, 'delete'])->name(RouteConstant::DASHBOARD['product_model_delete']);

                //STORAGE
                Route::prefix('storage')->group(function () {
                    Route::get('/{model}', [Storage::class, 'list'])->name(RouteConstant::DASHBOARD['storage_list']);
                    Route::get('create/{model}', [Storage::class, 'viewCreate'])->name(RouteConstant::DASHBOARD['storage_create']);
                    Route::post('create/{model}', [Storage::class, 'create']);
                    Route::get('update/{model}', [Storage::class, 'viewupdate'])->name(RouteConstant::DASHBOARD['storage_update']);
                    Route::post('update/{model}', [Storage::class, 'update']);
                    Route::get('delete/{model}', [Storage::class, 'delete'])->name(RouteConstant::DASHBOARD['storage_delete']);
                });
            });
        });
    });

    Route::controller(Home::class)->group(function () {
        Route::get('/', 'index')->name('home');
        Route::get('/products', 'listProducts')->name('products');
    });
    Route::prefix('/')->group(function () {
        Route::get('/', [Home::class, 'index'])->name(RouteConstant::HOMEPAGE);
        Route::get('/home', [Home::class, 'index'])->name(RouteConstant::HOMEPAGE);
        Route::get('/products', [ProductModel::class, 'listProductModel'])->name(RouteConstant::HOME_LIST_PRODUCT);
        Route::get('/product/{id}', [ProductModel::class, 'productDetail'])->name(RouteConstant::HOME_PRODUCT_DETAIL);
        Route::get('/cart', [Cart::class, 'listCart'])->name(RouteConstant::HOME_LIST_CART);
        Route::get('/add-cart', [Cart::class, 'create'])->name(RouteConstant::HOME_ADD_CART);
    });
});
