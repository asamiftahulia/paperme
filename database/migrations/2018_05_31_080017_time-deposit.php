<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TimeDeposit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time-deposit', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->float('amount');
            $table->boolean('status');
            $table->string('notes');
            $table->date('expired_date');
            $table->integer('period');
            $table->string('currency');
            $table->string('type_of_td')->unsigned();
            $table->foreign('type_of_td')->references('id_deposito')->on('m__tipe__depositos');
            $table->string('bank',50)->unsigned()->nullable();
            $table->foreign('bank')->references('KODE_LJK')->on('master_banks');
            $table->date('date_rollover');
            $table->float('special_rate');
            $table->float('normal_rate');
            $table->string('id_branch')->unsigned();
            $table->string('created_by');
            $table->string('updated_by');
            $table->string('image');
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
