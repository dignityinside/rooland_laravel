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

    /** @var int */
    public const MATERIAL_ARTICLE_ID = 1;

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

    /**
     * Returns materials
     *
     * @return string[]
     */
    public static function getMaterials(): array
    {
        return [
            self::MATERIAL_ARTICLE_ID => __('material.article_name'),
        ];
    }
}
