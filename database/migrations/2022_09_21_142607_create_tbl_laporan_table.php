<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_laporan', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->string('kd_laporan')->unique();
            $table->string('kd_kinerja')->index();
            $table->string('nama_laporan');
            $table->string('type_laporan')->index();
            $table->longtext('deskripsi_laporan');
            $table->string('status_laporan');
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
        Schema::dropIfExists('tbl_laporan');
    }
}
