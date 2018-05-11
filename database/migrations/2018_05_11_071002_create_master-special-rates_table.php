<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterSpecialRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master-special-rates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('term');
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
        Schema::dropIfExists('master-special-rates');
    }
}
