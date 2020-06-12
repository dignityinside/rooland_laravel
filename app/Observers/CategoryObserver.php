<?php

namespace App\Observers;

use App\Category;
use App\Material;
use Illuminate\Support\Str;

/**
 * Class CategoryObserver
 *
 * @package App\Observers
 *
 * @author Alexander Schilling
 */
class CategoryObserver
{

    /**
     * On creating category
     *
     * @param Category $category
     */
    public function creating(Category $category): void
    {
        if (empty($category->slug)) {
            $category->slug = $this->generateUniqueSlug($category);
        }
    }

    /**
     * On updating category
     *
     * @param Category $category
     */
    public function updating(Category $category): void
    {
        if (empty($category->slug)) {
            $category->slug = $this->generateUniqueSlug($category);
        }
    }

    /**
     * Generate unique slug
     *
     * @param Category $category
     *
     * @return string
     */
    private function generateUniqueSlug(Category $category): string
    {
        $tempSlug = Str::slug($category->name);
        $slug = Category::where('slug', $tempSlug)->where('material_id', $category->material_id)->first();

        return !empty($slug) ? $tempSlug . '-' . date('d-m-Y-H-i-s') : $tempSlug;
    }
}
