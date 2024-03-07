<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_task', function (Blueprint $table) {
            $table->id('id_custom');
            $table->string('kd_custom_task')->unique();
            $table->string('kd_kinerja');
            $table->string('kategori_task');
            $table->string('nama_task');
            $table->string('tgl_buat_custom');
            $table->string('deskripsi_custom_task');
            $table->string('status_custom_task');
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
        Schema::dropIfExists('custom_task');
    }
}
