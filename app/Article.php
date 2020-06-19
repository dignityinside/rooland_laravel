<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->where('material_id', self::MATERIAL_ARTICLE_ID);
    }

    /**
     * @return MorphMany
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id')->latest();
    }

    /**
     * @return int
     */
    public function allCommentsCount(): int
    {
        return $this->morphMany(Comment::class, 'commentable')->count();
    }
}
