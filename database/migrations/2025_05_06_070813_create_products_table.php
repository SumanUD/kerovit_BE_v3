<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id');
            $table->longText('product_code')->nullable();
            $table->longText('thumbnail_picture')->nullable();
            $table->longText('product_title')->nullable();
            $table->longText('Series')->nullable(); // Also referred to as Range
            $table->longText('shape')->nullable();
            $table->longText('spray')->nullable();
            $table->longText('category_name')->nullable();
            $table->text('product_description')->nullable();
            $table->longText('ranges')->nullable();
            $table->longText('collection')->nullable();
            $table->longText('size')->nullable();
            $table->double('price')->nullable();
            $table->longText('product_image')->nullable();
            $table->longText('diagram_image_name')->nullable();
            $table->longText('additional_image1')->nullable();
            $table->longText('additional_image2')->nullable();
            $table->longText('additional_image3')->nullable();
            $table->longText('additional_image4')->nullable();
            $table->longText('additional_image5')->nullable();
            $table->longText('installation_service_parts')->nullable();
            $table->longText('feature_image')->nullable();
            $table->longText('additional_information')->nullable();
            $table->primary('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
