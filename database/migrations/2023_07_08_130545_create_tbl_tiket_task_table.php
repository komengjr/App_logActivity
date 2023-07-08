<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblTiketTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_tiket_task', function (Blueprint $table) {
            $table->id('id_tiket_task');
            $table->string('kd_tiket_task');
            $table->string('id_leader')->index();
            $table->string('kd_cabang')->index();
            $table->string('kd_kinerja')->index();
            $table->string('kd_group')->index();
            $table->longtext('deskripsi_task');
            $table->string('status_task');
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
        Schema::dropIfExists('tbl_tiket_task');
    }
}
