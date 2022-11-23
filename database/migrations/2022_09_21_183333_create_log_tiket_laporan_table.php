<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogTiketLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_tiket_laporan', function (Blueprint $table) {
            $table->id('id_tiket_laporan');
            $table->string('no_tiket')->index();
            $table->string('id_user')->index();
            $table->string('keterangan');
            $table->string('tgl_buat');
            $table->string('lokasi');
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
        Schema::dropIfExists('log_tiket_laporan');
    }
}
