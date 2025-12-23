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
        Schema::create('informasi_desa', function (Blueprint $table) {
            $table->id('id_informasi');
            $table->foreignId('Admin_id_admin')->constrained('admin', 'id')->cascadeOnDelete();
            $table->string('kategori', 45);
            $table->string('judul', 45);
            $table->string('deskripsi', 255);
            $table->string('gambar')->nullable();
            $table->dateTime('tanggal_upload');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi_desas');
    }
};
