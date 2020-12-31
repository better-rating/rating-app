<?php

namespace BetterRating\BookRatingPackage;

use BetterRating\BookRatingPackage\Models\Book;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class BookServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'bookratingpackage');

        $file = __DIR__ . '/helpers.php';
        if (file_exists($file)) {
            require_once($file);
        };
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'bookratingpackage');

        if ($this->app->runningInConsole()) {
            // Export the migration
            if (!class_exists('CreateBooksTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_books_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_posts_table.php'),
                    // you can add any number of migrations here
                ], 'migrations');
            }
        }

        Route::bind('book', function ($value, $route) {
            return $this->getModel(Book::class, $value, 'slug');
        });
    }

    private function getModel($model, $routeKey, $type)
    {
        $modelInstance = resolve($model);

        if ($type === 'hashid') {
            $id = Hashids::connection($model)->decode($routeKey)[0] ?? null;
            return $modelInstance->findOrFail($id);
        }
        if ($type === 'slug') {
            return $modelInstance->where('slug', $routeKey)->firstOrFail();
        }
        if ($type === 'id') {
            return $modelInstance->findOrFail($routeKey);
        }
    }
}
