<?php

namespace App\Policies;

use App\Category;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class CategoryPolicy
 *
 * @package App\Policies
 *
 * @author Alexander Schilling
 */
class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any category (index).
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
     * Determine whether the user can create category.
     *
     * @param User $user
     *
     * @return bool
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the category.
     *
     * @param User $user
     * @param Category $category
     *
     * @return bool
     */
    public function update(User $user, Category $category): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the category.
     *
     * @param User $user
     * @param Category $category
     *
     * @return bool
     */
    public function delete(User $user, Category $category): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the category.
     *
     * @param User $user
     * @param Category $category
     *
     * @return bool
     */
    public function restore(User $user, Category $category): bool
    {
        return false;
    }
}
