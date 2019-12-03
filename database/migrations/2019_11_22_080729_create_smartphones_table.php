<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmartphonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smartphones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category');
            $table->string('brand');
            $table->string('model');
            $table->integer('price');
            $table->string('colour');
            $table->string('ram');
            $table->string('capacity');
            $table->text('image');
            $table->text('description');
            $table->integer('reviews_count');
            $table->string('rating');
            $table->string('onsale');
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
        Schema::dropIfExists('smartphones');
    }
}
