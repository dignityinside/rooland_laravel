<?php

namespace App\Policies;

use App\Article;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class ArticlePolicy
 *
 * @package App\Policies
 *
 * @author Alexander Schilling
 */
class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any article (index).
     *
     * @param User $user
     *
     * @return bool
     */
    public function viewAny(?User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the article.
     *
     * @param User $user
     * @param Article $article
     *
     * @return bool
     */
    public function view(?User $user, Article $article): bool
    {

        if ($article->status_id == 'public') {
            return true;
        }

        return false;

    }

    /**
     * Determine whether the user can create article.
     *
     * @param  \App\User  $user
     *
     * @return bool
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the article.
     *
     * @param User $user
     * @param Article $article
     *
     * @return bool
     */
    public function update(User $user, Article $article): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the article.
     *
     * @param User $user
     * @param Article $article
     *
     * @return bool
     */
    public function delete(User $user, Article $article): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the article.
     *
     * @param User $user
     * @param Article $article
     *
     * @return bool
     */
    public function restore(User $user, Article $article): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the article.
     *
     * @param User $user
     * @param Article $article
     *
     * @return bool
     */
    public function forceDelete(User $user, Article $article): bool
    {
        return false;
    }
}
