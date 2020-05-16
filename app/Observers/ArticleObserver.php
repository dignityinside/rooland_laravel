<?php

namespace App\Observers;

use App\Article;
use Illuminate\Support\Str;

/**
 * Class ArticleObserver
 *
 * @package App\Observers
 *
 * @author Alexander Schilling
 */
class ArticleObserver
{

    /**
     * On creating article
     *
     * @param Article $article
     */
    public function creating(Article $article): void
    {
        if (empty($article->slug)) {
            $article->slug = $this->generateUniqueSlug($article);
        }
    }

    /**
     * On updating article
     *
     * @param Article $article
     */
    public function updating(Article $article): void
    {
        if (empty($article->slug)) {
            $article->slug = $this->generateUniqueSlug($article);
        }
    }

    /**
     * Generate unique slug
     *
     * @param Article $article
     *
     * @return string
     */
    private function generateUniqueSlug(Article $article): string
    {

        $tempSlug = Str::slug($article->title);
        $slug = Article::where('slug', $tempSlug)->first();

        return !empty($slug) ? $tempSlug . '-' . date('d-m-Y-H-i-s') : $tempSlug;
    }
}
