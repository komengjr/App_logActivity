<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblKinerjaSubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kinerja_sub', function (Blueprint $table) {
            $table->id('id');
            $table->string('kd_kinerja_sub')->unique();
            $table->string('kd_kinerja');
            $table->string('kinerja_sub');
            $table->string('jenis_kinerja_sub');
            $table->string('status_kinerja_sub');
            $table->string('point_kinerja_sub');
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
        Schema::dropIfExists('tbl_kinerja_sub');
    }
}
