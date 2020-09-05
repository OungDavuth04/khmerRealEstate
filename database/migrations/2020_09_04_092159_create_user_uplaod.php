<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserUplaod extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_uplaod', function (Blueprint $table) {
            $table->bigIncrements('UpId');
            $table->string('uid');
            $table->string('title');
            $table->string('bedroom');
            $table->string('bathroom');
            $table->string('facing');
            $table->string('size');
            $table->string('price');
            $table->string('description');
            $table->string('province');
            $table->string('district');
            $table->string('commune');
            $table->string('localdetail');
            $table->string('phone');
            $table->string('email');
            $table->string('map_lat');
            $table->string('map_lng');
            $table->string('cat_name');
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
        Schema::dropIfExists('user_uplaod');
    }
}
