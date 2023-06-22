<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPeriodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_periode', function (Blueprint $table) {
            $table->id('id_periode');
            $table->string('bulan');
            $table->string('tahun');
            $table->string('awal_tgl');
            $table->string('akhir_tgl');
            $table->string('status_periode');
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
        Schema::dropIfExists('tbl_periode');
    }
}
