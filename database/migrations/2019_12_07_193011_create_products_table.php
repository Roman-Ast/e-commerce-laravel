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
            $table->bigIncrements('id');
            $table->string('category');
            $table->string('brand');
            $table->string('model');
            $table->integer('price');
            $table->string('colour');
            $table->string('ram')->nullable();
            $table->string('capacity')->nullable();
            $table->string('diagonal')->nullable();
            $table->string('screen')->nullable();
            $table->string('resolution')->nullable();
            $table->string('os')->nullable();
            $table->text('image');
            $table->text('description');
            $table->string('onsale');
            $table->integer('discount_persentage');
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
