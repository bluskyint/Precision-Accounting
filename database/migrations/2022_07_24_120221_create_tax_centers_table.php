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
        Schema::create('tax_centers', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100 )->unique()->index();
            $table->string('slug')->unique()->index();
            $table->foreignId('author_id')->constrained('users');
            $table->string('subtitle');
            $table->string('summary');
            $table->string('seo_title', 500);
            $table->string('seo_description', 1000);
            $table->string('seo_keywords', 1000);
            $table->string('visibility', 1 )->default('1');
            $table->text('content');
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
        Schema::dropIfExists('tax_centers');
    }
};
