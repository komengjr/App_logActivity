<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MRencanaLogDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_rencana_log_detail', function (Blueprint $table) {
            $table->id('id_m_rencana_log_detail');
            $table->string('m_rencana_log_code');
            $table->string('m_rencana_log_detail_cat');
            $table->string('m_rencana_log_detail_sub');
            $table->string('m_rencana_log_detail_desc');
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
        Schema::dropIfExists('m_rencana_log_detail');
    }
}
