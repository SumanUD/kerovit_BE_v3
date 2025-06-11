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
        Schema::create('about_us', function (Blueprint $table) {
        $table->id();
        $table->string('banner_image')->nullable();
        $table->text('banner_description')->nullable();
        $table->text('below_banner_content')->nullable();
        $table->string('director_image')->nullable();
        $table->text('director_description')->nullable();
        $table->json('manufacturing')->nullable(); // For manufacturing items
        $table->json('certification_images')->nullable(); // For multiple images
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
