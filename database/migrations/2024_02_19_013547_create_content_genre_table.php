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
        Schema::disableForeignKeyConstraints();

        Schema::create('content_genre', function (Blueprint $table) {
            $table->foreignId('content_id')->constrained('contents')->onDelete('cascade');
            $table->foreignId('genre_id')->constrained('genres')->onDelete('cascade');
            $table->primary(['content_id', 'genre_id']);
        });
        

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_genre');
    }
};
