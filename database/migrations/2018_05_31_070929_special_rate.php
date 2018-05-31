<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpecialRate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m-special-rates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('term');
            $table->string('currency');
            $table->float('counter_rate');
            $table->float('area_manager');
            $table->float('regional_head');
            $table->float('director');
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
