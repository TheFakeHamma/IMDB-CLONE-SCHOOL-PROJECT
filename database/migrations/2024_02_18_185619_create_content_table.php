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
        Schema::create('content', function (Blueprint $table) {
            $table->id('content_id');
            $table->string('title');
            $table->date('release_date');
            $table->text('synopsis')->nullable();
            $table->enum('type', ['movie', 'tv_show']);
            $table->string('photo_url')->nullable();
            $table->string('trailer_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content');
    }
};
