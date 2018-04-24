<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTimeDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction__time__deposits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_td')->unsigned();
            $table->foreign('id_td')->references('id')->on('t_ds');
            $table->string('created_by');
            $table->boolean('approved');
            $table->string('approved_by');
            $table->datetime('approved_at');
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
        Schema::dropIfExists('transaction__time__deposits');
    }
}
