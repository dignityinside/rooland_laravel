<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class CategoriesController
 *
 * @package App\Http\Controllers
 *
 * @author Alexander Schilling
 */
class CategoriesController extends Controller
{
    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        /**
         * @see CategoryPolicy
         */
        $this->authorizeResource(Category::class);
    }

    /**
     * Display a listing of categories.
     *
     * @return View
     */
    public function index(): View
    {
        $categories = Category::orderBy('order', 'asc')->paginate(config('category.admin_per_page'));
        return view('categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new category.
     *
     * @param Category $category
     *
     * @return View
     */
    public function create(Category $category): View
    {
        return view('categories.create')->with(['category' => $category]);
    }

    /**
     * Store a newly created category in storage.
     *
     * @param CategoryRequest $categoryRequest
     *
     * @return RedirectResponse
     */
    public function store(CategoryRequest $categoryRequest): RedirectResponse
    {
        Category::create($categoryRequest->validated());
        return redirect()->back()->with('message', __('categories.message_category_added'));
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param Category $category
     *
     * @return View
     */
    public function edit(Category $category): View
    {
        return view('categories.edit')->with(['category' => $category]);
    }

    /**
     * Update the specified category in storage.
     *
     * @param CategoryRequest $categoryRequest
     * @param Category $category
     *
     * @return RedirectResponse
     */
    public function update(CategoryRequest $categoryRequest, Category $category): RedirectResponse
    {
        $category->update($categoryRequest->validated());

        return redirect(route('categories.edit', ['category' => $category->id]))
            ->with('message', __('categories.message_category_saved'));
    }

    /**
     * Remove the specified category from storage.
     *
     * @param Category $category
     *
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
