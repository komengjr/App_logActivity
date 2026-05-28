<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MRencanaData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_rencana_data', function (Blueprint $table) {
            $table->id('id_m_rencana_data');
            $table->string('m_rencana_data_code')->unique();
            $table->string('m_rencana_data_cabang');
            $table->string('m_rencana_data_user');
            $table->integer('m_rencana_data_tahun');
            $table->integer('m_rencana_data_status');
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
        Schema::dropIfExists('m_rencana_data');
    }
}
