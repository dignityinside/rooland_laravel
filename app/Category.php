<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Category
 *
 * @package App
 *
 * @author Alexander Schilling
 */
class Category extends Material
{

    /** @var string[] Allowed fields */
    protected $fillable = [
        'name',
        'description',
        'slug',
        'material_id',
        'order',
    ];

    /**
     * @return HasMany
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
