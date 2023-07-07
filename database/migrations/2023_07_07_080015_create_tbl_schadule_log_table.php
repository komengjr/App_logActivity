<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSchaduleLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_schadule_log', function (Blueprint $table) {
            $table->id('id_log_schedule');
            $table->string('kd_schedule')->index();
            $table->string('id_user');
            $table->LongText('deskripsi_schedule');
            $table->string('status_schedule_user');
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
        Schema::dropIfExists('tbl_schadule_log');
    }
}
