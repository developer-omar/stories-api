<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            //data for profile
            $table->string("photo", 255)->nullable();
            $table->string("username", 30);
            $table->string("name", 255);
            $table->string("last_name", 255);
            $table->date("birth_date");
            $table->string("location", 255)->nullable();
            $table->text("about_you")->nullable();
            //relation with gender user table
            $table->unsignedBigInteger('user_gender_id')->default(3);
            $table->foreign('user_gender_id')
                ->references('id')
                ->on('user_genders');
            //relation with user state table
            $table->unsignedBigInteger('user_state_id')->default(1);
            $table->foreign('user_state_id')
                ->references('id')
                ->on('user_states');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
