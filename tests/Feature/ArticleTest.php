<?php

namespace Tests\Feature;

use App\Material;
use App\User;
use App\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class ArticleTest
 *
 * @package Tests\Feature
 *
 * @author Alexander Schilling
 */
class ArticleTest extends TestCase
{

    use RefreshDatabase;

    // Guest

    public function testGuestCanViewHomeOfArticles()
    {
        $this->get(route('articles.home'))->assertStatus(200);
    }

    public function testGuestMayNotCreateArticle()
    {
        $this->get(route('articles.create'))->assertStatus(403);
    }

    public function testGuestMayNotEditArticle()
    {
        $article = factory(Article::class)->create();
        $this->get(route('articles.edit', ['article' => $article->slug]))->assertStatus(403);
    }

    public function testGuestMayNotDeleteArticle()
    {
        $article = factory(Article::class)->create();
        $this->delete(route('articles.destroy', ['article' => $article]))->assertStatus(403);
    }

    public function testGuestMayNotSeeDraftArticle()
    {
        $article = factory(Article::class)->create(['status_id' => Material::STATUS_DRAFT]);
        $this->get(route('articles.show', ['article' => $article->slug]))->assertStatus(403);
    }

    public function testGuestCanSeePublicArticle()
    {
        $article = factory(Article::class)->create(['status_id' => Material::STATUS_PUBLIC]);
        $this->get(route('articles.show', ['article' => $article->slug]))->assertStatus(200);
    }

    public function testGuestCanSeeErrorPage()
    {
        $this->get(route('articles.show', ['article' => 'not-found']))->assertStatus(404);
    }

    // User

    public function testUserCanViewHomeOfArticles()
    {
        $this->actingAs(factory(User::class)->create())->get(route('articles.home'))->assertStatus(200);
    }

    public function testUserMayNotCreateArticle()
    {
        $this->actingAs(factory(User::class)->create())->get(route('articles.create'))->assertStatus(403);
    }

    public function testUserMayNotEditArticle()
    {
        $article = factory(Article::class)->create();

        $this->actingAs(factory(User::class)->create())
             ->get(route('articles.edit', ['article' => $article->slug]))->assertStatus(403);
    }

    public function testUserMayNotDeleteArticle()
    {
        $article = factory(Article::class)->create();

        $this->actingAs(factory(User::class)->create())
             ->delete(route('articles.destroy', ['article' => $article]))->assertStatus(403);
    }

    public function testUserMayNotSeeDraftArticle()
    {
        $article = factory(Article::class)->create(['status_id' => Material::STATUS_DRAFT]);
        $this->actingAs(factory(User::class)->create())
             ->get(route('articles.show', ['article' => $article->slug]))
             ->assertStatus(403);
    }

    public function testUserCanSeePublicArticle()
    {
        $article = factory(Article::class)->create(['status_id' => Material::STATUS_PUBLIC]);
        $this->actingAs(factory(User::class)->create())
            ->get(route('articles.show', ['article' => $article->slug]))
            ->assertStatus(200);
    }

    public function testUserCanSeeErrorPage()
    {
        $this->actingAs(factory(User::class)->create())
             ->get(route('articles.show', ['article' => 'not-found']))
             ->assertStatus(404);
    }

    // Admin

    public function testAdminCanViewIndexOfArticles()
    {
        $this->actingAs(factory(User::class)->create(['is_admin' => true]))
            ->get(route('articles.index'))
            ->assertStatus(200);
    }

    public function testAdminCanViewHomeOfArticles()
    {
        $this->actingAs(factory(User::class)->create(['is_admin' => true]))
             ->get(route('articles.home'))
             ->assertStatus(200);
    }

    public function testAdminCanSeePublicArticle()
    {
        $article = factory(Article::class)->create(['status_id' => Material::STATUS_PUBLIC]);
        $this->actingAs(factory(User::class)->create(['is_admin' => 1]))
             ->get(route('articles.show', ['article' => $article->slug]))
             ->assertStatus(200);
    }

    public function testAdminCanCreateArticle()
    {
        $this->actingAs(factory(User::class)->create(['is_admin' => true]));

        $this->get(route('articles.create'))->assertStatus(200);

        $article = factory(\App\Article::class)->make()->only(
            'category_id',
            'status_id',
            'slug',
            'thumbnail',
            'title',
            'content',
            'meta_title',
            'meta_description',
            'allow_comments',
            'hits'
        );

        $this->post(route('articles.store'), $article)
             ->assertStatus(302)
             ->assertRedirect(route('articles.create'))
             ->assertSessionHas('message', __('articles.message_article_added'));
    }

    public function testAdminCanEditArticle()
    {
        $this->actingAs(factory(User::class)->create(['is_admin' => true]));

        $article = factory(Article::class)->create();

        $this->get(route('articles.edit', ['article' => $article->slug]))->assertStatus(200);

        $article->title = "Hello World 2";

        $this->patch(route('articles.update', ['article' => $article->slug]), $article->toArray())
            ->assertStatus(302)
            ->assertRedirect(route('articles.edit', ['article' => $article->slug]))
            ->assertSessionHas('message', __('articles.message_article_saved'));
    }

    public function testAdminCanDeleteArticle()
    {
        $this->actingAs(factory(User::class)->create(['is_admin' => true]))
             ->delete(route('articles.destroy', ['article' => factory(Article::class)->create()]))
             ->assertStatus(302)
             ->assertRedirect(route('articles.index'));
    }

    public function testAdminCanSeeErrorPage()
    {
        $this->actingAs(factory(User::class)->create(['is_admin' => 1]))
             ->get(route('articles.show', ['article' => 'not-found']))
             ->assertStatus(404);
    }
}
