<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductexpandsionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('productexpandsion', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('category_id');
        //     $table->foreign('category_id')->references('id')->on("categories");
        //     $table->string('field_name');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productexpandsion');
    }
}
