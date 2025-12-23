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
        Schema::create('permohonan_surat', function (Blueprint $table) {
            $table->id('id_permohonan');
            $table->foreignId('Layanan_surat_id_layanan')->constrained('layanan_surat', 'id_layanan')->cascadeOnDelete();
            $table->string('nama_pemohon', 45);
            $table->string('nik_pemohon', 20);
            $table->string('alamat_pemohon', 45);
            $table->string('no_whatsapp', 45);
            $table->string('email_pemohon', 45);
            $table->dateTime('tanggal_permohonan');
            $table->string('status_permohonan', 20);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_surats');
    }
};
