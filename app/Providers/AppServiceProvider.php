<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
    }
}
