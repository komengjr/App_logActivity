<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblCabangAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_cabang_address', function (Blueprint $table) {
            $table->id('id_tbl_cabang_address');
            $table->string('tbl_cabang_address_code')->unique();
            $table->string('kd_cabang');
            $table->string('tbl_cabang_address_ip');
            $table->string('tbl_cabang_address_user');
            $table->string('tbl_cabang_address_pass');
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
        Schema::dropIfExists('tbl_cabang_address');
    }
}
