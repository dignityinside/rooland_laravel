<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'ArticlesController@home')->name('articles.home');
Route::resource('/articles', 'ArticlesController');
Route::get('/articles/category/{id}', 'ArticlesController@category')->name('articles.category');

Route::resource('/articles/{article}/comments', 'Articles\ArticleCommentController', [
    'names' => [
        'index' => 'articles.comments.index'
    ]
]);

Route::resource('/comments', 'Comments\CommentController');
Route::resource('/comments/{comment}/replies', 'Comments\CommentReplyController');

Route::resource('/categories', 'CategoriesController');

Route::get('/home', 'HomeController@index')->name('home');
