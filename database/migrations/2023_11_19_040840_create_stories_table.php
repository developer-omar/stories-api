<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration  {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('stories', function (Blueprint $table) {
            $table->engine    = 'InnoDB';
            $table->charset   = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->id();
            $table->string('cover_image', 255)->nullable();
            $table->string('title', 80);
            $table->string('slug', 255);
            $table->text('description');
            $table->text('tags');
            $table->tinyInteger('rating')
                ->default(0)
                ->comment('0: No madura; 1: Madura');
            $table->tinyInteger('story_status')
                ->default(0)
                ->comment('0: Incompleto; 1: Completo');
            //relation with categories table
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            //relation with audience type
            $table->unsignedBigInteger('audience_type_id');
            $table->foreign('audience_type_id')->references('id')->on('audience_types');
            //relation with copyright type table
            $table->unsignedBigInteger('copyright_type_id');
            $table->foreign('copyright_type_id')->references('id')->on('copyright_types');
            //relation with users table
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('deleted_state')
                ->default(0)
                ->comment('0: Sin eliminar; 1: Eliminado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('stories');
    }
};
