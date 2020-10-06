<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserspromote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userspromote', function (Blueprint $table) {
            $table->bigIncrements('promoteId');
            $table->string('UpId');
            $table->string('price');
            $table->string('day');
            $table->string('uid');
            $table->string('disable')->default('true');
            $table->string('viewer')->default('0');
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
        Schema::dropIfExists('userspromote');
    }
}
