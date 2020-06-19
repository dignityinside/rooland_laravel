<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

/**
 * Class Comment
 *
 * @package App
 *
 * @author Alexander Schilling
 */
class Comment extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'body',
    ];

    /**
     * @var string[]
     */
    protected $dates = [
        'edited_at'
    ];

    /**
     * Boot
     */
    public static function boot()
    {
        parent::boot();

        static::created(function ($comment) {
            $comment->body = \App\Helpers\HtmlPurifier::process($comment->body);
        });

        static::updating(function ($comment) {
            $comment->edited_at = Carbon::now();
            $comment->body = \App\Helpers\HtmlPurifier::process($comment->body);
        });

        static::deleting(function ($comment) {
            $comment->children()->delete();
        });

    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function children(): hasMany
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id')->latest();
    }

    /**
     * @return MorphTo
     */
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }
}
