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
            $table->foreignId('proyek_id')
            ->constrained('proyeks')
            ->onDelete('cascade');
            $table->foreignId('kartu_id')
                ->constrained('kartu_tugas')
                ->onDelete('cascade');
            $table->string('nama_tugas_item');
            $table->string('deskripsi_tugas_item')->nullable();
            $table->enum('status_tugas_item', ['dalam proses', 'selesai'])->default('dalam proses');
            $table->date('tgl_mulai_tugas')->default(now());;
            $table->date('tgl_selesai_tugas');
            $table->string('slug')->unique();
            // $table->json('penanggungjawab_ids'); 
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
