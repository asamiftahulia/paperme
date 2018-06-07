<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TdUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('td_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_td')->unsigned();
            $table->foreign('id_td')->references('id')->on('time-deposit');
            $table->string('bm');
            $table->string('am');
            $table->string('rh');
            $table->string('dr');
            $table->string('region');
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
        //
    }
}
