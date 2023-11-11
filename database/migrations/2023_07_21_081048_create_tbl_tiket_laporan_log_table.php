<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblTiketLaporanLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_tiket_laporan_log', function (Blueprint $table) {
            $table->id('id_tbl_tiket_laporan_log');
            $table->string('no_tiket')->index();
            $table->string('id_user')->index();
            $table->string('keterangan');
            $table->string('tgl_buat');
            $table->string('lokasi');
            $table->string('nilai_laporan');
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
        Schema::dropIfExists('tbl_tiket_laporan_log');
    }
}
