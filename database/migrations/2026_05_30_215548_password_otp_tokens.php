<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PasswordOtpTokens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('password_otp_tokens', function (Blueprint $table) {
            // Relasi ke nomor hp atau id user (Disarankan string phone_number jika mengacu pada nomor hp)
            $table->id();
            $table->string('phone_number', 20);
            $table->string('otp_code', 6);
            $table->timestamp('expires_at');
            $table->boolean('is_used')->default(false);

            // Membuat timestamps otomatis (created_at & updated_at)
            $table->timestamps();

            // Opsional: Membuat index agar pencarian query WHERE di database jauh lebih cepat
            $table->index(['phone_number', 'otp_code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('password_otp_tokens');
    }
}
