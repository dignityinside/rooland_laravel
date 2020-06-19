<?php

namespace App\Http\Controllers\Articles;

use App\Article;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class ArticleCommentController
 *
 * @package App\Http\Controllers\Articles
 *
 * @author Alexander Schilling
 */
class ArticleCommentController extends Controller
{
    /**
     * Index
     *
     * @param Article $article
     *
     * @return AnonymousResourceCollection
     */
    public function index(Article $article): AnonymousResourceCollection
    {
        return CommentResource::collection(
            $article->comments()->with(['children', 'user'])->paginate(config('articles.comments_per_page'))
        );
    }

    /**
     * Store a comment
     *
     * @param Article $article
     * @param CommentRequest $commentRequest
     *
     * @return CommentResource
     */
    public function store(Article $article, CommentRequest $commentRequest): CommentResource
    {
        $comment = $article->comments()->make($commentRequest->validated());

        $commentRequest->user()->comments()->save($comment);

        return new CommentResource($comment);
    }
}
