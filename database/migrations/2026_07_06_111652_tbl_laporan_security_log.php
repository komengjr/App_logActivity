<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblLaporanSecurityLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_laporan_security_log', function (Blueprint $table) {
            $table->id('id_laporan_security_log');
            $table->string('laporan_security_code');
            $table->string('laporan_security_log_user');
            $table->longText('laporan_security_log_desc');
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
        Schema::dropIfExists('tbl_laporan_security_log');
    }
}
