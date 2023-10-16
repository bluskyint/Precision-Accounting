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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100 )->unique()->index();
            $table->string('slug');
            $table->string('job_title', 100 );
            $table->string('linkedin')->nullable();
            $table->text('info');
            $table->string('slider_show' , 1 )->default('0');
            $table->json('img');
            $table->string('seo_title');
            $table->text('seo_description');
            $table->text('seo_keywords');
            $table->string('seo_robots');
            $table->string('og_title');
            $table->string('og_type');
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
        Schema::dropIfExists('members');
    }
};
