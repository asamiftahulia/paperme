<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMBranchsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('m_branchs', function (Blueprint $table) {
            $table->string('id',20);
            $table->string('nama',255);
            $table->string('alamat',255);
            $table->string('parent_id',20)->nullable('true');
            $table->string('jenis_cabang',10);
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
