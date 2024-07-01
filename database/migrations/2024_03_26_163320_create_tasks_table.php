<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('tugas_items', function (Blueprint $table) {
    //         $table->id();
    //         $table->foreignId('proyek_id')
    //         ->constrained('proyeks')
    //         ->onDelete('cascade');
    //         $table->foreignId('kartu_id')
    //             ->constrained('kartu_tugas')
    //             ->onDelete('cascade');
    //         $table->string('nama_tugas_item');
    //         $table->string('deskripsi_tugas_item')->nullable();
    //         $table->enum('status_tugas_item', ['dalam proses', 'selesai'])->default('dalam proses');
    //         $table->date('tgl_mulai_tugas')->default(now());;
    //         $table->date('tgl_selesai_tugas');
    //         $table->string('slug')->unique();
    //         // $table->json('penanggungjawab_ids'); 
    //         $table->timestamps();
    //     });
    // }

    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')
            ->constrained('projects')
            ->onDelete('cascade');
            $table->foreignId('modul_id')
                ->constrained('moduls')
                ->onDelete('cascade');
            $table->string('task_name');
            $table->string('task_description')->nullable();
            $table->enum('task_status', ['dalam proses', 'selesai'])->default('dalam proses');
            $table->date('task_start_date')->default(now());;
            $table->date('task_end_date');
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
