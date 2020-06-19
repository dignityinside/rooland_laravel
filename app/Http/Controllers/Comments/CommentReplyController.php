<?php

namespace App\Http\Controllers\Comments;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;

/**
 * Class CommentReplyController
 *
 * @package App\Http\Controllers\Comments
 *
 * @author Alexander Schilling
 */
class CommentReplyController extends Controller
{

    /**
     * Store
     *
     * @param Comment $comment
     * @param CommentRequest $commentRequest
     *
     * @return CommentResource
     */
    public function store(Comment $comment, CommentRequest $commentRequest): CommentResource
    {

        $this->authorize('reply', $comment);

        $reply = $comment->children()->make($commentRequest->validated());

        $reply->commentable()->associate($comment->commentable);

        $commentRequest->user()->comments()->save($reply);

        return new CommentResource($reply);
    }
}
