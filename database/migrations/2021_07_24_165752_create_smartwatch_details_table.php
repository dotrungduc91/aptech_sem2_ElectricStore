<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmartwatchDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('smartwatch_details', function (Blueprint $table) {
        //     $table->unsignedBigInteger('product_id');
        //     $table->foreign('product_id')->references('id')->on("products");
        //     $table->primary(['product_id']);
        //     $table->string('battery');
        //     $table->string('ram');
        //     $table->string('display');
        //     $table->string('cpu');
        //     $table->string('gpu');
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
        Schema::dropIfExists('smartwatch_details');
    }
}
