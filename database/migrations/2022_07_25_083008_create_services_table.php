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
            $table->string('title', 100 )->index();
            $table->string('slug')->index();
            $table->string('seo_title', 500);
            $table->string('seo_description', 1000);
            $table->string('seo_keywords', 1000);
            $table->string('summary', 255 );
            $table->integer('parent_id')->nullable();
            $table->text('content');
            $table->string('visibility', 1 )->default('1');
            $table->string('icon');
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
        Schema::dropIfExists('services');
    }
};
