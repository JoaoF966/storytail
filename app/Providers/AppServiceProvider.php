<?php

namespace App\Providers;

use App\Services\BookService;
use App\Storage\Repository\BookRepository;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(BookRepository::class, function (Application $app) {
            return new BookRepository();
        });

        $this->app->singleton(BookService::class, function (Application $app) {
            return new BookService(
                $app->make(BookRepository::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
