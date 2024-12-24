<?php

namespace App\Providers;

use App\Services\AgeGroupService;
use App\Services\AuthorService;
use App\Services\BookService;
use App\Services\TagService;
use App\Storage\Repository\AgeGroupRepository;
use App\Storage\Repository\AuthorsRepository;
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
        $this->app->singleton(AgeGroupRepository::class, function (Application $app) {
            return new AgeGroupRepository();
        });

        $this->app->singleton(AgeGroupService::class, function (Application $app) {
            $ageGroupRepository = $app->make(AgeGroupRepository::class);

            return new AgeGroupService(
                $ageGroupRepository,
                $ageGroupRepository,
            );
        });

        $this->app->singleton(BookRepository::class, function (Application $app) {
            return new BookRepository();
        });

        $this->app->singleton(BookService::class, function (Application $app) {
            return new BookService(
                $app->make(BookRepository::class),
                $app->get(BookRepository::class),
                $app->get(AgeGroupRepository::class),
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

        $this->app->singleton(AuthorsRepository::class, function (Application $app) {
            return new AuthorsRepository();
        });

        $this->app->singleton(AuthorService::class, function (Application $app) {
            $authorRepository = $app->make(AuthorsRepository::class);

            return new AuthorService(
               $authorRepository,
               $authorRepository,
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
