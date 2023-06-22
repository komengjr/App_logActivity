<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_schedule', function (Blueprint $table) {
            $table->id('id_schedue');
            $table->string('kd_schedule')->unique();
            $table->string('kd_kinerja');
            $table->string('tgl_start');
            $table->string('tgl_akhir');
            $table->string('status_schedule');
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
        Schema::dropIfExists('tbl_schedule');
    }
}
