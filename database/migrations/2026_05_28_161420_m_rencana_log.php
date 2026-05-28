<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MRencanaLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_rencana_log', function (Blueprint $table) {
            $table->id('id_m_rencana_log');
            $table->string('m_rencana_log_code')->unique();
            $table->string('m_rencana_log_id_brg');
            $table->string('m_rencana_log_cabang');
            $table->string('m_rencana_log_tahun');
            $table->string('m_rencana_log_bulan');
            $table->string('m_rencana_log_tgl_selesai');
            $table->string('m_rencana_log_tipe');
            $table->string('m_rencana_log_kondisi');
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
        Schema::dropIfExists('m_rencana_log');
    }
}
