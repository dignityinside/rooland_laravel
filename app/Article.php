<?php

namespace App;

/**
 * Class Article
 *
 * @package App
 *
 * @author Alexander Schilling
 */
class Article extends Material
{

    /** @var string[] Allowed fields */
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'thumbnail',
        'content',
        'status_id',
        'hits',
        'allow_comments',
        'meta_title',
        'meta_description',
    ];

    /**
     * Returns categories
     *
     * @return string[]
     */
    public function getCategories(): array
    {
        return [
            0 => __('articles.no_category'),
        ];
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
