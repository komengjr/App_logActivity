<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblKinerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kinerja', function (Blueprint $table) {
            $table->id('id_kinerja');
            $table->string('kd_kinerja')->unique();
            $table->string('kinerja');
            $table->string('jenis_kinerja');
            $table->string('status_kinerja');
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
        Schema::dropIfExists('tbl_kinerja');
    }
}
