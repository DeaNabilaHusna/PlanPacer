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
        Schema::create('tugas_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kartu_id');
            $table->string('nama_tugas_item');
            $table->timestamp('tenggat_waktu')->nullable();
            $table->string('penanggung_jawab');
            $table->string('deskripsi_tugas_item')->nullable();
            $table->string('status_tugas_item');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas_items');
    }
};
