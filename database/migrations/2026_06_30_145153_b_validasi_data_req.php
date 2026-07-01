<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BValidasiDataReq extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b_validasi_data_req', function (Blueprint $table) {
            $table->id('id_b_validasi_data_req');
            $table->string('b_validasi_data_req_code')->unique();
            $table->string('b_validasi_data_code');
            $table->string('b_menus_code');
            $table->string('b_validasi_data_req_date');
            $table->string('b_validasi_data_req_status');
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
        Schema::dropIfExists('b_validasi_data_req');
    }
}
