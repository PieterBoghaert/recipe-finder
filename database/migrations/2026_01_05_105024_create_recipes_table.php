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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('overview')->nullable();
            $table->unsignedInteger('servings')->default(1);
            $table->unsignedInteger('prep_minutes');
            $table->unsignedInteger('cook_minutes');
            $table->string('image_large', 512);
            $table->string('image_small', 512);
            $table->json('ingredients');
            $table->json('instructions');
            $table->timestamps();

            // Indexes
            $table->index('slug');
            $table->index('prep_minutes');
            $table->index('cook_minutes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
