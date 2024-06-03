<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration  {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('chapters', function (Blueprint $table) {
            $table->engine    = 'InnoDB';
            $table->charset   = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->id();
            $table->string('title', 200);
            $table->string('slug', 255);
            $table->text('content');
            $table->tinyInteger('publication_status')
                ->default(0)
                ->comment('0: No Publicado; 1: Publicado');
            //create relation with stories table
            $table->unsignedBigInteger('story_id');
            $table->foreign('story_id')
                ->references('id')
                ->on('stories');
            //delete state
            $table->tinyInteger('deleted_state')
                ->default(0)
                ->comment('0: Sin eliminar; 1: Eliminado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('chapters');
    }
};
