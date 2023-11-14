<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersHandlerBackupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_handler_backup', function (Blueprint $table) {
            $table->id('id_users_handler_backup');
            $table->string('id_user');
            $table->string('kd_cabang');
            $table->string('tgl_hendler_backup');
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
        Schema::dropIfExists('users_handler_backup');
    }
}
