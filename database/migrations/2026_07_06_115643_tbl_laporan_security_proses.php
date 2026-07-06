<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblLaporanSecurityProses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_laporan_security_proses', function (Blueprint $table) {
            $table->id('id_laporan_security_proses');
            $table->string('laporan_security_proses_code')->unique();
            $table->string('laporan_security_code');
            $table->string('laporan_security_proses_type');
            $table->date('estimasi_laporan_date');
            $table->time('estimasi_laporan_time');
            $table->string('laporan_security_proses_user');
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
        Schema::dropIfExists('tbl_laporan_security_proses');
    }
}
