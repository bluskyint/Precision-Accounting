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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('job_title');
            $table->string('linkedin')->nullable();
            $table->text('info')->nullable();
            $table->json('img')->default(json_encode(["src" => "user-avatar.png", "alt" => "user image"], JSON_THROW_ON_ERROR));
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('active', [0, 1]);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
