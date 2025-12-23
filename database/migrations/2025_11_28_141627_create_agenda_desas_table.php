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
        Schema::create('agenda_desa', function (Blueprint $table) {
            $table->id('id_agenda');
            $table->foreignId('Admin_id_admin')->constrained('admin', 'id')->cascadeOnDelete();
            $table->date('tanggal_agenda');
            $table->string('nama_agenda', 45);
            $table->string('lokasi_agenda', 45);
            $table->string('deskripsi_agenda', 255);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda_desas');
    }
};
