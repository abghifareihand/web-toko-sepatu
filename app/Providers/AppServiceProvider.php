<?php

namespace App\Providers;

use App\Repositories\Contracts\CategoryRepositoyInterface;
use App\Repositories\Contracts\OrderRepositoyInterface;
use App\Repositories\Contracts\PromoCodeRepositoyInterface;
use App\Repositories\Contracts\ShoeRepositoyInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PromoCodeRepository;
use App\Repositories\ShoeRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CategoryRepositoyInterface::class, CategoryRepository::class);
        $this->app->singleton(ShoeRepositoyInterface::class, ShoeRepository::class);
        $this->app->singleton(OrderRepositoyInterface::class, OrderRepository::class);
        $this->app->singleton(PromoCodeRepositoyInterface::class, PromoCodeRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
