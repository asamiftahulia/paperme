<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flow_mappings', function (Blueprint $table) {
            $table->increments('id');
            $table->String('initial');
            $table->String('step_1')->nullable(true);
            $table->String('step_2')->nullable(true);
            $table->String('step_3')->nullable(true);
            $table->String('created_by');
            $table->string('updated_by')->nullable(true);
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
        Schema::dropIfExists('flow_mappings');
    }
}
