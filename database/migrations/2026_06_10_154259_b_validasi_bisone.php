<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BValidasiBisone extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b_validasi_bisone', function (Blueprint $table) {
            $table->id();
            $table->string('b_validasi_bisone_code');                         // Contoh: 2026
            $table->string('b_validasi_data_req_code');                         // Contoh: 2026
            $table->year('tahun');                         // Contoh: 2026
            $table->string('bulan');                       // Contoh: "Januari"

            // Menghubungkan langsung ke kode unik sub menu Anda
            $table->string('b_menus_sub_code');
            $table->foreign('b_menus_sub_code')
                ->references('b_menus_sub_code')
                ->on('b_menus_sub')
                ->onDelete('cascade');

            $table->integer('skala');                      // Nilai 0-4
            $table->text('catatan_manual')->nullable();     // Input textarea bebas
            $table->string('nama_verifikator');
            $table->longText('ttd_verifikator');           // TTD Base64 string
            $table->string('nama_validator');
            $table->longText('ttd_validator');             // TTD Base64 string
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
        Schema::dropIfExists('b_validasi_bisone');
    }
}
