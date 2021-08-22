<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaptopDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('laptop_details', function (Blueprint $table) {
        //     $table->unsignedBigInteger('product_id');
        //     $table->foreign('product_id')->references('id')->on("products");
        //     $table->primary(['product_id']);
        //     $table->string('battery');
        //     $table->string('ram');
        //     $table->string('cpu');
        //     $table->string('display');
        //     $table->string('storage');
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
        Schema::dropIfExists('laptop_details');
    }
}
