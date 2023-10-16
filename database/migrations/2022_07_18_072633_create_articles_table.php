<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('title', 100 )->unique()->index();
            $table->string('slug')->unique()->index();
            $table->foreignId('author_id')->constrained('users');
            $table->foreignId('category_id')->constrained();
            $table->string('subtitle');
            $table->string('summary');
            $table->text('content')->nullable();
            $table->string('seo_title');
            $table->text('seo_description');
            $table->text('seo_keywords');
            $table->string('seo_robots');
            $table->string('og_title');
            $table->string('og_type');
            $table->string('pinned' , 1)->default('0');
            $table->json('img');
            $table->softDeletes();
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
};
