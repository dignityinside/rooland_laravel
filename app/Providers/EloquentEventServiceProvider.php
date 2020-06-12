<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\ArticleObserver;
use App\Observers\CategoryObserver;
use App\Article;
use App\Category;

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
        Category::observe(CategoryObserver::class);
    }
}
