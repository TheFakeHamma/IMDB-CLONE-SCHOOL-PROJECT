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

        Schema::create('content_people', function (Blueprint $table) {
            $table->foreignId('content_id')->constrained()->onDelete('cascade');
            $table->foreignId('person_id')->constrained()->onDelete('cascade');
            $table->enum('role', ['actor', 'director']);
            $table->primary(['content_id', 'person_id', 'role']);
        });        

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_people');
    }
};
