<?php

namespace App\Http\Controllers\Comments;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Request;

/**
 * Class CommentController
 *
 * @package App\Http\Controllers\Comments
 *
 * @author Alexander Schilling
 */
class CommentController extends Controller
{
    /**
     * Update
     *
     * @param Comment $comment
     * @param CommentRequest $request
     *
     * @return CommentResource
     */
    public function update(Comment $comment, CommentRequest $commentRequest): CommentResource
    {
        $this->authorize('update', $comment);

        $comment->update($commentRequest->validated());

        return new CommentResource($comment);
    }

    /**
     * Destroy
     *
     * @param Comment $comment
     * @param Request $request
     *
     * @return void
     */
    public function destroy(Comment $comment, Request $request): void
    {
        $this->authorize('destroy', $comment);

        $comment->delete();
    }
}
