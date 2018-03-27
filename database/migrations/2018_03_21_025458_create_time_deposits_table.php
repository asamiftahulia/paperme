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
            $table->increments('id_td');
            $table->String('full_name');
            $table->Float('amount');
            $table->Boolean('status');
            $table->String('notes');
            $table->date('expired_date');
            $table->Integer('period');
            $table->string('type_of_td');
            // $table->string('id_bank')->unsigned();
            // $table->foreign('id_bank')->references('id')->on('m_banks');
            $table->date('date_rollover');
            $table->float('special_rate');
            $table->float('normal_rate');
            $table->string('id_branch');
            $table->string('created_by');
            $table->string('updated_by');
            // $table->String('customer_id')->unsigned();
            // $table->foreign('customer_id')->references('id')->on('customers');
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
