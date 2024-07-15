<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblKinerjaDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kinerja_detail', function (Blueprint $table) {
            $table->id('id_kinerjat_detail');
            $table->string('kd_kinerja_detail')->unique();
            $table->string('kd_kinerja');
            $table->string('kinerja_detail');
            $table->string('kinerja_detail_jenis');
            $table->string('kinerja_detail_length_date');
            $table->string('kinerja_detail_status');
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
        Schema::dropIfExists('tbl_kinerja_detail');
    }
}
