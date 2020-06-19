<?php

namespace App\Policies;

use App\Comment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class CommentPolicy
 *
 * @package App\Policies
 *
 * @author Alexander Schilling
 */
class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Reply to comment
     *
     * @param User $user
     * @param Comment $comment
     *
     * @return bool
     */
    public function reply(User $user, Comment $comment): bool
    {
        return !$comment->parent_id;
    }

    /**
     * Update comment
     *
     * @param User $user
     * @param Comment $comment
     *
     * @return bool
     */
    public function update(User $user, Comment $comment): bool
    {
        return $user->id == $comment->user_id;
    }

    /**
     * Destroy comment
     *
     * @param User $user
     * @param Comment $comment
     *
     * @return bool
     */
    public function destroy(User $user, Comment $comment): bool
    {
        return $user->id == $comment->user_id;
    }
}
