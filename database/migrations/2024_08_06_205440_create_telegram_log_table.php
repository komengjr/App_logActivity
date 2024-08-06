<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelegramLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telegram_log', function (Blueprint $table) {
            $table->id('id_telegram');
            $table->string('update_id')->unique();
            $table->string('chat_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->text('text');
            $table->string('date');
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
        Schema::dropIfExists('telegram_log');
    }
}
