<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblLaporanUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_laporan_user', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->string('tiket_laporan')->unique();
            $table->string('kd_cabang');
            $table->string('nama_user');
            $table->string('nip_user');
            $table->string('divisi');
            $table->longText('deskripsi_laporan');
            $table->string('status_laporan');
            $table->string('tgl_laporan');
            $table->string('tgl_selesai_laporan')->nullable();
            $table->string('id_user')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('tbl_laporan_user');
    }
}
