<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_data', function (Blueprint $table) {
            $table->bigIncrements('dataId');
            $table->string('uid');
            $table->string('catHouse');
            $table->string('catLand');
            $table->string('catCondo');
            $table->string('catCommercial');
            $table->string('catRoom');
            $table->string('province');
            $table->string('district');
            $table->string('commune');
            $table->string('searchBox');
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
        Schema::dropIfExists('user_data');
    }
}
