<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateArticlesTable
 *
 * @author Alexander Schilling
 */
class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug')->unique();
            $table->string('thumbnail', 255)->nullable();
            $table->text('content');
            $table->enum('status_id', ['draft', 'public'])->default('draft');
            $table->unsignedInteger('category_id')->default(0);
            $table->unsignedBigInteger('hits')->default(0);
            $table->enum('allow_comments', [0, 1])->default(1);
            $table->string('meta_title', 255)->nullable();
            $table->string('meta_description', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
