<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersBackupHarianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_backup_harian', function (Blueprint $table) {
            $table->id('id_users_backup_harian');
            $table->string('kd_users_backup_harian')->unique();
            $table->string('sistem_backup_harian');
            $table->string('proses_backup_harian');
            $table->string('deskripsi_backup_harian');
            $table->string('status_backup_harian');
            $table->string('tgl_backup_harian');
            $table->string('kd_cabang');
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
        Schema::dropIfExists('users_backup_harian');
    }
}
