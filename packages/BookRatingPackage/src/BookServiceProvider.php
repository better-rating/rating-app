<?php

namespace BetterRating\BookRatingPackage;

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
                    __DIR__ . '/../database/migrations/create_books_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_posts_table.php'),
                    // you can add any number of migrations here
                ], 'migrations');
            }
        }
    }
}
