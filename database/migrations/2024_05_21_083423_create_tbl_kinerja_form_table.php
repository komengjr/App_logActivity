<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblKinerjaFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kinerja_form', function (Blueprint $table) {
            $table->id('id_form');
            $table->string('kd_kinerja_form')->unique();
            $table->string('kd_kinerja');
            $table->string('kd_kinerja_detail');
            $table->string('nama_form');
            $table->string('status_form');
            $table->string('posisi_form');
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
        Schema::dropIfExists('tbl_kinerja_form');
    }
}
