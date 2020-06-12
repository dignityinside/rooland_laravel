<?php

namespace Tests\Feature;

use App\User;
use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class CategoryTest
 *
 * @package Tests\Feature
 *
 * @author Alexander Schilling
 */
class CategoryTest extends TestCase
{

    use RefreshDatabase;

    // Guest

    public function testGuestMayNotCreateCategory()
    {
        $this->get(route('categories.create'))->assertStatus(403);
    }

    public function testGuestMayNotEditCategory()
    {
        $category = factory(Category::class)->create();
        $this->get(route('categories.edit', ['category' => $category->id]))->assertStatus(403);
    }

    public function testGuestMayNotDeleteCategory()
    {
        $category = factory(Category::class)->create();
        $this->delete(route('categories.destroy', ['category' => $category]))->assertStatus(403);
    }

    // User

    public function testUserMayNotCreateCategory()
    {
        $this->actingAs(factory(User::class)->create())->get(route('categories.create'))->assertStatus(403);
    }

    public function testUserMayNotEditCategory()
    {
        $category = factory(Category::class)->create();

        $this->actingAs(factory(User::class)->create())
             ->get(route('categories.edit', ['category' => $category->id]))->assertStatus(403);
    }

    public function testUserMayNotDeleteCategory()
    {
        $category = factory(Category::class)->create();

        $this->actingAs(factory(User::class)->create())
             ->delete(route('categories.destroy', ['category' => $category]))->assertStatus(403);
    }

    // Admin

    public function testAdminCanViewIndexOfCategories()
    {
        $this->actingAs(factory(User::class)->create(['is_admin' => true]))
            ->get(route('categories.index'))
            ->assertStatus(200);
    }

    public function testAdminCanCreateCategory()
    {
        $this->actingAs(factory(User::class)->create(['is_admin' => true]));

        $this->get(route('categories.create'))->assertStatus(200);

        $category = factory(\App\Category::class)->make()->only(
            'name',
            'description',
            'slug',
            'material_id',
            'order'
        );

        $this->post(route('categories.store'), $category)
             ->assertStatus(302)
             ->assertRedirect(route('categories.create'))
             ->assertSessionHas('message', __('categories.message_category_added'));
    }

    public function testAdminCanEditCategory()
    {
        $this->actingAs(factory(User::class)->create(['is_admin' => true]));

        $category = factory(Category::class)->create();

        $this->get(route('categories.edit', ['category' => $category->id]))->assertStatus(200);

        $category->name = "Hello World 2";

        $this->patch(route('categories.update', ['category' => $category->id]), $category->toArray())
            ->assertStatus(302)
            ->assertRedirect(route('categories.edit', ['category' => $category->id]))
            ->assertSessionHas('message', __('categories.message_category_saved'));
    }

    public function testAdminCanDeleteCategory()
    {
        $this->actingAs(factory(User::class)->create(['is_admin' => true]))
             ->delete(route('categories.destroy', ['category' => factory(Category::class)->create()]))
             ->assertStatus(302)
             ->assertRedirect(route('categories.index'));
    }
}
