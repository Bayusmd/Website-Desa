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
        Schema::create('layanan_surat', function (Blueprint $table) {
            $table->id('id_layanan');
            $table->foreignId('Admin_id_admin')->constrained('admin', 'id')->cascadeOnDelete();
            $table->string('nama_layanan', 45);
            $table->string('deskripsi_layanan', 255);
            $table->date('tanggal_dibuat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan_surats');
    }
};
