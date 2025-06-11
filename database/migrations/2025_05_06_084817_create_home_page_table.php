<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('home_page', function (Blueprint $table) {
            $table->id();
            // Banner section
            $table->enum('banner_type', ['video', 'slider'])->default('slider'); // Banner type: video or slider
            $table->text('video_url')->nullable(); // For video URL
            $table->json('slider_images')->nullable(); // For images (JSON format)
    
            // Categories Section (Text editor content)
            $table->text('categories_text')->nullable(); // Text content for Categories
    
            // Aurum Section (Text editor content)
            $table->text('aurum_text')->nullable(); // Text content for Aurum
    
            // Klassic Section (Text editor content)
            $table->text('klassic_text')->nullable(); // Text content for Klassic
    
            // World Of Kerovit Section
            $table->text('world_of_kerovit_text')->nullable(); // Text for World of Kerovit
            $table->string('world_of_kerovit_button_text')->nullable(); // Button text for World of Kerovit
            $table->string('world_of_kerovit_button_url')->nullable(); // Button URL for World of Kerovit
            $table->string('world_of_kerovit_image')->nullable(); // Image for World of Kerovit
    
            // Catalogue Section
            $table->string('catalogue_pdf_1')->nullable(); // PDF 1 URL
            $table->string('catalogue_pdf_2')->nullable(); // PDF 2 URL
    
            // About Us Section
            $table->text('about_us_text')->nullable(); // Text content for About Us
            $table->string('about_us_image')->nullable(); // Text content for About Us

            $table->string('about_us_button_text')->nullable(); // Button text for About Us
            $table->string('about_us_button_url')->nullable(); // Button URL for About Us
    
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_page');
    }
};
