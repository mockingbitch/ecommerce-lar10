<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Brand;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $models = [
            'User',
            'Category',
            'Brand',
            'Product'
        ];

        foreach ($models as $model) {
            $this->app->bind("App\Repositories\\Contracts\\Interface\\{$model}RepositoryInterface", "App\Repositories\\Contracts\\Repository\\{$model}Repository");
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        view()->composer('layouts.homeLayout', function($view){
            // $customer = Auth::guard('customer')->user();
            $categories = Category::where('status', 1)->get();
            $brands     = Brand::where('status', 1)->get();
            // $carts = session()->get('cart');
            // $cartQuantity = 0;
            // if (isset($carts)){
            //     $cartQuantity = count($carts);
            // }
            view()->share([
                // 'cartQuantity'=>$cartQuantity,
                // 'carts'=>$carts,
                // 'customer' => $customer,
                'categories' => $categories,
                'brands' => $brands
            ]);
        });
    }
}
