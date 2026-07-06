<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblLaporanSecurity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_laporan_security', function (Blueprint $table) {
            $table->id('id_laporan_security');
            $table->string('laporan_security_code')->unique();
            $table->string('laporan_security_cabang');
            $table->string('laporan_security_user');
            $table->string('laporan_security_nip');
            $table->string('laporan_security_divisi');
            $table->string('laporan_security_cat');
            $table->longText('laporan_security_desc');
            $table->string('laporan_security_status');
            $table->string('laporan_security_level');
            $table->string('laporan_security_date');
            $table->string('laporan_security_respon')->nullable();
            $table->string('laporan_security_proses')->nullable();
            $table->string('laporan_security_selesai')->nullable();
            $table->string('laporan_security_it')->nullable();
            $table->string('laporan_security_number')->nullable();
            $table->string('laporan_security_email')->nullable();
            $table->text('laporan_security_file')->nullable();
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
        Schema::dropIfExists('tbl_laporan_security');
    }
}
