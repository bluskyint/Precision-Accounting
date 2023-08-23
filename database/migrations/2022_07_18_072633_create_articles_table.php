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
            $table->unsignedBigInteger('category_id');
            $table->string('title', 100 )->unique()->index();
            $table->string('slug')->unique()->index();
            $table->string('subtitle');
            $table->string('summary');
            $table->text('content');
            $table->string('seo_title', 500);
            $table->string('seo_description', 1000);
            $table->string('seo_keywords', 1000);
            $table->string('pinned' , 1)->default('0');
            $table->string('author');
            $table->string('img');
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
