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
        Schema::create('aduan_masyarakat', function (Blueprint $table) {
            $table->id('id_aduan');
            $table->foreignId('Admin_id_admin')->nullable()->constrained('admin', 'id')->nullOnDelete();
            $table->string('kategori_aduan', 45);
            $table->string('deskripsi_aduan', 255);
            $table->date('tanggal_aduan');
            $table->string('status_aduan', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aduan_masyarakats');
    }
};
