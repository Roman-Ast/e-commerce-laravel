<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTVSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_v_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category');
            $table->string('brand');
            $table->string('model');
            $table->integer('price');
            $table->string('colour');
            $table->string('diagonal');
            $table->string('screen');
            $table->string('resolution');
            $table->string('os');
            $table->text('image');
            $table->text('description');
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
        Schema::dropIfExists('tvs');
    }
}
