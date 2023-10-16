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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100 )->unique()->index();
            $table->string('slug')->unique()->index();
            $table->foreignId('author_id')->constrained('users');
            $table->string('subtitle');
            $table->string('seo_title');
            $table->text('seo_description');
            $table->text('seo_keywords');
            $table->string('seo_robots');
            $table->string('og_title');
            $table->string('og_type');
            $table->string('summary', 255 );
            $table->integer('parent_id')->nullable();
            $table->text('content')->nullable();
            $table->string('visibility', 1 )->default('1');
            $table->json('icon');
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
        Schema::dropIfExists('services');
    }
};
