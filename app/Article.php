<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
