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
    Schema::create('rekam_medis', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pendaftaran_id')->constrained('pendaftarans')->onDelete('cascade');
        $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
        $table->foreignId('dokter_id')->constrained('users')->onDelete('cascade');
        $table->text('keluhan_utama'); // Anamnesa
        $table->string('tensi_darah')->nullable(); // Contoh: 120/80
        $table->string('suhu_tubuh')->nullable(); // Contoh: 36.5
        $table->text('diagnosa'); // Diagnosa dokter
        $table->text('tindakan')->nullable(); // Catatan tindakan medis
        $table->text('resep_obat')->nullable(); // Catatan resep obat
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekam_medis');
    }
};
