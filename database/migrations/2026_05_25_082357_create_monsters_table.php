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
        Schema::create('monsters', function (Blueprint $table) {
            $table->id();
            $table->string('mongo_id')->nullable();
            $table->foreignId('type_id')->nullable()->constrained('types')->onDelete('set null');
            
            $table->string('slug')->unique();
            $table->string('name');
            $table->boolean('isLarge')->default(false);
            $table->json('subSpecies')->nullable();
            $table->json('elements')->nullable();
            $table->json('ailments')->nullable();
            $table->json('weakness')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monsters');
    }
};
