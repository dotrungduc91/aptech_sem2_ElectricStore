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
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on("categories");
            $table->float('price');
            $table->float('price_discount');
            $table->Integer('price_lever');
            $table->unsignedBigInteger('quantity_available');
            $table->unsignedBigInteger('quantity_sale');
            $table->longtext('image');
            $table->text('short_description');
            $table->longtext('description');
            $table->Integer('is_deleted')->default(0);
            $table->string('href_param');
            $table->timestamps();
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
