<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->unsignedBigInteger('id_product');
            // $table->foreign('user_id')->references('id')->on('users');
            $table->string("product_name", 16);
            $table->integer("product_price");
            $table->string("category", 20);
            $table->string("input_picture", 50);
            $table->string("description", 500);
            $table->string("slug", 50)->nullable();
            $table->integer("stok");
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
