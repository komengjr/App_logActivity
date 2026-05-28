<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblLaporanUserProses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_laporan_user_proses', function (Blueprint $table) {
            $table->id('id_tbl_laporan_user_proses');
            $table->string('tbl_laporan_user_proses_code')->unique();
            $table->string('tiket_laporan');
            $table->string('tbl_laporan_user_proses_type');
            $table->date('estimasi_laporan_date');
            $table->time('estimasi_laporan_time');
            $table->string('id_user');
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
        Schema::dropIfExists('tbl_laporan_user_proses');
    }
}
