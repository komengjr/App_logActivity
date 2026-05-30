<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MTugas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_tugas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tipe');
            $table->string('target_user'); // Menyimpan nama atau ID petugas
            $table->date('tgl_mulai');
            $table->date('tgl_selesaimen');
            $table->string('nama_surat')->nullable();
            $table->string('url_surat')->nullable();
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['Belum Dimulai', 'Dalam Pengerjaan', 'Dalam Peninjauan', 'Selesai'])->default('Belum Dimulai');
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
        Schema::dropIfExists('m_tugas');
    }
}
