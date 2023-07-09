<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblTiketTaskLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_tiket_task_log', function (Blueprint $table) {
            $table->id('id_tiket_task_log');
            $table->string('kd_tiket_task')->index();
            $table->string('id_user')->index();
            $table->string('status_task_log');
            $table->string('tgl_buat_task_log');
            $table->longtext('deskripsi_task_log');
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
        Schema::dropIfExists('tbl_tiket_task_log');
    }
}
