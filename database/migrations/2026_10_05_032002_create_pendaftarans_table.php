<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('pendaftarans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
        $table->foreignId('dokter_id')->constrained('users')->onDelete('cascade');
        $table->string('poli'); // Contoh: Poli Umum, Poli Gigi, Poli Spesialis
        $table->string('no_antrean'); // Contoh: A-001, A-002
        $table->date('tanggal_daftar');
        $table->enum('status', ['menunggu', 'diperiksa', 'selesai', 'batal'])->default('menunggu');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
