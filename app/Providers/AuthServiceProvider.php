<?php

namespace App\Providers;

use App\Article;
use App\Category;
use App\Comment;
use App\User;
use App\Policies\ArticlePolicy;
use App\Policies\CategoryPolicy;
use App\Policies\CommentPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

/**
 * Class AuthServiceProvider
 *
 * @package App\Providers
 *
 * @author Alexander Schilling
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Article::class  => ArticlePolicy::class,
        Category::class => CategoryPolicy::class,
        Comment::class  => CommentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Gate $gate)
    {

        $this->registerPolicies();

        $gate::before(function (User $user) {

            if ($user->isAdmin()) {
                return true;
            }

            // do not return false here!
        });
    }
}
