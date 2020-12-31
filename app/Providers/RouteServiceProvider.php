<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Episode;
use App\Models\Movie;
use App\Models\Profile;
use App\Models\Rating;
use App\Models\RatingPartial;
use App\Models\Season;
use App\Models\Show;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Vinkla\Hashids\Facades\Hashids;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Route::bind('user', function ($value, $route) {
            return $this->getModel(User::class, $value, 'hashid');
        });
        Route::bind('rating-partial', function ($value, $route) {
            return $this->getModel(RatingPartial::class, $value, 'hashid');
        });
        Route::bind('rating', function ($value, $route) {
            return $this->getModel(Rating::class, $value, 'hashid');
        });
        Route::bind('profile', function ($value, $route) {
            return $this->getModel(Profile::class, $value, 'hashid');
        });
        Route::bind('movie', function ($value, $route) {
            return $this->getModel(Movie::class, $value, 'slug');
        });
        Route::bind('show', function ($value, $route) {
            return $this->getModel(Show::class, $value, 'slug');
        });
        Route::bind('season', function ($value, $route) {
            return $this->getModel(Season::class, $value, 'slug');
        });
        Route::bind('episode', function ($value, $route) {
            return $this->getModel(Episode::class, $value, 'slug');
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        Route::prefix('data')
             ->middleware(['web','auth'])
             ->namespace($this->namespace)
             ->group(base_path('routes/data.php'));

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
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
