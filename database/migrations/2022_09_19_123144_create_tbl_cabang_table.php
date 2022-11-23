<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCabangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_cabang', function (Blueprint $table) {
            $table->string('kd_cabang')->unique();
            $table->string('nama_cabang');
            $table->string('latitude');
            $table->string('longtitude');
            $table->string('city');
            $table->string('alamat');
            $table->string('phone');
            $table->string('status_cabang')->nullable();
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
        Schema::dropIfExists('tbl_cabang');
    }
}
