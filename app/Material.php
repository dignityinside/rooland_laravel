<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Material
 *
 * @package App
 *
 * @author Alexander Schilling
 */
class Material extends Model
{
    /** @var string */
    public const STATUS_DRAFT = 'draft';

    /** @var string */
    public const STATUS_PUBLIC = 'public';

    /** @var string */
    public const DATE_FORMAT = 'd.m.Y';

    /**
     * Returns material status
     *
     * @return string[]
     */
    public static function getStatus(): array
    {
        return [
            self::STATUS_DRAFT  => __('material.status_draft'),
            self::STATUS_PUBLIC => __('material.status_public'),
        ];
    }
}
