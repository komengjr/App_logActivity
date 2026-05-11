<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblLaporanHardware extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_laporan_hardware', function (Blueprint $table) {
            $table->id('id_tbl_laporan_hardware');
            $table->string('tbl_laporan_hardware_code')->unique();
            $table->string('tiket_laporan');
            $table->string('inventaris_data_code');
            $table->string('inventaris_data_name');
            $table->string('tbl_laporan_hardware_status');
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
        Schema::dropIfExists('tbl_laporan_hardware');
    }
}
