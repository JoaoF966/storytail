<?php

namespace App\Providers;

use App\Services\BookService;
use App\Services\TagService;
use App\Storage\Repository\BookRepository;
use App\Storage\Repository\TagRepository;
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

        $this->app->singleton(TagRepository::class, function (Application $app) {
            return new TagRepository();
        });

        $this->app->singleton(TagService::class, function (Application $app) {
            $tagRepository = $app->make(TagRepository::class);

            return new TagService(
               $tagRepository,
               $tagRepository,
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
