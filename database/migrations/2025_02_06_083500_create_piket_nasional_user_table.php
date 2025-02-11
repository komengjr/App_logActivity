<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePiketNasionalUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piket_nasional_user', function (Blueprint $table) {
            $table->id('id_piket_nasional_user');
            $table->string('tiket_piket_user')->unique();
            $table->string('tiket_piket_nasional');
            $table->string('user_piket');
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
        Schema::dropIfExists('piket_nasional_user');
    }
}
