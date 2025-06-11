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
        Schema::create('catalogues', function (Blueprint $table) {
            $table->id();
            $table->string('banner_image')->nullable();
            $table->text('description')->nullable();
            $table->string('catalogue_image_1')->nullable();
            $table->string('catalogue_image_2')->nullable();
            $table->string('catalogue_pdf_1')->nullable();
            $table->string('catalogue_pdf_2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogues');
    }
};
