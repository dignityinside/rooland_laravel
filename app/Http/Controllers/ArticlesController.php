<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class ArticlesController
 *
 * @package App\Http\Controllers
 *
 * @author Alexander Schilling
 */
class ArticlesController extends Controller
{
    /**
     * ArticlesController constructor.
     */
    public function __construct()
    {
        /**
         * @see ArticlePolicy
         */
        $this->authorizeResource(Article::class);
    }

    /**
     * Display a listing of the articles for admin.
     *
     * @return View
     */
    public function index(): View
    {
        $articles = Article::orderBy('created_at', 'desc')
            ->paginate(config('articles.admin_per_page'));

        return view('articles.index')->with('articles', $articles);
    }

    /**
     * Display a listing of the articles.
     *
     * @return View
     */
    public function home(): View
    {
        $articles = Article::where('status_id', 'public')
            ->orderBy('created_at', 'desc')
            ->paginate(config('articles.per_page'));

        return view('articles.home')->with('articles', $articles);
    }

    /**
     * Show the form for creating a new article.
     *
     * @param Article $article
     *
     * @return View
     */
    public function create(Article $article): View
    {
        return view('articles.create')->with(['article' => $article]);
    }

    /**
     * Store a newly created article in storage.
     *
     * @param ArticleRequest $articleRequest
     *
     * @return RedirectResponse
     */
    public function store(ArticleRequest $articleRequest): RedirectResponse
    {
        Article::create($articleRequest->validated());

        return redirect()->back()->with('message', __('articles.message_article_added'));
    }

    /**
     * Display the specified article.
     *
     * @param Article $article
     *
     * @return View
     */
    public function show(Article $article): View
    {
        return view('articles.show')->with('article', $article);
    }

    /**
     * Show the form for editing the specified article.
     *
     * @param Article $article
     *
     * @return View
     */
    public function edit(Article $article): View
    {
        return view('articles.edit')->with(['article' => $article]);
    }

    /**
     * Update the specified article in storage.
     *
     * @param ArticleRequest $articleRequest
     * @param Article $article
     *
     * @return RedirectResponse
     */
    public function update(ArticleRequest $articleRequest, Article $article): RedirectResponse
    {
        $article->update($articleRequest->validated());
        return redirect()->back()->with('message', __('articles.message_article_saved'));
    }

    /**
     * Remove the specified article from storage.
     *
     * @param Article $article
     *
     * @return RedirectResponse
     */
    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();
        return redirect()->route('articles.index');
    }
}
