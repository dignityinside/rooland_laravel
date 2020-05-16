<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\ArticleObserver;
use App\Article;

/**
 * Class EloquentEventServiceProvider
 *
 * @package App\Providers
 *
 * @author Alexander Schilling
 */
class EloquentEventServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        Article::observe(ArticleObserver::class);
    }
}
