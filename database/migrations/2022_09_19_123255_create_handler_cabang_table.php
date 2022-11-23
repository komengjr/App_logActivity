<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHandlerCabangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('handler_cabang', function (Blueprint $table) {
            $table->id('id_handler_cabang');
            $table->string('kd_cabang')->index();
            $table->string('kd_group')->index();
            $table->string('status_handler')->nullable();
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
        Schema::dropIfExists('handler_cabang');
    }
}
