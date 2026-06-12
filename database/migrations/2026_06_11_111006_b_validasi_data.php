<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BValidasiData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b_validasi_data', function (Blueprint $table) {
            $table->id('id_b_validasi_data');
            $table->string('b_validasi_data_code')->unique();
            $table->string('b_validasi_data_cabang');
            $table->integer('b_validasi_data_tahun');
            $table->integer('b_validasi_data_bulan');
            $table->string('b_validasi_data_user');
            $table->string('b_validasi_data_status');
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
        Schema::dropIfExists('b_validasi_data');
    }
}
