<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_deposits', function (Blueprint $table) {
            $table->increments('id');
            $table->String('bank');
            $table->String('tipe');
            $table->Integer('amount');
            $table->Integer('rate');
            $table->Integer('period');
            $table->Integer('td');
            $table->Integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
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
        Schema::dropIfExists('time_deposits');
    }
}
