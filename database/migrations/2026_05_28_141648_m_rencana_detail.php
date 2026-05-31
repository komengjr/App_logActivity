<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MRencanaDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_rencana_detail', function (Blueprint $table) {
            $table->id('id_m_rencana_detail');
            $table->string('m_rencana_detail_code')->unique();
            $table->string('m_rencana_data_code');
            $table->string('m_rencana_detail_id_brg');
            $table->string('m_rencana_detail_nama_brg');
            $table->string('m_rencana_detail_bulan');
            $table->string('m_rencana_detail_minggu');
            $table->date('m_rencana_detail_date');
            $table->string('m_rencana_detail_verif')->nullable();
            $table->text('m_rencana_detail_sign')->nullable();
            $table->integer('m_rencana_detail_status');
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
        Schema::dropIfExists('m_rencana_detail');
    }
}
