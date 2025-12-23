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
        Schema::create('berkas_permohonan', function (Blueprint $table) {
            $table->id('id_berkas');
            $table->foreignId('Permohonan_surat_id_permohonan')->constrained('permohonan_surat', 'id_permohonan')->cascadeOnDelete();
            $table->string('nama_berkas', 45);
            $table->string('file_path');
            $table->date('tanggal_upload_berkas');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas_permohonans');
    }
};
