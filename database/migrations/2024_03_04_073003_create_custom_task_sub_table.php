<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomTaskSubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_task_sub', function (Blueprint $table) {
            $table->id();
            $table->string('kd_custom_task');
            $table->string('nama_barang');
            $table->string('id_inventaris');
            $table->string('no_inventaris');
            $table->text('deskripsi_barang');
            $table->string('status_barang');
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
        Schema::dropIfExists('custom_task_sub');
    }
}
