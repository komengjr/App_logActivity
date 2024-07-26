<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersBackupBulananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_backup_bulanan', function (Blueprint $table) {
            $table->id('id_backup_bulanan');
            $table->string('kd_backup_bulanan')->unique();
            $table->string('kd_cabang');
            $table->string('nama_backup_bulanan');
            $table->date('tgl_input');
            $table->longText('deskripsi');
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
        Schema::dropIfExists('users_backup_bulanan');
    }
}
